<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:54:"themes/admin_simpleboot3/admin\order\reserveorder.html";i:1530167009;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
</head>
<body>
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#">预约订单</a></li>
			<!-- <li><a href="<?php echo url('Seller/sellerAdd'); ?>"><?php echo lang('ADMIN_SELLER_SELLERADD'); ?></a></li> -->
		</ul>
		<?php 
			$order_complete = array('1'=>'未确认','2'=>'确认','3'=>'拒绝','4'=>'完成');
		 ?>
		<form class="well form-inline margin-top-20" method="post" action="<?php echo url('admin/order/reserveOrder'); ?>">	                         
            <select class="form-control" name="order_complete" id="more-template-select">
        		<option value="">订单状态</option>
	        	<?php if(is_array($order_complete) || $order_complete instanceof \think\Collection || $order_complete instanceof \think\Paginator): if( count($order_complete)==0 ) : echo "" ;else: foreach($order_complete as $key=>$vo): ?>
					<option value="<?php echo $key; ?>" <?php if(input('request.order_complete') == $key): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
	        	<?php endforeach; endif; else: echo "" ;endif; ?>               
            </select>
            <input class="form-control js-bootstrap-date" type="text" name="time" value="<?php echo input('request.time'); ?>" style="width: 7%" placeholder="订单日期">
	        <input class="form-control" type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>"
	               placeholder="请输入订单ID/商家ID">
	        <input type="submit" class="btn btn-success" value="搜索"/>
	        <a class="btn btn-danger" href="<?php echo url('admin/order/reserveOrder'); ?>">清空</a>
	        <span style="float:right">
	        	<a class="btn btn-info" href="<?php echo url('admin/order/reserveOrder',array('order_complete'=>'1')); ?>">最新预约</a>
	        	<a class="btn btn-info" href="<?php echo url('admin/order/reserveOrder',array('order_complete'=>'2')); ?>">确认预约</a>
	        </span>
	    </form>
		<form method="post" class="margin-top-20">
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th width="10%">订单号</th>
						<th width="10%">预定人</th>
						<th width="10%">预留电话</th>
						<th width="10%" align="left">下单时间</th>
						<th width="10%" align="left">预定时间</th>
						<th width="10%" align="left">商家ID</th>
						<th width="5%">订单状态</th>
						<th width="10%">操作</th>
						<th width="15%">快速操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($order) || $order instanceof \think\Collection || $order instanceof \think\Paginator): if( count($order)==0 ) : echo "" ;else: foreach($order as $key=>$vo): ?>
						<tr>
							<td><?php echo $vo['order_id']; ?></td>
							<td><?php echo $vo['user_name']; ?></td>
							<td><?php echo $vo['tel']; ?></td>
							<td><?php echo date('Y-m-d H:i:s',$vo['order_time']); ?></td>
							<td><?php echo date('Y-m-d H:i:s',$vo['reserve_time']); ?></td>
							<td><?php echo $vo['seller_nickname']; ?></td>							
							<td><?php echo $order_complete[$vo['order_complete']]; ?></td>
							<td>
								<a type="button" class="btn btn-link" href="<?php echo url('reserve/Detailed',array('order_id'=>$vo['order_id'])); ?>">查看</a>
								<a type="button" class="btn btn-link" href="<?php echo url('reserve/Edit',array('order_id'=>$vo['order_id'])); ?>">修改</a>
								<?php if(cmf_get_current_admin_id() == 1): ?>
								<a type="button"class="btn btn-link js-ajax-delete" href="<?php echo url('Order/orderDel',array('order_id'=>$vo['order_id'])); ?>">删除</a>	
								<?php endif; ?>	
							</td>
							<td>
								<?php if($vo['order_complete'] != 3 and $vo['order_complete'] != 4): ?>
									<a type="button" class="btn btn-link js-ajax-dialog-btn" data-msg="确定订单将标记为完成！" href="<?php echo url('Order/reserve_quick',array('order_id'=>$vo['order_id'],'order_complete'=>4)); ?>">完成订单</a>
									<a type="button" class="btn btn-link js-ajax-dialog-btn" data-msg="确定拒绝该预约？" href="<?php echo url('Order/reserve_quick',array('order_id'=>$vo['order_id'],'order_complete'=>3)); ?>">拒绝预约</a>
									<?php if($vo['order_complete'] != 2): ?>
										<a type="button" class="btn btn-link js-ajax-dialog-btn" data-msg="确定已经查看该预约？" href="<?php echo url('Order/reserve_quick',array('order_id'=>$vo['order_id'],'order_complete'=>2)); ?>">确认预约</a>
									<?php endif; endif; ?>							
							</td>
						</tr>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
		</form>
		<div class="col-xs-12"  style="text-align:center">
			<ul class="pagination"><?php echo $page; ?></ul>
		</div>
	</div>
	<div><script src="__STATIC__/js/admin.js"></script></div>
</body>
</html>