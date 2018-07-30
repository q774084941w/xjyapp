<?php
namespace WxpayAPI\example;

// +----------------------------------------------------------------------
// | XjyApplet [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright © 2016-2026 AII Rights Reserved  http://www.ccapp.com.cn/
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +---------------------------------------------------------------------
// | Author: 小谢 < 774084941@qq.com>
// +----------------------------------------------------------------------
ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);

require_once EXTEND_PATH."WxpayAPI/lib/WxPay.Api.php";
require_once EXTEND_PATH."WxpayAPI/lib/WxPay.Config.php";
require_once EXTEND_PATH."WxpayAPI/lib/WxPay.Data.php";
require_once EXTEND_PATH."WxpayAPI/lib/WxPay.Exception.php";
require_once EXTEND_PATH.'WxpayAPI/lib/WxPay.Notify.php';
require_once EXTEND_PATH.'WxpayAPI/example/log.php';
require_once EXTEND_PATH.'WxpayAPI/example/WxPay.JsApiPay.php';
require_once EXTEND_PATH.'WxpayAPI/example/WxPay.MicroPay.php';

//初始化日志
$logHandler= new \CLogFileHandler("../logs/".date('Y-m-d').'.log');
$logCalss = new \Log();
$log = $logCalss->Init($logHandler, 15);

class NativeNotifyCallBack 
{
    /**
     * @param $openId  \用户openID
     * @param $product_id  \此id为二维码中包含的商品ID，商户自行定义
     * @param $trade_type  \支付类型：微信支付JSAPI ，扫码支付NATIVE，APP支付
     * @param string $notify_url  \设置接收微信支付异步通知回调地址
     * @param string $goods_tag  \代金券或立减优惠
     * @param int $total_fee  \支付金额,单位:分
     * @param string $attach \用于商户携带订单的自定义数据
     * @param $body \设置商品或支付单简要描述
     * @return \成功时返回设置的值
     */
	public function unifiedorder($openId, $product_id, $trade_type, $notify_url = '',$goods_tag = '', $total_fee = 0, $attach = '', $body)
	{
		//统一下单
		$logCalss = new \Log();
		$WxPayConfig = new \WxPayConfig();
		$WxPayApi = new \WxPayApi();
		$input = new \WxPayUnifiedOrder();
		$input->SetBody($body);
		$input->SetAttach($attach);
		$input->SetOut_trade_no($WxPayConfig::MCHID.date("YmdHis"));
		$input->SetTotal_fee($total_fee);
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetGoods_tag($goods_tag);
		$input->SetNotify_url($notify_url);
		$input->SetTrade_type($trade_type);
		$input->SetOpenid($openId);
		$input->SetProduct_id($product_id);
		$result = $WxPayApi::unifiedOrder($input);
		$logCalss->DEBUG("unifiedorder:" . json_encode($result));
		return $result;
	}
	
	public function NotifyProcess($data, &$msg)
	{
		$logCalss = new \Log();
		//echo "处理回调";
		$logCalss->DEBUG("call back:" . json_encode($data));
		
		if(!array_key_exists("openid", $data) ||
			!array_key_exists("product_id", $data))
		{
			$msg = "回调数据异常";
			return false;
		}
		 
		$openid = $data["openid"];
		$product_id = $data["product_id"];
		
		//统一下单
		$result = $this->unifiedorder($openid, $product_id);
		if(!array_key_exists("appid", $result) ||
			 !array_key_exists("mch_id", $result) ||
			 !array_key_exists("prepay_id", $result))
		{
		 	$msg = "统一下单失败";
		 	return false;
		 }
		
		$this->SetData("appid", $result["appid"]);
		$this->SetData("mch_id", $result["mch_id"]);
		$this->SetData("nonce_str", WxPayApi::getNonceStr());
		$this->SetData("prepay_id", $result["prepay_id"]);
		$this->SetData("result_code", "SUCCESS");
		$this->SetData("err_code_des", "OK");
		return true;
	}


    /**
     * 微信扫码支付
     * @param string $goods_tag  代金券或立减优惠
     * @param $total_fee  支付金额,单位:分
     * @param string $attach  用于商户携带订单的自定义数据
     * @param $body  设置商品或支付单简要描述
     * @param $auth_code 授权号码
     * @return \返回查询接口的结果
     */
	public function NATIVE($goods_tag = '', $total_fee, $attach = '', $body,$auth_code){
        $WxPayConfig = new \WxPayConfig();
        $MicroPay = new \MicroPay();
        $logCalss = new \Log();
        $input = new \WxPayMicroPay();
        $input->SetBody($body);
        $input->SetAttach($attach);
        $input->SetOut_trade_no($WxPayConfig::MCHID.date("YmdHis"));
        $input->SetTotal_fee($total_fee);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag($goods_tag);
        $input->SetAuth_code($auth_code);
        $result = $MicroPay->pay($input);
        $logCalss->DEBUG("unifiedorder:" . json_encode($result));
        return $result;
    }


}
