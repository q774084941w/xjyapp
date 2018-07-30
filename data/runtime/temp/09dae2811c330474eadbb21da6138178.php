<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:47:"themes/admin_simpleboot3/admin\order\index.html";i:1530197451;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
	#Scavenger{
    	background: none;
	    border: none;
	    /* font-size: 0; */
	}
</style>
<head>
</head>
<body>
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="<?php echo url('Order/index'); ?>">订单列表</a></li>
			<!-- <li><a href="<?php echo url('Seller/sellerAdd'); ?>"><?php echo lang('ADMIN_SELLER_SELLERADD'); ?></a></li> -->
		</ul>
		<?php 
			$pay 			= 	array('1'=>'未支付','2'=>'确认订单','3'=>'拒绝订单','4'=>'已支付','5'=>'未评价','6'=>'已评价');
			$order_class 	= 	array('1'=>'餐桌订单','2'=>'外卖订单','4'=>'直接收银');
			$order_complete = 	array('1'=>'未确认','2'=>'确认','3'=>'拒绝','4'=>'完成');
			function payType($id,$it){
			switch ($id){
			case 1:
			$color = '';
			switch($it){
			case 1:
			$color = '';
			break;
			case 2:
			$color = '#e0f967';
			break;
			case 3:
			$color = '#eefeaf';
			break;
			default:
			$color = '#d0beb3';
			}
			break;
			case 2:
			$color='#d0beb3';
			break;
			case 3:
			$color='#e0f967';
			break;
			case 4:
			$color='#eefeaf';
			break;
			case 5:
			$color='#b3f2f2';
			break;
			default:
			$color='#cbebba';
			}
			return $color;
			}
		 ?>
		<form class="well form-inline margin-top-20" method="post" action="<?php echo url('admin/order/index'); ?>">
			<div class="form-inline">
				<div class="form-group cy-mar-ver-s">
					<select name="menu" style="text-align: center" class="form-control">
						<?php if(!empty($menu[0])): ?>
							<option value="">请选择服务厅</option>
							<?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): ?>
								<option value="<?php echo $vo['id']; ?>" <?php if(input('request.menu') == $vo['id']): ?> selected <?php endif; ?> ><?php echo $vo['name']; ?></option>
							<?php endforeach; endif; else: echo "" ;endif; else: ?>
							<option value="">你还未建立服务厅，请在分类建立！</option>
						<?php endif; ?>
					</select>
					<select class="form-control" name="order_class" id="more-template-select">
						<option value="">订单类型</option>
						<?php if(is_array($order_class) || $order_class instanceof \think\Collection || $order_class instanceof \think\Paginator): if( count($order_class)==0 ) : echo "" ;else: foreach($order_class as $key=>$vo): ?>
							<option value="<?php echo $key; ?>" <?php if(input('request.order_class') == $key): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					<select class="form-control" name="pay" id="more-template-select">
						<option value="">支付状态</option>
						<?php if(is_array($pay) || $pay instanceof \think\Collection || $pay instanceof \think\Paginator): if( count($pay)==0 ) : echo "" ;else: foreach($pay as $key=>$vo): ?>
							<option value="<?php echo $key; ?>" <?php if(input('request.pay') == $key): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					<select class="form-control" name="order_complete" id="more-template-select">
						<option value="">订单状态</option>
						<?php if(is_array($order_complete) || $order_complete instanceof \think\Collection || $order_complete instanceof \think\Paginator): if( count($order_complete)==0 ) : echo "" ;else: foreach($order_complete as $key=>$vo): ?>
							<option value="<?php echo $key; ?>" <?php if(input('request.order_complete') == $key): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</select>

					<input class="form-control" type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>"
						   placeholder="请输入订单ID/商家ID">
					<span class="cy-pad-hor-s">时间</span>
				</div>
				<div class="input-daterange input-group" id="datepicker">
					<input type="text" class="js-bootstrap-date form-control" name="beginTime" id="qBeginTime" value="<?php echo input('request.beginTime'); ?>" />
					<span class="input-group-addon">至</span>
					<input type="text" class="js-bootstrap-date form-control" name="endTime" id="qEndTime"  value="<?php echo input('request.endTime'); ?>"/>
				</div>
				<div class="form-group cy-mar-ver-s">
					<input type="submit" class="btn btn-success" value="搜索" />
					<a class="btn btn-danger" href="<?php echo url('admin/order/index'); ?>">清空</a>
				</div>
				<span style="float:right">
					<a class="btn btn-info" href="<?php echo url('admin/order/index',array('pay'=>'2','order_complete'=>'1')); ?>">最新订单</a>
					<a class="btn btn-info" href="<?php echo url('admin/order/index',array('pay'=>'2','order_complete'=>'2')); ?>">确认订单</a>
					<button id="Scavenger_take" class="btn btn-info" type="button">
					扫一扫查找
					</button>
				</span>
			</div>
	    </form>
		<form method="post" class="margin-top-20">
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th width="10%">订单号</th>
						<th width="5%" align="left">订单类型</th>
						<th width="10%" align="left">下单时间</th>
						<th width="5%">消费金额</th>
						<th width="10%" align="left">商家ID</th>
						<th width="5%">订单状态</th>
						<th width="5%">支付状态</th>
						<th width="10%">操作</th>
						<th width="15%">快速操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($order) || $order instanceof \think\Collection || $order instanceof \think\Paginator): if( count($order)==0 ) : echo "" ;else: foreach($order as $key=>$vo): ?>

						<tr style="background-color: <?php echo payType($vo['pay'],$vo['order_complete']); ?>">
							<td><?php echo $vo['order_id']; ?></td>
							<td><?php echo $order_class[$vo['order_class']]; ?></td>
							<td><?php echo date('Y-m-d H:i:s',$vo['order_time']); ?></td>
							<td><?php echo $vo['order_price']; ?>元</td>
							<td><?php echo $vo['seller_nickname']; ?></td>
							<td><?php echo $order_complete[$vo['order_complete']]; ?></td>
							<td><?php echo $pay[$vo['pay']]; ?></td>
							<td>
								<?php if(($vo['pay']==1) AND ($vo['order_complete']!=4)): ?>
									<a type="button" class="btn btn-link" href="<?php echo url('Order/orderEdit',array('order_id'=>$vo['order_id'])); ?>">修改</a>
								<?php endif; ?>
								<a type="button" class="btn btn-link" href="<?php echo url('Order/orderDetailed',array('order_id'=>$vo['order_id'])); ?>">查看</a>
								<?php if(cmf_get_current_admin_id() == 1): ?>
								<a type="button"class="btn btn-link js-ajax-delete" href="<?php echo url('Order/orderDel',array('order_id'=>$vo['order_id'])); ?>">删除</a>	
								<?php endif; ?>	
							</td>
							<td>
								<?php if($vo['order_complete'] != 3 and $vo['order_complete'] != 4): ?>
									<a type="button" class="btn btn-link js-ajax-dialog-btn" data-msg="确定订单将标记为完成！" href="<?php echo url('Order/quick',array('order_id'=>$vo['order_id'],'order_complete'=>4)); ?>">完成订单</a>
									<a type="button" class="btn btn-link js-ajax-dialog-btn" data-msg="确定拒绝该订单？" href="<?php echo url('Order/quick',array('order_id'=>$vo['order_id'],'order_complete'=>3)); ?>">拒绝订单</a>
									<?php if($vo['order_complete'] != 2): ?>
										<a type="button" class="btn btn-link js-ajax-dialog-btn" data-msg="确定确认该订单？" href="<?php echo url('Order/quick',array('order_id'=>$vo['order_id'],'order_complete'=>2)); ?>">确认订单</a>
									<?php endif; endif; if($vo['order_complete'] != 1): ?>
									<a type="button" class="btn btn-link js-ajax-dialog-btn" data-msg="确定打印订单？" href="<?php echo url('admin/order/Print',array('order_id'=>$vo['order_id'])); ?>">打印订单</a>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
		</form>
		<div class="col-xs-12"  style="text-align:center">
			<ul class="pagination"><?php echo $page; ?></ul>
		</div>

		<ul id="explain">
			<li><span> 未确认：</span><div style=""></div></li>
			<li><span> 确认：</span><div style="background-color: #e0f967"></div></li>
			<li><span> 拒绝：</span><div style="background-color: #eefeaf"></div></li>
			<li><span> 完成：</span><div style="background-color: #d0beb3"></div></li>
			<li><span> 未评价：</span><div style="background-color: #b3f2f2"></div></li>
			<li><span> 已评价：</span><div style="background-color: #cbebba"></div></li>

			<li style="float: right">
				<span style="color: red">销量：<?php echo empty($allCount[0]['cont'])?0:$allCount[0]['cont']; ?> 单 ； &nbsp;</span>&nbsp;
				<span style="color: red">总销售额：<?php echo empty($allCount[0]['sum'])?0:$allCount[0]['sum']; ?> 元</span></li>
		</ul>
	</div>
	<form action="<?php echo url('admin/order/index'); ?>" method="post" style="position: fixed;right: 0;bottom: 0;">
		<input type="text" name="keyword" id="Scavenger" class="form-control">
	</form>
	<div><script src="__STATIC__/js/admin.js"></script></div>
	<script>
        $('#Scavenger_take').click(function () {
            $(this).css('background-color','#32e744');
            $('#Scavenger').focus();
        });
        $('#Scavenger').blur(function () {
            $('#Scavenger_take').css('background-color','#3498DB');
        })
	</script>
</body>
</html>