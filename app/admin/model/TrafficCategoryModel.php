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

class TrafficCategoryModel extends Model
{

    /**
     * 分类列表
     * @adminMenu(
     *     'name'   => '分类列表',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '分类列表',
     *     'param'  => ''
     * )
     */
    public function index($type=0){
        if(session('admin_parent_id') == 1)
        {
            $user_id = session('ADMIN_ID');
        }else
        {
            $user_id = session('admin_parent_id');
        }
        $data = $this->field('id,name')
            ->where('type',$type)
            ->where('status',1)
            ->where('parent_id','neq',0)
            ->where('delete_time',0)
            ->where('seller_id',$user_id)
            ->select();
        $data = json_decode(json_encode($data),true);
        return $data;
    }

    /**
     * 获取所有父id
     * @adminMenu(
     *     'name'   => '获取所有父id',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '获取所有父id',
     *     'param'  => ''
     * )
     */
    public function parent_id($parent_id = 0){
        if(session('admin_parent_id') == 1)
        {
            $user_id = session('ADMIN_ID');
        }else
        {
            $user_id = session('admin_parent_id');
        }
        $data = $this->field('id,name')
            ->where('status',1)
            ->where('parent_id','eq',$parent_id)
            ->where('delete_time',0)
            ->where('seller_id',$user_id)
            ->select();
        $data = json_decode(json_encode($data),true);
        return $data;
    }
}