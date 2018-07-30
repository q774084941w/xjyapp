<?php
namespace Barpay\f2fpay;
// +----------------------------------------------------------------------
// | XjyApplet [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright © 2016-2026 AII Rights Reserved  http://www.ccapp.com.cn/
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +---------------------------------------------------------------------
// | Author: 小谢 < 774084941@qq.com>
// +----------------------------------------------------------------------
require_once EXTEND_PATH.'Barpay/f2fpay/model/builder/GoodsDetail.php';
require_once EXTEND_PATH.'Barpay/f2fpay/model/builder/ExtendParams.php';
require_once EXTEND_PATH.'Barpay/f2fpay/model/builder/RoyaltyDetailInfo.php';
require_once EXTEND_PATH.'Barpay/f2fpay/model/builder/ContentBuilder.php';
require_once EXTEND_PATH.'Barpay/f2fpay/model/builder/AlipayTradePayContentBuilder.php';

require_once EXTEND_PATH.'Barpay/f2fpay/service/AlipayTradeService.php';

class Barpay
{
    /**
     * @param $outTradeNo 商户网站订单系统中唯一订单号，64个字符以内，只能包含字母、数字、下划线，$outTradeNo = "barpay" . date('Ymdhis') . mt_rand(100, 1000);
     * @param $totalAmount  订单总金额，单位为元，不能超过1亿元
     * @param $authCode  付款条码，用户支付宝钱包手机app点击“付款”产生的付款条码
     * @param $subject  订单标题，粗略描述用户的支付目的。如“XX品牌XXX门店消费”
     * @param $body  订单描述，可以对交易或商品进行一个详细地描述，比如填写"购买商品2件共15.00元"
     * @param $operatorId 商户操作员编号，添加此参数可以为商户操作员做销售统计
     * @param $alipayStoreId 支付宝的店铺编号
     * @param $appAuthToken 第三方应用授权令牌,商户授权系统商开发模式下使用
     * @param string $providerId 系统商pid,作为系统商返佣数据提取的依据
     * @param string $timeExpress  支付超时，线下扫码交易定义为5分钟
     * @param string $undiscountableAmount  订单不可打折金额，可以配合商家平台配置折扣活动，如果酒水不参与打折，则将对应金额填写至此字段 (可选)
     * @param array $goodsDetailList  商品明细列表，需填写购买商品详细信息，
     * @param string $storeId 商户门店编号，通过门店号和商家后台可以配置精准到门店的折扣信息，详询支付宝技术支持
     */
    public function barPay($outTradeNo,$totalAmount,$authCode,$subject,$body,$operatorId,$alipayStoreId,$appAuthToken,$providerId='',$timeExpress = "5m",$undiscountableAmount = "0",$goodsDetailList = array(),$storeId = "")
    {
        // 业务扩展参数，目前可添加由支付宝分配的系统商编号(通过setSysServiceProviderId方法)，详情请咨询支付宝技术支持
        $extendParams = new \ExtendParams();
        $extendParams->setSysServiceProviderId($providerId);
        $extendParamsArr = $extendParams->getExtendParams();

        $barPayRequestBuilder = new \AlipayTradePayContentBuilder();
        $barPayRequestBuilder->setOutTradeNo($outTradeNo);
        $barPayRequestBuilder->setTotalAmount($totalAmount);
        $barPayRequestBuilder->setAuthCode($authCode);
        $barPayRequestBuilder->setTimeExpress($timeExpress);
        $barPayRequestBuilder->setSubject($subject);
        $barPayRequestBuilder->setBody($body);
        $barPayRequestBuilder->setUndiscountableAmount($undiscountableAmount);
        $barPayRequestBuilder->setExtendParams($extendParamsArr);
        $barPayRequestBuilder->setGoodsDetailList($goodsDetailList);
        $barPayRequestBuilder->setStoreId($storeId);
        $barPayRequestBuilder->setOperatorId($operatorId);
        $barPayRequestBuilder->setAlipayStoreId($alipayStoreId);

        $barPayRequestBuilder->setAppAuthToken($appAuthToken);
        $config = require EXTEND_PATH.'Barpay/f2fpay/config/config.php';
        // 调用barPay方法获取当面付应答
        $barPay = new \AlipayTradeService($config);
        $barPayResult = $barPay->barPay($barPayRequestBuilder);

        switch ($barPayResult->getTradeStatus()) {
            case "SUCCESS":
                //echo "支付宝支付成功:" . "<br>--------------------------<br>";
                //print_r($barPayResult->getResponse());
                return array('code'=>1000,'sub_msg'=>"支付宝支付成功!!!",'data'=>$barPayResult->getResponse());
                break;
            case "FAILED":
                //echo "支付宝支付失败!!!" . "<br>--------------------------<br>";
                return array('code'=>9999,'sub_msg'=>"支付宝支付失败!!!",'data'=>$barPayResult->getResponse());
                break;
            case "UNKNOWN":
                //echo "系统异常，订单状态未知!!!" . "<br>--------------------------<br>";
              /*  if (!empty($barPayResult->getResponse())) {
                    //print_r($barPayResult->getResponse());
                    return $barPayResult->getResponse();
                }*/
                return array('code'=>9999,'sub_msg'=>"系统异常，订单状态未知!!!",'data'=>$barPayResult->getResponse());
                break;
            default:
                return array('code'=>9999,'sub_msg'=>"不支持的交易状态，交易返回异常!!!");
                break;
        }
    }
}