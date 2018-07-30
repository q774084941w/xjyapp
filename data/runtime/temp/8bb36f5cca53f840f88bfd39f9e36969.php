<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:55:"themes/admin_simpleboot3/admin\report\admin_report.html";i:1511832089;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
    <script src="__STATIC__/js/echarts/echarts.min.js"></script>
</head>
<body>
    <div class="well margin-top-20" style="height:780px">
    	<div class="col-md-6">
    		<div class="panel panel-info">
		  		<div class="panel-heading">销量统计(左图：系统商家总数；中图：月销售占比率；右图：本月销售额)</div>
			  	<div class="panel-body">
			    	<div class="media">
				  		<div id="sell_price" style="height:600px;"></div>
					</div>
			  	</div>
			</div>
    	</div> 
    	<div class="col-md-6">
    		<div class="panel panel-info">
		  		<div class="panel-heading">月销售量统计</div>
			  	<div class="panel-body">
			    	<div class="media">
				  		<div id="month_sales" style="height:600px;"></div>
					</div>
			  	</div>
			</div>
    	</div>    	
    </div> 
	<div><script src="__STATIC__/js/admin.js"></script></div>
</body>
<script type="text/javascript">
	var myChart = echarts.init(document.getElementById('sell_price'));
	
	option = {
	    backgroundColor: 'rgba(255,255,255,0)',
	    tooltip : {
	        formatter: "{a} <br/>{c} {b}"
	    },
	    
	    series : [
	        {
	            name: '月销售占总销量比率',
	            type: 'gauge',
	            z: 3,
	            min: 0,
	            max: 100,
	            splitNumber: 10,
	            radius: '50%',
	            axisLine: {            // 坐标轴线
	                lineStyle: {       // 属性lineStyle控制线条样式
	                    width: 10
	                }
	            },
	            axisTick: {            // 坐标轴小标记
	                length: 15,        // 属性length控制线长
	                lineStyle: {       // 属性lineStyle控制线条样式
	                    color: 'auto'
	                }
	            },
	            splitLine: {           // 分隔线
	                length: 20,         // 属性length控制线长
	                lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
	                    color: 'auto'
	                }
	            },
	            title : {
	                textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
	                    fontWeight: 'bolder',
	                    fontSize: 20,
	                    fontStyle: 'italic'
	                }
	            },
	            detail : {
	                textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
	                    fontWeight: 'bolder'
	                }
	            },
	            data:[{value: <?php echo floor($data/$sell_price*10000)/100; ?>, name: '占比率（%）'}]
	        },
	        {
	            name: '商家人数统计(个)',
	            type: 'gauge',
	            center: ['22%', '55%'],    // 默认全局居中
	            radius: '35%',
	            min:0,
	            max:400,
	            endAngle:45,
	            splitNumber:8,
	            axisLine: {            // 坐标轴线
	                lineStyle: {       // 属性lineStyle控制线条样式
	                    width: 8
	                }
	            },
	            axisTick: {            // 坐标轴小标记
	                length:12,        // 属性length控制线长
	                lineStyle: {       // 属性lineStyle控制线条样式
	                    color: 'auto'
	                }
	            },
	            splitLine: {           // 分隔线
	                length:20,         // 属性length控制线长
	                lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
	                    color: 'auto'
	                }
	            },
	            pointer: {
	                width:5
	            },
	            title: {
	                offsetCenter: [0, '-30%'],       // x, y，单位px
	            },
	            detail: {
	                textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
	                    fontWeight: 'bolder'
	                }
	            },
	            data:[{value: <?php echo $seller_count; ?>, name: '个'}]
	        },
	         {
	            name: '当月销售额(万元)',
	            type: 'gauge',
	            center: ['79%', '55%'],    // 默认全局居中
	            radius: '35%',
	            min:0,
	            max:40,
	            startAngle:140,
	            endAngle:-45,
	            splitNumber:8,
	            axisLine: {            // 坐标轴线
	                lineStyle: {       // 属性lineStyle控制线条样式
	                    width: 8
	                }
	            },
	            axisTick: {            // 坐标轴小标记
	                length:12,        // 属性length控制线长
	                lineStyle: {       // 属性lineStyle控制线条样式
	                    color: 'auto'
	                }
	            },
	            splitLine: {           // 分隔线
	                length:20,         // 属性length控制线长
	                lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
	                    color: 'auto'
	                }
	            },
	            pointer: {
	                width:5
	            },
	            title: {
	                offsetCenter: [0, '-30%'],       // x, y，单位px
	            },
	            detail: {
	                textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
	                    fontWeight: 'bolder'
	                }
	            },
	            data:[{value: <?php echo $data/10000; ?>, name: '万元'}]
	        }
	    ]
	};

	setInterval(function (){
	    option.series[0].data[0].value = (Math.random()*100).toFixed(2) - 0;
	    option.series[1].data[0].value = (Math.random()*7).toFixed(2) - 0;
	    option.series[2].data[0].value = (Math.random()*2).toFixed(2) - 0;

	},2000);

	myChart.setOption(option);

</script>

<script type="text/javascript">
	var month = echarts.init(document.getElementById('month_sales'));
	
	option1 = {
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
            data: <?php echo $rq; ?>,
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
            max: 40,
            interval: 5,
            axisLabel: {
                formatter: '{value} 万元'
            }
        },
        {
            type: 'value',
            name: '销售量',
            min: 0,
            max: 8,
            interval: 1,
            axisLabel: {
                formatter: '{value} 万份'
            }
        }
    ],
    series: [
        {
            name:'月销售',
            type:'bar',
            data:<?php echo $xs; ?>
        },
        {
            name:'月销量',
            type:'line',
            yAxisIndex: 1,
            data:<?php echo $xl; ?>
        }
    ]
};

	month.setOption(option1);

</script>
</html>