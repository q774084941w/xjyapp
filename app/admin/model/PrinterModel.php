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

class PrinterModel extends Model
{
    /**
     * 查询前台打印机
     * @adminMenu(
     *     'name'   => '查询前台打印机',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '查询前台打印机',
     *     'param'  => ''
     * )
     */
    public function Reception($menu_id,$food,$posit_id=1)
    {
        $where = array(
            'a.type'        => 1,
            'c.posit_id'    => $posit_id,
            'b.menu_id'     => $menu_id,
        );
        $data = $this
            ->field('b.print_id')
            ->alias('a')
            ->join('__PRINTER_MENU__ b','a.printer_id=b.print_id')
            ->join('__PRINTER_TO_POSITION__ c','c.printer_id=a.printer_id')
            ->where($where)
            ->find();
        $newArr = array();
        foreach ($food as $key=>$val)
        {
            $newArr[$data['print_id']][$key] = $val;
        }
        return $newArr;
    }


    /**
     * 查询打印机
     * @param $in
     * @param $food
     * @param $id
     * @return array
     */
    public function printer_id($in,$food,$id)
    {

        $print_id  = $this
            ->alias('a')
            ->join('__PRINTER_MENU__ b','a.printer_id=b.print_id')
            ->join('__PRINTER_TO_POSITION__ c','c.printer_id=a.printer_id')
            ->field('b.print_id,b.menu_id')
            ->where('a.type',1)
            ->where('c.posit_id',$id)
            ->where($in)
            ->select();
        $newArr = array();
        foreach ($food as $key=>$val)
        {
            foreach ($print_id as $vo)
            {
                if ($vo['menu_id']==$val['food_class'])
                {
                    $newArr[$vo['print_id']][$key] = $val;
                    continue;
                }
            }
        }
        return $newArr;
    }

    /**
     * 状态三
     * @param $menu_id
     * @return mixed
     */
    public function typeThree($user_id){
        $where = array(
            'a.type'        => 1,
            'c.posit_id'    => 3,
            'd.id'          => $user_id,
        );
        $data = $this
            ->field('a.printer_id')
            ->alias('a')
            ->join('__PRINTER_MENU__ b','a.printer_id=b.print_id')
            ->join('__PRINTER_TO_POSITION__ c','c.printer_id=a.printer_id')
            ->join('__USER__ d','b.menu_id=d.menu_id')
            ->where($where)
            ->find();
        $data = json_decode(json_encode($data),true);
        return $data;
    }

    /**
     * 查找当前菜系打印机
     * @adminMenu(
     *     'name'   => '查找当前菜系打印机',
     *     'parent' => '',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '查找当前菜系打印机',
     *     'param'  => ''
     * )
     */
    public function thisOne($menu_id,$id=2){
        $print_id  = $this
            ->alias('a')
            ->join('__PRINTER_MENU__ b','a.printer_id=b.print_id')
            ->join('__PRINTER_TO_POSITION__ c','c.printer_id=a.printer_id')
            ->where('a.type',1)
            ->where('c.posit_id',$id)
            ->where('b.menu_id',$menu_id)
            ->value('b.print_id');
        $data = json_decode(json_encode($print_id),true);
        return $data;
    }
}