<?php
namespace phonepay;
// +----------------------------------------------------------------------
// | XjyApplet [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright © 2016-2026 AII Rights Reserved  http://www.ccapp.com.cn/
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +---------------------------------------------------------------------
// | Author: 小谢 < 774084941@qq.com>
// +----------------------------------------------------------------------
require EXTEND_PATH.'phonepay\AopSdk.php';
class PhoneController
{
    protected static $result;
    /**
     *  手机网站支付接口2.0
     * @param $subject 商品的标题/交易标题/订单标题/订单关键字等。
     * @param $out_trade_no 商户网站唯一订单号
     * @param $total_amount  订单总金额，单位为元，精确到小数点后两位，取值范围[0.01,100000000]
     * @param $seller_id  收款支付宝用户ID。 如果该值为空，则默认为商户签约账号对应的支付宝用户ID
     * @param $quit_url  用户付款中途退出返回商户网站的地址
     * @param $product_code  销售产品码，商家和支付宝签约的产品码
     * @param string $body  对一笔交易的具体描述信息
     * @param string $auth_token 针对用户授权接口，获取用户相关数据时，用于标识用户授权关系
     * @param string $timeout_express  该笔订单允许的最晚付款时间
     * @param string $time_expire  绝对超时时间，格式为yyyy-MM-dd HH:mm。
     * @param int $goods_type 商品主类型 :0-虚拟类商品,1-实物类商品
     * @param string $passback_params  公用回传参数，如果请求时传递了该参数，则返回给商户时会回传该参数
     * @param string $promo_params 优惠参数
     * @param string $specified_channel 指定渠道，目前仅支持传入pcredit
     * @param string $business_params  商户传入业务信息
     */
    public function phone($subject,$out_trade_no,$total_amount,$quit_url,$product_code,$seller_id = '',$body='',$auth_token='',$timeout_express='90m',$time_expire='',$goods_type=1,$passback_params='',$promo_params='',$specified_channel='pcredit',$business_params=''){
        $config = require EXTEND_PATH.'Barpay/f2fpay/config/config.php';
        $aop = new \AopClient ();
        $aop->gatewayUrl = $config['gatewayUrl'];
        $aop->appId =$config['app_id'];
//        $aop->rsaPrivateKeyFilePath = EXTEND_PATH.'keyFile/privateKey.txt';
        $aop->rsaPrivateKey = $config['merchant_private_key'];
        $aop->alipayrsaPublicKey= $config['alipay_public_key'];
        $aop->apiVersion    =  '1.0';
        $aop->signType      =  $config['sign_type'];
        $aop->postCharset   =  $config['charset'];
        $aop->format='json';
        $request = new \AlipayTradeWapPayRequest();
        $request->setBizContent("{" .
            "\"body\":\"{$body}\"," .
            "\"subject\":\"{$subject}\"," .
            "\"out_trade_no\":\"{$out_trade_no}\"," .    //70501111111S001111119  商户网站唯一订单号
            "\"timeout_express\":\"{$timeout_express}\"," .   //90m  该笔订单允许的最晚付款时间 可选
            "\"time_expire\":\"{$time_expire}\"," .   //2016-12-31 10:05  绝对超时时间 	可选
            "\"total_amount\":{$total_amount}," .   //9.00  订单总金额
            "\"seller_id\":\"{$seller_id}\"," .  //2088102147948060   收款支付宝用户ID
            "\"auth_token\":\"{$auth_token}\"," .  //appopenBb64d181d0146481ab6a762c00714cC27  针对用户授权接口  可选
            "\"goods_type\":\"{$goods_type}\"," .  //0  商品主类型 :0-虚拟类商品,1-实物类商品  可选
            "\"passback_params\":\"{$passback_params}\"," .  //merchantBizType%3d3C%26merchantBizNo%3d2016010101111  公用回传参数  可选
            "\"quit_url\":\"{$quit_url}\"," .  //http://www.taobao.com/product/113714.html  用户付款中途退出返回商户网站的地址
            "\"product_code\":\"{$product_code}\"," .   //QUICK_WAP_WAY   销售产品码，商家和支付宝签约的产品码
            "\"promo_params\":\"{$promo_params}\"," .  //{\\\"storeIdType\\\":\\\"1\\\"}  优惠参数   可选

            /*描述分账信息，json格式*/
             /* "\"royalty_info\":{" .     //  可选
              "\"royalty_type\":\"\"," .
              "        \"royalty_detail_infos\":[{" .
              "          \"serial_no\":1," .
              "\"trans_in_type\":\"userId\"," .
              "\"batch_no\":\"123\"," .
              "\"out_relation_id\":\"20131124001\"," .
              "\"trans_out_type\":\"userId\"," .
              "\"trans_out\":\"2088101126765726\"," .
              "\"trans_in\":\"2088101126708402\"," .
              "\"amount\":0.1," .
              "\"desc\":\"分账测试1\"," .
              "\"amount_percentage\":\"100\"" .
              "          }]" .
              "    }," .*/

            /* "\"extend_params\":{" .
             "\"sys_service_provider_id\":\"2088511833207846\"," .
             "\"hb_fq_num\":\"3\"," .
             "\"hb_fq_seller_percent\":\"100\"," .
             "\"industry_reflux_info\":\"{\\\\\\\"scene_code\\\\\\\":\\\\\\\"metro_tradeorder\\\\\\\",\\\\\\\"channel\\\\\\\":\\\\\\\"xxxx\\\\\\\",\\\\\\\"scene_data\\\\\\\":{\\\\\\\"asset_name\\\\\\\":\\\\\\\"ALIPAY\\\\\\\"}}\"," .
             "\"card_type\":\"S0JP0000\"" .
             "    }," .*/
            /*间连受理商户信息体，当前只对特殊银行机构特定场景下使用此字段*/
          /*  "\"sub_merchant\":{" .
            "\"merchant_id\":\"19023454\"," .
            "\"merchant_type\":\"alipay: 支付宝分配的间连商户编号, merchant: 商户端的间连商户编号\"" .
            "    }," .
            "\"enable_pay_channels\":\"pcredit,moneyFund,debitCardExpress\"," .
            "\"disable_pay_channels\":\"pcredit,moneyFund,debitCardExpress\"," .
            "\"store_id\":\"NJ_001\"," .
            "\"settle_info\":{" .
            "        \"settle_detail_infos\":[{" .
            "          \"trans_in_type\":\"cardSerialNo\"," .
            "\"trans_in\":\"A0001\"," .
            "\"summary_dimension\":\"A0001\"," .
            "\"amount\":0.1" .
            "          }]" .
            "    }," .*/
            /* 开票信息*/
             /*"\"invoice_info\":{" .
             "\"key_info\":{" .
             "\"is_support_invoice\":true," .
             "\"invoice_merchant_name\":\"ABC|003\"," .
             "\"tax_num\":\"1464888883494\"" .
             "      }," .
             "\"details\":\"[{\\\"code\\\":\\\"100294400\\\",\\\"name\\\":\\\"服饰\\\",\\\"num\\\":\\\"2\\\",\\\"sumPrice\\\":\\\"200.00\\\",\\\"taxRate\\\":\\\"6%\\\"}]\"" .
             "    }," .*/
            "\"specified_channel\":\"{$specified_channel}\"," .   //指定渠道目前仅支持传入pcredit 可选
            "\"business_params\":\"{$business_params}\"," .  //商户传入业务信息 可选

            /* 外部指定买家*/
              /*"\"ext_user_info\":{" .
              "\"name\":\"李明\"," .
              "\"mobile\":\"16587658765\"," .
              "\"cert_type\":\"IDENTITY_CARD\"," .
              "\"cert_no\":\"362334768769238881\"," .
              "\"min_age\":\"18\"," .
              "\"fix_buyer\":\"F\"," .
              "\"need_check_info\":\"F\"" .
              "    }" .*/
            "  }");
        $result = $aop->pageExecute ($request);

        $responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
        $resultCode = $result->$responseNode->code;
        if(!empty($resultCode)&&$resultCode == 10000){
            return true;
        } else {
            return false;
        }
    }

}