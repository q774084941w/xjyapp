<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"themes/admin_simpleboot3/admin\cashier\index.html";i:1530251171;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
	<style>
	 	.modal-body>table>tbody>tr>th{
			text-align: center;
		}
		.modal-body>table>tbody>tr>td{
			 text-align: center;
		 }
	   a{
	   	text-decoration:none;
	   }
	   .list-group-item{
	   	border: 1px solid #ccc;
	   }
		.list-group .active,
		.list-group-item:hover{
			background:#2C3E50;
			color: #fff;
			border-color: #2C3E50;
			/*border-top-color: #eee;*/
		}
		.list-group .active a,
		.list-group-item:hover a{
			color: #fff;
		}
		.list-group-item a{
			color: #2C3E50;
			letter-spacing: 5px;
			text-decoration:none;
		}
		.Status-display{
			color: #fff;
			float: left;
		    line-height: 35px;
		    margin-left: 35px;
		}
		.Status-display font{
			padding: 0 5px;
			font-weight: 700;
			font-size: 18px;
		}
		.Status-display .idle font{
			color: #6EB452;
		}
		.Status-display .destine font{
			color: #E9AE62;
		}
		.Status-display .employ font{
			color: #8571b4;
		}
		.Status-display .disabled font{
			color: #D56EA6;
		}
		.Status-display .beconfirmed font{
			color: #36AF68;
		}
		.clear{
			clear: both;
		}
		.Table-list-li{
			height: 200px;margin: 20px;background: #6EB452;color: #fff;text-align: center;position: relative;border-radius: 5px;
		}
		.Table-list-li .Service-hall-name{
			margin-top: 15px;
		}
		.Table-list-li .Table-number{
			font-size: 26px;margin-top:25px;
		}
		.Table-list-li .contet-Table{
			position: absolute;bottom: 45px;width: 90%;
		}
		.Table-list-li .Table-type{
			position: absolute;bottom: 0px;width: 90%;text-align: right;padding-right: 10px;
		}
		.Table-list-li-destine{
			background: #E9AE62;
		}
		.Table-list-li-employ{
			background: #65B4AF;
		}
		.Table-list-li-disabled {
			background: #D56EA6;
		}
		.Table-list-li-beconfirmed {
			background: #36AF68;
		}
		.Table-type i{
			display: inline-block;width: 20px;height: 20px;background: url('__TMPL__/public/icon/number-people.svg'); vertical-align: middle;
		}
		.Table-type font{
			font-size: 16px; vertical-align: middle;
		}
		.Table-list-li .new-order-info{
			color: #E74C3C;
			font-size: 18px; 
			font-weight: 700;
		}
		.Table-list-li .order-bottom{
			border-radius: 3px;
		}
		.Table-list-li .mask{
			position: absolute;
		    width: 100%;
		    height: 100%;
		    left: 0;
		    top: 0;
		    opacity: 0.7;
		    background-color: black;
		    z-index: 99;
		    display: none;
		    border-radius: 5px;
		}
		.Table-list-li .mask a{
			position: absolute;
		    left: 35%;
		    top: 40%;
		    display: block;
	        text-decoration: none;
	        font-size: 16px;
		}
		.Table-list-li-destine:hover .mask{
			display: block;
		}
		.Table-list-li-destine:hover{
			cursor: pointer;
		}
		.Table-list-li:hover .mask{
			display: block;
		}
		.Table-list-li:hover{
			cursor: pointer;
		}
	</style>
</head>
<body>
	<div class=" js-check-wrap">
		<!--<ul class="nav nav-tabs">
			<li class="active"><a href="<?php echo url('Order/index'); ?>">收银列表</a></li>
			&lt;!&ndash; <li><a href="<?php echo url('Seller/sellerAdd'); ?>"><?php echo lang('ADMIN_SELLER_SELLERADD'); ?></a></li> &ndash;&gt;
		</ul>-->
		<?php 
			$pay 			= 	array('1'=>'未支付','2'=>'确认订单','3'=>'拒绝订单','4'=>'已支付','5'=>'未评价','6'=>'已评价');
			$order_complete = 	array('1'=>'未确认','2'=>'确认','3'=>'拒绝','4'=>'完成');
			$food_type      = 	array('0'=>'未出菜','1'=>'正在出菜','2'=>'已经全部出菜');
			$status_count   = 	array('1'=>'0','2'=>'0','3'=>'0','4'=>'0','5'=>'0'); // 餐桌状态 1:空闲;2:待确认;3:使用中;4:已经预定;5:停止使用;
		 ?>
		<div class="well form-inline" style="background-color: #495D70"><!--margin-top-20-->
			<form  method="post" action="<?php echo url('cashier/index'); ?>">
				<div style="float: left;">
					<input class="form-control" type="text" name="table" value="<?php echo input('request.table'); ?>" style="width: 150px" placeholder="输入桌号">
					<!-- <input class="form-control" type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>" placeholder="请输入订单ID"> -->
					<input type="submit" class="btn btn-success" value="搜索"/>
					<a class="btn btn-danger" href="<?php echo url('cashier/index'); ?>">清空</a>
				</div>
				<div class="Status-display .form-control">
					<a href="<?php echo url('cashier/index',array('menu_id'=>$menu_id,'type'=>1)); ?>"  class="btn <?php echo $type==1?'btn-success':'btn-default'; ?>">
						<span class="idle">空闲<font> <?php echo empty($all_table_type[1])?0:$all_table_type[1]; ?> </font>桌 ；</span>
					</a>
					<a href="<?php echo url('cashier/index',array('menu_id'=>$menu_id,'type'=>2)); ?>" class="btn <?php echo $type==2?'btn-success':'btn-default'; ?>">
						<span class="beconfirmed">待确认<font><?php echo empty($all_table_type[2])?0:$all_table_type[2]; ?></font>桌 ；</span>
					</a>

					<a href="<?php echo url('cashier/index',array('menu_id'=>$menu_id,'type'=>3)); ?>" class="btn <?php echo $type==3?'btn-success':'btn-default'; ?>">
						<span class="employ">使用 <font> <?php echo empty($all_table_type[3])?0:$all_table_type[3]; ?> </font> 桌 ；</span>
					</a>

					<a href="<?php echo url('cashier/index',array('menu_id'=>$menu_id,'type'=>4)); ?>" class="btn <?php echo $type==4?'btn-success':'btn-default'; ?>">
					<span class="destine">预定 <font> <?php echo empty($all_table_type[4])?0:$all_table_type[4]; ?>  </font> 桌 ；</span>
					</a>

					<a href="<?php echo url('cashier/index',array('menu_id'=>$menu_id,'type'=>5)); ?>" class="btn <?php echo $type==5?'btn-success':'btn-default'; ?>">
					<span class="disabled">停用 <font><?php echo empty($all_table_type[5])?0:$all_table_type[5]; ?> </font> 桌 ；</span>
					</a>
				</div>
				<!-- <button id="Scavenger_take" class="btn btn-danger" style="float: right" type="button">扫一扫查找</button> -->

				<div >

				</div>
				<div class="clear"></div>

			</form>
		</div>

		<ul class="col-md-1 list-group">

			<li class="list-group-item text-info <?php if($menu_id == ''): ?> active <?php endif; ?> " style="text-align: center;font-size: 16px">
				<a href="<?php echo url('cashier/index'); ?>" >全部</a>
			</li>
			<?php if(!empty($menu)): if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): ?>
					<li class="list-group-item text-info <?php if($menu_id == $vo['id']): ?> active <?php endif; ?>"  style="text-align: center;font-size: 16px"><a href="<?php echo url('cashier/index',['menu_id'=>$vo['id']]); ?>" ><?php echo $vo['name']; ?></a></li>
				<?php endforeach; endif; else: echo "" ;endif; endif; ?>
		</ul>

		<div class="col-md-11">
			<?php if(!empty($order)): if(is_array($order) || $order instanceof \think\Collection || $order instanceof \think\Paginator): if( count($order)==0 ) : echo "" ;else: foreach($order as $key=>$vo): ?>

				<div class="col-md-2 Table-list-li
				<?php if($vo['type'] == 2): ?> Table-list-li-beconfirmed
				<?php elseif($vo['type'] == 3): ?> Table-list-li-destine
				 <?php elseif($vo['type'] == 4): ?>Table-list-li-employ
				 <?php elseif($vo['type'] == 5): ?> Table-list-li-disabled
				 <?php else: ?> Table-list-li <?php endif; ?>"
					<?php if($vo['type']  ==  3): ?> name="my_table_all_thing"
						<?php elseif($vo['type'] == 1): ?> name="new_order" <?php endif; ?> >
					<h4 class="Service-hall-name"><?php echo $vo['name']; ?> 厅</h4>
					<div class="contet-Table">
						<h4 class="Table-number"> <?php echo $vo['tb_id']; ?> 号 <?php if($vo['type'] == 2): ?> <font class="new-order-info">新订单</font> <?php endif; ?></h4>
						<h3 class="status">
							<?php if($vo['type'] == 2): ?>
								<a class="btn btn-danger js-ajax-dialog-btn order-bottom" data-msg="确定确认该订单？" href="<?php echo url('Order/quick',array('order_id'=>$vo['order_id'],'order_complete'=>2)); ?>"> 确 认</a>
								<a class="btn btn-default js-ajax-dialog-btn order-bottom" data-msg="确定拒绝该订单？" href="<?php echo url('Order/quick',array('order_id'=>$vo['order_id'],'order_complete'=>3)); ?>"> 拒绝订单</a>
							<?php elseif($vo['type'] == 3): ?>
								使 用 中
							<?php elseif($vo['type'] == 4): ?>
								已 预 定
							<?php elseif($vo['type'] == 5): ?>
								停 止 使 用
							<?php else: ?>
								空  闲
							<?php endif; ?>
						</h3>
					</div>
					<p class="Table-type"><i> </i> <font><?php echo $vo['table_name']; ?></font></p>
					<?php switch($vo['type']): case "1": ?>
							<div class="mask">
								<a href="<?php echo url('admin/IsOrder/newOrder',array('table_id'=>$vo['id'])); ?>" title="开台"> 开台 </a>
							</div>
						<?php break; case "3": ?>
							<div class="mask">
								<a href="#" title="点击查看详细 / 结账"> 查看详细 / 结账 </a>
							</div>
						<?php break; default: ?>

						</default>
					<?php endswitch; ?>
				</div>
				<input type="hidden" value="<?php echo $vo['order_id']; ?>">
				<?php endforeach; endif; else: echo "" ;endif; endif; ?>
		</div>
		<div class="col-xs-12"  style="text-align:center">
			<?php if(!empty($page)): ?>
				<ul class="pagination"><?php echo (isset($page) && ($page !== '')?$page:''); ?></ul>
			<?php endif; ?>
		</div>

	</div>


	<!--详细页面-->
	<div class="modal fade"  id="myModal"
		 tabindex="-1"
		 role="dialog"
		 aria-labelledby="myModalLabel">

		<div class="modal-dialog"
			 role="document">

			<div class="modal-content" style="width:900px;">

				<div class="modal-header">

					<button type="button"
							class="close"
							data-dismiss="modal"
							aria-label="Close">
						<span
							aria-hidden="true" name="go_back_to">×</span>
					</button>

					<h4 class="modal-title" style="margin-top: 20px">

						<span id="menu_name" class="col-xs-2" name="details"></span>
						<span id="tb_id" class="col-xs-2" name="details"></span>
						<span id="nick_name" class="col-xs-3" name="details"></span>
						<span id="mobile" class="col-xs-3" name="details"></span>
						<span id="score" name="details"></span>
					</h4>

				</div>

				<form action="<?php echo url('admin/cashier/Settlement'); ?>" method="post" class="js-ajax-form">

					<input type="hidden" name="order[order_id]"  id="order_id">

					<div class="modal-body">

						<table class="table table-bordered " id="foodList" name="details">

						</table>
					</div>

					<div class="modal-footer">

						<span id="order_id_in" class="col-xs-4" name="details"></span>

						<span id="order_time" class="col-xs-4" name="details"></span>

						<div>

						</div>
						<span id="print_order" name="details">

							<a class="btn btn-danger js-ajax-dialog-btn " data-msg="确定打印订单？" href="<?php echo url('admin/order/Print',array('order_id'=>0,'Printrretue'=>true)); ?>">
								打印
							</a>

						</span>
						<span id="go_back_to_this_one">

							<button type="button" class="btn btn-default" id="changeOne">
							换台</button>

							<button type="button" class="btn btn-default" id="addOne" data-target="#thisModal" data-toggle="modal">
							加菜</button>

							<button type="button"  class="btn btn-primary" id="areYouSore">确认支付</button>
						</span>

					</div>
					<div class="modal fade" id="xg" tabindex="-1" role="dialog" aria-labelledby="xdlLabel">
						<div class="modal-dialog" role="document" >
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" name="go_back_to">
										<span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="xdLabel">
										&nbsp;
										<span style="color: red">
										请使用扫码机进行扫码或者读卡:
									</span>
									</h4>
								</div>
								<div class="modal-body">
									<input type="text" class="form-control" id="price" name="order[auth_code]" autofocus="autofocus" placeholder="现金请直接点击确认">
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary js-ajax-submit" >确认</button>
									<button type="button" class="btn btn-default" data-dismiss="modal" name="go_back_to">返回</button>
								</div>
							</div>
						</div>
					</div>
				</form>


			</div>

		</div>

	</div>
	<!--详细页面-->


	<!--所有菜单-->
	<div class="modal fade" id="thisModal" tabindex="-1" role="dialog" aria-labelledby="thisModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="thisModalLabel">菜品添加</h4>
					<form  class=" form-inline margin-top-20" id="seller_menu_form">

							<select name="menu_id" style="text-align: center" class="form-control" id="menu_parent_id">
								<?php if(!(empty($menu) || (($menu instanceof \think\Collection || $menu instanceof \think\Paginator ) && $menu->isEmpty()))): ?>
									<option value="">请选择服务厅</option>
									<?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): ?>
										<option value="<?php echo $vo['id']; ?>" ><?php echo $vo['name']; ?></option>
									<?php endforeach; endif; else: echo "" ;endif; else: ?>
									<option value="">你还未建立服务厅，请在分类建立！</option>
								<?php endif; ?>
							</select>
							<select name="child_id" style="text-align: center" class="form-control" id="menu_child_id">
								<option value="">请选择菜系</option>
							</select>
							<input class="form-control" type="text" name="menu_keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>"
								   placeholder="菜名/拼音">
						<button type="button" class="btn btn-success" id="submit_menu">搜索</button>
					</form>
				</div>
				<form action="<?php echo url('admin/cashier/addFood'); ?>" method="post">
					<input type="hidden" name="order_id" >
					<div class="modal-body" style="height: 600px;overflow-x: auto;">
						<table class="table table-bordered" id="seller_menu_table">

						</table>
					</div>
					<div class="modal-footer">
						<span style="float: left">
							备注：<span id="thisRemark"></span>
						</span>

						<button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
						<input type="submit" class="btn btn-primary" value="添加">
					</div>
				</form>

			</div>
		</div>
	</div>
	<!--所有菜单-->


	<!--换台-->
	<div class="modal fade"  id="changeOneModal"
		 tabindex="-1"
		 role="dialog"
		 aria-labelledby="myModalLabel">

		<div class="modal-dialog"
			 role="document"
		style="width: 90%">

			<div class="modal-content">

				<div class="modal-header">

					<button type="button"
							class="close"
							data-dismiss="modal"
							aria-label="Close"><span
							aria-hidden="true">×</span></button>

					<h4 class="modal-title">换台</h4>

				</div>

				<form action="<?php echo url('admin/rest/changeRest'); ?>" method="post" id="apply_form" class="js-ajax-form">
					<input type="hidden" name="order_id" >

					<div class="modal-body" style="height: 600px;overflow-x: auto">


						<ul class="col-md-1 list-group ">

							<li class="list-group-item text-info  active " style="text-align: center;font-size: 16px" name="rest_menu_id">
								<a href="javaScript:" >全部</a>
							</li>
							<?php if(!empty($menu)): if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): ?>
									<li class="list-group-item text-info "  menu_id="<?php echo $vo['id']; ?>"   style="text-align: center;font-size: 16px" name="rest_menu_id"><a href="javaScript:" ><?php echo $vo['name']; ?></a></li>
								<?php endforeach; endif; else: echo "" ;endif; endif; ?>
						</ul>

						<div class="col-md-11" id="rest_table_body">

						</div>
					</div>

					<div class="modal-footer">

						<button type="button"
								class="btn btn-default"  data-dismiss="modal">
							<span
								class="glyphicon glyphicon-remove"  aria-hidden="true"></span>
							关闭</button>
						<button type="submit"
								class="btn btn-primary  js-ajax-submit" >
								<span class="glyphicon glyphicon-floppy-disk"  aria-hidden="true">

								</span>
							确认
						</button>

					</div>

				</form>


			</div>

		</div>

	</div>
	<!--换台-->


	<!--扫码搜索-->
	<!--<form action="<?php echo url('cashier/search'); ?>" method="post" style="position: fixed;right: 0;bottom: 0;">
		<input type="text" name="id" id="Scavenger" class="form-control" value="">
	</form>-->
	<div><script src="__STATIC__/js/admin.js"></script></div>
	<script type="text/javascript" src="__STATIC__/js/bootbox/bootbox.min.js"></script>
	<script type="text/javascript" src="__TMPL__/public/assets/js/cashier.js"></script>
		<!--有php标签的-->
		<script>



			//换台餐桌信息
			function ajaxRest(menu_id)
			{
				$.post(
					"<?php echo url('admin/rest/findThem'); ?>",
					{'menu_id':menu_id},
					function (msg) {
						restToText(msg)
					},'json'
				)
			}


			//请求子集数据
			function ajaxChildren(parent_id)
			{
				$.post(
					"<?php echo url('foodmenu/getAllChild'); ?>",
					{'parent_id':parent_id},
					function (msg) {
						takeMenuChild(msg)
					},
					'json');
			}


			//详情弹窗
			function details(order_id,tb_id)
			{
				$('[name="details"]').empty();
				if(order_id!=null && order_id!=undefined && order_id!='')
				{
					$.post(
						"<?php echo url('admin/cashier/orderDetails'); ?>",
						{'order_id':order_id},
						function (msg) {
							cashierString(msg);
						},
						'json');
					$('#myModal').modal();
				}
				else
				{


				}

			}


			//结算添加
			$('#areYouSore').click(function ()
			{
				$(this).parent().css('display','none');
				$.post("<?php echo url('cashier/Payment'); ?>",
					{'allPrice':allprice},
					function (msg) {
					$('#foodList').append(msg);

					$('input[name="checkItem[]"]').each(function () {
						var val = $(this).parent().next().children().eq(0).val();

						$(this).val(val);
					})
				},'text');
			});


			// 验证密码
			function toPassword(a)
			{
				var toPassword = $(a);
				var type = toPassword.parent().prev().children().eq(0).val();
				if(type != null && type != undefined && type != '' ){
					var password = <?php echo lang('ADMIN_USER_PASSWORD'); ?>;
					bootbox.setLocale("zh_CN");
					bootbox.prompt("请输入权限密码", function (result) {
						if(result==password){
							toPassword.attr('class','btn btn-success');
							toPassword.next().val(1);
							bootbox.setLocale("zh_CN");
							bootbox.alert('验证通过，密码正确')
						}else{
							if(result!=null && result!=undefined && result!=''){
								bootbox.setLocale("zh_CN");
								bootbox.alert('密码不正确')
							}
						}

					});
				}
			}


			$(document).ready(function ()
			{
				<?php if(!(empty($begin_order_id) || (($begin_order_id instanceof \think\Collection || $begin_order_id instanceof \think\Paginator ) && $begin_order_id->isEmpty()))): ?>
				var order_id = "<?php echo $begin_order_id; ?>";
				details(order_id);
				<?php endif; ?>
			});


			//获取菜单信息
			function ajaxToGet(formdata)
			{
				$.ajax({
						url		: "<?php echo url('SellerMenu/index'); ?>",
						type	: 'post',
						processData : false,
						contentType : false,
						dataType    :  'json',
						data		:   formdata,
						success 	:  function (msg) {
							seller_menu_table(msg);
							initTableCheckbox2();
							checkboxVal(msg);
						}
					}
				)
			}


	</script>
	</body>
</html>