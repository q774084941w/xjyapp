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


use cmf\controller\AdminBaseController;
use think\Db;
use think\Validate;

/**
 * Class TrafficCategoryController
 * @package app\admin\controller
 * @adminMenuRoot(
 *     'name'   => '商品报表统计',
 *     'action' => 'default',
 *     'parent' => '',
 *     'display'=> true,
 *     'order'  => 10000,
 *     'icon'   => '',
 *     'remark' => '商品报表统计'
 * )
 */

class TrafficReportController extends AdminBaseController
{
    public function _initialize()
    {
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
     * 进货列表
     * @adminMenu(
     *     'name'   => '进货列表',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '进货列表',
     *     'param'  => ''
     * )
     */
    public function index()
    {

        $request = $this->request->param();
        $type    = 1;
        $where   = array(
            'a.seller_id'=>$this->admin_user_id,
            'a.type'     =>$type,
        );
        $traffic_all_record = Db::name('traffic_all_record');
        if(!empty($request['beginTime']) || !empty($request['endTime']))
        {
            if(empty($request['beginTime']))
            {
                $request['beginTime']= '1970-01-01' ;
            }
            
            if(empty($request['endTime']))
            {
                $endTime= date('Y-m-d',time());
            }else{
                $endTime = $request['endTime'];
            }
            $endTime =    date("Y-m-d",strtotime("$endTime   +1   day"));
            $traffic_all_record->whereTime('a.time','between',[$request['beginTime'],$endTime]);
        }
        elseif (!empty($request['time']))
        {
            $this->assign('whereTime',$request['time']);
            $traffic_all_record->whereTime('a.time',$request['time']);
        }
        else
        {
            $traffic_all_record->whereTime('a.time','today');
        }
        if(!empty($request['category']))
        {
            $where['c.id'] = $request['category'];
        }
        $model    = model('TrafficCategory');
        $category = $model->index();
        $this->assign('category',$category);

        if(!empty($request['keyword']))
        {
            $ret = Validate::is($request['keyword'],'chs');
            if($ret)
            {
                $where['b.name'] = ['like',"%".$request['keyword']."%"];
            }
            else
            {
                $where['b.pinyin'] = ['like',"%".$request['keyword']."%"];
            }
        }

        $traffic_all_record
            ->group('a.tra_id')
            ->field('a.tra_id,a.time,sum(a.add_num) as all_num,b.name,b.pinyin,b.buy_price,b.ret_price,c.name as category_name,b.traffic_number');

        $data =   $traffic_all_record
                    ->alias('a')
                    ->join('__TRAFFIC__ b','a.tra_id=b.tra_id')
                    ->join('__TRAFFIC_CATEGORY__ c','b.category_id=c.id')
                    ->where($where)
                    ->paginate(10);
        $data->appends($request);
        $page = $data->render();

        $this->assign('where',$request);
        $this->assign('page',$page);
        $this->assign('data',$data);
        return $this->fetch();
    }
    
      /**
     * 进货统计打印
     * @adminMenu(
     *     'name'   => '进货统计打印',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '进货统计打印',
     *     'param'  => ''
     * )
     */
    public function print1()
    {
        $types = intval($this->request->param('types'));
        // $Report_name = $types == 1 ? '进货统计单' : '出库统计单';
        $Report_name = '进货统计单';

        $request = $this->request->param();
        $type    = 1;
        $where   = array(
            'a.seller_id'=>$this->admin_user_id,
            'a.type'     =>$type,
        );

        $traffic_all_record = Db::name('traffic_all_record');
        if(!empty($request['beginTime']) || !empty($request['endTime']))
        {
            if(empty($request['beginTime']))
            {
                $request['beginTime']= '1970-01-01' ;
            }
            
            if(empty($request['endTime']))
            {
                $endTime= date('Y-m-d',time());
            }else{
                $endTime = $request['endTime'];
            }

            $endTime =    date("Y-m-d",strtotime("$endTime   +1   day"));
            $traffic_all_record->whereTime('a.time','between',[$request['beginTime'],$endTime]);

        }elseif (!empty($request['time']))
        {
            $this->assign('whereTime',$request['time']);
            $traffic_all_record->whereTime('a.time',$request['time']);
        }else
        {
            $traffic_all_record->whereTime('a.time','today');
        }

        if(!empty($request['category']))
        {
            $where['c.id'] = $request['category'];
        }

        $model    = model('TrafficCategory');
        $category = $model->index();
        $this->assign('category',$category);

        if(!empty($request['keyword']))
        {
            $ret = Validate::is($request['keyword'],'chs');
            if($ret)
            {
                $where['b.name'] = ['like',"%".$request['keyword']."%"];
            }else
            {
                $where['b.pinyin'] = ['like',"%".$request['keyword']."%"];
            }
        }

        $traffic_all_record
            ->group('a.tra_id')
            ->field('a.tra_id,a.time,sum(a.add_num) as all_num,b.name,b.pinyin,b.buy_price,b.ret_price,c.name as category_name');

        $data =   $traffic_all_record
                    ->alias('a')
                    ->join('__TRAFFIC__ b','a.tra_id=b.tra_id')
                    ->join('__TRAFFIC_CATEGORY__ c','b.category_id=c.id')
                    ->where($where)
                    ->paginate(100);

        $data->appends($request);
        $page = $data->render();

        $this->assign('page',$page);
        $this->assign('data',$data);
        $this->assign('Report_name',$Report_name);
        $this->assign('requests',$request);
        return $this->fetch();
    }

        /**
     * 出库统计打印
     * @adminMenu(
     *     'name'   => '出库统计打印',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '出库统计打印',
     *     'param'  => ''
     * )
     */
    public function print2(){
        $request = $this->request->param();
        $Report_name = '出库统计单';
        $type    = 2;
        $where   = array(
            'a.seller_id'=>$this->admin_user_id,
            'a.type'     =>$type,
        );
        $traffic_all_record = Db::name('traffic_all_record');
        if(!empty($request['beginTime']) || !empty($request['endTime'])){
            if(empty($request['beginTime'])){
                $request['beginTime']= '1970-01-01' ;
            }
            
            if(empty($endTime)){
                $endTime= date('Y-m-d',time());
            }else{
                $endTime = $request['endTime'];
            }

            $endTime =    date("Y-m-d",strtotime("$endTime   +1   day"));
            $traffic_all_record->whereTime('a.time','between',[$request['beginTime'],$endTime]);
        }elseif (!empty($request['time'])){
            $this->assign('whereTime',$request['time']);
            $traffic_all_record->whereTime('a.time',$request['time']);
        }else{

            $traffic_all_record->whereTime('a.time','today');
        }
        if(!empty($request['category'])){
            $where['c.id'] = $request['category'];
        }
        $model    = model('TrafficCategory');
        $category = $model->index();
        $this->assign('category',$category);
        if(!empty($request['keyword'])){
            $ret = Validate::is($request['keyword'],'chs');
            if($ret){
                $where['b.name'] = ['like',"%".$request['keyword']."%"];
            }else{
                $where['b.pinyin'] = ['like',"%".$request['keyword']."%"];
            }
        }

        $traffic_all_record
            ->group('a.tra_id')
            ->field('a.tra_id,a.time,sum(a.add_num) as all_num,b.name,b.pinyin,b.buy_price,b.ret_price,c.name as category_name');

        $data =   $traffic_all_record
            ->alias('a')
            ->join('__TRAFFIC__ b','a.tra_id=b.tra_id')
            ->join('__TRAFFIC_CATEGORY__ c','b.category_id=c.id')
            ->where($where)
            ->paginate(100);

        $data->appends($request);
        $page = $data->render();

        $this->assign('page',$page);
        $this->assign('data',$data);
        $this->assign('Report_name',$Report_name);
        $this->assign('requests',$request);
        return $this->fetch();
    }

    /**
     * 交易详情
     * @adminMenu(
     *     'name'   => '交易详情',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '交易详情',
     *     'param'  => ''
     * )
     */
    public function detailed(){
        $request = $this->request->param();
        $this->assign('request',$request);
        $where   = array(
            'a.tra_id'  => $request['tra_id'],
            'a.type'    => $request['type'],
            'a.seller_id'    => $this->admin_user_id,
        );
        $traffic_all_record = Db::name('traffic_all_record');


        if(!empty($request['beginTime']) || !empty($request['endTime'])){
            if(empty($request['beginTime'])){
                $request['beginTime']= '1970-01-01' ;
            }
            $endTime = $request['endTime'];
            if(empty($endTime)){
                $endTime= date('Y-m-d',time());
            }
            $endTime =    date("Y-m-d",strtotime("$endTime   +1   day"));
            $traffic_all_record->whereTime('a.time','between',[$request['beginTime'],$endTime]);
        }elseif (!empty($request['time'])){
            $traffic_all_record->whereTime('a.time',$request['time']);
        }

        $data    = $traffic_all_record
                    ->field('a.record_number,a.time,a.add_num,a.time,b.name,b.buy_price,b.ret_price,b.member_price,b.pinyin,c.name as category_name')
                    ->alias('a')
                    ->join('__TRAFFIC__ b','a.tra_id=b.tra_id')
                    ->join('__TRAFFIC_CATEGORY__ c','b.category_id=c.id')
                    ->where($where)
            ->paginate(10);
        $data->appends($request);
        $page = $data->render();
        $this->assign('page',$page);
        $this->assign('data',$data);
        return $this->fetch();
    }

    /**
     * 出库统计
     * @adminMenu(
     *     'name'   => '出库统计',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '出库统计',
     *     'param'  => ''
     * )
     */
    public function Shipments(){
        $request = $this->request->param();
        $type    = 2;
        $where   = array(
            'a.seller_id'=>$this->admin_user_id,
            'a.type'     =>$type,
        );
        $traffic_all_record = Db::name('traffic_all_record');
        if(!empty($request['beginTime']) || !empty($request['endTime'])){
            if(empty($request['beginTime'])){
                $request['beginTime']= '1970-01-01' ;
            }
            $endTime = $request['endTime'];
            if(empty($endTime)){
                $endTime= date('Y-m-d',time());
            }
            $endTime =    date("Y-m-d",strtotime("$endTime   +1   day"));
            $traffic_all_record->whereTime('a.time','between',[$request['beginTime'],$endTime]);
        }elseif (!empty($request['time'])){
            $this->assign('whereTime',$request['time']);
            $traffic_all_record->whereTime('a.time',$request['time']);
        }else{

            $traffic_all_record->whereTime('a.time','today');
        }
        if(!empty($request['category'])){
            $where['c.id'] = $request['category'];
        }
        $model    = model('TrafficCategory');
        $category = $model->index();
        $this->assign('category',$category);
        if(!empty($request['keyword'])){
            $ret = Validate::is($request['keyword'],'chs');
            if($ret){
                $where['b.name'] = ['like',"%".$request['keyword']."%"];
            }else{
                $where['b.pinyin'] = ['like',"%".$request['keyword']."%"];
            }
        }

        $traffic_all_record
            ->group('a.tra_id')
            ->field('a.tra_id,a.time,sum(a.add_num) as all_num,b.name,b.pinyin,b.buy_price,b.ret_price,c.name as category_name,b.traffic_number');

        $data =   $traffic_all_record
            ->alias('a')
            ->join('__TRAFFIC__ b','a.tra_id=b.tra_id')
            ->join('__TRAFFIC_CATEGORY__ c','b.category_id=c.id')
            ->where($where)
            ->paginate(10);
        $data->appends($request);
        $page = $data->render();

        $this->assign('where',$request);
        $this->assign('page',$page);
        $this->assign('data',$data);
        return $this->fetch();

    }


//报损

    /**
     * 商品报损
     * @adminMenu(
     *     'name'   => '商品报损',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '商品报损',
     *     'param'  => ''
     * )
     */
    public function lossIndex(){
        $request = $this->request->param();
        $where = array(
            'a.delete_time' => 0,
            'a.seller_id'   => $this->admin_user_id,
        );


        if(!empty($request['keyword'])){
            $ret = Validate::is($request['keyword'],'chs');
            if($ret){
                $where['c.name'] = ['like',"%".$request['keyword']."%"];
            }else{
                $where['c.pinyin'] = ['like',"%".$request['keyword']."%"];
            }
        }
        $traffic_loss = Db::name('traffic_loss');
        if(!empty($request['beginTime']) || !empty($request['endTime'])){
            if(empty($request['beginTime'])){
                $request['beginTime']= '1970-01-01' ;
            }
            $endTime = $request['endTime'];
            if(empty($endTime)){
                $endTime= date('Y-m-d',time());
            }
            $endTime =    date("Y-m-d",strtotime("$endTime   +1   day"));
            $traffic_loss->whereTime('a.time','between',[$request['beginTime'],$endTime]);

        }
        $data = $traffic_loss
            ->field('a.*,b.user_nickname,b.user_login,c.name as goods_name,c.buy_price')
            ->alias('a')
            ->join('__USER__ b','a.take_id=b.id')
            ->join('__TRAFFIC__ c','a.tra_id=c.tra_id')
            ->join('__TRAFFIC_CATEGORY__ d','c.category_id=d.id')
            ->where($where)
            ->paginate(10);
         $data->appends($request);
        $page = $data->render();
        $this->assign('page',$page);
        $this->assign('data',$data);
        return $this->fetch();
    }

    /**
     * 商品报损添加
     * @adminMenu(
     *     'name'   => '商品报损添加',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '商品报损添加',
     *     'param'  => ''
     * )
     */
    public function lossAdd(){
        if($this->request->isPost()){
            $request = $this->request->param();
            $result  = $this->validate($request['add'],'trafficReport.add');
            if($result!==true){
                $this->error($result);
            }
            $request['add']['take_id']   =  session('ADMIN_ID');
            $request['add']['seller_id'] =  $this->admin_user_id;
            $request['add']['time']      =  time();
            $ret = Db::name('traffic_loss')->insert($request['add']);
            if($ret){
                if($request['add']['type']==2){
                    Db::name('traffic')->where('tra_id',$request['add']['tra_id'])->setDec('stock',$request['add']['tra_num']);
                }
                $this->success('添加成功',url('trafficReport/lossIndex'));
            }else{
                $this->error('添加失败');
            }
        }

        $goods = Db::name('traffic')
                    ->field('tra_id,name')
                    ->where('seller_id',$this->admin_user_id)
                    ->select();
        $this->assign('goods',$goods);
        $men = Db::name('user')
            ->where('parent_id',$this->admin_user_id)
            ->field('id,user_nickname,user_login')
            ->select();
        $this->assign('men',$men);
        return $this->fetch();
    }

    /**
     * 商品报损修改
     * @adminMenu(
     *     'name'   => '商品报损修改',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '商品报损修改',
     *     'param'  => ''
     * )
     */
    public function lossEdit(){
        $id = $this->request->param('id');
        if(empty($id)){
            $this->error('参数错误');
        }
        if($this->request->isPost()){
            $request = $this->request->param();
             Db::name('traffic_loss')
                        ->where('id',$id)
                        ->update(array('delete_time'=>time()));
            $request['edit']['take_id']   =  session('ADMIN_ID');
            $request['edit']['seller_id'] =  $this->admin_user_id;
            $request['edit']['time']      =  time();
            $result = Db::name('traffic_loss')->insert($request['edit']);
            if($request['edit']['tra_num']!=$request['old_tra_num']){
                $num = $request['edit']['tra_num']-$request['old_tra_num'];
                Db::name('traffic')->where('tra_id',$request['add']['tra_id'])->setDec('stock',$num);
            }
            if($result){
                $this->success('修改成功',url('trafficReport/lossIndex'));
            }else{
                $this->error('修改失败');
            }
        }
        $goods = Db::name('traffic')
                    ->field('tra_id,name')
                    ->where('seller_id',$this->admin_user_id)
                    ->select();
        $this->assign('goods',$goods);
        $data = Db::name('traffic_loss')
                    ->field('a.*,b.user_nickname,b.user_login')
                    ->alias('a')
                    ->join('__USER__ b','a.take_id=b.id')
                    ->where('a.id',$id)
                    ->find();
        $this->assign('data',$data);
        return $this->fetch();
    }

    /**
     * 商品报损删除
     * @adminMenu(
     *     'name'   => '商品报损删除',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '商品报损删除',
     *     'param'  => ''
     * )
     */
    public function lossDel(){
        $id   = $this->request->param("id");
        $where['tra_id']  = $id ;
        $where['delete_time']   = strtotime(date('Y-m-d H:i:s',time()));
        $del['object_id']       = $id;
        $del['create_time']     = $where['delete_time'];
        $del['table_name']      = 'traffic';
        $del['name']            = '报损信息';
        $del['uid']             = session('ADMIN_ID');
        $del['seller_id']        = $this->admin_user_id;

        $req    = Db::name('recycle_bin')->insert($del);
        $status = Db::name('traffic')->update($where);
        if ($status)
        {
            $this->success('修改成功',url('trafficReport/lossIndex'));
        } else
        {
            $this->error("删除失败！");
        }
    }

//库存报警

    /**
     * 库存报警页面
     * @adminMenu(
     *     'name'   => '库存报警页面',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '库存报警页面',
     *     'param'  => ''
     * )
     */
    public function alert(){
        $request = $this->request->param();
        $model = model('traffic');
        $data  = $model->index($request);
        $this->assign('data',$data);
        return $this->fetch();
    }

//库存统计
    public function Statistics(){
        $request = $this->request->param();
        $type    = 1;
        $where   = array(
            'a.seller_id'=>$this->admin_user_id,
            'a.type'     =>$type,
        );
        $traffic_all_record = Db::name('traffic_all_record');
        if(!empty($request['beginTime']) || !empty($request['endTime']))
        {
            if(empty($request['beginTime']))
            {
                $request['beginTime']= '1970-01-01' ;
            }
            $endTime = $request['endTime'];
            if(empty($endTime))
            {
                $endTime= date('Y-m-d',time());
            }
            $endTime =    date("Y-m-d",strtotime("$endTime   +1   day"));
            $traffic_all_record->whereTime('a.time','between',[$request['beginTime'],$endTime]);
        }
        elseif (!empty($request['time']))
        {
            $this->assign('whereTime',$request['time']);
            $traffic_all_record->whereTime('a.time',$request['time']);
        }
        else
        {
            $traffic_all_record->whereTime('a.time','month');
        }
        if(!empty($request['category']))
        {
            $where['c.id'] = $request['category'];
        }
        $model    = model('TrafficCategory');
        $category = $model->index();
        $this->assign('category',$category);

        if(!empty($request['keyword']))
        {
            $ret = Validate::is($request['keyword'],'chs');
            if($ret)
            {
                $where['b.name'] = ['like',"%".$request['keyword']."%"];
            }
            else
            {
                $where['b.pinyin'] = ['like',"%".$request['keyword']."%"];
            }
        }

        $traffic_all_record
            ->group('a.tra_id')
            ->field('a.before,a.tra_id,a.time,sum(a.add_num) as all_num,b.name,b.pinyin,b.buy_price,b.ret_price,c.name as category_name,b.traffic_number,b.stock');

        $data =   $traffic_all_record
            ->alias('a')
            ->join('__TRAFFIC__ b','a.tra_id=b.tra_id')
            ->join('__TRAFFIC_CATEGORY__ c','b.category_id=c.id')
            ->where($where)
            ->paginate(10);
        $data->appends($request);
        $page = $data->render();
        $this->assign('page',$page);
        $this->assign('data',$data);
        return $this->fetch();
    }

    /**
     * 出库记录统计
     * @adminMenu(
     *     'name'   => '出库记录统计',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '出库记录统计',
     *     'param'  => ''
     * )
     */
    public static  function outTraffic($tra_id,$tra_num,$menu_id,$type=1){
        $model = model('traffic');
        $model->openAlert($tra_id);
        $result = Db::name('traffic_all_record')
            ->where('tra_id',$tra_id)
            ->where('menu_id',$menu_id)
            ->where('type',$type)
            ->whereTime('time','today')
            ->value('id');
        if(empty($result))
        {
            if(session('admin_parent_id') == 1)
            {
                $user_id = session('ADMIN_ID');
            }else
            {
                $user_id = session('admin_parent_id');
            }
            $arr  =  array(
                'record_number' => "CKD".date('YmdHis').mt_rand(000,999),
                'tra_id'        => $tra_id,
                'menu_id'       => $menu_id,
                'type'          => $type,
                'time'          => time(),
                'seller_id'     => $user_id,
                'add_num'       => $tra_num,
            );
            Db::name('traffic_all_record')->insert($arr);
        }
        else
        {
            Db::name('traffic_all_record')->where('id',$result)->setInc('add_num',$tra_num);
        }
    }
}