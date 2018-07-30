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
use think\Validate;

class SellerMenuController extends AdminBaseController
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
     * 菜品信息筛选
     * @adminMenu(
     *     'name'   => '菜品信息筛选',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '菜品信息筛选',
     *     'param'  => ''
     * )
     */
    public function index()
    {
        if($this->request->isPost())
        {
            $request = $this->request->param();
            $where   = array(
                'a.delete_time' =>  0,
                'a.seller_id'   =>  $this->admin_user_id
            );

            if(!empty($request['menu_id']))
            {
                if (!empty($request['child_id']))
                {
                    $where['a.food_class'] = $request['child_id'];
                }
                else
                {
                    $where['b.parent_id'] = $request['menu_id'];
                }

            }

            if(!empty($request['menu_keyword']))
            {
                $ret = Validate::is($request['menu_keyword'],'chs');
                if($ret){
                    $where['a.food_name'] = ['like',"%".$request['menu_keyword']."%"];
                }else{
                    $where['a.pinyin'] = ['like',"%".$request['menu_keyword']."%"];
                }
            }
            $model = model('SellerMenu');
            $data  = $model ->findThem($where);
            echo json_encode($data);exit;
        }
        else
        {
            $this->error('错误操作');
        }
    }


    /**
     * 库存信息筛选
     * @adminMenu(
     *     'name'   => '库存信息筛选',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '库存信息筛选',
     *     'param'  => ''
     * )
     */
    public function traffic(){
        if($this->request->isPost())
        {
            $request = $this->request->param();
            $where   = array(
                'a.delete_time' =>  0,
                'a.seller_id'   =>  $this->admin_user_id
            );

            if(!empty($request['category']))
            {
                if(!empty($request['child_id'])){
                    $where['a.category_id'] = $request['child_id'];
                }else{
                    switch ($request['category']){
                        case 20:
                            $where['a.category_id'] = $request['category'];
                            break;
                        default:
                            $where['b.parent_id'] = $request['category'];
                    }
                }
            }

            if(!empty($request['keyword']))
            {
                $ret = Validate::is($request['keyword'],'chs');
                if($ret){
                    $where['a.food_name'] = ['like',"%".$request['keyword']."%"];
                }else{
                    $where['a.pinyin'] = ['like',"%".$request['keyword']."%"];
                }
            }
            $model = model('Traffic');
            $data  = $model ->findThem($where);
            echo json_encode($data);exit;
        }
        else
        {
            $this->error('错误操作');
        }
    }
}