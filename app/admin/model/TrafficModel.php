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
use think\Validate;

class TrafficModel extends Model
{

    /**
     * 库存报警数据
     * @adminMenu(
     *     'name'   => '库存报警',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '库存报警',
     *     'param'  => ''
     * )
     */
    public function index($request,$type=2){
        $where =array(
            'a.delete_time' =>  0,
            'a.type'        =>  ['neq',9],
            'a.alert_type'  =>  $type
        );
        if(cmf_get_current_admin_id() != 1)
        {
            if(session('admin_parent_id') == 1)
            {
                $where['a.seller_id'] = ['eq',session('ADMIN_ID')];
            }else
            {
                $where['a.seller_id'] = ['eq',session('admin_parent_id')];
            }
        }
        if(!empty($request['keyword'])){
            $ret = Validate::is($request['keyword'],'chs');
            if($ret){
                $where['a.name'] = ['like',"%".$request['keyword']."%"];
            }else{
                $where['a.pinyin'] = ['like',"%".$request['keyword']."%"];
            }
        }
        $data = $this->alias('a')
            ->join('__TRAFFIC_CATEGORY__ b','a.category_id=b.id')
            ->where($where)
            ->field('a.*,b.name as category_name')
            ->select();
        $data = json_decode(json_encode($data),true);
        return $data;
    }


    /**
     * 开关警报
     * @adminMenu(
     *     'name'   => '开关警报',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '开关警报',
     *     'param'  => ''
     * )
     */
    public function openAlert($tra_id,$type=1)
    {
        $data = $this
            ->where('alert_type',$type)
            ->where('tra_id',$tra_id)
            ->field('stock,alert')
            ->find();
        if(empty($data))
        {
            return false;
        }
        switch ($type){
            case 1:
                if($data['stock']<$data['alert'])
                {
                    $arr = array(
                        'alert_type'=>2
                    );
                }
                else
                {
                    return false;
                }
                break;
            default:
                if($data['stock']>=$data['alert'])
                {
                    $arr = array(
                        'alert_type'=>1
                    );
                }
                else
                {
                    return false;
                }
        }
        $this->where('tra_id',$tra_id)->update($arr);
        return true;
    }


    /**
     * 查询商品当前库存
     * @adminMenu(
     *     'name'   => '查询商品当前库存',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '查询商品当前库存',
     *     'param'  => ''
     * )
     */
    public function howMuch($id){
        $data =  $this->name('traffic')
            ->alias('a')
            ->join('__TRAFFIC_CATEGORY__ b','a.category_id=b.id')
            ->where('a.tra_id',$id)
            ->field('a.tra_id,a.name,a.buy_price,a.traffic_number,a.stock,b.name as cateName')
            ->find();
        $data = json_decode(json_encode($data),true);
        return $data;
    }



    /**
     * 储存信息
     * @adminMenu(
     *     'name'   => '储存信息',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '储存信息',
     *     'param'  => ''
     * )
     */
    public function inventoryMore($arr){
        return $this->name('traffic_inventory_more')->insert($arr);
    }


    /**
     * 库存信息筛选
     * @adminMenu(
     *     'name'   => '库存信息筛选',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '库存信息筛选',
     *     'param'  => ''
     * )
     */
    public function findThem($where){
        $data = $this
            ->field('a.tra_id,a.name,b.name as cateName')
            ->alias('a')
            ->join('__TRAFFIC_CATEGORY__ b','a.category_id=b.id')
            ->where($where)
            ->select();
        $data = json_decode(json_encode($data),true);
        return $data;
    }

}