<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace api\wxapp\controller;

use think\Db;
use cmf\controller\RestBaseController;
use wxapp\aes\WXBizDataCrypt;
use think\Validate;

class PublicController extends RestBaseController
{
    // 原微信小程序 现公众号用户登录 TODO 增加最后登录信息记录,如 ip
    public function login()
    {
        $validate = new Validate([
            'code'           => 'require',
            'encrypted_data' => 'require',
            'iv'             => 'require',
            'raw_data'       => 'require',
            'signature'      => 'require',
        ]);

        $validate->message([
            'code.require'           => '缺少参数code!',
            'encrypted_data.require' => '缺少参数encrypted_data!',
            'iv.require'             => '缺少参数iv!',
            'raw_data.require'       => '缺少参数raw_data!',
            'signature.require'      => '缺少参数signature!',
        ]);

        $data = $this->request->param();
        // if (!$validate->check($data)) {
        //     $this->error($validate->getError());
        // }

        if (empty($data['code']) || empty($data['state'])) {
            $this->error('{"code":0,"msg":"缺少参数code!","data":""}');
        }

        //TODO 真实逻辑实现
        $code      = $data['code'];
        $ruteurl   = $data['state'];
        $appId     = 'wx4612824b7c9f43b5';
        $appSecret = '241735856e32ba6fd0d9905dad15710c';

        // $response = cmf_curl_get("https://api.weixin.qq.com/sns/jscode2session?appid=$appId&secret=$appSecret&js_code=$code&grant_type=authorization_code");
        $response = cmf_curl_get("https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appId&secret=$appSecret&code=$code&grant_type=authorization_code");

        $response = json_decode($response, true);
        if (!empty($response['errcode'])) {
            $this->error('操作失败!');
        }

        $openid         = $response['openid'];
        $refresh_token  = $response['refresh_token'];
        $access_token   = $response['access_token'];
        if(!empty($access_token))
        {
            //session('access_token', $access_token);
            //session('refresh_token', $refresh_token);
        }

        // $pc      = new WXBizDataCrypt($appId, $sessionKey);
        // $errCode = $pc->decryptData($data['encrypted_data'], $data['iv'], $wxUserData);

        // if ($errCode != 0) {
        //     $this->error('操作失败!');
        // }
        
        if (empty($openid) || empty($access_token) ) {
            $this->error('操作失败!');
        }

        //获取用户信息 开始
        $UserInfo = cmf_curl_get("https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN");
        $UserInfo = json_decode($UserInfo, true);

        if (!empty($UserInfo['errcode']) ) {
            $this->error('操作失败!');
        }

        if(!empty($UserInfo['nickname']) && !empty($UserInfo['openid']))
        {
            $wxUserData['gender']       = $UserInfo['sex'];
            $wxUserData['nickName']     = $UserInfo['nickname'];
            $wxUserData['avatarUrl']    = $UserInfo['headimgurl'];
            $wxUserData['user_address'] = $UserInfo['province'].$UserInfo['city'];
            $wxUserData['union_id']     = '微信平台';     
        }
        //获取用户信息 结束

        $findThirdPartyUser = Db::name("third_party_user")
            ->where('openid', $openid)
            ->where('app_id', $appId)
            ->find();

        if(!empty($findThirdPartyUser)){
            $result = Db::name('user')->where('id','eq',$findThirdPartyUser['user_id'])->find();
        }else{
            $result = '';
        }

        $currentTime = time();
        $ip          = $this->request->ip(0, true);

        if ($findThirdPartyUser) {
            $token = cmf_generate_user_token($findThirdPartyUser['user_id'], 'wxapp');

            $userData = [
                'last_login_ip'   => $ip,
                'last_login_time' => $currentTime,
                'login_times'     => ['exp', 'login_times+1'],
                'more'            => json_encode($wxUserData)
            ];

            if (isset($wxUserData['unionId'])) {
                $userData['union_id'] = $wxUserData['unionId'];
            }

            Db::name("third_party_user")
                ->where('openid', $openid)
                ->where('app_id', $appId)
                ->update($userData);

            session('name', $findThirdPartyUser['nickname']);
            session('user', $result);
            session('user_type', 1);
            session('user_id', $findThirdPartyUser['user_id']);

        } else {

            //TODO 使用事务做用户注册
            $userId = Db::name("user")->insertGetId([
                'create_time'     => $currentTime,
                'user_status'     => 1,
                'user_type'       => 2,
                'sex'             => $wxUserData['gender'],
                'user_nickname'   => $wxUserData['nickName'],
                'avatar'          => $wxUserData['avatarUrl'],
                'user_address'    => $wxUserData['user_address'],
                'last_login_ip'   => $ip,
                'last_login_time' => $currentTime,
            ]);

            Db::name("third_party_user")->insert([
                'openid'          => $openid,
                'user_id'         => $userId,
                // 'third_party'     => 'wxapp',
                'nickname'        => $wxUserData['nickName'],
                'avatarUrl'       => $wxUserData['avatarUrl'],
                'app_id'          => $appId,
                'last_login_ip'   => $ip,
                'union_id'        => isset($wxUserData['union_id']) ? $wxUserData['union_id'] : '',
                'last_login_time' => $currentTime,
                'create_time'     => $currentTime,
                'login_times'     => 1,
                'status'          => 1,
                'more'            => json_encode($wxUserData)
            ]);

            $token = cmf_generate_user_token($userId, 'wxapp');
            $result = array(
                        'id'            => $userId,
                        'user_nickname' => $wxUserData['nickName'],  
                        'avatar'        => $wxUserData['avatarUrl'],  
                    );

            session('name', $wxUserData['nickName']);
            session('user', $result);
            session('user_type', 1);
            session('user_id', $userId);

        }

        header("Location:".$ruteurl);

        $this->success("登录成功!", ['token' => $token]);


    }

}
