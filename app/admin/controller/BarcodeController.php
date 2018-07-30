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


use BarcodeBakery\Barcode\BCGcode39;
use BarcodeBakery\Common\BCGColor;
use BarcodeBakery\Common\BCGDrawing;
use think\Loader;

class BarcodeController
{
    /**
     * 条形码类
     */
    public static function barcode_create($content){
        // 引用barcode文件夹对应的类
        Loader::import('BarcodeBakery.Common.BCGFontFile',EXTEND_PATH);
        //Loader::import('BCode.BCGColor',EXTEND_PATH);
        Loader::import('BarcodeBakery.Common.BCGDrawing',EXTEND_PATH);
        // 条形码的编码格式
        Loader::import('BarcodeBakery.Barcode.BCGcode39',EXTEND_PATH,'.barcode.php');
        // $code = '';
        // 加载字体大小
        //$font = new BCGFontFile('./class/font/Arial.ttf', 18);
        //颜色条形码
        $color_black = new BCGColor(0, 0, 0);
        $color_white = new BCGColor(255, 255, 255);
        $drawException = null;
        try
        {
            $code = new BCGcode39();
            $code->setScale(1);
            $code->setThickness(50); // 条形码的厚度
            $code->setForegroundColor($color_black); // 条形码颜色
            $code->setBackgroundColor($color_white); // 空白间隙颜色
            // $code->setFont($font); //
            $code->parse($content); // 条形码需要的数据内容
        }
        catch(Exception $exception)
        {
            $drawException = $exception;
        }
        //根据以上条件绘制条形码
        $drawing = new BCGDrawing('', $color_white);
        if($drawException) {
            $drawing->drawException($drawException);
        }else{
            $drawing->setBarcode($code);
            $drawing->draw();
        }


        // 生成PNG格式的图片
        header('Content-Type: image/png');
        // header('Content-Disposition:attachment; filename="barcode.png"'); //自动下载
        $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
    }
}