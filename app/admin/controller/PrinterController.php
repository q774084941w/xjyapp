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
use app\user\model\UserModel;
use cmf\controller\AdminBaseController;
use think\Db;
use tree\Tree;

class PrinterController extends AdminBaseController

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
     * 设备管理
     * @adminMenu(
     *     'name'   => '设备管理',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '设备管理',
     *     'param'  => ''
     * )
     */

    public function index(){
        $request        = input('request.');
        $keywordComplex = [];
        if (!empty($request['keyword']))
        {
            $keyword = $request['keyword'];
            $keywordComplex['printer_id']  = ['like', "%$keyword%"];
        }
        $seller_id = $this->admin_user_id;

        $data = Db::name('printer')
                    ->where('seller_id',$seller_id)
                    ->where($keywordComplex)
                    ->paginate(10);

        $data->appends($request);
        $page = $data->render();
        $this->assign('id',session('ADMIN_ID'));
        $data = $this->myPosition($data);
        $this->assign("data", $data);
        $this->assign("page",$page);

        //位置信息
        $model      = model('PrinterPosition');
        $position   = $model->index($this->admin_user_id );
        $this->assign('position',$position);

        return $this->fetch();
    }

    /**
     * 获取当前设备位置
     * @adminMenu(
     *     'name'   => '获取当前设备位置',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '获取当前设备位置',
     *     'param'  => ''
     * )
     */
    public function myPosition($data , $type=1)
    {
        $newData = array();
        $model   = model('PrinterPosition');
        switch ($type)
        {
            case 2:
                $newData = $data;
                $name = $model->getMyAll($data['printer_id']);
                $nName = array();
                foreach ($name as $vo)
                {
                    $nName[] = $vo['posit_id'];
                }
                $newData['position'] = $nName;
                break;
            default:
                foreach ($data as $key=>$val)
                {
                    $newData[$key] = $val;
                    $name = $model->getMyAll($val['printer_id']);
                    $nName = array();
                    foreach ($name as $vo)
                    {
                        $nName[] = $vo['name'];
                    }
                    $newData[$key]['position'] = implode(',',$nName);
                }
        }

        return $newData;
    }

    /**
     * 添加打印机主页
     * @adminMenu(
     *     'name'   => '添加打印机',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '添加打印机',
     *     'param'  => ''
     * )
     */

    public function add_index()
    {
        $seller_id = $this->admin_user_id;

        $tree = new Tree();
        $result   = Db::name('FoodMenu')->where('seller_id',$seller_id)->order(["list_order" => "ASC"])->select();
        $array    = [];
        foreach ($result as $r) {
            $array[]       = $r;
        }
        $str      = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectCategory = $tree->getTree(0, $str);

        $this->assign("select_category", $selectCategory);


        //位置信息
        $model      = model('PrinterPosition');
        $position   = $model->index($this->admin_user_id );
        $this->assign('position',$position);


        return $this->fetch();
    }

    /**
     * 添加处理
     * @adminMenu(
     *     'name'   => '添加处理',
     *     'parent' => 'add_index',
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
            $id = $this->admin_user_id;
            if(!empty($id)){
                $data   = $this->request->param();
                $result = $this->validate($data,'Printer');
                if($result !== true){
                    $this->error($result);
                }else{
                    $this->isHave($data['printer_id'],$id);
                    $data['seller_id'] = $id;
                    //注册
                    $apiphp = new APIPHP();
                    $result = $apiphp->addprinter($data);
                    if($result['code']==1111){

                        $menu_id      = array_shift($data);
                        $position     = array_shift($data);

                        $model = model('printer');
                        $model->insert($data);
                        //关联菜系
                        foreach ($menu_id as $val)
                        {
                            $model->name('printer_menu')
                                ->insert(array(
                                    'print_id' => $data['printer_id'],
                                    'menu_id'  => $val,
                                ));
                        }

                        //关联位置
                        foreach ($position as $val)
                        {
                            $model->name('printer_to_position')
                                ->insert(array(
                                    'printer_id' =>$data['printer_id'],
                                    'posit_id'   => $val,
                                ));
                        }

                        $this->success($result['sub_msg'],url('Printer/index'));
                    }elseif ($result['code']==0000){
                        $this->error($result['sub_msg']);
                    }else{
                        $this->error("未知错误".$result['sub_msg']);
                    }
                }
            }else{
                $this->error('您不能操作');
            }
        } else{
            $this->error('操作错误');
        }
    }

    /**
     * 判断是否重复
     * @adminMenu(
     *     'name'   => '判断是否重复',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '判断是否重复',
     *     'param'  => ''
     * )
     */
    public function isHave($print_id,$seller_id){
        $id = Db::name('printer')
            ->where('printer_id',$print_id)
            ->where('seller_id',$seller_id)
            ->value('printer_id');
        if(!empty($id)){
            $this->error('设备号不能重复');
        }
        return true;
    }

    /**
     * 更改状态
     * @adminMenu(
     *     'name'   => '更改状态',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '更改状态',
     *     'param'  => ''
     * )
     */
    public function type(){
        $data = $this->request->param();
        if($data['type']==1){
            $result = Db::name('printer')
                ->where('printer_id',$data['id'])
                ->update(array('type'=>0));
            if($result){
                return 1100;
            }else{
                return '更改错误';
            }
        }else{
            $result = Db::name('printer')
                ->where('printer_id',$data['id'])
                ->update(array('type'=>1));
            if($result){
                return 1111;
            }else{
                return '更改错误';
            }
        }
    }

    /**
     * 更改信息页面
     * @adminMenu(
     *     'name'   => '更改信息页面',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '更改信息页面',
     *     'param'  => ''
     * )
     */

    public function change()
    {
        if($this->request->isPost()){
           $data = $this->request->param();
           $id   = $data['old_id'];
           if($id!=$data['printer_id']){
               $result = $this->changeCode($data,1);
               if($result['code']!=1111){
                   $this->error($result['sub_msg']);
               }
                $this->changePrinterMenu($data['menu_id'],$id,$data['printer_id']);
                $this->changePosition($data['position'],$id,$data['printer_id']);

               array_shift($data);
                $printer_id = array_shift($data);
                array_shift($data);
                array_shift($data);
                $data['printer_id'] = $printer_id;
               $result = Db::name('printer')->where('printer_id',$id)->update($data);
               if ($result)
               {
                   $this->success("修改成功", url("printer/index"));
               }else
               {
                   if($id==$data['printer_id']){
                       $this->error('您没有做任何修改请不要提交');
                   }
                   $this->error("修改失败");
               }
           }else{
               $menu=null;
               if(!empty($data['menu_id'])){
                   $menu = $data['menu_id'];
               }
               $this->changePrinterMenu($menu,$data['printer_id']);
               $this->changePosition($data['position'],$id);
               $result = $this->changeCode($data,2);
               if($result['code']!=1111){
                   $this->error($result['sub_msg']);
               }
               array_shift($data);
               array_shift($data);
               array_shift($data);
               array_shift($data);
               $result = Db::name('printer')->where('printer_id',$id)->update($data);
               if ($result)
               {
                   $this->success("修改成功", url("printer/index"));
               }else
               {
                   if($id==$data['printer_id']){
                       $this->error('您没有做任何修改请不要提交');
                   }
                   $this->error("修改失败");
               }
           }
        }

        $id   = $this->request->param();
        $data = Db::name('printer')
            ->where('printer_id',$id['id'])
            ->find();
        $this->findMenu($data['printer_id']);

        $data = $this->myPosition($data,2);

        $this->assign('data',$data);

        //位置信息
        $model      = model('PrinterPosition');
        $position   = $model->index($this->admin_user_id );
        $this->assign('position',$position);

        return $this->fetch();
    }



    /**
     * 修改执行
     * @param array $data 修改的数据
     * @param int $type 类型
     * @return array|string
     */
    protected function changeCode($data,$type){
        if(empty($data)){
            $this->error('数据为空');
        }
        $chan = new APIPHP();
        switch ($type){
            case 1:
                $old_id = $data['old_id'];
                array_shift($data);
                $result = $chan->addprinter($data);
                if($result['code']!=1111){
                    return $result;
                }
                $result = $chan->delete_code($old_id);
//                dump($result);exit;
                return $result;
                break;
            default:
                return $chan->change($data);
        }

    }

    /**
     * 查找包含的菜系
     * @adminMenu(
     *     'name'   => '查找包含的菜系',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '查找包含的菜系',
     *     'param'  => ''
     * )
     */
    public function findMenu($printer_id){
        $seller_id = $this->admin_user_id;
        $tree     = new Tree();
        //查询当前商家所有的菜系
        $result   = Db::name('FoodMenu')
                    ->where('seller_id',$seller_id)
                    ->order(["list_order" => "ASC"])
                    ->select();
        //查询当前打印机拥有的数据
        $all      = Db::name('printer_menu')
                    ->field('menu_id')
                    ->where('print_id',$printer_id)
                    ->select();
        //整合二维数组
        $all      = array_column(json_decode(json_encode($all),true),'menu_id');
        $array    = [];
        foreach ($result as $r) {
            $r['selected'] = in_array($r['id'],$all) ? 'selected' : '';
            $array[]       = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectCategory = $tree->getTree(0, $str);
        $this->assign("select_category", $selectCategory);
    }

    /**
     * 更改包含菜系
     * @adminMenu(
     *     'name'   => '更改包含菜系',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '更改包含菜系',
     *     'param'  => ''
     * )
     */
    public function changePrinterMenu($data,$print,$newPrint=null){
        //清空
        if (empty($data))
        {
            Db::name('printer_menu')->where('print_id',$print)->delete();
            return true;
        }
        //旧的
        $old  = Db::name('printer_menu')->where('print_id',$print)->select();

        $all  = array_column(json_decode(json_encode($old),true),'menu_id');
        if (empty($newPrint))
        {
           $print_id = $print;
        }
        else
        {
            $print_id = $newPrint;
            foreach ($old as $val)
            {
                Db::name('printer_menu')
                    ->where('id',$val['id'])
                    ->update(array('print_id' => $print_id));
            }

        }
        //添加原来没有的
        foreach ($data as $val)
        {
            if(!in_array($val,$all))
            {
                Db::name('printer_menu')->insert(array(
                    'print_id' => $print_id,
                    'menu_id'  => $val,
                ));
            }
        }

        //删除现在不要的
        foreach ($old as $val)
        {
            if(!in_array($val['menu_id'],$data)){
                Db::name('printer_menu')->where('id',$val['id'])->delete();
            }
        }
        return true;
    }

    /**
     * 更改包含位置
     * @adminMenu(
     *     'name'   => '更改包含位置',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '更改包含位置',
     *     'param'  => ''
     * )
     */
    public function changePosition($data,$printer_id,$newprinter_id=null){
        $model = model('PrinterPosition');
        //清空
        if (empty($data))
        {
            $model->name('printer_to_position')->where('printer_id',$printer_id)->delete();
            return true;
        }
        //旧的
        $old =  $model
            ->name('printer_to_position')
            ->where('printer_id',$printer_id)
            ->select();
        $old = json_decode(json_encode($old),true);
        $all = array_column($old,'posit_id');
        if (empty($newPrint))
        {
            $print_id = $printer_id;
        }
        else
        {
            $print_id = $newprinter_id;
            //将所有旧的更改
            foreach ($old as $val)
            {
                $model
                    ->where('id',$val['id'])
                    ->update(array('printer_id'=>$print_id));
            }
        }

        //添加原来没有的
        foreach ($data as $val)
        {
            if (!in_array($val,$all))
            {
                $model->insert(
                    array(
                        'printer_id' => $print_id,
                        'posit_id'   => $val,
                    )
                );
            }
        }

        //删除现在不要的
        foreach ($old as $val)
        {
            if (!in_array($val['posit_id'],$data))
            {
                $model->where('id',$val['id'])->delete();
            }
        }
        return true;

    }

}