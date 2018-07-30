<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:52:"themes/admin_simpleboot3/admin\traffic\purchase.html";i:1529057883;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
		<ul class="nav nav-tabs">
			<li class="active"><a href="">采购列表</a></li>
			<li><a href="<?php echo url('admin/traffic/purchaseAddIndex'); ?>">添加采购</a></li>
		</ul>
		<form class="well form-inline margin-top-20" method="post" action="<?php echo url('admin/traffic/purchase'); ?>">
			<div class="form-inline">
				<div class="form-group cy-mar-ver-s">
					<?php if(!(empty($category) || (($category instanceof \think\Collection || $category instanceof \think\Paginator ) && $category->isEmpty()))): ?>
						<select name="category"  class="form-control">
							<option value="">分类查找</option>
							<?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): if( count($category)==0 ) : echo "" ;else: foreach($category as $key=>$vo): ?>
								<option value="<?php echo $vo['id']; ?>" <?php if(input('request.category') == $vo['id']): ?>selected<?php endif; ?>><?php echo $vo['name']; ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					<?php endif; ?>
					<input class="form-control" type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>" placeholder="名称/拼音">
					<span class="cy-pad-hor-s">时间</span>
				</div>
				<div class="input-daterange input-group" id="datepicker">
					<input type="text" class="js-bootstrap-date form-control" name="beginTime" id="qBeginTime" value="<?php echo input('request.beginTime'); ?>" />
					<span class="input-group-addon">至</span>
					<input type="text" class="js-bootstrap-date form-control" name="endTime" id="qEndTime"  value="<?php echo input('request.endTime'); ?>"/>
				</div>
				<div class="form-group cy-mar-ver-s">
					<input type="submit" class="btn btn-success" value="搜索" />
				</div>
			</div>
		</form>
		<form method="post" class="margin-top-20 ">
			<table class="table table-hover table-bordered">
				<thead>
				<tr>
					<th width="5%">排号</th>
					<th width="8%" align="left">货品名称</th>
					<th width="8%" align="left">分类</th>
					<th width="8%">进货价</th>
					<th width="8%">添加时间</th>
					<th width="10%">备注</th>
					<th width="8%">数量</th>
					<th width="8%">总价</th>
					<th width="8%">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php if(!empty($data)): if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>
						<tr>
							<td><?php echo $key+1; ?></td>
							<td><?php echo $vo['name']; ?></td>
							<td><?php echo $vo['category_name']; ?></td>
							<td><?php echo $vo['buy_price']; ?></td>
							<td><?php echo date('Y-m-d H:i:s',$vo['add_time']); ?></td>
							<td><?php echo $vo['remark']; ?></td>
							<td><?php echo $vo['stock']; ?></td>
							<td><?php echo $vo['buy_price']*$vo['stock']; ?></td>
							<td>
								<?php if(!empty($seller_id)): ?>
									<a type="button" class="btn btn-link" href="<?php echo url('admin/traffic/purchaseEdit',array('tra_id'=>$vo['tra_id'])); ?>">修改</a>
									<a type="button" class="btn btn-link js-ajax-delete" href="<?php echo url('admin/traffic/trafficDel',array('tra_id'=>$vo['tra_id'],'type'=>9)); ?>">删除</a>
								<?php endif; ?>
								<button type="button" class="btn btn-link" name="add_goods">添加</button>
							</td>
							<input type="hidden" value="<?php echo $vo['tra_id']; ?>" name="tra_id">
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
	<!--添加商品弹窗-->
	<div class="modal fade"  id="addModal"
		 tabindex="-1"
		 role="dialog"
		 aria-labelledby="myModalLabel">

		<div class="modal-dialog"
			 role="document">

			<div class="modal-content">

				<div class="modal-header">

					<button type="button"
							class="close"
							data-dismiss="modal"
							aria-label="Close"><span
							aria-hidden="true">×</span></button>

					<h4 class="modal-title">添加</h4>

				</div>

				<form action="<?php echo url('admin/traffic/addGoods'); ?>" method="post" class="js-ajax-form">
					<input type="hidden" name="tra_id" id="tra_id">

					<div class="modal-body">
						<div class="form-group">

							<label for="txt_tra_num">添加数量</label>

							<input type="number"
								   name="tra_num"
								   class="form-control"
								   placeholder="添加数量" required>
						</div>

					</div>

					<div class="modal-footer">

						<button type="button"
								class="btn btn-default"  data-dismiss="modal">
							关闭</button>
						<button type="submit" class="btn btn-primary js-ajax-submit" ><span
								class="glyphicon glyphicon-floppy-disk"  aria-hidden="true"></span>添加</button>
					</div>

				</form>


			</div>

		</div>

	</div>
	<!--添加商品弹窗-->
	<div><script src="__STATIC__/js/admin.js"></script></div>
	<script>
        $("[name='add_goods']").click(function () {
            $('#tra_id').val($(this).parent().next().val());
            $('#addModal').modal();
        });
	</script>
</body>
</html>