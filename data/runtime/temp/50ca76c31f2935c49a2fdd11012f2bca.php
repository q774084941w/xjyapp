<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:50:"themes/admin_simpleboot3/admin\foodmenu\index.html";i:1530186293;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#">菜单信息</a></li>
			<li><a href="<?php echo url('foodmenu/menuAdd',array('id'=>$seller['id'])); ?>">菜品添加</a></li>

		</ul>
		<!-- <form class="well form-inline margin-top-20">
			<table class="table table-hover table-bordered" style="width: 50%;font-size: 25px">
				<tr>
					<th rowspan="4" style="width: 20%">
		      			<img src="<?php if(empty($seller['seller_logo'])): ?>__TMPL__/public/assets/images/default-thumbnail.png<?php else: ?><?php echo cmf_get_image_preview_url($seller['seller_logo']); endif; ?>" width="150"/></th>
					<td>商家ID：<?php echo $seller['id']; ?></td>
				</tr>
				<tr>
					<td>名字：<?php echo $seller['seller_nickname']; ?></td>						
				</tr>
				<tr>
					<?php $seller_type_name=array('0'=>'外卖+点餐','1'=>'点餐','2'=>'外卖'); ?>
					<td>类型：<?php echo $seller_type_name[$seller['seller_type']]; ?></td>
				</tr>
			</table>	
    	</form> -->
		<form class="well form-inline margin-top-20" method="get" action="<?php echo url('foodmenu/index'); ?>">

			<div class="form-inline">
				<div class="form-group cy-mar-ver-s">
					<select name="menu" style="text-align: center" class="form-control" id="menu_parent_id">
						<?php if(!empty($menu[0])): ?>
							<option value="">请选择服务厅</option>
							<?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): if($vo['parent_id'] == 0): if(!empty($pid)): ?>
										<option value="<?php echo $vo['id']; ?>" <?php echo $pid==$vo['id'] ? 'selected' : ''; ?>>
										<?php else: ?>
										<option value="<?php echo $vo['id']; ?>">
									<?php endif; ?>
									<?php echo $vo['name']; ?>
									</option>
								<?php endif; endforeach; endif; else: echo "" ;endif; else: ?>
							<option value="">请在分类建立</option>
						<?php endif; ?>
					</select>
					<select name="menu_id" style="text-align: center" class="form-control" id="menu_child_id">
						<option value="">请选择菜系</option>
					</select>

					<input class="form-control" type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>" placeholder="名称/拼音">

				</div>
				<div class="input-daterange input-group" id="datepicker">

				</div>
				<div class="form-group cy-mar-ver-s">
					<input type="submit" class="btn btn-success" value="搜索"/>
					<a class="btn btn-danger" href="<?php echo url('foodmenu/index'); ?>">清空</a>
				</div>
			</div>



		</form>
    	</div>
    	<div style="align:center">
    		<?php $food_exhaust=array('2'=>'充足','1'=>'告罄'); if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>
    			<div class="col-md-6 margin-top-10"  style="margin:0 auto">
			    	<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<td rowspan="2" width="10%">
									<img src="<?php if(empty($vo['food_icon'])): ?>__TMPL__/public/assets/images/default-thumbnail.png<?php else: ?><?php echo cmf_get_image_preview_url($vo['food_icon']); endif; ?>" width="70" height="70">
								</td>
								<td width="20%">名称：<?php echo $vo['food_name']; ?></td>
								<td width="20%">归属：<?php echo $vo['name']; ?></td>
								<td width="20%">评价：<?php echo $vo['food_evaluate']; ?>
									<!--<a href="">查看</a>-->
								</td>
								<td width="10%">销量：<?php echo $vo['sales_volume']; ?></td>
								<td width="20%" style="text-align:center;width: 5%">
									<a href="<?php echo url('foodmenu/menuEdit',array('id'=>$vo['id'])); ?>">编辑</a>
								</td>
							</tr>
							<tr>
								<td>价格：<?php echo $vo['price']; ?></td>
								<td>优惠价格：<?php echo $vo['discount']; ?></td>
								<td>餐盒费：<?php echo $vo['lunch_box']; ?></td>
								<td>库存：<?php echo $food_exhaust[$vo['exhaust']]; ?></td>
								<td style="text-align:center">
									<a class="js-ajax-delete" data-msg="确定删除该菜品？" href="<?php echo url('foodmenu/foodmenuDel',array('id'=>$vo['id'])); ?>">删除</a>						
								</td>
							</tr>
						</thead>
			    	</table>
			    </div>
	    	<?php endforeach; endif; else: echo "" ;endif; ?>
	    	
    	</div>	
	</div>
	<div class="col-xs-12"  style="text-align:center">
		<ul class="pagination"><?php echo $page; ?></ul>
	</div>
	<div><script src="__STATIC__/js/admin.js"></script></div>
	<script>

		$(document).ready(function () {
            takeAndGet('#menu_parent_id');
        });

        // 二级请求
        $('#menu_parent_id').change(function () {
            takeAndGet(this);
        });

        function takeAndGet(a) {
            var parent_id 		= $(a).val();
            ajaxChildren(parent_id);
        }

        // 填写数据
        function takeMenuChild(msg) {
            var menu_child_id 	= $('#menu_child_id');
            menu_child_id.empty();
            menu_child_id.append("<option value=''>请选择菜系</option>");
            $(msg).each(function () {
                menu_child_id.append("<option value='"+this.id+"'>"+this.name+"</option>");
            })
        }
        //		请求子集数据
        function ajaxChildren(parent_id) {
            $.post(
                "<?php echo url('foodmenu/getAllChild'); ?>",
                {'parent_id':parent_id},
                function (msg) {
                    takeMenuChild(msg)
                },
                'json');
        }
	</script>
</body>
</html>