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

class PrinterPositionController extends AdminBaseController
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
        //商家id
        $this->admin_user_id = $user_id;

        //model
        $this->thismodel  = model('PrinterPosition');
    }


    /**
     * 设备位置添加
     * @adminMenu(
     *     'name'   => '设备位置添加',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '设备位置添加',
     *     'param'  => ''
     * )
     */
    public function addAjax()
    {
        if ($this->request->isPost())
        {
            $request = $this->request->param();
            if (empty($request['name']))
            {
                $this->error('数据不完整');
            }
            $arr = array(
                'name' => $request['name'],
                'seller_id' => $this->admin_user_id,
            );
            $result = $this->thismodel ->insert($arr);
            if ($result)
            {
                $this->success('添加成功');
            }
            else
            {
                $this->error('添加失败');
            }
        }
        else
        {
            $this->error('错误操作');
        }
    }


    /**
     * 设备位置删除
     * @adminMenu(
     *     'name'   => '设备位置删除',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '设备位置删除',
     *     'param'  => ''
     * )
     */
    public function positDel()
    {
        $request = $this->request->param();
        if (empty($request['posit_id']))
        {
            $this->error('数据不完整');
        }
        $this->thismodel->deletePosition($request['posit_id']) ;
        $this->success('删除成功');

    }

    /**
     * 名称修改
     * @adminMenu(
     *     'name'   => '名称修改',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '名称修改',
     *     'param'  => ''
     * )
     */
    public function editAjax(){
        if ($this->request->isPost())
        {
            $request = $this->request->param();
            if (empty($request['name']) || empty($request['posit_id']))
            {
                $this->error('数据不完整');
            }

            $result = $this->thismodel
                ->where('posit_id',$request['posit_id'])
                ->update(array('name'=>$request['name'])) ;
            if ($result)
            {
                $this->success('修改成功');
            }
            else
            {
                $this->success('修改失败');
            }
        }
        else
        {
            $this->error('错误操作');
        }

    }

}