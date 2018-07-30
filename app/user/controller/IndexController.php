<?php
// +----------------------------------------------------------------------
// | XjyApplet [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright © 2016-2026 AII Rights Reserved  http://www.ccapp.com.cn/
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 阿黎 < 3289457575@qq.com>
// +----------------------------------------------------------------------
namespace app\user\controller;

use API_PHP\APIPHP;
use alipay\AopsdkController;
use cmf\controller\HomeBaseController;
use phonepay\PhoneController;
use think\Db;
use tree\Tree;
use think\Request;
use WeChat_signature\JSSDK;
// use think\Cache;
use think\Session;

class IndexController extends HomeBaseController
{

    public function _initialize()
    {
        $user       = session('user');
        $request    = $this->request;
        $action     = $request->action();

        if($action != 'waiterloginview' && $action != 'login' && $action != 'wechatto' && $action != 'auto')
        {
            if(empty($user))
            {
                header('Location:'.cmf_url('user/index/WaiterloginView'));
                /*$this->error('未登录，请选登录',cmf_url('user/index/WaiterloginView'));*/
            }
        }

        $this->appId    = "wx4612824b7c9f43b5";
        $this->appSecret= "241735856e32ba6fd0d9905dad15710c";

        $this->assign('user',$user);
        $this->assign('stateurl',$request->url(true));
    }
	
	public function index(){
			header('Location:'.cmf_url('user/index/WaiterloginView'));
	}
	
    /**
     * 暂定的支付处理
     */
    public function not_payment(){
        if($this->request->isPost()){
            $data = $this->request->param();
            $pace_type = $data['radio1'];
            if(!empty($pace_type)){
                switch ($pace_type){
                    //支付宝方式
                    case 1:

                        break;
                    //微信方式
                    case 2:

                        break;
                    //刷卡方式
                    case 3:

                        break;
                    default:

                }
                Db::name('order')->where('order_id',$data['order_id'])->update(['order_complete'=>2]);
                if(!empty($data['remarks'])){
                    $this->remarks($data);
                }
                $typs='';
                $result = $this->auto($data['order_id'],2);
                if($result['code']==0000){
					$typs = $result['sub_msg'];
                }
                $this->success('请前往收银台付款,备注：'.$typs,url('user/index/seller_index'));
            }else{
                $this->error('未选择支付方式');
            }
        }else{
            $this->error('操作错误');
        }
    }


    /**
     * 扫一扫静态页面
     */
    public function scanQRCode()
    {

        $jssdk = new JSSDK($this->appId, $this->appSecret);
        $signPackage = $jssdk->GetSignPackage();

        $this->assign('signPackage',$signPackage);    // wx.Config 配置信息
        return $this->fetch();
    }

    /**
     * 打印订单接口
     * @param $order_id 订单号
     * @param int $times 打印次数
     */
    public function auto($order_id,$times=1){

        if(empty($order_id)){
            $this->error('订单号不能为空！');
        }
        $all = array();
        $order = Db::name('order')
            ->alias('a')
            ->join('__REST__ b','a.table_id=b.id')
            ->join('__FOOD_MENU__ c','b.menu_id=c.id')
            ->field('a.food,c.name,a.remarks,a.order_price,a.order_time,a.order_id,b.tb_id')
            ->where('a.order_id', $order_id)
            ->find();
   
        if (empty($order)) {
            return array('code'=>0000,'sub_msg'=>'未查询到订单信息');
        }
        if (!empty($order['food'])) {
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
            $model = model('printer');

            //后厨打印
                $food_nub = $model->printer_id($where,$food,2);
                if(empty($food_nub))
                {
                    return array('code'=>0000,'sub_msg'=>'未查询到后厨对应的打印机');
                }
                $all['food_nub'] = $food_nub;

            //前台
                $newArr = $model->printer_id($where,$food,1);
            if(empty($newArr)){
                return array('code'=>0000,'sub_msg'=>'未查询到前台对应的打印机');
            }
            $all['food_all'] = $newArr;
            $all['order']    = $order;
            $all['order']['times']    = $times;

        }
        if(empty($all)){
            $this->error('订单没有点菜');
        }
        $apiphp = new APIPHP();
        return $apiphp->combination($all);
    }

   

    /**
     * 添加菜单打印
     * @adminMenu(
     *     'name'   => '添加菜单打印',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加菜单打印',
     *     'param'  => ''
     * )
     */
    public function printAdd($request,$order_id){
        $order = Db::name('order')
            ->alias('a')
            ->join('__REST__ b','a.table_id=b.id')
            ->join('__FOOD_MENU__ c','b.menu_id=c.id')
            ->field('c.name,a.remarks,a.order_time,a.order_id,b.tb_id')
            ->where('a.order_id', $order_id)
            ->find();

        $arr = array();
        $in  = array();
        foreach($request['food'] as $key=>$val){

            $arr[$key]['id'] = $val['id'];
            $arr[$key]['num'] = $val['food_nub'];
            $in[] = $val['id'];
        }
        $sql['id'] = array('in', $in);
        $data = Db::name('seller_menu')->field('food_name,id,price,food_class')->where($sql)->select();
        $in = array();
        foreach($data as $key=>$val){
            foreach ($arr as $k=>$v){
                if($v['id']==$val['id']){
                    $arr[$k]['title']       = $val['food_name'];
                    $arr[$k]['price']       = $val['price'];
                    $arr[$k]['food_class']  = $val['food_class'];
                    break;
                }
            }
            $in[] = $val['food_class'];
        }
        $where['menu_id'] = array('in',$in);
         $model  = model('printer');
        //后厨打印
            $food_nub = $model->printer_id($where,$arr,2);
        
            $all['food_nub'] = $food_nub;
            //前台

            $newArr = $model->printer_id($where,$arr,1);
               
            $order['thisTitle'] = '加菜订单';
            $all['food_all'] = $newArr;
            $all['order']    = $order;
            $all['order']['times']    = 2;

        $apiphp = new APIPHP();
         return $apiphp->combination($all);
    }

    /**
     * 退出登录
     */
    public function login_out(){
        $appid = session('appid');
        session(null);
        session('appid',$appid);
        // $this->WaiterloginView();
        header('Location:'.cmf_url('user/index/WaiterloginView'));
    }

    /**
     * 我的 个人中心
     * @adminMenu(
     *     'name'   => '我的 个人中心',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '我的 个人中心',
     *     'param'  => ''
     * )
     */
    public function my()
    {

        $user = session('user');

        $jssdk = new JSSDK($this->appId, $this->appSecret);
        $signPackage = $jssdk->GetSignPackage();

        $this->assign('user',$user);
        $this->assign('signPackage',$signPackage);              // wx.Config 配置信息
        return $this->fetch();
    }

    /**
     * 菜品及产品列表页
     * @adminMenu(
     *     'name'   => '菜品及产品列表页',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '菜品及产品列表页',
     *     'param'  => ''
     * )
     */
    public function FoodList()
    {
        $request    = Request::instance();
        $parent_id  = intval($request->param('parent_id'));
        $child_id   = intval($request->param('child_id'));
        $keywords   = $request->param('keywords');
        $appid      = session('appid');
        $where      = '';
        $seller_id  = session('seller_id');
        $datas = func_get_args() ;

        if(!empty($datas)){
            if(!empty($datas[0]['parent_id'])){
                $parent_id  = intval($datas[0]['parent_id']);
            }
            if(!empty($datas[0]['child_id'])){
                $child_id   = intval($datas[0]['child_id']);
            }
        }
        if(empty($appid))
        {
            $this->error('商家appid不存在');
        }



        //一级菜系
        // $foodClassdata = Db::name('seller')->alias('a')
        //     ->join('__FOOD_MENU__ c','a.id = c.seller_id')
        //     ->field('c.*')
        //     ->where('a.appid','eq',$appid)
        //     ->where('c.parent_id','eq',0)
        //     ->order('c.name ASC')
        //     ->select();

        // $foodClassdata = Cache::get('foodClassdata');
        // if($foodClassdata == false)
        // {
            $foodClassdata = Db::name('food_menu')
                ->where('parent_id','eq',0)
                ->where('seller_id',$seller_id)
                ->order('list_order ASC')
                ->select();

            $foodClassdata   = json_decode( json_encode( $foodClassdata ), true );//转化为纯数组

        //     Cache::set('foodClassdata',$foodClassdata,3600);
        // }

        if(!empty($foodClassdata)){
            $parent_id = $parent_id ? $parent_id : $foodClassdata[0]['id'];
        }
        //二级菜系 及子菜系
        if(!empty($parent_id)){
            // $foodChildClass = Cache::get('foodChildClass');
            // if($foodChildClass == false)
            // {
                $foodChildClass = Db::name('food_menu')
                ->where('parent_id','eq',$parent_id)
                ->where('seller_id',$seller_id)
                ->order('id ASC')
                ->select();

                $foodChildClass   = json_decode( json_encode( $foodChildClass ), true );//转化为纯数组

            //     Cache::set('foodChildClass',$foodChildClass,3600);
            // }

            $this->assign('foodChildClass',$foodChildClass);
        }

        if(!empty($keywords))
        {
            $where['food_name'] = ['like',"%$keywords%"];
        }else{
            if(!empty($foodChildClass[0]['id'])){
                $child_id = $child_id ? $child_id : $foodChildClass[0]['id'];
            }
            // $where['food_class'] = $child_id;  //v1.0版本
            $where['c.id'] = $parent_id;
        }

        //当前菜系 下面的菜品  //v1.0版本
        // $foods = Db::name('seller_menu')
        //     ->where('seller_id',$seller_id)
        //     ->where($where)
        //     ->order('food_name ASC')
        //     ->select();
        // $foods = Cache::get('foods');   
        // if($foods == false)
        // {
            $foods = Db::name('seller_menu')->alias('a')
            ->join('__FOOD_MENU__ b','a.food_class=b.id')
            ->join('__FOOD_MENU__ c','b.parent_id=c.id')
            ->where('a.delete_time',0)
            ->where('a.seller_id',$seller_id)
            ->where($where)
            ->order('a.food_class ASC')
            ->field('a.*')
            ->select();    
            $foods = json_decode( json_encode($foods), true );//转化为纯数组

        //     Cache::set('foods',$foods,3600);
        // }        

        //当前商家服务厅列表
        // $table_list = Cache::get('table_list');
        // if($table_list == false)
        // {
            $table_list = Db::name('food_menu')
                ->where('seller_id','eq',$seller_id)
                ->where('parent_id','eq',0)
                ->where('seller_id',$seller_id)
                ->field('id,name')
                ->select();

        //     Cache::set('table_list',$table_list,3600);
        // }

        $this->assign('data',$table_list);
        $this->assign('foods',$foods);
        $this->assign('foodClassdata',$foodClassdata);
        return $this->fetch();
    }

    /**
     * 加菜 菜品及产品列表页
     * @adminMenu(
     *     'name'   => '加菜 菜品及产品列表页',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '加菜 菜品及产品列表页',
     *     'param'  => ''
     * )
     */
    public function AddFoodList()
    {
        $request    = Request::instance();
        $order_id   = $request->param('order_id');
        $parent_id  = intval($request->param('parent_id'));
        $child_id   = intval($request->param('child_id'));
        $keywords   = $request->param('keywords');
        $appid      = session('appid');
        $where      = '';
        $seller_id  = session('seller_id');
        $datas = func_get_args() ;

        if(empty($order_id) && !empty(session('addfood_order_id')))
        {
            $count_order = Db::name('order')->where('order_id','eq',session('addfood_order_id'))->count();

            if($count_order<1)
            {
                $this->error('加菜订单id不存在');
            }

        }elseif (!empty($order_id)) 
        {
            Session::set('addfood_order_id',$order_id);
        }else
        {
            $this->error('加菜订单id不能为空');
        }

        if(!empty($datas)){
            if(!empty($datas[0]['parent_id'])){
                $parent_id  = intval($datas[0]['parent_id']);
            }
            if(!empty($datas[0]['child_id'])){
                $child_id   = intval($datas[0]['child_id']);
            }
        }
        if(empty($appid))
        {
            $this->error('商家appid不存在');
        }

        //一级菜系
        $foodClassdata = Db::name('food_menu')
            ->where('parent_id','eq',0)
            ->where('seller_id',$seller_id)
            ->order('list_order ASC')
            ->select();

        $foodClassdata   = json_decode( json_encode( $foodClassdata ), true );//转化为纯数组

        if(!empty($foodClassdata)){
            $parent_id = $parent_id ? $parent_id : $foodClassdata[0]['id'];
        }
        //二级菜系 及子菜系
        if(!empty($parent_id))
        {
            $foodChildClass = Db::name('food_menu')
            ->where('parent_id','eq',$parent_id)
            ->where('seller_id',$seller_id)
            ->order('id ASC')
            ->select();

            $foodChildClass   = json_decode( json_encode( $foodChildClass ), true );//转化为纯数组

            $this->assign('foodChildClass',$foodChildClass);
        }

        if(!empty($keywords))
        {
            $where['food_name'] = ['like',"%$keywords%"];
        }else
        {
            if(!empty($foodChildClass[0]['id'])){
                $child_id = $child_id ? $child_id : $foodChildClass[0]['id'];
            }

            $where['c.id'] = $parent_id;
        }

        //当前菜系 下面的菜品 
        $foods = Db::name('seller_menu')->alias('a')
        ->join('__FOOD_MENU__ b','a.food_class=b.id')
        ->join('__FOOD_MENU__ c','b.parent_id=c.id')
        ->where('a.delete_time',0)
        ->where('a.seller_id',$seller_id)
        ->where($where)
        ->order('a.food_class ASC')
        ->field('a.*')
        ->select();    
        $foods = json_decode( json_encode($foods), true );//转化为纯数组    

        //当前商家服务厅列表
        $table_list = Db::name('food_menu')
            ->where('seller_id','eq',$seller_id)
            ->where('parent_id','eq',0)
            ->where('seller_id',$seller_id)
            ->field('id,name')
            ->select();



        $this->assign('data',$table_list);
        $this->assign('foods',$foods);
        $this->assign('foodClassdata',$foodClassdata);
        $this->assign('addfood_order_id',session('addfood_order_id'));
        
        return $this->fetch();
    }

    /**
     * 购物车
     */
    public function sesssionTo(){

        if($this->request->isPost()){
            $data      = $this->request->param();
            $uid       = session('user');
            $mySession = session('shopping['.$uid['id'].']');
            switch ($data['type']){
                case 1:
                    if(empty($mySession[$data['id']])){
                        $mySession[$data['id']] = $data;
                    }else{
                        $old = $mySession[$data['id']];
                        $old['num'] += $data['num'];
                        $mySession[$data['id']] = $old;
                    }
                    break;
                case 2:
                    if(empty($mySession[$data['id']])){
                    }else{
                        $old = $mySession[$data['id']];
                        $old['num'] -= $data['num'];
                        $mySession[$data['id']] = $old;
                        if($old['num']==0){
                            unset($mySession[$data['id']]);
                        }
                    }
                    break;
                case 3:
                    echo json_encode($mySession);
                    break;
                default:
                    $mySession=null;
            }
            session('shopping['.$uid['id'].']',$mySession);
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
        $order_id = $this->request->param('order_id');
        $this->orderDetails($order_id);
        return $this->fetch();
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

    // public function foodsDetailed()
    // {
    //     return $this->fetch();
    // }

    /**
     * 修改备注
     * @param $data
     */
    protected function remarks($data){
        $arr = array(
            'remarks' => $data['remarks']
        );
        Db::name('order')->where('order_id',$data['order_id'])->update($arr);
    }

    /**
     * 我的订单评价
     * @adminMenu(
     *     'name'   => '我的订单评价',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '我的订单评价',
     *     'param'  => ''
     * )
     */

    public function evaluation()
    {
        $request = Request::instance();
        $order_pay = $request->param("order_pay", 0, 'intval');

        $this->order($order_pay);
        // return $this->fetch();
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
        $order_id = $this->request->param('order_id');
        $this->orderDetails($order_id);
        return $this->fetch();
    }

    /**
     * 查询订单详情数据
     * @param $id
     */
    protected function orderDetails($id){
        $order = Db::name('order')
            ->where('a.order_id',$id)
            ->field('a.delivery_evaluate,a.order_id,a.food,a.user_evaluate,a.order_price,a.discount_price,c.table_name,b.tb_id,d.name,e.seller_nickname,e.seller_logo')
            ->alias('a')
            ->join('__REST__ b','a.table_id=b.id')
            ->join('__SELLER_TABLE__ c','b.table_id=c.id')
            ->join('__FOOD_MENU__ d','b.menu_id=d.id')
            ->join('__SELLER__ e','e.id=a.seller_id')
            ->find();

        if (!empty($order['food'])) {
            $order['food'] = explode(";", $order['food']);
            $inarr = array();
            array_pop($order['food']);
            foreach ($order['food'] as $k => $u) {
                $strarr = explode("*", $u);
                foreach ($strarr as $key => $newstr) {
                    if ($key == 0) {
                        $food[$k]['id'] = $newstr;
                        $inarr[] = $newstr;
                    } else {
                        $food[$k]['nub'] = $newstr;
                    }
                }
                $type[$k]['nub'] = 1;
            }
            $sql['id'] = array('in', $inarr);
            $data = Db::name('seller_menu')
                ->field('id,food_name,food_icon,price')
                ->where($sql)
                ->select();
            $new  = array();
            foreach ($data as $kay=>$val){
                foreach ($food as $k=>$v){
                    if($v['id']==$val['id']){
                        $new[$v['id']][] = $val['food_name'];
                        $new[$v['id']][] = $val['food_icon'];
                        $new[$v['id']][] = $val['price'];
                        break;
                    }
                }
            }
            $this->assign('data', $new);
            $this->assign('food', $food);

        }
        $this->assign('order', $order);
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

    public function payment()
    {
        $order_id = $this->request->param('order_id');
        $this->orderDetails($order_id);
        return $this->fetch();
    }

    /**
     * 服务员用户登录
     * @adminMenu(
     *     'name'   => '服务员用户登录',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '服务员用户登录',
     *     'param'  => ''
     * )
     */
    public function WaiterloginView()
    {
        $token = session('token');
        $user = session('user');
        if(!empty($token) && !empty($user)){
            header('Location:'.url('user/index/seller_index'));
        }else{
            return $this->fetch();
        }
    }

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

    public function order($order_pay_get = '')
    {
        $request = Request::instance();
        $user    = session('user');

        $user_id   = $user['id'];
        // $user_id   = $request->param("user_id", 0, 'intval');                  //第三方用户ID
        $order_pay = $request->param("order_pay", 0, 'intval');                //订单类型
        $order_pay = $order_pay_get ? $order_pay_get : $order_pay;
        // $seller_id = $request->param("seller_id", 0, 'intval');                //商家ID
        $seller_id = session('seller_id');

        if(empty($order_pay))
        {
            $order_pay = 0;
        }

        if(empty($user_id) or empty($seller_id))
        {
            $this->error('错误操作');

            // $json = json_encode(array(
            //     "resultCode"=>100,
            //     "message"=>"错误操作",
            // ),JSON_UNESCAPED_UNICODE);

            // echo $json;
            exit;
        }else
        {
            echo $this->order_query($user_id,$order_pay,$seller_id);
            exit;
        }

        // return $this->fetch();
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

    // public function order_detailed()
    // {
    //     $request = Request::instance();

    //     $order_id = $request->post("order_id");                                //订单ID

    //     if(!empty($order_id))
    //     {
    //         $data = Db::name('order')->alias('a')->field('a.*,b.seller_nickname,b.seller_logo')->join('xjy_seller b','a.seller_id = b.id')->where('a.order_id','eq',$order_id)->find();

    //         if($data['order_class'] == 3)
    //         {
    //             $reserve = Db::name('seller_reserve')->alias('a')->field('a.*,b.table_name')->join('__SELLER_TABLE__ b', 'a.reserve_class = b.id')->where('a.id','eq',$data['order_id'])->find();

    //             $data = $data + $reserve;
    //         }

    //         if(!empty($data['food']))
    //         {
    //             $food = $this->food_list($data['food']);

    //             foreach($food as $key => $val)
    //             {
    //                 $food_list[$key] = $val['id'];
    //             }

    //             $sql['id']  = array('in',$food_list);

    //             $data['food_list'] = Db::name('seller_menu')->where($sql)->select();

    //             $json = json_encode(array(
    //                 "resultCode"=>200,
    //                 "message"=>"查询成功！",
    //                 "data"=>$data
    //             ),JSON_UNESCAPED_UNICODE);

    //             echo $json;
    //             exit;
    //         }else
    //         {
    //             echo $json = json_encode(array(
    //                 "resultCode"=>101,
    //                 "message"=>"订单号错误"
    //                 ),JSON_UNESCAPED_UNICODE);
    //             exit;
    //         }
    //     }else
    //     {
    //         echo $json = json_encode(array(
    //                 "resultCode"=>101,
    //                 "message"=>"订单号错误"
    //                 ),JSON_UNESCAPED_UNICODE);
    //             exit;
    //     }
    // }

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

    // public function foodsDetailed()

    // {
    //     $request    = Request::instance();
    //     $foods_list = $request->post("food_id");                     //食品ID使用；分割

    //     if(empty($foods_list))
    //     {
    //         echo $json = json_encode(array(
    //             "resultCode"=>101,
    //             "message"=>"商品查询失败"
    //             ),JSON_UNESCAPED_UNICODE);
    //         exit;
    //     }

    //     $foods_list = substr($foods_list,0,strlen($foods_list)-1);      //删除最后一个分号
    //     $food_list       = explode(";",$foods_list);                         //转换数组
    //     $data = array();

    //     foreach($food_list as $key => $val)
    //     {
    //         $data[$key] = $val;
    //     }
    //     $list       = Db::name('seller_menu')
    //         ->where('id','in',$data)
    //         ->select();

    //     $list       = json_decode( $list, true );                       //转化为纯数组

    //     if(!empty($list))
    //     {
    //         echo $json = json_encode(array(
    //             "resultCode"=>200,
    //             "message"=>"商品信息查询成功",
    //             "data"=>$list
    //             ),JSON_UNESCAPED_UNICODE);
    //         exit;
    //     }else{
    //         echo $json = json_encode(array(
    //             "resultCode"=>101,
    //             "message"=>"商品查询失败"
    //             ),JSON_UNESCAPED_UNICODE);
    //         exit;
    //     }
    // }

    /**
     * 用户对订单提交处理
     * @adminMenu(
     *     'name'   => '用户评价处理',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '用户评价处理',
     *     'param'  => ''
     * )
     */

    public function evaluate()
    {
        $data = input('post.');

        //没填写评论则不提交
        if(empty($data['user_evaluate'])){
            $this->error('您还尚未写评论');
        }

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
            $this->success('评论成功',url('user/index/order'));
            /*echo $json = json_encode(array(
                "resultCode"=>200,
                "message"=>"操作成功"
                ),JSON_UNESCAPED_UNICODE);*/
            exit;
        }else{
            $this->error('评价失败');
            /*echo $json = json_encode(array(
                "resultCode"=>103,
                "message"=>"添加评价失败"
                ),JSON_UNESCAPED_UNICODE);*/
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
        // $seller_id      = $request->param("seller_id", 0, 'intval');            //商家ID
        $seller_id      = session('seller_id');

        if(empty($seller_id))
        {
            $this->error("错误操作！");
            /*echo $json = json_encode(array(
                "resultCode"=>100,
                "message"=>"错误操作！",
                ),JSON_UNESCAPED_UNICODE);
            exit;*/
        }

        $table_list     = Db::name('food_menu')
            ->where('seller_id','eq',$seller_id)
            ->where('parent_id','eq',0)
            ->field('id,name')
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
     * 餐桌类型 AJAX请求
     * @adminMenu(
     *     'name'   => '餐桌类型 AJAX请求',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '餐桌类型 AJAX请求',
     *     'param'  => ''
     * )
     */

    public function sellerTableAjax()
    {
        $request        = Request::instance();
        $menu_id        = intval($request->post('menu_id'));   //商家服务厅ID
        $seller_id      = session('seller_id');

        if($request->isAjax() && $request->isPost()){

            if(empty($seller_id))
            {
                echo $json = json_encode(array(
                    "resultCode"=>100,
                    "message"=>"错误操作！",
                ),JSON_UNESCAPED_UNICODE);
                exit;
            }

            $table_list     = Db::name('rest')
                ->field('a.*,c.name,b.table_name,table_describe,remark')
                ->alias('a')
                ->join('__SELLER_TABLE__ b','a.table_id = b.id')
                ->join('__FOOD_MENU__ c','a.menu_id=c.id')
                ->group('a.table_id')
                ->where('a.seller_id','eq',$seller_id)
                ->where('a.menu_id','eq',$menu_id)
                ->where('a.delete_time',0)
                ->where('b.delete_time',0)
                ->select();
            $table_list   = json_decode( json_encode( $table_list ), true );//转化为纯数组

            if(!empty($table_list))
            {
                foreach ($table_list as $key => $value) 
                {
                    $where   = array(
                        'menu_id'       => $value['menu_id'],
                        'table_id'      => $value['table_id'],
                        'seller_id'     => $value['seller_id'],
                        'delete_time'   => 0,
                        'type'          => 1,
                    );

                    $count_rest = Db::name('rest')->where($where)->count();
                    $table_list[$key]['countrest'] = $count_rest;
                }

                echo $json = json_encode(array(
                    "resultCode"=>200,
                    "message"=>"查询成功！",
                    "data"=>$table_list
                ),JSON_UNESCAPED_UNICODE);
                exit;
            }else
            {
                echo $json = json_encode(array(
                    "resultCode"=>100,
                    "message"=>"未找到相关数据", //查询失败
                ),JSON_UNESCAPED_UNICODE);
                exit;
            }
        }else{
            echo $json = json_encode(array(
                "resultCode"=>100,
                "message"=>"错误操作！",
            ),JSON_UNESCAPED_UNICODE);
            exit;
        }
    }


    /**
     * 餐桌类型 AJAX请求2.0
     * @adminMenu(
     *     'name'   => '餐桌类型 AJAX请求2.0',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '餐桌类型 AJAX请求2.0',
     *     'param'  => ''
     * )
     */

    public function sellerTableAjax2()
    {
        $request        = Request::instance();
        $menu_id        = intval($request->post('menu_id'));   //商家服务厅ID
        $seller_id      = session('seller_id');

        if($request->isAjax() && $request->isPost()){

            if(empty($seller_id))
            {
                echo $json = json_encode(array(
                    "resultCode"=>100,
                    "message"=>"错误操作！",
                ),JSON_UNESCAPED_UNICODE);
                exit;
            }

            $table_list     = Db::name('rest')
                ->field('a.*,c.name,b.table_name,table_describe,remark')
                ->alias('a')
                ->join('__SELLER_TABLE__ b','a.table_id = b.id')
                ->join('__FOOD_MENU__ c','a.menu_id=c.id')
                ->group('a.tb_id')
                ->where('a.seller_id','eq',$seller_id)
                ->where('a.menu_id','eq',$menu_id)
                ->where('a.delete_time',0)
                ->where('b.delete_time',0)
                ->select();
            $table_list   = json_decode( json_encode( $table_list ), true );//转化为纯数组

            if(!empty($table_list))
            {
                echo $json = json_encode(array(
                    "resultCode"=>200,
                    "message"=>"查询成功！",
                    "data"=>$table_list
                ),JSON_UNESCAPED_UNICODE);
                exit;
            }else
            {
                echo $json = json_encode(array(
                    "resultCode"=>100,
                    "message"=>"未找到相关数据", //查询失败
                ),JSON_UNESCAPED_UNICODE);
                exit;
            }
        }else{
            echo $json = json_encode(array(
                "resultCode"=>100,
                "message"=>"错误操作！",
            ),JSON_UNESCAPED_UNICODE);
            exit;
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

        $id      = intval($request->param("id"));
		
        if(empty($id))
        {
            $this->error('餐桌ID为空');
        }
        $data = $request->param();

        $table_id  = Db::name('rest')
            ->field('a.id,tb_id,c.name,b.table_name,c.parent_id,a.menu_id')
            ->alias('a')
            ->join('__SELLER_TABLE__ b','a.table_id = b.id')
            ->join('__FOOD_MENU__ c','a.menu_id=c.id')
            ->where('a.id','eq',$id)
            ->find();
		 if(empty($table_id)){
            $this->error('未找到该餐桌',url('user/index/seller_index'));
        }
        if(empty($data['parent_id'])){
            $data['parent_id'] = $table_id['menu_id'];
        }
        $this->assign('parent_id',$data['parent_id']);
        $this->assign('table_id',$table_id);
        $this->scan_food($data);
        return  $this->fetch();
    }

    /**
     * 扫码菜品及产品列表页
     * @adminMenu(
     *     'name'   => '扫码菜品及产品列表页',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '扫码菜品及产品列表页',
     *     'param'  => ''
     * )
     */
    public function scan_food()
    {
        $child_id = 0;

        $datas = func_get_args() ;
       
        if(!empty($datas[0]['keywords'])){
            $keywords = $datas[0]['keywords'];
        }
        $appid      = session('appid');
        $where      = '';
        $seller_id  = session('seller_id');
        if(!empty($datas[0]['parent_id'])){
            $parent_id  = intval($datas[0]['parent_id']);
        }
        if(!empty($datas[0]['child_id'])){
            $child_id   = intval($datas[0]['child_id']);
        }

        if(empty($appid))
        {
            $this->error('商家appid不存在');
        }
        $foodClassdata = Db::name('food_menu')
            ->where('parent_id','eq',0)
            ->where('seller_id',$seller_id)
            ->order('list_order ASC')
            ->select();

        $foodClassdata   = json_decode( json_encode( $foodClassdata ), true );//转化为纯数组
        if(!empty($foodClassdata)){
            $parent_id = !empty($parent_id) ? $parent_id : $foodClassdata[0]['id'];
        }
        //二级菜系 及子菜系
        if(!empty($parent_id)){
            $foodChildClass = Db::name('food_menu')
                ->where('parent_id','eq',$parent_id)
                ->where('seller_id',$seller_id)
                // ->order('name ASC')  //v1.0版本
                ->order('id ASC')
                ->select();

            $foodChildClass   = json_decode( json_encode( $foodChildClass ), true );//转化为纯数组

            $this->assign('foodChildClass',$foodChildClass);
        }

        if(!empty($keywords))
        {
            $where['food_name'] = ['like',"%$keywords%"];
        }else{
             if(!empty($foodChildClass[0]['id'])){
                $child_id = $child_id ? $child_id : $foodChildClass[0]['id'];
            }
            // $where['food_class'] = $child_id;  //v1.0版本
            $where['c.id'] = $parent_id;
        }

        //当前菜系 下面的菜品
        //v1.0版本
        // $foods = Db::name('seller_menu')
        //     ->where('seller_id',$seller_id)
        //     ->where($where)
        //     ->order('food_name ASC')
        //     ->select();
        
        $foods = Db::name('seller_menu')->alias('a')
            ->join('__FOOD_MENU__ b','a.food_class=b.id')
            ->join('__FOOD_MENU__ c','b.parent_id=c.id')
            ->where('a.delete_time',0)
            ->where('a.seller_id',$seller_id)
            ->where($where)
            ->order('a.food_class ASC')
            ->field('a.*')
            ->select();
        $foods = json_decode( json_encode($foods), true );//转化为纯数组

        //当前商家服务厅列表
        // $table_list = Cache::get('table_list');
        // if($table_list == false)
        // {
        $table_list = Db::name('food_menu')
            ->where('seller_id','eq',$seller_id)
            ->where('parent_id','eq',0)
            ->where('seller_id',$seller_id)
            ->field('id,name')
            ->select();

        //     Cache::set('table_list',$table_list,3600);
        // }

        $this->assign('data',$table_list);
        $this->assign('foods',$foods);
        $this->assign('foodClassdata',$foodClassdata);
        return $this->fetch();
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

        $user               = session('user');
        $data['user_id']    = $user['id'];
        $data['seller_id']  = session('seller_id');
        $data['order_class']= intval($data['order_class']);
        $data['remarks']    = empty($data['remarks']) ? '该订单没有备注！' : $data['remarks'];

        if($data['order_class'] !== 3)
        {
            if(empty($data['food']))
            {
                $this->error('错误操作！');
                // echo $json = json_encode(array(
                // "resultCode"=>101,
                // "message"=>"错误操作！"
                // ),JSON_UNESCAPED_UNICODE);
                exit;
            }else
            {
                $food = $this->food_list($data['food']);
                array_multisort($food);

                foreach($food as $key => $val)
                {
                    $food_list[$key] = $val['id'];
                }

                $sql['id']  = array('in',$food_list);
                $food_data  = Db::name('seller_menu')->where($sql)->order('id ASC')->select();
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

                if(!empty($data['tb_id'])){
                    $result     = Db::name('rest')->field('type,order_id')->where('id',$data['tb_id'])->find();
                    if($result['type']!=1){
                        $this->error('该餐桌还有订单未完成：'.$result['order_id']);
                    }
                    $val['table_id'] = $data['tb_id'];
                }else{
                    if(empty($data['menu_id'])||empty($data['table_id'])){
                        $this->error('数据不能为空',url('user/index/seller_index'));
                    }
                    //分配对应服务厅的桌号
                    $where   = array(
                        'menu_id'       => $data['menu_id'],
                        'table_id'      => $data['table_id'],
                        'seller_id'     => $data['seller_id'],
                        'delete_time'   => 0,
                        'type'          => 1,
                    );
                    //当前订单中已经确认的座号
                    $had     = Db::name('order')->field('table_id')->whereTime('order_time','today')->where('order_complete',2)->select();
                    $in      = array();
                    if(!empty($had)){
                        foreach ($had as $vos){
                            $in[] = $vos['table_id'];
                        }
                    }

                    //
                    $id      = Db::name('rest')->field('id')->where($where)->whereNotIn('id',$in)->find();

                    if(empty($id)){
                        $this->error('座位已满');
                        // echo $json = json_encode(array(
                        //     "resultCode"=>106,
                        //     "message"=>"座位已满"
                        // ),JSON_UNESCAPED_UNICODE);
                        exit;
                    }
                    $val['table_id'] = $id['id'];
                }



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
                    'user_nub'      =>  intval($data['user_nub']), 
                    'table_nub'     =>  intval($data['table_nub']),
                    'reserve_time'  =>  strtotime($data['reserve_time']),
                    'tel'           =>  $data['tel'],
                    'user_name'     =>  $data['user_name'],
                    'reserve_class' =>  intval($data['reserve_class']),
                    'menu_id'       =>  intval($data['menu_id']),
                ];

            $res = Db::name('seller_reserve')->insert($value);
        }

        if(!empty($result))
        {
            if($data['order_class'] !== 3)
            {
                //改变服务厅餐桌 状态及订单号
                $infoup = array(
                            'order_id' => $val['order_id'], 
                            'type' => 2, 
                        );
                $res = Db::name('rest')->where('id','eq',$val['table_id'])->update($infoup);

                $user = session('user');
                $role_use = Db::name('role_user')->where('user_id',$user['id'])->find();

                if(!empty($role_use)){
                    $print  =  new IndexController();
                    $print->auto($val['order_id'],2);
                }
                session('shopping['.$data['user_id'].']',null);

                $this->success('下单成功',url('user/index/order'));
            }else{
                $this->success('预订提交成功! 等待商家确认',url('user/index/reserve',['status'=>1]));
            }
            exit;
        }else
        {
            if($data['order_class'] !== 3)
            {
                $this->error('下单失败');
            }else
            {
                $this->error('预订提交失败');
            }
            exit;
        }

        return $this->fetch();
    }

    /**
     * 用户加菜改单
     * @adminMenu(
     *     'name'   => '用户加菜改单',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '用户加菜改单',
     *     'param'  => ''
     * )
     */
    public function updated_order()
    {
        /*
         * 初步需要的参数：
         * 订餐类型order_class,1
         * 商家号seller_id,10
         * 用户user_id,1
         * 订单状态pay,1:未支付;2:已支付;3:确认;4:拒绝订单;5:未评价;6:已评价'
         * 食物food,13*1;15*1;17*1;20*1;
         * */
        $data = input('post.');

        $this->ifempty($data);

        $user               = session('user');
        $order_id           = session('addfood_order_id');
        $user_id            = $user['id'];
        $seller_id          = session('seller_id');

        if(!empty($order_id))
        {
            $order  = Db::name('order')->where('order_id','eq',$order_id)->field('food')->find();

            if(empty($data['food']) || empty($order))
            {
                $this->error('错误操作！');
                // echo $json = json_encode(array(
                // "resultCode"=>101,
                // "message"=>"错误操作！"
                // ),JSON_UNESCAPED_UNICODE);
                exit;
            }else
            {
                $request['food'] = $this->food_list($data['food']);
                $data['food'] = $order['food'].$data['food'];
                $food = $this->food_list($data['food']);

                //对商品排除重复 用其它数组赋值
                $foodid_two = array();
                $foodnub_two = array();
                foreach ($food as $key => $val) {
                    if(in_array($val['id'],$foodid_two))
                    {
                        $subscript = array_search($val['id'],$foodid_two);
                        $foodnub_two[$subscript] = intval($foodnub_two[$subscript]+$val['food_nub']); 
                    }else{
                        $foodid_two[] = $val['id'];
                        $foodnub_two[] = $val['food_nub'];
                    }
                }

                //对商品id 商品数量重新组合成数组
                $food = array();
                $data['food'] = '';
                foreach($foodid_two as $key => $val)
                {
                    $food[$key]['id'] = $val;
                    $food[$key]['food_nub'] = $foodnub_two[$key];

                    $data['food'] .= $food[$key]['id'].'*'.$food[$key]['food_nub'].';';
                }

                foreach($food as $key => $val)
                {
                    $food_list[$key] = $val['id'];
                }

                array_multisort($food);

                $sql['id']  = array('in',$food_list);
                $food_data  = Db::name('seller_menu')->where($sql)->order('id ASC')->select();
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

            $val=
                [
                    'food'          =>  $data['food'],
                    'food_type'     =>  0,
                    'order_price'   =>  $order_price,
                    'discount_price'=>  $order_discount_price,
                ];

            if(!empty($val))
            {             
                $result = Db::name('order')->where('user_id',$user_id)->where('seller_id',$seller_id)->where('order_id',$order_id)->where('pay',1)->update($val);
            }
        }

        if(!empty($result))
        {
            Session::delete('addfood_order_id');
            session('shopping['.$user_id.']',null);

            $this->printAdd($request,$order_id);  // 加菜成功后，后厨出加菜订单小票

            $this->success('加菜成功',url('user/index/order'));
            // echo $json = json_encode(array(
            //     "resultCode"=>200,
            //     "message"=>"下单成功"
            //     ),JSON_UNESCAPED_UNICODE);
            exit;
        }else
        {
            $this->error('加菜失败',url('user/index/order'));
            // echo $json = json_encode(array(
            //     "resultCode"=>106,
            //     "message"=>"下单失败"
            //     ),JSON_UNESCAPED_UNICODE);
            exit;
        }

        return $this->fetch();
    }

    /**
     * 点餐台主页
     * @adminMenu(
     *     'name'   => '点餐台主页',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '点餐台主页',
     *     'param'  => ''
     * )
     */
    // public function index()
    // {
    //     return $this->fetch();
    // }


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

        $request    = Request::instance();
        $appid      = session('appid');

        if(!is_string($appid))
        {
            $this->error("错误的appid");
            /*echo $json = json_encode(array(
                "resultCode"=>110,
                "message"=>"错误的appid"
                ),JSON_UNESCAPED_UNICODE);
            exit;*/
        }

        $data = Db::name('seller')->alias('a')
            ->join('__SELLER_MENU__ b','a.id = b.seller_id')
            ->join('__FOOD_MENU__ c','b.food_class = c.id')
            ->field('a.*,c.id as food_menu_id,c.*,b.*')
            ->where('a.appid','eq',$appid)
            ->where('b.delete_time','eq',0)
            ->order('c.name ASC')
            ->limit(4)
            ->select();
        $data   = json_decode( json_encode( $data ), true );//转化为纯数组

        session('seller_id',$data[0]['seller_id']);

        //商家 幻灯片广告图
        $seller_advert = array();
        if(!empty($data))
        {
            $seller_advert = explode(';',$data[0]['seller_advert']);
            array_pop( $seller_advert);
        }

        //一级菜系名称
        $menu = Db::name('seller')->alias('a')
            ->join('__FOOD_MENU__ c','a.id = c.seller_id')
            ->field('c.*')
            ->where('a.appid','eq',$appid)
            ->where('c.parent_id','eq',0)
            ->order('c.list_order')
            ->select();
        $menu   = json_decode( json_encode( $menu ), true );//转化为纯数组

        // $jssdk = new JSSDK($this->appId, $this->appSecret);
        // $signPackage = $jssdk->GetSignPackage();
        $signPackage = array('appId' => '' , 'timestamp' => '', 'nonceStr' => '' , 'signature' => '');

        $this->assign('signPackage',$signPackage);              // wx.Config 配置信息
        $this->assign('menu',$menu);
        $this->assign('seller_advert',$seller_advert);
        $this->assign('data',$data);
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

    // public function payJoinfee()
    // {
    //     $request        = Request::instance();
    //     $order_id       = $request->post('order_id');                           //获取用户订单ID
    //     $openid         = $request->post('openid');                             //用户Openid

    //     $this->ifempty($openid);
    //     $this->ifempty($order_id);

    //     $price = Db::name('order')->where('order_id','eq',$order_id)->value('discount_price');

    //     if(empty($price))
    //     {
    //         $this->error("支付失败");
    //         /*echo $json = json_encode(array(
    //         "resultCode"=>110,
    //         "message"=>"支付失败"            
    //         ),JSON_UNESCAPED_UNICODE);
    //         exit;*/
    //     }

    //     $appid='wx4fdc5885c2c4ad8c';
    //     $mch_id='1491561782';
    //     $key='57b4e182423d02bd50f25c6507b880d7';
    //     // $openid='oKKb00KIIZt7e5ZMWWokcqq6y5jc';  //前端传输

    //     import('WeixinPay',EXTEND_PATH);
    //     $weixinpay = new \WeixinPay($appid,$openid,$mch_id,$key,$price,$order_id);
    //     $return=$weixinpay->pay();
    //     $data['order']  = $order_id;
    //     $data['return'] = $return;
    //     //$this->assign('data',$data);
    //     //return $this->fetch();
    //     echo $json = json_encode(array(
    //         "resultCode"=>200,
    //         "message"=>"调起支付信息", 
    //         "data"=>$data          
    //         ),JSON_UNESCAPED_UNICODE);
    //     exit;
    // }

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
            'user'  => $data['user'],
            'pass'  => $data['pass'],
            'appid' => $data['appid']
        );
        $result = $this->validate($arr,'waiter');
        if(!$result){

            $this->error($result);
            // echo $json = json_encode(array(
            //     "resultCode"=>110,
            //     "message"=>$result
            // ),JSON_UNESCAPED_UNICODE);
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
                /*if ($result["id"] != 1 && (empty($groups) || empty($result['user_status']))) {
                    $this->error(lang('USE_DISABLED'));
                }*/
                //登入成功页面跳转
                session('ADMIN_ID', $result["id"]);
                session('name', $result["user_login"]);
                session('user', $result);
                session('user_type', 2);
                session('appid', $data['appid']);
                
                $seller_data = Db::name('seller')->alias('a')->where('a.appid','eq',$data['appid'])->field('id')->find();
				if(!empty($seller_data))
				{
					session('seller_id', $seller_data['id']);
				}
                
                $result['last_login_ip']   = get_client_ip(0, true);
                $result['last_login_time'] = time();
                $token                     = cmf_generate_user_token($result["id"], 'web');
                if (!empty($token)) {
                    session('token', $token);
                }
                Db::name('user')->update($result);
                $this->success('登录成功',$data['CallbackUrl']);
                // echo $json = json_encode(array(
                //     "resultCode"=>200,
                //     "message"=>"登录成功",
                // ),JSON_UNESCAPED_UNICODE);
                exit;
            } else {
                $this->error('用户名密码错误');
                // echo $json = json_encode(array(
                //     "resultCode"=>110,
                //     "message"=>"用户名密码错误",
                // ),JSON_UNESCAPED_UNICODE);
                exit;
            }
        } else
        {
            $this->error('系统找不到此用户名');
            // echo $json = json_encode(array(
            //     "resultCode"=>110,
            //     "message"=>"用户名密码错误",
            // ),JSON_UNESCAPED_UNICODE);
            exit;
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
        if(!empty($data['type'])){
            if($data['type']==2){
                $this->WaiterLogin($data);
                exit;
            }
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
     * 微信登录
     */
     public function WeChatto(){
        session('tokenState',null);
        $request = Request::instance();
        $data    = $request->param();

        if(empty($data) || empty($data['appid']))
        {
            $this->error("缺少商家APPID！");
        }

        $domain  = $request->domain();
        $redirect_uri = urlencode($domain."/api/index.php/wxapp/Public/login/");
        $appid   = $this->appId;
        // $_tokenState  = md5(date('Ymdhis'));
        $HTTP_REFERER = $_SERVER['HTTP_REFERER'];
        $HTTP_url     = $request->url(true);
        $_tokenState = $HTTP_REFERER ? $HTTP_REFERER : $HTTP_url ;
        session('tokenState',$_tokenState);
        if(!empty($data)){
            session('appid', $data['appid']);

            $seller_data = Db::name('seller')->alias('a')->where('a.appid','eq',$data['appid'])->field('id')->find();
            if(!empty($seller_data))
            {
                session('seller_id', $seller_data['id']);
            }
        }
        header('Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$redirect_uri.'&response_type=code&scope=snsapi_userinfo&state='.$_tokenState.'#wechat_redirect');
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
        $request    = Request::instance();
        $user       = session('user');
        $seller_id  = session('seller_id');  //商家ID
        $user_id    = $user['id']; //第三方用户ID
        $complete   = intval($request->param("complete"));
        $id         = $request->param("id"); //预订订单ID
        $status     = intval($request->param("status")); //状态 1：当前预订  2：预订历史
        $where      = '';

        if(empty($seller_id) or empty($user_id))
        {
            $this->error("错误操作！");
        }

        if($complete == 4 && !empty($id))
        {
            $result = Db::name('seller_reserve')->where('seller_id','eq',$seller_id)->where('user_id','eq',$user_id)->where('id','eq',$id)->update(['complete'=>4]);

            $this->success("取消成功！");
        }

        if($status == 1)
        {
            $where['a.seller_confirm'] = ['eq',1]; 
            $where['a.complete']       = ['eq',1];

        }elseif ($status == 2) 
        {
            $whereOr['a.complete']       = ['neq',1];
        }

        $data = Db::name('seller_reserve')->alias("a")
                ->join('__SELLER_TABLE__ c', 'a.reserve_class = c.id')
                ->join('__FOOD_MENU__ e', 'e.id = a.menu_id')
                ->where('a.seller_id','eq',$seller_id)
                ->where('a.user_id','eq',$user_id)
                ->where($where)
                ->field('a.id,a.user_name,a.reserve_time,a.seller_confirm,a.complete,c.table_name,e.name as menu_name')
                ->order('a.reserve_time DESC')
                ->select();

        $this->assign('data',$data);
        return $this->fetch();     
    }

    /**
     * 预约订单-详细
     * @adminMenu(
     *     'name'   => '预约订单-详细',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '预约订单-详细',
     *     'param'  => ''
     * )
     */
    public function reserve_detailed()
    {
        $request = Request::instance();
        $user    = session('user');
        $seller_id = session('seller_id');  //商家ID
        $user_id   = $user['id']; //第三方用户ID
        $id        = $request->param("id"); //预订订单ID

        if(empty($seller_id) or empty($user_id) or empty($id))
        {
            $this->error("错误操作！");
        }

        $data = Db::name('seller_reserve')->alias("a")
                ->join('__ORDER__ b', 'a.id =b.order_id')
                ->join('__SELLER_TABLE__ c', 'a.reserve_class = c.id')
                ->join('__FOOD_MENU__ e', 'e.id = a.menu_id')
                ->join('__SELLER__ f','f.id=a.seller_id')
                ->where('a.seller_id','eq',$seller_id)
                ->where('a.user_id','eq',$user_id)
                ->where('a.id','eq',$id)
                ->field('a.*,b.remarks,c.table_name,e.name as menu_name,f.seller_nickname')
                ->find();

        $this->assign('data',$data);
        return $this->fetch();     
    }

    /**
     * 会员卡管理
     * @adminMenu(
     *     'name'   => '会员卡管理',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '会员卡管理',
     *     'param'  => ''
     * )
     */
    public function user_card()
    {
        $request    = Request::instance();
        $user       = session('user');
        $seller_id  = session('seller_id');  //商家ID
        $user_id    = $user['id']; //第三方用户ID
        $data       = '';

        if(empty($seller_id) or empty($user_id))
        {
            $this->error("错误操作！");
        }

        $seller_data = Db::name('seller')->where('id','eq',$seller_id)->field('appid')->find();
        if(!empty($seller_data))
        {
            $data = Db::name('user_card')->alias("a")
                ->join('__THIRD_PARTY_USER__ b', 'a.user_id = b.user_id')
                ->join('__USER_LEVEL__ c', 'a.user_lv = c.id')
                ->where('b.app_id','eq',$seller_data['appid'])
                ->where('a.user_id','eq',$user_id)
                ->field('a.*,c.grade_name')
                ->select();
        }

        $this->assign('data',$data);
        return $this->fetch();     
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
        array_unique($data);

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
                ->where('order_class','neq',3)
                ->order('order_time DESC')
                ->select();
        }elseif ($order_pay==5)
        {
            $data = Db::name('order')
                ->where('user_id','eq',$user_id)
                ->where('pay','EGT',4) 
                ->where('user_evaluate',['eq','该用户尚未评价！'],['eq',''],'or')
                ->where('seller_id','eq',$seller_id)
                ->where('order_class','neq',3)
                ->order('order_time DESC')
                ->select();
        }
        else
        {
            $data = Db::name('order')
                ->where('user_id','eq',$user_id)
                ->where('pay','eq',$order_pay)
                ->where('seller_id','eq',$seller_id)
                ->where('order_class','neq',3)
                ->order('order_time DESC')
                ->select();
        }

        foreach($data as $key => $val)
        {
            $food_b = $this->food_list($val['food']);

            if(!empty($food_b))
            {
                $food_list[$key] = Db::name('seller_menu')
                    ->where('id','eq',$food_b[0]['id'])
                    ->find();

                $data[$key] = array_merge((array)$val,(array)$food_list[$key]);
            }

        }

        $this->assign('data',$data);
        return $this->fetch();
    }

    /**
     * 判断是否为空
     * @param $data
     */
    function ifempty($data)
    {
        if(empty($data))
        {
            $this->error('错误操作！未找到相关数据');
            // echo $json = json_encode(array(
            //     "resultCode"=>100,
            //     "message"=>"错误操作！"
            // ),JSON_UNESCAPED_UNICODE);
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
        $notifyUrl      = 'http://'.$_SERVER["HTTP_HOST"].'/userajax/return_url';
        $result = $aopsdk->phone($subject,$out_trade_no,$total_amount,$quit_url,$product_code,$seller_id,$body='',$notifyUrl);
        if($result['code']==1111)
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
