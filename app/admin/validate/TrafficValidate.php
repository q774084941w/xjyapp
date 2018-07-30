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

class TrafficValidate extends Validate
{
    protected $rule = [
        'add_time'          => 'require|number',
        'seller_id'         => 'require',
        'name'              => 'require',
        'pinyin'            => 'require',
        'stock'             => 'require|number',
        'buy_price'         => 'require',
        'ret_price'         => 'require',
        'brand'             => 'require',
    ];
    protected $message = [
        'add_time.require'       => '时间不能为空',
        'add_time.number'        => '时间格式错误',
        'seller_id.require'      => '不能为空',
        'name.require'           => '货品名称不能为空',
        'pinyin.require'         => '拼音码不能为空',
        'stock.require'          => '数量不能为空',
        'stock.number'           => '数量格式错误',
        'buy_price.require'      => '进价不能为空',
        'ret_price.require'      => '出售价不能为空',
        'brand.require'          => '品牌不能为空',
    ];

    protected $scene = [
        'purchase'  => ['add_time', 'seller_id', 'name', 'stock', 'buy_price'],
        'apply'     => ['add_time', 'seller_id', 'name', 'pinyin', 'stock', 'buy_price','ret_price','brand'],

    ];
}