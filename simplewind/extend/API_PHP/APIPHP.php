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
namespace  API_PHP;

use think\Db;

require_once EXTEND_PATH.'API_PHP/HttpClient.class.php';
class APIPHP
{
    const USER='ccapp@ccapp.com.cn';  //*必填*：飞鹅云后台注册账号
    const UKEY='pwUKAe5z2ICzubzb';  //*必填*: 飞鹅云注册账号后生成的UKEY
    const SN='';  //*必填*：打印机编号，必须要在管理后台里添加打印机或调用API接口添加之后，才能调用API
    const IP='api.feieyun.cn';  //接口IP或域名
    const PORT='80';  //接口IP端口
    const PATH='/Api/Open/';	//接口路径
//    const STIME= time();	    //公共参数，请求时间
//    const SIG='';//sha1(USER.UKEY.STIME)   //公共参数，请求公钥
    protected $stime = '';
    protected $sig = '';
    public function __construct()
    {
        $this->stime = time();
        $this->sig = sha1(self::USER.self::UKEY.$this->stime);
    }

    /**
     * 注册信息
     * @param $arr
     * @return array|string
     */

    public function addprinter($arr){
        if(empty($arr)){
            return  array(
                'code'=>'0000',
                'sub_msg'=>'数据不能为空');

        }
        $result = $this->production($arr);
        if(is_array($result)){
            return $result;
        }

        $snlist = $result;
        $content = array(
            'user'=>self::USER,
            'stime'=>$this->stime,
            'sig'=>$this->sig,
            'apiname'=>'Open_printerAddlist',

            'printerContent'=>$snlist
        );

        $client = new \HttpClient(self::IP,self::PORT);
        if(!$client->post(self::PATH,$content)){
            return array(
                'code'=>'1110',
                'sub_msg'=>'失败');
        }
        else{
            $result = json_decode($client->getContent(),true);
            if(empty($result['data']['ok'])){
                return array(
                    'code'=>'1110',
                    'sub_msg'=>$result['data']['no'][0]);
            }
           return  array('code'=>'1111','sub_msg'=>'添加成功');
        }
    }

    /**
     * 拼接字符串 注册
     * @param  array $arr
     * @return array|string
     */

    protected function production($arr){
        //提示：打印机编号(必填) # 打印机识别码(必填) # 备注名称(选填) # 流量卡号码(选填)，多台打印机请换行（\n）添加新打印机信息，每次最多100行(台)。
        //$snlist = "sn1#key1#remark1#carnum1\nsn2#key2#remark2#carnum2";
        //addprinter($snlist);
        if(empty($arr)){
            return array(
                'code'=>'0000',
                'sub_msg'=>'数据为空');
        }
            if(!empty($arr[0])){
                $str = array();
                foreach ($arr as $val) {
                    if(!empty($val[0])&&is_array($val[0])){
                        return array(
                            'code'=>'0000',
                            'sub_msg'=>'对不起，仅支持二维数组');
                    }
                    $str[] = $val['printer_id'].'#'.$val['secret_key'].'#'.$val['remark'] ;
                }
                return implode('\n',$str);
            }else{
                return $arr['printer_id'].'#'.$arr['secret_key'].'#'.$arr['remark'] ;
            }

    }

    /**
     * 打印接口调用
     * @param array $arr
     * @return array|bool|string
     */

    public function combination($arr){

        $arr['order']['thisTitle'] = empty($arr['order']['thisTitle']) ? '订单信息' : $arr['order']['thisTitle'];

        //后厨打印方法
        if(!empty($arr['food_nub'])){
            $this->printKitchen($arr['food_nub'],$arr['order']);
        }

        //前台打印
        $this->kitchenPrint($arr['food_all'],$arr['order'],$arr['order']['times'],$arr['order']['times']);
        return array(
            'code'=>'1111',
            'sub_msg'=>'成功');


    }

    //打印组合方法
    public function kitchenPrint($food_nub,$order,$time=1){
        foreach ($food_nub as $printer_id=>$val){
            $orderInfo = $this->Typesetting($val,16,5,6,5,$order);
            $this->wp_print($printer_id,$orderInfo,$time);
        }
    }

    //打印组合方法
    public function printKitchen($food_nub,$order,$time=1){
        foreach ($food_nub as $printer_id=>$val){
            foreach ($val as $vo){
                $orderInfo = $this->Typesetting(array($vo),16,5,6,5,$order);
                $this->wp_print($printer_id,$orderInfo,$time);
            }
        }
    }

    /**
     * 执行打印操作
     * @param string|int $printer_sn 打印机编号
     * @param string $orderInfo 打印内容
     * @param int $times 次数
     * @return bool|string
     */

    protected function wp_print($printer_sn,$orderInfo,$times=1){

        $content = array(
            'user'=>self::USER,
            'stime'=>$this->stime,
            'sig'=>$this->sig,
            'apiname'=>'Open_printMsg',

            'sn'=>$printer_sn,
            'content'=>$orderInfo,
            'times'=>$times//打印次数
        );

        $client = new \HttpClient(self::IP,self::PORT);
        if(!$client->post(self::PATH,$content)){
            return false;
        }
        else{
            //服务器返回的JSON字符串，建议要当做日志记录起来
            return  array(
                'code'=>'1111',
                'sub_msg'=>json_decode($client->getContent(),true));
        }

    }


    /**
     *    输入字符串转换为条形码
     *    最大支持28位纯数字的条形码（按58mm打印机标准）
     *
     *    26-28位数字条形码，在数字中不可以出现2个及以上连续的0存在
     *    23-25位数字条形码，在数字中不可以出现3个及以上连续的0存在
     *    21-22位数字条形码，在数字中不可以出现4个及以上连续的0存在
     *    19-20位数字条形码，在数字中不可以出现6个及以上连续的0存在
     *    17-18位数字条形码，在数字中不可以出现8个及以上连续的0存在
     *    15-16位数字条形码，在数字中不可以出现10个及以上连续的0存在
     *    少于或等于14位数字的条形码，0的数量没有影响
     */

    protected function bar_code($strnum)
    {
        $codeB = array("\x30","\x31","\x32","\x33","\x34","\x35","\x36","\x37","\x38","\x39");//匹配字符集B
        $codeC = array("\x00","\x01","\x02","\x03","\x04","\x05","\x06","\x07","\x08","\x09","\x0A","\x0B","\x0C","\x0D","\x0E","\x0F","\x10","\x11","\x12","\x13","\x14","\x15","\x16","\x17","\x18","\x19","\x1A","\x1B","\x1C","\x1D","\x1E","\x1F","\x20","\x21","\x22","\x23","\x24","\x25","\x26","\x27","\x28","\x29","\x2A","\x2B","\x2C","\x2D","\x2E","\x2F","\x30","\x31","\x32","\x33","\x34","\x35","\x36","\x37","\x38","\x39","\x3A","\x3B","\x3C","\x3D","\x3E","\x3F","\x40","\x41","\x42","\x43","\x44","\x45","\x46","\x47","\x48","\x49","\x4A","\x4B","\x4C","\x4D","\x4E","\x4F","\x50","\x51","\x52","\x53","\x54","\x55","\x56","\x57","\x58","\x59","\x5A","\x5B","\x5C","\x5D","\x5E","\x5F","\x60","\x61","\x62","\x63");//匹配字符集C
        $length = strlen($strnum);
        $b=array();
        $b[0] = "\x1b";
        $b[1] = "\x64";
        $b[2] = "\x02";
        $b[3] = "\x1d";
        $b[4] = "\x48";
        $b[5] = "\x32";
        $b[6] = "\x1d";
        $b[7] = "\x68";
        $b[8] = "\x50";
        $b[9] = "\x1d";
        $b[10] = "\x77";
        $b[11] = "\x02";
        $b[12] = "\x1d";
        $b[13] = "\x6b";
        $b[14] = "\x49";
        $b[15]  = chr($length + 2);
        $b[16] = "\x7b";
        $b[17] = "\x42";
        if($length > 14){//大于14个字符的进来这个区间
            $b[17] = "\x43";
            $j = 0;
            $key = 18;
            $ss = $length/2;//初始化数组长度
            if($length%2 == 1){//判断条形码为单数
                $ss = $ss-0.5;
            }
            for ($i = 0; $i < $ss; $i++){
                $temp = substr($strnum,$j,2);
                $iindex = intval($temp);
                $j = $j+2;
                if($iindex == 0){
                    if($b[$key + $i-1] == '0' && $b[$key + $i-2] == '0'){//判断前面的为字符集B,此时不需要转换字符集
                        $b[$key + $i] = $codeB[0];
                        $b[$key + $i + 1] = $codeB[0];
                        $key += 1;
                    }else{
                        if($b[$key + $i-1] == 'C' && $b[$key + $i-2] == '{'){//判断条形码开头前两位数都为0时转换字符集B
                            $b[$key + $i - 2] = "\x7b";
                            $b[$key + $i - 1] = "\x42";
                            $b[$key + $i] = $codeB[0];
                            $b[$key + $i + 1] = $codeB[0];
                            $key += 1;
                        }else{
                            $b[$key + $i] = "\x7b";
                            $b[$key + $i + 1] = "\x42";
                            $b[$key + $i + 2] = $codeB[0];
                            $b[$key + $i + 3] = $codeB[0];
                            $key += 3;
                        }
                    }
                }else{
                    if($b[$key + $i-1] == '0' && $b[$key + $i-2] == '0'){//判断前面的为字符集B,此时要转换字符集C
                        $b[$key + $i] = "\x7b";
                        $b[$key + $i + 1] = "\x43";
                        $b[$key + $i + 2] = $codeC[$iindex];
                        $key += 2;
                    }else{
                        $b[$key + $i] = $codeC[$iindex];
                    }
                }
            }
            @$lastkey = end(array_keys($b));//取得数组的最后一个元素的键
            if($length % 2 > 0){
                $lastnum = substr($strnum,-1);//取得字符串的最后一个数字
                if($b[$lastkey] == '0' && $b[$lastkey-1] == '0'){//判断前面的为字符集B,此时不需要转换字符集
                    $b[$lastkey + 1] = $codeB[$lastnum];
                }else{
                    $b[$lastkey + 1] = "\x7b";
                    $b[$lastkey + 2] = "\x42";
                    $b[$lastkey + 3] = $codeB[$lastnum];
                }
            }
        }else{//1-14位数字的条形码进来这个区间
            for ($i = 0; $i < $length; $i++){
                $temp = substr($strnum,$i,1);
                $iindex = intval($temp);
                $b[18 + $i] = $codeB[$iindex];
            }
        }
        @$b[15] = chr(end(array_keys($b)) - 15);//得出条形码长度
        $str = implode("",$b);
        return $str;
    }

    /**
     *    订单排版处理
     *    名称($A => 26) 单价($B => 7) 数量($C => 4) 金额($D => 6)-->数值适合80mm打印机，这里的字节数可按自己需求自由改写
     */

    protected function Typesetting($arr,$A,$B,$C,$D,$order)
    {
        $orderInfo = '<CB>'.$order['thisTitle'].'</CB><BR>';
        $orderInfo .= '订单号：'.$order['order_id'].'<BR>';
        $orderInfo .= '服务厅：'.$order['name'].'     桌号：'.$order['tb_id'].'号<BR>';
        $orderInfo .= '--------------------------------<BR>';
        $orderInfo .= '名称　　　　　 单价  数量 金额<BR>';
        $orderInfo .= '--------------------------------<BR>';
        foreach ($arr as $k5 => $v5) {
            $name = $v5['title'];
            $price = $v5['price'];
            $num = $v5['num'];
            $prices = $v5['price']*$v5['num'];
            $kw3 = '';
            $kw1 = '';
            $kw2 = '';
            $kw4 = '';
            $str = $name;
            $blankNum = $A;
            $lan = mb_strlen($str,'utf-8');
            $m = 0;
            $j=1;
            $blankNum++;
            $result = array();
            for ($i=0;$i<$lan;$i++){
                $new = mb_substr($str,$m,$j,'utf-8');
                $j++;
                if(mb_strwidth($new,'utf-8')<$blankNum) {
                    if($m+$j>$lan) {
                        $m = $m+$j;
                        $tail = $new;
                        $lenght = iconv("UTF-8", "GBK//IGNORE", $new);
                        $k = $A - strlen($lenght);
                        for($q=0;$q<$k;$q++){
                            $kw3 .= ' ';
                        }
                        $tail .= $kw3;
                        break;
                    }else{
                        $next_new = mb_substr($str,$m,$j,'utf-8');
                        if(mb_strwidth($next_new,'utf-8')<$blankNum) continue;
                        else{
                            $m = $i+1;
                            $result[] = $new.'<BR>';
                            $j=1;
                        }
                    }
                }
            }
            $head = '';
            foreach ($result as $value) {
                $head .= $value;
            }
            if(strlen($price) < $B){
                $k1 = $B - strlen($price);
                for($q=0;$q<$k1;$q++){
                    $kw1 .= ' ';
                }
                $price = $price.$kw1;
            }
            if(strlen($num) < $C){
                $k2 = $C - strlen($num);
                for($q=0;$q<$k2;$q++){
                    $kw2 .= ' ';
                }
                $num = $num.$kw2;
            }
            if(strlen($prices) < $D){
                $k3 = $D - strlen($prices);
                for($q=0;$q<$k3;$q++){
                    $kw4 .= ' ';
                }
                $prices = $prices.$kw4;
            }
            $orderInfo .= $head.$tail.' '.$price.' '.$num.' '.$prices.'<BR>';
            @$nums += $prices;
        }
        $time = date('Y-m-d H:i:s',time());
        $orderInfo .= '--------------------------------<BR>';
        $orderInfo .= '合计：'.number_format($nums, 1).'元<BR>';
        /*$orderInfo .= '送货地点：广州市南沙区xx路xx号<BR>';
        $orderInfo .= '联系电话：020-39004606<BR>';*/
        $orderInfo .= '订餐时间：'.date('Y-m-d H:i:s',$order['order_time']).'<BR>';
        $orderInfo .= '备注：'.$order['remarks'].'<BR>';
        $content    =  $this->bar_code($order['order_id']);
        $orderInfo .=  $content;//把解析后的二维码生成的字符串用标签套上即可自动生成二维码
        return $orderInfo;
    }

    //打印组合方法2
    public function kitchenPrint2($food_nub,$order,$time=1){
        foreach ($food_nub as $printer_id=>$val){
            $orderInfo = $this->Typesetting2($val,$order);
            $result = $this->wp_print($printer_id,$orderInfo,$time);
            if(!$result){
                return  array(
                    'code'=>'0000',
                    'sub_msg'=>'打印失败'
                );
            }
        }
        return $result;
    }
    /**
     *    订单排版处理2
     *    名称($A => 26) 单价($B => 7) 数量($C => 4) 金额($D => 6)-->数值适合80mm打印机，这里的字节数可按自己需求自由改写
     */

    protected function Typesetting2($arr,$order,$A=16,$B=5,$C=6,$D=5)
    {
        $orderInfo = '<CB>消费订单</CB><BR>';
        $orderInfo .= '订单号：'.$order['order_id'].'<BR>';
        $orderInfo .= '服务厅：'.$order['name'].'     桌号：'.$order['tb_id'].'号<BR>';
        $orderInfo .= '--------------------------------<BR>';
        $orderInfo .= '名称　　　　　 单价  数量 金额<BR>';
        $orderInfo .= '--------------------------------<BR>';
        foreach ($arr as $k5 => $v5) {
            $name = $v5['title'];
            $price = $v5['price'];
            $num = $v5['num'];
            $prices = $v5['price']*$v5['num'];
            $kw3 = '';
            $kw1 = '';
            $kw2 = '';
            $kw4 = '';
            $str = $name;
            $blankNum = $A;
            $lan = mb_strlen($str,'utf-8');
            $m = 0;
            $j=1;
            $blankNum++;
            $result = array();
            for ($i=0;$i<$lan;$i++){
                $new = mb_substr($str,$m,$j,'utf-8');
                $j++;
                if(mb_strwidth($new,'utf-8')<$blankNum) {
                    if($m+$j>$lan) {
                        $m = $m+$j;
                        $tail = $new;
                        $lenght = iconv("UTF-8", "GBK//IGNORE", $new);
                        $k = $A - strlen($lenght);
                        for($q=0;$q<$k;$q++){
                            $kw3 .= ' ';
                        }
                        $tail .= $kw3;
                        break;
                    }else{
                        $next_new = mb_substr($str,$m,$j,'utf-8');
                        if(mb_strwidth($next_new,'utf-8')<$blankNum) continue;
                        else{
                            $m = $i+1;
                            $result[] = $new.'<BR>';
                            $j=1;
                        }
                    }
                }
            }
            $head = '';
            foreach ($result as $value) {
                $head .= $value;
            }
            if(strlen($price) < $B){
                $k1 = $B - strlen($price);
                for($q=0;$q<$k1;$q++){
                    $kw1 .= ' ';
                }
                $price = $price.$kw1;
            }
            if(strlen($num) < $C){
                $k2 = $C - strlen($num);
                for($q=0;$q<$k2;$q++){
                    $kw2 .= ' ';
                }
                $num = $num.$kw2;
            }
            if(strlen($prices) < $D){
                $k3 = $D - strlen($prices);
                for($q=0;$q<$k3;$q++){
                    $kw4 .= ' ';
                }
                $prices = $prices.$kw4;
            }
            $orderInfo .= $head.$tail.' '.$price.' '.$num.' '.$prices.'<BR>';
            @$nums += $prices;
        }
        $time = date('Y-m-d H:i:s',time());
        $orderInfo .= '--------------------------------<BR>';
        $orderInfo .= '合计：'.number_format($nums, 1).'元<BR>';
        /*$orderInfo .= '送货地点：广州市南沙区xx路xx号<BR>';
        $orderInfo .= '联系电话：020-39004606<BR>';*/
        $orderInfo .= '订餐时间：'.date('Y-m-d H:i:s',$order['order_time']).'<BR>';
        $orderInfo .= '备注：'.$order['remarks'].'<BR>';
        $orderInfo .= '--------------------------------<BR>';
        $orderInfo .= '支付方式：'.$order['pay_class'].'<BR>';
        if(!empty($order['grade_name'])){
            $orderInfo .= '会员卡：'.$order['grade_name'].'<BR>';
        }
        $discount = $order['discount']?$order['discount']:0;
        $orderInfo .= '优惠劵：'.$order['coupon'].'元<BR>';
        $orderInfo .= '折扣：'.$discount.'折<BR>';
        $orderInfo .= '实际已付金额：'.$order['price'].'元<BR>';
        $orderInfo .= '支付时间：'.date('Y-m-d H:i:s',$order['end_time']).'<BR>';
        $content    =  $this->bar_code($order['order_id']);
        $orderInfo .=  $content;//把解析后的二维码生成的字符串用标签套上即可自动生成二维码
        return $orderInfo;
    }

    //打印组合方法3
    public function kitchenPrint3($type,$food_nub,$order){
        switch ($type){
            case 1:
                $orderInfo      =  '';
                foreach ($food_nub as $key=>$val){
                    $orderInfo .= $this->Typesetting3($val,$order[$key]);
                    $orderInfo .=  '--------------------------------<BR>';
                    $orderInfo .=  '--------------------------------<BR>';
                }
                $orderInfo .=  '总销售量：'.$order['all_number'].'<BR>';
                $orderInfo .=  '总收银金额：'.$order['all_price'].'<BR>';
                return $orderInfo;
                break;
            default:
               return $this->wp_print($food_nub,$order);
        }

    }


    /**
     *    订单排版处理3
     *    名称($A => 26) 单价($B => 7) 数量($C => 4) 金额($D => 6)-->数值适合80mm打印机，这里的字节数可按自己需求自由改写
     */

    protected function Typesetting3($arr,$order,$A=16,$B=5,$C=6,$D=5)
    {
        $orderInfo  = '收银员：'.$order['user_name'].'<BR>';
        $orderInfo .= '服务厅：'.$order['menu_name'].'<BR>';
        $orderInfo .= '--------------------------------<BR>';
        $orderInfo .= '名称　　　　　 单价  数量 金额<BR>';
        $orderInfo .= '--------------------------------<BR>';
        foreach ($arr as $k5 => $v5) {
            $name = $v5['title'];
            $price = $v5['price'];
            $num = $v5['num'];
            $prices = $v5['price']*$v5['num'];
            $kw3 = '';
            $kw1 = '';
            $kw2 = '';
            $kw4 = '';
            $str = $name;
            $blankNum = $A;
            $lan = mb_strlen($str,'utf-8');
            $m = 0;
            $j=1;
            $blankNum++;
            $result = array();
            for ($i=0;$i<$lan;$i++){
                $new = mb_substr($str,$m,$j,'utf-8');
                $j++;
                if(mb_strwidth($new,'utf-8')<$blankNum) {
                    if($m+$j>$lan) {
                        $m = $m+$j;
                        $tail = $new;
                        $lenght = iconv("UTF-8", "GBK//IGNORE", $new);
                        $k = $A - strlen($lenght);
                        for($q=0;$q<$k;$q++){
                            $kw3 .= ' ';
                        }
                        $tail .= $kw3;
                        break;
                    }else{
                        $next_new = mb_substr($str,$m,$j,'utf-8');
                        if(mb_strwidth($next_new,'utf-8')<$blankNum) continue;
                        else{
                            $m = $i+1;
                            $result[] = $new.'<BR>';
                            $j=1;
                        }
                    }
                }
            }
            $head = '';
            foreach ($result as $value) {
                $head .= $value;
            }
            if(strlen($price) < $B){
                $k1 = $B - strlen($price);
                for($q=0;$q<$k1;$q++){
                    $kw1 .= ' ';
                }
                $price = $price.$kw1;
            }
            if(strlen($num) < $C){
                $k2 = $C - strlen($num);
                for($q=0;$q<$k2;$q++){
                    $kw2 .= ' ';
                }
                $num = $num.$kw2;
            }
            if(strlen($prices) < $D){
                $k3 = $D - strlen($prices);
                for($q=0;$q<$k3;$q++){
                    $kw4 .= ' ';
                }
                $prices = $prices.$kw4;
            }
            $orderInfo .= $head.$tail.' '.$price.' '.$num.' '.$prices.'<BR>';


            @$nums += $prices;
        }
        $orderInfo .= '--------------------------------<BR>';
        $orderInfo .= '销售量：'.$order['thisnumber'].'<BR>';
        $orderInfo .= '收银金额：'.$order['thisprice'].'<BR>';
        return $orderInfo;
    }


    //打印组合方法4
    public function kitchenPrint4($type,$food_nub,$order,$all_menu=0){
        switch ($type){
            case 1:
        $orderInfo  = '收银员：'.$order['user_name'].'<BR>';
        $orderInfo .= '起始时间：'.$order['beginTime'].'<BR>';
        $orderInfo .= '结束时间：'.$order['endTime'].'<BR>';
        foreach ($food_nub as $key=>$val){
            if(!empty($all_menu)){
                $menu = implode('',$all_menu[$key]);
                $orderInfo .= '操作门店：'.$menu.'<BR>';
            }
            foreach ($val as $k=>$vo){
                $orderInfo .= $this->Typesetting4($vo);
            }
            $orderInfo .= '--------------------------------<BR>';

        }

        return $orderInfo;
                break;
            default:
                return $this->wp_print($food_nub,$order);
        }
    }

    /**
     *    订单排版处理4
     *    名称($A => 26) 单价($B => 7) 数量($C => 4) 金额($D => 6)-->数值适合80mm打印机，这里的字节数可按自己需求自由改写
     */

    protected function Typesetting4($arr,$A=16,$B=5,$C=6,$D=5)
    {

        $orderInfo = '--------------------------------<BR>';
        foreach ($arr as $k5 => $v5) {
            $name = $v5['title'];
            $price = '';
            $num =  $v5['price'];
            $prices ='';
            $kw3 = '';
            $kw1 = '';
            $kw2 = '';
            $kw4 = '';
            $str = $name;
            $blankNum = $A;
            $lan = mb_strlen($str,'utf-8');
            $m = 0;
            $j=1;
            $blankNum++;
            $result = array();
            for ($i=0;$i<$lan;$i++){
                $new = mb_substr($str,$m,$j,'utf-8');
                $j++;
                if(mb_strwidth($new,'utf-8')<$blankNum) {
                    if($m+$j>$lan) {
                        $m = $m+$j;
                        $tail = $new;
                        $lenght = iconv("UTF-8", "GBK//IGNORE", $new);
                        $k = $A - strlen($lenght);
                        for($q=0;$q<$k;$q++){
                            $kw3 .= ' ';
                        }
                        $tail .= $kw3;
                        break;
                    }else{
                        $next_new = mb_substr($str,$m,$j,'utf-8');
                        if(mb_strwidth($next_new,'utf-8')<$blankNum) continue;
                        else{
                            $m = $i+1;
                            $result[] = $new.'<BR>';
                            $j=1;
                        }
                    }
                }
            }
            $head = '';
            foreach ($result as $value) {
                $head .= $value;
            }
            if(strlen($price) < $B){
                $k1 = $B - strlen($price);
                for($q=0;$q<$k1;$q++){
                    $kw1 .= ' ';
                }
                $price = $price.$kw1;
            }
            if(strlen($num) < $C){
                $k2 = $C - strlen($num);
                for($q=0;$q<$k2;$q++){
                    $kw2 .= ' ';
                }
                $num = $num.$kw2;
            }
            if(strlen($prices) < $D){
                $k3 = $D - strlen($prices);
                for($q=0;$q<$k3;$q++){
                    $kw4 .= ' ';
                }
                $prices = $prices.$kw4;
            }
            $orderInfo .= $head.$tail.' '.$price.' '.$num.' '.$prices.'<BR>';
            @$nums += $prices;
        }

        return $orderInfo;
    }

    //打印组合方法
    public function printKitchen2($food_nub,$order,$time=1){

        $orderInfo = $this->Typesetting5(array($food_nub),16,5,6,5,$order);
        $this->wp_print($order['print_id'],$orderInfo,$time);
    }

    /**
     *    后厨退菜打印
     *    名称($A => 26) 单价($B => 7) 数量($C => 4) 金额($D => 6)-->数值适合80mm打印机，这里的字节数可按自己需求自由改写
     */

    protected function Typesetting5($arr,$A,$B,$C,$D,$order)
    {
        $orderInfo = '<CB>'.$order['theTitle'].'</CB><BR>';
        $orderInfo .= '订单号：'.$order['order_id'].'<BR>';
        $orderInfo .= '服务厅：'.$order['name'].'     桌号：'.$order['tb_id'].'号<BR>';
        $orderInfo .= '--------------------------------<BR>';
        $orderInfo .= '名称　　　　　 单价  数量 金额<BR>';
        $orderInfo .= '--------------------------------<BR>';
        foreach ($arr as $k5 => $v5) {
            $name = $v5['title'];
            $price = $v5['price'];
            $num = $v5['num'];
            $prices = $v5['price']*$v5['num'];
            $kw3 = '';
            $kw1 = '';
            $kw2 = '';
            $kw4 = '';
            $str = $name;
            $blankNum = $A;
            $lan = mb_strlen($str,'utf-8');
            $m = 0;
            $j=1;
            $blankNum++;
            $result = array();
            for ($i=0;$i<$lan;$i++){
                $new = mb_substr($str,$m,$j,'utf-8');
                $j++;
                if(mb_strwidth($new,'utf-8')<$blankNum) {
                    if($m+$j>$lan) {
                        $m = $m+$j;
                        $tail = $new;
                        $lenght = iconv("UTF-8", "GBK//IGNORE", $new);
                        $k = $A - strlen($lenght);
                        for($q=0;$q<$k;$q++){
                            $kw3 .= ' ';
                        }
                        $tail .= $kw3;
                        break;
                    }else{
                        $next_new = mb_substr($str,$m,$j,'utf-8');
                        if(mb_strwidth($next_new,'utf-8')<$blankNum) continue;
                        else{
                            $m = $i+1;
                            $result[] = $new.'<BR>';
                            $j=1;
                        }
                    }
                }
            }
            $head = '';
            foreach ($result as $value) {
                $head .= $value;
            }
            if(strlen($price) < $B){
                $k1 = $B - strlen($price);
                for($q=0;$q<$k1;$q++){
                    $kw1 .= ' ';
                }
                $price = $price.$kw1;
            }
            if(strlen($num) < $C){
                $k2 = $C - strlen($num);
                for($q=0;$q<$k2;$q++){
                    $kw2 .= ' ';
                }
                $num = $num.$kw2;
            }
            if(strlen($prices) < $D){
                $k3 = $D - strlen($prices);
                for($q=0;$q<$k3;$q++){
                    $kw4 .= ' ';
                }
                $prices = $prices.$kw4;
            }
            $orderInfo .= $head.$tail.' '.$price.' '.$num.' '.$prices.'<BR>';
            @$nums += $prices;
        }
        $time = date('Y-m-d H:i:s',time());
        $orderInfo .= '--------------------------------<BR>';
        $orderInfo .= '合计：'.number_format($nums, 1).'元<BR>';
        $orderInfo .= '退菜时间：'.$time.'<BR>';
        $content    =  $this->bar_code($order['order_id']);
        $orderInfo .=  $content;//把解析后的二维码生成的字符串用标签套上即可自动生成二维码
        return $orderInfo;
    }

    /**
     * 修改对应的打印机备注属性
     * @param $data
     * @return array
     */
    public function change($data){
        if(empty($data)){
            return array('code'=>1000,'sub_msg'=>'数据为空');
        }
        $msgInfo = array(
            'user'=>self::USER,
            'stime'=>$this->stime,
            'sig'=>$this->sig,
            'apiname'=>'Open_printerEdit',
            'sn'     => $data['printer_id'],
            'name'   => $data['remark'],
        );
        $client = new \HttpClient(self::IP,self::PORT);
        if(!$client->post(self::PATH,$msgInfo)){
            return array('code'=>1110,'sub_msg'=>'修改失败');
        }
        else{
            $result = $client->getContent();
            return array('code'=>1111,'sub_msg'=>'成功');
        }
    }

    /**
     * 删除打印机
     * @param $data
     * @return array
     */
    public function delete_code($data){
        if(empty($data)){
            return array('code'=>1000,'sub_msg'=>'数据为空');
        }
        $msgInfo = array(
            'user'=>self::USER,
            'stime'=>$this->stime,
            'sig'=>$this->sig,
            'apiname'=>'Open_printerDelList',

        );
        if(is_array($data)){
            if(!empty($data[0])&&is_array($data)){
                return array('code'=>1100,'sub_msg'=>'不支持二维以上数组');
            }
            $msgInfo['snlist'] = implode('-',$data);
        }else{
            $msgInfo['snlist'] = $data;
        }
        $client = new \HttpClient(self::IP,self::PORT);
        if(!$client->post(self::PATH,$msgInfo)){
            return array('code'=>1110,'sub_msg'=>'删除失败');
        }
        else{
            $result = \Qiniu\json_decode($client->getContent(),true);
            if(empty($result['data']['ok'])){
                return array(
                    'code'=>'1110',
                    'sub_msg'=>$result['data']['no'][0]);
            }
            return  array('code'=>'1111','sub_msg'=>'删除成功');
        }
    }
}