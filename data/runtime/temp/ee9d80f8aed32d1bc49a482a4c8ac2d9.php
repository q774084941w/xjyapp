<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"themes/admin_simpleboot3/admin\traffic_report\index.html";i:1529411001;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a href="">进货统计</a></li>
        <li><a href="<?php echo url('trafficReport/Shipments'); ?>">出库统计</a></li>
        <li><a href="<?php echo url('trafficReport/alert'); ?>">库存报警</a></li>
        <li><a href="<?php echo url('trafficReport/Statistics'); ?>">库存统计</a></li>
    </ul>
    <form class="well form-inline margin-top-20 js-ajax-form" method="post" action="<?php echo url('admin/trafficReport/index'); ?>">
        <?php 
            $whereTime = empty($whereTime)?'today':$whereTime;
         ?>
        <input type="hidden" name="time" value="<?php echo $whereTime; ?>">
        <div class="form-inline">
            <div class="form-group cy-mar-ver-s">
                <?php if(!(empty($category) || (($category instanceof \think\Collection || $category instanceof \think\Paginator ) && $category->isEmpty()))): ?>
                    <select name="category"  class="form-control">
                        <option value="">分类查找</option>
                        <?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): if( count($category)==0 ) : echo "" ;else: foreach($category as $key=>$vo): ?>
                            <option value="<?php echo $vo['id']; ?>" <?php if(input('request.category') == $vo['id']): ?>selected<?php endif; ?>><?php echo $vo['name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                <?php endif; ?>
                <input class="form-control" type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>" placeholder="货品名称/拼音">
                <span class="cy-pad-hor-s">时间</span>
            </div>
            <div class="input-daterange input-group" id="datepicker">
                <input type="text" class="js-bootstrap-date form-control" name="beginTime" id="qBeginTime" value="<?php echo input('request.beginTime'); ?>" />
                <span class="input-group-addon">至</span>
                <input type="text" class="js-bootstrap-date form-control" name="endTime" id="qEndTime"  value="<?php echo input('request.endTime'); ?>"/>
            </div>
            <div class="form-group cy-mar-ver-s">
                <input type="submit" class="btn btn-success" value="搜索" />
            </div>
            <span style="float:right">
                <a class="btn btn-info" href="<?php echo url('trafficReport/index',array('time'=>'today')); ?>">今日</a>
                <a class="btn btn-info" href="<?php echo url('trafficReport/index',array('time'=>'yesterday')); ?>">昨天</a>
                <a class="btn btn-info" href="<?php echo url('trafficReport/index',array('time'=>'week')); ?>">本周</a>
                <a class="btn btn-info" href="<?php echo url('trafficReport/index',array('time'=>'month')); ?>">本月</a>
                <a class="btn btn-info" href="<?php echo url('trafficReport/index',array('time'=>'last month')); ?>">上个月</a>
            </span>
        </div>
    </form>
    <form method="post" class="margin-top-20">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th width="5%">排号</th>
                    <th width="5%">货品编号</th>
                    <th width="8%" align="left">货品名称</th>
                    <th width="5%" align="left">拼音码</th>
                    <th width="8%" align="left">分类</th>
                    <th width="8%">进货量</th>
                    <th width="8%">进货价</th>
                    <th width="8%">总计</th>
                    <th width="8%">零售价</th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($data)): if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>
                    <tr>
                        <td><?php echo $key+1; ?></td>
                        <td><?php echo $vo['traffic_number']; ?></td>
                        <td><?php echo $vo['name']; ?></td>
                        <td><?php echo $vo['pinyin']; ?></td>
                        <td><?php echo $vo['category_name']; ?></td>
                        <td class="before">
                            <a href="<?php echo url('trafficReport/detailed',array('tra_id'=>$vo['tra_id'],'type'=>1,'time'=>$whereTime)); ?>">
                                <?php echo $vo['all_num']; ?>
                            </a>
                        </td>
                        <td><?php echo $vo['buy_price']; ?></td>
                        <td><?php echo $vo['all_num']*$vo['buy_price']; ?></td>
                        <td><?php echo $vo['ret_price']; ?></td>
                    </tr>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="9" align="center"> 
                        <a href="<?php echo url('trafficReport/print1',$where); ?>" class="btn btn-danger">打印</a>
                    </td>
                </tr>
            </tfoot>
            <tfoot>
                <tr>
                    <td>合计：</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td id="all_before"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </form>
    <div class="col-xs-12"  style="text-align:center">
        <ul class="pagination"><?php if(!empty($page)): ?>
            <?php echo (isset($page) && ($page !== '')?$page:''); endif; ?></ul>
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
        $('.before').each(function () {
            all_before  += Number($(this).text());
            all_stock   += Number($(this).next().text());
            all_all_num += Number($(this).next().next().text());
        });
        var id = $('#all_before');
        id.text(all_before);
        id.next().text(all_stock);
        id.next().next().text(all_all_num);
    })


</script>
</body>
</html>