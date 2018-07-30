<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:51:"themes/wechat_ordering/user\index\seller_index.html";i:1530195263;s:39:"themes/wechat_ordering/public\head.html";i:1528451063;s:38:"themes/wechat_ordering/public\nav.html";i:1524642742;s:41:"themes/wechat_ordering/public\footer.html";i:1530186868;}*/ ?>
<!DOCTYPE html>
<html>
  <head>
    <title>微信点餐-首页</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="pragma" content="no-cache">

<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<!-- weui Start-->
<link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
<link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">
<!-- weui end -->

<!-- artDialog Start-->
<link rel="stylesheet" href="__STATIC__/js/artDialog/skins/default.css?v=">
<link rel="stylesheet" href="__STATIC__/js/layer/skin/default/layer.css?v=">
<!-- artDialog end -->

<!-- <link rel="stylesheet" type="text/css" href="__TMPL__/public/assets/css/cropper.css">
<link rel="stylesheet" href="__TMPL__/public/assets/css/geeteststyle.css"> -->
<!-- <script src="__TMPL__/public/assets/js/jweixin-1.0.0.js"></script> -->
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>

<script>
  window.ROOTURL = location.href;
  function SetShareConfig(appId, timestamp, nonceStr, signature) {
    wx.config({
      debug: false,//true false
      appId: appId,
      timestamp: timestamp,
      nonceStr: nonceStr,
      signature: signature,
      jsApiList: ["onMenuShareTimeline", "onMenuShareAppMessage", "onMenuShareQQ", "onMenuShareWeibo", "onMenuShareQZone", 'startRecord', 'stopRecord', 'onVoiceRecordEnd', 'playVoice', 'onVoicePlayEnd', 'pauseVoice', 'stopVoice', 'uploadVoice', 'downloadVoice','chooseWXPay','openAddress','scanQRCode']
    });
  }
  function PlayShareConfig(title, desc, img, titleTow, url) {
    wx.ready(function() {
      wx.onMenuShareTimeline({
        title: titleTow,
        link: url,
        imgUrl: img,
        success: function() {},
        cancel: function() {}
      });
      wx.onMenuShareAppMessage({
        title: title,
        desc: desc,
        link: url,
        imgUrl: img,
        type: "",
        dataUrl: "",
        success: function() {},
        cancel: function() {}
      });
      wx.onMenuShareQQ({
        title: title,
        desc: desc,
        link: url,
        imgUrl: img,
        success: function() {},
        cancel: function() {}
      });
      wx.onMenuShareWeibo({
        title: title,
        desc: desc,
        link: url,
        imgUrl: img,
        success: function() {},
        cancel: function() {}
      });
      wx.onMenuShareQZone({
        title: title,
        desc: desc,
        link: url,
        imgUrl: img,
        success: function() {},
        cancel: function() {}
      });
    });
  }
</script>

<link href="__TMPL__/public/assets/css/app.css?v=20180412" rel="stylesheet">

<script type="text/javascript">
    //全局变量
    var GV = {
        ROOT: "__ROOT__/",
        WEB_ROOT: "__WEB_ROOT__/",
        JS_ROOT: "static/js/"
    };
</script>	

<?php 
  $default_thumb= "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAB4CAMAAAAOusbgAAAAeFBMVEUAwAD///+U5ZTc9twOww7G8MYwzDCH4YcfyR9x23Hw+/DY9dhm2WZG0kbT9NP0/PTL8sux7LFe115T1VM+zz7i+OIXxhes6qxr2mvA8MCe6J6M4oz6/frr+us5zjn2/fa67rqB4IF13XWn6ad83nxa1loqyirn+eccHxx4AAAC/klEQVRo3u2W2ZKiQBBF8wpCNSCyLwri7v//4bRIFVXoTBBB+DAReV5sG6lTXDITiGEYhmEYhmEYhmEYhmEY5v9i5fsZGRx9PyGDne8f6K9cfd+mKXe1yNG/0CcqYE86AkBMBh66f20deBc7wA/1WFiTwvSEpBMA2JJOBsSLxe/4QEEaJRrASP8EVF8Q74GbmevKg0saa0B8QbwBdjRyADYxIhqxAZ++IKYtciPXLQVG+imw+oo4Bu56rjEJ4GYsvPmKOAB+xlz7L5aevqUXuePWVhvWJ4eWiwUQ67mK51qPj4dFDMlRLBZTqF3SDvmr4BwtkECu5gHWPkmDfQh02WLxXuvbvC8ku8F57GsI5e0CmUwLz1kq3kD17R1In5816rGvQ5VMk5FEtIiWislTffuDpl/k/PzscdQsv8r9qWq4LRWX6tQYtTxvI3XyrwdyQxChXioOngH3dLgOFjk0all56XRi/wDFQrGQU3Os5t0wJu1GNtNKHdPqYaGYQuRDfbfDf26AGLYSyGS3ZAK4S8XuoAlxGSdYMKwqZKM9XJMtyqXi7HX/CiAZS6d8bSVUz5J36mEMFDTlAFQzxOT1dzLRljjB6+++ejFqka+mXIe6F59mw22OuOw1F4T6lg/9VjL1rLDoI9Xzl1MSYDNHnPQnt3D1EE7PrXjye/3pVpr1Z45hMUdcACc5NVQI0bOdS1WA0wuz73e7/5TNqBPhQXPEFGJNV2zNqWI7QKBd2Gn6AiBko02zuAOXeWIXjV0jNqdKegaE/kJQ6Bfs4aju04lMLkA2T5wBSYPKDGF3RKhFYEa6A1L1LG2yacmsaZ6YPOSAMKNsO+N5dNTfkc5Aqe26uxHpx7ZirvgCwJpWq/lmX1hA7LyabQ34tt5RiJKXSwQ+0KU0V5xg+hZrd4Bn1n4EID+WkQdgLfRNtvil9SPfwy+WQ7PFBWQz6dGWZBLkeJFXZGCfLUjCgGgqXo5TuSu3cugdcTv/HjqnBTEMwzAMwzAMwzAMwzAMw/zf/AFbXiOA6frlMAAAAABJRU5ErkJggg==";
 ?>
    <style type="text/css">
      .swiper-container .swiper-slide img{
        width: 100%;
      }
    </style>
  </head>
  <body class="grade-a">

      <!-- 幻灯片 -->
      <div class="swiper-container" data-space-between='10' data-pagination='.swiper-pagination' data-autoplay="1000">
        <div class="swiper-wrapper">
          <?php if(!(empty($seller_advert) || (($seller_advert instanceof \think\Collection || $seller_advert instanceof \think\Paginator ) && $seller_advert->isEmpty()))): if(is_array($seller_advert) || $seller_advert instanceof \think\Collection || $seller_advert instanceof \think\Paginator): if( count($seller_advert)==0 ) : echo "" ;else: foreach($seller_advert as $key=>$vo): ?>
              <div class="swiper-slide"><img src="<?php echo cmf_get_image_url($vo); ?>" alt=""></div>
            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
      </div>

      <!-- 菜单导航 -->
      <div class="weui-grids index-nav-food">
        <!-- 菜系项 -->
        <?php if(!(empty($menu) || (($menu instanceof \think\Collection || $menu instanceof \think\Paginator ) && $menu->isEmpty()))): if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): if(($key<5)): ?>
            <a href="<?php echo cmf_url('user/index/FoodList',['parent_id'=>$vo['id']]); ?>" class="weui-grid js_grid">
              <div class="weui-grid__icon">
                <icon class="iconfont icon-<?php echo $vo['icon']; ?>" type="" size=""/>
              </div>
              <p class="weui-grid__label">
                <?php echo $vo['name']; ?>
              </p>
            </a>
            <?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
        <!-- 功能项 -->
        <a href="<?php echo cmf_url('user/index/sellerReserve'); ?>" class="weui-grid js_grid">
          <div class="weui-grid__icon">
            <icon class="iconfont icon-yuyue" type="" size=""/>
          </div>
          <p class="weui-grid__label">
            预订餐桌
          </p>
        </a>
        <!-- <a href="" class="weui-grid js_grid">
          <div class="weui-grid__icon">
            <icon class="iconfont icon-quhaopaidui" type="" size=""/>
          </div>
          <p class="weui-grid__label">
            预约排号
          </p>
        </a> -->
        <a href="" class="weui-grid js_grid" id="scanQRCode">
          <div class="weui-grid__icon">
            <icon class="iconfont icon-saoma" type="" size=""/>
          </div>
          <p class="weui-grid__label">
            扫码点餐
          </p>
        </a>
        <!-- <a href="" class="weui-grid js_grid">
          <div class="weui-grid__icon">
            <icon class="iconfont icon-shouyin1" type="" size=""/>
          </div>
          <p class="weui-grid__label">
            收银
          </p>
        </a> -->
        <a href="<?php echo cmf_url('user/index/FoodList'); ?>" class="weui-grid js_grid">
          <div class="weui-grid__icon">
            <icon class="iconfont icon-iconfontgengduo" type="" size=""/>
          </div>
          <p class="weui-grid__label">
            更多
          </p>
        </a>
      </div>
      
      <!-- 推荐菜品 -->
      <div class="weui-panel weui-panel_access">
        <div class="weui-panel__hd title-lists">
          <div  class="fl title-hide">推荐菜品</div>
          <div class="weui-panel__ft fr">
            <a href="<?php echo cmf_url('user/index/FoodList'); ?>" class="weui-cell weui-cell_access weui-cell_link">
              <div class="weui-cell__bd">查看更多</div>
              <span class="weui-cell__ft"></span>
            </a>    
          </div>
          <div class="clear"> </div>
        </div>
        <div class="weui-panel__bd conont-lists">
          <?php if(!(empty($data) || (($data instanceof \think\Collection || $data instanceof \think\Paginator ) && $data->isEmpty()))): if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): if($key < '2'): ?>
                <a href="<?php echo cmf_url('user/index/FoodList',['parent_id'=>$vo['parent_id'],'child_id'=>$vo['food_menu_id']]); ?>#Dishes-list-<?php echo $vo['id']; ?>" class="weui-media-box weui-media-box_appmsg">
                  <div class="weui-media-box__hd">
                    <img class="weui-media-box__thumb" src="<?php echo cmf_get_image_url($vo['food_icon']); ?>">
                  </div>
                  <div class="weui-media-box__bd">
                    <h4 class="weui-media-box__title"><?php echo $vo['food_name']; ?></h4>
                    <h5 class="weui-media-box__price">￥ <?php echo $vo['price']; ?></h5>
                    <p class="weui-media-box__desc"><?php echo $vo['food_describe']; ?></p>
                  </div>
                </a>
              <?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
        </div>
      </div>
      
      <!-- 热销菜品 -->
      <div class="weui-panel weui-panel_access">
        <div class="weui-panel__hd title-lists">
          <div  class="fl title-hide">热销菜品</div>
          <div class="weui-panel__ft fr">
            <a href="<?php echo cmf_url('user/index/FoodList'); ?>" class="weui-cell weui-cell_access weui-cell_link">
              <div class="weui-cell__bd">查看更多</div>
              <span class="weui-cell__ft"></span>
            </a>    
          </div>
          <div class="clear"> </div>
        </div>
        <div class="weui-panel__bd conont-lists">
          <?php if(!(empty($data) || (($data instanceof \think\Collection || $data instanceof \think\Paginator ) && $data->isEmpty()))): if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): if($key >= '2'): ?>
                <a href="<?php echo cmf_url('user/index/FoodList',['parent_id'=>$vo['parent_id'],'child_id'=>$vo['food_menu_id']]); ?>#Dishes-list-<?php echo $vo['id']; ?>" class="weui-media-box weui-media-box_appmsg">
                  <div class="weui-media-box__hd">
                    <img class="weui-media-box__thumb" src="<?php echo cmf_get_image_url($vo['food_icon']); ?>">
                  </div>
                  <div class="weui-media-box__bd">
                    <h4 class="weui-media-box__title"><?php echo $vo['food_name']; ?></h4>
                    <h5 class="weui-media-box__price">￥ <?php echo $vo['price']; ?></h5>
                    <p class="weui-media-box__desc"><?php echo $vo['food_describe']; ?></p>
                  </div>
                </a>
              <?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
        </div>
      </div>

    <!-- nav 底部导航 -->
    <?php 
      $requestAction = request()->action();
     ?>

    <div class="clear-bothheight"> </div>

    <div class="weui-tabbar wx-food-foodnav">
        <a href="<?php echo cmf_url('user/index/seller_index',['appid'=>4]); ?>" class="weui-tabbar__item <?php if($requestAction == 'seller_index'): ?> weui-bar__item_on <?php endif; ?> ">
            <span style="display: inline-block;position: relative;">
                <icon class="iconfont icon-shouye weui-tabbar__icon " type="" size="50"/>
            </span>
            <p class="weui-tabbar__label">首页</p>
        </a>
        <a href="<?php echo cmf_url('user/index/FoodList'); ?>" class="weui-tabbar__item <?php if($requestAction == 'foodlist'): ?> weui-bar__item_on <?php endif; ?> ">
            <span style="display: inline-block;position: relative;">
                <icon class="iconfont icon-qingdan- weui-tabbar__icon " type="" />
            </span>
            <p class="weui-tabbar__label">菜单</p>
        </a>
        <a href="<?php echo cmf_url('user/index/sellerReserve'); ?>" class="weui-tabbar__item <?php if($requestAction == 'sellerreserve'): ?> weui-bar__item_on <?php endif; ?> ">
            <span style="display: inline-block;position: relative;">
                <icon class="iconfont icon-yuyue weui-tabbar__icon " type="" />
            </span>
            <p class="weui-tabbar__label">预订</p>
        </a>
        <a href="<?php echo cmf_url('user/index/order'); ?>" class="weui-tabbar__item <?php if($requestAction == 'order'): ?> weui-bar__item_on <?php endif; ?> ">
            <span style="display: inline-block;position: relative;">
                <icon class="iconfont icon-dingdan weui-tabbar__icon " type="" />
            </span>
            <p class="weui-tabbar__label">订单</p>
        </a>
        <a href="<?php echo cmf_url('user/index/my'); ?>" class="weui-tabbar__item <?php if($requestAction == 'my'): ?> weui-bar__item_on <?php endif; ?>">
            <span style="display: inline-block;position: relative;">
                <icon class="iconfont icon-wode weui-tabbar__icon " type="" />
            </span>
            <p class="weui-tabbar__label">我的</p>
        </a>
    </div>
<!-- loading toast -->
<div id="loadingToast" style="display:none;">
    <div class="weui-mask_transparent"></div>
    <div class="weui-toast">
        <i class="weui-loading weui-icon_toast"></i>
        <p class="weui-toast__content">数据加载中</p>
    </div>
</div>

<div id="toast" style="display: none;">
    <div class="weui-mask_transparent"></div>
    <div class="weui-toast">
        <i class="weui-icon-success-no-circle weui-icon_toast"></i>
        <p class="weui-toast__content">已完成</p>
    </div>
</div>

<!-- Msg 操作失败提示页 -->
<div class="page" id="tpl_msg_warn" style="display: none;">
    <div class="weui-msg">
        <div class="weui-msg__icon-area"><i class="weui-icon-warn weui-icon_msg"></i></div>
        <div class="weui-msg__text-area">
            <h2 class="weui-msg__title">请在微信客户端打开</h2>
            <!-- <p class="weui-msg__desc">内容详情，可根据实际需要安排，如果换行则不超过规定长度，居中展现<a href="javascript:void(0);">文字链接</a></p> -->
        </div>
        <div class="weui-msg__extra-area">
            <div class="weui-footer">
                <p class="weui-footer__links">
                    <a href="javascript:void(0);" class="weui-footer__link"><?php echo (isset($site_info['site_name']) && ($site_info['site_name'] !== '')?$site_info['site_name']:''); ?></a>
                </p>
                <p class="weui-footer__text"><?php echo (isset($site_info['site_icp']) && ($site_info['site_icp'] !== '')?$site_info['site_icp']:''); ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Footer ================================================== -->

  </body>

<!-- WEUI js stare-->
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>

<!-- 如果使用了某些拓展插件还需要额外的JS -->
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/swiper.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/city-picker.min.js"></script>
<!-- WEUI js end-->

<!-- layer stare-->
<script src="__STATIC__/js/layer/layer.js"></script>
<!-- layer end-->

<script type="text/javascript" src="__TMPL__/public/assets/js/app.js"></script>
    
<script src="__STATIC__/js/wind.js"></script>
<script src="__STATIC__/js/admin.js"></script>

<!-- 限制页面只能在微信浏览器打开 -->
<script type="text/javascript">  

    //预订餐桌服务厅选择
    $("#sellrmenus .booking-numname").click(function(){
      $("#sellrmenus .booking-numname").removeClass('isusing');
      $(this).addClass('isusing');
      var menu_id = $(this).attr('data-id');
      $("#menu_id").val(menu_id);
      $("#Notable_types").html('<div class="clear"> </div>');

        $.ajax({
            type: "POST",//方法类型
            dataType: "json",//预期服务器返回的数据类型
            url: "<?php echo cmf_url('user/index/sellerTableAjax'); ?>" ,//url
            data: {'menu_id':menu_id},
            success: function (result) {
//                console.log(result);
                if (result.resultCode == 200) {
                    var data = '';
                    $.each(result.data,function(name,value) {
                        var Scheduled = value.countrest ? '' : 'Scheduled';
                        data+= '<view class="booking-numname '+ Scheduled +'" data-id="'+ value.table_id +'" data-countrest="'+ value.countrest +'" bindtap="tapName" >'+ value.table_name +'</view>';
                    });
                    data+= '<div class="clear"> </div>';

                    $("#Notable_types").html('');
                    $("#Notable_types").append(data);
                    $(".Notable_type").fadeIn();

                }else{
                    layer.msg(result.message);
                }
            },
            error : function() {
                layer.msg('请求异常！');
            }
        });
    });

    //菜单点餐-服务厅选择
    $("#sellrmenus2 .booking-numname").click(function(){
      $("#sellrmenus2 .booking-numname").removeClass('isusing');
      $(this).addClass('isusing');
      var menu_id = $(this).attr('data-id');
      $("#menu_id").val(menu_id);
      $("#Notable_types").html('<div class="clear"> </div>');

        $.ajax({
            type: "POST",//方法类型
            dataType: "json",//预期服务器返回的数据类型
            url: "<?php echo cmf_url('user/index/sellerTableAjax2'); ?>" ,//url
            data: {'menu_id':menu_id},
            success: function (result) {
//                console.log(result);
                if (result.resultCode == 200) {
                    var data = '';
                    $.each(result.data,function(name,value) {
                        var Scheduled = value.type==1 ? '' : 'Scheduled';
                        data+= '<view class="booking-numname '+ Scheduled +'" data-id="'+ value.id +'" data-countrest="'+ value.type +'" bindtap="tapName" >' +
                            '<span >'+ value.tb_id +'号桌</span>' +
                            '<br/>' +
                            '<span style="font-size: 12px">'+value.table_name+'</span>' +
                            '</view>';
                    });
                    data+= '<div class="clear"> </div>';

                    $("#Notable_types2").html('');
                    $("#Notable_types2").append(data);
                    $(".Notable_type").fadeIn();

                }else{
                    layer.msg(result.message);
                }
            },
            error : function() {
                layer.msg('请求异常！');
            }
        });
    });

    // loading
    function loadingToast(){
        $(function(){
            var $loadingToast = $('#loadingToast');
            if ($loadingToast.css('display') != 'none') return;

            $loadingToast.fadeIn(100);
            setTimeout(function () {
                $loadingToast.fadeOut(100);
            }, 500);
        });
    }
    
    //toast
    function toast(){
        var $toast = $('#toast');
        if ($toast.css('display') != 'none') return;

        $toast.fadeIn(100);
        setTimeout(function () {
            $toast.fadeOut(100);
            
        }, 2000);
    }

    // 对浏览器的UserAgent进行正则匹配，不含有微信独有标识的则为其他浏览器  
    var useragent = navigator.userAgent;  
    if (useragent.match(/MicroMessenger/i) != 'MicroMessenger') {  
        // 这里警告框会阻塞当前页面继续加载  
        console.log('已禁止本次访问：您必须使用微信内置浏览器访问本页面！'); 
        $(".login_out").show();

        // $("#tpl_msg_warn").show();
        // $('.page-forward,.weui-tabbar').html('');
        // $('title').text('');
        
        // 以下代码是用javascript强行关闭当前页面  
        // var opened = window.open('about:blank', '_self');  
        // opened.opener = null;  
        // opened.close();  
    }else{
      // loadingToast();

      // setTimeout(function () {
      //     $(".page-forward,.weui-tabbar,#divMaskDetail").show();
      // }, 500);
    }
    function addshop(thiss){
     var arr 		= new Array();
     var Dishesnum 	= thiss.parent('.Dishes-num');  //商品数量
     var foodname 	= thiss.attr('data-foodname'); //当前位置 所在商品名称
     var dataprice	= parseFloat(thiss.attr('data-price')); //当前位置 所在单价
     var id			= parseInt(thiss.attr('data-id'));  //商品id
     var znumshop 	= parseInt($(".z-num-shop").text());  //总数量
     var Totalprice 	= parseFloat($(".Total-price").text());
     var key = 1;
     znumshop++;
     $(".z-num-shop").show();
     var allPrice = Math.floor((Totalprice+dataprice)*100)/100;
     $(".Total-price").text(allPrice);
     $(".z-num-shop").text(znumshop);

     $(".shop-chaked-list .Dishes-list .plus-round-add").each(function(){
     var shop_chaked_dataid = parseInt($(this).attr('data-id'));
     arr.push(shop_chaked_dataid);
     });

     if($.inArray(id, arr) == -1)
     {
     $(".shop-chaked-list .Dishes-list").append(
     '			<view class="Service-fee Service-fee-list Dishes-list-id-'+ id +'">'+
     '                <text class="fl">' + foodname +'</text>'+
     '                <view class="fr Dishes-num"> '+
     '                  <text class="price"> ￥ ' + dataprice +' </text>'+
     '                  <view class="plus-round plus-round-Reduce" data-foodname="' + foodname +'" data-id="' + id +'" data-price="' + dataprice +'" bindtap="SelectedamountReduce">-</view>'+
     '                  <text class="Dishes-num-size">1</text>'+
     '                  <view class="plus-round plus-round-add" data-foodname="' + foodname +'" data-id="' + id +'" data-price="' + dataprice +'" bindtap="SelectedamountAdd">+</view>'+
     '                </view>'+
     '                <view class="clear"></view>'+
     '           </view>'
     );
     }
     $(".Dishes-list-id-" + id).find('.Dishes-num-size').text((parseInt(Dishesnum.find('.Dishes-num-size').text())+1));
     // Dishesnum.find('.Dishes-num-size').text((parseInt(Dishesnum.find('.Dishes-num-size').text())+1));
     Dishesnum.find('.plus-round-Reduce').css('display','inline-block');
     Dishesnum.find('.Dishes-num-size').css('display','inline-block');
        var narr   = new Array(id,foodname,dataprice);
        sesssionTo(narr,1);
     }



     /*存储数据*/
    function sesssionTo(arr,type) {
        switch (type){
            case 1:
                $.post("<?php echo url('user/index/sesssionTo'); ?>",
                    {
                        'id'    : arr[0],
                        'name'  : arr[1],
                        'price' : arr[2],
                        'num'   : 1,
                        'type'  : 1
                    }
                    ,function (msg) {

                },'text');
                break;
            case 2:
                $.post("<?php echo url('user/index/sesssionTo'); ?>",
                    {
                        'id'    : arr[0],
                        'name'  : arr[1],
                        'price' : arr[2],
                        'num'   : 1,
                        'type'  : 2
                    }
                    ,function (msg) {
                    },'text');
                break;
            case 3:
                $.post("<?php echo url('user/index/sesssionTo'); ?>",
                    {'type'  : 3}
                    ,function (msg) {
                        Initialization(msg);
                    },'json');
                break;
            default:
                $.post("<?php echo url('user/index/sesssionTo'); ?>",
                    {'type':0},
                    function (msg) {
                },'text')
        }
    }

    $(document).ready(function () {
        sesssionTo('',3);
    });
    function Initialization(msg) {
        $.each(msg,function () {
                var Totalprice  = parseFloat($(".Total-price").text());
                var num = parseInt(this.num);
                var znumshop 	= parseInt($(".z-num-shop").text());  //总数量
                znumshop += num;
                $(".z-num-shop").show();
                $(".z-num-shop").text(znumshop);
                var foodname = this.name;
                var id = this.id;
                var dataprice = parseFloat(this.price);
                var all = parseFloat(Totalprice+Math.floor(num*dataprice*100)/100);
                 $(".Total-price").text(all);
                $(".shop-chaked-list .Dishes-list").append(
                    '			<view class="Service-fee Service-fee-list Dishes-list-id-'+ id +'">'+
                    '                <text class="fl">' + foodname +'</text>'+
                    '                <view class="fr Dishes-num"> '+
                    '                  <text class="price"> ￥ ' + dataprice +' </text>'+
                    '                  <view class="plus-round plus-round-Reduce" data-foodname="' + foodname +'" data-id="' + id +'" data-price="' + dataprice +'" bindtap="SelectedamountReduce">-</view>'+
                    '                  <text class="Dishes-num-size"> '+ num +' </text>'+
                    '                  <view class="plus-round plus-round-add" data-foodname="' + foodname +'" data-id="' + id +'" data-price="' + dataprice +'" bindtap="SelectedamountAdd">+</view>'+
                    '                </view>'+
                    '                <view class="clear"></view>'+
                    '           </view>'
                );

        });

    }

    /*减少*/
    function Reduceshop(thiss){
        var Dishesnum 	= thiss.parent('.Dishes-num');
        var foodname 	= thiss.attr('data-foodname'); //当前位置 所在商品名称
        var dataprice	= parseFloat(thiss.attr('data-price'));
        var id			= parseInt(thiss.attr('data-id'));
        var znumshop 	= parseInt($(".z-num-shop").text());
        var Totalprice 	= parseFloat($(".Total-price").text());
        var Dishesnumsize = (parseInt(Dishesnum.find('.Dishes-num-size').text()));
        Dishesnumsize--;
        znumshop--;
        var allPrice = Math.floor((Totalprice-dataprice)*100)/100;
        $(".Total-price").text(allPrice);
        if(znumshop >=0){
            $(".z-num-shop").text(znumshop);
        }
        if(znumshop <1){
            $(".z-num-shop").hide();
            $(".footer-shopping-Selected-products,.mask").hide();
            $('#Notactive-button').hide();
            $('#active-Selected').show();
        }

        // Dishesnum.find('.Dishes-num-size').text(Dishesnumsize);
        $(".Dishes-list-id-" + id).find('.Dishes-num-size').text(Dishesnumsize);
        if(Dishesnumsize <= 0){
            // Dishesnum.find('.plus-round-Reduce,.Dishes-num-size').hide();
            $(".Dishes-list-id-" + id).find('.plus-round-Reduce,.Dishes-num-size').hide();
            $(".shop-chaked-list .Dishes-list-id-" + id).remove();
        }
        var narr   = new Array(id,foodname,dataprice);
        sesssionTo(narr,2);

    }
</script>

<!-- <script type="text/javascript" charset="utf-8">
    var user_id      = "";
    var stateurl     = "";
    var state        = "";
    var redirect_uri = '';
    var appid        = 'wx96ef9f9c7c573a51';
    var code         = "";

    if(state == ''){
        state = stateurl;
    }

    if(user_id){
        console.log(code);
    }else{
        // window.location.href = "https://open.weixin.qq.com/connect/oauth2/authorize?appid="+ appid +"&redirect_uri="+ redirect_uri +"&response_type=code&scope=snsapi_userinfo&state="+ state +"#wechat_redirect";
    }

</script> -->



</html>


<script type="text/javascript">
  $(".swiper-container").swiper();

  //weixin  js-sdk


  wx.ready(function(){
    wx.checkJsApi({
        jsApiList: ['scanQRCode'], // 需要检测的JS接口列表，所有JS接口列表见附录2,
        success: function(res) {
          console.log('true');
            // 以键值对的形式返回，可用的api值true，不可用为false
            // 如：{"checkResult":{"chooseImage":true},"errMsg":"checkJsApi:ok"}
          
          $("#scanQRCode").click(function(){
            wx.scanQRCode({
              needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
              scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
              success: function (res) {
                console.log(res);
                var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
              }
            }); 
          })
        }
    });
  });
</script>