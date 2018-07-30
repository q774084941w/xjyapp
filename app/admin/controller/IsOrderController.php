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


use API_PHP\APIPHP;
use cmf\controller\AdminBaseController;
use think\Db;

class IsOrderController extends AdminBaseController
{
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
     * 后台开台
     * @adminMenu(
     *     'name'   => '后台开台',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '后台开台',
     *     'param'  => ''
     * )
     */
    public function newOrder()
    {
        $request   = $this->request->param();
        if(empty($request['table_id'])){
            return $this->error('数据不完整',url('admin/cashier/index'));
        }
        $model = model('rest');
        $data['user_id']     =  session('ADMIN_ID');
        $data['seller_id']   =  $this->admin_user_id;
        $data['table_id']    =  $model->witchOne($request['table_id']);
        $data['order_id']    =  self::orderID();
        $data['order_time']  =  time();
        $this->assign('order',$data);



        //服务厅列表
        $model = model('FoodMenu');
        $menu = $model->index();
        $this->assign('menu',$menu);

        return $this->fetch();
    }

    /**
     * 确认订单
     * @adminMenu(
     *     'name'   => '确认订单',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '确认订单',
     *     'param'  => ''
     * )
     */
    public function addPost(){

        if ($this->request->isPost())
        {
            $data = $this->request->param();
            $result = $this->validate($data['order'], 'order');

            if (true !== $result)
            {
                $this->error($result);
            }

            $data['order']['order_time']    = strtotime($data['order']['order_time']);

            if(!empty($data['food']))
            {
                $data['order']['food']          = "";

                ksort($data['food']);

                foreach($data['food'] as $key =>$val)
                {
                    $data['order']['food'].=$key.'*'.$val.';';
                }
            }
            $model = model('rest');
            $model->insertOrderId($data['order']['table_id'],$data['order']['order_id']);

            if (Db::name('order')->insert($data['order']) !== false)
            {
                $result = $this->auto($data['order']['order_id'],2);

                $this->success("添加成功！", url( 'Cashier/index',array('order'=>$data['order']['order_id'])));
            }

            else
            {
                $this->error("添加失败！",url('isOrder/newOrder'));
            }

        }

        else
        {
            $this->error('错误操作');
        }
    }


    /**
     * 订单号生成
     * @return string
     */
    public static function orderID(){
        return date('YmdHis').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }


    /**
     * 退菜页面
     * @adminMenu(
     *     'name'   => '退菜页面',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '退菜页面',
     *     'param'  => ''
     * )
     */
    public function Edit()
    {
        $request = $this->request->param();
        if (empty($request['order_id']))
        {
            $this->error('数据不完整',url('cashier/index'));
        }

        $order_id  = $request['order_id'];
        $model   = model('order');
        $order = $model->index($order_id);

        if(empty($order))
        {
            $this->error('订单号不存在！');
        }
        elseif($order['seller_id'] == session('ADMIN_ID') or session('admin_parent_id') != 1 or cmf_get_current_admin_id() == 1)
        {
            if (!empty($order['food']))
            {
                $data = $model->takeFood($order['food']);
                $this->assign('data',$data['data']);
                $this->assign('food',$data['food']);
            }

            $model = model('rest');
            $order['table_id']    =  $model->witchOne($order['table_id']);

            $this->assign('order', $order);



            //服务厅列表
            $model = model('FoodMenu');
            $menu = $model->index();
            $this->assign('menu', $menu);


        }
        return $this->fetch();
    }


    /**
     * 退菜提交
     * @adminMenu(
     *     'name'   => '退菜提交',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '退菜提交',
     *     'param'  => ''
     * )
     */
    public function editPost(){
        if ($this->request->isPost())
        {
            $request = $this->request->param();
            $model   = model('order');
            $order_data = $model->printinformation($request['order']['order_id']);

            if (empty($request['food']))
            {
                $this->error('数据不完整');
            }
            //退菜打印
            $result = $this->theFood($order_data['food'],$request['food'],$order_data);

            $request['order']['order_time']    = strtotime($request['order']['order_time']);

            if(!empty($request['food']))
            {
                $request['order']['food']          = "";

                ksort($request['food']);
                $food = $request['food'];
                foreach($request['food'] as $key =>$val)
                {
                    $request['order']['food'].=$key.'*'.$val.';';
                    $food_list[] = $key;
                }

                //重新计算价格
                $sql['id']  = array('in',$food_list);
                $food_data  = Db::name('seller_menu')->field('id,price,discount')->where($sql)->order('id ASC')->select();
                $order_price = 0;
                $order_discount = 0;
                $order_discount_price = 0;
                foreach ($food_data as $key => $value)
                {
                    $order_price += $value['price']*$food[$value['id']];
                    $order_discount += $value['discount']*$food[$value['id']];
                }

                $order_discount_price += $order_price - $order_discount;
                $request['order']['discount_price'] = $order_discount_price;
            }
            if (Db::name('order')->update($request['order']) !== false)
            {
                $this->success("修改成功！", url('Cashier/index',array('order'=>$request['order']['order_id'])));
            }
            else
            {
                $this->error("修改失败！",url('Cashier/index'));
            }


        }
        else
        {
            $this->error('错误操作',url('cashier/index'));
        }
    }

    /**
     * 食物比较
     * @adminMenu(
     *     'name'   => '食物比较',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '食物比较',
     *     'param'  => ''
     * )
     */
    public function theFood($old,$new,$order)
    {
        if (empty($old)||empty($new))
        {
           return false;
        }
        $newFoodId = array();
        //获取新菜单的所有信息
        foreach ($new as $key=>$val)
        {
            $newFoodId[] = $key;
        }

        $add      = array();
        $deleteId = array();
        foreach ($old as $k=>$v)
        {
            //删除菜系
            if (!in_array($v[0],$newFoodId))
            {
                $deleteId[] = $v;
            }
            else
            {
                //数量减少
                if ($v[1] > $new[$v[0]])
                {
                    $deleteId[] = array(
                        $v[0],($v[1]-$new[$v[0]])
                    );
                }
                //数量增加
                elseif ($v[1] < $new[$v[0]])
                {
                    $add[]    = array(
                        $v[0],($new[$v[0]]-$v[1])
                    );
                }
            }

        }
        if(!empty($add)){
            $this->outPrint($add,$order,2);
        }

        return $this->outPrint($deleteId,$order);


    }



    /**
     * 退菜打印
     * @adminMenu(
     *     'name'   => '退菜打印',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '退菜打印',
     *     'param'  => ''
     * )
     */
    public function outPrint($deleteId,$order,$type=1)
    {
        if (empty($deleteId))
        {
            return false;
        }
        $apiphp = new APIPHP();
        $model       = model('sellerMenu');
        $printModel  = model('printer');
        $arr   =  array(
            'a.seller_id' => $this->admin_user_id ,
        );
        $lost = array();
        switch ($type)
        {
            case 1:
                $order['theTitle'] = '退菜信息';
                break;
            default:
                $order['theTitle'] = '加菜信息';
        }
        foreach ($deleteId as $val)
        {
            $arr['a.id'] = $val[0];
            $data  = $model->findThem($arr);

            $order['print_id'] = $printModel->thisOne($data[0]['food_class'],2);
            $food  = array(
                'title' => $data[0]['food_name'],
                'price' => $data[0]['price'],
                'num'   => $val[1],
            );

            $result = $apiphp->printKitchen2($food,$order);
            $order['print_id'] = $printModel->thisOne($data[0]['food_class'],1);
            $result = $apiphp->printKitchen2($food,$order);
            if($result['code']!=1111){
                $lost[] = array(
                    'food' => $food,
                    'sub_msg' => $result['sub_msg']
                );
            }

        }

        return $lost;

    }


    /**
     * 查看是否能退菜
     * @adminMenu(
     *     'name'   => '查看是否能退菜',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '查看是否能退菜',
     *     'param'  => ''
     * )
     */
    public function canDelete()
    {
        $request = $this->request->param();
        if (empty($request['food_id'] || empty($request['order_id'])))
        {
            $this->error('数据不完整');
        }

        $model = model('order');
        $where = array(
            'order_id' => $request['order_id'],
            'food_id'  => $request['food_id'],
        );
        $result = $model->canDelete($where);
        if ($result)
        {
            echo json_encode(array(
                'code'      => 1111,
                'sub_msg'   => '可以删除',
            ));
        }
        else
        {
            echo json_encode(array(
                'code'      => 0000,
                'sub_msg'   => '已经出菜',
            ));
        }
    }

    /**
     * 闭台
     * @adminMenu(
     *     'name'   => '闭台',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '闭台',
     *     'param'  => ''
     * )
     */
    public function closeRest()
    {
        if ($this->request->isPost())
        {
            $request = $this->request->param();
            if (empty($request['order_id']))
            {
                echo json_encode(array(
                    'code'      => 0000,
                    'sub_msg'   => '数据不完整',
                ));
                exit;
            }

            $arr='退单信息';
            $this->auto($request['order_id'],2,$arr);

            $model  = model('order');
            $model->where('order_id',$request['order_id'])->delete();
            $result = $model
                ->name('rest')
                ->where('order_id',$request['order_id'])
                ->update(array(
                    'type'      => 1,
                    'order_id'  => null,
                ));

            if($result)
            {

                echo json_encode(array(
                    'code'      => 1111,
                    'sub_msg'   => '修改成功',
                ));
            }
            else
            {
                echo json_encode(array(
                    'code'      => 0000,
                    'sub_msg'   => '修改失败',
                ));
            }

        }
        else
        {
            echo json_encode(array(
                'code'      => 0000,
                'sub_msg'   => '错误操作',
            ));
        }
    }

    /**
     * 打印订单接口
     * @param $order_id 订单号
     * @param int $times 打印次数
     */
    public function auto($order_id,$times=1,$orderTitle=null){

        if(empty($order_id))
        {
            $this->error('订单号不能为空！');
        }
        $all=array();
        $order = Db::name('order')
            ->alias('a')
            ->join('__REST__ b','a.table_id=b.id')
            ->join('__FOOD_MENU__ c','b.menu_id=c.id')
            ->field('a.food,c.name,a.remarks,a.order_price,a.order_time,a.order_id,b.tb_id')
            ->where('a.order_id', $order_id)
            ->find();
        if (empty($order))
        {
            $this->error('未查询到订单信息');
        }
        if (!empty($order['food']))
        {

            $order['food'] = explode(";", $order['food']);
            $id = array();
            $food = array();
            array_pop($order['food']);
            //挑出菜单
            foreach ($order['food'] as $k => $u) {
                $strarr = explode("*", $u);
                foreach ($strarr as $key => $newstr) {
                    if ($key == 0) {
                        $food[$k]['id'] = $newstr;
                        $id[] = $newstr;
                    } else {
                        $food[$k]['num'] = $newstr;
                    }
                }
            }

            $sql['id'] = array('in', $id);
            $data = Db::name('seller_menu')->field('food_name,id,price,food_class')->where($sql)->select();
            $id = array();
            foreach ($data as $kay=>$val)
            {
                foreach ($food as $k=>$v)
                {
                    if ($v['id']==$val['id'])
                    {
                        $food[$k]['title'] = $val['food_name'];
                        $food[$k]['price'] = $val['price'];
                        $food[$k]['food_class'] = $val['food_class'];
                        break;
                    }
                }
                $id[] = $val['food_class'];
            }
            $where['menu_id'] = array('in',$id);
            $model  = model('printer');


                //后厨打印
                $food_nub = $model->printer_id($where,$food,2);

                $all['food_nub'] = $food_nub;

                //前台

                $newArr = $model->printer_id($where,$food,1);



            $all['food_all']          = $newArr;
            $all['order']             = $order;
            $all['order']['times']    = $times;
            if (!empty($orderTitle))
            {
                $all['order']['thisTitle']=$orderTitle;
            }
        }
        if(empty($all)){
            return array('code'=>0000,'sub_msg'=>'订单没有点菜');
        }

        $apiphp = new APIPHP();
        return $apiphp->combination($all);
    }

}