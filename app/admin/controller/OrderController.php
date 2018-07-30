<?php
// +----------------------------------------------------------------------
// | XjyApplet [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright © 2016-2026 AII Rights Reserved  http://www.ccapp.com.cn/
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +---------------------------------------------------------------------
// | Author: 小李 < 1017658209@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use API_PHP\APIPHP;
use app\user\controller\IndexController;
use cmf\controller\AdminBaseController;
use think\Db;
use think\Validate;

// 联调环境地址 const API_URL = 'https://exam-anubis.ele.me/anubis-webapi';
    // 线上环境地址 const API_URL = 'https://open-anubis.ele.me/anubis-webapi';
const API_URL = 'https://exam-anubis.ele.me/anubis-webapi';
const APP_ID = 'c3d16801-05cf-449f-959a-0a0e9663f45e';    //填入正确的app_id
const SECRET_KEY = '8b3cd403-5200-4a5d-9f91-b969fcdf1464';    // 填入正确的secret_key

class AnubisApiHelper {
  public static function generateSign($appId, $salt, $secretKey) {
    $seed = 'app_id=' . $appId . '&salt=' . $salt . '&secret_key=' . $secretKey;
    return md5(urlencode($seed));
  }

  public static function generateBusinessSign($appId, $token, $urlencodeData, $salt) {
    $seed = 'app_id=' . $appId . '&access_token=' . $token
          . '&data=' . $urlencodeData . '&salt=' . $salt;
    return md5($seed);
  }
}

class HttpClient
{
    /**
     * 发送GET请求
     * @param string $url
     * @param array $param
     * @return bool|mixed
     */
    public static function doGet($url, $param = null)
    {
        if (empty($url) or (!empty($param) and !is_array($param))) {
            throw new InvalidArgumentException('Params is not of the expected type');
        }
        // 验证url合法性
//        if (!filter_var($url, FILTER_VALIDATE_URL)) {
//            throw new InvalidArgumentException('Url is not valid');
//        }

        if (!empty($param)) {
            $url = trim($url, '?') . '?' . http_build_query($param);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);     //  不进行ssl 认证
        // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $result = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if (!empty($result) and $code == 200) {
            return $result;
        }
        return false;
    }

    /**
     * POST请求
     * @param $url
     * @param $param
     * @return boolean|mixed
     */
    public static function doPost($url, $param, $method = "POST")
    {
        // echo 'Request url is ' . $url . PHP_EOL;
        if (empty($url) or empty($param)) {
            throw new InvalidArgumentException('Params is not of the expected type');
        }

        // 验证url合法性
//        if (!filter_var($url, FILTER_VALIDATE_URL)) {
//            throw new InvalidArgumentException('Url is not valid');
//        }

        if (!empty($param) and is_array($param)) {
            $param = urldecode(json_encode($param));
        } else {
            // $param = urldecode(strval($param));
            $param = strval($param);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);     //  不进行ssl 认证

        if (strcmp($method, "POST") == 0) {  // POST 操作
          curl_setopt($ch, CURLOPT_POST, true);
        } else if (strcmp($method, "DELETE") == 0) { // DELETE操作
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        } else {
          throw new InvalidArgumentException('Please input correct http method, such as POST or DELETE');
        }

        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: Application/json'));
        $result = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if (!empty($result) and $code == '200') {
            return $result;
        }
        return false;
    }
}

class OrderController extends AdminBaseController
{
    public function _initialize()
    {
        if (cmf_get_current_admin_id() == null) {
            $this->error("您没有访问权限！");
        }
        if(session('admin_parent_id') == 1)
        {
            $user_id = session('ADMIN_ID');
        }else
        {
            $user_id = session('admin_parent_id');
        }

        $this->admin_user_id = $user_id;
    }

	/**
     * 总订单列表
     * @adminMenu(
     *     'name'   => '总订单列表',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '总订单列表',
     *     'param'  => ''
     * )
     */
    
	public function index()
	{
        $request        = $this->request->param();
        $pay            = $this->request->param("pay", 0, 'intval');
        $order_complete = $this->request->param("order_complete", 0, 'intval');
        $where          = [
            'a.delete_time' => ['eq',0],
            'a.order_class' => ['neq',3],
        ];

        //是否支付状态

        if (!empty($pay))
        {
            $where['a.pay']  =  ['eq',$pay];
        }

        //订单是否完成

        if (!empty($order_complete))
        {
            $where['a.order_complete']  =  ['eq',$order_complete];
        }

        //店家id

        if (cmf_get_current_admin_id() != 1)
        {
            $where['a.seller_id'] = ['eq',$this->admin_user_id];
        }

        //订单类型

        if (!empty($request['order_class']))
        {
            $where['a.order_class']  = ['eq',$request['order_class']];
        }

        //服务厅选择

        if (!empty($request['menu']))
        {
            $where['c.menu_id'] = $request['menu'];
        }

        //模糊搜索

        if (!empty($request['keyword']))
        {
            $keyword = $request['keyword'];
            $result  = Validate::is($keyword,'number');
            if ($result)
            {
                $where['a.order_id'] = $keyword;
            }
            else
            {
                $where['b.seller_nickname'] = ['like', "%$keyword%"];
            }
        }

        $count = Db::name('order');
        $order = Db::name('order');

        //时间选择

        if(!empty($request['beginTime']) || !empty($request['endTime'])){
            if(empty($request['beginTime'])){
                $request['beginTime']= '1970-01-01' ;
            }
            $endTime = $request['endTime'];
            if(empty($endTime)){
                $endTime= date('Y-m-d',time());
            }

            $endTime =    date("Y-m-d",strtotime("$endTime   +1   day"));
            $order->whereTime('order_time','between',[$request['beginTime'],$endTime]);
            $count->whereTime('order_time','between',[$request['beginTime'],$endTime]);
        }

        $data = $order
            ->alias('a')
            ->join('__SELLER__ b','a.seller_id = b.id')
            ->join('__REST__ c','a.table_id=c.id')
            ->where($where)
            ->order(['a.order_complete'=>'ASC','a.pay'=>'ASC'])
            ->field('a.*,b.seller_nickname')
            ->paginate(10);
        $data->appends($request);
        $page = $data->render();

        //服务厅

        $model = model('FoodMenu');
        $menu = $model->index();
        $this->assign('menu',$menu);

        //总数总量

        $allCount = $count
            ->alias('a')
            ->join('__SELLER__ b','a.seller_id = b.id')
            ->join('__REST__ c','a.table_id=c.id')
            ->where($where)
            ->field('count(*) as cont,FORMAT(sum(order_price),2) as sum')
            ->find();

        $this->assign('allCount',$allCount);

        $this->assign('id',session('ADMIN_ID'));
        $this->assign("order", $data);
        $this->assign("page",$page);

        return $this->fetch();

	}


	/**
     * 订单修改
     * @adminMenu(
     *     'name'   => '订单修改',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '订单修改',
     *     'param'  => ''
     * )
     */

	public function orderEdit(){
            $type     = $this->request->param('type');
            $this->assign('type',$type);
    		$order_id = $this->request->param("order_id");

            if(empty($order_id))
            {
                $this->error('订单号不能为空！');
            }else
            {
                //订单详情
                $model = model('order');
                $order  = $model->orderDetail($order_id);

                if(empty($order))
                {
                    $this->error('订单号不存在！');
                }
                elseif($order['seller_id'] == session('ADMIN_ID') or session('admin_parent_id') != 1 or cmf_get_current_admin_id() == 1)
                {
                    $delivery1  = Db::name('delivery_type')->select();

                    if ($order['order_class'] == 2)
                    {
                        $delivery   = Db::name('delivery_type')->where(["delivery_id" => $order['delivery_type']])->find();
                        $this->assign('delivery',$delivery);
                    }

                    elseif ($order['order_class'] == 3)
                    {
                        $reserve    = Db::name('seller_reserve')->where(["id" => $order['order_id']])->find();
                        $this->assign('reserve',$reserve);
                    }

                    if ($order['coupon_id'] != 0)
                    {
                        $coupon     = xjy_get_sql("*","xjy_coupon left join xjy_coupon_type on xjy_coupon.coupon_type_id = xjy_coupon_type.coupon_type_id","xjy_coupon.coupon_id = ".$order['coupon_id']);
                        $this->assign('coupon',$coupon);
                    }           
                    
                    if (!empty($order['food']))
                    {
                        $data = $model->takeFood($order['food']);
                        $this->assign('data',$data['data']);
                        $this->assign('food',$data['food']);
                    }
                    
                    $seller_menu= Db::name('seller_menu')->where(['seller_id'=>$order['seller_id']])->where('delete_time','eq',0)->select();
                    $table      = Db::name('seller_table')->where(['seller_id'=>$order['seller_id']])->where('delete_time','eq',0)->select();

                    $this->assign('table',$table);
                    $this->assign('seller_menu',$seller_menu);

                    $this->assign('order',$order);
                    $this->assign('delivery1',$delivery1);


                    //服务厅列表
                    $model = model('FoodMenu');
                    $menu = $model->index();
                    $this->assign('menu',$menu);

                    return $this->fetch();
                }else
                {
                    $this->error("不能修改他人订单！");
                }
            }    		
	}

	/**
     * 订单修改提交
     * @adminMenu(
     *     'name'   => '订单修改提交',
     *     'parent' => 'admin/User/default',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '订单修改提交',
     *     'param'  => ''
     * )
     */
    
    public function orderEditPost()
    {
	    	if($this->request->isPost())
			{
				$data = $this->request->param();
//                dump($data);exit;
	            $result = $this->validate($data['order'], 'order');

	            if(true !== $result)
	            {
	            	$this->error($result);
	            }elseif($data['order']['seller_id'] == session('ADMIN_ID') or session('admin_parent_id') != 1 or cmf_get_current_admin_id() == 1)
	        	{
	        		$data['order']['order_time']    = strtotime($data['order']['order_time']);

                    if(!empty($data['food']))
                    {
                        $data['order']['food']          = "";

                        ksort($data['food']);

                        foreach($data['food'] as $key =>$val)
                        {
                            $data['order']['food'].=$key.'*'.$val.';';
                        }
                    }

                    
	        		if($data['order']['order_class'] != 3)
	        		{
	        			if (Db::name('order')->update($data['order']) !== false) 
                        {
                            $type = $this->request->param('type');
                            $url  = 'order/index';
                            if(!empty($type)){
                                $url  = 'Cashier/index';
                            }
	                      $this->success("修改成功！", url($url,array('order'=>$data['order']['order_id'])));
		                } else 
                        {
		                    $this->error("修改失败！");
		                }
	        		}
	        		else
	        		{
	        			$data['reserve']['id'] = $data['order']['order_id'];
	        			$data['reserve']['reserve_time'] = strtotime($data['reserve']['reserve_time']);

                        $val = Db::name('seller_reserve')->where('id','eq',$data['reserve']['id'])->find();

                        if(empty($val))
                        {
                            Db::name('seller_reserve')->insert(['id'=>$data['reserve']['id']]);

                            $data['reserve']['seller_id'] = $data['order']['seller_id'];

                            $data['reserve']['user_id'] = $data['order']['user_id'];
                        }

	        			if(Db::name('order')->update($data['order']) !== false && Db::name('seller_reserve')->update($data['reserve']) !== false)
	        			{
	        				$this->success("修改成功！", url('order/index'));
		                }else 
		                {
		                    $this->error("修改失败！");
		                }
	        		}
	        		
		        }
		        else
		            {
                    $this->error("不能修改他人订单！");
                }
			}else
            {
                $this->error("错误操作！");
            }
    }



    /**
     * 预约信息
     * @adminMenu(
     *     'name'   => '预约信息',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '预约信息',
     *     'param'  => ''
     * )
     */
    
    public function reserveOrder()
    {
        $request        = input('request.');

        $order_complete = $this->request->param("order_complete", 0, 'intval');
        $where          = [
            'a.delete_time' => 0,
            'a.order_class' => 3,
        ];
        
        if(!empty($order_complete))
        {
            $where['order_complete']  =  ['eq',$order_complete];
        }

        if(cmf_get_current_admin_id() != 1)
        {
            $where['a.seller_id'] = ['eq',$this->admin_user_id];
        }
        
        if(!empty($request['pay']))
        {
            $where['pay']  =  ['eq',$request['pay']];
        }

        if(!empty($request['order_complete']))
        {
            $where['order_complete']  =  ['eq',$request['order_complete']];
        }

        $keywordComplex = [];
        if (!empty($request['keyword'])) {
            $keyword = $request['keyword'];

            $keywordComplex['a.order_id|b.seller_nickname']  = ['like', "%$keyword%"];
        }

        $time = [];
        if(!empty($request['time']))
        {
            $time = 'date_format(from_unixtime(a.order_time),"%Y-%m-%d") = date_format("'.$request['time'].'","%Y-%m-%d")';
        }   

        $data = Db::name('order')
                ->alias('a')
                ->join('__SELLER__ b','a.seller_id = b.id')
                ->join('__SELLER_RESERVE__ C','a.order_id = c.id')
                ->whereOr($keywordComplex)
                ->where($where)
                ->where($time)
                ->order(["a.order_id" => "DESC"])
                ->field('a.*,b.seller_nickname,c.*')            
                ->paginate(10);

        $data->appends($request);
        $page = $data->render();

        $this->assign('id',session('ADMIN_ID'));
        $this->assign("order", $data);
        $this->assign("page",$page);

        return $this->fetch();
    }

	/**
     * 预约信息修改
     * @adminMenu(
     *     'name'   => '预约信息修改',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '预约信息修改',
     *     'param'  => ''
     * )
     */
    
	public function reserveOrderEdit(){
		if (cmf_get_current_admin_id() == 1) 
    	{

			$order_id = $this->request->param("order_id");

			$data = Db::name('seller_reserve')->where(['id'=>$order_id])->find();

			if(!$data){
				$this->error('该预约信息不存在！');
			}

			$this->assign('data',$data);			
			return $this->fetch();

		}
		else
    	{
			$this->error("您没有访问权限！");
		}
	}

	/**
     * 预约修改提交
     * @adminMenu(
     *     'name'   => '预约修改提交',
     *     'parent' => 'admin/User/default',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '预约修改提交',
     *     'param'  => ''
     * )
     */
    
    public function reserveorderEditPost()
    {
    	if (cmf_get_current_admin_id() == 1) 
    	{
	    	if($this->request->isPost())
			{
				$data = $this->request->param();

	            $result = $this->validate($data, 'seller_reserve');

	            if(true !== $result)
	            {
	            	$this->error($result);
	            }
	            else
	        	{
	        		if (Db::name('seller_reserve')->update($data) !== false) {

	                    $this->success("修改成功！", url('order/index'));

	                }else
	                {
	                    $this->error("修改失败！");
	                }
		        }
			}
		}else
    	{
			$this->error("您没有访问权限！");
		}
    }

    /**
     * 餐桌订单添加
     * @adminMenu(
     *     'name'   => '订单添加',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '订单添加',
     *     'param'  => ''
     * )
     */

    public function orderAdd(){

        $id = $this->request->param("id", 0, 'intval');

        if($id == session('ADMIN_ID') or cmf_get_current_admin_id() == 1 or session('admin_parent_id') != 1)
        {
            $seller_menu    = Db::name('seller_menu')->where(['seller_id'=>$id])->select();
            $seller         = Db::name('seller')->where(['id'=>$id])->find();

            $this->assign('seller_menu',$seller_menu);
            $this->assign('seller',$seller);

            return $this->fetch();
        }else
        {
            $this->error('不能添加他人订单！');
        }
    }

    /**
     * 订单添加提交
     * @adminMenu(
     *     'name'   => '订单添加提交',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '订单添加提交',
     *     'param'  => ''
     * )
     */

    public function orderAddPost()
    {
      $id = $this->request->param("id", 0, 'intval');

    	if(!$this->request->isPost())
        {
            $this->error('错误操作！');

        }else if($id == session('ADMIN_ID') or cmf_get_current_admin_id() == 1 or session('admin_parent_id') != 1)
    	{
    		$data = $this->request->param();
            if(empty($data['order']['order_price']))
            {
                $this->error('金额不能为空');
            }

            $data['order']['order_id']      = date('YmdHis').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
            $data['order']['seller_id']     = $this->request->param("id", 0, 'intval');
            $data['order']['order_time']    = strtotime($data['order']['order_time']);
            $data['order']['order_price']   = $data['order']['order_price'];
            $data['order']['pay']           = 2;
            $data['order']['order_complete']= 4;
            $data['order']['order_class']   = 4;

        	$result = Db::name('order')->insert($data['order']);

        	if ($result) 
            {
            	$this->success("添加订单成功", url("order/index"));
            }else{
            	$this->error("添加订单失败");
            }	        
    	}else
        {
            $this->error('不能添加他人订单！');
        }
    }

    /**
     * 订单详细查看
     * @adminMenu(
     *     'name'   => '订单详细',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '订单详细',
     *     'param'  => ''
     * )
     */
    
    public function orderDetailed(){
        $type     = $this->request->param('type');
        $this->assign('type',$type);
		$order_id = $this->request->param("order_id");
        if (empty($order_id))
        {

            $this->error('订单号不能为空！');

        }
        else
        {
            //订单详情
            $model = model('order');
            $order  = $model->orderDetail($order_id);


            if (empty($order))
            {
                $this->error('订单号不存在！');
            }
            elseif($order['seller_id'] == session('ADMIN_ID') or cmf_get_current_admin_id() == 1 or session('admin_parent_id') != 1)

            {

                $user   = Db::name('third_party_user')->where('openid','eq',$order['user_id'])->find();

                $this->assign('user',$user);

                $seller = Db::name('seller')->where(["id" => $order['seller_id']])->find();
                //外卖订单
                if ($order['order_class'] == 2)
                {
                    $delivery = Db::name('delivery_type')->where(["delivery_id" => $order['delivery_type']])->find();

                    $this->assign('delivery',$delivery);

                }
                //预约订单
                elseif($order['order_class'] == 3)
                {
                    $reserve = Db::name('seller_reserve')->alias('a')->field('a.*,b.table_name')->join('__SELLER_TABLE__ b', 'a.reserve_class = b.id')->where(["a.id" => $order['order_id']])->find();

                    $this->assign('reserve',$reserve);
                }
                //使用优惠劵ID
                if ($order['coupon_id'] != 0)
                {
                    $coupon = xjy_get_sql("*","xjy_coupon left join xjy_coupon_type on xjy_coupon.coupon_type_id = xjy_coupon_type.coupon_type_id","xjy_coupon.coupon_id = ".$order['coupon_id']);
                    $this->assign('coupon',$coupon);
                }
                //食物详情
                if (!empty($order['food']))
                {
                    $data = $model->takeFood($order['food']);
                    $this->assign('data',$data['data']);
                    $this->assign('food',$data['food']);
                }

                $this->assign('order',$order);
                $this->assign('seller',$seller);
                return $this->fetch();
            }
            else
            {
                $this->error('不能查看他人订单！');
            }
        }
    }

    /**
     * 订单删除
     * @adminMenu(
     *     'name'   => '订单删除',
     *     'parent' => 'orderDetailed',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '订单删除',
     *     'param'  => ''
     * )
     */
    public function orderDel()
	{
		if (cmf_get_current_admin_id() == 1) 
    	{
			$id = $this->request->param("order_id");

            $where['order_id']  = $id ;
            $where['delete_time']    = strtotime(date('Y-m-d H:i:s',time()));
            $del['object_id']   = $id;
            $del['create_time'] = $where['delete_time'];
            $del['table_name']  = 'order';
            $del['name']        = '订单信息';
            $del['uid']         = session('ADMIN_ID');
            $del['seller_id']        = $this->admin_user_id;

            $req    = Db::name('recycle_bin')->insert($del);          
			$status = Db::name('order')->update($where);

	        if (!empty($status))
	        {
	        	$this->success("删除成功！", url('order/index'));
	        }
	        else
	        {
	            $this->error("删除失败！");
	        }
        }
        else
    	{
			$this->error("您没有访问权限！");
		}
	}

    /**
     * 订单添加
     * @adminMenu(
     *     'name'   => '订单添加',
     *     'parent' => 'orderDetailed',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '订单添加',
     *     'param'  => ''
     * )
     */
    public function orderAddList()
    {
        if(cmf_get_current_admin_id() == 1)
        {
            if($this->request->isPost())
            {
                $search_uid = $this->request->param('uid');
                if($search_uid)
                {
                    $where['id'] = ['like',"%$search_uid%"];
                }

                $search_key = $this->request->param('keyword');
                if($search_key)
                {
                    $where['seller_nickname'] = ['like',"%$search_key%"];
                }
            }

            if(empty($where)){
                $where = "id != 0";//可能有错
            }

            $data = Db::name('seller')
                ->where('delete_time','eq',0)
                ->where($where)
                ->order("id DESC")
                ->paginate(10);

            $page = $data->render();

            $this->assign("seller", $data);
            $this->assign("page",$page);

            return $this->fetch();
        }else
        {
            $this->redirect('order/orderadd',array('id'=>session('ADMIN_ID')));
        }
    }

    /**
     * 销售排行榜主页
     * @adminMenu(
     *     'name'   => '销售排行榜',
     *     'parent' => 'orderDetailed',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '销售排行榜',
     *     'param'  => ''
     * )
     */
    public function Printindex()
    {
        $request = $this->request->param();
        $where = array(
            'a.status'         => 2,
            'b.order_complete' => 4,
            'b.end_time'       => ['neq',0],
        );


        if (!empty($request['waiter']))
        {
            $where['b.cashier'] = $request['waiter'];
        }

        //关键字查询
        if (!empty($request['keyword']))
        {
            $ret = Validate::is($request['keyword'],'chs');
            if($ret){
                $where['c.food_name'] = ['like',"%".$request['keyword']."%"];
            }else{
                $where['c.pinyin'] = ['like',"%".$request['keyword']."%"];
            }
        }
        //服务厅查询
        if (!empty($request['menu']))
        {
            $where['d.parent_id'] = ['eq',$request['menu']];
        }
        //需要关联的数据表
        $order_food = Db::name('order_food')
            ->field('sum(come_out_num) as food_number,c.food_name,c.pinyin,c.price')
            ->alias('a')
            ->join('__ORDER__ b','a.order_id=b.order_id')
            ->join('__SELLER_MENU__ c','a.food_id=c.id')
            ->join('__FOOD_MENU__ d','c.food_class=d.id');

        $order_food2 = Db::name('order_food')
            ->field('sum(come_out_num) as cont,sum(c.price) as sum')
            ->alias('a')
            ->join('__ORDER__ b','a.order_id=b.order_id')
            ->join('__SELLER_MENU__ c','a.food_id=c.id')
            ->join('__FOOD_MENU__ d','c.food_class=d.id');
        //时间
        if(!empty($request['beginTime']) || !empty($request['endTime'])){
            if(empty($request['beginTime'])){
                $request['beginTime']= '1970-01-01' ;
            }
            $endTime = $request['endTime'];
            if(empty($endTime)){
                $endTime= date('Y-m-d',time());
            }
            $endTime =    date("Y-m-d",strtotime("$endTime   +1   day"));
            $order_food  -> whereTime('b.end_time','between',[$request['beginTime'],$endTime]);
            $order_food2 -> whereTime('b.end_time','between',[$request['beginTime'],$endTime]);
        }

        if(!empty($request['today'])){
            $order_food  -> whereTime('b.end_time','today');
            $order_food2 -> whereTime('b.end_time','today');
        }

        if (session('admin_parent_id') == 1)
        {
            $where['b.seller_id'] = $this->admin_user_id;
            $waiter = Db::name('role_user')
                ->field('c.id,c.user_login,c.user_nickname')
                ->alias('a')
                ->join('__USER__ c','c.id=a.user_id')
                ->where('a.role_id',6)
                ->where('c.parent_id', $where['b.seller_id'])
                ->select();
            $this->assign('waiterType',2);
        }
        else
        {
            $where['b.seller_id'] = session('admin_parent_id');
            $waiter = Db::name('user')
                ->where('id',session('ADMIN_ID'))
                ->field('id,user_login,user_nickname')
                ->find();
            $this->assign('waiterType',1);
            $order_food  -> where('b.cashier',session('ADMIN_ID'));
            $order_food2 -> where('b.cashier',session('ADMIN_ID'));
        }
        //服务员选项
        $this->assign('waiter',$waiter);

        //执行
        $data = $order_food
            ->where($where)
            ->group('c.food_name')
            ->order(['food_number'=>'DESC','c.id'])
            ->paginate(10);

        $data->appends($request);
        $page = $data->render();
        $this->assign('data',$data);
        $this->assign("page",$page);
        //统计
        $all = $order_food2
            ->where($where)
            ->select();
        $this->assign('allCount',$all);
        //服务厅
        $model = model('FoodMenu');
        $menu = $model->index();
        $this->assign('menu',$menu);
        return $this->fetch();
    }

    /**
     * 统计打印处理2.0
     * @adminMenu(
     *     'name'   => '统计打印处理',
     *     'parent' => 'orderDetailed',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '统计打印处理',
     *     'param'  => ''
     * )
     */
    public function printAllThing()
    {
        $request    = $this->request->param();
        $seller_id  = $this->admin_user_id;

        $model      = model('printer');

        $apiphp     = new APIPHP();
        if (!empty($request['waiter']))
        {
            $print_id   = $model->typeThree($request['waiter']);

            if (empty($print_id))
            {
                echo json_encode(array(
                    'code'      =>  0000,
                    'sub_msg'   =>  '您未绑定服务厅',
                ));exit;
            }
            $result =  $this->textToTake($request,$apiphp);
            if (empty($result['orderInfo']))
            {
                echo json_encode($result);
                exit;
            }
            $orderInfo      =  '<CB>收银信息</CB><BR>';
            $orderInfo     .= $result['orderInfo'];
            $orderInfo     .= '打印时间：'.date('Y-m-d H:i:s',time()).'<BR>';
            return      $this->Limited($apiphp,$print_id['printer_id'],$orderInfo);

        }
        else
        {
            $waiter = Db::name('order')
                ->where(array(
                'pay'            => ['in','4,5,6'],
                'order_complete' => 4,
                 'seller_id'  => $seller_id,
            ))
                ->field('cashier')
                ->group('cashier')
                ->select();
            $order = '';
            foreach ($waiter as $val)
            {
                $request['waiter'] = $val['cashier'];
                $result = $this->textToTake($request,$apiphp);
                if (!empty($result['orderInfo']))
                {
                    $order  .= $result['orderInfo'];
                    $order .=  '--------------------------------<BR>';
                    $order .=  '--------------------------------<BR>';
                }
            }
            $print_id   = $model->typeThree($request['waiter']);
            if (empty($print_id))
            {
                echo json_encode(array(
                    'code'      =>  0000,
                    'sub_msg'   =>  '您未绑定服务厅',
                ));exit;
            }
            if (empty($order))
            {
                echo json_encode(array(
                    'code'      =>  0000,
                    'sub_msg'   =>  '未查询到相应数据',
                ));exit;
            }
            $orderInfo      =  '<CB>收银信息</CB><BR>';
            $orderInfo     .= $order;
            $orderInfo     .= '打印时间：'.date('Y-m-d H:i:s',time()).'<BR>';
            return      $this->Limited($apiphp,$print_id['printer_id'],$orderInfo);
            return $apiphp->kitchenPrint4(2,$print_id['printer_id'],$orderInfo);
        }
    }

    /**
     * 字节限制打印
     * @adminMenu(
     *     'name'   => '字节限制打印',
     *     'parent' => 'orderDetailed',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '字节限制打印',
     *     'param'  => ''
     * )
     */
    public function Limited($apiphp,$print_id,$orderInfo)
    {
        $ret = $this->strLen($orderInfo);

        foreach ($ret as $val)
        {
            $result = $apiphp->kitchenPrint4(2,$print_id,$val);
        }
        return $result;
    }


    /**
     * 限制字数
     * @adminMenu(
     *     'name'   => '限制字数',
     *     'parent' => 'orderDetailed',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '限制字数',
     *     'param'  => ''
     * )
     */
    public function strLen($orderInfo)
    {
        $str = $orderInfo;
        $str_len = strlen($str);
        $ret = array();
        $step = 5000;
        for ($i=0; $i<$str_len; $i+=$step) {
            if (strlen($str) >= $step) {
                $ret[] = substr($str, 0, $step);
                $str = substr($str, $step);
            } else {
                $ret[] = $str;
            }
        }
        return $ret;
    }

    /**
     * 统计打印处理1.0
     * @adminMenu(
     *     'name'   => '统计打印处理',
     *     'parent' => 'orderDetailed',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '统计打印处理',
     *     'param'  => ''
     * )
     */
    /*public function printAllThing(){
        $request = $this->request->param();
        if(session('admin_parent_id') == 1)
        {
            $seller_id = session('ADMIN_ID');
        }
        else
        {
            $seller_id= session('admin_parent_id');
        }
        $apiphp = new APIPHP();
        if(!empty($request['waiter'])){
            $result =  $this->textToTake($request,$apiphp);
            $orderInfo      =  '<CB>收银信息</CB><BR>';
            $orderInfo     .= '时间：'.$result['time'].'<BR>';
            $orderInfo     .= $result['orderInfo'];
            return $apiphp->kitchenPrint3(2,$result['print_id'],$orderInfo);
        }else{
            $waiter = Db::name('role_user')
                ->field('c.id,c.user_login,c.user_nickname')
                ->alias('a')
                ->join('__USER__ c','c.id=a.user_id')
                ->where('a.role_id',6)
                ->where('c.parent_id',$seller_id)
                ->select();
            $arr = array('code'=>1111,'sub_msg'=>'');
            $order = '';
            $all_number = 0;
            $all_price = 0;
            foreach ($waiter as $val){
                $request['waiter'] = $val['id'];
                $result = $this->textToTake($request,$apiphp);
                $order  .= $result['orderInfo'];
                $order .=  '--------------------------------<BR>';
                $order .=  '--------------------------------<BR>';
                $all_number += $result['all_number'];
                $all_price += $result['all_price'];
            }
            $orderInfo      =  '<CB>收银信息</CB><BR>';
            $orderInfo     .= '时间：'.$result['time'].'<BR>';
            $orderInfo     .= $order;
            $orderInfo .=  '--------------------------------<BR>';
            $orderInfo .=  '--------------------------------<BR>';
            $orderInfo .=  '合计销售量：'.$all_number.'<BR>';
            $orderInfo .=  '合计收银金额：'.$all_price.'<BR>';
            return $apiphp->kitchenPrint3(2,$result['print_id'],$orderInfo);
        }




    }*/

    /**
     * 统计打印数据拼接2.0
     * @adminMenu(
     *     'name'   => '数据拼接',
     *     'parent' => 'printAllThing',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '数据拼接',
     *     'param'  => ''
     * )
     */
    public function textToTake($request,$apiphp)
    {
        $where = array(
            'a.pay'            => ['in','4,5,6'],
            'a.order_complete' => 4,
        );

        $where['a.seller_id'] = $this->admin_user_id;

        $where['a.cashier'] = $request['waiter'];

        if(!empty($request['menu'])){
            $where['d.parent_id'] = ['eq',$request['menu']];
        }
        $recharge_record = Db::name('recharge_record')
            ->field('amount')
            ->where('type',1)
            ->where('seller_id',$where['a.seller_id']);
        $order_food = Db::name('order')
            ->field('d.name,price_receipts,price_number,a.pay_class,c.menu_id')
            ->alias('a')
            ->join('__USER__ b','a.cashier=b.id')
            ->join('__REST__ c','a.table_id=c.id')
            ->join('__FOOD_MENU__ d','c.menu_id=d.id');
        if(!empty($request['beginTime']) || !empty($request['endTime'])){
            if(empty($request['beginTime'])){
                $request['beginTime']= '1970-01-01' ;
            }
            $endTime = $request['endTime'];
            if(empty($endTime)){
                $endTime= date('Y-m-d',time());
            }
            $endTime =    date("Y-m-d",strtotime("$endTime   +1   day"));
            $order_food      ->  whereTime('a.end_time','between',[$request['beginTime'],$endTime]);
            $recharge_record -> whereTime('time','between',[$request['beginTime'],$endTime]);
            $beginTime = $request['beginTime'];
        }
        else{
            //今日数据
            $order_food      -> whereTime('a.end_time','today');
            $recharge_record -> whereTime('time','today');
            $beginTime = date("Y-m-d",time());
            $endTime   = date("Y-m-d",strtotime("+1   day"));
        }
        $data = $order_food
            ->where($where)
           ->order('name')
            ->select();
        $data = json_decode(json_encode($data),true);
        $record = $recharge_record->where('user_id',$request['waiter'])->select();
        $order     = array();
        $arr       = array();
        $k         = 0;
        $all_menu  = array();
        //订单销售额
        foreach ($data as $val){
            if(empty($all_menu[$k][$val['menu_id']])){
                $k++;
                $all_menu[$k][$val['menu_id']] = $val['name'];
            }
            $arr[$k]['this_price']=array(
                '6'=>array('title'=>'营收总额', 'price' => 0),
                '7'=>array('title'=>'优惠总额', 'price' => 0),
                '8'=>array('title'=>'应收总额', 'price' => 0),
                '9'=>array('title'=>'=========','price'=>''),
                '1'=>array('title'=>'支付宝', 'price'=>0),
                '2'=>array('title'=>'微信', 'price'=>0),
                '3'=>array('title'=>'银联', 'price'=>0),
                '4'=>array('title'=>'现金', 'price'=>0),
                '5'=>array('title'=>'vip卡', 'price'=>0),
            );
            $arr[$k]['discount']=array(
                '1'=>array('title'=>'优惠明细','price'=>''),
//                '2'=>array('title'=>'免单笔数','price'=>0),
//                '3'=>array('title'=>'免单金额','price'=>0),
                '4'=>array('title'=>'打折金额','price'=>0),
            );
            $arr[$k]['return'] = array(
                '1'=>array('title'=>'退货单数','price'=>0),
                '2'=>array('title'=>'退货总额','price'=>0),
            );
            $arr[$k]['this_price'][$val['pay_class']]['price'] += $val['price_receipts'];
            $arr[$k]['this_price'][6]['price'] += $val['price_receipts']+$val['price_number'];
            $arr[$k]['this_price'][7]['price'] += $val['price_number'];
            $arr[$k]['this_price'][8]['price'] += $val['price_receipts'];
           if(!empty($val['price_number'])){
               $arr[$k]['discount'][4]['price'] += $val['price_number'];
           }
        }
        if(empty($arr[$k]['this_price'])){
            $arr[$k]['this_price']=array(
                '6'=>array('title'=>'营收总额', 'price' => 0),
                '7'=>array('title'=>'优惠总额', 'price' => 0),
                '8'=>array('title'=>'应收总额', 'price' => 0),
                '9'=>array('title'=>'=========','price'=>''),
                '1'=>array('title'=>'支付宝', 'price'=>0),
                '2'=>array('title'=>'微信', 'price'=>0),
                '3'=>array('title'=>'银联', 'price'=>0),
                '4'=>array('title'=>'现金', 'price'=>0),
                '5'=>array('title'=>'vip卡', 'price'=>0),
            );
            $arr[$k]['discount']=array(
                '1'=>array('title'=>'优惠明细','price'=>''),
//                '2'=>array('title'=>'免单笔数','price'=>0),
//                '3'=>array('title'=>'免单金额','price'=>0),
                '4'=>array('title'=>'打折金额','price'=>0),
            );
            $arr[$k]['return'] = array(
                '1'=>array('title'=>'退货单数','price'=>0),
                '2'=>array('title'=>'退货总额','price'=>0),
            );
        }

        $arr[$k]['record'] = array(
            1=>array('title'=>'卡充值金额','price'=>''),
            2=>array('title'=>'笔数','price'=>0),
            3=>array('title'=>'VIP会员卡','price'=>0),
        );
        foreach ($record as $val){
            $arr[$k]['record'][2]['price'] += 1;
            $arr[$k]['record'][3]['price'] += $val['amount'];
        }
        if(empty($order['user_name'])){
            $value  = Db::name('user')->where('id',$request['waiter'])->field('user_nickname,user_login')->find();
            $order['user_name']  = empty($value['user_nickname'])?$value['user_login']:$value['user_nickname'];
        }
        //充值额
        $order['beginTime']  =  $beginTime;
        $order['endTime']    =  $endTime;
        $order['orderInfo']  = $apiphp->kitchenPrint4(1,$arr,$order,$all_menu);
         return $order;
    }

    /**
     * 统计打印数据拼接1.0
     * @adminMenu(
     *     'name'   => '数据拼接',
     *     'parent' => 'printAllThing',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '数据拼接',
     *     'param'  => ''
     * )
     */
    /*public function textToTake($request,$apiphp){
        $where = array(
            'a.status'         => 2,
            'b.order_complete' => 4,
            'b.end_time'       => ['neq',0],
        );
        if(session('admin_parent_id') == 1)
        {
            $where['b.seller_id'] = session('ADMIN_ID');
        }
        else
        {
            $where['b.seller_id'] = session('admin_parent_id');
        }

        $where['b.cashier'] = $request['waiter'];

        if(!empty($request['keyword'])){
            $ret = Validate::is($request['keyword'],'chs');
            if($ret){
                $where['c.food_name'] = ['like',"%".$request['keyword']."%"];
            }else{
                $where['c.pinyin'] = ['like',"%".$request['keyword']."%"];
            }
        }

        if(!empty($request['menu'])){
            $where['d.parent_id'] = ['eq',$request['menu']];
        }
        $time = date('Y-m-d',time());

        $order_food = Db::name('order_food')
            ->field('sum(come_out_num) as food_number,c.food_name,c.price,f.user_nickname,f.user_login,d.name as menu_name')
            ->alias('a')
            ->join('__ORDER__ b','a.order_id=b.order_id')
            ->join('__USER__ f','b.cashier=f.id')
            ->join('__SELLER_MENU__ c','a.food_id=c.id')
            ->join('__FOOD_MENU__ d','c.food_class=d.id');

        if(!empty($request['beginTime']) || !empty($request['endTime'])){
            if(empty($request['beginTime'])){
                $request['beginTime']= '1970-01-01' ;
            }
            $endTime = $request['endTime'];
            if(empty($endTime)){
                $endTime= date('Y-m-d',time());
            }
            $endTime =    date("Y-m-d",strtotime("$endTime   +1   day"));
            $order_food->whereTime('b.end_time','between',[$request['beginTime'],$endTime]);
            $beginTime = $request['beginTime'];
            $time      = $beginTime.'-'.$endTime;
        }

        if(!empty($request['today'])){
            $order_food->whereTime('b.end_time','today');
            $time = date('Y-m-d',time());
        }


     
        $data = $order_food
            ->where($where)
            ->group('menu_name,food_name')
            ->order('menu_name')
            ->select();

        $order = array();
        $arr   = array();
        $k = 0;
        $allnumber = 0;
        $allprice = 0;
        foreach ($data as  $key=>$val){
            $true = true;
            $user_name = empty($val['user_nickname'])?$val['user_login']:$val['user_nickname'];
            $menu_name = $val['menu_name'];
            foreach ($order as $vo){
                if($vo['menu_name'] == $menu_name){

                    $true = false;
                    continue;
                }
            }
            if($true){

                $k++;
                $order[$k]['user_name']  = $user_name;
                $order[$k]['menu_name']  = $menu_name;
                $order[$k]['thisnumber'] = 0;
                $order[$k]['thisprice']  = 0;
            }
            $order[$k]['thisnumber'] += $val['food_number'];
            $order[$k]['thisprice']  += $val['food_number']*$val['price'];

            $arr[$k][]=array(
                'title' => $val['food_name'],
                'price' => $val['price'],
                'num'  => $val['food_number']

            );
            $allnumber += $val['food_number'];
            $allprice  += $val['food_number']*$val['price'];
        }
        $print_id = Db::name('printer')->field('printer_id')->where('position',2)->find();
        $order['print_id'] = $print_id['printer_id'];
        $order['time']     =  $time;
        $order['all_number'] = $allnumber;
        $order['all_price'] = $allprice;
        $order['orderInfo'] = $apiphp->kitchenPrint3(1,$arr,$order);
         return $order;
    }*/

    /**
     * 订单打印处理
     * @adminMenu(
     *     'name'   => '订单打印',
     *     'parent' => 'orderDetailed',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '订单打印',
     *     'param'  => ''
     * )
     */
    public function Print()
    {
       if($this->request){
            $order_id = $this->request->param("order_id");
            $number   = $this->request->param('number',1,'intval');
            $Printrretue   = $this->request->param('Printrretue');
           switch ($Printrretue){
               case 1:
                   $url = 'cashier/search';
                   $arr = array('id'=>$order_id);
                   break;
               case 2:
                   $url = 'cashier/index';
                   $arr = array('order'=>$order_id);
                   break;
               default:
                   $url = 'order/index';
                   $arr = null;
           }


            // $print  =  new IndexController();
            // $result = $print->auto($order_id,$number);
            $result = $this->auto($order_id,$number);
            if(is_array($result)){
                if($result['code']==1111){

                  if(!empty($Printrretue))
                  {
                    $this->success('打印成功',url($url,$arr));
                  }else
                  {
                    $this->success('打印成功',url($url));
                  }
                }else{
                    $this->error($result['sub_msg'],url($url));
                }
            }else{
                $result = json_decode($result);
                if($result->msg === 'ok'){
                  if(!empty($Printrretue))
                  {
                    $this->success('打印成功',url($url,$arr));
                  }else
                  {
                    $this->success('打印成功',url($url));
                  }
                }else{
                    $this->error('打印失败，请联系管理员',url($url));
                }
            }
        }   
      
    }

    /**
     * 快速修改订单
     * @adminMenu(
     *     'name'   => '快速修改',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '快速修改',
     *     'param'  => ''
     * )
     */
        
    public function quick()
    {
        $order_id       = $this->request->param("order_id");
        $order_complete = $this->request->param("order_complete", 0, 'intval');

        if(empty($order_id) or empty($order_complete))
        {
            $this->error("错误操作！");
        }else
        {
            $data['order_id'] = $order_id;
            $data['order_complete'] = $order_complete;

            if($order_complete==2){

                $result = $this->auto($order_id,2);
                if($result['code']!=1111)
                {
                    $this->error($result['sub_msg']);
                }

                $res = Db::name('order')->update($data);

                $data = Db::name('order')->where('order_id','eq',$order_id)->field('table_id')->find();
                if(!empty($data))
                {
                  $res = Db::name('rest')->where('id','eq',$data['table_id'])->update(['type'=>3]);
                }


            }

            if($order_complete==3)
            {
                $data = Db::name('order')->where('order_id','eq',$order_id)->field('table_id')->find();
                if(!empty($data))
                {
                  $res = Db::name('rest')->where('id','eq',$data['table_id'])->update(['type'=>1]);
                }
            }

            if($res)
            {
                $this->success("操作成功");
            }
        }
    }

    /**
     * 快速修改预约订单
     * @adminMenu(
     *     'name'   => '快速修改预约订单',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '快速修改预约订单',
     *     'param'  => ''
     * )
     */
        
    public function reserve_quick()
    {
        $order_id       = $this->request->param("order_id");
        $order_complete = intval($this->request->param("order_complete"));

        if(empty($order_id) or empty($order_complete))
        {
            $this->error("错误操作！");
        }else
        {
            $data['order_id'] = $order_id;
            $data['order_complete'] = $order_complete;

            $res = Db::name('order')->update($data);
            if($res)
            {
                $reserve_data = '';
                if($order_complete < 4)
                {
                  $reserve_data['seller_confirm'] = $order_complete;
                }else if($order_complete == 4)
                {
                  $reserve_data['complete'] = 2;
                }

                $res = Db::name('seller_reserve')->where('id','eq',$order_id)->update($reserve_data);
            }

            if($res)
            {
                $this->success("操作成功");
            }         
        }
    }

    /**
     * 确认订单请求外卖
     * @adminMenu(
     *     'name'   => '请求外卖',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '请求外卖',
     *     'param'  => ''
     * )
     */
    public function takeaway()
    {
        $order_id   = $this->request->param("order_id");
        $data       = Db::name('order')->where('order_id','eq',$order_id)->find();

        if(cmf_get_current_admin_id() == 1 or $data['seller_id'] == session('ADMIN_ID') or session('admin_parent_id') != 1)
        {
            if($data['order_class'] != 2 )
            {
                $this->error('非外卖订单无法配送');
            }elseif($data['order_complete'] == 3 or $data['order_complete'] == 4 )
            {
                $this->error("该订单已经完成或者拒绝！");
            }elseif($data['order_delivery'] != 1 )
            {
                $this->error('该订单已经发起配送！');
            }elseif($data['pay'] != 2 )
            {
                $this->error('该订单还未支付！');
            }elseif (empty($data['food'])) {
                $this->error('该订单没有菜品信息！');
            }else
            {
                $order = Db::name('order')
                    ->alias('a')
                    ->join('__SELLER__ b','a.seller_id = b.id')
                    ->join('__USER_ADDRESS__ c','a.user_address = c.id')
                    ->where('a.order_id','eq',$order_id)
                    ->field('a.*,b.*,c.*') 
                    ->find();

                if(!empty($order['food']))
                    {
                        $order['food']  = explode(";",$order['food']);

                        $nub = 0;

                        array_pop( $order['food']);
                        
                        foreach($order['food'] as $k => $u){
                            $strarr = explode("*",$u);
                            foreach($strarr as $key => $newstr){
                                if($key == 0)
                                {
                                    $id[$nub]=$newstr;
                                    $nub++;
                                }else
                                {
                                    $food[$k]['nub'] = $newstr;
                                }         
                            }
                        }

                        $sql['id']  = array('in',$id);
                        $value       = Db::name('seller_menu')->where($sql)->select();
                    }

                $a=json_encode($value);
                $value=json_decode($a,true);
                
                foreach ($value as $key => $val) {

                    $items[$key]['item_name'] = $val['food_name'];
                    $items[$key]['item_quantity'] = $food[$key]['nub'];
                    $items[$key]['item_price'] = $val['price'];
                    $items[$key]['item_actual_price'] = $val['price']+$val['lunch_box'];
                    $items[$key]['is_need_package'] = 0;
                    $items[$key]['is_agent_purchase'] = 0;
                }

                if(empty($order))
                {
                    $this->error('订单信息错误！');
                }

                $this->requestToken();

                $dataArray = array(                               
                  'transport_info' => array(                            //商家信息
                    // 'transport_name' => $order['seller_nickname'],   //门店名称
                    // 'transport_address' => $order['seller_address'], //取货点地址
                    'transport_name' => '四川云九科技有限公司',         //门店名称
                    'transport_address' => '四川省成都市高新区天府大道北段1700号新世纪环球中心E1栋9楼',    //取货点地址
                    'transport_longitude' => $order['seller_lng'],      //取货点经度，取值范围0～180
                    'transport_latitude' => $order['seller_lat'],       //取货点纬度，取值范围0～90
                    'position_source' => 1,                             //取货点经纬度来源, 1:腾讯地图, 2:百度地图, 3:高德地图
                    'transport_tel' => $order['seller_tel']             //取货点联系方式, 只支持手机号,400开头电话以及座机号码
                    
                  ),
                  'receiver_info' => array(                             //收货人信息
                    'receiver_name' => $order['Contacts'],              //收货人姓名
                    'receiver_primary_phone' => $order['tel'],          //收货人联系方式
                    'receiver_address' => $order['address'],            //收货人地址
                    'receiver_longitude' => $order['lng'],              //收货人经度
                    'position_source' => 1,                             //收货人经纬度来源, 1:腾讯地图, 2:百度地图, 3:高德地图
                    'receiver_latitude' => $order['lat']                //收货人纬度
                  ),
                  'partner_order_code' => $order['order_id'],           // 第三方订单号, 需唯一
                  'notify_url' => 'https://xiaojiuyun.cn/admin/NotifyUrl/index',//第三方回调 url地址
                  'order_type' => 1,                                    //订单类型 1: 蜂鸟配送，支持90分钟内送达
                  'order_total_amount' => $order['order_price'],        //订单总金额（不包含商家的任何活动以及折扣的金额）
                  'order_actual_amount' => $order['order_price']+$order['delivery'],      //客户需要支付的金额
                  'order_weight'=> 1.0,                                 //营业类型选定为果蔬生鲜、商店超市、其他三类时必填，大于0kg并且小于等于6kg
                  'is_invoiced' => 0,                                   //是否需要发票, 0:不需要, 1:需要
                  'order_payment_status' => 1,                          //订单支付状态 0:未支付 1:已支付
                  'order_payment_method' => 1,                          //订单支付方式 1:在线支付       
                  'goods_count' => count($items),                       //订单货物件数
                  'is_agent_payment' => 0                               //是否需要ele代收 0:否
                );

                $dataArray['items_json'] = $items;
                $order_token = $this->getToken();// first 获取token
                $state = json_decode($this->sendOrder($dataArray),true);

                if($state['code'] == 200)
                {
                    $val = 
                    [
                        'token' => $order_token,
                        'order_id' =>$order_id
                    ];

                    $res = Db::name('order')->update($val);

                    $this->success("配送方已经收到订单");

                }else
                {
                    $this->error("配送订单下发失败");
                }
            }
        }else
        {
            $this->error("他人订单！");
        }
    }

    private $token;

    /**
     * 生成token值
     */
    public function requestToken()
    {
        $salt = mt_rand(1000, 9999);
        // 获取签名
        $sig = AnubisApiHelper::generateSign(APP_ID, $salt, SECRET_KEY);
        $url = API_URL . '/get_access_token';
        $tokenStr = HttpClient::doGet($url, array('app_id' => APP_ID, 'salt' => $salt, 'signature' => $sig));
        // echo $tokenStr;
        // 获取token
        $this->token = json_decode($tokenStr, true)['data']['access_token'];
      }

      // step 2 创建订单
    public function sendOrder($dataArray)
    {
        $salt = mt_rand(1000, 9999);
        $dataJson =  json_encode($dataArray, JSON_UNESCAPED_UNICODE) . PHP_EOL;
        // echo 'data json is ' . $dataJson . PHP_EOL;

        // $urlencodeData = urlencode($dataJson);
        $urlencodeData = urlencode($dataJson);

        // echo 'urlencode data is ' . $urlencodeData . PHP_EOL;
        $sig = AnubisApiHelper::generateBusinessSign(APP_ID, $this->token, $urlencodeData, $salt);   //生成签名
        $requestJson = json_encode(array(
          'app_id' => APP_ID,
          'salt' => $salt,
          'data' => $urlencodeData,
          'signature' => $sig
        ));
        // echo $requestJson . PHP_EOL;
        // $this->url = 'http://127.0.0.1:8080/anubis-webapi/order';
        $url = API_URL . '/v2/order';
        return HttpClient::doPost($url, $requestJson);
      }

    /**
     * 获取token值
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
      }


    /**
     * 解析食品到数组中返回
     * @param $data
     * @return mixed
     */
    function food_list($data)
    {
        $data = explode(";",$data);
        $nub = 0;

        array_pop( $data);
        
        foreach($data as $k => $u){
            $strarr = explode("*",$u);
            foreach($strarr as $key => $newstr){
                if($key == 0)
                {
                    $food[$nub]['id']=$newstr;
                    $nub++;
                }else
                {
                    $food[$k]['food_nub'] = $newstr;
                }         
            }
        }

        return $food;
    }

    /**
     * json加密
     * @param array $data
     * @return string
     */
    function json_echo($data)
    {
        if(!empty($data[0]))
        {
            $json = json_encode(array(
                "resultCode"=>200,
                "message"=>"查询成功！",
                "data"=>$data
            ),JSON_UNESCAPED_UNICODE);
        }else
        {
            $json = json_encode(array(
                "resultCode"=>100,
                "message"=>"查询失败"
            ),JSON_UNESCAPED_UNICODE);
        }
        return $json;
    }

    /**
     * @param $user_id
     * @param $order_pay
     * @return string
     */
    function order_query($user_id,$order_pay)
    {

        if($order_pay == 0)
        {
            $data = Db::name('order')
                ->where('user_id','eq',$user_id)
                ->select();
        }else
        {
            $data = Db::name('order')
                ->where('user_id','eq',$user_id)
                ->where('pay','eq',$order_pay)
                ->select();
        }       

        foreach($data as $key => $val)
        {
            $food = $this->food_list($val['food']);

            $food_list[$key] = Db::name('seller_menu')->where('id','eq',$food[0]['id'])->find();

            $data[$key] = $data[$key] + $food_list[$key];
        }
        
        return $this->json_echo($data);
    }

    /**
     * 打印订单接口
     * @param $order_id 订单号
     * @param int $times 打印次数
     */
    public function auto($order_id,$times=1)
    {

        if(empty($order_id)){
            $this->error('订单号不能为空！');
        }
        $all = array();
        $order = Db::name('order')
            ->alias('a')
            ->join('__REST__ b','a.table_id=b.id')
            ->join('__FOOD_MENU__ c','b.menu_id=c.id')
            ->field('a.food,c.name,a.remarks,a.order_price,a.order_time,a.order_id,b.tb_id,b.menu_id')
            ->where('a.order_id', $order_id)
            ->find();
        //dump($order);exit;
        if (empty($order)) {
            return array('code'=>0000,'sub_msg'=>'未查询到订单信息');
        }
        if (!empty($order['food'])) {
            $menu_id = $order['menu_id'];
            $order['food'] = explode(";", $order['food']);
            $id = array();
            $food = array();
            array_pop($order['food']);
            //挑出菜单
            foreach ($order['food'] as $k => $u) {
                $strarr = explode("*", $u);
                foreach ($strarr as $key => $newstr) {
                    if ($key == 0) {
                        $food[$k]['id'] = $newstr;
                        $id[] = $newstr;
                    } else {
                        $food[$k]['num'] = $newstr;
                    }
                }
            }

            $sql['id'] = array('in', $id);
            $data = Db::name('seller_menu')->field('food_name,id,price,food_class')->where($sql)->select();
            $id = array();
            foreach ($data as $kay=>$val){
                foreach ($food as $k=>$v){
                    if($v['id']==$val['id']){
                        $food[$k]['title'] = $val['food_name'];
                        $food[$k]['price'] = $val['price'];
                        $food[$k]['food_class'] = $val['food_class'];
                        break;
                    }
                }
                $id[] = $val['food_class'];
            }
            $where['menu_id'] = array('in',$id);
            $model  = model('printer');

            if ($times==2)
            {
                //后厨打印
                $food_nub = $model->printer_id($where,$food,2);

                $all['food_nub'] = $food_nub;

                //前台

                $newArr = $model->printer_id($where,$food,1);
            }
            else
            {
                //前台
                $newArr = $model->Reception($menu_id,$food,3);
            }

            $all['food_all'] = $newArr;
            $all['order']    = $order;
            $all['order']['times']    = $times;
        }
        if(empty($all)){
            return array('code'=>0000,'sub_msg'=>'订单没有点菜');
        }
      
        $apiphp = new APIPHP();
        return $apiphp->combination($all);
    }


}