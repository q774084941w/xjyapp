<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:51:"themes/admin_simpleboot3/admin\order\orderedit.html";i:1530199084;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
    .table-bordered td font{
		font-weight: 700;
    }
</style>
</head>
<body onload="yz();">
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<?php if(empty($type) || (($type instanceof \think\Collection || $type instanceof \think\Paginator ) && $type->isEmpty())): ?>
				<li><a href="<?php echo url('Order/index'); ?>">订单列表</a></li>
			<?php endif; ?>
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
		             	<td style="width: 20%"><font>订单号：</font> <input readonly class="form-control" type="text" name="order[order_id]"
                                    value="<?php echo $order['order_id']; ?>" placeholder="订单号不给于修改"/></td>
			            <td style="width: 25%"><font>商家ID：</font> <input readonly class="form-control" type="text" name="order[seller_id]"
                                    value="<?php echo $order['seller_id']; ?>" placeholder="商家ID不给于修改"/></td>   
			            <td style="width: 25%"><font>用户ID：</font> <input readonly class="form-control" type="text" name="order[user_id]"
                                    value="<?php echo $order['user_id']; ?>" placeholder="用户ID不给于修改"/></td>  			            
			            <td style="width: 30%"><font>下单时间：</font> <input class="form-control js-bootstrap-datetime" type="text" name="order[order_time]" value="<?php echo date('Y-m-d H:i:s',$order['order_time']); ?>" readonly></td>
			        </tr>  
			        <tr>  			   
			        	<td><font>订单类型：</font>
							<select class="form-control" name="order[order_class]" readonly>
								<?php if(is_array($order_class) || $order_class instanceof \think\Collection || $order_class instanceof \think\Paginator): if( count($order_class)==0 ) : echo "" ;else: foreach($order_class as $key=>$vo): ?>
									<option value="<?php echo $key; ?>"  <?php if($key == $order['order_class']): ?>selected<?php endif; ?> ><?php echo $vo; ?></option>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
			        	</td>  
			        	<td><font>支付状态：</font>

			        		<select class="form-control" name="order[pay]" readonly>
			        			<?php if(is_array($pay) || $pay instanceof \think\Collection || $pay instanceof \think\Paginator): if( count($pay)==0 ) : echo "" ;else: foreach($pay as $key=>$vo): ?>
									<option value="<?php echo $key; ?>" <?php if($order['pay'] == $key): ?>selected<?php endif; ?> ><?php echo $vo; ?></option>
					        	<?php endforeach; endif; else: echo "" ;endif; ?>                             
                            </select>
			        	</td>   
			            <td><font>订单状况：</font>
			            	<?php if(is_array($order_complete) || $order_complete instanceof \think\Collection || $order_complete instanceof \think\Paginator): if( count($order_complete)==0 ) : echo "" ;else: foreach($order_complete as $key=>$vo): ?>
								<input type="radio" readonly name="order[order_complete]" value="<?php echo $key; ?>" <?php if($order['order_complete'] == $key): ?>checked<?php endif; ?> ><?php echo $vo; endforeach; endif; else: echo "" ;endif; ?> 
						</td>		
						<?php if($order['order_class'] != 4): ?>
						<td><font>餐桌ID：</font> <input class="form-control" type="number" readonly  value="<?php echo $order['table_id']; ?>"  placeholder="没有使用就不填"></td>
						<?php else: ?>
						<td><font>订单价格：</font> <input class="form-control" type="text" name="order[order_price]" value="<?php echo $order['order_price']; ?>" id="allPrice"></td>
						<?php endif; ?>           
			            <!-- <td>优惠劵ID：<input class="form-control" type="text" name="order[coupon_id]" <?php if($order['coupon_id'] == 0): else: ?>value=""<?php endif; ?> placeholder="没有使用就不填"></td>  -->
			        </tr>

					<tr>
						<input type="hidden" name="order[table_id]" value="<?php echo $order['table_id']; ?>">
						<td><font>服务厅：</font> <?php echo $order['name']; ?></td>
						<td><font>餐桌类型：</font> <?php echo $order['table_name']; ?></td>
						<td><font>桌号：</font> 第<?php echo $order['tb_id']; ?>桌</td>
						<td><font>支付方式：</font>
							<select class="form-control valid" name="order[pay_class]" aria-invalid="false">
								<?php if(is_array($pay_class) || $pay_class instanceof \think\Collection || $pay_class instanceof \think\Paginator): if( count($pay_class)==0 ) : echo "" ;else: foreach($pay_class as $key=>$vo): ?>
									<option value="<?php echo $key; ?>" <?php if($order['pay_class'] == $key): ?>selected<?php endif; ?> ><?php echo $vo; ?></option>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><font>优惠券金额：</font> ￥ <?php echo $order['coupon']; ?> 元</td>
						<td><font>折扣：</font> <?php echo $order['price_discount']; ?> 折</td>
						<td><font>应收金额：</font> ￥<?php echo $order['order_price']; ?> 元</td>
						<td><font>实际已收金额：</font> ￥<?php echo $order['price_receipts']; ?> 元</td>
					</tr>
			        <tr>  
			            <td colspan="2">
			            	<font>用户评价：</font>
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
                    	<?php if($order['order_class'] != 4): ?>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#xg" onclick="getTdValue()">修改</button>
                        <?php else: ?>
                    	<button type="submit" class="btn btn-primary"  >修改</button>
                    	<?php endif; ?>
                        <a class="btn btn-default" href="javaScript:history.go(-1)">返回</a>
                        <!-- <?php echo empty($type)?url('order/index'):'javaScript:history.go(-1)'; ?> -->
                    </div>
                </div>            
            </div>
            <?php if(!empty($data)): ?>
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
				    		<?php if(is_array($food) || $food instanceof \think\Collection || $food instanceof \think\Paginator): if( count($food)==0 ) : echo "" ;else: foreach($food as $key=>$vo): ?>
					  		<tr>
					  			<td><?php echo $data[$vo['id']]['food_name']; ?></td>
					  			<td>
					  				<input class="form-control" type="number" name="food[<?php echo $vo['id']; ?>]" value="<?php echo $vo['nub']; ?>">
                                </td>
                                <td><input readonly class="form-control" type="number"  min="1"  value="<?php echo $data[$vo['id']]['price']; ?>" name="price"></td>
					  			<td><input  type="button" class="btn btn-default" value="删除" onclick="res(this)"></td>
					  		</tr>	  		
					  		<?php endforeach; endif; else: echo "" ;endif; ?>
						</table>					
				  	</div>
				  	<div class="panel-footer"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
					  添加
						</button>
					</div>
				</div>           	
            </div>
        	<?php endif; ?>
            <div class="modal fade" id="xg" tabindex="-1" role="dialog" aria-labelledby="xdlLabel">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
	      			<div class="modal-header">
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        		<h4 class="modal-title" id="xdLabel">价格确认</h4>
		      		</div>
		      		<div class="modal-body">
		      			<?php if($order['order_class'] != 4): ?>
			        	总共消费:<input type="text" readonly class="form-control" id="price" name="order[order_price]">
			        	<?php endif; ?>
	  				</div>
		      		<div class="modal-footer">
		        		<button type="submit" class="btn btn-primary js-ajax-submit" >修改</button>
		        		<button type="button" class="btn btn-default" data-dismiss="modal">在想想</button>
	      			</div>
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
                bootbox.prompt("请输入权限密码", function (result) {
                    if(result==password){
                        var row = obj.parentNode.parentNode; //标签所在行
                        var tb = row.parentNode; //当前表格
                        var rowIndex = row.rowIndex; //A标签所在行下标
                        tb.deleteRow(rowIndex); //删除当前行
                        all_price();
                    }else{
                        if(result!=null && result!=undefined && result!=''){
                            bootbox.setLocale("zh_CN");
                            bootbox.alert('密码不正确')
                        }
                    }

                });
            }


            //请求子集数据
            function ajaxChildren(parent_id) {
                $.post(
                    "<?php echo url('foodmenu/getAllChild'); ?>",
                    {'parent_id':parent_id},
                    function (msg) {
                        takeMenuChild(msg)
                    },
                    'json');
            }


			/*获取菜单信息*/
            function ajaxToGet(formdata) {
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


            function yz()
            {
                val=document.getElementById("order_class").value;
                if(val==1 || val == 4)
                {
                    document.getElementById('delivery_n').style.display="none";
                    document.getElementById('reserve_s').style.display="none";
                    document.getElementById('reserve_a').style.display="none";
                }
                if(val==2)
                {
                    document.getElementById('delivery_n').style.display="";
                    document.getElementById('reserve_s').style.display="none";
                    document.getElementById('reserve_a').style.display="none";
                }
                if(val==3)
                {
                    document.getElementById('delivery_n').style.display="none";
                    document.getElementById('reserve_s').style.display="";
                    document.getElementById('reserve_a').style.display="";
                }
            }
		</script>
</body>
</html>