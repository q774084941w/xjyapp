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

class RestModel extends Model
{

    /**
     * 统计餐桌信息
     * @param $keywordComplex
     * @param $where
     * @return false|mixed|\PDOStatement|string|\think\Collection
     */
    public function cuntAll($keywordComplex,$where){
        $table_type = $this->alias('a')
            ->field('count(*) as number,type')
            ->where('a.delete_time',0)
            ->whereOr($keywordComplex)
            ->where($where)
            ->group('type')
            ->order('type')
            ->select();
        $table_type = json_decode(json_encode($table_type),true);
        return $table_type;
    }

    /**
     * 当前餐桌的简单信息
     * @param $id
     * @return array|false|mixed|\PDOStatement|string|Model
     */
    public function witchOne($id){
        $data = $this->alias('a')
            ->field('a.id,a.tb_id,c.name,b.table_name')
            ->join('__SELLER_TABLE__ b','a.table_id=b.id')
            ->join('__FOOD_MENU__ c','a.menu_id=c.id')
            ->where('a.delete_time',0)
            ->where('a.id',$id)
            ->find();

        $data = json_decode(json_encode($data),true);
        return $data;
    }


    /**
     * 更改订单id
     * @param $id
     * @param $order_id
     */
    public function insertOrderId($id,$order_id){
        $this->where('id',$id)->update(array('order_id'=>$order_id,'type'=>3));
    }

    /**
     * 查找对应的餐桌号
     * @param $id
     * @param $order_id
     */
    public function findThem($where){
        $data = $this->alias('a')
                    ->field('a.id,a.tb_id,c.name,b.table_name')
                    ->join('__SELLER_TABLE__ b','a.table_id=b.id')
                    ->join('__FOOD_MENU__ c','a.menu_id=c.id')
                    ->where('a.delete_time',0)
                    ->where('a.type',1)
                    ->where($where)
                    ->select();
        $data = json_decode(json_encode($data),true);
        return $data;
    }

}