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

class MarketplaceController extends AdminBaseController
{
    public function _initialize()
    {
        if (cmf_get_current_admin_id() == null) {
            $this->error("您没有访问权限！");
        }
    }

    /**
     * 应用市场
     * @adminMenu(
     *     'name'   => '应用市场',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '应用市场',
     *     'param'  => ''
     * )
     */

    public function index(){
        return $this->fetch();
    }
}