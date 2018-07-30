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

class TrafficReportValidate extends Validate
{
    protected $rule = [
        'tra_id'          => 'require|number',
        'user_name'       => 'require',
        'user_id'         => 'require|number',
        'reason'          => 'require',
        'tra_num'         => 'require|number',
    ];
    protected $message = [
        'tra_id.require'         => '货物不能为空',
        'tra_id.number'          => '货物格式错误',
        'user_name.require'      => '报损人不能为空',
        'user_id.require'        => '报损人不能为空',
        'user_id.number'         => '报损人格式错误',
        'reason.require'         => '报损原因不能为空',
        'tra_num.require'        => '数量不能为空',
        'tra_num.number'         => '数量格式错误',
    ];

    protected $scene = [
        'add'  => ['tra_id',  'reason', 'tra_num'],
        'add2'  => ['tra_id',  'reason', 'tra_num'],
    ];

}