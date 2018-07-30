<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:57:"themes/admin_simpleboot3/user\admin_oauth\levelindex.html";i:1527331688;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
        <li class="active"><a href="<?php echo url('AdminOauth/levelIndex'); ?>">用户等级列表</a></li>
        <li><a id="addOne">新增等级</a></li>
    </ul>
    <form method="post" class="js-ajax-form margin-top-20">
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>等级名称</th>
                <th>优惠折扣</th>
                <th>是否积分</th>
                <!--需要添加属性请从这后面添加，否则请修改:修改的js方法-->
                 <th align="center"><?php echo lang('ACTIONS'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($data)): 
                    $level_type = array('否','是');
                 if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>
                    <tr>

                        <td><?php echo $vo['id']; ?></td>
                        <td><?php echo $vo['grade_name']; ?></td>
                        <td><?php echo $vo['discount']; ?></td>
                        <td><?php echo $level_type[$vo['level_type']]; ?></td>
                         <td>
                            <button class="btn btn-default" name="changeThis" type="button">修改</button>
                             <?php if($vo['id']!=1): ?>
                                 <a href="<?php echo url('user/adminOauth/levelDelete',array('id'=>$vo['id'])); ?>" class="btn btn-danger   js-ajax-delete">删除</a>
                             <?php endif; ?>

                        </td>
                    </tr>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>

            </tbody>
        </table>
        <ul class="pagination"><?php echo $page; ?></ul>
    </form>
</div>
<script src="__STATIC__/js/admin.js"></script>
<!--添加页面-->
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

                <h4 class="modal-title"
                    id="">新增等级</h4>

            </div>

            <form action="<?php echo url('user/adminOauth/levelAdd'); ?>" method="post" class="js-ajax-form">
                <div class="modal-body">
                    <div class="form-group">

                        <label for="grade_name">等级名称</label>

                        <input type="text"
                               name="add[grade_name]"
                               class="form-control"
                               placeholder="等级名称">

                    </div>
                    <div class="form-group">

                        <label for="discount">优惠折扣</label>

                        <input type="number"
                               name="add[discount]"
                               class="form-control"
                               min="0"
                               max="100"
                               placeholder="请填入整数，例如：80表示80%">

                    </div>
                    <div class="form-group">

                        <label for="level_type">是否积分</label>
                        <select name="add[level_type]" class="form-control">
                            <option value="0">否</option>
                            <option value="1" selected>是</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-default"  data-dismiss="modal">
                        关闭</button>
                    <input type="submit" value="新增" class="btn btn-primary js-ajax-submit">
                </div>

            </form>


        </div>

    </div>

</div>
<!--添加页面-->
<!--修改页面-->
<div class="modal fade"  id="changeModal"
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

                <h4 class="modal-title"
                    id="myModalLabel">修改等级</h4>

            </div>

            <form action="<?php echo url('user/adminOauth/levelEdit'); ?>" method="post" id="apply_form" class="js-ajax-form">
                <div class="modal-body">
                    <input type="hidden" name="edit[id]" id="editId">
                    <div class="form-group">

                        <label for="grade_name">等级名称</label>

                        <input type="text"
                               name="add[grade_name]"
                               class="form-control"
                               id="grade_name"
                               placeholder="等级名称">

                    </div>
                    <div class="form-group">

                        <label for="discount">优惠折扣</label>

                        <input type="number"
                               name="add[discount]"
                               class="form-control"
                               id="discount"
                               min="0"
                               max="100"
                               placeholder="请填入整数，例如：80表示80%">

                    </div>
                    <div class="form-group">

                        <label for="level_type">是否积分</label>
                        <select name="add[level_type]" id="level_type" class="form-control">
                            <option value="0">否</option>
                            <option value="1" selected>是</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-default"  data-dismiss="modal">
                        关闭</button>
                    <input type="submit" value="修改" class="btn btn-primary js-ajax-submit" id="submit">
                </div>

            </form>


        </div>

    </div>

</div>
<!--修改页面-->
<script>
    /*添加页面*/
    $("#addOne").click(function () {
        $('#myModal').modal();
    });
    /*修改页面*/
    $("[name='changeThis']").click(function () {
        var dic = $(this).parent().parent().children();
            $('#grade_name').val($(dic).eq(1).text());
            $('#discount').val($(dic).eq(2).text());
            $('#editId').val($(dic).eq(0).text());
            if($(dic).eq(3).text()=='否'){
                $('#level_type').children().eq(1).attr("selected", "");
                $('#level_type').children().eq(0).attr("selected", "selected");
            }
        $('#apply_id').val($(this).next().val());
        $('#changeModal').modal();

    });

</script>
</body>
</html>