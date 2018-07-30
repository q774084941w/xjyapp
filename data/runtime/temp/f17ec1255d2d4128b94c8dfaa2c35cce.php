<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:52:"themes/admin_simpleboot3/admin\inventory\addnew.html";i:1529639021;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
        <li  class="active"><a href="">新增盘点</a></li>
    </ul>
    <form method="post" class="margin-top-20" action="<?php echo url('Inventory/addNew'); ?>">
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
                    <input type="text" class=" form-control"  value="<?php echo $name; ?>" readonly />
                </div>
                <div class="form-group cy-mar-ver-s">
                    <span class="cy-pad-hor-s">业务日期：</span>
                </div>
                <div class="input-daterange input-group" style="margin-right: 10px">
                    <input readonly type="text" class="js-bootstrap-datetime form-control" value="<?php echo date('Y-m-d H:i:s'); ?>"  name="time"/>
                </div>
                <div class="form-group cy-mar-ver-s">
                    <span class="cy-pad-hor-s">单据编号：</span>
                </div>
                <div class="input-daterange input-group" style="margin-right: 10px">
                    <input readonly type="text" class=" form-control" value="<?php echo $number; ?>" name="number" />
                </div>
            </div>

        </div>
        <table class="table table-hover table-bordered margin-top-20">
            <thead>
                <tr>
                    <th width="5%">排号</th>
                    <th width="50%">货品名称</th>
                    <th width="8%" align="left">货品编号</th>
                    <th width="8%">账目数量</th>
                    <th width="8%">实际数量</th>
                    <th width="8%">备注（差异原因）</th>
                </tr>
            </thead>
            <tbody>
                <tr >
                    <td>1</td>
                    <td>
                        <span style="width: 80%;float: left;">
                        <input type="text" class=" form-control" name='tra_name[]' value='' readonly/>
                        </span>
                        <button type="button" class="btn btn-success " onclick="clickOneTo(this)" name="selectOne" style="float: right;margin-right: 20px">选择</button>
                    </td>
                    <td></td>
                    <td class="before"></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td>合计</td>
                    <td></td>
                    <td></td>
                    <td id="all_before"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>备注：</td>
                    <td colspan="4"><input type="text" name="remark" class="form-control"></td>
                    <td><button type="submit" class="btn btn-success ">保存</button></td>
                </tr>
            </tfoot>
        </table>
    </form>
    <div class="col-xs-12"  style="text-align:center">
        <ul class="pagination"><?php if(!empty($page)): ?>
            <?php echo (isset($page) && ($page !== '')?$page:''); endif; ?></ul>
    </div>

</div>


    <!--申请商品弹窗-->
    <div class="modal fade"  id="myModal"
         tabindex="-1"
         role="dialog"
         aria-labelledby="myModalLabel">

        <div class="modal-dialog"
             role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"><span
                            aria-hidden="true">×</span></button>

                    <h4 class="modal-title">选择商品</h4>
                    <form  class=" form-inline margin-top-20" id="seller_menu_form">

                        <select name="category" style="text-align: center" class="form-control" id="menu_parent_id">
                            <?php if(!(empty($category) || (($category instanceof \think\Collection || $category instanceof \think\Paginator ) && $category->isEmpty()))): ?>
                                <option value="">请选择系列</option>
                                <?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): if( count($category)==0 ) : echo "" ;else: foreach($category as $key=>$vo): ?>
                                    <option value="<?php echo $vo['id']; ?>" ><?php echo $vo['name']; ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </select>
                        <select name="child_id" style="text-align: center" class="form-control" id="menu_child_id">
                            <option value="">请选择类型</option>
                        </select>
                        <input class="form-control" type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>"
                               placeholder="菜名/拼音">
                        <button type="button" class="btn btn-success" id="submit_menu">搜索</button>
                    </form>
                </div>

                <form  method="post" id="apply_form" >
                    <div class="modal-body">
                        <table class="table table-hover table-bordered margin-top-20" id="seller_menu_table">

                        </table>
                    </div>

                    <div class="modal-footer">

                        <button type="button"
                                class="btn btn-default"  data-dismiss="modal">
                            关闭</button>
                        <button type="button"
                                class="btn btn-primary "  id="confirm">
                            确认
                        </button>

                    </div>

                </form>


            </div>

        </div>

    </div>
    <!--申请商品弹窗-->
    <script src="__STATIC__/js/admin.js"></script>
    <script type="text/javascript" src="__STATIC__/js/bootbox/bootbox.min.js"></script>
<script type="text/javascript" src="__TMPL__/public/assets/js/addNew.js"></script>
    <script>

        //请求子集数据
        function ajaxChildren(parent_id) {
            $.post(
                "<?php echo url('TrafficCategory/getAllChild'); ?>",
                {'parent_id':parent_id},
                function (msg) {
                    takeMenuChild(msg)
                },
                'json');
        }


        //获取库存数据
        function ajaxToPost(arr)
        {
            $.post(
                "<?php echo url('Inventory/getGoods'); ?>",
                {'data':arr},
                function (msg)
                {
                    stringtoIN(msg)
                },
                'json');

        }

        //提交表单查询数据
        function ajaxToGet(formdata)
        {
            $.ajax({
                    url		: "<?php echo url('SellerMenu/traffic'); ?>",
                    type	: 'post',
                    processData : false,
                    contentType : false,
                    dataType    :  'json',
                    data		:   formdata,
                    success 	:  function (msg) {
                        seller_menu_table(msg);
                        initTableCheckbox();
                    }
                }
            )
        }


    </script>
</body>
</html>