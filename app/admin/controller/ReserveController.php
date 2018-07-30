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


use cmf\controller\AdminBaseController;
use think\Db;

class ReserveController extends AdminBaseController
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
     * 预约信息列表
     * @adminMenu(
     *     'name'   => '预约信息列表',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '预约信息列表',
     *     'param'  => ''
     * )
     */

    public function index()
    {
        $request        = input('request.');

        $order_complete = $this->request->param("order_complete", 0, 'intval');
        $where          = [
            'a.delete_time' => 0,
            'a.order_class' => 3,
        ];

        if(!empty($order_complete))
        {
            $where['order_complete']  =  ['eq',$order_complete];
        }

        if(cmf_get_current_admin_id() != 1)
        {
            $where['a.seller_id'] = ['eq',$this->admin_user_id];
        }

        if(!empty($request['pay']))
        {
            $where['pay']  =  ['eq',$request['pay']];
        }

        if(!empty($request['order_complete']))
        {
            $where['order_complete']  =  ['eq',$request['order_complete']];
        }

        $keywordComplex = [];
        if (!empty($request['keyword'])) {
            $keyword = $request['keyword'];

            $keywordComplex['a.order_id|b.seller_nickname']  = ['like', "%$keyword%"];
        }

        $time = [];
        if(!empty($request['time']))
        {
            $time = 'date_format(from_unixtime(a.order_time),"%Y-%m-%d") = date_format("'.$request['time'].'","%Y-%m-%d")';
        }

        $data = Db::name('order')
            ->alias('a')
            ->join('__SELLER__ b','a.seller_id = b.id')
            ->join('__SELLER_RESERVE__ C','a.order_id = c.id')
            ->whereOr($keywordComplex)
            ->where($where)
            ->where($time)
            ->order(["a.order_id" => "DESC"])
            ->field('a.*,b.seller_nickname,c.*')
            ->paginate(10);

        $data->appends($request);
        $page = $data->render();

        $this->assign('id',session('ADMIN_ID'));
        $this->assign("order", $data);
        $this->assign("page",$page);

        return $this->fetch();
    }


    /**
     * 预约信息详情
     * @adminMenu(
     *     'name'   => '预约信息详情',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '预约信息详情',
     *     'param'  => ''
     * )
     */

    public function Detailed()
    {
        $type     = $this->request->param('type');
        $this->assign('type',$type);
        $order_id = $this->request->param("order_id");
        if (empty($order_id))
        {

            $this->error('订单号不能为空！');

        }
        else
        {
            //订单详情
            $model = model('order');
            $order  = $model->index($order_id);


            if (empty($order))
            {
                $this->error('订单号不存在！');
            }
            elseif($order['seller_id'] == session('ADMIN_ID') or cmf_get_current_admin_id() == 1 or session('admin_parent_id') != 1)

            {

                $user   = Db::name('third_party_user')->where('id','eq',$order['user_id'])->find();

                $this->assign('user',$user);

                $seller = Db::name('seller')->where(["id" => $order['seller_id']])->find();


                    $reserve = Db::name('seller_reserve')
                        ->alias('a')
                        ->field('a.*,b.table_name,c.name')
                        ->join('__SELLER_TABLE__ b', 'a.reserve_class = b.id')
                        ->join('__FOOD_MENU__ c', 'a.menu_id = c.id')
                        ->where(["a.id" => $order['order_id']])->find();
//                    dump($reserve);exit;
                    $this->assign('reserve',$reserve);

                //使用优惠劵ID
                if ($order['coupon_id'] != 0)
                {
                    $coupon = xjy_get_sql("*","xjy_coupon left join xjy_coupon_type on xjy_coupon.coupon_type_id = xjy_coupon_type.coupon_type_id","xjy_coupon.coupon_id = ".$order['coupon_id']);
                    $this->assign('coupon',$coupon);
                }
                //食物详情
                if (!empty($order['food']))
                {
                    $data = $model->takeFood($order['food']);
                    $this->assign('data',$data['data']);
                    $this->assign('food',$data['food']);
                }

                $this->assign('order',$order);
                $this->assign('seller',$seller);
                return $this->fetch();
            }
            else
            {
                $this->error('不能查看他人订单！');
            }
        }
    }


    /**
     * 预约订单修改
     * @adminMenu(
     *     'name'   => '预约订单修改',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '预约订单修改',
     *     'param'  => ''
     * )
     */

    public function Edit(){
        $type     = $this->request->param('type');
        $this->assign('type',$type);
        $order_id = $this->request->param("order_id");

        if(empty($order_id))
        {
            $this->error('订单号不能为空！');
        }else
        {
            //订单详情
            $model = model('order');
            $order  = $model->index($order_id);

            if(empty($order))
            {
                $this->error('订单号不存在！');
            }
            elseif($order['seller_id'] == session('ADMIN_ID') or session('admin_parent_id') != 1 or cmf_get_current_admin_id() == 1)
            {
                $delivery1  = Db::name('delivery_type')->select();

                if ($order['order_class'] == 2)
                {
                    $delivery   = Db::name('delivery_type')->where(["delivery_id" => $order['delivery_type']])->find();
                    $this->assign('delivery',$delivery);
                }

                elseif ($order['order_class'] == 3)
                {
                    $reserve    = $model
                        ->name('seller_reserve')
                        ->where(["id" => $order['order_id']])
                        ->find();

                    $this->assign('reserve',$reserve);
                }

                if ($order['coupon_id'] != 0)
                {
                    $coupon     = xjy_get_sql("*","xjy_coupon left join xjy_coupon_type on xjy_coupon.coupon_type_id = xjy_coupon_type.coupon_type_id","xjy_coupon.coupon_id = ".$order['coupon_id']);
                    $this->assign('coupon',$coupon);
                }

                if (!empty($order['food']))
                {
                    $data = $model->takeFood($order['food']);
                    $this->assign('data',$data['data']);
                    $this->assign('food',$data['food']);
                }

                $seller_menu= Db::name('seller_menu')->where(['seller_id'=>$order['seller_id']])->where('delete_time','eq',0)->select();
                $table      = Db::name('seller_table')->where(['seller_id'=>$order['seller_id']])->where('delete_time','eq',0)->select();

                $this->assign('table',$table);
                $this->assign('seller_menu',$seller_menu);

                $this->assign('order',$order);
                $this->assign('delivery1',$delivery1);


                //服务厅列表
                $model = model('FoodMenu');
                $menu = $model->index();
                $this->assign('menu',$menu);

                return $this->fetch();
            }else
            {
                $this->error("不能修改他人订单！");
            }
        }
    }
}