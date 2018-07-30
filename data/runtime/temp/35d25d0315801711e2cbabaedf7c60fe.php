<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:60:"themes/admin_simpleboot3/admin\traffic\purchaseaddindex.html";i:1529057906;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>


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
<link href="__JS__/bootstrop-file/css/fileinput.min.css" rel="stylesheet" />
<script type="text/javascript" src="__JS__/bootstrop-file/js/fileinput.min.js"></script>
<script type="text/javascript" src="__JS__/bootstrop-file/js/locales/zh.js"></script>

<div class="wrap js-check-wrap">
	<ul class="nav nav-tabs">
		<li><a href="<?php echo url('admin/traffic/purchase'); ?>">采购列表</a></li>
		<li class="active"><a href="">添加采购</a></li>
	</ul>

	<form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url('traffic/purchaseAddPost'); ?>" >
		<input type="hidden" name="add[add_time]" value="<?php echo time(); ?>">
		<input type="hidden" name="add[seller_id]" value="<?php echo $seller_id; ?>">
		<input type="hidden" name="add[type]" value="9">
		<div class="form-group">
			<label for="input-parent_id" class="col-sm-2 control-label"><span class="form-required">*</span>货品名称</label>
			<div class="col-md-6 col-sm-10">
				<input type="text" class="form-control" id="input-parent_id" name="add[name]" placeholder="货品名称" required>
			</div>
		</div>
		<div class="form-group">
			<label for="input-category_id" class="col-sm-2 control-label"><span class="form-required">*</span>分类</label>
			<div class="col-md-6 col-sm-10">
				<select class="form-control" name="add[category_id]" id="input-category_id" required>
					<option value="0">- 请选择采购分类 -</option><?php echo $select_category; ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="input-name" class="col-sm-2 control-label"><span class="form-required">*</span>数量</label>
			<div class="col-md-6 col-sm-10">
				<input type="number" class="form-control" id="input-name" name="add[stock]" placeholder="数量" required>
			</div>
		</div>
		<div class="form-group">
			<label for="input-key" class="col-sm-2 control-label"><span class="form-required">*</span>进货价</label>
			<div class="col-md-6 col-sm-10">
				<input type="text" class="form-control" id="input-key" name="add[buy_price]" placeholder="单位：元" required>
			</div>
		</div>
		<div class="form-group">
			<label for="input-brand" class="col-sm-2 control-label"><!-- <span class="form-required">*</span> -->品牌</label>
			<div class="col-md-6 col-sm-10">
				<input type="text" class="form-control" id="input-brand" name="add[brand]" placeholder="品牌名称，可不填">
			</div>
		</div>
		<div class="form-group">
			<label for="input-remark" class="col-sm-2 control-label">备注</label>
			<div class="col-md-6 col-sm-10">
				<textarea class="form-control" id="input-remark" name="add[remark]"></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary js-ajax-submit">添加</button>
				<button type="button" class="btn btn-primary" id="excel">Excel上传</button>
				<a class="btn btn-primary" href="<?php echo url('admin/traffic/export',array('type'=>9)); ?>" style="display: none;float: right" name="excels">模板下载</a>
			</div>
		</div>
	</form>


	<form class="well form-inline margin-top-20" enctype="multipart/form-data" style="display: none" name="excels">
		<div class="file-loading">
			<input id="kv-explorer" type="file" multiple>
		</div>
		<br>
		<div class="file-loading">
			<input id="imgUpload" class="file" type="file" multiple data-min-file-count="1" name="excel">
		</div>
		<br>
	</form>
</div>

<script src="__STATIC__/js/admin.js"></script>
<script>
	$('#excel').click(function () {
		$('[name="excels"]').css('display','block');
    });
    $("#imgUpload")
        .fileinput({
            language: 'zh',
            uploadUrl: "<?php echo url('admin/traffic/do_upload',array('type'=>9)); ?>",
            autoReplace: true,
            maxFileCount: 1,
            allowedFileExtensions: ["xlsx", "xls"],
            browseClass: "btn btn-primary", //按钮样式
            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
        })
        .on("fileuploaded", function (e, data) {
            var res = data.response;
            if (res.state > 0) {
                alert('上传成功');
                window.location.href="<?php echo url('traffic/purchase'); ?>";
            }
            else {
                alert('上传失败')
            }
        })

</script>
</body>
</html>