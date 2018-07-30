<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:52:"themes/admin_simpleboot3/admin\foodmenu\menuadd.html";i:1528017186;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
	<div class="wrap" style="align:center">
		<ul class="nav nav-tabs">
			<li><a href="<?php echo url('foodmenu/index',array('id'=>$id)); ?>">菜单信息</a></li>
			<li class="active"><a href="#">菜品添加</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form  form-inline margin-top-20" action="<?php echo url('foodmenu/addPost',array('sellser_id'=>$id)); ?>"> 
			<!-- js-ajax-form -->
			<table class="table" style="width: 50%;margin:0 auto;">
				<tr>
					<th width="20%">菜品图片：</th>
					<td>
						<div style="text-align: center;">
			                <input type="hidden" name="post[food_icon]" id="thumbnail" value="">
			                <a href="javascript:uploadOneImage('图片上传','#thumbnail');">
			                    <img src="__TMPL__/public/assets/images/default-thumbnail.png"
			                         id="thumbnail-preview"
			                         width="135" style="cursor: pointer"/>
			                </a>
			                <input type="button" class="btn btn-sm btn-cancel-thumbnail" value="取消图片">
			            </div>
					</td>					
				</tr>
				<tr>
					<th><span class="form-required">*</span>菜系：</th>
					<td>
						<?php if(!empty($select_category)): ?>
							<select class="form-control" name="post[food_class]" id="input-parent_id">
								<?php echo $select_category; ?>
							</select>
						<?php endif; ?>

						<a style="font-size: 12px;font-weight: 400" href="<?php echo url('classification/index'); ?>" class="btn btn-danger">菜系添加</a>
					</td>
				</tr>
				<tr>
					<th><span class="form-required">*</span>名称：</th>
					<td><input class="form-control" style="width: 80%" type="text" name="post[food_name]" placeholder="菜品名称" id="food_name"></td>
				</tr>
				<tr>
					<th>拼音码：</th>
					<td><input class="form-control" style="width: 80%" type="text" name="post[pinyin]" placeholder="拼音码" id="pinyin"></td>
				</tr>

				<tr>
					<th><span class="form-required">*</span>价格：</th>
					<td><input class="form-control" style="width: 80%" type="text" name="post[price]" placeholder="菜品价格"></td>
				</tr>
				<tr>
					<th>优惠：</th>
					<td><input class="form-control" style="width: 80%" type="text" name="post[discount]" placeholder="菜品优惠价格,没优惠不填	"></td>
				</tr>
				<tr>
					<th>餐盒费用：</th>
					<td><input class="form-control" style="width: 80%" type="text" name="post[lunch_box]" placeholder="外卖餐盒费，可不填"></td>
				</tr>
				<tr>
					<th>库存：</th>
					<td>
		            	<input type="radio" value="2" name="post[exhaust]" checked>充足&ensp;

						<input type="radio" value="1" name="post[exhaust]">告罄
					</td>
				</tr>
				<tr>
					<th>热销：</th>
					<td >
		            	<input type="radio" value="1" name="post[hot]" checked>正常
						&ensp;
						<input type="radio" value="2" name="post[hot]">热销
					</td>
					</td>
				</tr>
				<tr>
					<th><span class="form-required">*</span>描述：</th>
					<td>
						 <textarea name="post[food_describe]" class="form-control" style="resize: none;width: 80%;height: 100px" placeholder="菜品描述"></textarea>
						<!--<script type="text/plain" id="content" name="post[food_describe]"></script>-->
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<div class="col-sm-offset-2 col-sm-2">
							<button type="submit" class="btn btn-primary js-ajax-submit" >添加</button>
						</div>
						<div class="col-sm-2">
						    <a class="btn btn-danger" href="<?php echo url('admin/foodmenu/index',array('id'=>$id)); ?>">返回</a>
						</div>
					</td>
				</tr>
			</table>
			<div class="form-group">
				
			</div>
			<div class="form-group">
				
			</div>
		</form>
	</div>
	<script src="__STATIC__/js/admin.js"></script>
<!--	<script type="text/javascript" src="__STATIC__/js/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" src="__STATIC__/js/ueditor/ueditor.all.min.js"></script>-->
	<script src="__TMPL__/public/assets/js/pinyin.js"></script>
<!--	<script type="text/javascript">
		//编辑器路径定义
		var editorURL = GV.WEB_ROOT;
	</script>-->
	<script type="text/javascript">
	    $(function () {

	        /*editorcontent = new baidu.editor.ui.Editor();
	        editorcontent.render('content');
	        try {
	            editorcontent.sync();
	        } catch (err) {
	        }*/

	        $('.btn-cancel-thumbnail').click(function () {
	            $('#thumbnail-preview').attr('src', '__TMPL__/public/assets/images/default-thumbnail.png');
	            $('#thumbnail').val('');
	        });

	    });

        $('#food_name').blur(function () {
            var name = $(this).val();
            var pinyin = codefans_net_CC2PY(name);
            $('#pinyin').val(pinyin)
        });

	</script>
</body>
</html>