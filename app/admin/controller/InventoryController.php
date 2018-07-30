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

class InventoryController extends AdminBaseController
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
     * 盘点统计
     * @adminMenu(
     *     'name'   => '盘点统计',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '盘点统计',
     *     'param'  => ''
     * )
     */
    public function index()
    {
        $whereTime = null;
        $request = $this->request->param();
        $type    = 1;
        if(!empty($request['type'])){
            $type = null;
        }

        $where = array(
            'a.seller_id' => $this->admin_user_id,
            'a.delete_time' => 1,
        );
        $inModel = model('TrafficInventory');
        $result  = $inModel->index($type,$where,$whereTime);
        $this->assign('data',$result);
        return $this->fetch();
    }

    /**
     * 新增盘点
     * @adminMenu(
     *     'name'   => '新增盘点',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '新增盘点',
     *     'param'  => ''
     * )
     */
    public function addNew()
    {
        $request        =  $this->request->param();
        $menu_id        = intval($this->request->param("menu_id"));


        if($this->request->isPost()){
            if(empty($request['actual'])||empty($request['why'])||empty($request['tra_id'])||empty($request['tra_name'])||empty($request['number'])){
                $this->error('数据不完整',url('Inventory/addNew'));
            }
            $profit  = 0;
            $deficit = 0;
            $inven_type = 2;
            $model = model('traffic');
            foreach ($request['actual'] as $key=>$val){

                $data = $model->howMuch($key);
                $arr  = array(
                    'inven_number'  => $request['number'],
                    'tra_id'        => $data['tra_id'],
                    'record'        => $data['stock'],
                    'actual'        => $val,
                    'why'           => $request['why'][$key],
                );
                $model->inventoryMore($arr);
                //记录数据大于实际，亏
                if($data['stock']>$val){
                    $deficit += ($data['stock']-$val)*$data['buy_price'];
                    $inven_type=1;
                }
                //记录数据小于实际，盈
                elseif($data['stock']<$val){
                    $profit += ($val-$data['stock'])*$data['buy_price'];
                    $inven_type=1;
                }
            }

            $inModel = model('TrafficInventory');
            $result  = $inModel->thisInsert($request['number'],$profit,$deficit);
            if($result){
                $this->success('新增成功',url('Inventory/index'));
            }else{
                $this->error('新增失败',url('Inventory/addNew'));
            }
        }
        //单据编号
        $number = 'PD'.date('YmdH').mt_rand(000,999);
        $this->assign('number',$number);

        //盘点人姓名
        $model  = model('user');
        $userName = $model->myName(session('ADMIN_ID'));
        $name = empty($userName['user_nickname'])?$userName['user_login']:$userName['user_nickname'];
        $this->assign('name',$name);

        //服务厅列表
       /* $model = model('FoodMenu');
        $menu = $model->index();
        $this->assign('menu',$menu);
        $this->assign('menu_id',$menu_id);*/


       //获取仓库所有分类
        $model      = model('TrafficCategory');
        $Category   = $model->parent_id();
        $this->assign('category',$Category);


        return $this->fetch();
    }


    /**
     * 获取货品库存信息AJAX
     * @adminMenu(
     *     'name'   => '获取货品库存',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '获取货品库存',
     *     'param'  => ''
     * )
     */
    public function getGoods()
    {
        $data = $this->request->param();
        $arr   = array();
        $model = model('traffic');
        foreach ($data['data'] as $val)
        {
            $arr[]=$model->howMuch($val);
        }

        echo json_encode($arr);exit;
    }

    /**
     * 拼接字符串
     * @adminMenu(
     *     'name'   => '拼接字符串',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '拼接字符串',
     *     'param'  => ''
     * )
     */
    public function takeString($arr)
    {
        if(empty($arr)){
            return false;
        }
        $string = "";
        foreach ($arr as $key=>$val)
        {
            $string .="<tr>";
            $string .= "<td><input name='tra_id[]' value='".$key."' type='hidden'/></td>
                        <td> 
                         <span style=\"width: 80%;float: left;\">
                           <input type=\"text\" class=\" form-control\" name='tra_name[]' value='".$val['name']."(".$val['cateName'].")' readonly>
                        </span>
                        <button type=\"button\" class=\"btn btn-success \" name=\"selectOne\" style=\"float: right;margin-right: 20px\">选择</button>
                        </td>
                        <td>".$val['traffic_number']."</td>
                        <td>".$val['stock']."</td>
                        <td>
                            <input type='text' class=\" form-control\" name='actual[".$key."]' value='".$val['stock']."'/>
                        </td>
                        <td>
                              <input type='text' class=\" form-control\" name='why[".$key."]' value=''/>
                        </td>";
            $string .="</tr>";
        }

        return $string;
    }

    /**
     * 盘点详情
     * @adminMenu(
     *     'name'   => '盘点详情',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '盘点详情',
     *     'param'  => ''
     * )
     */
    public function details(){
        $request = $this->request->param();
        if(empty($request['inven_number'])){
            $this->error('错误操作',url("Inventory/index"));
        }
        $model = model('TrafficInventory');
        $data = $model->details($request['inven_number']);

        $this->assign('all',$data['all']);
        $this->assign('data',$data['more']);
        return $this->fetch();
    }

    /**
     * 盘点作废
     * @adminMenu(
     *     'name'   => '盘点作废',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '盘点作废',
     *     'param'  => ''
     * )
     */
    public function changeType(){
        $request = $this->request->param();
        if(empty($request['inven_id'])){
            $this->error('错误操作',url("Inventory/index"));
        }
        $model  = model('TrafficInventory');
        $result = $model->changeType($request['inven_id']);
        if($result){
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }
}