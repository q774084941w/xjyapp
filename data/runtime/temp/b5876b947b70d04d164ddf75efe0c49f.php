<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:51:"themes/admin_simpleboot3/admin\inventory\index.html";i:1529486765;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
        <li class="active"><a href="">盘点</a></li>
        <li><a href="<?php echo url('Inventory/addNew'); ?>">新增盘点</a></li>
    </ul>
    <form class="well form-inline margin-top-20 js-ajax-form" method="post" action="<?php echo url('admin/trafficReport/index'); ?>">
        <?php 
            $whereTime = empty($whereTime)?'month':$whereTime;
         ?>
        <input type="hidden" name="time" value="<?php echo $whereTime; ?>">
        <div class="form-inline">
            <div class="form-group cy-mar-ver-s">
                <span class="cy-pad-hor-s">时间</span>
            </div>
            <div class="input-daterange input-group" >
                <input type="text" class="js-bootstrap-date form-control" name="Time"  value="<?php echo input('request.Time'); ?>" />
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
                    <th width="5%">排号</th>
                    <th width="5%">业务时间</th>
                    <th width="8%" align="left">单据编号</th>
                    <th width="8%">盘点状态</th>
                    <th width="8%">盘亏金额（元）</th>
                    <th width="8%">盘盈金额（元）</th>
                    <th width="8%">盘点人</th>
                    <th width="8%">备注</th>
                    <th width="8%">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($data) || (($data instanceof \think\Collection || $data instanceof \think\Paginator ) && $data->isEmpty())): ?>
                    <tr><td colspan="8" style="text-align: center">暂无数据</td></tr>
                    <?php else: 
                        $inven_type = array(1=>'有盈亏',2=>'无盈亏');
                     if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>
                        <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo date('Y-m-d',$vo['time']); ?></td>
                            <td><?php echo $vo['inven_number']; ?></td>
                            <td><?php echo $inven_type[$vo['inven_type']]; ?></td>
                            <td><?php echo $vo['deficit']; ?></td>
                            <td><?php echo $vo['profit']; ?></td>
                            <td><?php echo empty($vo['user_nickname'])?$vo['user_login']:$vo['user_nickname']; ?></td>
                            <td><?php echo $vo['remark']; ?></td>
                            <td>
                                <a href="<?php echo url('Inventory/details',array('inven_number'=>$vo['inven_number'])); ?>" class="btn btn-link">详情</a>
                                <!--<a href="">复制新增</a>-->
                                <a href="<?php echo url('Inventory/changeType',array('inven_id'=>$vo['inven_id'])); ?>" class="btn btn-link js-ajax-dialog-btn"  data-msg="确定作废！">作废</a>
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