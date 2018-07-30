<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:60:"themes/admin_simpleboot3/admin\traffic_report\lossindex.html";i:1528960172;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
        <li class="active"><a href="{}">商品报损记录</a></li>
        <li><a href="<?php echo url('admin/trafficReport/lossAdd'); ?>">商品报损添加</a></li>
    </ul>
    <form class="well form-inline margin-top-20 js-ajax-form" method="post" action="<?php echo url('admin/trafficReport/lossIndex'); ?>">

        <div class="form-inline">
            <div class="form-group cy-mar-ver-s">
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
        </div>
    </form>
    <form method="post" class="margin-top-20">
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="5%">报损人</th>
                <th width="8%" align="left">货品名称</th>
                <th width="8%" align="left">单价</th>
                <th width="8%">数量</th>
                <th width="8%">报损金额</th>
                <th width="8%" >报损原因</th>
                <th width="8%">时间</th>
                <th width="10%">备注</th>
                <th width="15%">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($data)): if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>
                    <tr>
                        <td><?php echo $vo['id']; ?></td>
                        <td><?php echo empty($vo['user_nickname'])?$vo['user_login']:$vo['user_nickname']; ?></td>
                        <td><?php echo $vo['goods_name']; ?></td>
                        <td><?php echo $vo['buy_price']; ?></td>
                        <td><?php echo $vo['tra_num']; ?></td>
                        <td><?php echo $vo['tra_num']*$vo['buy_price']; ?></td>
                        <td><?php echo $vo['reason']; ?></td>
                        <td><?php echo date('Y-m-d H:i:s',$vo['time']); ?></td>
                        <td><?php echo $vo['remark']; ?></td>
                        <td>
                            <a href="<?php echo url('admin/trafficReport/lossEdit',array('id'=>$vo['id'])); ?>" type="button" class="btn btn-link">修改</a>
                            <a href="<?php echo url('admin/trafficReport/lossDel',array('id'=>$vo['id'])); ?>" type="button" class="btn btn-link js-ajax-delete">删除</a>
                        </td>
                    </tr>
            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </tbody>
        </table>
    </form>
    <div class="col-xs-12"  style="text-align:center">
        <ul class="pagination"><?php if(!empty($page)): ?>
            <?php echo (isset($page) && ($page !== '')?$page:''); endif; ?></ul>
    </div>

</div>
<script src="__STATIC__/js/admin.js"></script>

</body>
</html>