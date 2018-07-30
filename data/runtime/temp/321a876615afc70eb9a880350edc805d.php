<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:52:"themes/admin_simpleboot3/admin\order\printindex.html";i:1530243937;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
	<style>
		#explain{
			float: left;
			width: 100%;
		}
		#explain>li{
			list-style:none; /* 将默认的列表符号去掉 */
			padding:0; /* 将默认的内边距去掉 */
			margin:0; /* 将默认的外边距去掉 */
		}
	</style>
</head>
<body>
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#">销量排行榜</a></li>
		</ul>
		<form class="well form-inline margin-top-20" method="post" action="<?php echo url('admin/order/printindex'); ?>" id="thisForm">
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

					<input class="form-control" type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>"
						   placeholder="商品名/拼音
">
					收银人员：
					<select class="form-control" name="waiter" id="waiter">
						<?php switch($waiterType): case "1": ?>
								<option value="<?php echo $waiter['id']; ?>">
									<?php echo empty($waiter['user_nickname'])?$waiter['user_login']:$waiter['user_nickname']; ?>
								</option>
							<?php break; default: ?>
								<option value="">全部</option>
								<?php if(is_array($waiter) || $waiter instanceof \think\Collection || $waiter instanceof \think\Paginator): if( count($waiter)==0 ) : echo "" ;else: foreach($waiter as $key=>$vo): ?>
									<option value="<?php echo $vo['id']; ?>"  <?php if(input('request.waiter') == $vo['id']): ?> selected <?php endif; ?>  >
									<?php echo empty($vo['user_nickname'])?$vo['user_login']:$vo['user_nickname']; ?>
									</option>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</default>
						<?php endswitch; ?>
					</select>
					<span class="cy-pad-hor-s">时间</span>
				</div>
				<div class="input-daterange input-group" id="datepicker">
					<input type="text" class="js-bootstrap-date form-control" name="beginTime" id="qBeginTime" value="<?php echo input('request.beginTime'); ?>" />
					<span class="input-group-addon">至</span>
					<input type="text" class="js-bootstrap-date form-control" name="endTime" id="qEndTime"  value="<?php echo input('request.endTime'); ?>"/>
				</div>
				<div class="form-group cy-mar-ver-s">
					<input type="checkbox" value="1" name="today" style="display: none" id="today"  <?php if(input('request.today') == 1): ?> checked <?php endif; ?> >
					<label for="today">
						<div class=" <?php if(input('request.today') == 1): ?>btn btn-danger  <?php else: ?>btn btn-success <?php endif; ?>" type="button">今日</div>
					</label>
					<input type="submit" class="btn btn-success" value="搜索" />
					<a class="btn btn-danger" href="<?php echo url('admin/order/printindex'); ?>">清空</a>
					
				</div>




			</div>
		</form>

		<form method="post" class="margin-top-20 js-ajax-form">
			<table class="table table-hover table-bordered">
				<thead>
					<tr class="success">
						<th width="10%">排名</th>
						<th width="15%">名称</th>
						<th width="10%">拼音码</th>
						<th width="15%">数量</th>
						<th width="10%">单价</th>
						<th width="10%">金额</th>
					</tr>
				</thead>
				<tbody>
					<?php if(!(empty($data) || (($data instanceof \think\Collection || $data instanceof \think\Paginator ) && $data->isEmpty()))): if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>
							<tr>
								<td><?php echo $key+1; ?></td>
								<td><?php echo $vo['food_name']; ?></td>
								<td><?php echo $vo['pinyin']; ?></td>
								<td><?php echo $vo['food_number']; ?></td>
								<td><?php echo $vo['price']; ?></td>
								<td><?php echo $vo['price']*$vo['food_number']; ?></td>
							</tr>
						<?php endforeach; endif; else: echo "" ;endif; endif; ?>
				</tbody>
			</table>
		</form>
		<div class="col-xs-12"  style="text-align:center">
			<ul class="pagination"><?php echo $page; ?></ul>
		</div>
		<ul id="explain">
			<li>
				<span style="color: red">
					销量：<?php echo empty($allCount[0]['cont'])?0:$allCount[0]['cont']; ?> 单  &nbsp;</span>&nbsp;
				<span style="color: red">
					总销售额：<?php echo empty($allCount[0]['sum'])?0:$allCount[0]['sum']; ?> 元</span>
				<span style="float: right;margin-right: 30px" >
					<input type="submit" value="打印" class="btn btn-success" id="print_all">
				</span>
			</li>
		</ul>
	</div>
	<div><script src="__STATIC__/js/admin.js"></script></div>
	<script type="text/javascript" src="__STATIC__/js/bootbox/bootbox.min.js"></script>
	<script>
		$('#today').change(function () {
            thecolor();
        });
		function thecolor() {
            var type = $('#today').prop('checked');
            if(type){
                $('#today').next().children().eq(0).attr('class','btn btn-danger')
            }else {
                $('#today').next().children().eq(0).attr('class','btn btn-success')
            }
        }

		$('#print_all').click(function () {
			var myform = new FormData($('#thisForm')[0]);
			$.ajax({
			    type : 'post',
				url  : "<?php echo url('admin/order/printAllThing'); ?>",
				data : myform,
                cache: false,
				dataType 	: 'json',
				contentType : false,
				processData : false,
				success     : function (msg) {
					if(msg.code==1111){
                        bootbox.alert("打印成功")
					}else {
                        bootbox.alert(msg.sub_msg)
					}
                }
			})
        })

	</script>
</body>
</html>