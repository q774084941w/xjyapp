<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:54:"themes/admin_simpleboot3/user\admin_oauth\details.html";i:1527845000;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
            <li><a href="<?php echo url('adminOauth/index'); ?>"><?php echo lang('USER_OAUTHADMIN_INDEX'); ?></a></li>
			<li class="active"><a href="#">详细信息</a></li>
		</ul>
        <?php 
            $type = array(1=>'正常',2=>'冻结',);
         ?>
		<form action="" method="post" class="form-horizontal js-ajax-form margin-top-20">   <!-- js-ajax-form -->
        <div class="row">
            <div class="col-md-3">
                <table class="table table-bordered">
                    <tr>
                        <th><b>用户头像</b></th>
                    </tr>
                    <tr>
                        <td>
                            <div style="text-align: center;">
                                <input type="hidden" name="post[avatarUrl]" id="avatarUrl" value="<?php echo $avatarUrl; ?>">
                                <img src="<?php echo empty($avatarUrl)?'__TMPL__/public/assets/images/default-thumbnail.png':$avatarUrl; ?>"
                                     id="thumbnail-preview" width="135" style="cursor: pointer"/>

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><b>用户昵称</b></th>
                    </tr>
                    <tr>
                        <td>
                            <input class="form-control" readonly type="text"  value="<?php echo $nickname; ?>">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-9">
                <table class="table table-bordered">
                    <tr>
                        <th>真实姓名</th>
                        <td>
                            <input class="form-control" readonly type="text"
                                    required value="<?php echo empty($real_name)?'':$real_name; ?>" />
                        </td>
                        <th>
                           性别
                        </th>
                        <td>
                            <?php $allSex = array('保密','男','女'); ?>
                            <input class="form-control" type="text"
                                    readonly value="<?php echo empty($sex)?'':$allSex[$sex]; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th>生日</th>
                        <td>
                            <input class="form-control" readonly type="text"
                                    required value="<?php echo empty($birthday)?'':date('Y-m-d',$birthday); ?>" />
                        </td>
                        <th>积分</th>
                        <td>
                            <input class="form-control" type="text"
                                    readonly value="<?php echo $score; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th>用户状态</th>
                        <td>
                            <?php $userStatus = array('禁用','正常','未验证'); ?>
                            <input class="form-control" readonly type="text" value="<?php echo $userStatus[$user_status]; ?>">
                        </td>
                        <th><b>注册时间</b></th>
                        <td>
                            <input class="form-control" readonly type="text" value="<?php echo date('Y-m-d H:i:s',$create_time); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>手机号<span class="form-required"></span></th>
                        <td>
                            <input class="form-control" readonly type="text"
                                    value="<?php echo $mobile; ?>" />
                        </td>
                        <th>邮箱<span class="form-required"></span></th>
                        <td>
                            <input class="form-control" readonly type="text"
                                    required value="<?php echo $user_email; ?>" />
                        </td>
                    </tr>
                    <!--<tr>
                       <th>用户优惠劵<span class="form-required"></span></th>
                       <td>
                           <input class="form-control" readonly type="text"
                                   value="<?php echo $coupon; ?>" />
                       </td>
                       <th>金币<span class="form-required"></span></th>
                       <td>
                           <input class="form-control" readonly type="text"
                                   required value="<?php echo $coin; ?>" />
                       </td>
                   </tr>-->
                    <tr>
                        <th>用户所在地区<span class="form-required"></span></th>
                        <td colspan="3">
                            <input class="form-control" readonly type="text"
                                    value="<?php echo $user_address; ?>" />
                        </td>

                    </tr>
                    <tr>
                        <th>个性签名<span class="form-required"></span></th>
                        <td colspan="3">
                            <input class="form-control" readonly type="text"
                                   required value="<?php echo $signature; ?>" />
                        </td>
                    </tr>

                </table>
                <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-10">
                        <a class="btn btn-default" href="<?php echo url('adminOauth/edit',array('id'=>$edit_id)); ?>">修改信息</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered">
                    <tr class="success">
                        <th>序号</th>
                        <th>会员卡号</th>
                        <th>内置卡号</th>
                        <th>等级</th>
                        <th>折扣</th>
                        <th>余额</th>
                        <th width="13%">注册时间</th>
                        <th>备注</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    <?php if(!(empty($user_card) || (($user_card instanceof \think\Collection || $user_card instanceof \think\Paginator ) && $user_card->isEmpty()))): if(is_array($user_card) || $user_card instanceof \think\Collection || $user_card instanceof \think\Paginator): if( count($user_card)==0 ) : echo "" ;else: foreach($user_card as $key=>$vo): ?>
                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo $vo['card_no']; ?></td>
                                <td><?php echo $vo['card_number']; ?></td>
                                <td><?php echo $vo['grade_name']; ?></td>
                                <td><?php echo $vo['discount']; ?>%</td>
                                <td><?php echo $vo['user_RMB']; ?></td>
                                <td><?php echo empty($vo['card_time'])?'':date('Y-m-d H:i:s',$vo['card_time']); ?></td>
                                <td><?php echo $vo['remark']; ?></td>
                                <td><?php echo $type[$vo['type']]; ?></td>
                                <td>
                                    <a href="javaScript:" name='addOne' >修改</a>
                                    <a href="javaScript:" name='Recharge' >充值</a>
                                </td>
                                <input type="hidden" value="<?php echo $vo['id']; ?>">
                                <input type="hidden" value="<?php echo $vo['user_lv']; ?>">
                                <input type="hidden" value="<?php echo $vo['type']; ?>">
                                <input type="hidden" value="<?php echo $vo['user_id']; ?>">
                            </tr>
                        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                </table>
                <ul class="pagination"><?php echo $page; ?></ul>
            </div>
        </div>
    </form>
	</div>
    <!--修改页面-->
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
                        id="">修改</h4>

                </div>

                <form action="<?php echo url('user/adminOauth/changeLevel'); ?>" method="post" class="js-ajax-form">
                    <input type="hidden" name="id" id="card_id">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="modal-body">
                        <div class="form-group">

                            <label >会员卡号</label>

                            <input type="text"
                                   name="edit[card_no]"
                                   class="form-control"
                                   id="card_no"
                                   required>

                        </div>
                        <div class="form-group">

                            <label >会员卡内置卡号</label>

                            <input type="text"
                                   name="edit[card_number]"
                                   class="form-control"
                                   id="card_number"
                                   required>

                        </div>
                        <div class="form-group">

                            <label>状态</label>
                            <select name="edit[type]" class="form-control" id="type" >
                                <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): if( count($type)==0 ) : echo "" ;else: foreach($type as $key=>$vo): ?>
                                    <option value="<?php echo $key; ?>"><?php echo $vo; ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>

                        <div class="form-group">

                            <label >备注</label>

                            <input type="text"
                                   name="edit[remark]"
                                   class="form-control"
                                   id="remark"
                                   placeholder="备注" >

                        </div>
                        <div class="form-group">

                            <label>会员等级</label>
                            <select name="edit[user_lv]" class="form-control" id="user_lv" >
                                <?php if(is_array($level) || $level instanceof \think\Collection || $level instanceof \think\Paginator): if( count($level)==0 ) : echo "" ;else: foreach($level as $key=>$vo): ?>
                                    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['grade_name']; ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">

                        <button type="button"
                                class="btn btn-default"  data-dismiss="modal">
                            关闭</button>
                        <button type="submit" class="btn btn-primary js-ajax-submit">修改</button>
                    </div>

                </form>


            </div>

        </div>

    </div>
    <!--修改页面-->

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

                    <h4 class="modal-title"></h4>

                </div>

                <form action="<?php echo url('user/adminOauth/user_RMB'); ?>" method="post" class="js-ajax-form">
                    <input type="hidden" name="card_id" id="third_id">
                    <div class="modal-body">
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

    <script src="__STATIC__/js/admin.js"></script>
    <script>
        /*修改页面*/
        $("[name='addOne']").click(function () {
            var children = $(this).parent().parent().children();
            var user_lv_id  = $(this).parent().next().next().val();
            var type_id     = $(this).parent().next().next().next().val();
            $('#card_no').val(children.eq(1).text());
            $('#card_number').val(children.eq(2).text());
            $('#remark').val(children.eq(7).text());
            var user_lv  =  $('#user_lv').children();
            user_lv.each(function () {
                $(this).removeAttr("selected");
            });
            user_lv.eq(user_lv_id-1).attr('selected','selected');
            $('#type').children().eq(type_id-1).attr('selected','selected');
            $('#card_id').val($(this).parent().next().val());
            $('#user_id').val($(this).parent().next().next().next().next().val());
            $('#myModal').modal();
        });
        /*充值页面*/
        $("[name='Recharge']").click(function () {
            $('#user_RMB').val($(this).parent().parent().children().eq(5).text());
            var user_id  = $(this).parent().next().val();
            $('#third_id').val(user_id);
            $('#Recharge').modal();
        });
    </script>
</body>
</html>