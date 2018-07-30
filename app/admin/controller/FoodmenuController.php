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
use think\Validate;
use tree\Tree;

class FoodmenuController extends AdminBaseController
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
     * 商家菜单管理列表
     * @adminMenu(
     *     'name'   => '商家菜单管理',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '商家菜单管理',
     *     'param'  => ''
     * )
     */
    
	public function index()
	{
          $id = $this->request->param("id", 0, 'intval');
            $request = $this->request->param();
          if(empty($id) and cmf_get_current_admin_id() !=1)
          {
              $id = $this->admin_user_id ;

          }

          if(!empty($id)){      
               
               $seller   = Db::name('seller')->where(['id'=>$id])->find();

               if (empty($seller)) 
               {
                 $this->error("您还未创建商家！",'seller/sellerAdd',array('id'=>session('ADMIN_ID')));
               }elseif($seller['id'] == session('ADMIN_ID') or cmf_get_current_admin_id() == 1 or session('admin_parent_id') != 1)
               {
                   $where = array();

                   if (!empty($request['menu']))
                   {
                        $where['b.parent_id'] = $request['menu'];
                        $this->assign('pid',$request['menu']);
                   }

                   if (!empty($request['menu_id']))
                   {
                        $where['b.id'] = $request['menu_id'];
                       $this->assign('menu_id',$request['menu_id']);
                   }

                   if (!empty($request['keyword']))
                   {
                       $ret = Validate::is($request['keyword'],'chs');
                       if ($ret)
                       {
                           $where['a.food_name'] = ['like',"%".$request['keyword']."%"];
                       }
                       else
                       {
                           $where['a.pinyin'] = ['like',"%".$request['keyword']."%"];
                       }
                   }

                    $data     = Db::name('seller_menu')
                                    ->alias('a')
                                    ->join('__FOOD_MENU__ b','b.id = a.food_class')
                                    ->where('a.delete_time',0)
                                    ->where('a.seller_id',$id)
                                    ->where($where)
                                    ->field('a.*,b.name')
                                    ->order("a.food_class DESC")
                                    ->paginate(8);
                    $data->appends($request);
                    $page     = $data->render();
                   $menu = Db::name('food_menu')
                       ->field('id,name,parent_id')
                       ->where('seller_id',$id)
                       ->select();
                   $this->assign('menu',$menu);
                    $this->assign("page",$page);
                    $this->assign('seller',$seller);
                    $this->assign('data',$data);
               }else{
                    $this->error("不能查看他人菜单！");
               }
          }elseif(cmf_get_current_admin_id() == 1)
          {
               $this->redirect('seller/index');
          }
          else
          {
               $this->error("错误操作！");
          }
          return $this->fetch();
	}


     /**
     * 菜单删除操作
     * @adminMenu(
     *     'name'   => '菜单删除',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '菜单删除',
     *     'param'  => ''
     * )
     */

     public function foodmenuDel()
     {
          $id       = $this->request->param("id", 0, 'intval');

          $seller   = Db::name('seller_menu')->where(['id'=>$id])->find();

          if($seller['seller_id'] == session('ADMIN_ID') or cmf_get_current_admin_id() == 1 or session('admin_parent_id') != 1)
          {

               $where['id']             = $id ;
               $where['delete_time']    = strtotime(date('Y-m-d H:i:s',time()));
               $del['object_id']        = $id;
               $del['create_time']      = $where['delete_time'];
               $del['table_name']       = 'seller_menu';
               $del['name']             = '菜单信息';
               $del['uid']              = session('ADMIN_ID');
               $del['seller_id']        = $this->admin_user_id;

               $req      = Db::name('recycle_bin')->insert($del);
               $status   = Db::name('seller_menu')->update($where);

               if (!empty($status))
               {
                    $this->success("删除成功！");
               }else 
               {
                    $this->error("删除失败！");
               }
          }else
          {
               $this->error("您不能删除他人菜单！");
          }          
     }

     /**
     * 菜单添加
     * @adminMenu(
     *     'name'   => '菜单添加',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '菜单添加',
     *     'param'  => ''
     * )
     */

     public function menuAdd()
     {

          $id = $this->request->param("id", 0, 'intval');

          if(!empty($id)){
               $tree     = new Tree();
              $id =$this->admin_user_id ;
               $parentId = $this->request->param("parent_id", 0, 'intval');
               $result   = Db::name('FoodMenu')->where('seller_id',$id)->order(["list_order" => "ASC"])->select();
               $array    = [];
               foreach ($result as $r) {
                    $array[]       = $r;
               }
               $str      = "<option value='\$id' \$selected>\$spacer \$name</option>";
               $tree->init($array);
               $selectCategory = $tree->getTree(0, $str);

               $this->assign("select_category", $selectCategory);
               $this->assign('id',$id);
               return $this->fetch();
          }else{
               $this->error("非法操作！");
          }
      
        
     }

     /**
     * 菜单添加操作
     * @adminMenu(
     *     'name'   => '菜单添加操作',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '菜单添加操作',
     *     'param'  => ''
     * )
     */
    
    public function addPost()
    {

     if($this->request->isPost())
     {
          $data     = $this->request->param();
          $a        = Db::name('seller')->where(["id" => $data['sellser_id']])->find();
          if (empty($a['id'])) 
          {
            $this->error("该商家不存在！");
          }elseif($a['id'] == session('ADMIN_ID') or cmf_get_current_admin_id() == 1 or session('admin_parent_id') != 1)
          {
               if(empty($data['post']['discount'])) $data['post']['discount']=0;
               
               $result = $this->validate($data['post'], 'FoodMenu');

               if(true !== $result)
               {
                    $this->error($result);
               }else
               {
                    $data['post']['seller_id']=$data['sellser_id'];

                    $result = Db::name('seller_menu')->insert($data['post']);
                    if ($result) 
                    {
                         $this->success("添加菜品成功", url("foodmenu/index",array('id'=>$data['sellser_id'])));
                    }else
                    {    
                         $this->error("添加菜品失败");
                    }
               }
          }else
          {
               $this->error("不能添加他人菜单！");
          }
     }


    }

    /**
     * 菜单信息修改
     * @adminMenu(
     *     'name'   => '菜单修改',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '菜单修改',
     *     'param'  => ''
     * )
     */

     public function menuEdit()
     {

          $id = $this->request->param("id", 0, 'intval');

          if(!empty($id))
          {
               $data     = Db::name('seller_menu')->where(["id" => $id])->find();

               if (empty($data['id'])) 
               {
                 $this->error("该菜品不存在！");
               }elseif($data['seller_id'] == session('ADMIN_ID') or cmf_get_current_admin_id() == 1 or session('admin_parent_id') != 1)
               {

                       $seller_id = $this->admin_user_id ;

                    $tree     = new Tree();
                    $parentId = $data['food_class'];
                    $result   = Db::name('FoodMenu')->where('seller_id',$seller_id)->order(["list_order" => "ASC"])->select();
                    $array    = [];
                    foreach ($result as $r) {
                         $r['selected'] = $r['id'] == $parentId ? 'selected' : '';
                         $array[]       = $r;
                    }
                    $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
                    $tree->init($array);
                    $selectCategory = $tree->getTree(0, $str);

                    $data['food_describe'] = html_entity_decode($data['food_describe']);
                    
                    $this->assign("select_category", $selectCategory);
                    $this->assign("data", $data);
                    $this->assign('id',$id);
                    
                    return $this->fetch();
               }else
               {
                    $this->error("不能修改他人菜单！");
               }                                      
          }else
          {
               $this->error("非法操作！");
          }

     }

     /**
     * 修改菜单提交
     * @adminMenu(
     *     'name'   => '修改菜单提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '修改菜单提交',
     *     'param'  => ''
     * )
     */

     public function editPost()
     {
          if($this->request->isPost())
          {
               $data     = $this->request->param();
               $data['post']['id']=$data['id'];
               $a        = Db::name('seller_menu')->where(["id" => $data['post']['id']])->find();
               if (empty($a['seller_id'])) 
               {
                 $this->error("该商家不存在！");
               }elseif($a['seller_id'] == session('ADMIN_ID') or cmf_get_current_admin_id() == 1 or session('admin_parent_id') != 1)
               {
                    if(empty($data['post']['discount'])) $data['post']['discount']=0;
                    
                    $result = $this->validate($data['post'], 'FoodMenu');

                    if(true !== $result)
                    {
                         $this->error($result);
                    }else
                    {    
                         $data['post']['seller_id']=$data['seller_id'];

                         $result = Db::name('seller_menu')->update($data['post']);
                         if ($result) 
                         {
                              $this->success("修改菜品成功", url("foodmenu/index",array('id'=>$data['seller_id'])));
                         }else
                         {    
                              $this->error("修改菜品失败");
                         }
                    }
               }else
               {
                    $this->error('不能修改他人菜单！');
               }
          }

     }


    /**
     * 获得所有子集
     * @adminMenu(
     *     'name'   => '获得所有子集',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '获得所有子集',
     *     'param'  => ''
     * )
     */
     public function getAllChild(){
        if ($this->request->isPost())
        {
            $request = $this->request->param();
            $model   = model('FoodMenu');
            $data    = $model ->index($request['parent_id']);
            echo  json_encode($data);exit;
        }
        else
        {
            $this->error('错误操作');
        }
     }

}