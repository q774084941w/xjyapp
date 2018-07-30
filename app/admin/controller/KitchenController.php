<?php
// +----------------------------------------------------------------------
// | XjyApplet [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright © 2016-2026 AII Rights Reserved  http://www.ccapp.com.cn/
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +---------------------------------------------------------------------
// | Author: 小谢 < 774084941@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use think\Db;
use cmf\controller\AdminBaseController;

class KitchenController extends AdminBaseController
{
    protected $thisOne;

    public function _initialize()
    {
        if (cmf_get_current_admin_id() == null) {
            $this->error("您没有访问权限！");
        }
        if(session('admin_parent_id') == 1)
        {
            $user_id = session('ADMIN_ID');
        }else
        {
            $user_id = session('admin_parent_id');
        }

        $this->admin_user_id = $user_id;
    }

    /**
     * 后厨主页
     * @adminMenu(
     *     'name'   => '后厨主页',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '后厨主页',
     *     'param'  => ''
     * )
     */
    public function index(){
        $request        = input('request.');
        $where          = [];
        if(cmf_get_current_admin_id() != 1)
        {
            $where['a.seller_id'] = ['eq',$this->admin_user_id ];
        }
        $order = Db::name('order');
        $keywordComplex = [];
        if (!empty($request['keyword'])) {
            $keyword = $request['keyword'];

            $keywordComplex['a.order_id']  = ['like', "%$keyword%"];
        }

        if(!empty($request['table']))
        {
            $where['b.tb_id'] = ['eq',$request['table']];
        }

        if(!empty($request['menu']))
        {
            $where['b.menu_id'] = ['eq',$request['menu']];
        }

        if(!empty($request['beginTime']) || !empty($request['endTime'])){
            if(empty($request['beginTime'])){
                $request['beginTime']= '1970-01-01' ;
            }
            $endTime = $request['endTime'];
            if(empty($endTime)){
                $endTime= date('Y-m-d',time());
            }
            $endTime =    date("Y-m-d",strtotime("$endTime   +1   day"));
            $order->whereTime('order_time','between',[$request['beginTime'],$endTime]);

        }


        $data = $order
                ->field('a.order_id,a.order_time,c.name,tb_id,a.food_type')
                ->alias('a')
                ->join('__REST__ b','a.table_id =  b.id')
                ->join('__FOOD_MENU__ c','c.id =  b.menu_id')
                ->whereOr($keywordComplex)
                ->where($where)
                ->where('a.delete_time','eq',0)
                ->where('a.order_class','neq',3)
                ->order("food_type")
                ->paginate(10);
        $data->appends($request);
        $page = $data->render();

        //服务厅列表
        $model = model('FoodMenu');
        $menu = $model->index();
        $this->assign('menu',$menu);

        $this->assign('id',session('ADMIN_ID'));
        $this->assign("order", $data);
        $this->assign("page",$page);

        return $this->fetch();
    }

    /**
     * 菜单详情
     * @adminMenu(
     *     'name'   => '菜单详情',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '菜单详情',
     *     'param'  => ''
     * )
     */
    public function menu()
    {
        $id = $this->request->param("id");
        if (!empty($id))
        {
            $order_id = $id;
        }
        if (empty($order_id))
        {
            $this->error('订单号不能为空！');
        }
        else
            {
                $model = model('order');
                $order = $model->index($order_id);

                $model->where('order_id', $order_id)->update(['food_type'=>1]);

                if (empty($order))
                {
                    $this->error('订单号不存在！');
                }
                if (!empty($order['food']))
                {

                    $theModelData = $model->takeFood($order['food']);
                    $food           = $theModelData['food'];
                    $new            = $theModelData['data'];
                    $food_conuts = 0;
                    foreach ($food as $key => $value) 
                    {
                        $order_food_info = Db::name('order_food')->where('order_id', $order_id)->where('food_id', $value['id'])->field('come_out_num,status')->find();

                        if(!empty($order_food_info))
                        {
                           $food[$key]['come_out_num'] =  $order_food_info['come_out_num'];
                           $food[$key]['status']       =  $order_food_info['status'];
                        }else
                        {
                            $food[$key]['come_out_num'] = 0;
                            $food[$key]['status']       = 0; 
                        }

                        if($food[$key]['status'] != 2)
                        {
                            $food_conuts++;
                        }

                    }

                    $this->assign('food_conuts', $food_conuts);
                    $this->assign('data', $new);
                    $this->assign('food', $food);
                    $this->assign('order_id', $order_id);


                    return $this->fetch();
                }

            return $this->fetch();

        }
    }

    /**
     * 菜品操作
     * @adminMenu(
     *     'name'   => '菜品操作',
     *     'parent' => 'menu',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '菜品操作',
     *     'param'  => ''
     * )
     */
    public function changeType(){
        $old   = $this->request->param('id');
        $food_conuts = intval($this->request->param('food_conuts'));
        
        $food_id  = explode(",",$old);
        $order_id = $food_id[0];
        $num      = $food_id[2];
        $food_id  = $food_id[1];
        
        $food_conuts_num = session("food_conuts_num") ? session("food_conuts_num") : 1;

        if($food_conuts_num < $food_conuts)
        {
            $rest = Db::name('order_food')->where('order_id', $order_id)->where('food_id', $food_id)->field('come_out_num,status')->find();
            if(!empty($rest))
            {
                $rest = Db::name('order_food')->where('order_id', $order_id)->where('food_id', $food_id)->update(['status'=>2]);
            }else{
                $val = array(
                            'order_id'      => $order_id,
                            'food_id'       => $food_id,
                            'num'           => $num,
                            'come_out_num'  => $num,
                            'status'        => 2,
                        );
                $rest = Db::name('order_food')->insert($val);
            }
            
            $food_conuts_num++;
            session("food_conuts_num",$food_conuts_num);
            echo 1100;
        }else{

            $rest = Db::name('order_food')->where('order_id', $order_id)->where('food_id', $food_id)->field('come_out_num,status')->find();
            if(!empty($rest))
            {
                $rest = Db::name('order_food')->where('order_id', $order_id)->where('food_id', $food_id)->update(['status'=>2]);
            }else{
                $val = array(
                            'order_id'      => $order_id,
                            'food_id'       => $food_id,
                            'num'           => $num,
                            'come_out_num'  => $num,
                            'status'        => 2,
                        );
                $rest = Db::name('order_food')->insert($val);
            }


            $result = Db::name('order')
                        ->where('order_id',$order_id)
                        ->update(['food_type'=>2]);
            if(!empty($result))
            {
                session("food_conuts_num",null);

                echo 1111;
                exit;
            }else
            {
                $this->error('错误');
            }     
        }

    }

    /**
     * 检测出单情况
     * @adminMenu(
     *     'name'   => '检测出单情况',
     *     'parent' => 'menu',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '检测出单情况',
     *     'param'  => ''
     * )
     */
    protected function haveAll($data){
        foreach ($data as $val){
            if($val['nub']!=3){
                return true;
            }
        }
        return false;
    }
}