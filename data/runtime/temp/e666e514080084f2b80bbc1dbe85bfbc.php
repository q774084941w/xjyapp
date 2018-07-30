<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:57:"themes/admin_simpleboot3/admin\traffic_report\print1.html";i:1529412007;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
	.fl{
		float: left;
	}
	.fr{
		float: right;
	}
	.clear{
		clear: both;
	}
	#content {	    
	    border: 1px solid #ddd;
   	    padding: 20px 20px 70px;
	}
	.tilete h3{
		text-align: center;
		padding: 10px 0;
		font-weight: 700;
		margin-top: -15px;
		margin-right: 300px;
	}
	.tilete p{
		font-size: 20px;
	}
	.tilete h3 font{
		margin-left: 25px;
	}
	.list_input label,
	.list_input label input{
		display: inline-block;		
	}
	.list_input label input{
		border: none;
		border-bottom: 1px solid #dce4ec;
	}
	.list_input label{
		width: 48%;
	}
	.list_input label input{
		width: 85%;
	}
	.list_input label font{
		/*width: 100px;*/
		display: inline-block;
	}
	.table-content{
		/*position: absolute;
	    top: 26%;
	    left: 26%;*/
	    height: 240px;
	    /*margin-top: -120px; */
	    /* negative half of the height */
	    width: 1050px;
	    height: 600px;
	    /*margin: 0;*/
	   	margin: auto;
	}
	table tr td,
	table tr th{
		text-align: center;
	}
</style>
</head>
<body>
	<?php 
		$dataname = '';
	 if(input('request.time')): if(input('request.time') == 'today'):  $dataname = '今日- 统计';  endif; if(input('request.time') == 'yesterday'):  $dataname = '昨日- 统计';  endif; if(input('request.time') == 'week'):  $dataname = '本周- 统计';  endif; if(input('request.time') == 'month'):  $dataname = '本月- 统计';  endif; if(input('request.time') == 'last month'):  $dataname = '上个月- 统计';  endif; else: if(!(empty($requests['beginTime']) || (($requests['beginTime'] instanceof \think\Collection || $requests['beginTime'] instanceof \think\Paginator ) && $requests['beginTime']->isEmpty()))): if((!empty($requests['beginTime'])) AND (!empty($requests['endTime']))):  $dataname = $requests['beginTime'].' - '.$requests['endTime']; else:  $dataname = $requests['beginTime'].' - 至今'; endif; else: if(!(empty($requests['endTime']) || (($requests['endTime'] instanceof \think\Collection || $requests['endTime'] instanceof \think\Paginator ) && $requests['endTime']->isEmpty()))):  $dataname = ' - '.$requests['endTime']; endif; endif; endif; ?>

<div class="wrap js-check-wrap table-content" >
	<div id="content" >
	    <form method="post" class="margin-top-20">
	    	<div class="tilete"> 
	    		<!-- <p class="fr">NO.JHD-20180615189</p> -->
				<h3 class="fr">川味印象  <font><?php echo $Report_name; ?></font></h3>
				<div class="clear"> </div>
	    	</div>
	    	<div>
	    		<div class="list_input">
	    			<label class="checkbox inline">
	    				<font>供  应  商：</font>
					  <input type="text" class="form-control" >
					</label>
					<label class="checkbox inline">
					  <font>日 &nbsp;&nbsp; 期：</font>
					  <input type="text" class="form-control" value="<?php echo date('Y-m-d'); ?>（<?php echo $dataname; ?>）" >
					</label>
	    		</div>
	    		<div class="list_input">
	    			<label class="checkbox inline">
	    			  <font> 地 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 址</font>：
					  <input type="text" class="form-control" >
					</label>
					<label class="checkbox inline">
					  <font>电 &nbsp;&nbsp; 话：</font>
					  <input type="text" class="form-control" >
					</label>
	    		</div>
	    	</div>
	        <table class="table table-hover table-bordered">
	            <thead>
	                <tr>
	                    <th width="5%">序号</th>
	                    <!-- <th width="5%">编号条码</th> -->
	                    <th width="8%"> 货品名称</th>
	                    <th width="5%" >拼音码</th>
	                    <th width="8%" >分类</th>
	                    <th width="8%">进货量</th>
	                    <th width="8%">进货价</th>
	                    <th width="8%" >零售价</th>
	                    <th width="8%" >合计金额</th>
	                </tr>
	            </thead>
	            <tbody>
	            <?php if(!empty($data)): if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>
	                    <tr>
	                        <td><?php echo $key+1; ?></td>
	                        <td><?php echo $vo['name']; ?></td>
	                        <td><?php echo $vo['pinyin']; ?></td>
	                        <td><?php echo $vo['category_name']; ?></td>
	                        <td class="before"><?php echo $vo['all_num']; ?></td>
	                        <td><?php echo $vo['buy_price']; ?></td>
	                        <td><?php echo $vo['ret_price']; ?></td>
	                        <td><?php echo $vo['buy_price']*$vo['all_num']; ?></td>
	                    </tr>
	                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
	            </tbody>
	            <tfoot>
	                <tr>
	                    <td colspan="4">合计：</td>
	                    <td id="all_before"></td>
	                    <td ></td>
	                    <td ></td>
	                    <td ></td>
	                </tr>
	            </tfoot>
	            
	        </table>

	        <div>
	        	<p style="text-align: right;margin-right: 100px; ">经手人：</p>
	        </div>
	    </form>
	</div>

	<div class="col-xs-12 pages"  style="text-align:center">
        <ul class="pagination"><?php if(!empty($page)): ?>
            <?php echo (isset($page) && ($page !== '')?$page:''); endif; ?></ul>
    </div>

	<div style="margin-top:20px;">
		<p style="text-align: center;">
			<a href="javascript:void(printPage())" class="btn btn-danger" id="printImg" >打印</a>
			<a href="javascript:history.back()"  class="btn btn-default">返回</a>
		</p>
	</div>
</div>

<script src="__STATIC__/js/admin.js"></script>
<script>
    $('#detailed').change(function () {
        var type = $(this).prop('checked');
        if(type){
            $(this).next().children().eq(0).attr('class','btn btn-danger')
        }else {
            $(this).next().children().eq(0).attr('class','btn btn-info')
        }
    });
    $(document).ready(function () {
        var all_before=0;
        var all_stock=0;
        var all_all_num=0;
        var z_all_all_num=0;
        $('.before').each(function () {
            all_before  += Number($(this).text());
            all_stock   += Number($(this).next().text());
            all_all_num += Number($(this).next().next().text());
            z_all_all_num += Number($(this).next().next().next().text());
        });
        var id = $('#all_before');
        id.text(all_before);
        id.next().text(all_stock);
        id.next().next().text(all_all_num);
        id.next().next().next().text(z_all_all_num);
    })

	function printPage()  
	{  
	    $("#printImg,.pages").hide();  
	    window.print();
	    $("#printImg,.pages").show();

	    return false;  
	} 

</script>
</body>
</html>