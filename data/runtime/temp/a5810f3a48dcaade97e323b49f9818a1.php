<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:59:"themes/admin_simpleboot3/admin\traffic_report\lossedit.html";i:1528892868;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>


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

<div class="wrap js-check-wrap">
	<ul class="nav nav-tabs">
		<li><a href="<?php echo url('admin/trafficReport/lossIndex'); ?>">商品报损记录</a></li>
		<li><a href="<?php echo url('admin/trafficReport/lossAdd'); ?>">商品报损添加</a></li>
		<li class="active"><a href="">商品报损修改</a></li>
	</ul>

	<form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url('trafficReport/lossEdit'); ?>" >
		<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
		<div class="form-group">
			<label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>货品名称</label>
			<div class="col-md-6 col-sm-10">
				<select name="edit[tra_id]" id="input-name" class="form-control">
					<option value="">请选择</option>
					<?php if(!(empty($goods) || (($goods instanceof \think\Collection || $goods instanceof \think\Paginator ) && $goods->isEmpty()))): if(is_array($goods) || $goods instanceof \think\Collection || $goods instanceof \think\Paginator): if( count($goods)==0 ) : echo "" ;else: foreach($goods as $key=>$vo): ?>
							<option value="<?php echo $vo['tra_id']; ?>"  <?php echo $vo['tra_id']==$data['tra_id']?'selected':''; ?> ><?php echo $vo['name']; ?></option>
						<?php endforeach; endif; else: echo "" ;endif; endif; ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="input-tra_num" class="col-sm-2 control-label"><span class="form-required">*</span>数量</label>
			<div class="col-md-6 col-sm-10">
				<input type="hidden" name="old_tra_num" value="<?php echo $data['tra_num']; ?>">
				<input type="number" class="form-control" id="input-tra_num" name="edit[tra_num]" placeholder="数量" value="<?php echo $data['tra_num']; ?>" required>
			</div>
		</div>
		<?php if(empty($data['user_name']) || (($data['user_name'] instanceof \think\Collection || $data['user_name'] instanceof \think\Paginator ) && $data['user_name']->isEmpty())): ?>
			<div class="form-group">
				<label for="input-user_id" class="col-sm-2 control-label"><span class="form-required">*</span>报损人</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-user_id"  value="<?php echo empty($data['user_nickname'])?$data['user_login']:$data['user_nickname']; ?>" >
				</div>
			</div>
			<?php else: ?>
			<div class="form-group">
				<label for="input-user_name" class="col-sm-2 control-label"><span class="form-required">*</span>报损人</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-user_name" name="edit[user_name]" value="<?php echo $data['user_name']; ?>"  placeholder="请输入报损人的姓名" >
				</div>
			</div>
		<?php endif; ?>
		<div class="form-group">
			<label for="input-reason" class="col-sm-2 control-label"><span class="form-required">*</span>报损原因</label>
			<div class="col-md-6 col-sm-10">
				<input type="text" class="form-control" id="input-reason" name="edit[reason]" value="<?php echo $data['reason']; ?>"  placeholder="请输入报损原因" required>
			</div>
		</div>
		<div class="form-group">
			<label for="input-type" class="col-sm-2 control-label"><span class="form-required">*</span>状态</label>
			<div class="col-md-6 col-sm-10">
				<select name="add[type]" id="input-type" class="form-control">
					<option value="1" <?php echo $data['type']==1?'selected':''; ?>>已出库商品</option>
					<option value="2" <?php echo $data['type']==2?'selected':''; ?>>未出库商品</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="input-remark" class="col-sm-2 control-label">备注</label>
			<div class="col-md-6 col-sm-10">
				<textarea class="form-control" id="input-remark" name="edit[remark]" ><?php echo $data['remark']; ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary js-ajax-submit">修改</button>
			</div>
		</div>
	</form>


</div>
<script src="__STATIC__/js/admin.js"></script>


</body>
</html>