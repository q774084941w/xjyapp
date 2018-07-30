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

class SellerMenuModel extends Model
{

    /**
     * 筛选菜品
     * @adminMenu(
     *     'name'   => '筛选菜品',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '筛选菜品',
     *     'param'  => ''
     * )
     */
    public function findThem($where){
        $data = $this
            ->field('a.id,a.food_name,a.price,a.food_class')
            ->alias('a')
            ->join('__FOOD_MENU__ b','a.food_class=b.id')
            ->where($where)
            ->select();
        $data = json_decode(json_encode($data),true);
        return $data;
    }
}