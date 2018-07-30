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

namespace app\admin\model;


use think\Model;

class PrinterPositionModel extends Model
{
    /**
     * 设备位置列表
     * @adminMenu(
     *     'name'   => '设备位置列表',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '设备位置列表',
     *     'param'  => ''
     * )
     */
    public function index($seller_id)
    {
        $data = $this
            ->field('posit_id,name')
            ->where('seller_id',$seller_id)
            ->select();
        $data = json_decode(json_encode($data),true);
        return $data;
    }


    /**
     * 位置删除
     * @adminMenu(
     *     'name'   => '位置删除',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '位置删除',
     *     'param'  => ''
     * )
     */
    public function deletePosition($posit_id){
        $this->where('posit_id',$posit_id)->delete();
        $this->name('printer_to_position')->where('posit_id',$posit_id)->delete();
    }

    /**
     * 获取拥有位置信息
     * @adminMenu(
     *     'name'   => '获取拥有位置信息',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '获取拥有位置信息',
     *     'param'  => ''
     * )
     */
    public function getMyAll($printer_id){
        $data = $this->alias('a')
            ->field('a.posit_id,name')
            ->join('__PRINTER_TO_POSITION__ b','a.posit_id=b.posit_id')
            ->where('printer_id',$printer_id)
            ->select();
        $data = json_decode(json_encode($data),true);
        return $data;
    }

}