<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:54:"themes/admin_simpleboot3/admin\seller\withdrawals.html";i:1527739568;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
	<div class="well margin-top-20" style="height:280px">
			<div class="col-md-4">
				<div class="panel panel-info">
					<div class="panel-heading">
						账户余额： <span style="float: right"><?php echo date('Y-m-d h:i:s'); ?></span>
					</div>
					<div class="panel-body">
						<div class="media" style="text-align: center;line-height: inherit">
							<h4 class="media-heading">
						<span class="glyphicon glyphicon-jpy" aria-hidden="true" style="color: red">
							<?php if(!empty($seller['user_RMB'])&&!empty($seller['Alipay_RMB'])): ?>
								<?php echo $seller['user_RMB']+$seller['Alipay_RMB']; else: ?>
								0
							<?php endif; ?>
							元
						</span>
							</h4>
						</div>
					</div>
					<div class="panel-body">
						<table class="table table-striped" style="color:blue;">
							<tr>
								<th>微信：</th>
								<td>
									<?php echo empty($seller['user_RMB']) ? 0 : $seller['user_RMB']; ?>
									元
								</td>
								<th>支付宝：</th>
								<td>
									<?php echo empty($seller['Alipay_RMB']) ? 0 : $seller['Alipay_RMB']; ?>
									元
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
	</div>

	<div class="wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="<?php echo url('seller/withdrawals'); ?>">微信提现</a></li>
			<li><a href="<?php echo url('seller/alipayCash'); ?>">支付宝提现</a></li>
		</ul>
		<form class="form-horizontal js-ajax-form margin-top-20"method="post" action="<?php echo url('admin/seller/withdrawalsEditPost'); ?>">
			<div class="col-md-offset-2 col-sm-4">	
				<div class="form-group">
					<label for="input-user-nickname" class="col-sm-3 control-label">收款人：</label>
					<div class="col-md-9 col-sm-9">
						<input type="text" class="form-control" name="seller_name" required value="<?php echo $seller['seller_name']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="input-birthday" class="col-sm-3 control-label">当前余额：</label>
					<div class="col-md-9 col-sm-9">
						<sapn class="form-control"><?php echo empty($seller['user_RMB']) ? 0 : $seller['user_RMB']; ?>元</sapn>
					</div>
				</div>
				<div class="form-group">
					<label for="input-user_url" class="col-sm-3 control-label">openid：</label>
					<div class="col-md-9 col-sm-9">
						<sapn class="form-control" id="openid"><?php echo $seller['seller_openid']; ?></sapn>
					</div>
				</div>
				<div class="form-group">
					<label for="input-user_url" class="col-sm-3 control-label">上次收款日期：</label>
					<div class="col-md-9 col-sm-9">
						<?php if(empty($seller['withdrawals_time']) || (($seller['withdrawals_time'] instanceof \think\Collection || $seller['withdrawals_time'] instanceof \think\Paginator ) && $seller['withdrawals_time']->isEmpty())): ?>
							<sapn class="form-control">从未提款</sapn>
						<?php else: ?>
							<sapn class="form-control"><?php echo date('Y-m-d H:i:s',$seller['withdrawals_time']); ?></sapn>
						<?php endif; ?>
					</div>
				</div>
			</div>	
			<div class="col-sm-5">
				<div class="col-sm-4">
					<img src="<?php echo cmf_get_image_preview_url('QR_code/seller-'.$seller['id'].'.png'); ?>" width="200" style="cursor: pointer" alt="没有二维码"/>
				</div>
				<div class="col-sm-5">
					<div class="alert alert-danger alert-dismissible fade in" role="alert">
				      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				      <h4>重要信息</h4>
				      <p>请正确填写收款人名字和openid！</p>
				      <p>openid获取方式：使用微信扫描左侧二维码获取；</p>
				      <p>单笔单日提款限额2W/2W；</p>
				      <p>不支持给非实名用户打款；</p>
				      <p>每次提款间隔不少于10天；</p>
				      <p>提现手续费：2.5%；</p>
				      <p>提现金额不少于100元；</p>
				      <p>扫描过后openid自动更新，请刷新该页面；</p>
				    </div>
				</div> 
			</div>
			<div class="col-sm-offset-4 col-sm-8">
				<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('EDIT'); ?></button>
				<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">提现</button>
			</div>
		</form>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title" id="myModalLabel"><b>提现详细</b></h4>
		      	</div>
		      	<div class="modal-body">
		        	<table class="table">
		        		<tr>
		        			<th width="100">提现金额：</td>
		        			<td><?php echo $seller['user_RMB']; ?>元</td>
		        		</tr>
		        		<tr>
		        			<th>手续费：</th>
		        			<td><?php echo round($seller['user_RMB']*0.025,2); ?>元</td>
		        		</tr>
		        		<tr>
		        			<th>实际到帐：</th>
		        			<td><?php echo $seller['user_RMB']-round($seller['user_RMB']*0.025,2); ?>元</td>
		        		</tr>
		        		<tr>
		        			<th>收款人：</th>
		        			<td><?php echo $seller['seller_name']; ?></td>
		        		</tr>
		        	</table>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
		        	<a type="button" href="<?php echo url('admin/seller/withdrawalsPost'); ?>" class="btn btn-danger js-ajax-dialog-btn" data-msg="提现间隔为10天<br>您确认要申请提现吗？">提交</a>
		      	</div>
		    	</div>
		  	</div>
		</div>
	</div>
	<script src="__STATIC__/js/admin.js"></script>
	<!--<script type="text/javascript">
		$(function(){
			function show()
			{
			   $.ajax({
		        url:'OpenidAjax',
		        type:'POST', //GET
		        async:true,    //或false,是否异步
		        data:{
		            Openid:'<?php echo $seller['seller_openid']; ?>',
		            seller_id:<?php echo $seller['id']; ?>
		        },
		        timeout:5000,    //超时时间
		        dataType:'html',    //返回的数据格式：json/xml/html/script/jsonp/text

		        success:function(data,textStatus,jqXHR){

		           if(data !== true)
		           {
		           		$("#openid").html(data)
		           }
		        },

		    	})
			}
			setInterval(show,5000);// 注意函数名没有引号和括弧！ 
		// 使用setInterval("show()",3000);会报“缺少对象” 
		});
	</script>-->
</body>
</html>