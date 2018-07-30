<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:57:"themes/admin_simpleboot3/admin\seller\sellerdetailed.html";i:1526870467;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

    <link rel="icon" href="__TMPL__/public/assets/images/favicon.ico" type="image/x-icon">
    <link href="__TMPL__/public/assets/themes/<?php echo cmf_get_admin_style(); ?>/bootstrap.min.css" rel="stylesheet">
    <link href="__TMPL__/public/assets/simpleboot3/css/simplebootadmin.css" rel="stylesheet">
    <link href="__STATIC__/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style>
        form .input-order {
            margin-bottom: 0px;
            padding: 0 2px;
            width: 42px;
            font-size: 12px;
        }

        form .input-order:focus {
            outline: none;
        }

        .table-actions {
            margin-top: 5px;
            margin-bottom: 5px;
            padding: 0px;
        }

        .table-list {
            margin-bottom: 0px;
        }

        .form-required {
            color: red;
        }
    </style>
    <script type="text/javascript">
        //全局变量
        var GV = {
            ROOT: "__ROOT__/",
            WEB_ROOT: "__WEB_ROOT__/",
            JS_ROOT: "static/js/",
            APP: '<?php echo \think\Request::instance()->module(); ?>'/*当前应用名*/
        };
    </script>
    <script src="__TMPL__/public/assets/js/jquery-1.10.2.min.js"></script>
    <script src="__STATIC__/js/wind.js"></script>
    <script src="__TMPL__/public/assets/js/bootstrap.min.js"></script>
    <script>
        Wind.css('artDialog');
        Wind.css('layer');
        $(function () {
            $("[data-toggle='tooltip']").tooltip();
            $("li.dropdown").hover(function () {
                $(this).addClass("open");
            }, function () {
                $(this).removeClass("open");
            });
        });
    </script>
    <?php if(APP_DEBUG): ?>
        <style>
            #think_page_trace_open {
                z-index: 9999;
            }
        </style>
    <?php endif; ?>
<style type="text/css">
    .pic-list li {
        margin-bottom: 5px;
    }
</style>
<script type="text/html" id="photos-item-tpl">
    <li id="saved-image{id}">
        <input id="photo-{id}" type="hidden" name="photo_urls[]" value="{filepath}">
        <input class="form-control" id="photo-{id}-name" type="text" name="photo_names[]" value="{name}"
               style="width: 200px;" title="图片名称">
        <img id="photo-{id}-preview" src="{url}" style="height:36px;width: 36px;"
             onclick="imagePreviewDialog(this.src);">
        <a href="javascript:uploadOneImage('图片上传','#photo-{id}');">替换</a>
        <a href="javascript:(function(){$('#saved-image{id}').remove();})();">移除</a>
    </li>
</script>
</head>
<body>
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<?php if(session('ADMIN_ID') == 1): ?>
			<li><a href="<?php echo url('Seller/index'); ?>">商家列表</a></li>
			<?php endif; ?>
			<li class="active"><a href="#">详细信息</a></li>
		</ul>
		<form action="<?php echo url('Seller/sellerEditPost',array('id'=>$data['id'])); ?>" method="post" class="form-horizontal js-ajax-form margin-top-20">   <!-- js-ajax-form -->
        <div class="row">
            <div class="col-md-9">
                <table class="table table-bordered">
                    <tr>
                        <th width="100">店名</th>
                        <td colspan="4">
                        <input class="form-control" readonly type="text" name="post[seller_nickname]" id="keywords" required value="<?php echo $data['seller_nickname']; ?>"
                                   placeholder="请输入商家点名">
                        </td>
                    </tr>
                    <tr>
                        <th>地址</th> 
                        <td>
                            <input class="form-control" readonly type="text" name="post[seller_address]"
                                   id="title" required value="<?php echo $data['seller_address']; ?>" placeholder="请输入地址"/>
                        </td>
                        <th  width="8%">
                           坐标
                        </th>
                        <td width="20%">
                            <input class="form-control" type="text" name="post[seller_lng]"
                                   id="lng" readonly value="<?php echo $data['seller_lng']; ?>" placeholder="经度"/>
                        </td>
                        <td width="20%">
                            <input class="form-control" type="text" name="post[seller_lat]"
                                   id="lat" readonly value="<?php echo $data['seller_lat']; ?>" placeholder="纬度"/>
                        </td>
                    </tr>
                    <tr>
                        <th>手机号<span class="form-required"></span></th>
                        <td colspan="4">
                            <input class="form-control" readonly type="text" name="post[seller_tel]"
                                   id="title" value="<?php echo $data['seller_tel']; ?>" placeholder="请输入手机号"/>
                        </td>
                    </tr>
                    <tr>
                        <th>运营时间<span class="form-required"></span></th>
                        <td colspan="1">
                            <input class="form-control" readonly  style="width:300px;" type="text" name="post[seller_time_start]"
                                   value="<?php echo $data['seller_time_start']; ?>" placeholder="请输入开始时间">
                            <span class="form-required">开始营业时间</span>
                        </td>
                        <td colspan="3">
                            <input class="form-control" readonly style="width:300px;" type="text" name="post[seller_time_end]"
                                   value="<?php echo $data['seller_time_end']; ?>" placeholder="请输入结束时间">
                            <span class="form-required">结束营业时间</span>
                        </td>
                    </tr>
                    <tr>
                        <th>满额配送<span class="form-required"></span></th>
                        <td colspan="4">
                            <input class="form-control" readonly type="text" name="post[takeout_max]"
                                   id="title" required value="<?php echo $data['takeout_max']; ?>" placeholder="请输入所需金额"/>
                        </td>
                    </tr>
                    <tr>
                        <th>预定桌数</th>
                        <td colspan="4">
                            <input class="form-control" readonly type="text" name="post[table]" id="keywords" value="<?php echo $data['table']; ?>"
                                   placeholder="输入可预订的桌数">
                        </td>
                    </tr>
                    <tr>
                        <th>商家描述</th>
                        <td colspan="4">
                            <input class="form-control" readonly type="text" id="content" value="<?php echo $data['seller_introduce']; ?>" name="post[seller_introduce]" placeholder="输入商家的描述">
                        </td>
                    </tr>    
                    <tr>
                        <th>商家AppID</th>
                        <td colspan="4">
                            <input class="form-control" readonly type="text" id="post[appid]" value="<?php echo $data['appid']; ?>" name="post[appid]" placeholder="输入商家的描述">
                        </td>
                    </tr>                                   
                </table>
                <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-10">
                        <a class="btn btn-default" href="<?php echo url('seller/sellerEdit',array('id'=>$data['id'])); ?>">修改信息</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <table class="table table-bordered">
                    <tr>
                        <th><b>商家LOGO</b></th>
                    </tr>
                    <tr>
                        <td>
                            <div style="text-align: center;">
                                <input type="hidden" name="post[seller_logo]" id="thumbnail" value="">                            
                                    <img src="<?php if(empty($data['seller_logo'])): ?>__TMPL__/public/assets/images/default-thumbnail.png<?php else: ?><?php echo cmf_get_image_preview_url($data['seller_logo']); endif; ?>"
                                         id="thumbnail-preview" width="135" style="cursor: pointer"/>

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><b>注册时间</b></th>
                    </tr>
                    <tr>
                        <td>
                            <input class="form-control" readonly type="text" name="post[create_time]"
                                   value="<?php echo date('Y-m-d H:i:s',$data['create_time']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th><b>配送方式</b></th>
                    </tr>
                    <tr>
                        <td>
                        	<?php 
                        		$seller_type=array('0'=>'外卖+点餐','1'=>'点餐','2'=>'外卖');
                        		$seller_status=array('0'=>'禁用','1'=>'正常','2'=>'未验证');
                        	 ?>
                        	<input class="form-control" readonly type="text" value="<?php echo $seller_type[$data['seller_type']]; ?>">                  
                        </td>
                    </tr>
                        <th>商家状态</th>
                    </tr>
                    <tr>
                        <td>
                        	<input class="form-control" readonly type="text" value="<?php echo $seller_status[$data['seller_status']]; ?>">                           
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
	</div>
	<script type="text/javascript" src="__STATIC__/js/admin.js"></script>
	<script type="text/javascript">
	    //编辑器路径定义
	    var editorURL = GV.WEB_ROOT;
	</script>
	<script type="text/javascript" src="__STATIC__/js/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" src="__STATIC__/js/ueditor/ueditor.all.min.js"></script>
	<script type="text/javascript">
	    $(function () {

	        editorcontent = new baidu.editor.ui.Editor();
	        editorcontent.render('content');
	        try {
	            editorcontent.sync();
	        } catch (err) {
	        }

	        $('.btn-cancel-thumbnail').click(function () {
	            $('#thumbnail-preview').attr('src', '__TMPL__/public/assets/images/default-thumbnail.png');
	            $('#thumbnail').val('');
	        });

	    });
	</script>
</body>
</html>