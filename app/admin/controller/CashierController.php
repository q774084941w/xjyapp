<?php
// +----------------------------------------------------------------------
// | XjyApplet [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright © 2016-2026 AII Rights Reserved  http://www.ccapp.com.cn/
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +---------------------------------------------------------------------
// | Author: 小谢 < 774084941@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use API_PHP\APIPHP;
use Barpay\f2fpay\Barpay;
use cmf\controller\AdminBaseController;
use think\Db;
use think\Validate;
use WxpayAPI\example\JsApiPay;
use WxpayAPI\example\NativeNotifyCallBack;

class CashierController extends AdminBaseController
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
     * 收银系统模块主页
     * @adminMenu(
     *     'name'   => '收银管理',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '收银管理',
     *     'param'  => ''
     * )
     */

    public function index()
    {
        $request        = $this->request->param();
        $where          = [];
        $menu_id        = intval($this->request->param("menu_id"));
        $type        = intval($this->request->param("type"));

        if (!empty($request['request']))
        {
            dump($request);exit;
        }





        if(cmf_get_current_admin_id() != 1)
        {
            $where['a.seller_id'] = $this->admin_user_id;
        }

        if (!empty($menu_id))
        {
            $where['a.menu_id'] = $menu_id;
        }

        $keywordComplex = [];
        if (!empty($request['keyword']))
        {
            $keyword = $request['keyword'];
            $keywordComplex['b.order_id']  = ['like', "%$keyword%"];
        }


        if(!empty($request['table']))
        {
            $where['a.tb_id'] = ['eq',$request['table']];
        }

        $rest = Db::name('rest');

        if(!empty($request['type']))
        {
            $rest->where('a.type',$request['type']);
        }


        $data = $rest
            ->distinct(true)
            ->field('a.*,c.name,d.table_name')
            ->alias('a')
            // ->join('__ORDER__ b','a.id=b.table_id','LEFT')
            ->join('__FOOD_MENU__ c','c.id=a.menu_id','LEFT')
            ->join('__SELLER_TABLE__ d','d.id=a.table_id','LEFT')
            ->where('a.delete_time',0)
            ->whereOr($keywordComplex)
            ->where($where)
            ->order("a.tb_id ASC")
            ->paginate(15);
        $data->appends($request);
        $page = $data->render();
        $this->assign('id',session('ADMIN_ID'));
        $this->assign("order", $data);
        $this->assign("page",$page);

        //统计餐桌信息
        $cmodel = model('Rest');
        $table_type = $cmodel->cuntAll($keywordComplex,$where);
        $narr = array();
        foreach ($table_type as $val)
        {
            $narr[$val['type']] = $val['number'];
        }
        $this->assign('all_table_type',$narr);

        //服务厅列表
        $model = model('FoodMenu');
        $menu = $model->index();
        $this->assign('menu',$menu);
        $this->assign('menu_id',$menu_id);
        $this->assign('type',$type);

        $page = $this->request->param('page');
        if (empty($page))
        {
            $begin_order_id = $this->request->param('order');
            $this->assign('begin_order_id',$begin_order_id);
        }
        return $this->fetch();
    }


    /**
     * 收银台结算
     * @adminMenu(
     *     'name'   => '收银台结算',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '收银台结算',
     *     'param'  => ''
     * )
     */
    public function search()
    {
        $id = $this->request->param("id");
        if (!empty($id))
        {
            $order_id = $id;
        }
        if (empty($order_id))
        {
            $this->error('订单号不能为空！');
        }
        else
        {
            $model = model('order');
            $order = $model->index($order_id);

            if (empty($order))
            {
                $this->error('订单号不存在！');
            }
            elseif ($order['seller_id'] == session('ADMIN_ID') or cmf_get_current_admin_id() == 1 or session('admin_parent_id') != 1)
            {
                $delivery1  = Db::name('delivery_type')->select();

                if ($order['order_class'] == 2)
                {
                    $delivery   = Db::name('delivery_type')
                        ->where(["delivery_id" => $order['delivery_type']])
                        ->find();
                    $this->assign('delivery',$delivery);
                }

                elseif ($order['order_class'] == 3)
                {
                    $reserve    = Db::name('seller_reserve')
                        ->where(["id" => $order['order_id']])
                        ->find();
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

                $seller_menu= Db::name('seller_menu')
                    ->where(['seller_id'=>$order['seller_id']])
                    ->where('delete_time','eq',0)
                    ->select();
                $table      = Db::name('seller_table')
                    ->where(['seller_id'=>$order['seller_id']])
                    ->where('delete_time','eq',0)
                    ->select();

                $this->assign('table',$table);
                $this->assign('seller_menu',$seller_menu);

                $this->assign('order',$order);
                $this->assign('delivery1',$delivery1);

                return $this->fetch();
            }
            else
            {
                $this->error("操作越权！");
            }
            return $this->fetch();
        }
    }






    /**
     * 是否扫码
     * @param $data
     */
    protected function Auth_code($data)
    {
        if (empty($data['auth_code']))
        {
            $this->error('未扫码');
        }
    }


    /**
     * 结算接口
     * @adminMenu(
     *     'name'   => '结算接口',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '结算接口',
     *     'param'  => ''
     * )
     */
    public function Settlement()
    {
        $url = array(
            'cashier/index'
        );
        if ($this->request->isPost())
        {

            $return = '';
            $request  = $this->request->param();

            //合并支付
            if (empty($request['order_pay_class']))
            {
                $result = $this->validate($request['order'],'cashier.no_pass');

                if (true !== $result)
                {
                    $this->error($result);
                }
            }
            else
            {
                return $this->order_pay_class($request,$url);

            }


            $type=1;

            if (!empty($request['pass']['discount']))
            {
                $type=2;

                $result = $this->validate($request['pass'],'cashier.have_pass');

                if (true !== $result)
                {
                    $this->error($result);
                }

                $pass   = $request['pass'];
            }



            $data   = $request['order'];

            $discount_price = Db::name('order')
                ->field('order_price,discount_price')
                ->where('order_id',$data['order_id'])
                ->find();

            //查出商品原价

            $yes_check = empty($discount_price['discount_price']) ? $discount_price['order_price'] : $discount_price['discount_price'];
            $no_check  = 0;
            //计算出打折商品总价
            $old = 0;
            if (!empty($request['checkItem']))
            {
                foreach ($request['checkItem'] as $val)
                {
                    $arr = explode(',',$val);
                    if (!empty($arr[0]) && !empty($arr[1]))
                    {
                        $old += $arr[0]*$arr[1];
                    }
                }
                $no_check = $yes_check-$old;
            }

            //对应该打折的商品打折
            switch ($type)
            {
                case 2:
                    if ($pass['to_password']!=1)
                    {
                        $this->error('打折授权密码验证失败',$url[0]);
                    }
                    $now_price = $old*$pass['discount']/100;
                    $price['discount'] = $pass['discount'];
                    break;
                default:
                    $now_price  = $yes_check;
            }
            $data['order_price'] = $now_price;

            if (!empty($no_check))
            {
                $now_price += $no_check;
            }

            //暂定的优惠劵方案
            $now_price          -= $request['Coupons'];

            $price['coupon']     = $request['Coupons'] ? $request['Coupons'] : 0 ;
            $price['price']      = $now_price;
            $price_discount      = empty($pass['discount'])?0:$pass['discount'];
            $price_number        = $yes_check-$now_price;

            //order表的修改数据
            $arr=array(
                'coupon'         => $request['Coupons'],
                'price_number'   => $price_number,
                'price_discount' => $price_discount,
                'price_receipts' => $now_price,
                'pay_class'      => $data['pay_class'],
                'pay'            => '4',
                'order_complete' => '4',
                'end_time'       => time(),
                'cashier'        => session('ADMIN_ID'),
            );
            $type = true;//状态
            /*switch ($data['pay_class']){
                //支付宝
                case 1:
                    $this->Auth_code($data);
                    $result = $this->Alipay($data);
                    if($result===true){
                        $type = $result;
                    }else{
                        $return = $result;
                    }
                    Db::name('user')
                        ->where('id',session('ADMIN_ID'))
                        ->setInc('Alipay_RMB',$data['order_price']);
                    break;
                //微信
                case 2:
                    $this->Auth_code($data);
                    $type=$this->WeChat($data);
                    if($type){
                        $arr['order_num'] = $type['out_trade_no'];
                    }
                    //往账户中添加总金额
                    Db::name('user')
                        ->where('id',session('ADMIN_ID'))
                        ->setInc('user_RMB',$data['order_price']);
                    break;
                //银联
                case 3:
                    $this->UnionPay($data);
                    //往账户中添加总金额
                    break;
                //vip卡
                case 5:

                break;
                //现金
                default:
                    $this->Record('Cash',$data['order_price']);
                    $type = true;
                    break;
            }*/
            //vip卡暂定的计算方式
            if($data['pay_class']==5){
                if(empty($data['auth_code'])){
                    $this->error('缺少卡号',$url[0]);
                }
                $vip  = $this->VIP_card($data);
                $arr['price_number']   += $yes_check - $vip['price'];
                $vip_price_discount     = $vip['discount'];
                if(!empty($price_discount)){
                    $vip_price_discount  *= $price_discount;
                }
                $arr['price_discount']  = $vip_price_discount;
                $arr['price_receipts']  = $vip['price']+$no_check;
            }


            if($type){
                //更改订单表数据
                if(Db::name('order')->where('order_id',$data['order_id'])->update($arr) !== false)
                {
                    $order_id = $data['order_id'];
                    $data = Db::name('order')->where('order_id','eq',$data['order_id'])->field('table_id')->find();
                    
                    if(!empty($data))
                    {
                      Db::name('rest')->where('id','eq',$data['table_id'])->update(['type'=>1]);
                    }

                    if(!empty($vip['price'])){
                        $price['price'] = $vip['price'];
                        $price['discount'] =   $arr['price_discount'];
                    }

                    //结算打印
                    $result = $this->theLastPrint($order_id,$price);

                    if(!empty($vip)){
                        $this->success("支付成功！余额为".$vip['user_RMB'], url($url[0]));
                    }
                    $this->success("支付成功！", url($url[0]));
                }else
                {
                    $this->error("支付失败！",url($url[0]));
                }
            }else{
                $this->error('支付失败'.$return);
            }
        }
        else
        {
            $this->error("错误操作！",url($url[0]));
        }
    }



    /**
     * 支付宝接口
     * @adminMenu(
     *     'name'   => '支付宝接口',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '支付宝接口',
     *     'param'  => ''
     * )
     */
    public function Alipay($num){
        $outTradeNo    =  "barpay" . date('Ymdhis') . mt_rand(100, 1000);
        $totalAmount   =  $num['order_price']; //此处单位为元，精确到小数点后2位
        $authCode      =  $num['auth_code'];
        $subject       =  '美食城消费';
        $body          =  '消费共'.$num['order_price'].'元';
        $operatorId    =  '110';   //商户操作员编号
        $alipayStoreId =  "";   //支付宝的店铺编号
        $appAuthToken  =  "";  //第三方应用授权令牌 //test_alipay_store_id
        $Alipay        =  new Barpay();
        $result        =  $Alipay->barPay($outTradeNo,$totalAmount,$authCode,$subject,$body,$operatorId,$alipayStoreId,$appAuthToken,$providerId='',$timeExpress = "5m",$undiscountableAmount = "0.01",$goodsDetailList = array(),$storeId = "");
        if($result['code']==1000){
            $this->Record('Alipay',$num['order_price']);
            return true;
        }else{
            return $result['sub_msg'];
        }
    }

    /**
     * 微信接口
     * @adminMenu(
     *     'name'   => '微信接口',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '微信接口',
     *     'param'  => ''
     * )
     */
    public function WeChat($num){
        $Wxpay = new NativeNotifyCallBack();
        $body   = '川味印象-美食城';
        $total_fee = $num['order_price']*100;  //单位为分，
        //$total_fee = 1;  //单位为分，
        $auth_code  = $num['auth_code'];
        $result=$Wxpay ->NATIVE($goods_tag = '', $total_fee, $attach = '', $body,$auth_code);
        if(!$result){
            $this->Record('WeChat',$num['order_price']);
            return false;
        }else{
            return $result;
        }
    }

    /**
     * TODO  银联接口还未完成
     * 银联接口
     * @adminMenu(
     *     'name'   => '银联接口',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '银联接口',
     *     'param'  => ''
     * )
     */
    public function UnionPay($num){
        $this->error('功能尚未完善，敬请期待');
        exit;
        $this->Record('WeChat',$num['order_price']);
    }

    /**
     * 记录每种方式每天的收银情况
     * @param $field 字段
     * @param $price 增加值
     */
    public function Record($field,$price){
        $seller_id = $this->admin_user_id;
        $time       = session('today');
        if(date('Y-m-d') == date('Y-m-d',$time)){
            $record_id  = session('record_id');
            if(empty($record_id)){
                $record_id=Db::name('user_balance')
                    ->field('record_id')
                    ->where('seller_id',$seller_id)
                    ->whereTime('time','today')
                    ->find();
                if(empty($record_id)){
                    $arr = array(
                        'seller_id' => $seller_id,
                        'time'      => time()
                    );
                    $record_id['record_id'] = Db::name('user_balance')->insertGetId($arr);
                }
                session('record_id',$record_id['record_id']);
                $record_id = session('record_id');
            }
        }else{
            $record_id=Db::name('user_balance')
                ->field('record_id')
                ->where('seller_id',$seller_id)
                ->whereTime('time','today')
                ->find();
            if(empty($record_id)){
                $arr = array(
                    'seller_id' => $seller_id,
                    'time'      => time()
                );
                $record_id['record_id'] = Db::name('user_balance')->insertGetId($arr);
            }
            session('record_id',$record_id['record_id']);
            session('today',time());
            $record_id = session('record_id');
        }
        $old    = Db::name('user_balance')->where('record_id',$record_id)->value($field);
        $result = Db::name('user_balance')
                    ->where('record_id',$record_id)
                    ->update(array("$field"=>($old*100+$price*100)/100));

        $oldPrice = Db::name('user')->where('id',$seller_id)->value('user_RMB');
         Db::name('user')->where('id',$seller_id)->update(array('user_RMB'=>($oldPrice*100+$price*100)/100));

    }

    /**
     * VIP接口
     * @adminMenu(
     *     'name'   => 'VIP接口',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => 'VIP接口',
     *     'param'  => ''
     * )
     */
    public function VIP_card($data){
        $oldOne = Db::name('user')
                    ->alias('a')
                    ->join('__USER_CARD__ b','b.user_id=a.id')
                    ->join('__USER_LEVEL__ c','b.user_lv=c.id')
                    ->field('b.id,b.user_RMB,c.discount,c.grade_name')
                    ->where('b.card_number',$data['auth_code'])
                    ->find();
        if (empty($oldOne))
        {
            $this->error('未找到该卡绑定的用户');
        }

        if (($oldOne['user_RMB']*100)<($data['order_price']*$oldOne['discount']))
        {
            $this->error('您的余额不足;余额为:'.$oldOne['user_RMB']);
        }


        $price = ($data['order_price']*$oldOne['discount']);
        $oldOne['user_RMB'] = (($oldOne['user_RMB']*100)-$price)/100;

        $resturn = $oldOne;
        array_pop($oldOne);
        array_pop($oldOne);
        $result = Db::name('user_card')
            ->where('id',$oldOne['id'])
            ->update(array('user_RMB'=>$oldOne['user_RMB']));
        $resturn['price'] = $price/100;
        if($result)
        {
            $this->Record('VIP_card',($price/100));
            return $resturn;
        }
        else
        {
            $this->error('执行失败');
        }
    }

    /**
     * 添加菜单
     * @adminMenu(
     *     'name'   => '添加菜单',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加菜单',
     *     'param'  => ''
     * )
     */
    public function addFood(){
        if($this->request->isPost()){
            $request = $this->request->param();
            $order_id = $request['order_id'];
            if(empty($request['food'])){
                $this->error('你未选择菜品',url('cashier/index'));
            }
            $arr = array();
            foreach($request['food'] as $val){
                $arr[$val] = $request['number'][$val];
            }
            if(empty($arr)){
                $this->error('你未选择输入数量',url('cashier/index'));
            }

            //订单数据更改
            $food_order = Db::name('order')->where('order_id',$order_id)->field('food')->find();
            $food_order = explode(";", $food_order['food']);
            array_pop($food_order);
            foreach ($food_order as $k => $u)
            {
                $strarr = explode("*", $u);
                foreach ($strarr as $key => $newstr)
                {
                    if ($key == 0)
                    {
                        $food[$k]['id'] = $newstr;
                    }
                    else
                        {
                        if(!empty($arr[$food[$k]['id']]))
                        {
                            $newstr += $arr[$food[$k]['id']];
                            unset($arr[$food[$k]['id']]);
                        }
                        $food[$k]['nub'] = $newstr;
                    }
                }
            }

            $food_list = '';
            if(!empty($arr)){
                foreach ($arr as $key=>$val){
                    $food[]  = array(
                        'id'  => $key,
                        'nub' => $val,
                    );
                }
            }

            $food_order = '';
            foreach ($food as $val){
                $food_order .= implode('*',$val).';';

                $food_list[] = $val['id'];
            }

            array_multisort($food);

            //重新计算价格
            $sql['id']  = array('in',$food_list);
            $food_data  = Db::name('seller_menu')->where($sql)->order('id ASC')->select();
            $order_price = 0;
            $order_discount = 0;
            $order_discount_price = 0;

            foreach ($food_data as $key => $value) 
            {
                $order_price += $value['price']*$food[$key]['nub'];
                $order_discount += $value['discount']*$food[$key]['nub'];
            }

            $order_discount_price += $order_price - $order_discount;

            $val_array =
                [
                    'food'          =>  $food_order,
                    'food_type'     =>  0,
                    'order_price'   =>  $order_price,
                    'discount_price'=>  $order_discount_price,
                ];
            
            $result = Db::name('order')->where('order_id',$order_id)->update($val_array);

            if($result){

                $this->printAdd($request,$order_id);
                $this->error('添加成功',url('cashier/index',array('order'=>$order_id)));
            }else{
                $this->error('添加失败',url('cashier/index'));
            }
        }else{
            $this->error('错误操作',url('cashier/index'));
        }
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
        foreach ($request['food'] as $key=>$val)
        {
            $arr[$key]['id'] = $val;
            $arr[$key]['num'] = $request['number'][$val];
            $in[] = $val;
        }

        $sql['id'] = array('in', $in);
        $data = Db::name('seller_menu')
            ->field('food_name,id,price,food_class')
            ->where($sql)
            ->select();
        $in = array();
        foreach ($data as $key=>$val)
        {
            foreach ($arr as $k=>$v)
            {
                if ($v['id']==$val['id'])
                {
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
               
            $order['thisTitle']     = '加菜订单';
            $all['food_all']        = $newArr;
            $all['order']           = $order;
            $all['order']['times']  = 2;

        $apiphp = new APIPHP();
         return $apiphp->combination($all);
    }



    /**
     * 支付完成打印
     * @adminMenu(
     *     'name'   => '支付完成打印',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '支付完成打印',
     *     'param'  => ''
     * )
     */
    public function theLastPrint($order_id,$price)
    {
        $order = Db::name('order')
            ->alias('a')
            ->join('__REST__ b','a.table_id=b.id')
            ->join('__FOOD_MENU__ c','b.menu_id=c.id')
            ->field('a.food,c.name,a.remarks,a.order_price,a.order_time,a.order_id,b.tb_id,a.end_time,a.pay_class,b.menu_id')
            ->where('a.order_id', $order_id)
            ->find();
        switch ($order['pay_class'])
        {
            case 1:
                $order['pay_class']='支付宝';
                break;
            case 2:
                $order['pay_class']='微信';
                break;
            case 3:
                $order['pay_class']='银联';
                break;
            case 4:
                $order['pay_class']='现金';
                break;
            case 5:
                $order['pay_class']='vip卡';
                break;
            default:
                $order['pay_class']='其它`';
        }
        $menu_id = $order['menu_id'];
        $order['food'] = explode(";", $order['food']);
        $id = array();
        $food = array();
        array_pop($order['food']);
        //挑出菜单
        foreach ($order['food'] as $k => $u)
        {
            $strarr = explode("*", $u);
            foreach ($strarr as $key => $newstr)
            {
                if ($key == 0)
                {
                    $food[$k]['id'] = $newstr;
                    $id[] = $newstr;
                }
                else
                {
                    $food[$k]['num'] = $newstr;
                }
            }
        }

        $sql['id'] = array('in', $id);
        $data = Db::name('seller_menu')
            ->field('food_name,id,price,food_class')
            ->where($sql)
            ->select();

        foreach ($data as $kay=>$val)
        {
            foreach ($food as $k=>$v)
            {
                if ($v['id']==$val['id'])
                {
                    $food[$k]['title'] = $val['food_name'];
                    $food[$k]['price'] = $val['price'];
                    $food[$k]['food_class'] = $val['food_class'];
                    break;
                }
            }

        }
        $order['coupon']        = $price['coupon'];
        $order['price']         = $price['price'];
        $order['grade_name']    = empty($price['grade_name'])?null:$price['grade_name'];
        $order['discount']      = empty($price['discount'])?null:$price['discount'];

        $model  = model('printer');
        $newArr = $model->Reception($menu_id,$food,3);
        $apihp = new APIPHP();
        return $apihp->kitchenPrint2($newArr,$order,2);
    }

    /**
     * 支付完成打印1.0
     * @adminMenu(
     *     'name'   => '支付完成打印1.0',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '支付完成打印1.0',
     *     'param'  => ''
     * )
     */
/*    public function theLastPrint($order_id,$price){
        $order = Db::name('order')
            ->alias('a')
            ->join('__REST__ b','a.table_id=b.id')
            ->join('__FOOD_MENU__ c','b.menu_id=c.id')
            ->field('a.food,c.name,a.remarks,a.order_price,a.order_time,a.order_id,b.tb_id,a.end_time,a.pay_class')
            ->where('a.order_id', $order_id)
            ->find();
        switch ($order['pay_class']){
            case 1:
                $order['pay_class']='支付宝';
                break;
            case 2:
                $order['pay_class']='微信';
                break;
            case 3:
                $order['pay_class']='银联';
                break;
            case 4:
                $order['pay_class']='现金';
                break;
            case 5:
                $order['pay_class']='vip卡';
                break;
            default:
                $order['pay_class']='其它`';
        }
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
        $order['price']         = $price['price'];
        $order['grade_name']    = empty($price['grade_name'])?null:$price['grade_name'];
        $order['discount']      = empty($price['discount'])?null:$price['discount'];
        $where['menu_id']       = array('in',$id);
        $newArr = $this->printer_id($where,$food,0);
        $apihp = new APIPHP();
        return $apihp->kitchenPrint2($newArr,$order,2);
    }*/


    /**
     * 订单详情Ajax
     */
    public function orderDetails()
    {
        if($this->request->isPost())
        {
            $order_id   = $this->request->param('order_id','','string');
            $data       = Db::name('order')
                ->field('a.order_id,date_format(from_unixtime(a.order_time),"%Y-%m-%d %H:%i:%s") as order_time,a.food,e.nickname,b.user_login,b.mobile,b.score,a.remarks,c.tb_id,d.name')
                ->alias('a')
                ->join('__USER__ b','a.user_id=b.id')
                ->join('__REST__ c','a.table_id=c.id')
                ->join('__FOOD_MENU__ d','c.menu_id=d.id')
                ->join('__THIRD_PARTY_USER__ e','e.user_id=b.id','LEFT')
                ->where('a.order_id',$order_id)
                ->find();
            $data = \Qiniu\json_decode(json_encode($data),true);
            
            if( !empty($data['food'])){

                $string = $this->foodList($data['food'],$order_id,$data);
                $data['food_data'] = $string[0];
                $data['allPrice']  = $string[1];
            }

            $data['print_order'] = '<a class="btn btn-danger js-ajax-dialog-btn " data-msg="确定打印订单？" href="'.url("admin/order/Print",array("order_id"=>$order_id,"Printrretue"=>2)).'">打印</a>';
            echo json_encode($data);
        }
    }

    /**
     * 拼接字符串
     * @param $food_order
     * @param $order_id
     * @param $allData
     * @return string
     */
    public function foodList($food_order,$order_id,$allData){
        $food_order = explode(";", $food_order);
        $inarr = array();
        array_pop($food_order);
        foreach ($food_order as $k => $u) {
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
        $food_type  = session("type[$order_id]");
        if (!empty($food_type))
        {
            if (count($type)<=count($food_type))
            {
                $type = $food_type;
            }
        }
        $sql['id'] = array('in', $inarr);
        $data   = Db::name('seller_menu')->field('id,food_name,price')->where($sql)->select();
        $string = '<thead>
                        <tr class="success">
							<th class="col-xs-2">名称</th>
							<th class="col-xs-2">数量</th>
							<th class="col-xs-2">单价</th>
							<th class="col-xs-2">总价</th>
							<th class="col-xs-2">状态</th>
							<th class="col-xs-2">操作</th>
						</tr>
                    </thead>';
        $allPrice = 0;
        $string .= "<tbody>";
        foreach ($data as $kay=>$val)
        {
            foreach ($food as $k=>$v)
            {
                if ($v['id']==$val['id'])
                {

                    $order_food_info = Db::name('order_food')->where('order_id', $order_id)->where('food_id', $val['id'])->where('status', 2)->field('come_out_num,status')->find();

                    // $thisType = $type[$k]['nub']==1?'未出':'已出';
                    $thisType = $order_food_info ? '已出' : '未出'  ;

                    $string .= "<tr>
                            <td><input type='hidden' value='".$val['price'].','.$v['nub']."'/>".$val['food_name']."</td>
                            <td>".$v['nub']."</td>
                            <td>".$val['price']."</td>
                            <td>".$val['price']*$v['nub']."</td>
                            <td>".$thisType."</td>
                            <td><a class='btn btn-default'  href='".url('IsOrder/Edit',array('order_id'=>$order_id,'type'=>2))."'>删除</a></td>
                            </tr>";
                    $allPrice += $val['price']*$v['nub'];
                    break;
                }
            }
        }

        $string .="<tr>
                    <td >备注：</td>
                    <td colspan='4' class='remarks'>".$allData['remarks']."</td>
                    <td>合计：".$allPrice."元</td>
                    </tr>";
        $string .= "</tbody>";
        return  array($string,$allPrice);
    }

    /**
     * 支付页面
     */
    public function Payment(){
        $model      = model('order');
        $pay_class       = $model->pay_class($this->admin_user_id);
        $allPrice   = $this->request->param('allPrice',0);
        $string = "<tr>
                    <td colspan='2'>优惠劵：</td>
                    <td colspan='2'><input type='number' name='Coupons' class=\"form-control\" min='0' placeholder='请填入优惠金额' onchange='CouponsSubtract(this)' onkeyup='CouponsSubtract(this)' /></td>
                    <td>其它：</td>
                    <td colspan='2'><input type='text' name='' class=\"form-control\" /></td> 
                    </tr>
                    <tr>
                     <td colspan='2'>折扣：</td>
                    <td colspan='2'>
                    <input type='number' name='pass[discount]' class=\"form-control\" placeholder='例如：九折既90,请点击确认折扣' onchange='typeToClear(this)' onkeyup='typeToClear(this)' min='0' max='100' id='discount'/>
                    </td>
                    <td>
                    <button type='button' class='btn btn-danger' onclick='toPassword(this)'>
                    确认折扣
                    </button>
                    <input type='hidden' name='pass[to_password]'>
                    </td>
                    <td>应收：</td>
                    <td><input type='text' name='order[order_price]' readonly class='form-control' value='".$allPrice."'></td>
                    </tr>
                    <tr>
                    <td  colspan='2'>
                       <input type=\"radio\" id=\"WeChat\" name=\"order[pay_class]\" value=\"2\" style=\"display: none\" />
                            <label for=\"WeChat\" onclick='backgroundcolor(this)'>
								<i class=\"icon iconfont icon-weixinzhifu2\" style=\"color: #14e90f\" title=\"该功能尚未完善\"></i>
								<div class=\"name\"  style=\"color: #14e90f\">{$pay_class[2]}</div>
							</label>		   
					</td>
					<td >
						<input type=\"radio\" id=\"Alipay\" name=\"order[pay_class]\" value=\"1\" style=\"display: none\" />
                            <label for=\"Alipay\" onclick='backgroundcolor(this)'>
								<i class=\"icon iconfont icon-zhifubaozhifu\" style=\"color: #3256e9\" title=\"该功能尚未完善\"></i>
								<div class=\"name\" style=\"color: #3256e9\">{$pay_class[1]}</div>
							</label>   
					</td>
					<td >
					    <input type=\"radio\" id=\"UnionPay\" name=\"order[pay_class]\" value=\"3\" style=\"display: none\">
                        <label for=\"UnionPay\" onclick='backgroundcolor(this)'>
						    <i class=\"icon iconfont icon-ai-pay-copy\" style=\"color: #49cde9\" title=\"该功能尚未完善\"></i>
						    <div class=\"name\" style=\"color: #49cde9\">{$pay_class[3]}</div>
						</label>	   
					</td>
					<td >			   
					    <input type=\"radio\" id=\"cash\" name=\"order[pay_class]\" value=\"4\" style=\"display: none\">
                        <label for=\"cash\" onclick='backgroundcolor(this)'>
                            <i class=\"icon iconfont icon-xianjin\" style=\"color: #e9484e;\" ></i>
                            <div class=\"name\" style=\"color: #e9484e\">{$pay_class[4]}</div>
                        </label>
                    </td>
                    <td >
                       <input type=\"radio\" id=\"vipCard\"  name=\"order[pay_class]\" value=\"5\" style=\"display: none\">
                       <label for=\"vipCard\" onclick='backgroundcolor(this)'>
                            <i class=\"icon iconfont icon-membership-card_icon\" style=\"color: red\"></i>
                            <div class=\"name\" style=\"color: red\">{$pay_class[5]}</div>
                        </label>
                    </td>
                    <td style='text-align:left'>
                        <button type=\"button\"  class=\"btn btn-success \" data-toggle=\"modal\" data-target=\"#xg\" id='oneOffPayment'>
                            支付
                        </button>
                        <div   style='float:left;display: none' class=\"btn btn-success  merge\" >
                            合并支付
                        </div>
                        <label for='thisType' style='float:right;'>
                            <input type='checkbox' id='thisType' style='display: none' />
                            <div type='button' class='btn-success' onclick='changeThisType(this)'>合
                            </div>
                         </label>
                    </td>
                    </tr>";
        $string .= "<tr style='display: none' class='merge'>";
        foreach ($pay_class as $key=>$val)
        {
            switch ($key)
            {
                case 1:
                    $string .="<td colspan='2'><input type='number' class='form-control reduce' name='pay_class2[".$key."]' value='0' min='0' max='".$allPrice."' onchange='changSurplus()'></td>";
                    break;
                default:
                    $string .="<td ><input type='number' class='form-control reduce' name='pay_class2[".$key."]' value='0' min='0' max='".$allPrice."' onchange='changSurplus()'></td>";
            }

        }
        $string .= "
                        <td>剩余： <span id='Surplus'>".$allPrice."</span>元</td>
                    </tr>";
        $string .= "<tr  style='display: none' class='merge'>";
        foreach ($pay_class as $key=>$val)
        {
            switch ($key)
            {
                case 1:
                    $string .="<td colspan='2'>
                                    <label for='order_pay_class".$key."' >
                                    <input type='radio' id='order_pay_class".$key."' style='display: none' name='order_pay_class' value='".$key."'/>
                                    <div type=\"button\"  class=\"btn btn-success \" data-toggle=\"modal\" data-target=\"#xg\">支付</div>
                                    </label>
                                </td>";
                    break;
                default:
                    $string .="<td > 
                                    <label for='order_pay_class".$key."' >
                                    <input type='radio' id='order_pay_class".$key."' style='display: none' name='order_pay_class' value='".$key."' />
                                    <div type=\"button\"  class=\"btn btn-success \" data-toggle=\"modal\" data-target=\"#xg\">支付</div>
                                    </label>
                                </td>";
            }

        }

        $string .= " </tr>";

        echo $string;exit;
    }





    /**
     * 合并支付记录
     * @adminMenu(
     *     'name'   => '合并支付记录',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '合并支付记录',
     *     'param'  => ''
     * )
     */
    public function order_pay_class($request,$url)
    {
        $arr = array(
            'order_id'      => $request['order']['order_id'],
            'pay_class_id'  => $request['order_pay_class'],
            'price'         => $request['pay_class2'][$request['order_pay_class']],
        );

        //记录金额方式
        $model = model('order');
        $model->name('order_pay_price')->insert($arr);





        $all_number = $model
            ->name('order_pay_price')
            ->field('sum(price) as all_price')
            ->where('order_id',$request['order']['order_id'])
            ->group('order_id')
            ->find();
        //支付完全保存数据库
        if ($all_number['all_price']>=$request['order']['order_price']) {
            $oldOne = $model->name('order')
                ->field('order_price,discount_price')
                ->where('order_id', $request['order']['order_id'])
                ->find();
            $oldOne = empty($oldOne['discount_price']) ? $oldOne['order_price'] : $oldOne['discount_price'];
            $price_number = $oldOne - $request['order']['order_price'];
            $arr = array(
                'coupon' => $request['Coupons'],
                'price_number' => $price_number,
                'price_discount' => empty($request['pass']['discount']) ? 0 : $request['pass']['discount'],
                'price_receipts' => $request['order']['order_price'],
                'pay' => '4',
                'order_complete' => '4',
                'end_time' => time(),
                'cashier' => session('ADMIN_ID'),
            );
            $price = array(
                'discount' => empty($request['pass']['discount']) ? 0 : $request['pass']['discount'],
                'price' => $request['order']['order_price']
            );

            $this->changeOrder($request['order']['order_id'], $arr, $price, $url);
        }
        else
        {
            $this->success('支付成功，剩余'.($request['order']['order_price']-$all_number['all_price']),url($url[0],array('request',$request)));
        }
    }


    /**
     * 合并支付记录
     * @adminMenu(
     *     'name'   => '合并支付记录',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '合并支付记录',
     *     'param'  => ''
     * )
     */
    public function changeOrder($order_id,$arr,$price,$url)
    {
        //更改订单表数据
        if(Db::name('order')->where('order_id',$order_id)->update($arr) !== false)
        {
            $data = Db::name('order')->where('order_id','eq',$order_id)->field('table_id')->find();

            if(!empty($data))
            {
                Db::name('rest')->where('id','eq',$data['table_id'])->update(['type'=>1]);
            }

            //结算打印
            $result = $this->theLastPrint($order_id,$price);

            $this->success("支付成功！", url($url[0]));
        }else
        {
            $this->error("支付失败！",url($url[0]));
        }

    }

    /**
     * 二次支付
     * @adminMenu(
     *     'name'   => '二次支付',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '二次支付',
     *     'param'  => ''
     * )
     */
    public function mergeIndex()
    {
        $request = $this->request->param();

        $model   = model('order');
        $pay_class = $model->pay_class($this->admin_user_id);
        dump($request);
        dump($pay_class);exit;
        $this->assign('data',$request);
        $this->assign('pay_class',$pay_class);
        return $this->fetch();
    }
}