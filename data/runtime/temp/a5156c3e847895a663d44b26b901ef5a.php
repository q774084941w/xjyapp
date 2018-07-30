<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:48:"themes/admin_simpleboot3/admin\seller\index.html";i:1524193037;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
	<style type="text/css">
		a{
			text-decoration:none;
		}
	</style>
</head>
<body>
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="<?php echo url('Seller/index'); ?>">商家列表</a></li>
			<li><a href="<?php echo url('Seller/sellerAdd'); ?>">商家添加</a></li>
		</ul>
		<form class="well form-inline margin-top-20" method="post" action="<?php echo url('admin/seller/index'); ?>">
	        用户ID：
	        <input class="form-control" type="text" name="uid" style="width: 200px;" value="<?php echo input('request.uid'); ?>"
	               placeholder="请输入商家ID">
	        商家名：
	        <input class="form-control" type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>"
	               placeholder="商家姓名">
	        <input type="submit" class="btn btn-primary" value="搜索"/>
	        <a class="btn btn-danger" href="<?php echo url('admin/seller/index'); ?>">清空</a>
	    </form>
		<form method="post" class="margin-top-20">
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th width="5%">ID</th>
						<th width="10">用户名</th>
						<th width="10">用户昵称</th>
						<th width="10%" align="left">商家名称</th>
						<th width="5%" align="left">商家类型</th>
						<th width="5%" align="left">运营状态</th>
						<th width="5%" align="left">起送金额</th>
						<th width="5%" align="left">菜单</th>
						<th width="10%">电话</th>
						<th width="10%">运营时间</th>
						<th width="10%">注册时间</th>
						<th width="15%">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php $seller_type_name=array('0'=>'外卖+点餐','1'=>'点餐','2'=>'外卖');
						$seller_status_type=array('0'=>'禁用','1'=>'正常','2'=>'未验证');
						$a=0;
					 if(is_array($seller) || $seller instanceof \think\Collection || $seller instanceof \think\Paginator): if( count($seller)==0 ) : echo "" ;else: foreach($seller as $key=>$vo): ?>
						<tr>
							<td><?php echo $vo['id']; ?></td>
							<td><?php echo $user[$a]['user_login']; ?></td>
							<td><?php echo !empty($user[$a]['user_nickname'])?$user[$a]['user_nickname']:'未填写'; ?></td>
							<?php $a++; ?>
							<td><a style="text-decoration:none;" href="<?php echo url('Seller/sellerDetailed',array('id'=>$vo['id'])); ?>"><?php echo $vo['seller_nickname']; ?></a></td>
							<td><?php echo $seller_type_name[$vo['seller_type']]; ?></td>
							<td><?php echo $seller_status_type[$vo['seller_status']]; ?></td>
							<td><?php echo $vo['takeout_max']; ?>元</td>
							<td><a href="<?php echo url('Foodmenu/index',array('id'=>$vo['id'])); ?>">查看菜单</a></td>
							<td><?php echo $vo['seller_tel']; ?></td>
							<td><?php echo $vo['seller_time_start']; ?>至<?php echo $vo['seller_time_end']; ?></td>
							<td><?php echo date('Y-m-d H:i:s',$vo['create_time']); ?></td>
							<td>
								<a href="<?php echo url('Seller/sellerEdit',array('id'=>$vo['id'])); ?>">编辑</a>
								<a href="<?php echo url('Seller/password',array('id'=>$vo['id'])); ?>">密码</a>
								<?php if($vo['seller_type'] != 1): ?> <a href="<?php echo url('Seller/sellerEdit',array('id'=>$vo['id'])); ?>">配送</a><?php endif; if($vo['seller_type'] != 2): ?> <a href="<?php echo url('Seller/sellerTable',array('id'=>$vo['id'])); ?>">餐桌</a><?php endif; ?>
								<a class="js-ajax-delete" href="<?php echo url('Seller/sellerDel',array('id'=>$vo['id'])); ?>">删除</a>
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