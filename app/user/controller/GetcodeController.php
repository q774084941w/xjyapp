<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Powerless < wzxaini9@gmail.com>
// +----------------------------------------------------------------------
namespace app\user\controller;

use think\Db;
use cmf\controller\HomeBaseController;

class GetcodeController extends HomeBaseController
{

    /**
     * 获取用户Openid
     */
    public function index()
    {

        $seller_id = $this->request->param("seller_id",0,'intval');

        if (isset($_GET['code']) and !empty($seller_id))
        {

            $appid  = "wx979cb71291915d83";
            $secret = "e7a388753de2e3ae28eb7c29d1c6a768";
            $code   = $_GET['code'];
            $handle = fopen("https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$secret."&code=".$code."&grant_type=authorization_code","rb");
            $content = "";
            while (!feof($handle)) 
            {
                $content .= fread($handle, 10000);
            }
            fclose($handle);

            $content   = json_decode( $content , true );
	
            $res = Db::name('user')->where('id','eq',$seller_id)->update(['seller_openid'=>$content['openid']]);

            $this->assign('openid',$content['openid']);

            return $this->fetch();

		}else{
		    echo "NO CODE";
		}
    }
}