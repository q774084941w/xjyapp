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

class AddressController extends AdminBaseController
{
    public function _initialize()
    {
        if (cmf_get_current_admin_id() == NULL) {
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
     * 第三方用户收货表
     * @adminMenu(
     *     'name'   => '用户收货表',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '用户收货表',
     *     'param'  => ''
     * )
     */

	public function index()
	{
		$oauthUserQuery = Db::name('third_party_user');

        if(cmf_get_current_admin_id()==1)
        {
            $lists = $oauthUserQuery->where("status", 1)->order("create_time DESC")->paginate(10);
        }else
        {
            $user = Db::name('order')->where('seller_id','eq',session('ADMIN_ID'))->field('user_id')->group('user_id')->select();

            $user    = json_decode( json_encode( $user ), true );//转化为纯数组

            $user_id = array();

            foreach ($user as $key => $value) {
                array_push($user_id,$value['user_id']);       //二维数组变一维数组
            }

            $lists = $oauthUserQuery->where("status", 1)->where('id','in',$user_id)->order("create_time DESC")->paginate(10);

        }
        
        // 获取分页显示
        $page = $lists->render();
        $this->assign('lists', $lists);
        $this->assign('page', $page);
        // 渲染模板输出
        return $this->fetch();
	}

    /**
     * 收货地址详细信息
     * @adminMenu(
     *     'name'   => '地址详细信息',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '地址详细信息',
     *     'param'  => ''
     * )
     */

    public function list()
    {
        $id = $this->request->param("id", 0, 'intval');

        $result = false;

        if(empty($id))
        {
            $this->error("错误操作！");
        }

        $val = input('request.');

        if(!empty($val['add']['tel']))
        {
            $val['add']['user_id'] = $id;

            $result = Db::name('user_address')->insert($val['add']);
        }

        if(!empty($val['edit']['tel']))
        {

            $result = Db::name('user_address')->update($val['edit']);
        }

        if($result)
        {
            $this->redirect('address/list', ['id' => $id]);
        }

        $data = Db::name('user_address')->where("user_id", $id)->where('delete_time','eq',0)->paginate(10);
        $page = $data->render();

        if(empty($data))
        {
            $this->error("没有信息！");
        }else
        {
            $this->assign('id',$id);
            $this->assign('data', $data);
            $this->assign('page', $page);
            return $this->fetch();
        }        
    }

    /**
     * 删除用户信息
     * @adminMenu(
     *     'name'   => '删除用户信息',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '删除用户信息',
     *     'param'  => ''
     * )
     */
    
    public function del()
    {
        $id = $this->request->param("id", 0, 'intval');

        $where['id']        = $id ;
        $where['delete_time']   = strtotime(date('Y-m-d H:i:s',time()));
        $del['object_id']   = $id;
        $del['create_time'] = $where['delete_time'];
        $del['table_name']  = 'user_address';
        $del['name']        = '收货地址';
        $del['uid']         = session('ADMIN_ID');
        $del['seller_id']   = $this->admin_user_id;
        $data   = Db::name('user_address')->where('id','eq',$id)->find();
        $req    = Db::name('recycle_bin')->insert($del);
        $result = Db::name('user_address')->update($where);

        if (!$result) 
        {
            $this->error("删除失败");
        }else
        {   
            $this->redirect('address/list', ['id' => $data['user_id']]);
        }
    }

}
