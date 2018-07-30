<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:51:"themes/admin_simpleboot3/user\admin_oauth\edit.html";i:1527819894;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
<style type="text/css">
    .pic-list li {
        margin-bottom: 5px;
    }
</style>
<script type="text/html" id="photos-item-tpl">
    <li id="saved-image{id}">
        <input id="photo-{id}" type="hidden" name="photo_urls[]" value="{filepath}">

        <img id="photo-{id}-preview" src="{url}" style="height:36px;width: 36px;"
             onclick="imagePreviewDialog(this.src);">
        <a href="javascript:uploadOneImage('图片上传','#photo-{id}');">替换</a>
        <a href="javascript:(function(){$('#saved-image{id}').remove();})();">移除</a>
    </li>
</script>
<script>
    function show_child()
    {
        var iHeight =500;
        var iWidth =1000;
        //获得窗口的垂直位置
        var iTop = (window.screen.availHeight - 30 - iHeight) / 2;
        //获得窗口的水平位置
        var iLeft = (window.screen.availWidth - 10 - iWidth) / 2;
        var child=window .open("<?php echo url('Seller/map'); ?>","child",'height=' + iHeight + ',innerHeight=' + iHeight + ',width=' + iWidth + ',innerWidth=' + iWidth + ',top=' + iTop + ',left=' + iLeft + "status=yes,toolbar=no,menubar=no,location=no,resizable=no,scrollbars=no");
    }
</script>
<body>

	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
            <li><a href="<?php echo url('adminOauth/index'); ?>"><?php echo lang('USER_OAUTHADMIN_INDEX'); ?></a></li>
			<li class="active"><a href="#">修改个人信息</a></li>
		</ul>
		<form action="<?php echo url('adminOauth/edit'); ?>" method="post" class="form-horizontal js-ajax-form margin-top-20">   <!-- js-ajax-form -->
            <input type="hidden" name="id" value="<?php echo $user_id; ?>">
        <div class="row">
            <div class="col-md-3">
                <table class="table table-bordered">
                    <tr>
                        <th><b>用户头像</b></th>
                    </tr>
                    <tr>
                        <td>
                            <div style="text-align: center;">
                                <input type="hidden" name="third[avatarUrl]" id="thumbnail" value="<?php echo $avatarUrl; ?>">
                                <a href="javascript:uploadOneImage('图片上传','#thumbnail');">
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
                            <input class="form-control" type="text"  value="<?php echo $nickname; ?>" name="third[nickname]">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-9">
                <table class="table table-bordered">
                    <tr>
                        <th>真实姓名</th>
                        <td>
                            <input class="form-control" type="text"
                                     value="<?php echo empty($real_name)?'':$real_name; ?>" name="post[real_name]"/>
                        </td>
                        <th>
                           性别
                        </th>
                        <td>
                            <?php $allSex = array('保密','男','女'); ?>
                            <select name="post[sex]" class="form-control">
                                <?php if(is_array($allSex) || $allSex instanceof \think\Collection || $allSex instanceof \think\Paginator): if( count($allSex)==0 ) : echo "" ;else: foreach($allSex as $key=>$vo): ?>
                                    <option value="<?php echo $key; ?>" <?php echo $sex==$key?'selected':''; ?>><?php echo $vo; ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>生日</th>
                        <td>
                            <input class="form-control js-bootstrap-date" type="text"
                                   value="<?php echo empty($birthday)?'':date('Y-m-d',$birthday); ?>" name="post[birthday]"/>
                        </td>
                        <th>积分</th>
                        <td>
                            <input class="form-control" type="text"
                                   value="<?php echo $score; ?>" name="post[score]" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <th>用户状态</th>
                        <td>
                            <?php $userStatus = array('禁用','正常','未验证'); ?>
                            <select name="post[user_status]" class="form-control">
                                <?php if(is_array($userStatus) || $userStatus instanceof \think\Collection || $userStatus instanceof \think\Paginator): if( count($userStatus)==0 ) : echo "" ;else: foreach($userStatus as $key=>$vo): ?>
                                    <option value="<?php echo $key; ?>" <?php echo $user_status==$key?'selected':''; ?>><?php echo $vo; ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>

                            </select>
                        </td>
                        <th><b>注册时间</b></th>
                        <td>
                            <input class="form-control" type="text" value="<?php echo date('Y-m-d H:i:s',$create_time); ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>手机号<span class="form-required"></span></th>
                        <td>
                            <input class="form-control" type="text"
                                    value="<?php echo $mobile; ?>" name="post[mobile]"/>
                        </td>
                        <th>邮箱<span class="form-required"></span></th>
                        <td>
                            <input class="form-control" type="text"
                                   value="<?php echo $user_email; ?>" name="post[user_email]"/>
                        </td>
                    </tr>
                    <!--<tr>
                       <th>用户优惠劵<span class="form-required"></span></th>
                       <td>
                           <input class="form-control" type="text"
                                   value="<?php echo $coupon; ?>"  name="post[coupon]"/>
                       </td>
                       <th>金币<span class="form-required"></span></th>
                       <td>
                           <input class="form-control" type="text"
                                value="<?php echo $coin; ?>" name="post[coin]"/>
                       </td>
                   </tr>-->
                    <tr>
                        <th>用户所在地区<span class="form-required"></span></th>
                        <td colspan="3">
                            <input class="form-control" type="text"
                                    value="<?php echo $user_address; ?>" name="post[user_address]"/>
                        </td>

                    </tr>
                    <tr>
                        <th>个性签名<span class="form-required"></span></th>
                        <td colspan="3">
                            <input class="form-control" type="text"
                                  value="<?php echo $signature; ?>" name="post[signature]"/>
                        </td>
                    </tr>

                </table>
                <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-10">
                        <input class="btn btn-default js-ajax-submit" value="修改信息" type="submit">
                    </div>
                </div>
            </div>
        </div>
    </form>
	</div>
    <script type="text/javascript" src="__STATIC__/js/admin.js"></script>
</body>
</html>