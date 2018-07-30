<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:49:"themes/admin_simpleboot3/admin\printer\index.html";i:1529738069;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
</head>
<body>
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="<?php echo url('printer/index'); ?>">设备列表</a></li>
			<li><a href="<?php echo url('printer/add_index'); ?>">添加设备</a></li>
		</ul>
		<?php 
			$type = array('停用','启用');
			$voice = array('无','滴滴声','真人语音(小)','真人语音(中)','真人语音(大)');
		 ?>
		<form class="well form-inline margin-top-20" method="post" action="<?php echo url('printer/index'); ?>">
	        <input class="form-control" type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>"
	               placeholder="请输入设备号">
	        <input type="submit" class="btn btn-success" value="搜索"/>
	        <a class="btn btn-danger" href="<?php echo url('printer/index'); ?>">清空</a>
			<!--<span style="float: right">
				<button type="button" id="printer_position" class="btn btn-success">位置管理</button>
			</span>-->
	    </form>
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th width="10%">设备号</th>
						<th width="10%">秘钥</th>
						<th width="20%">名称、型号等其他信息</th>
						<th width="5%">状态</th>
						<th width="5%">位置</th>
						<th width="15%">语音</th>
						<th width="15%">快速操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($data)): if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>
							<tr>
								<td><?php echo $vo['printer_id']; ?></td>
								<td><?php echo $vo['secret_key']; ?></td>
								<td><?php echo $vo['remark']; ?></td>
								<td>
									<button type="button" class="<?php echo $vo['type']==1?'btn btn-success':'btn btn-danger'; ?>" name="type">
										<?php echo $type[$vo['type']]; ?>
									</button>
									<i style="display: none"><?php echo $vo['type']; ?></i>
								</td>
								<td><?php echo empty($vo['position'])?'暂未分配':$vo['position']; ?></td>
								<td><?php echo $voice[$vo['voice']]; ?></td>
								<td>
									<a class="btn btn-success" href="<?php echo url('printer/change',['id'=>$vo['printer_id']]); ?>">修改</a>
								</td>
							</tr>
						<?php endforeach; endif; else: echo "" ;endif; endif; ?>
				</tbody>
			</table>
		<div class="col-xs-12"  style="text-align:center">
			<ul class="pagination">
				<?php if(!empty($page)): ?>
					<?php echo (isset($page) && ($page !== '')?$page:''); endif; ?>
			</ul>
		</div>
	</div>

	<!--位置管理-->
	<div class="modal fade"  id="myModal"
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

					<h4 class="modal-title"
						id="myModalLabel">

					</h4>

				</div>


					<input type="hidden" name="add[tra_id]" id="apply_id">

					<div class="modal-body">
						<table class="table table-bordered " id="foodList">
							<thead>
							<tr>
								<th>序号</th>
								<th>名称</th>
								<th>操作</th>
							</tr>
							</thead>
							<tbody>
							<?php if(!(empty($position) || (($position instanceof \think\Collection || $position instanceof \think\Paginator ) && $position->isEmpty()))): if(is_array($position) || $position instanceof \think\Collection || $position instanceof \think\Paginator): if( count($position)==0 ) : echo "" ;else: foreach($position as $key=>$vo): ?>
									<tr>
										<td><?php echo $key+1; ?></td>
										<td><?php echo $vo['name']; ?></td>
										<td>
											<button type="button" class="btn btn-link" name="edit_position">修改</button>
											<a type="button" class="btn btn-link js-ajax-delete" href="<?php echo url('PrinterPosition/positDel',array('posit_id'=>$vo['posit_id'])); ?>">删除</a>
										</td>
										<input type="hidden" value="<?php echo $vo['posit_id']; ?>">
									</tr>
								<?php endforeach; endif; else: echo "" ;endif; endif; ?>
							</tbody>
						</table>
					</div>

					<div class="modal-footer">

						<button type="button"
								class="btn btn-default"  data-dismiss="modal">
							<span
								class="glyphicon glyphicon-remove"  aria-hidden="true"></span>
							关闭</button>
						<button type="button"
								class="btn btn-primary" data-target="#thisModal" data-toggle="modal">
							新增
						</button>

					</div>




			</div>

		</div>

	</div>
	<!--位置管理-->

	<!--新增位置-->
	<div class="modal fade" id="thisModal" tabindex="-1" role="dialog" aria-labelledby="thisModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="thisModalLabel">位置添加</h4>
				</div>
				<form  action="<?php echo url('admin/PrinterPosition/addAjax'); ?>" class="js-ajax-form" method="post">
					<div class="modal-body" >
						<div class="form-group">

							<label for="position_add_name">名称</label>

							<input type="text"
								   name="name"
								   class="form-control"
								   id="position_add_name"
								   placeholder="名称" required>

						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
						<button type="submit" class="btn btn-default js-ajax-submit" >确定</button>

					</div>
				</form>

			</div>
		</div>
	</div>
	<!--新增位置-->

	<!--修改位置-->
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="thisModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" >位置修改</h4>
				</div>
				<form  action="<?php echo url('admin/PrinterPosition/editAjax'); ?>" class="js-ajax-form" method="post">
					<input type="hidden" name="posit_id" id="edit_posit_id">
					<div class="modal-body" >
						<div class="form-group">

							<label for="position_add_name">名称</label>

							<input type="text"
								   name="name"
								   class="form-control"
								   id="edit_name"
								   placeholder="名称" required>

						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
						<button type="submit" class="btn btn-default js-ajax-submit" >确定</button>

					</div>
				</form>

			</div>
		</div>
	</div>
	<!--修改位置-->

	<div><script src="__STATIC__/js/admin.js"></script></div>
	<script type="text/javascript" src="__STATIC__/js/bootbox/bootbox.min.js"></script>

	<script>
		//快捷停用
		$('[name="type"]').click(function () {
		    var thisOne = $(this);
			var id		= thisOne.parent().parent().children().first().text();
			var type 	= thisOne.next().text();
			$.post("<?php echo url('printer/type'); ?>",
				{'id':id,'type':type},function (msg) {
					if(msg==1100){
                        thisOne.next().text('0');
					    thisOne[0].className='btn btn-danger';
					    thisOne.text('停用');
					}else if(msg==1111){
                        thisOne.next().text('1');
                        thisOne[0].className='btn btn-success';
                        thisOne.text('启用');
					}else {
                        alert(msg);
					}
                },'text')
        });


		//位置弹窗
		$('#printer_position').click(function () {
            $('#myModal').modal();
        });


		//修改
		$('[name="edit_position"]').click(function () {
		    var edit_position = $(this).parent();
			$('#edit_posit_id').val(edit_position.next().val());
			$('#edit_name').val(edit_position.prev().text());
			$('#editModal').modal();
        })
	</script>
</body>
</html>