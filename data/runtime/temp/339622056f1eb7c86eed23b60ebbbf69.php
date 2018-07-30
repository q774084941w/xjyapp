<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:55:"themes/admin_simpleboot3/admin\traffic\trafficedit.html";i:1529050816;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
<div class="wrap">
	<ul class="nav nav-tabs">
		<li><a href="<?php echo url('traffic/index'); ?>">商品管理</a></li>
		<li><a href="<?php echo url('traffic/trafficAdd'); ?>">添加商品</a></li>
		<li class="active"><a href="">修改商品</a></li>
	</ul>
	<form method="post" class="form-horizontal margin-top-20 js-ajax-form" action="<?php echo url('traffic/postEdit'); ?>">
		<input type="hidden" name="edit[tra_id]" value="<?php echo $tra_id; ?>">
		<input type="hidden" name="type" value="<?php echo $type; ?>">
		<div class="form-group">
			<label for="input-parent_id" class="col-sm-2 control-label"><span class="form-required">*</span>货品名称</label>
			<div class="col-md-6 col-sm-10">
				<input type="text" class="form-control" id="input-parent_id" name="edit[name]" value="<?php echo $name; ?>" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label"><span class="form-required">*</span>货品编号</label>
			<div class="col-md-6 col-sm-10">
				<input type="text" class="form-control"  name="edit[traffic_number]" placeholder="货品编号" value="<?php echo $traffic_number; ?>" required>
			</div>
		</div>
		<div class="form-group">
			<label for="input-pinyin" class="col-sm-2 control-label"><span class="form-required">*</span>拼音码</label>
			<div class="col-md-6 col-sm-10">
				<input type="text" class="form-control" id="input-pinyin" name="edit[pinyin]" value="<?php echo $pinyin; ?>" required>
			</div>
		</div>
		<div class="form-group">
			<label for="input-category_id" class="col-sm-2 control-label"><span class="form-required">*</span>分类</label>
			<div class="col-md-6 col-sm-10">
				<select class="form-control" name="edit[category_id]" id="input-category_id" required>
					<option value="0">- 请选择商品分类 -</option><?php echo $select_category; ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>数量</label>
			<div class="col-md-6 col-sm-10">
				<input type="hidden" name="old_stock" value="<?php echo $stock; ?>">
				<input type="number" class="form-control" id="input-name" name="edit[stock]" value="<?php echo $stock; ?>" required>
			</div>
		</div>
		<div class="form-group">
			<label for="input-key" class="col-sm-2 control-label"><span class="form-required">*</span>进货价</label>
			<div class="col-md-6 col-sm-10">
				<input type="text" class="form-control" id="input-key" name="edit[buy_price]" value="<?php echo $buy_price; ?>" required>
			</div>
		</div>
		<div class="form-group">
			<label for="input-ret" class="col-sm-2 control-label"><span class="form-required">*</span>零售价</label>
			<div class="col-md-6 col-sm-10">
				<input type="text"  class="form-control" id="input-ret" name="edit[ret_price]" value="<?php echo $ret_price; ?>" required>
			</div>
		</div>
		<div class="form-group">
			<label for="input-company" class="col-sm-2 control-label"><span class="form-required">*</span>单位</label>
			<div class="col-md-6 col-sm-10">
				<input type="text"  class="form-control" id="input-company" name="edit[company]" value="<?php echo $company; ?>" required>
			</div>
		</div>
		<div class="form-group">
			<label for="input-member" class="col-sm-2 control-label"><span class="form-required">*</span>会员价</label>
			<div class="col-md-6 col-sm-10">
				<input type="text"  class="form-control" id="input-member" name="edit[member_price]" value="<?php echo $member_price; ?>" required>
			</div>
		</div>
		<div class="form-group">
			<label for="input-brand" class="col-sm-2 control-label"><!-- <span class="form-required">*</span> -->品牌</label>
			<div class="col-md-6 col-sm-10">
				<input type="text" class="form-control" id="input-brand" name="edit[brand]" value="<?php echo $brand; ?>" >
			</div>
		</div>
		<div class="form-group">
			<label  class="col-sm-2 control-label">报警库存</label>
			<div class="col-md-6 col-sm-10">
				<input type="text" class="form-control" name="edit[alert]" placeholder="报警库存" value="<?php echo $alert; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="input-remark" class="col-sm-2 control-label">备注</label>
			<div class="col-md-6 col-sm-10">
				<textarea class="form-control" id="input-remark" name="edit[remark]"><?php echo $remark; ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary js-ajax-submit">修改</button>
			</div>
		</div>
	</form>
</div>

<script src="__STATIC__/js/admin.js"></script>

</body>
</html>