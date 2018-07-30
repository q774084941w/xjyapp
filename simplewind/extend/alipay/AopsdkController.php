<?php
namespace alipay;
// +----------------------------------------------------------------------
// | XjyApplet [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright © 2016-2026 AII Rights Reserved  http://www.ccapp.com.cn/
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +---------------------------------------------------------------------
// | Author: 小谢 < 774084941@qq.com>
// +----------------------------------------------------------------------
require EXTEND_PATH.'alipay/AopSdk.php';
class AopsdkController
{
    /**
     *  单笔转账到支付宝账户接口
     * @param $out_biz 商户转账唯一订单号
     * @param $payee_account 收款方账户
     * @param $amount  转账金额，单位：元
     * @param $payer_show_name  付款方姓名
     * @param $payee_real_name  收款方真实姓名
     * @param $remark  转账备注
     * @param $payee_type  收款方账户类型  1、ALIPAY_USERID：支付宝账号对应的支付宝唯一用户号。以2088开头的16位纯数字组成。2、ALIPAY_LOGONID：支付宝登录号，支持邮箱和手机号格式。
     */
    public function aopSDK($out_biz,$payee_account,$amount,$payer_show_name,$payee_real_name,$remark='',$payee_type='ALIPAY_LOGONID'){
       /* $c = new \AopClient;
        $c->gatewayUrl = "https://openapi.alipaydev.com/gateway.do";
        $c->appId = "2016091500519940";
        $c->rsaPrivateKey = file_get_contents(EXTEND_PATH.'keyFile/privateKey.txt') ;
        $c->format = "json";
        $c->charset = "UTF-8";
        $c->signType= "RSA2";
        $c->alipayrsaPublicKey = file_get_contents(EXTEND_PATH.'keyFile/publicKey.txt');
## 实例化具体API对应的request类,类名称和接口名称对应,当前调用接口名称：alipay.open.public.template.message.industry.modify
        $request = new \AlipayFundTransToaccountTransferRequest();
//SDK已经封装掉了公共参数，这里只需要传入业务参数
//此次只是参数展示，未进行字符串转义，实际情况下请转义
        $request->setBizContent ("{" .

            "    \"out_biz_no\":\"$out_biz\"," .

            "    \"payee_type\":\"$payee_type\"," .
            "    \"payee_account\":\"$payee_account\"," .
            "    \"amount\":\"$amount\"" .
            "    \"payer_show_name\":\"$payer_show_name\"" .
            "    \"payee_real_name\":\"$payee_real_name\"" .
            "    \"remark\":\"$remark\"" .
            "  }") ;

//ISV代理商户调用需要传入app_auth_token

        $response= $c->execute($request);
        $responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
        $resultCode = $response->$responseNode->code;
        var_dump($request);*/
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
        $request = new \AlipayFundTransToaccountTransferRequest ();
        $request->setBizContent("{" .
            "\"out_biz_no\":\"{$out_biz}\"," .
            "\"payee_type\":\"{$payee_type}\"," .
            "\"payee_account\":\"{$payee_account}\"," .
            "\"amount\":\"{$amount}\"," .
            "\"payer_show_name\":\"{$payer_show_name}\"," .
            "\"payee_real_name\":\"{$payee_real_name}\"," .
            "\"remark\":\"{$remark}\"" .
            "}");
        $result = $aop->execute ($request);

        $responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
        $resultCode = $result->$responseNode->code;
        if(!empty($resultCode)&&$resultCode == 10000){
            //并且记录 流水等等
            return true;
        } else {
            //$result->$responseNode->sub_msg 这个参数 是返回的错误信息
           /* throw new Exception($result->$responseNode->sub_msg);*/

           return $result->$responseNode->sub_msg ;
        }
    }

}