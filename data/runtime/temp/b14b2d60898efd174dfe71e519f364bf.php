<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:54:"themes/admin_simpleboot3/admin\classification\add.html";i:1528531780;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
</head>
<body>
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li><a href="<?php echo url('Classification/index'); ?>">菜系列表</a></li>
        	<li  class="active"><a href="<?php echo url('Classification/add'); ?>">新菜系添加</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url('Classification/addPost'); ?>">
			<div class="form-group">
				<label for="input-parent_id" class="col-sm-2 control-label"><span class="form-required">*</span>上级菜系</label>
				<div class="col-md-6 col-sm-10">
					<select class="form-control" name="parent_id" id="input-parent_id">
						<option value="0">作为一级菜单</option><?php echo $select_category; ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>名称</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-name" name="name">
				</div>
			</div>					
			<div class="form-group">
				<label for="input-icon" class="col-sm-2 control-label">图片</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-icon" name="icon">
					<p class="help-block">
						<a href="<?php echo url('Classification/icon'); ?>" target="_blank">选择图标</a> 不带前缀.icon-，如.icon-huoguo => huoguo
					</p>
				</div>
			</div>
			<div class="form-group">
				<label for="input-remark" class="col-sm-2 control-label">备注</label>
				<div class="col-md-6 col-sm-10">
					<textarea class="form-control" id="input-remark" name="remark"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="input-status" class="col-sm-2 control-label">状态</label>
				<div class="col-md-6 col-sm-10" id="input-status">
					<select class="form-control" name="status">
						<option value="1">在左侧菜单显示</option>
						<option value="0">在左侧菜单隐藏</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary js-ajax-submit">添加</button>
				</div>
			</div>
		</form>
	</div>
	<script src="__STATIC__/js/admin.js"></script>
</body>
</html>