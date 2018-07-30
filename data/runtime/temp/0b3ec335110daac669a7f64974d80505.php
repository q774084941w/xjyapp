<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:53:"themes/admin_simpleboot3/admin\inventory\details.html";i:1529499023;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
        <li><a href="<?php echo url('Inventory/index'); ?>">盘点</a></li>
        <li ><a href="<?php echo url('Inventory/addNew'); ?>">新增盘点</a></li>
        <li  class="active"><a href="">盘点详情</a></li>
    </ul>
    <form method="post" class="margin-top-20" >
        <div class="margin-top-20">
            <h4 style="text-align: center">商品盘点单</h4>
        </div>
        <div class="form-inline" >
            <!--<select name="menu" style="text-align: center" class="form-control" id="menu_id">
                <?php if(!empty($menu[0])): ?>
                    <option value="" <?php echo $menu_id==""?"selected":""; ?>>请选择服务厅</option>
                    <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): ?>
                        <option value="<?php echo $vo['id']; ?>" <?php echo $menu_id==$vo['id']?"selected":""; ?>><?php echo $vo['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; else: ?>
                    <option value="">你还未建立服务厅，请在分类建立！</option>
                <?php endif; ?>
            </select>-->
            <div style="float:right;margin-bottom: 20px;">
                <div class="form-group cy-mar-ver-s">
                    <span class="cy-pad-hor-s">盘点人：</span>
                </div>
                <div class="input-daterange input-group" style="margin-right: 10px">
                    <input type="text" class=" form-control"  value="<?php echo empty($all['user_nickname'])?$all['user_login']:$all['user_nickname']; ?>" readonly />
                </div>
                <div class="form-group cy-mar-ver-s">
                    <span class="cy-pad-hor-s">业务日期：</span>
                </div>
                <div class="input-daterange input-group" style="margin-right: 10px">
                    <input readonly type="text" class="js-bootstrap-date form-control" value="<?php echo date('Y-m-d H:i:s',$all['time']); ?>"  name="time"/>
                </div>
                <div class="form-group cy-mar-ver-s">
                    <span class="cy-pad-hor-s">单据编号：</span>
                </div>
                <div class="input-daterange input-group" style="margin-right: 10px">
                    <input readonly type="text" class=" form-control" value="<?php echo $all['inven_number']; ?>" name="number" />
                </div>
            </div>

        </div>
        <table class="table table-hover table-bordered margin-top-20">
            <thead>
                <tr>
                    <th width="5%">排号</th>
                    <th width="10%">货品名称</th>
                    <th width="8%" align="left">货品编号</th>
                    <th width="8%">账目数量</th>
                    <th width="8%">实际数量</th>
                    <th width="8%">盘亏数量</th>
                    <th width="8%">盘亏金额</th>
                    <th width="8%">盘盈数量</th>
                    <th width="8%">盘盈金额</th>
                    <th width="8%">备注</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!(empty($data) || (($data instanceof \think\Collection || $data instanceof \think\Paginator ) && $data->isEmpty()))): if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): 
                            $profit = 0;
                            $deficit = 0;
                            if($vo['record']>$vo['actual']){
                            $profit = $vo['record']-$vo['actual'];
                            }
                            else
                            {
                            $deficit = $vo['actual']-$vo['record'];
                            }
                         ?>
                        <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $vo['name']; ?></td>
                            <td><?php echo $vo['traffic_number']; ?></td>
                            <td ><?php echo $vo['record']; ?></td>
                            <td><?php echo $vo['actual']; ?></td>
                            <td><?php echo $profit; ?></td>
                            <td class="before"><?php echo $profit*$vo['buy_price']; ?></td>
                            <td><?php echo $deficit; ?></td>
                            <td><?php echo $deficit*$vo['buy_price']; ?></td>
                            <td><?php echo $vo['why']; ?></td>
                        </tr>
                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>合计</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td id="all_before"><?php echo $all['deficit']; ?></td>
                    <td></td>
                    <td><?php echo $all['profit']; ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>备注：</td>
                    <td colspan="9"><?php echo $all['remark']; ?></td>

                </tr>
           <!-- <tr>
                <td><button  class="btn btn-success ">打印</button></td>
            </tr>-->
            </tfoot>
        </table>
    </form>
</div>

    <script src="__STATIC__/js/admin.js"></script>
    <script>

    </script>
</body>
</html>