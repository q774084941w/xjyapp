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

class RestController extends AdminBaseController
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
     * 所有空闲的餐桌
     * @adminMenu(
     *     'name'   => '所有空闲的餐桌',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '所有空闲的餐桌',
     *     'param'  => ''
     * )
     */
    public function findThem(){
        if ($this->request->isPost())
        {

            $where = array();
            $request = $this->request->param();

            if(!empty($request['menu_id'])){
                $where['a.menu_id'] = $request['menu_id'];
            }

            $model = model('rest');
            $data  = $model->findThem($where);
            echo json_encode($data);
            exit;
        }
        else
        {
            echo json_encode(
                array(
                    'code'      => 0000,
                    'sub_msg'   => '错误操作'
                )
            );
            exit;
        }
    }


    /**
     * 更改座号
     * @adminMenu(
     *     'name'   => '更改座号',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '更改座号',
     *     'param'  => ''
     * )
     */
    public function changeRest()
    {
        $request = $this->request->param();
        if (empty($request['order_id'])||empty($request['table_id']))
        {
            $this->error('数据不齐全');
        }
        $model  = model('rest');
         $model->where('order_id',$request['order_id'])
            ->update(array(
                'type'      => 1,
                'order_id'  => null
            ));

        $model->where('id',$request['table_id'])->update(
            array(
                'type'      => 3,
                'order_id'  => $request['order_id']
            )
        );

        $model->name('order')->where('order_id',$request['order_id'])
            ->update(array(
                'table_id'=>$request['table_id']
            ));

        $this->success('操作成功');
    }


}