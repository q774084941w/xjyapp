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

namespace app\admin\model;


use think\Model;

class OrderModel extends Model
{
    /**
     * 查找订单信息
     * @adminMenu(
     *     'name'   => '查找订单信息',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '查找订单信息',
     *     'param'  => ''
     * )
     */
    public function index($order_id)
    {
        $data = $this
            ->where('order_id',$order_id)
            ->find();

        $data = json_decode(json_encode($data),true);
        return $data;
    }



    /**
     * 查询是否出菜
     * @adminMenu(
     *     'name'   => '查询是否出菜',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '查询是否出菜',
     *     'param'  => ''
     * )
     */
    public function canDelete($where)
    {
        $data = $this
            ->name('order_food')
            ->where($where)
            ->find();

        $data = json_decode(json_encode($data),true);

        if (!empty($data))
        {
            return false;
        }
        else
        {
            return true;
        }
    }


    /**
     * 打印时需要的信息
     * @adminMenu(
     *     'name'   => '打印时需要的信息',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '打印时需要的信息',
     *     'param'  => ''
     * )
     */
    public function printinformation($order_id)
    {
        $order = $this
            ->alias('a')
            ->join('__REST__ b','a.table_id=b.id')
            ->join('__FOOD_MENU__ c','b.menu_id=c.id')
            ->field('a.food,c.name,a.remarks,a.order_price,a.order_time,a.order_id,b.tb_id,b.menu_id')
            ->where('a.order_id', $order_id)
            ->find();
        $data = json_decode(json_encode($order),true);
        $food  = explode(";",$data['food']);
        array_pop( $food);
        $Ndata = array();
        foreach($food as $k => $u)
        {
            $strarr = explode("*",$u);
            $Ndata[] = $strarr;
        }
        $data['food'] = $Ndata;
        return $data;
    }

    /**
     * 支付方式
     * @adminMenu(
     *     'name'   => '支付方式',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '支付方式',
     *     'param'  => ''
     * )
     */
    public function pay_class($seller_id)
    {
        $data = $this->name('order_pay_class')
            ->field('id,name')
            ->where('seller_id',$seller_id)
            ->where('delete_time',1)
            ->select();
        $data  = json_decode(json_encode($data),true);
        $nArr  = array();
        foreach ($data as $val)
        {
            $nArr[$val['id']] = $val['name'];
        }
        return $nArr;
    }

    /**
     * 订单详情
     * @adminMenu(
     *     'name'   => '订单详情',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '订单详情',
     *     'param'  => ''
     * )
     */
    public function orderDetail($order_id)
    {
        $data = $this->alias('a')
            ->join('__REST__ b','a.table_id=b.id')
            ->join('__SELLER_TABLE__ c','b.table_id=c.id')
            ->join('__FOOD_MENU__ d','b.menu_id=d.id')
            ->join('__SELLER__ e','e.id=a.seller_id')
            ->field('a.*,c.table_name,b.tb_id,d.name,e.seller_nickname,e.seller_logo')
            ->where(["a.order_id" => $order_id])
            ->find();

        $data = json_decode(json_encode($data),true);
        return $data;
    }

    /**
     * 排列食物详情
     * @adminMenu(
     *     'name'   => '排列食物详情',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '排列食物详情',
     *     'param'  => ''
     * )
     */
    public function takeFood($oldFood)
    {
        $oldFood = explode(";", $oldFood);
        $inarr = array();
        array_pop($oldFood);
        //排列数据
        foreach ($oldFood as $k => $u) {
            $strarr = explode("*", $u);
            foreach ($strarr as $key => $newstr) {
                if ($key == 0) {
                    $food[$k]['id'] = $newstr;
                    $inarr[] = $newstr;
                } else {
                    $food[$k]['nub'] = $newstr;
                }
            }
        }
        $sql['id'] = array('in', $inarr);


        $data = $this
            ->field('id,food_name,price')
            ->name('seller_menu')
            ->where($sql)
            ->select();

        //匹配一对一的数据
        $new  = array();
        foreach ($data as $kay=>$val){
            foreach ($food as $k=>$v){
                if($v['id']==$val['id']){
                    $new[$v['id']]['food_name'] = $val['food_name'];
                    $new[$v['id']]['price'] = $val['price'];
                    break;
                }
            }
        }

        return array(
            'data' => $new,
            'food' => $food,
        );
    }
}