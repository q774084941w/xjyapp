<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:48:"themes/admin_simpleboot3/admin\reserve\edit.html";i:1530170214;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
<style type="text/css">
    .pic-list li {
        margin-bottom: 5px;
    }
</style>
</head>
<body>
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<li ><a href="<?php echo url('admin/reserve/index'); ?>">预约订单</a></li>
			<li class="active"><a href="#">订单修改</a></li>
		</ul>
		<form action="<?php echo url('order/orderEditPost'); ?>" method="post" class="form-horizontal js-ajax-form margin-top-20">   <!-- js-ajax-form -->
        <div class="row">
            <div class="col-md-9">
            	<?php 
					$pay 			= 	array('1'=>'未支付','2'=>'确认订单','3'=>'拒绝订单','4'=>'已支付','5'=>'未评价','6'=>'已评价');
					$order_class 	= 	array('1'=>'餐桌订单','2'=>'外卖订单','3'=>'预约订单');
					$order_complete = 	array('1'=>'未确认','2'=>'确认','3'=>'拒绝','4'=>'完成');
					$pay_class 	 = 	array('1'=>'支付宝','2'=>'微信','3'=>'银联','4'=>'现金','5'=>'vip卡');
				 ?>
            	<table  class="table table-bordered">  
			        <tr>  
		             	<td style="width: 20%">订单号：<input readonly class="form-control" type="text" name="order[order_id]"
                                    value="<?php echo $order['order_id']; ?>" placeholder="订单号不给于修改"/></td>
			            <td style="width: 25%">商家ID：<input readonly class="form-control" type="text" name="order[seller_id]"
                                    value="<?php echo $order['seller_id']; ?>" placeholder="商家ID不给于修改"/></td>   
			            <td style="width: 25%">用户ID：<input readonly class="form-control" type="text" name="order[user_id]"
                                    value="<?php echo $order['user_id']; ?>" placeholder="用户ID不给于修改"/></td>  			            
			            <td style="width: 30%">下单时间：<input class="form-control js-bootstrap-datetime" type="text" name="order[order_time]"
                                   value="<?php echo date('Y-m-d H:i:s',$order['order_time']); ?>" disabled></td>
			        </tr>  
			        <tr>  			   
			        	<td>订单类型：
							<input type="text" class="form-control"  id="order_class" name="order[order_class]" disabled value="<?php echo $order_class[$order['order_class']]; ?>">
			        	</td>  
			        	<td>支付状态：

			        		<select class="form-control" name="order[pay]" disabled>
			        			<?php if(is_array($pay) || $pay instanceof \think\Collection || $pay instanceof \think\Paginator): if( count($pay)==0 ) : echo "" ;else: foreach($pay as $key=>$vo): ?>
									<option value="<?php echo $key; ?>" <?php if($order['pay'] == $key): ?>selected<?php endif; ?> ><?php echo $vo; ?></option>
					        	<?php endforeach; endif; else: echo "" ;endif; ?>                             
                            </select>
			        	</td>   
			            <td>订单状况：
			            	<?php if(is_array($order_complete) || $order_complete instanceof \think\Collection || $order_complete instanceof \think\Paginator): if( count($order_complete)==0 ) : echo "" ;else: foreach($order_complete as $key=>$vo): ?>
								<input type="radio" disabled name="order[order_complete]" value="<?php echo $key; ?>" <?php if($order['order_complete'] == $key): ?>checked<?php endif; ?> ><?php echo $vo; endforeach; endif; else: echo "" ;endif; ?> 
						</td>		
						<?php if($order['order_class'] != 4): ?>
						<td>餐桌ID：<input class="form-control" type="text" disabled name="order[table_id]" value="<?php echo $order['table_id']; ?>"placeholder="没有使用就不填"></td>
						<?php else: ?>
						<td>订单价格：<input class="form-control" type="text" name="order[order_price]" value="<?php echo $order['order_price']; ?>" id="allPrice"></td>
						<?php endif; ?>           
			            <!-- <td>优惠劵ID：<input class="form-control" type="text" name="order[coupon_id]" <?php if($order['coupon_id'] == 0): else: ?>value=""<?php endif; ?> placeholder="没有使用就不填"></td>  -->
			        </tr>
			        <tr id="delivery_n" <?php if($order['order_class'] == 1 or $order['order_class'] == 3 or $order['order_class'] == 4): ?> style="display: none;"  <?php endif; ?> >	
			            <td colspan="1">配送方：
							<select class="form-control" name="order[delivery_type]">
							<?php if(is_array($delivery1) || $delivery1 instanceof \think\Collection || $delivery1 instanceof \think\Paginator): if( count($delivery1)==0 ) : echo "" ;else: foreach($delivery1 as $key=>$vo): ?>
								<option value ="<?php echo $vo['delivery_id']; ?>" <?php if($order['delivery_type'] == $vo['delivery_id']): ?> selected = 'selected'<?php endif; ?>><?php echo $vo['delivery_name']; ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
			            </td> 
			            <td colspan="1">配送评分：<input class="form-control" type="text" name="order[delivery_evaluate]" value="<?php echo $order['delivery_evaluate']; ?>"  placeholder="配送评分"></td>
			            <?php $order_delivery=array('1'=>'未接单','2'=>'配送中','3'=>'配送完成','4'=>'系统接单','5'=>'分配骑手','6'=>'骑手到店') ?>
			            <td colspan="2">配送状态：
			            	<?php if(is_array($order_delivery) || $order_delivery instanceof \think\Collection || $order_delivery instanceof \think\Paginator): if( count($order_delivery)==0 ) : echo "" ;else: foreach($order_delivery as $key=>$val): ?>
			            		<input type="radio" name="order[order_delivery]" value="<?php echo $key; ?>" <?php if($order['order_delivery'] == $key): ?>checked<?php endif; ?> > <?php echo $val; endforeach; endif; else: echo "" ;endif; ?>
			            </td> 
			        </tr>
			        <?php if($order['order_class'] != 3): 
			        		$reserve['table_nub']=0;
				        	$reserve['reserve_time']=time();
				        	$reserve['complete']=1;
				         endif; ?>
					<tr id="reserve_s" <?php if($order['order_class'] == 1 or $order['order_class'] == 2 or $order['order_class'] == 4): ?> style="display: none;"  <?php endif; ?> >
						<td colspan="1">预约桌数：<input class="form-control" type="text" value="<?php echo $reserve['table_nub']; ?>" name="reserve[table_nub]" placeholder="预约桌数"></td> 
			            <td colspan="1">预约时间：<input class="form-control js-bootstrap-datetime" type="text" name="reserve[reserve_time]"
                               value="<?php echo date('Y-m-d H:i:s',$reserve['reserve_time']); ?>"></td> 

			            <td colspan="3">预约是否完成：
							<input type="radio" name="reserve[complete]" value="1" <?php if($reserve['complete'] == 1): ?>checked<?php endif; ?> >未确认
							<input type="radio" name="reserve[complete]" value="2" <?php if($reserve['complete'] == 2): ?>checked<?php endif; ?> >完成
							<input type="radio" name="reserve[complete]" value="3" <?php if($reserve['complete'] == 3): ?>checked<?php endif; ?> >商家违约
							<input type="radio" name="reserve[complete]" value="4" <?php if($reserve['complete'] == 4): ?>checked<?php endif; ?> >用户违约
			            </td>
					</tr>	
					<tr id="reserve_a" >
						<td>就餐人数：<input class="form-control" type="text" value="<?php echo $reserve['user_nub']; ?>" name="reserve[user_nub]" placeholder="就餐人数"></td>
						<td>预约电话：<input class="form-control" type="text" value="<?php echo $reserve['tel']; ?>" name="reserve[tel]" placeholder="预约电话"></td>
						<td>预约者名字：<input class="form-control" type="text" value="<?php echo $reserve['user_name']; ?>" name="reserve[user_name]" placeholder="预约者名字"></td>


					</tr>

					<tr>

						<td>预约服务厅：
							<select class="form-control" name="reserve[reserve_class]">
								<option value="">默认服务厅</option>
								<?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): ?>
									<option value ="<?php echo $vo['id']; ?>" <?php if($reserve['menu_id'] == $vo['id']): ?> selected = 'selected'<?php endif; ?>><?php echo $vo['name']; ?></option>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</select>

						</td>
						<td >预约餐桌：
						<select class="form-control" name="reserve[reserve_class]">
							<option value="">默认餐桌</option>
							<?php if(is_array($table) || $table instanceof \think\Collection || $table instanceof \think\Paginator): if( count($table)==0 ) : echo "" ;else: foreach($table as $key=>$vo): ?>
								<option value ="<?php echo $vo['id']; ?>" <?php if($reserve['reserve_class'] == $vo['id']): ?> selected = 'selected'<?php endif; ?>><?php echo $vo['table_name']; ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						</td>
					</tr>

			        <tr>  
			            <td colspan="2">用户评价：
			            	<div>
				            	<textarea  name="order[user_evaluate]" style="width: 100%;height: 100px;resize: none;"><?php if(empty($order['user_evaluate'])): ?>该用户尚未评价！<?php else: ?><?php echo $order['user_evaluate']; endif; ?></textarea>
			            	</div>
			            </td>
						<td colspan="2">备注：
							<div>
								<textarea  name="order[remarks]" style="width: 100%;height: 100px;resize: none;"><?php echo $order['remarks']; ?></textarea>
							</div>
						</td>
			        </tr>
			    </table>
				<input type="hidden" name="type" value="<?php echo $type; ?>">
			    <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-9">

                    	<button type="submit" class="btn btn-primary"  >修改</button>
                        <a class="btn btn-default" href="javaScript:history.go(-1)">返回</a>
                    </div>
                </div>            
            </div>

            <div class="col-md-3">
            	<div class="panel panel-default">
			  		<div class="panel-heading">订单详情：</div>
				  	<div class="panel-body" style="height:400px;overflow-y:scroll;">
						<table class="table table-bordered" id="testTbl">
				    		<tr>
				    			<td width="25%">菜品</th>
					    			<td width="30%">数量</th>
					    			<td width="30%">单价</th>
					    			<td width="15%">操作</th>
				    		</tr>
							<?php if(!(empty($food) || (($food instanceof \think\Collection || $food instanceof \think\Paginator ) && $food->isEmpty()))): if(is_array($food) || $food instanceof \think\Collection || $food instanceof \think\Paginator): if( count($food)==0 ) : echo "" ;else: foreach($food as $key=>$vo): ?>
									<tr>
										<td><?php echo $data[$vo['id']]['food_name']; ?></td>
										<td>
											<input class="form-control" type="number" name="food[<?php echo $vo['id']; ?>]" value="<?php echo $vo['nub']; ?>">
										</td>
										<td><input readonly class="form-control" type="number"  min="1"  value="<?php echo $data[$vo['id']]['price']; ?>" name="price"></td>
										<td><input  type="button" class="btn btn-default" value="删除" onclick="res(this)"></td>
									</tr>
								<?php endforeach; endif; else: echo "" ;endif; endif; ?>

						</table>					
				  	</div>
				  	<div class="panel-footer"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
					  添加
						</button>
					</div>
				</div>           	
            </div>

        </div>
    </form>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
      			<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title" id="myModalLabel">菜品添加</h4>
					<form  class=" form-inline margin-top-20" id="seller_menu_form">

						<select name="menu_id" style="text-align: center" class="form-control" id="menu_parent_id">
							<?php if(!(empty($menu) || (($menu instanceof \think\Collection || $menu instanceof \think\Paginator ) && $menu->isEmpty()))): ?>
								<option value="">请选择服务厅</option>
								<?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): ?>
									<option value="<?php echo $vo['id']; ?>" ><?php echo $vo['name']; ?></option>
								<?php endforeach; endif; else: echo "" ;endif; else: ?>
								<option value="">你还未建立服务厅，请在分类建立！</option>
							<?php endif; ?>
						</select>
						<select name="child_id" style="text-align: center" class="form-control" id="menu_child_id">
							<option value="">请选择菜系</option>
						</select>
						<input class="form-control" type="text" name="menu_keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>"
							   placeholder="菜名/拼音">
						<button type="button" class="btn btn-success" id="submit_menu">搜索</button>
					</form>
	      		</div>
	      		<div class="modal-body" style="height: 600px;overflow-x: auto;">
		        	<table class="table table-bordered" id="seller_menu_table">
		    			<tr>
			    			<th width="75%">菜品名字</th>
			    			<th width="15%">价格</th>
			    		</tr>	
			    		<?php if(is_array($seller_menu) || $seller_menu instanceof \think\Collection || $seller_menu instanceof \think\Paginator): if( count($seller_menu)==0 ) : echo "" ;else: foreach($seller_menu as $key=>$vo): ?>
			    		<tr>
			    			<td>
			    				<div class="input-group">
							      <span class="input-group-addon">
							        <input type="checkbox" name="food1" value="<?php echo $vo['id']; ?>">
							      </span>
							      <input readonly type="text" class="form-control" name='food_name' value="<?php echo $vo['food_name']; ?>" >
							    </div>										  
			    			</td>
			    			<td><input readonly type="text" class="form-control" name='food_price' value="<?php echo $vo['price']; ?>" ></td>
			    		</tr>	
			    		<?php endforeach; endif; else: echo "" ;endif; ?>	    		
					</table>
  				</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-default" data-dismiss="modal">返回</button>
	        		<button type="button" class="btn btn-primary" onclick="chk()">添加</button>
      			</div>
    		</div>
	  	</div>
	</div>

	<script type="text/javascript" src="__STATIC__/js/admin.js"></script>
	<script type="text/javascript" src="__STATIC__/js/bootbox/bootbox.min.js"></script>
		<script type="text/javascript" src="__TMPL__/public/assets/js/orderedit.js"></script>
		<!--有php标签的-->
		<script>
			//验证密码
            function res(obj){
                var password = <?php echo lang('ADMIN_USER_PASSWORD'); ?>;
                bootbox.setLocale("zh_CN");
                bootbox.prompt("请输入权限密码", function (result)
				{
                    if(result==password)
                    {
                        var row = obj.parentNode.parentNode; //标签所在行
                        var tb = row.parentNode; //当前表格
                        var rowIndex = row.rowIndex; //A标签所在行下标
                        tb.deleteRow(rowIndex); //删除当前行
                        all_price();
                    }
                    else
                        {
                        if (result!=null && result!=undefined && result!='')
                        {
                            bootbox.setLocale("zh_CN");
                            bootbox.alert('密码不正确')
                        }
                    }

                });
            }


            //请求子集数据
            function ajaxChildren(parent_id)
			{
                $.post(
                    "<?php echo url('foodmenu/getAllChild'); ?>",
                    {'parent_id':parent_id},
                    function (msg) {
                        takeMenuChild(msg)
                    },
                    'json');
            }


			/*获取菜单信息*/
            function ajaxToGet(formdata)
			{
                $.ajax({
                        url		: "<?php echo url('SellerMenu/index'); ?>",
                        type	: 'post',
                        processData : false,
                        contentType : false,
                        dataType    :  'json',
                        data		:   formdata,
                        success 	:  function (msg) {
                            seller_menu_table(msg);
                        }
                    }
                )
            }


		</script>
</body>
</html>