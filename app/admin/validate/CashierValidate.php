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

namespace app\admin\validate;


use think\Validate;

class CashierValidate extends Validate
{
    protected $rule = [
        'order_id'       => 'require',
        'pay_class'      => 'require',
        'order_price'    => 'require',
        'discount'       => 'require|number',
        'to_password'    => 'require|number',
    ];

    protected $message = [
        'order_id.require'      => '订单号不能为空',
        'pay_class.require'     => '支付方式不能为空',
        'order_price.require'   => '菜品价格不能为空',
        'discount.require'      => '折扣不能为空',
        'discount.number'       => '折扣格式错误',
        'to_password.require'   => '密码验证不能为空',
        'to_password.number'    => '验证失败',
    ];

    protected $scene = [
        'no_pass'   => ['order_id','pay_class','order_price'],
        'have_pass' => ['discount','to_password'],
    ];

}