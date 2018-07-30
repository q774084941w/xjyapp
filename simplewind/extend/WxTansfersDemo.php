<?php

include 'WxTransfers.Api.php';  


		
		$path = WxTransfersConfig::getRealPath(); // 证书文件路径
		$config['wxappid'] = WxTransfersConfig::APPID;
		$config['mch_id'] = WxTransfersConfig::MCHID;
		$config['key'] = WxTransfersConfig::KEY;
		$config['PARTNERKEY'] = WxTransfersConfig::KEY;
		$config['api_cert'] = $path . WxTransfersConfig::SSLCERT_PATH;
		$config['api_key'] = $path . WxTransfersConfig::SSLKEY_PATH;
		$config['rootca'] = $path . WxTransfersConfig::SSLROOTCA;
		
		$wxtran=new WxTransfers($config);
		
		// $wxtran->setLogFile('D:\\transfers.log');//日志地址
		
		//转账
		$data=array(
			'openid'=>'oKKb00KIIZt7e5ZMWWokcqq6y5jc',//openid
			'check_name'=>'NO_CHECK',//是否验证真实姓名参数
			're_user_name'=>'11',//姓名
			'amount'=>100,//最小1元 也就是100
			'desc'=>'企业转账测试',//描述
			'spbill_create_ip'=>$wxtran->getServerIp(),//服务器IP地址
		);

		// var_dump($wxtran->transfers($data));
		// print_r($wxtran->transfers($data));
		var_dump(json_encode($wxtran->transfers($data),JSON_UNESCAPED_UNICODE));
		var_dump($wxtran->error);

		//获取转账信息
		// var_dump($wxtran->getInfo('11111111'));
		// var_dump($wxtran->error);
	

