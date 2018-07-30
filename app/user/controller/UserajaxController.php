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
namespace app\user\controller;

use alipay\AopsdkController;
use cmf\controller\HomeBaseController;
use phonepay\PhoneController;
use think\Db;
use tree\Tree;
use think\Request;

class UserAjaxController extends HomeBaseController
{

	/**
     * 订单信息ajax请求
     * @adminMenu(
     *     'name'   => 'ajax请求',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => 'ajax 请求',
     *     'param'  => ''
     * )
     */
    
    public function order()
    {
    	$request = Request::instance();

    	$user_id   = $request->param("user_id", 0, 'intval');                  //第三方用户ID
    	$order_pay = $request->param("order_pay", 0, 'intval');                //订单类型
        $seller_id = $request->param("seller_id", 0, 'intval');                //商家ID

    	if(empty($order_pay))
    	{
    		$order_pay = 0;
    	}

        if(empty($user_id) or empty($seller_id))
        {
            $json = json_encode(array(
                "resultCode"=>100,
                "message"=>"错误操作",
            ),JSON_UNESCAPED_UNICODE);

            echo $json;
            exit;
        }else
        {
            echo $this->order_query($user_id,$order_pay,$seller_id);
            exit;
        }
    } 

    /**
     * 详细订单信息
     * @adminMenu(
     *     'name'   => '详细订单信息',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '详细订单信息',
     *     'param'  => ''
     * )
     */  

    public function order_detailed()
    {
    	$request = Request::instance();

    	$order_id = $request->post("order_id");                                //订单ID

        if(!empty($order_id))
        {
            $data = Db::name('order')->alias('a')->field('a.*,b.seller_nickname,b.seller_logo')->join('xjy_seller b','a.seller_id = b.id')->where('a.order_id','eq',$order_id)->find();

            if($data['order_class'] == 3)
            {
                $reserve = Db::name('seller_reserve')->alias('a')->field('a.*,b.table_name')->join('__SELLER_TABLE__ b', 'a.reserve_class = b.id')->where('a.id','eq',$data['order_id'])->find();

                $data = $data + $reserve;
            }

            if(!empty($data['food']))
            {
                $food = $this->food_list($data['food']);

                foreach($food as $key => $val)
                {
                    $food_list[$key] = $val['id'];
                }

                $sql['id']  = array('in',$food_list);

                $data['food_list'] = Db::name('seller_menu')->where($sql)->select();    

                $json = json_encode(array(
                    "resultCode"=>200,
                    "message"=>"查询成功！",
                    "data"=>$data
                ),JSON_UNESCAPED_UNICODE);

                echo $json;
                exit;
            }else
            {
                echo $json = json_encode(array(
                    "resultCode"=>101,
                    "message"=>"订单号错误"
                    ),JSON_UNESCAPED_UNICODE);
                exit;
            }
        }else
        {
            echo $json = json_encode(array(
                    "resultCode"=>101,
                    "message"=>"订单号错误"
                    ),JSON_UNESCAPED_UNICODE);
                exit;
        }	 	
    }

    /**
     * 详细菜品信息
     * @adminMenu(
     *     'name'   => '详细菜品信息',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '详细菜品信息',
     *     'param'  => ''
     * )
     */  
    
    public function foodsDetailed()

    {
        $request    = Request::instance();
        $foods_list = $request->post("food_id");                     //食品ID使用；分割    

        if(empty($foods_list))
        {
            echo $json = json_encode(array(
                "resultCode"=>101,
                "message"=>"商品查询失败"
                ),JSON_UNESCAPED_UNICODE);
            exit;
        }

        $foods_list = substr($foods_list,0,strlen($foods_list)-1);      //删除最后一个分号
        $food_list       = explode(";",$foods_list);                         //转换数组
        $data = array();

        foreach($food_list as $key => $val)
        {
            $data[$key] = $val;
        }
        $list       = Db::name('seller_menu')
            ->where('id','in',$data)
            ->select();

        $list       = json_decode( $list, true );                       //转化为纯数组

        if(!empty($list)) 
        {
            echo $json = json_encode(array(
                "resultCode"=>200,
                "message"=>"商品信息查询成功",
                "data"=>$list
                ),JSON_UNESCAPED_UNICODE);
            exit;
        }else{
            echo $json = json_encode(array(
                "resultCode"=>101,
                "message"=>"商品查询失败"
                ),JSON_UNESCAPED_UNICODE);
            exit;
        }   
    }

    /**
     * 用户对订单评价
     * @adminMenu(
     *     'name'   => '用户评价',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '用户评价',
     *     'param'  => ''
     * )
     */
    
    public function order_evaluate()
    {
    	$data = input('post.');

        $this->ifempty($data);

        if(!empty($data['delivery_evaluate']))
        {
            $val['delivery_evaluate'] = $data['delivery_evaluate'];
        }
        // if(!empty($data['food_evaluate']))
        // {
        //     $val['food_evaluate'] = $data['food_evaluate'];
        // }
        if(!empty($data['order_icon']))
        {
            $val['order_icon'] = $data['order_icon'];
        }else
        {
            $val['order_icon'] = '';
        }

        $val = 
        [
            'pay'               =>  '6',
            'order_complete'    =>  '4',
            'order_delivery'    =>  '3',
            // 'delivery_evaluate' =>  $data['delivery_evaluate'],                      //配送评价---可不填默认5
            //'food_evaluate'     =>  $data['food_evaluate'],                           //菜品评价（菜品*评价；分割）---可不填
            'user_evaluate'     =>  $data['user_evaluate']                              //用户对本次购物评论---用户评价
            //'order_icon'        =>  $data['order_icon']                               //评论图片----评价图片
        ];

    	$res = Db::name('order')->where('order_id','eq',$data['order_id'])->update($val);

    	if($res) 
        {
        	echo $json = json_encode(array(
	            "resultCode"=>200,
	            "message"=>"操作成功"
	        	),JSON_UNESCAPED_UNICODE);
            exit;
        }else{
        	echo $json = json_encode(array(
	            "resultCode"=>103,
	            "message"=>"添加评价失败"
	        	),JSON_UNESCAPED_UNICODE);
            exit;
        }	        
    }

    /**
     * 收藏页面
     * @adminMenu(
     *     'name'   => '收藏页面',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '收藏页面',
     *     'param'  => ''
     * )
     */

    public function user_collection()
    {
    	$request = Request::instance();

    	$user_id = $request->param("user_id", 0, 'intval');

        $seller_id = $request->param("seller_id", 0, 'intval');

        if(empty($user_id) or empty($seller_id))
        {
            $this->error('错误操作！');
            /*echo $json = json_encode(array(
                "resultCode"=>101,
                "message"=>"错误操作！"
                ),JSON_UNESCAPED_UNICODE);
            exit;*/
        }

    	$data = Db::name('user_collection')->where('user_id','eq',$user_id)->find();

    	if(!empty($data['menu_id']))
    	{
    		$data = explode(";",$data['menu_id']);

		  	array_pop( $data);

		  	$sql['id']  = array('in',$data);

		  	$food = Db::name('seller_menu')->where($sql)->where('seller_id','eq',$seller_id)->select();
            $this->error('data',$food);
            return $this->fetch();
		  	/*$json = json_encode(array(
	            "resultCode"=>200,
	            "message"=>"查询成功！",
	            "data"=>$food
	        ),JSON_UNESCAPED_UNICODE);

	        echo $json;
            exit;*/
    	}else
        {
            $this->error("该用户没有收藏信息！");
            /*$json = json_encode(array(
                "resultCode"=>220,
                "message"=>"该用户没有收藏信息！"
            ),JSON_UNESCAPED_UNICODE);

            echo $json;
            exit;*/
        }
    }

	/**
     * 消除收藏
     * @adminMenu(
     *     'name'   => '消除收藏',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '消除收藏',
     *     'param'  => ''
     * )
     */
	    
	public function user_collection_edit()
	{
		$request = Request::instance();

    	$user_id = $request->post("user_id", 0, 'intval');

    	$menu_id = $request->post("menu_id", 0, 'intval');

        if(empty($user_id) or empty($menu_id))
        {
            echo $json = json_encode(array(
                "resultCode"=>101,
                "message"=>"错误操作！"
                ),JSON_UNESCAPED_UNICODE);
            exit;
        }

    	$data = Db::name('user_collection')->where('user_id','eq',$user_id)->find();
	
    	if(!empty($data['menu_id']))
    	{
    		$food = explode(";",$data['menu_id']);

		  	array_pop($food);

		  	$key = array_search($menu_id,$food);

		  	if ($key !== false) 
	  		{
	  			array_splice($food, $key, 1);

                if(!empty($food))
                {
                    $data['menu_id'] = '';

                    foreach($food as $key => $val)
                    {
                        $data['menu_id'].=$val.';';
                    }

                    Db::name('user_collection')->update($data);

                }else
                {
                    Db::name('user_collection')->where('$user_id','eq',$data['user_id'])->delete();
                }

	  			echo $json = json_encode(array(
	            "resultCode"=>200,
	            "message"=>"消除收藏成功"
	        	),JSON_UNESCAPED_UNICODE);
                exit;
	  		}else
	  		{
	  			echo $json = json_encode(array(
	            "resultCode"=>102,
	            "message"=>"操作失败，商品错误！"
	        	),JSON_UNESCAPED_UNICODE);
                exit;
	  		}		  	
    	}else
        {
            $json = json_encode(array(
                "resultCode"=>220,
                "message"=>"该用户没有收藏信息！"
            ),JSON_UNESCAPED_UNICODE);

            echo $json;
            exit;
        }	
	}

    /**
     * 添加收藏页面
     * @adminMenu(
     *     'name'   => '添加收藏',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加收藏',
     *     'param'  => ''
     * )
     */
    
    public function user_collection_add()
    {
        $request = Request::instance();

        $user_id = $request->post("user_id", 0, 'intval');

        $menu_id = $request->post("menu_id", 0, 'intval');

        if(empty($user_id) or empty($menu_id))
        {
            echo $json = json_encode(array(
                "resultCode"=>101,
                "message"=>"错误操作！"
                ),JSON_UNESCAPED_UNICODE);
            exit;
        }

        $data = Db::name('user_collection')->where('user_id','eq',$user_id)->find();

        if(empty($data))
        {
            $val = 
            [
                'user_id'   => $user_id,
                'menu_id'   => $menu_id,
                'time'      => strtotime(date('Y-m-d H:i:s',time()))
            ];

            Db::name('user_collection')->insert($val);

            echo $json = json_encode(array(
                    "resultCode"=>203,
                    "message"=>"收藏成功！"
                    ),JSON_UNESCAPED_UNICODE);
            exit;
 
        }else
        {
            $food = explode(";",$data['menu_id']);

            array_pop($food);

            $key = array_search($menu_id,$food);

            if ($key !== false) 
            {
                echo $json = json_encode(array(
                "resultCode"=>111,
                "message"=>"该商品已经收藏！"
                ),JSON_UNESCAPED_UNICODE);
                exit;
            }else
            {
                $data['menu_id'] .= $menu_id.';';

                Db::name('user_collection')->update($data);

                echo $json = json_encode(array(
                    "resultCode"=>203,
                    "message"=>"收藏成功！"
                    ),JSON_UNESCAPED_UNICODE);
                exit;
            }
        }
    }
    
	/**
     * 用户收货地址
     * @adminMenu(
     *     'name'   => '用户收货地址',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '用户收货地址',
     *     'param'  => ''
     * )
     */
    public function user_address()
    {
    	$request = Request::instance();

    	$user_id = $request->param("user_id", 0, 'intval');

        if(empty($user_id))
        {
            echo $json = json_encode(array(
                "resultCode"=>101,
                "message"=>"错误操作！"
                ),JSON_UNESCAPED_UNICODE);
            exit;
        }

    	$address = Db::name('user_address')->where('user_id','eq',$user_id)->select();
        $this->assign('data',$address);
        return $this->fetch();
    	//echo $this->json_echo($address);
    }

    /**
     * 收货地址详细信息
     * @adminMenu(
     *     'name'   => '收货地址详细信息',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '收货地址详细信息',
     *     'param'  => ''
     * )
     */
    public function user_address_detailed()
    {
        $request = Request::instance();

        $user_id = $request->param("user_id", 0, 'intval');

        $id      = $request->param("id", 0, 'intval');

        if(empty($user_id) or empty($id))
        {
            echo $json = json_encode(array(
                "resultCode"=>101,
                "message"=>"错误操作！"
                ),JSON_UNESCAPED_UNICODE);
            exit;
        }

        $address = Db::name('user_address')->where('user_id','eq',$user_id)->where('id','eq',$id)->where('delete_time','eq',0)->find();

        if($user_id != $address['user_id'])
        {
            echo $json = json_encode(array(
                "resultCode"=>101,
                "message"=>"非法操作！"
                ),JSON_UNESCAPED_UNICODE);
            exit;
        }else
        {
            echo $json = json_encode(array(
                "resultCode"=>200,
                "message"=>"查询成功！",
                'data'=>$address
                ),JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    /**
     * 收货地址新添
     * @adminMenu(
     *     'name'   => '收货地址新添',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '收货地址新添',
     *     'param'  => ''
     * )
     */
    public function user_address_add()
    {
    	$data = input('post.');

        $this->ifempty($data);

        $val = 
        [
            'user_id'   =>  $data['user_id'],                       //第三方用户ID
            'address'   =>  $data['address'],                       //用户地址
            'Contacts'  =>  $data['Contacts'],                      //收货人
            'tel'       =>  $data['tel'],                           //收货电话
            'lng'       =>  $data['lng'],                           //收货地址经度
            'lat'       =>  $data['lat']                            //收货地址纬度
        ];

    	$result = Db::name('user_address')->insert($val);

    	if($result) 
        {
        	echo $json = json_encode(array(
	            "resultCode"=>200,
	            "message"=>"操作成功"
	        	),JSON_UNESCAPED_UNICODE);
            exit;
        }else{
        	echo $json = json_encode(array(
	            "resultCode"=>103,
	            "message"=>"添加地址失败"
	        	),JSON_UNESCAPED_UNICODE);
            exit;
        }	        
    }

    /**
     * 修改收货地址操作
     * @adminMenu(
     *     'name'   => '修改收货地址操作',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '修改收货地址操作',
     *     'param'  => ''
     * )
     */
    public function user_address_edit()
    {
    	$data = input('post.');

        $this->ifempty($data);

        $val = 
        [   
            'address'   =>  $data['address'],
            'Contacts'  =>  $data['Contacts'],
            'tel'       =>  $data['tel'],
            'lng'       =>  $data['lng'],
            'lat'       =>  $data['lat']
        ];

        $request = Request::instance();
        $id      = $request->post("id", 0, 'intval');
        $user_id = $request->post('user_id',0,'intval');

    	$result  = Db::name('user_address')->where('id','eq',$id)->where('user_id','eq',$user_id)->update($val);

    	if($result) 
        {
        	echo $json = json_encode(array(
	            "resultCode"=>200,
	            "message"=>"操作成功"
	        	),JSON_UNESCAPED_UNICODE);
            exit;
        }else{
        	echo $json = json_encode(array(
	            "resultCode"=>104,
	            "message"=>"修改失败"
	        	),JSON_UNESCAPED_UNICODE);
            exit;
        }	        
    }



    /**
     * 删除收货地址操作
     * @adminMenu(
     *     'name'   => '删除收货地址操作',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '删除收货地址操作',
     *     'param'  => ''
     * )
     */
    public function user_address_del()
    {

        $request = Request::instance();

        $id      = $request->post("id", 0, 'intval');
        $user_id = $request->post('user_id',0,'intval');
        $val     = ['delete_time'=>time()];

        $result  = Db::name('user_address')->where('id','eq',$id)->where('user_id','eq',$user_id)->update($val);

        if($result) 
        {
            echo $json = json_encode(array(
                "resultCode"=>200,
                "message"=>"操作成功"
                ),JSON_UNESCAPED_UNICODE);
            exit;
        }else{
            echo $json = json_encode(array(
                "resultCode"=>104,
                "message"=>"修改失败"
                ),JSON_UNESCAPED_UNICODE);
            exit;
        }           
    }

    /**
     * 预约餐桌
     * @adminMenu(
     *     'name'   => '预约餐桌',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '预约餐桌',
     *     'param'  => ''
     * )
     */
    
    public function sellerReserve()
    {
        $request        = Request::instance();
        $seller_id      = $request->param("seller_id", 0, 'intval');            //商家ID

        if(empty($seller_id))
        {
            $this->error("错误操作！");
            /*echo $json = json_encode(array(
                "resultCode"=>100,
                "message"=>"错误操作！",
                ),JSON_UNESCAPED_UNICODE);
            exit;*/
        }

        $table_list     = Db::name('rest')
            ->field('a.id,tb_id,a.table_id,a.menu_id,c.name,b.table_name,table_describe,remark')
            ->alias('a')
            ->join('xjy_seller_table b','a.table_id = b.id')
            ->join('xjy_food_menu c','a.menu_id=c.id')
            ->where('a.seller_id','eq',$seller_id)
            ->where('a.delete_time',0)
            ->where('b.delete_time',0)
            ->select();



        if(!empty($table_list))
        {
            $this->assign('data',$table_list);
            return $this->fetch();
            /*echo $json = json_encode(array(
                "resultCode"=>200,
                "message"=>"查询成功！",
                "data"=>$table_list
                ),JSON_UNESCAPED_UNICODE);
            exit;*/
        }else
        {
            $this->error("查询失败");
            /*echo $json = json_encode(array(
                "resultCode"=>100,
                "message"=>"查询失败",
                ),JSON_UNESCAPED_UNICODE);
            exit;*/
        }  
    }

    /**
     * 扫码点餐
     * @adminMenu(
     *     'name'   => '扫码点餐',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '扫码点餐',
     *     'param'  => ''
     * )
     */
    public function scan_order()
    {
    	$request = Request::instance();

    	$id      = $request->param("id", 0, 'intval');

    	if(empty($id))
    	{
    	    $this->error('餐桌ID为空');
    		/*echo $json = json_encode(array(
	            "resultCode"=>105,
	            "message"=>"餐桌ID为空",
	        	),JSON_UNESCAPED_UNICODE);
            exit;*/
    	}

    	// $data =Db::query("SELECT a.seller_nickname,c.name,b.* FROM xjy_seller as a,xjy_seller_menu as b,xjy_food_menu as c,xjy_seller_table as d WHERE a.id = b.seller_id AND b.food_class = c.id AND a.id = d.seller_id AND d.id = ".$id." ORDER BY c.name");

        $data = Db::name('rest')
            ->field('a.id,a.tb_id,name,table_name,table_describe,remark')
            ->alias('a')
            ->join('xjy_food_menu b','a.menu_id=b.id')
            ->join('xjy_seller_table c','a.table_id=c.id')
            ->where('a.id','eq',$id)
            ->where('a.delete_time',0)
            ->where('c.delete_time',0)
            ->find();
        /*  使用*得到的数据：array(14) {
       ["id"] => int(1)   //桌子的主id
       ["table_id"] => int(1)  //类型id
       ["tb_id"] => int(1)  //在当前服务厅的id
       ["menu_id"] => int(179)  //服务厅id
       ["seller_id"] => int(10)  //店家id
       ["delete_time"] => int(0)  //删除状态
       ["parent_id"] => int(0)   //服务厅的父id
       ["status"] => int(1)  //服务厅的状态
       ["list_order"] => float(10000) //排序
       ["remark"] => string(12) "大口吃肉"  //类型的备注
       ["table_name"] => string(6) "大厅"   //类型的名称
       ["name"] => string(6) "中餐"       //服务厅名称
       ["icon"] => string(0) ""     //服务厅图标
       ["table_describe"] => string(19) "餐桌位于大厅a"   //服务厅的备注
       }*/
    	if(!empty($data))
    	{
    	    $this->assign('data',$data);
    		/*echo $json = json_encode(array(
	            "resultCode"=>200,
	            "message"=>"查询成功！",
	            "data"=>$data
	        	),JSON_UNESCAPED_UNICODE);
            exit;*/
    		$this->fetch();
    	}else
    	{
    	    $this->error('查询失败');
    		/*echo $json = json_encode(array(
	            "resultCode"=>100,
	            "message"=>"查询失败",
	        	),JSON_UNESCAPED_UNICODE);
            exit;*/
    	}    	
    }

    /*public function text(){
        $where   = array(
            'menu_id'     => 179,
            'table_id'    => 14,
            'seller_id'   => 3,
            'delete_time' => 1
        );
        $had     = Db::name('order')->field('table_id')->whereTime('order_time','today')->select();
        $in      = array();
        foreach ($had as $val){
            $in[]  = implode('',$val);
        }
        $id      = Db::name('rest')->field('id')->where($where)->find();
        echo Db::getLastsql();
        echo '<hr>';
        if(empty($id)){
            echo 1111,'<hr>';
        }
        var_dump($id['id']) ;
        //var_dump($id->id) ;
        dump($had);
        dump($id);
    }*/

    /**
     * 用户下单
     * @adminMenu(
     *     'name'   => '用户下单',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '用户下单',
     *     'param'  => ''
     * )
     */
    public function place_order()
    {
        /*
         * 初步需要的参数：
         * 订餐类型order_class,1
         * 商家号seller_id,10
         * 用户user_id,1
         * 订单状态pay,1:未支付;2:已支付;3:确认;4:拒绝订单;5:未评价;6:已评价'
         * 食物food,13*1;15*1;17*1;20*1;
         * 备注remarks,加辣，加饭
         * 服务厅号码menu_id,179
         * 餐桌类型table_id，1
         * */
    	$data = input('post.');

        $this->ifempty($data);
        $this->ifempty($data['order_class']);
        $data['remarks'] = empty($data['remarks']) ? '该订单没有备注！' : $data['remarks'];
        if($data['order_class'] !== 3)
        {
            if(empty($data['food']))
            {
                echo $json = json_encode(array(
                "resultCode"=>101,
                "message"=>"错误操作！"               
                ),JSON_UNESCAPED_UNICODE);
                exit;
            }else
            {
                $food = $this->food_list($data['food']);

                foreach($food as $key => $val)
                {
                    $food_list[$key] = $val['id'];
                }

                $sql['id']  = array('in',$food_list);
                $food_data  = Db::name('seller_menu')->where($sql)->select(); 
                $order_price = 0;
                $order_discount = 0;
                $order_discount_price = 0;

                foreach ($food_data as $key => $value) {
                    $order_price += $value['price']*$food[$key]['food_nub'];
                    $order_discount += $value['discount']*$food[$key]['food_nub'];
                } 

                if($data['order_class'] == 2)
                {
                    foreach ($food_data as $key => $value) {
                        $order_price += $value['lunch_box']*$food[$key]['food_nub'];
                        $order_discount_price += $value['lunch_box']*$food[$key]['food_nub'];
                    }
                }

                $order_discount_price += $order_price - $order_discount;
            }
        }

        if($data['order_class'] == 1 or $data['order_class'] == 2)
        {
            $val=
            [
                'seller_id'     =>  $data['seller_id'],
                'user_id'       =>  $data['user_id'],
                'food'          =>  $data['food'],
                'order_time'    =>  strtotime(date('Y-m-d H:i:s',time())),
                'order_price'   =>  $order_price,
                'discount_price'=>  $order_discount_price,
                'pay'           =>  $data['pay'],           
                'order_class'   =>  $data['order_class'],
                'remarks'       =>  $data['remarks']
            ];

            if($data['order_class'] == 1)
            {
                //分配对应服务厅的桌号
                $where   = array(
                    'menu_id'       => $data['menu_id'],
                    'table_id'      => $data['table_id'],
                    'seller_id'     => $data['seller_id'],
                    'delete_time'   => 0,
                );
                //当前订单中已经确认的座号
                $had     = Db::name('order')->field('table_id')->whereTime('order_time','today')->where('order_complete',4)->select();
                $in      = array();
                foreach ($had as $val){
                    $in[] = $val['table_id'];
                }
                //
                $id      = Db::name('rest')->field('id')->where($where)->whereNotIn('id',$in)->find();
                if(empty($id)){
                    echo $json = json_encode(array(
                        "resultCode"=>106,
                        "message"=>"座位已满"
                    ),JSON_UNESCAPED_UNICODE);
                    exit;
                }
                $val['table_id'] = $id['id'];

            }
            if($data['order_class'] == 2)
            {
                $val['delivery_type'] = $data['delivery_type'];
                $val['user_address']  = $data['user_address'];
            }

        }elseif($data['order_class'] == 4)
        {
            $val=
            [
                'seller_id'     =>  $data['seller_id'],
                'user_id'       =>  $data['user_id'],
                'order_price'   =>  $order_price,
                'discount_price'=>  $order_discount_price,
                'order_time'    =>  strtotime(date('Y-m-d H:i:s',time())),
                'pay'           =>  2,
                'pay_class'     =>  2,
                'order_complete'=>  1,
                'order_class'   =>  4
            ];

        }elseif($data['order_class'] == 3)
        {
            $val= 
            [
                'seller_id'     =>  $data['seller_id'],
                'user_id'       =>  $data['user_id'],
                'order_time'    =>  strtotime(date('Y-m-d H:i:s',time())),
                'order_class'   =>  3,
                'remarks'       =>  $data['remarks']
            ];
        }

        $val['order_id'] = date('YmdHis').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);

    	$result = Db::name('order')->insert($val);

        if($data['order_class'] == 3)
        {
            $value =
            [
                'id'            =>  $val['order_id'],
                'user_id'       =>  $data['user_id'],
                'seller_id'     =>  $data['seller_id'],
                'user_nub'      =>  $data['user_nub'],
                'table_nub'     =>  $data['table_nub'],
                'reserve_time'  =>  strtotime($data['reserve_time']),
                'tel'           =>  $data['tel'],
                'user_name'     =>  $data['user_name'],
                'reserve_class' =>  $data['reserve_class']
            ];

            $res = Db::name('seller_reserve')->insert($value);
        }

    	if(!empty($result))
    	{
    	    $user = session('user');
            $role_use = Db::name('role_user')->where('user_id',$user['id'])->find();
    	    if(!empty($role_use)){
                $print  =  new IndexController();
                $print->auto( $val['order_id'],2);

            }

    		echo $json = json_encode(array(
	            "resultCode"=>200,
	            "message"=>"下单成功"	            
	        	),JSON_UNESCAPED_UNICODE);
            exit;
    	}else
    	{
    		echo $json = json_encode(array(
	            "resultCode"=>106,
	            "message"=>"下单失败"	            
	        	),JSON_UNESCAPED_UNICODE);
            exit;
    	}
    }

    /**
     * 商家主页
     * @adminMenu(
     *     'name'   => '商家主页',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '商家主页',
     *     'param'  => ''
     * )
     */
    public function seller_index()
    {
    	$request = Request::instance();

    	$appid =   $request->param("appid");

        $this->ifempty($appid);

        if(!is_string($appid))
        {
            $this->error("错误的appid");
            /*echo $json = json_encode(array(
                "resultCode"=>110,
                "message"=>"错误的appid"        
                ),JSON_UNESCAPED_UNICODE);
            exit;*/
        }

    	// $data =    Db::query("SELECT a.*,c.name,b.* FROM xjy_seller as a,xjy_seller_menu as b,xjy_food_menu as c WHERE a.id = b.seller_id AND b.food_class = c.id AND a.appid = ".$appid." ORDER BY c.name");

        $data = Db::name('seller')->alias('a')
            ->join('__SELLER_MENU__ b','a.id = b.seller_id')
            ->join('__FOOD_MENU__ c','b.food_class = c.id')
            ->field('a.*,c.name,b.*')
            ->where('a.appid','eq',$appid)
            ->where('b.delete_time','eq',0)
            ->order('c.name ASC')
            ->select();
        $data   = json_decode( json_encode( $data ), true );//转化为纯数组
        $menu = Db::name('seller')->alias('a')
            ->join('__FOOD_MENU__ c','a.id = c.seller_id')
            ->field('c.name')
            ->where('a.appid','eq',$appid)
            ->select();
        $this->ifempty($data);


        // $count =   Db::query("SELECT COUNT(name) as count FROM xjy_seller as a,xjy_seller_menu as b,xjy_food_menu as c WHERE a.id = b.seller_id AND b.food_class = c.id AND a.appid = ".$appid." GROUP BY c.name ORDER BY c.name");  

        // $a = 0;
        // $b = 0;


        // foreach($count as $key => $nub)
        // {
        //     for ($i=0; $i <$nub['count'] ; $i++) { 
        //         $val[$b]['0'] = $data[$a+$i]['name'];
        //         $val[$b]['1'] = $data[$a+$i]['food_class'];
        //         $val[$b]['2'][$i] = $data[$a+$i];
        //     }
        //     $a +=$nub['count'];    
        //     $b++; 

        // }

        $this->assign('data',$data);
        $this->assign('menu',$menu);
        return $this->fetch();
    	/*echo $json = json_encode(array(
	            "resultCode"=>200,
	            "message"=>"查询成功！",
	            "data"=>$data              //$val	            
	        	),JSON_UNESCAPED_UNICODE);
        exit;*/
    }

    /**
     * 支付页面
     * @adminMenu(
     *     'name'   => '支付页面',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '支付页面',
     *     'param'  => ''
     * )
     */

    public function payJoinfee()
    {
        $request        = Request::instance();
        $order_id       = $request->post('order_id');                           //获取用户订单ID
        $openid         = $request->post('openid');                             //用户Openid

        $this->ifempty($openid);
        $this->ifempty($order_id);

        $price = Db::name('order')
            ->where('order_id','eq',$order_id)
            ->value('discount_price');

        if(empty($price))
        {
            $this->error("支付失败");
            /*echo $json = json_encode(array(
            "resultCode"=>110,
            "message"=>"支付失败"            
            ),JSON_UNESCAPED_UNICODE);
            exit;*/
        }

        $appid='wx4fdc5885c2c4ad8c';
        $mch_id='1491561782';
        $key='57b4e182423d02bd50f25c6507b880d7';
        // $openid='oKKb00KIIZt7e5ZMWWokcqq6y5jc';  //前端传输

        import('WeixinPay',EXTEND_PATH);
        $weixinpay = new \WeixinPay($appid,$openid,$mch_id,$key,$price,$order_id);
        $return=$weixinpay->pay();
        $data['order']  = $order_id;
        $data['return'] = $return;
        //$this->assign('data',$data);
        //return $this->fetch();
        echo $json = json_encode(array(
            "resultCode"=>200,
            "message"=>"调起支付信息", 
            "data"=>$data          
            ),JSON_UNESCAPED_UNICODE);
        exit;
    }


    /**
     * 支付结果
     * @adminMenu(
     *     'name'   => '支付结果',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '支付结果',
     *     'param'  => ''
     * )
     */
    
    public function payResult()
    {
        $result = input('post.');

        if(empty($result['success']) or $result['order_id'])
        {
            echo $json = json_encode(array(
                "resultCode"=>101,
                "message"=>"错误操作！"            
                ),JSON_UNESCAPED_UNICODE);
            exit;
        }else
        {
            if($result['success'])
            {
                $val = 
                [
                    'order_id' => $result['order_id'],
                    'pay'      => 2
                ];

                $res    = Db::name('order')->update($val);
                $order  = Db::name('order')->where('order_id','eq',$result['order_id'])->find();
                $discount_price = $order['discount_price'];
                $seller_id      = $order['seller_id'];
                $request= Db::name('user')->where('id','eq',$seller_id)->setInc('user_RMB',$discount_price);

                if($res)
                {
                    if($request)
                    {
                        echo $json = json_encode(array(
                        "resultCode"=>201,
                        "message"=>"支付成功！"            
                        ),JSON_UNESCAPED_UNICODE);
                        exit;
                    }else
                    {
                        echo $json = json_encode(array(
                        "resultCode"=>150,
                        "message"=>"支付成功！但是商家余额添加失败!"            
                        ),JSON_UNESCAPED_UNICODE);
                        exit;
                    }
                    
                }else
                {
                    echo $json = json_encode(array(
                    "resultCode"=>110,
                    "message"=>"支付失败"            
                    ),JSON_UNESCAPED_UNICODE);
                    exit;
                }
            }else
            {
                echo $json = json_encode(array(
                "resultCode"=>300,
                "message"=>"没有支付"            
                ),JSON_UNESCAPED_UNICODE);
                exit;
            }
        }
    }

    /**
     * 确认收货
     * @adminMenu(
     *     'name'   => '确认收货',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '确认收货',
     *     'param'  => ''
     * )
     */
    public function confirm()
    {
        $request = Request::instance();

        $order_id = $request->post("order_id");

        if(empty($order_id))
        {
            echo $json = json_encode(array(
                "resultCode"=>101,
                "message"=>"错误操作！"               
                ),JSON_UNESCAPED_UNICODE);
            exit;
        }

        $val =
        [
            'order_complete'=>  '4',
            'order_delivery'=>  '3'
        ];

        $res = Db::name('order')->where('order_id','eq',$order_id)->update($val);  
        
        if($res)
        {
            echo $json = json_encode(array(
                "resultCode"=>200,
                "message"=>"收货成功"            
                ),JSON_UNESCAPED_UNICODE);
            exit;
        }else
        {
            echo $json = json_encode(array(
                "resultCode"=>107,
                "message"=>"收货失败"            
                ),JSON_UNESCAPED_UNICODE);
            exit;
        }  
    }

    /**
     * 服务员登录
     * @adminMenu(
     *     'name'   => '服务员登录',
     *     'parent' => 'login',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '服务员登录',
     *     'param'  => ''
     * )
     */
    public function WaiterLogin($data){
        $name = $data['user'];
        $pass = $data['pass'];
        $arr = array(
            'user' => $data['user'],
            'pass' => $data['pass'],
        );
        $result = $this->validate($arr,'waiter');
        if(!$result){
            echo $json = json_encode(array(
                "resultCode"=>110,
                "message"=>$result
            ),JSON_UNESCAPED_UNICODE);
            exit;
        }
        if (strpos($name, "@") > 0) {//邮箱登陆
            $where['user_email'] = $name;
        } else {
            $where['user_login'] = $name;
        }
        $result = Db::name('user')->where($where)->find();
        if (!empty($result) ) {             //&& $result['user_type'] == 1
            if (cmf_compare_password($pass, $result['user_pass'])) {
                $groups = Db::name('RoleUser')
                    ->alias("a")
                    ->join('__ROLE__ b', 'a.role_id =b.id')
                    ->where(["user_id" => $result["id"], "status" => 1])
                    ->value("role_id");
                if ($result["id"] != 1 && (empty($groups) || empty($result['user_status']))) {
                    $this->error(lang('USE_DISABLED'));
                }
                //登入成功页面跳转
                session('ADMIN_ID', $result["id"]);
                session('name', $result["user_login"]);
                $result['last_login_ip']   = get_client_ip(0, true);
                $result['last_login_time'] = time();
                $token                     = cmf_generate_user_token($result["id"], 'web');
                if (!empty($token)) {
                    session('token', $token);
                }
                Db::name('user')->update($result);
                echo $json = json_encode(array(
                    "resultCode"=>200,
                    "message"=>"登录成功",
                ),JSON_UNESCAPED_UNICODE);
                exit;
            } else {
                echo $json = json_encode(array(
                    "resultCode"=>110,
                    "message"=>"用户名密码错误",
                ),JSON_UNESCAPED_UNICODE);
            }
        } else {
            echo $json = json_encode(array(
                "resultCode"=>110,
                "message"=>"用户名密码错误",
            ),JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * 用户登录
     * @adminMenu(
     *     'name'   => '用户登录',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '用户登录',
     *     'param'  => ''
     * )
     */
    public function login()
    {
        /*
         * 第三方登录：
         * openid,
         * appid,
         * type，
         * 服务员登录：
         * user
         * pass
         * type
         * */
        $data = input('post.');
        if($data['type']==2){
            $this->WaiterLogin($data);
            exit;
        }
        if(empty($data['openid']) or empty($data['appid']))
        {
            echo $json = json_encode(array(
                "resultCode"=>101,
                "message"=>"错误操作！"         
                ),JSON_UNESCAPED_UNICODE);
                exit;
        }

        if(!is_string($data['appid']))
        {
            echo $json = json_encode(array(
                "resultCode"=>110,
                "message"=>"错误的appid"        
                ),JSON_UNESCAPED_UNICODE);
            exit;
        }
        $res = Db::name('third_party_user')
                    ->where('openid','eq',$data['openid'])
                    ->where('app_id','eq',$data['appid'])
                    ->find();
        if(empty($res))
        {
            $val  = 
            [
                'last_login_time'   =>  strtotime(date('Y-m-d H:i:s',time())),
                'create_time'       =>  strtotime(date('Y-m-d H:i:s',time())),
                'nickname'          =>  $data['nickname'],
                'openid'            =>  $data['openid'],
                'avatarUrl'         =>  $data['avatarUrl'],
                'gender'            =>  $data['gender'],
                'app_id'            =>  $data['appid'],
                'union_id'          =>  '微信'
            ]; 

            $res = Db::name('third_party_user')->insert($val);

            if($res)
            {
                echo $json = json_encode(array(
                "resultCode"=>201,
                "message"=>"新用户添加成功"         
                ),JSON_UNESCAPED_UNICODE);
                exit;
            }else
            {
                echo $json = json_encode(array(
                "resultCode"=>108,
                "message"=>"新用户添加失败"         
                ),JSON_UNESCAPED_UNICODE);
                exit;
            }
        }else
        {   
            $val = 
            [
                'id'                =>  $res['id'],
                'last_login_time'   =>  strtotime(date('Y-m-d H:i:s',time())),
                'login_times'       =>  ++$res['login_times']
            ];

            $re = Db::name('third_party_user')->update($val);
            echo $json = json_encode(array(
                "resultCode"=>200,
                "message"=>"登录成功",
                'data'=>$res            
                ),JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    /**
     * 预约订单
     * @adminMenu(
     *     'name'   => '预约订单',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '预约订单',
     *     'param'  => ''
     * )
     */
    public function reserve()
    {
        $request = Request::instance();

        $seller_id = $request->param("seller_id", 0, 'intval');

        $user_id = $request->param("user_id", 0, 'intval');

        if(empty($seller_id) or empty($user_id))
        {
            $this->error("错误操作！");
            /*echo $json = json_encode(array(
                "resultCode"=>101,
                "message"=>"错误操作！"               
                ),JSON_UNESCAPED_UNICODE);
            exit;*/
        }

        $data = Db::name('seller_reserve')->where('seller_id','eq',$seller_id)->where('user_id','eq',$user_id)->select();

        if(!empty($data))
        {
            $this->assign('data',$data);
            return $this->fetch();
            /*echo $json = json_encode(array(
                "resultCode"=>200,
                "message"=>"查询成功！",
                'data'=>$data            
                ),JSON_UNESCAPED_UNICODE);
            exit;*/
        }else
        {
            $this->error("错误信息！" );
            /*echo $json = json_encode(array(
                "resultCode"=>101,
                "message"=>"错误信息！"
                ),JSON_UNESCAPED_UNICODE);
            exit;*/
        }
    }

    /**
     * 解析菜单
     * @param $data
     * @return array
     */
    function food_list($data)
    {
        $food_a = array();
    	$data = explode(";",$data);
        $nub = 0;

        array_pop( $data);
        
        foreach($data as $k => $u){
            $strarr = explode("*",$u);
            foreach($strarr as $key => $newstr){
                if($key == 0)
                {
                    $food_a[$nub]['id']=$newstr;
                    $nub++;
                }else
                {
                    $food_a[$k]['food_nub'] = $newstr;
                }         
            }
        }

        return $food_a;
    }

    /**
     * 返回json格式
     * @param $data
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
     * 查询订单信息
     * @param $user_id
     * @param $order_pay
     * @param $seller_id
     * @return string
     */
    function order_query($user_id,$order_pay,$seller_id)
    {

    	if($order_pay == 0)
    	{
    		$data = Db::name('order')
    			->where('user_id','eq',$user_id)
                ->where('seller_id','eq',$seller_id)
    			->select();
    	}else
    	{
    		$data = Db::name('order')
    			->where('user_id','eq',$user_id)
    			->where('pay','eq',$order_pay)
                ->where('seller_id','eq',$seller_id)
    			->select();
    	}   	

		foreach($data as $key => $val)
		{
			$food_b = $this->food_list($val['food']);
            
            if(!empty($food_b))
            {
                $food_list[$key] = Db::name('seller_menu')->where('id','eq',$food_b[0]['id'])->find();
                $data[$key] = $data[$key] + $food_list[$key];
            }

		}

    	//return $this->json_echo($data);
        if(!empty($data[0]))
        {
            $this->assign('data',$data);
            return $this->fetch();
        }else
        {
            $this->error('查询失败');
        }
    }

    /**
     * 判断是否为空
     * @param $data
     */
    function ifempty($data)
    {
        if(empty($data))
        {
            echo $json = json_encode(array(
                "resultCode"=>100,
                "message"=>"错误操作！"
            ),JSON_UNESCAPED_UNICODE);
            exit;
        }
    }


    /**
     * 手机网站支付
     */
    public function phoneTrade(){
        $subject        = '美食城';
        $out_trade_no   = request()->param('order_id');
        $total_amount   = request()->param('order_price');
        //$total_amount   = 0.01;
        $quit_url       = 'http://'.$_SERVER["HTTP_HOST"].'/user/index';
        $product_code   = 'QUICK_WAP_WAY';  //销售产品码
        $seller_id      =  '';
        $aopsdk = new PhoneController();
        $result = $aopsdk->phone($subject,$out_trade_no,$total_amount,$quit_url,$product_code,$seller_id,$body='',$notifyUrl);
        if($result)
        {
            $json = json_encode(array(
                "resultCode"=>200,
                "message"=>"支付成功！",
                "trade_no"=>$result['trade_no']
            ),JSON_UNESCAPED_UNICODE);
        }else
        {
            $json = json_encode(array(
                "resultCode"=>100,
                "message"=>$result['sub_msg']
            ),JSON_UNESCAPED_UNICODE);
        }
        echo $json;
    }

}