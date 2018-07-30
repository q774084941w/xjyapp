<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:48:"themes/admin_simpleboot3/admin\kitchen\menu.html";i:1530186423;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
<link rel="stylesheet" href="__TMPL__/public/assets/themes/flatadmin/bootstrap-switch.min.css">
<script src="__TMPL__/public/assets/js/bootstrap-switch.min.js"></script>
<style type="text/css">
	.pic-list li {
		margin-bottom: 5px;
	}
	#testTbl i{
		display: none;
	}
</style>
</head>
<body>
<div class="wrap js-check-wrap">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#">出菜订单列表</a></li>
	</ul>
		<div class="panel panel-default">
			<div class="panel-heading">订单详情：</div>
			<div class="panel-body" style="height:500px;overflow-y:scroll;">
				<table class="table table-bordered" id="testTbl">
					<?php $a=0; ?>
					<tr>
						<td width="40%">菜品</th>
						<td width="20%">数量</th>
						<td width="20%">操作</th>
					</tr>
					<?php if(!empty($food)): if(is_array($food) || $food instanceof \think\Collection || $food instanceof \think\Paginator): if( count($food)==0 ) : echo "" ;else: foreach($food as $key=>$vo): ?>
							<tr>
								<td><?php echo $data[$vo['id']]['food_name']; ?></td>
								<td>
									<input readonly class="form-control" type="text"  value="<?php echo $vo['nub']; ?>">
								</td>
								<td>
									<?php if(empty($vo['status']) || (($vo['status'] instanceof \think\Collection || $vo['status'] instanceof \think\Paginator ) && $vo['status']->isEmpty())): ?>
									
										<div class="switch switch-large" >
											<input type="checkbox" name="mycheck"/>
											<input type="hidden" value="<?php echo $order_id; ?>,<?php echo $vo['id']; ?>,<?php echo $vo['nub']; ?>">
										</div>
									<?php else: ?>
										<div class="switch switch-large" >
											<input type="checkbox" name="nocheck"/>
										</div>
									<?php endif; ?>

								</td>

							</tr>
						<?php endforeach; endif; else: echo "" ;endif; else: ?>
						<tr>
							<td colspan="4">没有点任何菜</td>
						</tr>
					<?php endif; ?>
				</table>
			</div>
			<div class="panel-footer">
				<a  class="btn btn-primary" href="javaScript:history.go(-1)">
					<!-- <?php echo url('admin/kitchen/index'); ?> -->
					返回
				</a>
			<!--	<button id="oneKey">一键出菜</button>-->
			</div>
		</div>

</div>

	<script>
		$('[name="nocheck"]').bootstrapSwitch({
            onText:"未出菜",
            offText:"已出菜",
            onColor:"info",
            offColor:"success",
            size:"large",
            handleWidth: '200px',
            disabled : true,
            inverse: true
		});
		/**滑动按钮**/
        $('[name="mycheck"]').bootstrapSwitch({
            onText:"已出菜",
			offText:"未出菜",
			onColor:"success",
			offColor:"info",
			size:"large",
            handleWidth: '200px',
            disabled : false,
			onSwitchChange:function(event,state){
                if(state==true){
                    var id = $(this).parent().parent().next().val();
                    var func = $(this);
            
					confirm(change,id,func);
				}else{
					$(this).val("2");
				}
			}
        });
        /*更改状态*/
		function change(id) {
			var food_conuts = '<?php echo $food_conuts; ?>';
			$.post("<?php echo url('kitchen/changeType'); ?>",
				{'id':id,'food_conuts':food_conuts},
				function (msg) {
					if(msg==1111){
						window.history.back(-1);
					}
                }, 'text');
			return true;
        }

        /**
         * 重写确认框 fun:函数对象 params:参数列表， 可以是数组
         */
        function confirm(fun, params,func) {
            if ($("#myConfirm").length > 0) {
                $("#myConfirm").remove();
            }
            var html = "<div class='modal fade' id='myConfirm' >"
                + "<div class='modal-backdrop in' style='opacity:0; '></div>"
                + "<div class='modal-dialog' style='z-index:2901; margin-top:60px; width:400px; '>"
                + "<div class='modal-content'>"
                + "<div class='modal-header'  style='font-size:16px; '>"
                + "<span class='glyphicon glyphicon-envelope'>&nbsp;</span>信息！<button type='button' class='close' data-dismiss='modal'>"
                + "<span style='font-size:20px;  ' class='glyphicon glyphicon-remove'></span><tton></div>"
                + "<div class='modal-body text-center' id='myConfirmContent' style='font-size:18px; '>"
                + "确定出菜"
                + "</div>"
                + "<div class='modal-footer ' style=''>"
                + "<button class='btn btn-danger ' id='confirmOk' >确定<tton>"
                + "<button class='btn btn-info ' data-dismiss='modal' id='confirmNo'>取消<tton>"
                + "</div>" + "</div></div></div>";
            $("body").append(html);

            $("#myConfirm").modal("show");

            $("#confirmOk").on("click", function() {
                $("#myConfirm").modal("hide");
                 fun(params); // 执行函数
				func.bootstrapSwitch('disabled',true);
            });
            $("#confirmNo").on("click", function() {
				func.bootstrapSwitch('toggleState');
            });
			$(".close").on("click", function() {
				func.bootstrapSwitch('toggleState');
            });
        }
	</script>
</body>
</html>