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

namespace app\user\validate;


use think\Validate;

class WaiterValidate extends Validate
{
    protected $rule = [
        'user' => 'require|max:15',
        'pass' => 'require|max:20',
        'appid' => 'require',
    ];
    protected $message = [
        'user.require' => '用户名不能为空',
        'user.max:15'  => '用户名超长',
        'pass.require' => '密码不能为空',
        'appid.require' => 'appid为空',
        'pass.max:18'  => '密码超长',
    ];

   /* protected $scene = [
        'add'  => ['post_title'],
        'edit' => ['post_title'],
    ];*/
}