<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:55:"themes/admin_simpleboot3/user\admin_oauth\recharge.html";i:1527848279;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
<div class="wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#">充值记录</a></li>
    </ul>
    <?php 
        $type = array(1=>'正常',2=>'被回退');
     ?>
    <form class="well form-inline margin-top-20" method="post" action="<?php echo url('AdminOauth/recharge'); ?>">
        <div class="form-inline">
            <div class="form-group cy-mar-ver-s">

                <!--<select class="form-control" name="user" style="width: 200px;">
                    <option value="">服务员</option>
                    <?php if(is_array($user) || $user instanceof \think\Collection || $user instanceof \think\Paginator): if( count($user)==0 ) : echo "" ;else: foreach($user as $key=>$vo): ?>
                        <option value="<?php echo $vo['id']; ?>" <?php if(input('request.user') == $vo['id']): ?>selected<?php endif; ?>><?php echo empty($vo['user_nickname'])?$vo['user_login']:$vo['user_nickname']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>-->
                <select class="form-control" name="type" style="width: 200px;">
                    <option value="">请选择状态</option>
                    <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): if( count($type)==0 ) : echo "" ;else: foreach($type as $key=>$vo): ?>
                        <option value="<?php echo $key; ?>" <?php if(input('request.type') == $key): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                <input class="form-control" type="text" name="user_keyword" style="width: 200px;" value="<?php echo input('request.user_keyword'); ?>" placeholder="请输入操作人员">
                <input class="form-control" type="text" name="men_keyword" style="width: 200px;" value="<?php echo input('request.men_keyword'); ?>" placeholder="请输入客户名">
                <span class="cy-pad-hor-s">时间</span>
            </div>
            <div class="input-daterange input-group" id="datepicker">
                <input type="text" class="js-bootstrap-date form-control" name="beginTime" id="qBeginTime" value="<?php echo input('request.beginTime'); ?>" />
                <span class="input-group-addon">至</span>
                <input type="text" class="js-bootstrap-date form-control" name="endTime" id="qEndTime"  value="<?php echo input('request.endTime'); ?>"/>
            </div>
            <div class="form-group cy-mar-ver-s">
                <input type="submit" class="btn btn-success" value="搜索" />
                <a class="btn btn-danger" href="<?php echo url('AdminOauth/recharge'); ?>">清空</a>
            </div>
        </div>
    </form>
    <form method="post" class="js-ajax-form margin-top-20">
        <table class="table table-hover table-bordered">
            <thead>
            <tr class="success">
                <th>序号</th>
                <th>操作人员</th>
                <th>客户</th>
                <th>充值卡号</th>
                <th>充值时间</th>
                <th>充值前金额</th>
                <th>充值金额</th>
                <th>充值后金额</th>
                <th>状态</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($data)): if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>
                    <tr>

                        <td><?php echo $key+1; ?></td>
                        <td><?php echo empty($vo['waiter_nickname'])?$vo['waiter_login']:$vo['waiter_nickname']; ?></td>
                        <td>
                            <a href="<?php echo url('adminOauth/details',array('id'=>$vo['third_id'])); ?>" >
                            <?php echo empty($vo['user_nickname'])?$vo['user_login']:$vo['user_nickname']; ?>
                            </a>
                        </td>
                        <td><?php echo $vo['card_no']; ?></td>
                        <td><?php echo date('Y-m-d H:i:s',$vo['time']); ?></td>
                        <td><?php echo $vo['before']; ?></td>
                        <td><?php echo $vo['amount']; ?></td>
                        <td><?php echo $vo['amount']+$vo['before']; ?></td>
                        <td><?php echo $type[$vo['type']]; ?></td>
                    </tr>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>

            </tbody>
        </table>
        <ul class="pagination"><?php echo $page; ?></ul>
    </form>
</div>
<div><script src="__STATIC__/js/admin.js"></script></div>
</body>
</html>