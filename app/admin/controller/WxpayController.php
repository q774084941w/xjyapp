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

namespace app\admin\controller;


use cmf\controller\BaseController;
use think\Loader;
use WxpayAPI\example\NativeNotifyCallBack;

class WxpayController extends BaseController
{

    public function index(){

        $wxpay      = new NativeNotifyCallBack();
        $openId   ;//用户openID
        $product_id = 2018040916102110052535;//此id为二维码中包含的商品ID，商户自行定义
        $trade_type ; //支付类型：微信支付JSAPI ，扫码支付NATIVE，APP支付
        $notify_url;//设置接收微信支付异步通知回调地址
        $goods_tag;//代金券或立减优惠
        $total_fee;//支付金额,单位:分
        $attach;//用于商户携带订单的自定义数据
        $body;//设置商品或支付单简要描述

        $wxpay ->unifiedorder($openId, $product_id, $trade_type, $notify_url = '',$goods_tag = '', $total_fee = 0, $attach = '', $body);
    }
}