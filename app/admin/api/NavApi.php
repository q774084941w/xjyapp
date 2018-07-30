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
namespace app\admin\api;

use app\admin\model\NavModel;

class NavApi
{
    // 分类列表 用于模板设计
    public function index($param = [])
    {
        $navModel = new NavModel();

        $where = [];

        if (!empty($param['keyword'])) {
            $where['name'] = ['like', "%{$param['keyword']}%"];
        }

        return $navModel->where($where)->select();
    }

}