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

class FoodMenuValidate extends Validate
{
    protected $rule = [
        'food_class'      => 'require',
        'food_name'      => 'require',
        'price'      => 'require|number',
    ];

    protected $message = [
        'food_class.require'      => '菜品类型不能为空',
        'food_name.require'      => '菜品名字不能为空',
        'price.require'      => '菜品价格不能为空',
        'price.number'      => '菜品价格填写错误',

    ];

}