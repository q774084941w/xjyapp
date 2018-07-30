<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:45:"themes/admin_simpleboot3/admin\user\edit.html";i:1528876861;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
			<li><a href="<?php echo url('user/index'); ?>"><?php echo lang('ADMIN_USER_INDEX'); ?></a></li>
			<li><a href="<?php echo url('user/add'); ?>">用户添加</a></li>
			<li class="active"><a>编辑管理员</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url('User/editPost'); ?>">
			<div class="form-group">
				<label for="input-user_login" class="col-sm-2 control-label"><span class="form-required">*</span><?php echo lang('USERNAME'); ?></label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-user_login" name="user_login" value="<?php echo $user_login; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_pass" class="col-sm-2 control-label"><span class="form-required">*</span><?php echo lang('PASSWORD'); ?></label>
				<div class="col-md-6 col-sm-10">
					<input type="password" class="form-control" id="input-user_pass" name="user_pass" value="" placeholder="******">
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_email" class="col-sm-2 control-label"><span class="form-required">*</span><?php echo lang('EMAIL'); ?></label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-user_email" name="user_email" value="<?php echo $user_email; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-user_email" class="col-sm-2 control-label"><span class="form-required">*</span><?php echo lang('ROLE'); ?></label>
				<div class="col-md-6 col-sm-10">
					<?php if(is_array($roles) || $roles instanceof \think\Collection || $roles instanceof \think\Paginator): if( count($roles)==0 ) : echo "" ;else: foreach($roles as $key=>$vo): ?>
						<label class="checkbox-inline">
							<?php $role_id_checked=in_array($vo['id'],$role_ids)?"checked":""; ?>
							<input value="<?php echo $vo['id']; ?>" type="checkbox" name="role_id[]" <?php echo $role_id_checked; if(cmf_get_current_admin_id() != 1 && $vo['id'] == 1): ?>disabled="true"<?php endif; ?>><?php echo $vo['name']; ?>
						</label>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>

			<div class="form-group">
				<label for="input-menu_id" class="col-sm-2 control-label"><span class="form-required">*</span>分配服务厅</label>
				<div class="col-md-6 col-sm-10">
					<select name="menu_id" id="input-menu_id"  class="form-control">
						<?php if(empty($menu) || (($menu instanceof \think\Collection || $menu instanceof \think\Paginator ) && $menu->isEmpty())): ?>
							<option value="">你还未建立服务厅</option>
							<?php else: ?>
							<option value="">请选择</option>
							<?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): ?>
								<option value="<?php echo $vo['id']; ?>" <?php if($menu_id == $vo['id']): ?> selected <?php endif; ?>><?php echo $vo['name']; ?></option>
							<?php endforeach; endif; else: echo "" ;endif; endif; ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="input-harge" class="col-sm-2 control-label"><span class="form-required">*</span>充值密码</label>
				<div class="col-md-6 col-sm-10">
					<input type="password" class="form-control" id="input-harge" name="harge" placeholder="<?php echo empty($harge)?'':'******'; ?>">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="hidden" name="id" value="<?php echo $id; ?>" />
					<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('SAVE'); ?></button>
					<a class="btn btn-default" href="javascript:history.back(-1);"><?php echo lang('BACK'); ?></a>
				</div>
			</div>
		</form>
	</div>
	<script src="__STATIC__/js/admin.js"></script>
</body>
</html>