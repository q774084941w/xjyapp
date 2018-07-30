<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:52:"themes/admin_simpleboot3/user\admin_oauth\index.html";i:1528098198;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
        <li class="active"><a>会员管理</a></li>
    </ul>
    <form class="well form-inline margin-top-20" method="post" action="<?php echo url('AdminOauth/index'); ?>">
        昵称:
        <input type="text" class="form-control" name="nickname" style="width: 120px;" value="<?php echo input('request.nickname'); ?>" placeholder="请输入昵称">
        真实姓名:
        <input type="text" class="form-control" name="real_name" style="width: 120px;" value="<?php echo input('request.real_name'); ?>" placeholder="请输入真实姓名">
        手机号码:
        <input type="text" class="form-control" name="mobile" style="width: 120px;" value="<?php echo input('request.mobile'); ?>" placeholder="请输入手机号码">
        会员号:
        <input type="text" class="form-control" name="card_number" style="width: 120px;" value="<?php echo input('request.card_number'); ?>" placeholder="请输入会员号">

        <input type="submit" class="btn btn-primary" value="搜索" />
        <a class="btn btn-danger" href="<?php echo url('AdminOauth/index'); ?>">清空</a>
        <span style="float: right">
             <a class="btn btn-danger" href="javaScript:" id="refund">错误充值</a>
        </span>
    </form>

    <form method="post" class="js-ajax-form margin-top-20">
        <table class="table table-hover table-bordered">
            <thead>
            <tr class="success">
                <th>序号</th>
                <th><?php echo lang('USER_FROM'); ?></th>
                <th><?php echo lang('AVATAR'); ?></th>
                <th>用户昵称</th>
                <th>真实姓名</th>
                <th>手机号码</th>
                <th>持有卡片</th>
                <th>积分</th>
                 <th align="center"><?php echo lang('ACTIONS'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$vo): ?>
                <tr style="background-color: <?php echo $vo['status']==1?'':'rgba(235,235,231,0.44)'; ?>" >
                    <td><?php echo $key+1; ?></td>
                    <td><?php echo $vo['union_id']; ?></td>
                    <td><img width="25" height="25" src="<?php echo $vo['avatarUrl']; ?>"/></td>
                    <td><?php echo $vo['nickname']; ?></td>
                    <td><?php echo $vo['real_name']; ?></td>
                    <td><?php echo $vo['mobile']; ?></td>
                    <td><?php echo $vo['card_number']; ?></td>
                    <td><?php echo $vo['score']; ?></td>
                     <td>
                        <a href="<?php echo url('adminOauth/details',array('id'=>$vo['id'])); ?>" >详情</a>

                         <?php switch($vo['status']): case "0": ?>
                                 <a href="<?php echo url('adminOauth/ban',array('id'=>$vo['id'],'val'=>1)); ?>" class="js-ajax-dialog-btn" data-msg="确认恢复">恢复</a>
                             <?php break; default: ?>
                                 <a href="javaScript:" name='addOne' >新加卡片</a>
                                 <a href="javaScript:" name='Recharge' >充值</a>
                                 <a href="<?php echo url('adminOauth/ban',array('id'=>$vo['id'],'val'=>0)); ?>" class="js-ajax-dialog-btn" data-msg="确认拉黑">拉黑</a>
                             </default>
                         <?php endswitch; ?>

                    </td>
                    <input type="hidden" value="<?php echo $vo['user_id']; ?>">
                    <input type="hidden" value="<?php echo $vo['id']; ?>">
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <ul class="pagination"><?php echo $page; ?></ul>
    </form>
</div>

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
                    id="">新加会员卡号</h4>

            </div>

            <form action="<?php echo url('user/adminOauth/addLevel'); ?>" method="post" class="js-ajax-form">
                <input type="hidden" name="add[user_id]" id="user_id">
                <div class="modal-body">
                    <div class="form-group">

                        <label >会员卡号</label>

                        <input type="text"
                               name="add[card_no]"
                               class="form-control"
                               id="card_no"
                               placeholder="请输入会员卡上的编号"  required>

                    </div>
                    <div class="form-group">

                        <label>会员等级</label>
                        <select name="add[user_lv]" class="form-control" id="user_lv" >
                            <?php if(is_array($level) || $level instanceof \think\Collection || $level instanceof \think\Paginator): if( count($level)==0 ) : echo "" ;else: foreach($level as $key=>$vo): ?>
                                <option value="<?php echo $vo['id']; ?>"><?php echo $vo['grade_name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>

                    <div class="form-group">

                        <label >备注</label>

                        <input type="text"
                               name="add[remark]"
                               class="form-control"
                               id="remark"
                               placeholder="备注" >

                    </div>
                    <div class="form-group">

                        <label >会员卡内置卡号</label>

                        <input type="text"
                               name="add[card_number]"
                               class="form-control"
                               id="card_number"
                               placeholder="请不要手动输入，使用读卡器读取" required>

                    </div>
                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-default"  data-dismiss="modal">
                        关闭</button>
                    <button type="submit"  class="btn btn-primary js-ajax-submit">添加</button>
                </div>

            </form>


        </div>

    </div>

</div>
<!--添加页面-->

<!--充值页面-->
<div class="modal fade"  id="Recharge"
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

                <h4 class="modal-title">充值</h4>

            </div>

            <form action="<?php echo url('user/adminOauth/user_RMB'); ?>" method="post" class="js-ajax-form">
                <input type="hidden" name="id" id="third_id">
                <div class="modal-body">

                    <div class="form-group">
                        <label>所持有卡片</label>
                        <select name="card_id" id="user_card"  class="form-control" required>
                            <option value="">你还未拥有任何卡片</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label>账号余额</label>
                        <input type="text"
                               class="form-control"
                               id="user_RMB"
                               placeholder="账号余额"
                               value=""
                               readonly>

                    </div>
                    <div class="form-group">

                        <label>充值金额</label>
                        <input type="text"
                               class="form-control"
                               name="number"
                               placeholder="充值金额" required>
                    </div>
                    <div class="form-group">

                        <label>充值密码</label>
                        <input type="password"
                               class="form-control"
                               name="harge"
                               placeholder="充值密码" required>
                    </div>
                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-default"  data-dismiss="modal">
                        关闭</button>
                    <button type="submit" class="btn btn-primary js-ajax-submit">充值</button>
                </div>

            </form>


        </div>

    </div>

</div>
<!--充值页面-->

<!--充值页面-->
<div class="modal fade"  id="theRefund"

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

                <h4 class="modal-title">错误充值回退</h4>

            </div>

            <form action="<?php echo url('user/adminOauth/refund'); ?>" method="post" >

                <div class="modal-body">
                    <div class="form-group">

                        <label >会员卡号</label>

                        <input type="text"
                               name="card_no"
                               class="form-control"
                               placeholder="请输入会员卡上的编号"  required>

                    </div>
                    <div class="form-group">

                        <label >会员卡内置卡号</label>

                        <input type="text"
                               name="card_number"
                               class="form-control"
                               placeholder="请不要手动输入，使用读卡器读取" required>

                    </div>

                    <div class="form-group">

                        <label>充值密码</label>
                        <input type="password"
                               class="form-control"
                               name="harge"
                               placeholder="充值密码" required>
                    </div>
                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-default"  data-dismiss="modal">
                        关闭</button>
                    <button type="submit" class="btn btn-primary" >查找</button>
                </div>

            </form>


        </div>

    </div>

</div>
<!--充值页面-->

<script src="__STATIC__/js/admin.js"></script>
<script>
    /*添加页面*/
    $("[name='addOne']").click(function () {
        $('#user_id').val($(this).parent().next().val());
        $('#myModal').modal();
    });
    var cardMore = '';
    /*充值页面*/
    $("[name='Recharge']").click(function () {
        var user_id  = $(this).parent().next().val();
        $.post("<?php echo url('AdminOauth/myCard'); ?>",{'user_id':user_id},function (msg) {
            cardMore=msg;
                if(msg!=null && msg!=undefined && msg!=''){
                    var user_card = $('#user_card');
                    user_card.empty();
                    user_card.append(" <option value=''>请选择</option>");
                    $(msg).each(function () {
                        user_card.append(" <option value='"+this.id+"'>"+this.card_no+"</option>");
                    })
                }

        },'json');
        $('#third_id').val(user_id);
        $('#user_RMB').val(0);
        $('#Recharge').modal();

    });
    /*查看当前卡的余额*/
    $('#user_card').on('change',function () {
        var val = $(this).val();
        $(cardMore).each(function () {
           if(this.id==val){
               $('#user_RMB').val(this.user_RMB);
           }
        })
    });

    /*充值回退*/
    $('#refund').click(function () {
        $('#theRefund').find('input').val('');
        $('#theRefund').modal();
    })
</script>
</body>
</html>