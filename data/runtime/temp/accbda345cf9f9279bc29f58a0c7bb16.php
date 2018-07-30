<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"themes/admin_simpleboot3/admin\traffic\apply.html";i:1528967501;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
<style>
	#explain{
		float: left;
		width: 100%;
	}
	#explain>li>div{
		width: 20px;
		height: 20px;
		border: 1px solid black;
		float: left;
	}
	#explain>li>span{
		margin-left: 5px;
		float: left;
	}
	#explain>li{
		list-style:none; /* 将默认的列表符号去掉 */
		padding:0; /* 将默认的内边距去掉 */
		margin:0; /* 将默认的外边距去掉 */
	}
</style>
<head>
</head>
<body>
	<div class="wrap js-check-wrap">
		<?php 
			$result = array('未确认','配送中','完成','拒绝');
		 ?>
		<ul class="nav nav-tabs">
			<li class="active"><a href="<?php echo url('traffic/apply'); ?>">申请列表</a></li>
			<li><a href="<?php echo url('traffic/addapply'); ?>">填写申请</a></li>
		</ul>
		<form class="well form-inline margin-top-20 js-ajax-form" method="post" action="<?php echo url('admin/traffic/apply'); ?>">
			<div class="form-inline">
				<div class="form-group cy-mar-ver-s">
					<input class="form-control" type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>" placeholder="名称/拼音">
					<input class="form-control" type="text" name="user_nickname" style="width: 200px;" value="<?php echo input('request.user_nickname'); ?>" placeholder="申请人">
					<span class="cy-pad-hor-s">时间</span>
				</div>
				<div class="input-daterange input-group" id="datepicker">
					<input type="text" class="js-bootstrap-date form-control" name="beginTime" id="qBeginTime" value="<?php echo input('request.beginTime'); ?>" />
					<span class="input-group-addon">至</span>
					<input type="text" class="js-bootstrap-date form-control" name="endTime" id="qEndTime"  value="<?php echo input('request.endTime'); ?>"/>
				</div>
				<div class="form-group cy-mar-ver-s">
					<input type="submit" class="btn btn-success" value="搜索" />
					<a class="btn btn-danger" href="<?php echo url('traffic/apply'); ?>">清空</a>
				</div>
			</div>
		</form>
		<form method="post" class="margin-top-20">
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th width="5%">排号</th>
						<th width="8%" align="left">货品名称</th>
						<th width="5%" align="left">价格</th>
						<th width="5%">数量</th>
						<th width="8%" >总价</th>
						<th width="8%" >申请人</th>
						<th width="8%">申请时间</th>
						<th width="8%">结束时间</th>
						<th width="8%">备注</th>
						<th width="8%">状态</th>
						<th width="15%">操作</th>
					</tr>
				</thead>
				<tbody>
				<?php if(!empty($data)): if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>
						<tr>
							<td><?php echo $key+1; ?></td>
							<td><?php echo $vo['name']; ?></td>
							<td><?php echo $vo['ret_price']; ?></td>
							<td><?php echo $vo['tra_num']; ?></td>
							<td><?php echo $vo['all_price']; ?></td>
							<td>
								<?php if(empty($vo['user_nickname'])): ?>
									<?php echo $vo['user_login']; else: ?>
									<?php echo $vo['user_nickname']; endif; ?>

							</td>
							<td><?php echo date('Y-m-d H:i:s',$vo['start_time']); ?></td>
							<td><?php if(!empty($vo['end_time'])): ?><?php echo date('Y-m-d H:i:s',$vo['end_time']); else: ?>还未完成<?php endif; ?></td>
							<td><?php echo $vo['remark']; ?></td>
							<td><?php echo $result[$vo['result']]; ?></td>
							<td>
								<?php if(empty($seller_id)): switch($vo['result']): case "0": switch($Supermarket): case "1": ?>
												<a type="button" class="btn btn-link" href="<?php echo url('traffic/apply_result',array('re_id'=>$vo['re_id'],'result'=>1)); ?>">确认配送</a>
												<a type="button"class="btn btn-link js-ajax-delete" href="<?php echo url('traffic/apply_result',array('re_id'=>$vo['re_id'],'result'=>3)); ?>">拒绝</a>
											<?php break; default: ?>
												申请中
											</default>
										<?php endswitch; break; case "1": switch($Supermarket): case "1": ?>
												配送中
											<?php break; default: ?>
												<a type="button"class="btn btn-link js-ajax-delete" href="<?php echo url('traffic/apply_result',array('re_id'=>$vo['re_id'],'result'=>2)); ?>">接收完成</a>
											</default>
										<?php endswitch; break; case "2": ?>
										已完成
									<?php break; case "3": ?>
										已拒绝
									<?php break; default: ?>
										数据错误，请联系管理员
									</default>
								<?php endswitch; else: ?>
									<switch name="Supermarket">
										<?php switch($vo['result']): case "0": ?>
											<a type="button" class="btn btn-link js-ajax-dialog-btn"  data-msg="确定配送？" href="<?php echo url('traffic/apply_result',array('re_id'=>$vo['re_id'],'result'=>1)); ?>">确认配送</a>
											<a type="button"class="btn btn-link js-ajax-delete" href="<?php echo url('traffic/apply_result',array('re_id'=>$vo['re_id'],'result'=>3)); ?>">拒绝</a>
											<?php break; case "1": ?>
											<a type="button"class="btn btn-link js-ajax-delete" href="<?php echo url('traffic/apply_result',array('re_id'=>$vo['re_id'],'result'=>2)); ?>">接收完成</a>
											<?php break; case "2": ?>
												已完成
											<?php break; case "3": ?>
												已拒绝
											<?php break; default: ?>
												数据错误，请联系管理员
											</default>
									<?php endswitch; endif; ?>
							</td>
						</tr>
					<?php endforeach; endif; else: echo "" ;endif; endif; ?>
				</tbody>
			</table>
		</form>
		<div class="col-xs-12"  style="text-align:center">
			<ul class="pagination"><?php if(!empty($page)): ?>
				<?php echo (isset($page) && ($page !== '')?$page:''); endif; ?></ul>
		</div>

	</div>
	<div><script src="__STATIC__/js/admin.js"></script></div>
</body>
</html>