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

class TrafficInventoryModel extends Model
{

    /**
     * 盘点总表数据添加
     * @adminMenu(
     *     'name'   => '盘点总表数据添加',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '盘点总表数据添加',
     *     'param'  => ''
     * )
     */
    public function thisInsert($number,$profit=0,$deficit=0){
        if(session('admin_parent_id') == 1)
        {
            $user_id = session('ADMIN_ID');
        }else
        {
            $user_id = session('admin_parent_id');
        }
        $type = 1;
        if($profit == 0 && $deficit==0){
            $type = 2;
        }
        $arr =  array(
            'seller_id'     => $user_id,
            'inven_number'  => $number,
            'user_id'       => session('ADMIN_ID'),
            'time'          => time(),
            'inven_type'    => $type,
            'profit'        => $profit,
            'deficit'       => $deficit,
        );
        return $this->insert($arr);
    }


    /**
     * 获取总表数据
     * @adminMenu(
     *     'name'   => '获取总表数据',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '获取总表数据',
     *     'param'  => ''
     * )
     */
    public function index($in,$where,$whereTime)
    {
        if(!empty($in))
        {
            $this->where('a.type',$in);
        }
        $data = $this
            ->alias('a')
            ->field('a.*,b.user_nickname,b.user_login')
            ->join('__USER__ b','a.user_id=b.id')
            ->where($where)
            ->whereTime('a.time','eq',$whereTime)
            ->select();

        $data = json_decode(json_encode($data),true);
        return $data;
    }


    /**
     * 获取详情信息
     * @adminMenu(
     *     'name'   => '获取详情信息',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '获取详情信息',
     *     'param'  => ''
     * )
     */
    public function details($inven_number)
    {
        $arr = array();

        $data = $this -> alias('a')
            ->field('a.*,b.user_nickname,b.user_login')
            ->join('__USER__ b','a.user_id=b.id')
            ->where('a.inven_number',$inven_number)
            ->find();
        $arr['all'] = json_decode(json_encode($data),true);


        $data = $this->name('traffic_inventory_more')
            ->field('a.*,b.name,b.buy_price,b.traffic_number')
            ->alias('a')
            ->join('__TRAFFIC__ b','a.tra_id=b.tra_id')
            ->where('a.inven_number',$inven_number)
            ->select();
        $arr['more'] = json_decode(json_encode($data),true);
        return $arr;
    }


    /**
     * 盘点作废
     * @adminMenu(
     *     'name'   => '盘点作废',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '盘点作废',
     *     'param'  => ''
     * )
     */
    public function changeType($id){
        return $this
            ->where('inven_id',$id)
            ->update(array('type'=>2));
    }

}