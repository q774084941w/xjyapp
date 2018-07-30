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
use think\Loader;
use think\Validate;
use tree\Tree;

class TrafficController extends AdminBaseController
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
     * 货流货品主页
     * @adminMenu(
     *     'name'   => '货品管理',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '货品管理',
     *     'param'  => ''
     * )
     */
    public function index(){
        $request = $this->request->param();
        $where =array('a.delete_time'=>0,'a.type'=>['neq',9]);
        if(cmf_get_current_admin_id() != 1)
        {
            if(session('admin_parent_id') == 1)
            {
                $where['a.seller_id'] = ['eq',session('ADMIN_ID')];
                $this->assign("seller_id",session('ADMIN_ID'));
            }else
            {
                $where['a.seller_id'] = ['eq',session('admin_parent_id')];
            }
        }

        if (!empty($request['category']))
        {
            $where['b.id'] = $request['category'];
        }
        $model    = model('TrafficCategory');
        $category = $model->index();
        $this->assign('category',$category);
        $traffic = Db::name('traffic');

        if(!empty($request['beginTime']) || !empty($request['endTime'])){
            if(empty($request['beginTime'])){
                $request['beginTime']= '1970-01-01' ;
            }
            $endTime = $request['endTime'];
            if(empty($endTime)){
                $endTime= date('Y-m-d',time());
            }
            $endTime =    date("Y-m-d",strtotime("$endTime   +1   day"));
            $traffic->whereTime('add_time','between',[$request['beginTime'],$endTime]);

        }

        if (!empty($request['keyword']))
        {
            $ret = Validate::is($request['keyword'],'chs');
            if ($ret)
            {
                $where['a.name'] = ['like',"%".$request['keyword']."%"];
            }
            else
            {
                $where['a.pinyin'] = ['like',"%".$request['keyword']."%"];
            }
        }

        $result = $traffic->alias('a')
            ->join('__TRAFFIC_CATEGORY__ b','a.category_id=b.id')
            ->where($where)
            ->field('a.*,b.name as category_name')
            ->paginate(10);
        $result->appends($request);
        $page = $result->render();
        $this->assign("Supermarket",session('Supermarket'));
        $this->assign('data',$result);
        $this->assign("page",$page);
        return $this->fetch();
    }



    /**
     * excel导入
     */
    public function do_upload()
    {
        $seller_id = $this->admin_user_id;

        //引入文件（把扩展文件放入vendor目录下，路径自行修改）
        vendor("PHPExcelClass.PHPExcel");

        //获取表单上传文件
        $file = request()->file('excel');
        $info = $file->validate(['ext' => 'xlsx,xls'])->move(ROOT_PATH . 'public' . DS . 'upload' . DS . 'TaoBao');

        //数据为空返回错误
        if(empty($info)){
            echo  json_encode(array('state'=>0));
            exit;
        }

        //获取文件名
        $exclePath = $info->getSaveName();
        //上传文件的地址
        $filename = ROOT_PATH . 'public' . DS . 'upload' . DS . 'TaoBao'. DS . $exclePath;

        //判断截取文件
        $extension = strtolower( pathinfo($filename, PATHINFO_EXTENSION) );

        //区分上传文件格式
        if($extension == 'xlsx') {
            $objReader =\PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load($filename, $encode = 'utf-8');
        }else if($extension == 'xls'){
            $objReader =\PHPExcel_IOFactory::createReader('Excel5');
            $objPHPExcel = $objReader->load($filename, $encode = 'utf-8');
        }

        $excel_array = $objPHPExcel->getsheet(0)->toArray();   //转换为数组格式
        array_shift($excel_array);  //删除第一个数组(标题);
        $city = [];
        $request = $this->request->param();
        if($request['type']==9){
            foreach($excel_array as $k=>$v) {
                $city[$k]['name']           = $v[0];
                $city[$k]['stock']          = $v[1];
                $city[$k]['buy_price']      = $v[2];
                $city[$k]['brand']          = $v[3];
                $city[$k]['remark']         = $v[4];
                $city[$k]['add_time']       = time();
                $city[$k]['seller_id']      = $seller_id;
                $city[$k]['type']           = 9;
            }
        }
        else{
            foreach($excel_array as $k=>$v) {
                $tra_id = Db::name('traffic')
                    ->field('tra_id,stock')
                    ->where('name',$v[0])
                   ->where(array('type'=>['neq',9]))
                    ->find();
                if($tra_id){
                    $arr = array(
                        'tra_id' => $tra_id['tra_id'],
                        'stock' => ((int)$tra_id['stock']+(int)$v[2]),
                        'add_time' => time()
                    );
                    $this->all_record($tra_id['tra_id'],$v[2]);
                    Db::name('traffic')->update($arr);
                    continue;
                }
                $city[$k]['name']           = $v[0];
                $city[$k]['pinyin']         = $v[1];
                $city[$k]['stock']          = $v[2];
                $city[$k]['buy_price']      = $v[3];
                $city[$k]['ret_price']      = $v[4];
                $city[$k]['ret_price']      = $v[5];
                $city[$k]['member_price']   = $v[6];
                $city[$k]['remark']         = $v[7];
                $city[$k]['add_time']       = time();
                $city[$k]['seller_id']      = $seller_id;
            }
        }
        Db::name('traffic')->insertAll($city); //批量插入数据
        foreach ($city as $val){
            $this->all_record($val['name'],$val['stock'],2);
        }
        echo json_encode(array('state'=>1));
    }

    /**
     * 打印excel模板
     */
    public function export(){

        vendor("PHPExcel.Classes.PHPExcel.PHPExcel");
        vendor("PHPExcel.Classes.PHPExcel.Writer.IWriter");
        vendor("PHPExcel.Classes.PHPExcel.Writer.Abstract");
        vendor("PHPExcel.Classes.PHPExcel.IOFactory");
        vendor("PHPExcel.Classes.PHPExcel.Writer.Excel5");
        vendor("PHPExcel.Classes.PHPExcel.Writer.Excel2007");
        $objPHPExcel=new \PHPExcel;
        $objWriter=new \PHPExcel_Writer_Excel5($objPHPExcel);
        $objWriter=new \PHPExcel_Writer_Excel2007($objPHPExcel);
        /*--------------设置表头信息------------------*/
        $request = $this->request->param();
        if($request['type']==9){
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', '货品名称')
                ->setCellValue('B1', '数量')
                ->setCellValue('C1', '进价')
                ->setCellValue('D1', '品牌名称')
                ->setCellValue('E1', '备注');
        }
        else{
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', '货品名称')
                ->setCellValue('B1', '拼音码')
                ->setCellValue('C1', '数量')
                ->setCellValue('D1', '进价')
                ->setCellValue('E1', '零售价')
                ->setCellValue('F1', '会员价')
                ->setCellValue('G1', '品牌名称')
                ->setCellValue('H1', '备注');
        }

        /*--------------开始从数据库提取信息插入Excel表中------------------*/
        //$i=2;  //定义一个i变量，目的是在循环输出数据是控制行数
        /*$i = 2,因为第一行是表头，所以写到表格时候只能从第二行开始写。*/
        //$count = count($result);  //计算有多少条数据
        /*for ($i = 2; $i <= $count+1; $i++) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $result[$i-2]['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $result[$i-2]['stock']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $result[$i-2]['buy_price']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $result[$i-2]['ret_price']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $result[$i-2]['pinyin']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $result[$i-2]['brand']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $result[$i-2]['remark']);
        }*/
        /**接下来就是设置导入表的名称等内容了**/
        /*--------------下面是设置其他信息------------------*/

        $objPHPExcel->getActiveSheet()->setTitle('message');      //设置sheet的名称
        $objPHPExcel->setActiveSheetIndex(0);                   //设置sheet的起始位置
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');   //通过PHPExcel_IOFactory的写函数将上面数据写出来
        $PHPWriter = \PHPExcel_IOFactory::createWriter( $objPHPExcel,"Excel2007");
        header('Content-Disposition: attachment;filename="货物模板.xlsx"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $PHPWriter->save("php://output"); //表示在$path路径下面生成demo.xlsx文件
    }

    /**
     * 货流货品修改主页
     * @adminMenu(
     *     'name'   => '货品修改',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '货品修改',
     *     'param'  => ''
     * )
     */
    public function trafficEdit(){
        $id = intval($this->request->param('tra_id'));

        $data = Db::name('traffic')->where('tra_id',$id)->find();

        $where = array(
                    'seller_id'     => $this->admin_user_id, 
                    'type'          => ['neq',9], 
                    'delete_time'   => 0
                );

        $tree   = new Tree();
        $result = Db::name('traffic_category')->where($where)->order(["list_order" => "ASC"])->select();
        $array  = [];
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $data['category_id'] ? 'selected' : '';
            $array[]       = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectCategory = $tree->getTree(0, $str);

        $this->assign("select_category", $selectCategory);
        $this->assign($data);
        return $this->fetch();
    }

    /**
     * 货流货品修改处理
     * @adminMenu(
     *     'name'   => '修改处理',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '修改处理',
     *     'param'  => ''
     * )
     */
    public function postEdit(){
        if($this->request->isPost()){
            $data   = $this->request->param();
            $old_stock = $this->request->param('old_stock');
            $stock     = $data['edit']['stock']-$old_stock;
            $this->all_record($data['edit']['tra_id'],$stock);
            $result = Db::name('traffic')->update($data['edit']);
            if ($result){
                $type      = $this->request->param('type');
                if($type==9){
                    $url='traffic/purchase';
                }else{
                    $url='traffic/index';
                }
            $this->success('修改成功',url($url));
            }else{
                $this->error('修改失败');
            }
        }
    }

    /**
     * 货流货品添加主页
     * @adminMenu(
     *     'name'   => '货品添加',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '货品添加',
     *     'param'  => ''
     * )
     */
    public function trafficAdd()
    {
        $where = array(
                    'seller_id'     => $this->admin_user_id, 
                    'type'          => ['neq',9], 
                    'delete_time'   => 0
                );

        $tree     = new Tree();
        $parentId = intval($this->request->param("parent_id", 0, 'intval'));
        $result   = Db::name('traffic_category')->where($where)->order(["list_order" => "ASC"])->select();
        $array    = [];
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $parentId ? 'selected' : '';
            $array[]       = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectCategory = $tree->getTree(0, $str);

        $this->assign("select_category", $selectCategory);
        $this->assign('seller_id',$this->admin_user_id);
        return $this->fetch();
    }

    /**
     * 货流货品添加处理
     * @adminMenu(
     *     'name'   => '添加处理',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加处理',
     *     'param'  => ''
     * )
     */
    public function addPost(){
        if($this->request->isPost()){
            $data = $this->request->param();

            $result = $this->validate($data['add'],'traffic.apply');
            if($result !== true){
                $this->error($result);
            }
            $result = Db::name('traffic')->insert($data['add'],true);
            $this->all_record($data['add']['name'],$data['add']['stock'],2);
            if ($result){
                $this->success('添加成功',url('traffic/index'));
            }else{
                $this->error('添加失败');
            }
        }
    }

    /**
     * 货流货品删除
     * @adminMenu(
     *     'name'   => '货品删除',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '货品删除',
     *     'param'  => ''
     * )
     */
    public function trafficDel(){
            $id   = $this->request->param("tra_id");
            $type = $this->request->param("type");
            $where['tra_id']  = $id ;
            $where['delete_time']    = strtotime(date('Y-m-d H:i:s',time()));
            $del['object_id']   = $id;
            $del['create_time'] = $where['delete_time'];
            $del['table_name']  = 'traffic';
            if($type==9){
                $del['name']        = '采购信息';
            }else{
                $del['name']        = '货品信息';
            }

            $del['uid']         = session('ADMIN_ID');
            $del['seller_id']        = $this->admin_user_id;

            $req    = Db::name('recycle_bin')->insert($del);
            $status = Db::name('traffic')->update($where);
            if (!empty($status))
            {
                if($type==9){
                    $url='traffic/purchase';
                }else{
                    $url='traffic/index';
                }
                $this->success('修改成功',url($url));
            } else
            {
                $this->error("删除失败！");
            }
    }

    /**
     * 申请记录页面
     * @adminMenu(
     *     'name'   => '申请记录页面',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '申请记录页面',
     *     'param'  => ''
     * )
     */
    public function apply(){
        $request = $this->request->param();
        $Supermarket=session('Supermarket');
        $where  = array();
        if(cmf_get_current_admin_id() != 1)
        {

            if(session('admin_parent_id') == 1)
            {
                $where['seller_id'] = ['eq',session('ADMIN_ID')];
                $this->assign("seller_id",session('ADMIN_ID'));
            }else
            {
                if ($Supermarket!=1){
                    $where['man_id']    = ['eq',session('ADMIN_ID')];
                }
                $where['seller_id'] = ['eq',session('admin_parent_id')];
            }
        }
        if(!empty($request['keyword'])){
            $ret = Validate::is($request['keyword'],'chs');
            if($ret){
                $where['b.name'] = ['like',"%".$request['keyword']."%"];
            }else{
                $where['b.pinyin'] = ['like',"%".$request['keyword']."%"];
            }
        }
        if(!empty($request['user_nickname'])){
            $ret = Validate::is($request['user_nickname'],'chs');
            if($ret){
                $where['c.user_nickname'] = ['like',"%".$request['user_nickname']."%"];
            }else{
                $where['c.user_login'] = ['like',"%".$request['user_nickname']."%"];
            }
        }

        $traffic_record = Db::name('traffic_record');

        if(!empty($request['beginTime']) || !empty($request['endTime'])){
            if(empty($request['beginTime'])){
                $request['beginTime']= '1970-01-01' ;
            }
            $endTime = $request['endTime'];
            if(empty($endTime)){
                $endTime= date('Y-m-d',time());
            }
            $endTime =    date("Y-m-d",strtotime("$endTime   +1   day"));
            $traffic_record->whereTime('start_time','between',[$request['beginTime'],$endTime]);
        }



        $result = $traffic_record
                            ->field('a.*,b.name,b.ret_price,c.user_nickname,c.user_login')
                            ->alias('a')
                            ->join('__USER__ c','c.id=a.man_id')
                            ->join('__TRAFFIC__ b','a.tra_id=b.tra_id')
                            ->where($where)
                            ->paginate(10);

        $result->appends($request);
        $page = $result->render();
        $this->assign("Supermarket",$Supermarket);
        $this->assign('data',$result);
        $this->assign("page",$page);
        return $this->fetch();
    }

    /**
     * 申请添加
     * @adminMenu(
     *     'name'   => '申请添加',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '申请添加',
     *     'param'  => ''
     * )
     */
    public function applyAdd(){
        if($this->request->isPost()){
            $data = $this->request->param();
            if(empty($data['add']['tra_id'])){
                $this->error('数据丢失');
            }
            $goods = Db::name('traffic')->where('tra_id',$data['add']['tra_id'])->find();
            if(empty($goods)){
                $this->error('数据丢失');
            }
            $data['add']['man_id'] = session('ADMIN_ID');
            $data['add']['all_price']  = $goods['ret_price']*$data['add']['tra_num'];
            $data['add']['start_time'] = time();
            $result = Db::name('traffic_record')->insert($data['add']);
            if($result){
                $this->success('申请中');
            }else{
                $this->error('申请失败');
            }
        }
    }

    /**
     * 处理申请
     * @adminMenu(
     *     'name'   => '处理申请',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '处理申请',
     *     'param'  => ''
     * )
     */
    public function apply_result(){
        $data   =  $this->request->param();
        if ($data['result'] != 1){
            $data['end_time'] = time();
        }
        $result =  Db::name('traffic_record')->update($data);
        if($data['result'] == 1){
            $thisOne = Db::name('traffic_record')
                ->alias('a')
                ->join('__USER__ b','a.man_id=b.id')
                ->field('a.tra_id,a.tra_num,b.menu_id')
                ->where('a.re_id',$data['re_id'])
                ->find();
            Db::name('traffic')
                ->where('tra_id',$thisOne['tra_id'])
                ->setDec('stock',$thisOne['tra_num']);
            TrafficReportController::outTraffic($thisOne['tra_id'],$thisOne['tra_num'],$thisOne['menu_id'],2);
        }
        if($result){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }
    }

    /**
     * 采购主页
     * @adminMenu(
     *     'name'   => '采购主页',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '采购主页',
     *     'param'  => ''
     * )
     */
    public function purchase()
    {
        $request = $this->request->param();
        $where =array('a.delete_time'=>0,'a.type'=>9);
        if(cmf_get_current_admin_id() != 1)
        {
            if(session('admin_parent_id') == 1)
            {
                $where['a.seller_id'] = ['eq',session('ADMIN_ID')];
                $this->assign("seller_id",session('ADMIN_ID'));
            }else
            {
                $where['a.seller_id'] = ['eq',session('admin_parent_id')];
            }
        }
        if(!empty($request['category'])){
            $where['b.id'] = $request['category'];
        }
        $model    = model('TrafficCategory');
        $category = $model->index(9);
        $this->assign('category',$category);
        if(!empty($request['keyword'])){
            $ret = Validate::is($request['keyword'],'chs');
            if($ret){
                $where['a.name'] = ['like',"%".$request['keyword']."%"];
            }else{
                $where['a.pinyin'] = ['like',"%".$request['keyword']."%"];
            }
        }
        $traffic = Db::name('traffic');
        if(!empty($request['beginTime']) || !empty($request['endTime'])){
            if(empty($request['beginTime'])){
                $request['beginTime']= '1970-01-01' ;
            }
            $endTime = $request['endTime'];
            if(empty($endTime)){
                $endTime= date('Y-m-d',time());
            }
            $endTime =    date("Y-m-d",strtotime("$endTime   +1   day"));
            $traffic->whereTime('add_time','between',[$request['beginTime'],$endTime]);

        }

        $result = $traffic->alias('a')
                ->join('__TRAFFIC_CATEGORY__ b','a.category_id=b.id')
                ->where($where)
                ->field('a.*,b.name as category_name')
                ->paginate(10);
        $result->appends($request);
        $page = $result->render();
        $this->assign("Supermarket",session('Supermarket'));
        $this->assign('data',$result);
        $this->assign("page",$page);
        return $this->fetch();
    }

    /**
     * 添加采购主页
     * @adminMenu(
     *     'name'   => '添加采购',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加采购',
     *     'param'  => ''
     * )
     */
    public function purchaseAddIndex()
    {
        $where = array(
                    'seller_id'     => $this->admin_user_id, 
                    'type'          => ['eq',9], 
                    'delete_time'   => 0
                );

        $tree     = new Tree();
        $parentId = intval($this->request->param("parent_id", 0, 'intval'));
        $result   = Db::name('traffic_category')->where($where)->order(["list_order" => "ASC"])->select();
        $array    = [];
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $parentId ? 'selected' : '';
            $array[]       = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectCategory = $tree->getTree(0, $str);

        $this->assign("select_category", $selectCategory);
        $this->assign('seller_id',$this->admin_user_id);
        return $this->fetch();
    }

    /**
     * 货流货品添加处理
     * @adminMenu(
     *     'name'   => '添加处理',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加处理',
     *     'param'  => ''
     * )
     */
    public function purchaseAddPost(){
        if($this->request->isPost()){
            $data = $this->request->param();

            $result = $this->validate($data['add'],'traffic.purchase');
            if($result !== true){
                $this->error($result);
            }

            $result=Db::name('traffic')->insert($data['add']);
            $this->all_record($data['add']['name'],$data['add']['stock'],2);
            if ($result){

                $this->success('添加成功',url('traffic/purchase'));
            }else{
                $this->error('添加失败');
            }
        }
    }

    /**
     * 采购修改
     * @adminMenu(
     *     'name'   => '采购修改',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '采购修改',
     *     'param'  => ''
     * )
     */
    public function purchaseEdit()
    {
        $id = intval($this->request->param('tra_id'));
        $data = Db::name('traffic')->where('tra_id',$id)->find();

        $where = array(
                    'seller_id'     => $this->admin_user_id, 
                    'type'          => ['eq',9], 
                    'delete_time'   => 0
                );

        $tree   = new Tree();
        $result = Db::name('traffic_category')->where($where)->order(["list_order" => "ASC"])->select();
        $array  = [];
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $data['category_id'] ? 'selected' : '';
            $array[]       = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectCategory = $tree->getTree(0, $str);

        $this->assign("select_category", $selectCategory);
        $this->assign($data);
        return $this->fetch();
    }



    /**
     * 入库记录
     * @adminMenu(
     *     'name'   => '入库记录',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '入库记录',
     *     'param'  => ''
     * )
     */
    public function all_record($tra_id,$num,$type=1){
        switch ($type){
            case 1:
                $stock = Db::name('traffic')
                    ->where('tra_id',$tra_id)
                    ->field('tra_id,stock')
                    ->find();
                break;
            default:
                $stock = Db::name('traffic')
                    ->where('name',$tra_id)
                    ->group('name')
                    ->order('tra_id DESC')
                    ->field('tra_id')
                    ->find();
        }
        $arr = array(
            'record_number' => "RKD".date('YmdHis').mt_rand(000,999),
            'tra_id'        => $stock['tra_id'],
            'before'        => empty($stock['stock']) ? 0 : $stock['stock'],
            'add_num'       => $num,
            'time'          => time(),
            'seller_id'     => $this->admin_user_id,
        );
        $model = model('traffic');
        $model->openAlert($stock['tra_id'],2);
        Db::name('traffic_all_record')
            ->insert($arr);
    }


    /**
     * 添加商品
     * @adminMenu(
     *     'name'   => '添加商品',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加商品',
     *     'param'  => ''
     * )
     */
    public function addGoods(){
        $request = $this->request->param();
        $this->all_record($request['tra_id'],$request['tra_num']);
        $result = Db::name('traffic')
            ->where('tra_id',$request['tra_id'])
            ->setInc('stock',$request['tra_num']);
        if($result){
            $this->success('添加成功');
        }else{
            $this->success('添加失败');
        }


    }

    /**
     * 填写申请
     * @adminMenu(
     *     'name'   => '填写申请',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '填写申请',
     *     'param'  => ''
     * )
     */
    public function addapply(){
        if($this->request->isPost()){
            $request = $this->request->param();
            $arr     = array(
                'name'      => $request['name'],
                'pinyin'    => $request['pinyin'],
                'add_time'  => time(),
                'seller_id' => $this->admin_user_id,
            );
            $id  = Db::name('traffic')->insertGetId($arr);
            if(empty($id)){
                $this->error('数据错误');
            }
            $narr = array(
                'tra_id'        =>   $id,
                'tra_num'       =>   $request['stock'],
                'all_price'     =>   0,
                'man_id'        =>   session('ADMIN_ID'),
                'start_time'    =>   time(),
                'remark'        =>   $request['remark'],
            );
            $result = Db::name('traffic_record')->insert($narr);
            if($result){
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }
        }
        return $this->fetch();
    }
}