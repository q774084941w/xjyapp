<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"themes/admin_simpleboot3/admin\kitchen\index.html";i:1530173601;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
<head>
	<style type="text/css">
		#Scavenger{
	    	background: none;
		    border: none;
		    /* font-size: 0; */
		}
	</style>
</head>
<body>
<div class="wrap js-check-wrap">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#">后厨</a></li>
	</ul>
	<?php 
		$food_type      = 	array('0'=>'未出菜','1'=>'正在出菜','2'=>'已经全部出菜');
	 ?>

	<form class="well form-inline margin-top-20" method="post" action="<?php echo url('kitchen/index'); ?>">

		<div class="form-inline">
			<div class="form-group cy-mar-ver-s">

				<input class="form-control" type="text" name="keyword"  value="<?php echo input('request.keyword'); ?>"
					   placeholder="请输入订单ID">

				<select name="menu" style="text-align: center" class="form-control">
					<?php if(!empty($menu[0])): ?>
						<option value="">请选择服务厅</option>
						<?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): ?>
							<option value="<?php echo $vo['id']; ?>" <?php if(input('request.menu') == $vo['id']): ?> selected <?php endif; ?> ><?php echo $vo['name']; ?></option>
						<?php endforeach; endif; else: echo "" ;endif; else: ?>
						<option value="">你还未建立服务厅，请在分类建立！</option>
					<?php endif; ?>
				</select>
				<input class="form-control" type="text" name="table" value="<?php echo input('request.table'); ?>"  placeholder="输入桌号">

				<span class="cy-pad-hor-s">时间</span>
			</div>
			<div class="input-daterange input-group" id="datepicker">
				<input type="text" class="js-bootstrap-date form-control" name="beginTime" id="qBeginTime" value="<?php echo input('request.beginTime'); ?>" />
				<span class="input-group-addon">至</span>
				<input type="text" class="js-bootstrap-date form-control" name="endTime" id="qEndTime"  value="<?php echo input('request.endTime'); ?>"/>
			</div>
			<div class="form-group cy-mar-ver-s">
				<input type="submit" class="btn btn-success" value="搜索"/>
				<a class="btn btn-danger" href="<?php echo url('kitchen/index'); ?>">清空</a>
			</div>
			<button id="Scavenger_take" class="btn btn-danger" style="float: right" type="button">
				扫一扫查找
			</button>
		</div>



	</form>

	<form method="post" class="margin-top-20">
		<table class="table table-hover table-bordered">
			<thead>
			<tr>
				<th width="10%">订单号</th>
				<th width="10%" align="left">下单时间</th>
				<th width="5%">服务厅</th>
				<th width="5%">餐桌号</th>
				<th width="15%">快速操作</th>
			</tr>
			</thead>
			<tbody>
			<?php if(!empty($order)): if(is_array($order) || $order instanceof \think\Collection || $order instanceof \think\Paginator): if( count($order)==0 ) : echo "" ;else: foreach($order as $key=>$vo): ?>
				<tr style="background-color: <?php echo $vo['food_type']==2?'#E74C3C':''; ?>;color: <?php echo $vo['food_type']==2?'#fff':''; ?> " >
					<td><?php echo $vo['order_id']; ?></td>
					<td><?php echo date('Y-m-d H:i:s',$vo['order_time']); ?></td>
					<td><?php echo $vo['name']; ?></td>
					<td><?php echo $vo['tb_id']; ?></td>
					<td>
						<?php if(($vo['food_type']==2)): ?>
							<span class="btn"><?php echo $food_type[$vo['food_type']]; ?></span>
							<?php else: ?>
							<a href="<?php echo url('kitchen/menu',['id'=>$vo['order_id']]); ?>"  class="btn btn-success">点击出菜</a>
						<?php endif; ?>

					</td>
				</tr>
			<?php endforeach; endif; else: echo "" ;endif; endif; ?>
			</tbody>
		</table>
	</form>
	<div class="col-xs-12"  style="text-align:center">
		<ul class="pagination"><?php echo (isset($page) && ($page !== '')?$page:''); ?></ul>
	</div>
</div>
<form action="<?php echo url('admin/kitchen/menu'); ?>" method="post" style="position: fixed;right: 0;bottom: 0;">
	<input type="text" name="id" id="Scavenger" class="form-control">
</form>
<div><script src="__STATIC__/js/admin.js"></script></div>
<script>
    $('#Scavenger_take').click(function () {
        $(this).css('background-color','#32e744');
        $('#Scavenger').focus();
    });
    $('#Scavenger').blur(function () {
        $('#Scavenger_take').css('background-color','#E74C3C');
    })
</script>
</body>
</html>