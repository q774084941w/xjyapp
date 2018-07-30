<?php
// +----------------------------------------------------------------------
// | XjyApplet [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright © 2016-2026 AII Rights Reserved  http://www.ccapp.com.cn/
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +---------------------------------------------------------------------
// | Author: 小李 < 1017658209@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\validate;

use think\Validate;

class SellerValidate extends Validate
{
    protected $rule = [
        'user_login'         => 'require|unique:user_login',
        'user_pass'          => 'require',
        'user_pass_confirm'  => 'require|confirm:user_pass',
        'seller_nickname'    => 'require',
        'seller_tel'         => 'number|max:11|min:11',
        'takeout_max'        => 'number',
        'appid'              => 'require|unique:seller'
    ];

    protected $message = [
        'user_login.require'        => '登录账号不能为空!',
        'user_login.unique'         => '用户名已存在',
        'user_pass.require'         => '请输入密码!',
        'user_pass_confirm.require' => '请输入确认密码!',
        'user_pass_confirm.confirm' => '两次输入的密码不一致!',
        'seller_nickname.require'   => '商家不能为空',
        'seller_tel.number'         => '手机号码不正确',
        'seller_tel.max'            => '手机号码不正确(不多于11位)',
        'seller_tel.min'            => '手机号码不正确(不少于11位)',
        'takeout_max.number'        => '起送金额不正确',
        'appid.require'             => '商家AppID不能为空!',
        'appid.unique'              => '商家AppID已经存在',
    ];

    protected $scene = [
        'user'      => ['user_login', 'user_pass', 'user_pass_confirm'],
        'post'      => ['seller_nickname', 'seller_tel', 'takeout_max','appid'],
        'password'  =>['user_pass','user_pass_confirm'],
    ];

}