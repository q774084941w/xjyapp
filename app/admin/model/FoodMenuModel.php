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

class FoodMenuModel extends Model
{
    /**
     * 获取一级分类
     * @adminMenu(
     *     'name'   => '获取一级分类',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '获取一级分类',
     *     'param'  => ''
     * )
     */
    public function index($parent_id=0){
        if(session('admin_parent_id') == 1)
        {
            $user_id = session('ADMIN_ID');
        }else
        {
            $user_id = session('admin_parent_id');
        }
        $data = $this
            ->field('id,name')
            ->where('seller_id',$user_id)
            ->where('parent_id',$parent_id)
            ->select();
        $data = json_decode(json_encode($data),true);
        return $data;
    }

}