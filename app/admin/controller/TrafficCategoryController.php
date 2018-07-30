<?php
// +----------------------------------------------------------------------
// | XjyApplet [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright © 2016-2026 AII Rights Reserved  http://www.ccapp.com.cn/
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +---------------------------------------------------------------------
// | Author: 阿黎 < 3289457575@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use tree\Tree;

/**
 * Class TrafficCategoryController
 * @package app\admin\controller
 * @adminMenuRoot(
 *     'name'   => '商品分类管理',
 *     'action' => 'default',
 *     'parent' => '',
 *     'display'=> true,
 *     'order'  => 10000,
 *     'icon'   => '',
 *     'remark' => '商品分类管理'
 * )
 */
class TrafficCategoryController extends AdminBaseController
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
     * 分类列表
     * @adminMenu(
     *     'name'   => '分类列表',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '分类列表',
     *     'param'  => ''
     * )
     */
	public function index()
	{  
        $type = intval($this->request->param("type", 0, 'intval'));

        if(!empty($type))
        {
            $type_where = ['eq',$type];
            $this->type = $type;
        }else
        {
            $type_where = ['neq',9];
        }     

        $where = array(
                    'seller_id'     => $this->admin_user_id, 
                    'type'          => $type_where, 
                    'delete_time'   => 0
                );

		$result     = Db::name('traffic_category')->where($where)->order(["list_order" => "ASC"])->select()->toArray();
        $tree       = new Tree();
        $tree->icon = ['&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ '];
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';

        $newMenus = [];
        foreach ($result as $m) {
            $newMenus[$m['id']] = $m;
        }
        foreach ($result as $key => $value) {

            $result[$key]['parent_id_node'] = ($value['parent_id']) ? ' class="child-of-node-' . $value['parent_id'] . '"' : '';
            $result[$key]['style']          = empty($value['parent_id']) ? '' : 'display:none;';
            $result[$key]['str_manage']     = '<a href="' . url("TrafficCategory/add", ["parent_id" => $value['id'], "menu_id" => $this->request->param("menu_id"),"type" =>$type])
                . '">添加子分类</a>  <a href="' . url("TrafficCategory/edit", ["id" => $value['id'], "menu_id" => $this->request->param("menu_id"),"type" =>$type])
                . '">' . lang('EDIT') . '</a>  <a class="js-ajax-delete" href="' . url("TrafficCategory/delete", ["id" => $value['id'], "menu_id" => $this->request->param("menu_id")]) . '">' . lang('DELETE') . '</a> ';
            $result[$key]['status']         = $value['status'] ? lang('DISPLAY') : lang('HIDDEN');
            
            // . lang('ADD_SUB_MENU') . 
        }

        $tree->init($result);
        $str      = "<tr id='node-\$id' \$parent_id_node style='\$style'>
                        <td style='padding-left:20px;'><input name='list_orders[\$id]' type='text' size='3' value='\$list_order' class='input input-order'></td>
                        <td>\$id</td>
                        <td>\$spacer\$name</td>	                        
                        <td>\$status</td>
                        <td>\$str_manage</td>
                    </tr>";
        $category = $tree->getTree(0, $str);
        $this->assign("category", $category);
        $this->assign("type", $type);

        return $this->fetch('index');
	}

    /**
     * 只针对采购分类列表
     * @adminMenu(
     *     'name'   => '只针对采购分类列表',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '只针对采购分类列表  采购分类  type=9 ',
     *     'param'  => ''
     * )
     */
    public function purchase_index()
    {
        header('Location:'.url("TrafficCategory/index", ["type" =>9]));
    }

	/**
     * 分类添加
     * @adminMenu(
     *     'name'   => '分类添加',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '分类添加',
     *     'param'  => ''
     * )
     */
    public function add()
    {
        $type = intval($this->request->param("type", 0, 'intval'));

        if(!empty($type))
        {
            $type_where = ['eq',$type];
        }else
        {
            $type_where = ['neq',9];
        }

        $where = array(
                    'seller_id'     => $this->admin_user_id, 
                    'type'          => $type_where, 
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
        $this->assign("type", $type);

        return $this->fetch();
    }

    /**
     * 分类添加提交保存
     * @adminMenu(
     *     'name'   => '分类添加提交保存',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '分类添加提交保存',
     *     'param'  => ''
     * )
     */
    public function addPost()
    {
        if ($this->request->isPost()) 
        {
            $result = $this->validate($this->request->param(), 'AdminMenu.class');
            if ($result !== true) 
            {
                $this->error($result);
            }else 
            {
                $type = intval($this->request->param("type", 0, 'intval'));
                $data = $this->request->param();
                $data['seller_id'] = $this->admin_user_id;
                $data['type'] = $type;
                Db::name('traffic_category')->strict(false)->field(true)->insert($data);                        
            }
                $this->success("添加成功！", url('TrafficCategory/index',["type" =>$type]));
        }
    }

    /**
     * 分类编辑
     * @adminMenu(
     *     'name'   => '分类编辑',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '分类编辑',
     *     'param'  => ''
     * )
     */
    public function edit()
    {
        $type = intval($this->request->param("type", 0, 'intval'));

        if(!empty($type))
        {
            $type_where = ['eq',$type];
        }else
        {
            $type_where = ['neq',9];
        }

        $where = array(
                    'seller_id'     => $this->admin_user_id, 
                    'type'          => $type, 
                    'delete_time'   => 0
                );

        $tree   = new Tree();
        $id     = intval($this->request->param("id", 0, 'intval'));
        $rs     = Db::name('traffic_category')->where(["id" => $id])->find();
        $result = Db::name('traffic_category')->where($where)->order(["list_order" => "ASC"])->select();
        $array  = [];
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $rs['parent_id'] ? 'selected' : '';
            $array[]       = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $selectCategory = $tree->getTree(0, $str);
        $this->assign("data", $rs);
        $this->assign("select_category", $selectCategory);
        $this->assign("type", $type);

        return $this->fetch();
    }

    /**
     * 分类编辑提交保存
     * @adminMenu(
     *     'name'   => '分类编辑提交保存',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '分类编辑提交保存',
     *     'param'  => ''
     * )
     */
    
    public function editPost()
    {
        if ($this->request->isPost()) {
            $id      = intval($this->request->param('id', 0, 'intval'));
            $type    = intval($this->request->param("type", 0, 'intval'));
            $oldMenu = Db::name('traffic_category')->where(['id' => $id])->find();

            $result = $this->validate($this->request->param(), 'AdminMenu.class');

            if ($result !== true) {
                $this->error($result);
            } else {
                Db::name('traffic_category')->strict(false)->field(true)->update($this->request->param());

                $this->success("修改成功！",url('TrafficCategory/index',["type" =>$type]));
            }
        }
    }

    /**
     * 分类删除
     * @adminMenu(
     *     'name'   => '分类删除',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '分类删除',
     *     'param'  => ''
     * )
     */
    public function delete()
    {
        $id    = intval($this->request->param("id", 0, 'intval'));
        $count = Db::name('traffic_category')->where(["parent_id" => $id])->count();
        if ($count > 0) {
            $this->error("该分类下还有子分类，无法删除！若要删除，请将子分类全部删除");
        }
        if (Db::name('traffic_category')->delete($id) !== false) {
            $this->success("删除分类成功！");
        } else {
            $this->error("删除失败！");
        }
    }

    /**
     * 分类排序
     * @adminMenu(
     *     'name'   => '分类排序',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '分类排序',
     *     'param'  => ''
     * )
     */
    public function sort(){
        if($this->request->isPost()){
            $data = $this->request->param();
            if(!empty($data['list_orders'])){
                foreach ($data['list_orders'] as $key=>$val){
                    $new=array(
                        'id'          => $key,
                        'list_order' => $val
                    );
                    Db::name('traffic_category')->update($new);
                }
                $this->success('排列成功');
            }
        }else{
            $this->error('错误操作');
        }
    }

    /**
     * 获取子类
     * @adminMenu(
     *     'name'   => '获取子类',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '获取子类',
     *     'param'  => ''
     * )
     */
    public function getAllChild(){
        if ($this->request->isPost())
        {
            $request = $this->request->param();
            $model   = model('TrafficCategory');
            $data    = $model ->parent_id($request['parent_id']);
            echo  json_encode($data);exit;
        }
        else
        {
            $this->error('错误操作');
        }
    }
}
