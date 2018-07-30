<?php
// +----------------------------------------------------------------------
// | YunJiuCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2026 http://www.ccapp.com.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 云九科技 <ccapp@ccapp.com.cn>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use app\admin\model\RouteModel;
use cmf\controller\AdminBaseController;
use FontLib\Table\Type\name;
use think\Db;

class RecycleBinController extends AdminBaseController
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
     * 回收站
     * @adminMenu(
     *     'name'   => '回收站',
     *     'parent' => '',
     *     'display'=> false,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '回收站',
     *     'param'  => ''
     * )
     */
    function index()
    {
        $where= '';
        if(cmf_get_current_admin_id()!==1)
        {
            $where['seller_id'] =  $this->admin_user_id;
        }

        $list = Db::name('recycleBin')
            ->field('a.*,b.user_nickname,b.user_login')
            ->alias('a')
            ->join('__USER__ b','a.uid=b.id')
            ->where($where)
            ->order('create_time desc')
            ->paginate(10);
        // 获取分页显示
        $page = $list->render();
        $this->assign('page', $page);
        $this->assign('list', $list);
        return $this->fetch();
    }

    /**
     * 回收站还原
     * @adminMenu(
     *     'name'   => '回收站还原',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '回收站还原',
     *     'param'  => ''
     * )
     */
    function restore()
    {

        $id     = $this->request->param('id');
        $result = Db::name('recycleBin')->where(['id' => $id])->find();

        if(cmf_get_current_admin_id()!==1 or empty($result))
        {
            if($result['uid'] != session('ADMIN_ID'))
            {
                $this->error('错误操作！');
            }
        }

        $tableName = explode('#', $result['table_name']);
        $tableName = $tableName[0];
        //还原资源
        if ($result) {
            if($tableName == 'order')
            {
                $res = Db::name($tableName)
                ->where(['order_id' => $result['object_id']])
                ->update(['delete_time' => '0']);
            }
            elseif ($tableName=='traffic'){
                $res = Db::name($tableName)
                    ->where(['tra_id' => $result['object_id']])
                    ->update(['delete_time' => '0']);
            }
            else
            {
                $res = Db::name($tableName)
                ->where(['id' => $result['object_id']])
                ->update(['delete_time' => '0']);
            }
            
            if ($tableName =='portal_post'){
                Db::name('portal_category_post')->where('post_id',$result['object_id'])->update(['status'=>1]);
                Db::name('portal_tag_post')->where('post_id',$result['object_id'])->update(['status'=>1]);
            }

            if ($res) {
                $re = Db::name('recycleBin')->where('id', $id)->delete();
                if ($re) {
                    $this->success("还原成功！");
                }
            }else{
                $this->error('出错了');
            }
        }
    }

    /**
     * 回收站彻底删除
     * @adminMenu(
     *     'name'   => '回收站彻底删除',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '回收站彻底删除',
     *     'param'  => ''
     * )
     */
    function delete()
    {
        $id     = $this->request->param('id');
        $result = Db::name('recycleBin')->where(['id' => $id])->find();
        //删除资源
        if ($result) {

            //页面没有单独的表.
            if($result['table_name'] === 'portal_post#page'){
                $re = Db::name('portal_post')->where('id', $result['object_id'])->delete();
                //消除路由
                $routeModel = new RouteModel();
                $routeModel->setRoute('', 'portal/Page/index', ['id' => $result['object_id']], 2, 5000);
                $routeModel->getRoutes(true);
            }else{
                $this->seller_table($result);
                $re = Db::name($result['table_name'])->where('id', $result['object_id'])->delete();
            }

            if ($re) {
                $res = Db::name('recycleBin')->where('id', $id)->delete();
                if($result['table_name'] === 'portal_post'){
                    Db::name('portal_category_post')->where('post_id',$result['object_id'])->delete();
                    Db::name('portal_tag_post')->where('post_id',$result['object_id'])->delete();
                }
                if ($res) {

                    $this->success("删除成功！");
                }

            }
        }
    }

    protected function seller_table($result){
        if($result['table_name']=='rest'){
            $res = Db::name($result['table_name'])->field('table_id')->where('id',$result['object_id'])->select();
            if(count($res[0])<2){
                Db::name('seller_table')->where('id',$res[0]['table_id'])->delete();
            }
        }
    }
}