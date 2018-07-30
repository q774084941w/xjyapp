<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:50:"themes/admin_simpleboot3/admin\printer\change.html";i:1530186469;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
<link href="__STATIC__/js/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
<script src="__STATIC__/js/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="__STATIC__/js/bootstrap-select/js/i18n/defaults-zh_CN.min.js"></script>
</head>
<body>
<div class="wrap">
	<ul class="nav nav-tabs">
		<li><a href="<?php echo url('printer/index'); ?>">设备列表</a></li>
		<li><a href="<?php echo url('printer/add_index'); ?>">添加设备</a></li>
		<li class="active"><a href="#">修改</a></li>
	</ul>
	<form method="post" class="form-horizontal margin-top-20 js-ajax-form" action="<?php echo url('printer/change'); ?>">
		<input type="hidden" name="old_id" value="<?php echo $data['printer_id']; ?>">

		<div class="form-group">
			<label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>设备编号</label>
			<div class="col-md-6 col-sm-10">
				<input type="text" class="form-control" id="input-name" name="printer_id" placeholder="请输入正确的设备编号" value="<?php echo empty($data['printer_id'])?'':$data['printer_id']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="input-menu_id" class="col-sm-2 control-label"><span class="form-required">*</span>菜系</label>
			<div class="col-md-6 col-sm-10">
				<select class="form-control selectpicker" name="menu_id[]" id="input-menu_id" data-live-search="true" multiple data-actions-box="true">
					<?php echo $select_category; ?>
				</select>

			</div>
		</div>

		<div class="form-group">
			<label for="input-status" class="col-sm-2 control-label">位置</label>
			<div class="col-md-6 col-sm-10" >
				<select class="form-control selectpicker" name="position[]" data-live-search="true" multiple data-actions-box="true">
					<?php if(!(empty($position) || (($position instanceof \think\Collection || $position instanceof \think\Paginator ) && $position->isEmpty()))): if(is_array($position) || $position instanceof \think\Collection || $position instanceof \think\Paginator): if( count($position)==0 ) : echo "" ;else: foreach($position as $key=>$vo): ?>
							<option value="<?php echo $vo['posit_id']; ?>"
							<?php if(in_array(($vo['posit_id']), is_array($data['position'])?$data['position']:explode(',',$data['position']))): ?>selected<?php endif; ?>
							><?php echo $vo['name']; ?></option>
						<?php endforeach; endif; else: echo "" ;endif; endif; ?>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label for="input-key" class="col-sm-2 control-label"><span class="form-required">*</span>设备秘钥</label>
			<div class="col-md-6 col-sm-10">
				<input type="text" class="form-control" id="input-key" name="secret_key" placeholder="请输入正确的设备秘钥" value="<?php echo empty($data['secret_key'])?'':$data['secret_key']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="input-remark" class="col-sm-2 control-label">名称、型号等其他信息</label>
			<div class="col-md-6 col-sm-10">
				<textarea class="form-control" id="input-remark" name="remark">
					<?php echo empty($data['remark'])?'':$data['remark']; ?>
				</textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="input-status" class="col-sm-2 control-label">状态</label>
			<div class="col-md-6 col-sm-10" id="input-status">
				<select class="form-control" name="type">
					<option value="1" <?php echo $data['type']==1?'selected':''; ?>>启用</option>
					<option value="0"  <?php echo $data['type']==0?'selected':''; ?>>停用</option>
				</select>
			</div>
		</div>

		<?php 
			$voice = array('无','滴滴声','真人语音(小)','真人语音(中)','真人语音(大)');
		 ?>
		<div class="form-group">
			<label for="input-voice" class="col-sm-2 control-label">语音</label>
			<div class="col-md-6 col-sm-10" id="input-voice">
				<select class="form-control" name="voice">
					<?php if(is_array($voice) || $voice instanceof \think\Collection || $voice instanceof \think\Paginator): if( count($voice)==0 ) : echo "" ;else: foreach($voice as $key=>$vo): if(!empty($data['voice'])): ?>
							<option value="<?php echo $key; ?>" <?php echo $key==$data['voice']?'selected':''; ?>><?php echo $vo; ?></option>
						<?php else: ?>
						<option value="<?php echo $key; ?>"><?php echo $vo; ?></option>
						<?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary js-ajax-submit" >修改</button>  <!--js-ajax-submit-->
			</div>
		</div>
	</form>
</div>
</body>

<script type="text/javascript" src="__STATIC__/js/admin.js"></script>

</html>