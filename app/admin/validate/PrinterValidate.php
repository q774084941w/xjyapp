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

class PrinterValidate extends Validate
{
    protected $rule = [
        'menu_id'       => 'require',
        'printer_id'    => 'require',
        'remark'        => 'require',
        'type'          => 'require',
        'secret_key'    => 'require',
        'voice'         => 'require',
        'position'      => 'require',
    ];
    protected $message = [
        'menu_id.require'       => '服务厅不能为空',
        'printer_id.require'    => '设备编号不能为空',
        'remark.require'        => '备注不能为空',
        'type.require'          => '状态不能为空',
        'secret_key.require'    => '秘钥不能为空',
        'voice.require'         => '语音不能为空',
        'position.require'      => '位置不能为空',
    ];
}