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

use cmf\controller\AdminBaseController;
use think\Db;
use tree\Tree;

class ReportController extends AdminBaseController
{
     public function _initialize()
    {
     if (cmf_get_current_admin_id() == null) {
          $this->error("您没有访问权限！");
     }
        self::yesterday();
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
     * 报表主页
     * @adminMenu(
     *     'name'   => '报表主页',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '报表主页',
     *     'param'  => ''
     * )
     */
    
	public function index()
	{
        //echo date(strtotime('-2 hours'));exit;

		if(cmf_get_current_admin_id() != 1 )
		{
            $seller_id = $this->admin_user_id;
            $type      = 1;
            $request = $this->request->param();


            if(!empty($request['type'])){
                $type = $request['type'];
            }
            //日销售总额和总份数
            $data   = Db::name('order')
                ->field('FORMAT(sum(order_price),2) as totalmoney,count(*) as sheets')
                ->where('order_complete',4)
                ->where('seller_id',$seller_id)
                ->whereTime('end_time','today')
                ->select();
			$this->assign('nub1',$data[0]['totalmoney']);
			$this->assign('count1',$data[0]['sheets']);
            //月销售总额和总份数
            $month_sales    = Db::name('sum_count')
                ->where('seller_id',$seller_id)
                ->whereTime('count_time','month')
                ->field("sum(count_sum) as totalmoney, sum(count_num) as sheets")
                ->order('sheets')
                ->select();
			$this->assign('nub2',$month_sales[0]['totalmoney']);
			$this->assign('count2',$month_sales[0]['sheets']);
            //服务厅列表
            $model = model('FoodMenu');
            $menu = $model->index();
            $this->assign('menu',$menu);
            //报表数据

            $this->details($type,$seller_id,$request);
            //查询本天，本周，本月的交易额
            $this->getUserRecord('today',$seller_id);
            $this->getUserRecord('week',$seller_id);
            $this->getUserRecord('month',$seller_id);
	      	return $this->fetch();
		}else
        {
            return redirect(url('admin/report/admin_report', [], false, true));
        }
	}



    /**
     * 超级管理员界面
     * @return mixed
     */
    public function admin_report()
    {
        if(cmf_get_current_admin_id()!==1)
        {
            $this->error('错误访问！');
            exit;
        }

        $count          = Db::name('seller')->where('delete_time','eq',0)->count('id');
        $sell_price     = Db::name('order')->where('order_complete',4)->sum('order_price');

        $data           = Db::name('order')
            ->where('order_complete',4)
            ->where("date_format(from_unixtime(end_time), '%Y-%m') = date_format(now(),'%Y-%m')")
            ->sum('order_price');

        $month_sales    = Db::name('order')
            ->where('order_complete',4)
            ->field("sum(order_price) as totalmoney, count(*) as sheets,date_format(from_unixtime(end_time), '%y-%m') as time")
            ->group("date_format(from_unixtime(end_time), '%y-%m')")
            ->select();

        $arr=$this->takeTo($month_sales,10000);
        $this->assign('xs',$arr['xs']);
        $this->assign('xl',$arr['xl']);
        $this->assign('rq',$arr['rq']);
        $this->assign('seller_count',$count);
        $this->assign('sell_price',$sell_price);
        $this->assign('month_sales',$month_sales);
        $this->assign('data',$data);

        return $this->fetch();
    }

   	public function Daily_sales()
    {
        $data = Db::query("select DATE_FORMAT(from_unixtime(end_time),'%H') hours,count(order_id) count from xjy_order WHERE order_complete = 4 and seller_id = ".$this->admin_user_id." and to_days(from_unixtime(end_time)) = to_days(now()) group by hours;");

        $value = null;

        foreach($data as $key => $val)
        {
            $value .= $val['hours'].','.$val['count'].';';
        }
        echo $value;
    }

    /**
     * 根据提供的时间范围执行查询操作
     * @param $time 方式
     * @param $id 商家id
     * @return mixed
     */
    protected function getUserRecord($time,$id){
        $data  = Db::name('user_balance')
            ->field("sum(WeChat) as WeChat,sum(Alipay) as Alipay,sum(UnionPay) as UnionPay,sum(Cash) as Cash,sum(VIP_card) as VIP_card")
            ->whereTime('time',$time)
            ->where('seller_id',$id)
            ->find();
        $data =  json_decode( json_encode( $data ), true );
        $this->assign($time,$data);
    }

    /**
     * 转换
     * @param $data 从数据库查询的数据
     * @param int $bit 倍数
     * @return array
     */
    protected function takeTo($data,$bit=1){
        $month_sales   = json_decode( json_encode( $data ), true );//转化为纯数组
        //var_dump($month_sales);exit;
        $xs = '[';
        $xl = '[';
        $rq = '[';
        if(!empty($month_sales)){
            foreach ($month_sales as $key => $value) {
                $xs .= ($value['totalmoney']/$bit).",";
                $xl .= ($value['sheets']/$bit).",";
                $rq .= "'".$value['time']."',";
            }
        }else{
            for($i=0;$i<=24;$i++){
                $xs .= '0,';
                $xl .= '0,';
                $rq .= $i.',';
            }
        }



        $xs = substr($xs,0,strlen($xs)-1);
        $xs.=']';

        $xl = substr($xl,0,strlen($xl)-1);
        $xl.=']';

        $rq = substr($rq,0,strlen($rq)-1);
        $rq.=']';
        return array(
            'xs' => $xs,
            'xl' => $xl,
            'rq' => $rq,
        );
    }



    /**
     * 计算昨日的总金额
     * @return bool
     */
    public static function yesterday(){
        $id = Db::name('sum_count')->field('count_id')->whereTime('count_time','yesterday')->find();
        if(!empty($id)){
            $id = Db::name('sum_count')->field('count_id')->whereTime('count_time','-3 day')->select();
            //var_dump($id);exit;
            if(count($id)<2){
                self::addSomeThing('-2 day');
                return true;
            }
            return true;
        }
        self::addSomeThing();
        return true;
    }

    /**
     * 添加数据
     * @param string $day
     */
    protected static function addSomeThing($day='-1 day'){
        if(session('admin_parent_id') == 1)
        {
            $seller_id = session('ADMIN_ID');
        }else
        {
            $seller_id = session('admin_parent_id');
        }
        if(empty($seller_id)){
            header('Location:'.cmf_url('admin/Main/index'));
        }
        $times=null;
        $days = 'yesterday';
        if($day=='-2 day'){
            $days   = 'between';
            $times  = [date(strtotime($day)),date(strtotime('-1 day'))];
        }
        $money = Db::name('order')
            ->alias('a')
            ->join('__REST__ b','a.table_id=b.id','RIGHT')
            ->field('sum(order_price) as money,count(*) as sheets,b.menu_id')
            ->whereTime('a.end_time',$days,$times)
            ->group('menu_id')
            ->where('b.seller_id',$seller_id)
            ->select();
        $money = \Qiniu\json_decode(json_encode($money),true);
       if(empty($money)){
           $money = Db::name('rest')->field('menu_id')->where('seller_id',$seller_id)->group('menu_id')->select();
           $money = \Qiniu\json_decode(json_encode($money),true);
       }
        foreach ($money as $val){
            $arr = array(
                'menu_id'    => $val['menu_id'],
                'seller_id'  => $seller_id,
                'count_time' => date(strtotime($day)),
                'count_sum'  => empty($val['money'])?0:$val['money'],
                'count_num'  => empty($val['sheets'])?0:$val['sheets'],
            );
            Db::name('sum_count')->insert($arr);
        }

    }

    /**
     * 调出详细数据,并且赋值
     * @param $type
     * @param $seller_id
     * @param $request
     */
    protected function details($type,$seller_id,$request){
        switch ($type) {
            case 1:
                //日销售 小时/单
                $max = Db::name('order')
                    ->join('__REST__ b','a.table_id=b.id')
                    ->field('truncate(sum(order_price),2) as maxmoney,count(*) as maxsheets');
                $table = Db::name('order')->join('__REST__ b','a.table_id=b.id');

                $table->field('truncate(sum(order_price),2) as totalmoney,count(*) as sheets,date_format(from_unixtime(end_time),"%d日%H时") as time')
                    ->where('order_complete',4);
                $time='end_time';
                $mode = 'today';
                break;
            case 2:
                // 天/单
                $max = Db::name('sum_count')
                    ->field('truncate(sum(count_sum),2) as maxmoney,sum(count_num) as maxsheets');
                $table =Db::name('sum_count');
                $table->field('count_sum as totalmoney,count_num as sheets,date_format(from_unixtime(count_time),"%m月%d日") as time');
                $time = 'count_time';
                $mode = 'month';
                break;
            default:
                //年
                $max = Db::name('sum_count')
                    ->field('truncate(sum(count_sum),2) as maxmoney,sum(count_num) as maxsheets');
                $table =Db::name('sum_count');
                $table->field('count_sum as totalmoney,count_num as sheets,date_format(from_unixtime(count_time),"%Y年%m月") as time');
                $time = 'count_time';
                $mode = 'year';
        }
        if(!empty($request['menu'])){
            $table->where('menu_id',$request['menu']);
            $max->where('menu_id',$request['menu']);
        }

        if(!empty($request['beginTime']) || !empty($request['endTime'])){
            if(empty($request['beginTime'])){
                $request['beginTime']= '1970-01-01' ;
            }
            $beginTime = $request['beginTime'];
            $endTime   = $request['endTime'];
            if(empty($endTime)){
                $endTime= date('Y-m-d',time());
            }
            $endTime =    date("Y-m-d",strtotime("$endTime   +1   day"));
            $table->whereTime($time,'between',[$beginTime,$endTime]);
            $max->whereTime($time,'between',[$beginTime,$endTime]);
        }else{
            $table->whereTime($time,$mode);
            $max->whereTime($time,$mode);
        }
        $max = $max->alias('a')->select();
        //最大值
        $this->assign('maxmoney',round($max[0]['maxmoney'],0));
        $this->assign('maxsheets',round($max[0]['maxsheets'],0));
        $day_sales = $table->alias('a')
            ->where('a.seller_id',$seller_id)
            ->group($time)
            ->select();

        $arr=$this->takeTo($day_sales,1);
        $this->assign('dxs',$arr['xs']);
        $this->assign('dxl',$arr['xl']);
        $this->assign('drq',$arr['rq']);
    }
}