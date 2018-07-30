<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:48:"themes/admin_simpleboot3/admin\report\index.html";i:1528090880;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
<script src="__STATIC__/js/echarts/echarts.min.js">
</script>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- 引入 ECharts 文件 -->
</head>
<body>
    <div class="well margin-top-20" style="height:780px">
    	<div class="col-md-3">
    		<div class="panel panel-info">
			  	<div class="panel-heading">营收：</div>
		  		<div class="panel-body">
	    			<div class="media">
		  				<div class="media-body">
		    				<h4 class="media-heading">
								<span class="glyphicon glyphicon-jpy" aria-hidden="true">
									<?php echo empty($nub1)?0:$nub1; ?>&ensp;</span>元</h4>
		    				当日销售额
		  				</div>
					</div>
	  			</div>
			</div>
    	</div>
    	<div class="col-md-3">
    		<div class="panel panel-info">
			  	<div class="panel-heading">销量：</div>
			  	<div class="panel-body">
			    	<div class="media">
			 	 		<div class="media-body">
				    		<h4 class="media-heading">
								<span class="glyphicon glyphicon-list-alt" aria-hidden="true">
								<?php echo empty($count1)?0:$count1; ?>&ensp;</span>单</h4>
				    		当日销量
				  		</div>
					</div>
			  	</div>
			</div>
    	</div>
    	<div class="col-md-3">
    		<div class="panel panel-info">
		  		<div class="panel-heading">营收：</div>
			  	<div class="panel-body">
		   	 		<div class="media">
				  		<div class="media-body">
				    		<h4 class="media-heading">
								<span class="glyphicon glyphicon-jpy" aria-hidden="true">
									<?php echo empty($nub2)?0:$nub2; ?>&ensp;
								</span>元</h4>
				    		本月销售额
				  		</div>
					</div>
			  	</div>
			</div>
    	</div>
    	<div class="col-md-3">
    		<div class="panel panel-info">
		  		<div class="panel-heading">销量：</div>
			  	<div class="panel-body">
			    	<div class="media">
				  		<div class="media-body">
				    		<h4 class="media-heading">
								<span class="glyphicon glyphicon-list-alt" aria-hidden="true">
									<?php echo empty($count2)?0:$count2; ?>&ensp;
								</span>单</h4>
				   	 		当月销量
				  		</div>
					</div>
			  	</div>
			</div>
    	</div>
    	<div class="col-md-12">
    		<div class="panel panel-info">
				<div class="panel-heading">
					<form action="<?php echo url(); ?>" method="post"  class="form-inline panel-heading">

    <div class="form-inline">
        <div class="form-group cy-mar-ver-s">
			<span class="cy-pad-hor-s">门店：</span>
			<select name="menu" style="text-align: center" class="form-control">
				<?php if(!empty($menu[0])): ?>
					<option value="">全部</option>
					<?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): ?>
						<option value="<?php echo $vo['id']; ?>" <?php if(input('request.menu') == $vo['id']): ?> selected <?php endif; ?> ><?php echo $vo['name']; ?></option>
					<?php endforeach; endif; else: echo "" ;endif; else: ?>
					<option value="">没有</option>
				<?php endif; ?>
			</select>
            &ensp;  &ensp;<span class="cy-pad-hor-s">时间：</span>
        </div>
        <div class="input-daterange input-group" id="datepicker">
            <input type="text" class="js-bootstrap-datetime form-control" name="beginTime" id="qBeginTime" value="<?php echo input('request.beginTime'); ?>"/>
            <span class="input-group-addon">至</span>
            <input type="text" class="js-bootstrap-datetime form-control" name="endTime" id="qEndTime" value="<?php echo input('request.endTime'); ?>"/>
        </div>
<?php $type = input('request.type'); ?>
        <div class="form-group cy-mar-ver-s">
			<select name="type" id=""  class="form-control">
				<option value="1" <?php echo $type=='1'?'selected':''; ?>>小时</option>
				<option value="2" <?php echo $type=='2'?'selected':''; ?>>天</option>
				<option value="3" <?php echo $type=='3'?'selected':''; ?>>月</option>
			</select>
			<input type="submit" class="btn btn-success" value="搜索" />
			<a href="<?php echo url('Report/index'); ?>" class="btn btn-danger">清除</a>
        </div>
		<span style="float: right;font-size:20px;color: white;margin-right: 20px">
				销量：<?php echo empty($maxsheets)?0:$maxsheets; ?>单
			</span>
		<span style="float: right;font-size:20px;color: white;margin-right: 20px">
				金额：<?php echo empty($maxmoney)?0:$maxmoney; ?>元
			</span>
    </div>

					</form>

				</div>
			  	<div class="panel-body">
			    	<div class="media">
				  		<div id="Daily_sales" style="height:500px;"></div>
					</div>
			  	</div>
			</div>
    	</div>

    </div>

	<?php 
		$user_record = array(
		['今日',date('Y-m-d'),'data'=>$today],
		['本周',date('l'),'data'=>$week],
		['本月',date('F'),'data'=>$month]
		);
	 ?>
	<div class="well margin-top-20" style="height:280px">
		<?php if(is_array($user_record) || $user_record instanceof \think\Collection || $user_record instanceof \think\Paginator): if( count($user_record)==0 ) : echo "" ;else: foreach($user_record as $key=>$vo): ?>
			<div class="col-md-4">
				<div class="panel panel-info">
					<div class="panel-heading">
						<span><?php echo $vo[0]; ?></span> <span style="float: right"><?php echo $vo[1]; ?></span>
					</div>
					<div class="panel-body">
						<div class="media" style="text-align: center;line-height: inherit">
							<h4 class="media-heading">
						<span class="glyphicon glyphicon-jpy" aria-hidden="true" style="color: red">
							<?php echo array_sum($vo['data']); ?>
							元
						</span>
							</h4>
						</div>
					</div>
					<div class="panel-body">
						<table class="table table-striped" style="color:blue;">
							<tr>
								<th>微信：</th>
								<td>
									<?php echo empty($vo['data']['WeChat']) ? 0 : $vo['data']['WeChat']; ?>
									元
								</td>
								<th>支付宝：</th>
								<td>
									<?php echo empty($vo['data']['Alipay']) ? 0 : $vo['data']['Alipay']; ?>
									元
								</td>
							</tr>
							<tr>
								<th>银联：</th>
								<td>
									<?php echo empty($vo['data']['UnionPay']) ? 0 : $vo['data']['UnionPay']; ?>
									元
								</td>
								<th>现金：</th>
								<td>
									<?php echo empty($vo['data']['Cash']) ? 0 : $vo['data']['Cash']; ?>
									元
								</td>
							</tr>
							<tr>
								<th>vip卡：</th>
								<td>
									<?php echo empty($vo['data']['VIP_card']) ? 0 : $vo['data']['VIP_card']; ?>
									元
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		<?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
	<div><script src="__STATIC__/js/admin.js"></script></div>
</body>
<script type="text/javascript">
    var month = echarts.init(document.getElementById('Daily_sales'));

    option = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                crossStyle: {
                    color: '#999'
                }
            }
        },
        toolbox: {
            feature: {
                dataView: {show: true, readOnly: false},
                magicType: {show: true, type: ['line', 'bar']},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        legend: {
            data:['蒸发量','平均温度']
        },
        xAxis: [
            {
                type: 'category',
                data: <?php echo empty($drq)?0:$drq; ?>,/*<?php echo empty($drq)?0:$drq; ?>,*/
    axisPointer: {
        type: 'shadow'
    }
    }
    ],
    yAxis: [
        {
            type: 'value',
            name: '销售额',
            min: 0,
            max: <?php echo empty($maxmoney)?10:$maxmoney; ?>,
            interval: <?php echo empty($maxmoney)?1:($maxmoney/10); ?>,
            axisLabel: {
                formatter: '{value} 元'
            }
        },
        {
            type: 'value',
            name: '销售量',
            min: 0,
            max: <?php echo empty($maxsheets)?10:$maxsheets; ?>,
            interval: <?php echo empty($maxsheets)?1:($maxsheets/10); ?>,
            axisLabel: {
                formatter: '{value} 份'
            }
        }
    ],
        series: [
        {
            name:'日销售',
            type:'bar',
            data: <?php echo empty($dxs)?0:$dxs; ?>/*<?php echo empty($dxs)?0:$dxs; ?>*/
    },
    {
        name:'日销量',
            type:'line',
        yAxisIndex: 1,
        data: <?php echo empty($dxl)?0:$dxl; ?>,/*<?php echo empty($dxl)?0:$dxl; ?>*/
    }
    ]
    };

    month.setOption(option);

</script>

</html>