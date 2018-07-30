<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:55:"themes/admin_simpleboot3/admin\order\orderdetailed.html";i:1530177626;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
<style type="text/css">
    .pic-list li {
        margin-bottom: 5px;
    }
    .table-bordered td font{
		font-weight: 700;
    }
</style>
</head>

<body>
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<?php if(empty($type) || (($type instanceof \think\Collection || $type instanceof \think\Paginator ) && $type->isEmpty())): ?>
				<li><a href="<?php echo url('Order/index'); ?>">订单列表</a></li>
			<?php endif; ?>
			<li class="active"><a href="#">订单详情</a></li>
		</ul>
		<form  method="post" class="form-horizontal js-ajax-form margin-top-20">
        <div class="row">
            <div class="col-md-9">
            	<table  class="table table-bordered">  
			        <tr>  
			            <td  rowspan="2" style="width: 135px;height: 135px;text-align: center;">
							<img src="<?php if(empty($seller['seller_logo'])): ?>__TMPL__/public/assets/images/default-thumbnail.png<?php else: ?><?php echo cmf_get_image_preview_url($seller['seller_logo']); endif; ?>"
                                         id="thumbnail-preview"
                                         width="135" style="cursor: pointer"/>
			            </td>  
			            <td style="width: 25%"><font>商家ID：</font><?php echo $seller['id']; ?> </td>  
			            <td style="width: 35%"><font>商家名称：</font><?php echo $seller['seller_nickname']; ?></td> 
			            <td style="width: 20%"><font>订单号：</font><?php echo $order['order_id']; ?></td>
			            <td style="width: 20%"><font>下单时间：</font><?php echo date('Y-m-d H:i:s',$order['order_time']); ?></td>  
			        </tr>

			        <tr>
			            <!--<td>2.1</td>-->  
			            <td><font>用户ID：</font> <?php if(!empty($user)): ?><?php echo $user['openid']; else: ?>未知用户<?php endif; ?></td>  
			            <td><font>用户名称：</font> <?php if(!empty($user)): ?><?php echo $user['nickname']; else: ?>未知用户<?php endif; ?></td>
			            <?php $order_pay=array('1'=>'未支付','2'=>'已确认','3'=>'已拒绝','4'=>'已支付','5'=>'未评价','6'=>'已评价');
							$order_complete = array('1'=>'未确认','2'=>'确认','3'=>'拒绝','4'=>'完成');
							$pay_class 	 = 	array('1'=>'支付宝','2'=>'微信','3'=>'银联','4'=>'现金','5'=>'vip卡');
			             ?> 
			            <td><font>订单状况：</font> <?php echo $order_complete[$order['order_complete']]; ?></td>
			            <td><font>支付状态：</font> <?php echo $order_pay[$order['pay']]; ?></td>   
			        </tr>  
			        <tr>  
			        	<?php $oreder_class=array('1'=>'餐桌订单','2'=>'外卖订单','3'=>'预约订单','4'=>'直接收银'); ?>
			        	<td colspan="1"><font>餐桌ID：</font> <?php echo $order['table_id']; ?></td> 
			        	<td colspan="1"><font>订单类型：</font> <?php echo $oreder_class[$order['order_class']]; ?></td> 
			            <td colspan="1"><font>配送方：</font> <?php if($order['order_class'] == 2): ?><?php echo $delivery['delivery_name']; else: ?>非外卖订单<?php endif; ?></td> 
			            <td colspan="1"><font>配送评分：</font> <?php if($order['order_class'] == 2): ?><?php echo $order['delivery_evaluate']; else: ?>非外卖订单<?php endif; ?></td>
			            <?php $order_delivery=array('1'=>'未接单','2'=>'配送中','3'=>'配送完成','4'=>'系统接单','5'=>'分配骑手','6'=>'骑手到店') ?>
			            <td colspan="1"><font>配送状态：</font> <?php if($order['order_class'] == 2): ?><?php echo $order_delivery[$order['order_delivery']]; else: ?>非外卖订单<?php endif; ?></td> 
			        </tr>
					<tr>
						<td><font>服务厅：</font> <?php echo $order['name']; ?></td>
						<td><font>餐桌类型：</font> <?php echo $order['table_name']; ?></td>
						<td><font>桌号：</font> 第<?php echo $order['tb_id']; ?>桌</td>
						<td><font>支付方式：</font> <?php echo $pay_class[$order['pay_class']]; ?></td>
					</tr>
					<tr>
						<td><font>优惠券金额：</font> ￥ <?php echo $order['coupon']; ?> 元</td>
						<td><font>折扣：</font> <?php echo $order['price_discount']; ?> 折</td>
						<td><font>应收金额：</font> ￥<?php echo $order['order_price']; ?> 元</td>
						<td><font>实际已收金额：</font> ￥<?php echo $order['price_receipts']; ?> 元</td>
					</tr>
			        <tr>  
			            <td colspan="3">
			            	<font>订单备注：</font>
			            	<div>
				            	<textarea readonly  style="width: 100%;height: 100px;resize: none;">&nbsp;&nbsp;&nbsp;&nbsp;<?php if(empty($order['remarks'])): ?>该订单没有备注<?php else: ?><?php echo $order['remarks']; endif; ?></textarea>
			            	</div>
			            </td>
						<td colspan="3">
							<font>用户评价：</font>
							<div>
								<textarea readonly  style="width: 100%;height: 100px;resize: none;">&nbsp;&nbsp;&nbsp;&nbsp;<?php if(empty($order['user_evaluate'])): ?>该用户尚未评价！<?php else: ?><?php echo $order['user_evaluate']; endif; ?></textarea>
							</div>
						</td>
					</tr>
			    </table> 
			    <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-9">
						<?php if(empty($type) || (($type instanceof \think\Collection || $type instanceof \think\Paginator ) && $type->isEmpty())): ?>
                        <a class="btn btn-default" href="<?php echo url('order/orderEdit',array('order_id'=>$order['order_id'])); ?>">修改</a>
						<?php endif; ?>
                        <input class="btn btn-info" type="button" value="后退" onclick="javascript:history.go(-1);">
                    </div>
                </div>             
            </div>
            <?php if(!empty($data)): ?>
            <div class="col-md-3">
            	<div class="panel panel-default">
			  		<div class="panel-heading">订单详情：</div>
				  	<div class="panel-body" style="height:400px;overflow-y:scroll;">
				    	<ul class="list-group">

				    		<?php $b=0; if(is_array($food) || $food instanceof \think\Collection || $food instanceof \think\Paginator): if( count($food)==0 ) : echo "" ;else: foreach($food as $key=>$vo): ?>
					  		<li class="list-group-item">
					    	<span class="col-md-2 badge"><span class="glyphicon glyphicon-yen" aria-hidden="true"><?php echo $data[$vo['id']]['price']*$vo['nub']; ?></span></span>
							<?php echo $data[$vo['id']]['food_name']; ?>
							<span class="">*<?php echo $vo['nub']; ?></span>
					  		</li>
					  		<p hidden><?php echo $b+=$data[$vo['id']]['price']*$vo['nub'];; ?> </p>
					  		<?php endforeach; endif; else: echo "" ;endif; ?>

						</ul>					
				  	</div>
				  	<div class="panel-footer">总金额：<span class="pull-right" style="margin-right: 50px"><?php echo $b; ?></span></div>
				</div>           	
            </div>
        	<?php endif; ?>
        </div>
    </form>
	</div>
	<script type="text/javascript" src="__STATIC__/js/admin.js"></script>
	<script type="text/javascript" src="__STATIC__/js/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" src="__STATIC__/js/ueditor/ueditor.all.min.js"></script>
</body>
</html>
