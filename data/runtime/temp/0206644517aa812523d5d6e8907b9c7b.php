<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:54:"themes/admin_simpleboot3/admin\seller\sellertable.html";i:1528443791;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
			<?php if(cmf_get_current_admin_id() == 1): ?>
				<li><a href="<?php echo url('Seller/index'); ?>">商家列表</a></li>
			<?php endif; ?>
			<li class="active"><a href="#">餐桌管理</a></li>
			<li>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">添加</button>
					</div>
				</div>
			</li>
		</ul>
		<form class="well form-inline margin-top-20" method="get" action="<?php echo url('Seller/sellerTable'); ?>">

			<select name="menu" style="text-align: center" class="form-control">
				<?php if(!empty($menu[0])): ?>
					<option value="" <?php echo $menu_id==""?"selected":""; ?>>请选择服务厅</option>
					<?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): ?>
						<option value="<?php echo $vo['id']; ?>" <?php echo $menu_id==$vo['id']?"selected":""; ?>><?php echo $vo['name']; ?></option>
					<?php endforeach; endif; else: echo "" ;endif; else: ?>
					<option value="">你还未建立服务厅，请在分类建立！</option>
				<?php endif; ?>
			</select>
			<input type="submit" class="btn btn-success" value="搜索"/>
			<a class="btn btn-danger" href="<?php echo url('Seller/sellerTable'); ?>">清空</a>

		</form>
		<form method="post" class="form-horizontal js-ajax-form margin-top-20">
			<table class="table table-bordered table-hover" id='testTbl'>
				<thead>
					<tr class="success">
						<th width="5%">ID</th>
						<th width="15%">类型</th>
						<th width="52%">描述</th>
						<th width="8%">服务厅</th>
						<th width="5%">排号</th>
						<th width="7%">餐桌二维码</th>
						<th width="11%">操作</th>
					</tr>
				</thead>
				<?php if(is_array($table) || $table instanceof \think\Collection || $table instanceof \think\Paginator): if( count($table)==0 ) : echo "" ;else: foreach($table as $key=>$vo): ?>
					<tbody>
						<td><?php echo $key+1; ?></td>
						<td><?php echo $vo['table_name']; ?></td>
						<td><?php echo $vo['table_describe']; ?></td>
						<td><?php echo $vo['name']; ?></td>
						<td><?php echo $vo['tb_id']; ?></td>
						<td style="text-align: center;">
                    		<a href="<?php echo cmf_get_image_preview_url('QR_code/seller-table-'.$vo['id'].'.png'); ?>" title="点击下载" download="<?php echo $vo['id']; ?>">
	                           <img src="<?php echo cmf_get_image_preview_url('QR_code/seller-table-'.$vo['id'].'.png'); ?>" width="50" style="cursor: pointer"/>
	                        </a>							                    	
	                    </td>
						<td>
							<?php 
								$array = array(301,302,303,304,305,306,307,308,309);
							 if(!in_array(($vo['id']), is_array($array)?$array:explode(',',$array))): ?>
								<button type="button" class="btn btn-default js-ajax-submit" data-toggle="modal" data-target="#edit" onclick="editseller(this)">修改</button><input type="hidden" name="" value="<?php echo $vo['id']; ?>"><input type="hidden" name="" value="<?php echo $vo['table_id']; ?>">
								<a class="btn btn-danger js-ajax-delete" href="<?php echo url('seller/sellerTableDel',array('id'=>$vo['id'])); ?>">删除</a>
							<?php endif; ?>
						</td>	
					</tbody>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</table>
			<div style="position: relative;">
				<button type="button" class="btn btn-success" id="all_download">
					批量下载
				</button>
			</div>
		</form>
		<div class="col-xs-12"  style="text-align:center">
			<ul class="pagination"><?php echo $page; ?></ul>
		</div>
	</div>
	<!--添加页面-->
	<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addLabel">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
      			<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title" id="addLabel">餐桌添加</h4>
	      		</div>
	      		<form method="post" href="<?php echo url('Seller/sellerTable'); ?>" class="form-horizontal js-ajax-form margin-top-20">
		      		<div class="modal-body">
			   			<table class="table table-hover table-bordered">
							<tr>
								<th>
									服务厅：
								</th>
								<td>
									<?php if(!empty($menu[0])): ?>
										<select name="rest[menu]" style="text-align: center" class="form-control">
											<?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): ?>
												<option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
											<?php endforeach; endif; else: echo "" ;endif; ?>
										</select>

										<?php else: ?>
										你还未建立服务厅，请在分类建立！
									<?php endif; ?>
								</td>
							</tr>

							<tr>
								<th>
									<?php if(!empty($table_name[0])): ?>
										<div class="new_table">原有餐桌类型：</div>
										<button class="new_table" type="button" id="new" style="color: red;border: none;background-color: rgba(255,255,255,0);">
											新
										</button>
									<?php endif; ?>
									<div class="old_table" style="<?php echo empty($table_name[0])?'':'display:none'; ?>">
										新餐桌类型：
									</div>
									<?php if(!empty($table_name[0])): ?>
									<button type="button" id="old" style="color: red;border: none;background-color: rgba(255,255,255,0);display: none;" class="old_table">
									旧
								</button>
									<?php endif; ?>
								</th>
								<td>
									<?php if(!empty($table_name[0])): ?>
									<div class="new_table">
										<select name="old_table" class="form-control">
											<option value="">请选择</option>
											<?php if(is_array($table_name) || $table_name instanceof \think\Collection || $table_name instanceof \think\Paginator): if( count($table_name)==0 ) : echo "" ;else: foreach($table_name as $key=>$vo): ?>
												<option value="<?php echo $vo['id']; ?>"><?php echo $vo['table_name']; ?></option>
											<?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
									</div>
									<?php endif; ?>
									<div class="old_table" style="<?php echo empty($table_name[0])?'':'display:none'; ?>">
										<input type="text" class="form-control"  placeholder="新类型名称,老式则不用填" name="add[table_name]">
									</div>
								</td>
							</tr>
			   				<tr>
								<th>餐桌描述：</th>
								<td><textarea type="text" style="resize: none;width: 100%;height: 100px" name="add[table_describe]"  class="form-control" placeholder="商家对餐桌用途的描述,老式可不填"></textarea></td>
			   				</tr>
							<tr>
								<th>数量：</th>
								<td><input type="number" name="rest[num]" placeholder="请输入你要添加的餐桌数量" class="form-control"></td>
							</tr>
			   			</table>
	  				</div>
		      		<div class="modal-footer">
		        		<button type="submit" class="btn btn-primary js-ajax-submit" >添加</button>
		        		<button type="button" class="btn btn-default" data-dismiss="modal">在想想</button>
	      			</div>
      			</form>
    		</div>
	  	</div>
	</div>
	<!--修改页面-->
	<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editLabel">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
      			<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title" id="editLabel">餐桌修改</h4>
	      		</div>
	      		<form method="post" href="<?php echo url('Seller/sellerTable'); ?>" class="form-horizontal js-ajax-form margin-top-20">
		      		<div class="modal-body">
			   			<table class="table table-hover table-bordered">
			   				<input type="hidden" id="restid" name="rest[id]" value="">
							<tr>
								<th>
									服务厅：
								</th>
								<td>
									<input readonly type="text" id="this_menu"  class="form-control" name="rest[old_menu]">
									<?php if(!empty($menu[0])): ?>
										<select name="rest[menu]" style="text-align: center;display: none" class="form-control">
											<option value="">重新选择服务厅</option>
											<?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): ?>
												<option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
											<?php endforeach; endif; else: echo "" ;endif; ?>
										</select>

										<?php else: ?>
										你还未建立服务厅，请在分类建立！
									<?php endif; ?>
								</td>
							</tr>
							<tr>
								<th>
									<?php if(!empty($table_name[0])): ?>
										<div class="edit_new_table">原有餐桌类型：</div>
										<button class="edit_new_table" type="button" id="edit_new" style="color: red;border: none;background-color: rgba(255,255,255,0);">
											新
										</button>
									<?php endif; ?>
									<div class="edit_old_table" style="display:none">
										新餐桌类型：
									</div>
									<?php if(!empty($table_name[0])): ?>
										<button type="button" id="edit_old" style="color: red;border: none;background-color: rgba(255,255,255,0);display: none;" class="edit_old_table">
											旧
										</button>
									<?php endif; ?>
								</th>
								<td>
									<?php if(!empty($table_name[0])): ?>
										<div class="edit_new_table">
											<select name="rest[table_id]" class="form-control" id="edit_new_table">
												<option value="">请选择</option>
												<?php if(is_array($table_name) || $table_name instanceof \think\Collection || $table_name instanceof \think\Paginator): if( count($table_name)==0 ) : echo "" ;else: foreach($table_name as $key=>$vo): ?>
													<option value="<?php echo $vo['id']; ?>"><?php echo $vo['table_name']; ?></option>
												<?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									<?php endif; ?>
									<div class="edit_old_table" style="display:none">
										<input type="text" class="form-control"  placeholder="新类型名称,老式则不用填" name="edit[table_name]">
									</div>
								</td>
							</tr>
			   				<tr>
								<th>餐桌描述：</th>
								<td><textarea type="text" id="editdescribe" style="resize: none;width: 100%;height: 100px" name="edit[table_describe]"  class="form-control" placeholder="商家对餐桌用途的描述"></textarea></td>
			   				</tr>
							<tr>
								<th>排号:</th>
								<td>
									<input type="hidden" name="rest[old_id]" id="old_id">
									<input type="number" name="rest[tb_id]" id="tb_id" class="form-control">
								</td>
							</tr>
			   			</table>
	  				</div>
		      		<div class="modal-footer">
		        		<button type="submit" class="btn btn-primary js-ajax-submit" >修改</button>
		        		<button type="button" class="btn btn-default" data-dismiss="modal">在想想</button>
	      			</div>
      			</form>
    		</div>
	  	</div>
	</div>
	<div><script src="__STATIC__/js/admin.js"></script></div>
	<form action="" id=""></form>
	<script type="text/javascript">
		/*数据修改*/
		function editseller(obj){
			var id = $(obj).next().val();
			var table_id = $(obj).next().next().val();
		var row = obj.parentNode.parentNode; //标签所在行
		var tb = row.parentNode.parentNode; //当前表格
		var rowIndex = row.rowIndex; //A标签所在行下标
		$('#tb_id').val(tb.rows[rowIndex].cells[5].innerHTML);
		$('#old_id').val(tb.rows[rowIndex].cells[5].innerHTML);
		$('#this_menu').val(tb.rows[rowIndex].cells[4].innerHTML);
		$('#restid').val(id);

		$('#editdescribe').val(tb.rows[rowIndex].cells[3].innerHTML);
		$('#edit_new_table').children().each(function () {
			$(this).removeAttr("selected");
		});
		$('#edit_new_table').children().eq(table_id).attr('selected','selected');
		close();
	}
		/*修改服务厅*/
		$('#this_menu').click(function () {
			$(this).css('display','none');
			$(this).next().css('display','block');
        });

		function close() {
            $('#this_menu').css('display','block');
            $('#this_menu').next().css('display','none');
        }

        /*新添加*/
        $('#new').click(function () {
            $('.new_table').css('display','none');
            $('.old_table').css('display','block');
        });
        /*新添加*/
        $('#edit_new').click(function () {
            $('.edit_new_table').css('display','none');
            $('.edit_old_table').css('display','block');
        });
		/*旧选择*/
        $('#old').click(function () {
            $('.new_table').css('display','block');
            $('.old_table').css('display','none');
        });
		/*旧选择*/
        $('#edit_old').click(function () {
            $('.edit_new_table').css('display','block');
            $('.edit_old_table').css('display','none');
        });


        $('#all_download').on("click", function(){
			var srcArr = new Array();
			$('[name="checkItem"]:checked').each(function (a,b) {
				var href = $(this).parent().parent().children().eq(6).children().attr('href');
					if(href!=undefined){
                        srcArr[a] = href;
					}
            });

            $.post("<?php echo url('seller/zipDown'); ?>",{'data':srcArr},function (msg) {
				console.log(msg);
                window.location.href=msg;
            });
        });

	</script>

	<script>
		/*全选框*/
        $(function(){
            function initTableCheckbox() {
                var $thr = $('table thead tr');
                var $checkAllTh = $('<th><input type="checkbox" id="checkAll" name="checkAll" /></th>');
				/*将全选/反选复选框添加到表头最前，即增加一列*/
                $thr.prepend($checkAllTh);
				/*“全选/反选”复选框*/
                var $checkAll = $thr.find('input');
                $checkAll.click(function(event){
					/*将所有行的选中状态设成全选框的选中状态*/
                    $tbr.find('input').prop('checked',$(this).prop('checked'));
					/*并调整所有选中行的CSS样式*/
                    if ($(this).prop('checked')) {
                        $tbr.find('input').parent().parent().addClass('warning');
                    } else{
                        $tbr.find('input').parent().parent().removeClass('warning');
                    }
					/*阻止向上冒泡，以防再次触发点击操作*/
                    event.stopPropagation();
                });
				/*点击全选框所在单元格时也触发全选框的点击操作*/
                $checkAllTh.click(function(){
                    $(this).find('input').click();
                });
                var $tbr = $('table tbody tr');
                var $checkItemTd = $('<td><input type="checkbox" name="checkItem" /></td>');
				/*每一行都在最前面插入一个选中复选框的单元格*/
                $tbr.prepend($checkItemTd);
				/*点击每一行的选中复选框时*/
                $tbr.find('input').click(function(event){
					/*调整选中行的CSS样式*/
                    $(this).parent().parent().toggleClass('warning');
					/*如果已经被选中行的行数等于表格的数据行数，将全选框设为选中状态，否则设为未选中状态*/
                    $checkAll.prop('checked',$tbr.find('input:checked').length == $tbr.length ? true : false);
					/*阻止向上冒泡，以防再次触发点击操作*/
                    event.stopPropagation();
                });
				/*点击每一行时也触发该行的选中操作*/
                $tbr.click(function(){
                    $(this).find('input').click();
                });
            }
            initTableCheckbox();
        });
	</script>
</body>
</html>