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

class UserModel extends Model
{
    /**
     * 寻找该id的称呼
     * @adminMenu(
     *     'name'   => '寻找该id的称呼',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '寻找该id的称呼',
     *     'param'  => ''
     * )
     */
    public function myName($id){
        $data = $this
            ->where('id',$id)
            ->field('user_nickname,user_login')
            ->find();
        $data = json_decode(json_encode($data),true);
        return $data;
    }

}