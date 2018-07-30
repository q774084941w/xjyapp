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

class OrderValidate extends Validate
{
    protected $rule = [
        'seller_id'      => 'require',
        'user_id'      => 'require',
    ];

    protected $message = [
        'seller_id.require'      => '商家ID不能为空',
        'user_id.require'      => '用户ID不能为空',
    ];

}