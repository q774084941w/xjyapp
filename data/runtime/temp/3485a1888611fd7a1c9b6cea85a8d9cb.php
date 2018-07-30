<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:50:"themes/admin_simpleboot3/admin\cashier\search.html";i:1528254061;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
<link rel="stylesheet" href="__TMPL__/public/assets/themes/font-pay/iconfont.css">
<link rel="stylesheet" href="__TMPL__/public/assets/themes/font-pay/demo.css">
<style type="text/css">
	.pic-list li {
		margin-bottom: 5px;
	}
</style>
</head>
<body>
<div class="wrap js-check-wrap">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#">订单支付</a></li>
	</ul>
	<?php if(!empty($order)): ?>
	<form action="<?php echo url('cashier/Settlement'); ?>" method="post" class="form-horizontal margin-top-20 js-ajax-form">
		<div class="row">
			<div class="col-md-9">
				<?php 
					$pay 			= 	array('1'=>'未支付','2'=>'确认订单','3'=>'拒绝订单','4'=>'已支付','5'=>'未评价','6'=>'已评价');
					$order_class 	= 	array('1'=>'餐桌订单','2'=>'外卖订单','3'=>'预约订单');
					$pay_class 	= 	array('1'=>'支付宝','2'=>'微信','3'=>'银联','4'=>'现金',5=>'vip卡');
					$order_complete = 	array('1'=>'未确认','2'=>'确认','3'=>'拒绝','4'=>'完成');
				 ?>
				<table  class="table table-bordered">

					<tr>
						<td style="width: 20%">订单号：
							<input readonly class="form-control" type="text" name="order[order_id]"
														  value="<?php echo $order['order_id']; ?>" placeholder="订单号不给于修改"/>
						</td>
						<td style="width: 25%">商家ID：<input readonly class="form-control" type="text"
														   value="<?php echo $order['seller_id']; ?>" placeholder="商家ID不给于修改"/></td>
						<td style="width: 25%">用户ID：<input readonly class="form-control" type="text"
														   value="<?php echo $order['user_id']; ?>" placeholder="用户ID不给于修改"/></td>
						<td style="width: 30%">下单时间：<input class="form-control js-bootstrap-datetime" type="text"
														   value="<?php echo date('Y-m-d H:i:s',$order['order_time']); ?>"></td>
					</tr>
					<tr>
						<td>订单类型：
							<select class="form-control" id="order_class" >
								<?php if($order['order_class'] != 4): if(is_array($order_class) || $order_class instanceof \think\Collection || $order_class instanceof \think\Paginator): if( count($order_class)==0 ) : echo "" ;else: foreach($order_class as $key=>$vo): ?>
										<option value="<?php echo $key; ?>" <?php if($order['order_class'] == $key): ?>selected<?php endif; ?> ><?php echo $vo; ?></option>
									<?php endforeach; endif; else: echo "" ;endif; else: ?>
										<option value="4" selected>直接付款</option>
								<?php endif; ?>
							</select>
						</td>
						<td>支付状态：
							<select class="form-control" >
								<?php if(is_array($pay) || $pay instanceof \think\Collection || $pay instanceof \think\Paginator): if( count($pay)==0 ) : echo "" ;else: foreach($pay as $key=>$vo): ?>
									<option value="<?php echo $key; ?>" <?php if($order['pay'] == $key): ?>selected<?php endif; ?> ><?php echo $vo; ?></option>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
						</td>
						<td>订单状况：
							<?php if(is_array($order_complete) || $order_complete instanceof \think\Collection || $order_complete instanceof \think\Paginator): if( count($order_complete)==0 ) : echo "" ;else: foreach($order_complete as $key=>$vo): ?>
								<input type="radio" value="<?php echo $key; ?>" <?php if($order['order_complete'] == $key): ?>checked<?php endif; ?> ><?php echo $vo; ?>&nbsp;
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</td>
						<?php if($order['order_class'] != 4): ?>
							<td>餐桌ID：<input class="form-control" type="text" value="<?php echo $order['table_id']; ?>"placeholder="没有使用就不填"></td>
							<?php else: ?>
								<td>订单价格：<input class="form-control" type="text"  value="<?php echo $order['order_price']; ?>"></td>
						<?php endif; ?>
						<!-- <td>优惠劵ID：<input class="form-control" type="text" name="order[coupon_id]" <?php if($order['coupon_id'] == 0): else: ?>value=""<?php endif; ?> placeholder="没有使用就不填"></td>  -->
					</tr>
					<?php if($order['order_class'] != 3): 
							$reserve['table_nub']=0;
							$reserve['reserve_time']=time();
							$reserve['complete']=1;
						 endif; ?>
					<tr id="reserve_s">
						<td colspan="1">预约桌数：<input class="form-control" type="text" value="<?php echo $reserve['table_nub']; ?>"  placeholder="预约桌数"></td>
						<td colspan="1">预约时间：<input class="form-control js-bootstrap-datetime" type="text"
													value="<?php echo date('Y-m-d H:i:s',$reserve['reserve_time']); ?>"></td>

						<td colspan="3">预约是否完成：

							<input type="radio" name="reserve[complete]" value="1" <?php if($reserve['complete'] == 1): ?>checked<?php endif; ?> >未确认
							&emsp;
							<input type="radio" name="reserve[complete]" value="2" <?php if($reserve['complete'] == 2): ?>checked<?php endif; ?> >完成
							&emsp;
							<input type="radio" name="reserve[complete]" value="3" <?php if($reserve['complete'] == 3): ?>checked<?php endif; ?> >商家违约
							&emsp;
							<input type="radio" name="reserve[complete]" value="4" <?php if($reserve['complete'] == 4): ?>checked<?php endif; ?> >用户违约
						</td>
					</tr>
					<tr id="reserve_a">
						<?php if($order['order_class'] == 3): ?>
							<td colspan="1">就餐人数：<input class="form-control" type="text" value="<?php echo $reserve['user_nub']; ?>"  placeholder="就餐人数"></td>
							<td colspan="1">预约电话：<input class="form-control" type="text" value="<?php echo $reserve['tel']; ?>"  placeholder="预约电话"></td>
							<td colspan="1">预约者名字：<input class="form-control" type="text" value="<?php echo $reserve['user_name']; ?>"  placeholder="预约者名字"></td>
							<td colspan="2">预约餐桌：
								<?php if(!empty($table)): ?>
								<select class="form-control" >
									<option value="">默认餐桌</option>

										<?php if(is_array($table) || $table instanceof \think\Collection || $table instanceof \think\Paginator): if( count($table)==0 ) : echo "" ;else: foreach($table as $key=>$vo): ?>
											<option value ="<?php echo $vo['id']; ?>" <?php if($reserve['reserve_class'] == $vo['id']): ?> selected = 'selected'<?php endif; ?>><?php echo $vo['table_name']; ?></option>
										<?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
										<?php else: ?>
								您还未加入任何餐桌！请去餐桌管理加入
									<?php endif; ?>

							</td>
							<?php else: ?>
								<td colspan="1">就餐人数：<input class="form-control" type="text" value=""  placeholder="就餐人数"></td>
								<td colspan="1">预约电话：<input class="form-control" type="text" value="" placeholder="预约电话"></td>
								<td colspan="1">预约者名字：<input class="form-control" type="text" value=""  placeholder="预约者名字"></td>
								<td colspan="2">预约餐桌：
									<?php if(!empty($table)): ?>
										<select class="form-control" >
											<option value="">默认餐桌</option>

											<?php if(is_array($table) || $table instanceof \think\Collection || $table instanceof \think\Paginator): if( count($table)==0 ) : echo "" ;else: foreach($table as $key=>$vo): ?>
												<option value ="<?php echo $vo['id']; ?>"><?php echo $vo['table_name']; ?></option>
											<?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										<?php else: ?>
										您还未加入任何餐桌！请去餐桌管理加入
									<?php endif; ?>
								</td>
						<?php endif; ?>
					</tr>
					<tr>
						<td colspan="5">用户评价：
							<div>
								<textarea  style="width: 100%;height: 100px;resize: none;"><?php if(empty($order['user_evaluate'])): ?>该用户尚未评价！<?php else: ?><?php echo $order['user_evaluate']; endif; ?></textarea>
							</div>
						</td>
					</tr>
</table>
<table class="table table-bordered">
					<tr>
						<td colspan="5">请选择支付方式：</td>
					</tr>
					<tr class="icon_lists clear" style="text-align: center">
						<td width="247px">
							<input type="radio" id="WeChat" name="order[pay_class]" value="2" style="display: none">
							<label for="WeChat">
								<i class="icon iconfont icon-weixinzhifu2" style="color: #14e90f" title="提示"
								   data-container="body" data-toggle="popover" data-placement="top"
								   data-content="该功能尚未完善"></i>
								<div class="name"  style="color: #14e90f"><?php echo $pay_class[2]; ?></div>
							</label>
						</td>

						<td width="247px">
							<input type="radio" id="Alipay" name="order[pay_class]" value="1" style="display: none">
							<label for="Alipay">
								<i class="icon iconfont icon-zhifubaozhifu" style="color: #3256e9" title="提示"
								   data-container="body" data-toggle="popover" data-placement="top"
								   data-content="该功能尚未完善"></i>
								<div class="name" style="color: #3256e9"><?php echo $pay_class[1]; ?></div>
							</label>
						</td>

						<td width="247px">
							<input type="radio" id="UnionPay" name="order[pay_class]" value="3" style="display: none">
							<label for="UnionPay">
								<i class="icon iconfont icon-ai-pay-copy" style="color: #49cde9" title="提示"
								   data-container="body" data-toggle="popover" data-placement="top"
								   data-content="该功能尚未完善"></i>
								<div class="name" style="color: #49cde9"><?php echo $pay_class[3]; ?></div>
							</label>
						</td>

						<td width="247px">
							<input type="radio" id="cash" name="order[pay_class]" value="4" style="display: none">
							<label for="cash">
								<i class="icon iconfont icon-xianjin" style="color: #e9484e;" ></i>
								<div class="name" style="color: #e9484e"><?php echo $pay_class[4]; ?></div>
							</label>
						</td>

						<td width="247px">
							<input type="radio" id="vipCard"  name="order[pay_class]" value="5" style="display: none">
							<label for="vipCard">
								<i class="icon iconfont icon-membership-card_icon" style="color: red"></i>
								<div class="name" style="color: red"><?php echo $pay_class[5]; ?></div>
							</label>
						</td>

					</tr>
				</table>
				<div class="form-group">
					<div class="col-sm-offset-6 col-sm-9">

						<button type="button" class="btn btn-primary js-ajax-submit" data-toggle="modal" data-target="#xg"  id="find">支付</button>
						<a class="btn btn-danger js-ajax-dialog-btn " data-msg="确定打印订单？" href="<?php echo url('admin/order/Print',array('order_id'=>$order['order_id'],'Printrretue'=>true)); ?>">打印订单</a>
						<!--<input type="submit" class="btn btn-default js-ajax-submit" value="支付">-->
						<a class="btn btn-default" href="<?php echo url('cashier/index'); ?>">返回</a>
					</div>
				</div>
			</div>

				<div class="col-md-3">
					<div class="panel panel-default">
						<div class="panel-heading">订单详情：</div>
						<div class="panel-body" style="height:400px;overflow-y:scroll;">
							<table class="table table-bordered" id="testTbl">
								<?php $a=0; ?>
								<tr>
									<td width="50%">菜品</th>
									<td width="20%">数量</th>
									<td width="20%">单价</th>
								</tr>
								<?php if(!empty($data)): if(is_array($food) || $food instanceof \think\Collection || $food instanceof \think\Paginator): if( count($food)==0 ) : echo "" ;else: foreach($food as $key=>$vo): ?>
									<tr>
										<td><?php echo $data[$a]['food_name']; ?></td>
										<td>
											<input class="form-control" type="text"  value="<?php echo $vo['nub']; ?>">
										</td>
										<td><input readonly class="form-control" type="text" value="<?php echo $data[$a++]['price']; ?>"></td>
									</tr>
								<?php endforeach; endif; else: echo "" ;endif; else: ?>
									<tr>
										<td colspan="4">您还没有点任何菜</td>
									</tr>
								<?php endif; ?>
							</table>
						</div>
						<div class="panel-footer">
							<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">-->
							<!--加菜-->
							<!--</button>-->
							总计：
							<input type="text" readonly class="btn btn-primary" id="Total" name="order[order_price]" value="<?php echo $order['order_price']; ?>">

						</div>
					</div>
				</div>

			<div class="modal fade" id="xg" tabindex="-1" role="dialog" aria-labelledby="xdlLabel">
				<div class="modal-dialog" role="document" >
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h2 class="modal-title" id="xdLabel">
								&nbsp;
								<span style="color: red">
									请使用扫码机进行扫码或者读卡:
								</span>
							</h2>
						</div>
						<div class="modal-body">
								<input type="text" class="form-control" id="price" name="order[auth_code]" autofocus="autofocus" placeholder="现金请直接点击确认">
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary js-ajax-submit" >确认</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
						</div>
					</div>
				</div>
			</div>
		</div>

	</form>

<?php endif; ?>
</div>
	<script>
		/*  支付方式选择*/
		$('[name="order[pay_class]"]').change(function () {
		    $(this).parent().parent().children().css('background-color','');
			$(this).parent().css('background-color','#e9e67e');
        });
        $('#xg').on('shown.bs.modal',function(e){
            $('#price').focus(); //通过ID找到对应输入框，让其获得焦点
        });
        $(function (){
            $("[data-toggle='popover']").popover();
        });
	</script>
</body>
</html>