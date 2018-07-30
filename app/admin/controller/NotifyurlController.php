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


use think\Db;
use tree\Tree;

class NotifyurlController 
{
    
	/**
     * 物流信息
     * @adminMenu(
     *     'name'   => '物流信息',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '物流信息',
     *     'param'  => ''
     * )
     */
    
	public function index()
	{	
          $data = input('post.');

          if($data['order_status'] == 1)
          {
               $val = 
               [
                    'order_id'          => $data['partner_order_code'],
                    'order_delivery'    => 4
               ];

               $red = Db::name('order')->update($val);
          }

		if($data['order_status'] == 20)
          {
               $val = 
               [
                    'order_id'               => $data['partner_order_code'],
                    'order_delivery'         => 5,
                    'carrier_driver_name'    => $data['carrier_driver_name'],
                    'carrier_driver_phone'   => $data['carrier_driver_phone']
               ];

               $red = Db::name('order')->update($val);
          }

          if($data['order_status'] == 80)
          {
               $val = 
               [
                    'order_id'               => $data['partner_order_code'],
                    'order_delivery'         => 6,
                    'carrier_driver_name'    => $data['carrier_driver_name'],
                    'carrier_driver_phone'   => $data['carrier_driver_phone']
               ];

               $red = Db::name('order')->update($val);
          }

          if($data['order_status'] == 2)
          {
               $val = 
               [
                    'order_id'               => $data['partner_order_code'],
                    'order_delivery'         => 2,
                    'carrier_driver_name'    => $data['carrier_driver_name'],
                    'carrier_driver_phone'   => $data['carrier_driver_phone']
               ];

               $red = Db::name('order')->update($val);
          }

          if($data['order_status'] == 3)
          {
               $val = 
               [
                    'order_id'               => $data['partner_order_code'],
                    'order_delivery'         => 3,
                    'carrier_driver_name'    => $data['carrier_driver_name'],
                    'carrier_driver_phone'   => $data['carrier_driver_phone']
               ];

               $red = Db::name('order')->update($val);
          }
     }
}