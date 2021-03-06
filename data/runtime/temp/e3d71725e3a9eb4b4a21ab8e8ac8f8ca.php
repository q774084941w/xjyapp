<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"D:\wwwroot\wx_cwyx\wwwroot\public/plugins/custom_admin_login/view/widget.html";i:1522745701;}*/ ?>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>小九云商务管理中心</title>
    <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge"/>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta name="robots" content="noindex,nofollow">
    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
    <link rel="icon" href="__ADMIN_TMPL__/public/assets/images/favicon.ico" type="image/x-icon">
    <link href="__ADMIN_TMPL__/public/assets/themes/<?php echo cmf_get_admin_style(); ?>/bootstrap.min.css" rel="stylesheet">
    <link href="__STATIC__/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="__ADMIN_TMPL__/public/assets/themes/<?php echo cmf_get_admin_style(); ?>/login.css" rel="stylesheet">
    <script>
        if (window.parent !== window.self) {
            document.write              = '';
            window.parent.location.href = window.self.location.href;
            setTimeout(function () {
                document.body.innerHTML = '';
            }, 0);
        }
    </script>
</head>
<body>
<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h3 class="text-center" style="padding-bottom: 20px;">小九云商务管理中心</h3>
                <form class="js-ajax-form" action="<?php echo url('admin/Public/doLogin'); ?>" method="post">
                    <div class="form-group">
                        <input type="text" id="input_username" class="form-control" name="username"
                               placeholder="<?php echo lang('USERNAME_OR_EMAIL'); ?>" title="<?php echo lang('USERNAME_OR_EMAIL'); ?>"
                               value="<?php echo cookie('admin_username'); ?>" data-rule-required="true" data-msg-required="">
                    </div>

                    <div class="form-group">
                        <input type="password" id="input_password" class="form-control" name="password"
                               placeholder="<?php echo lang('PASSWORD'); ?>" title="<?php echo lang('PASSWORD'); ?>" data-rule-required="true"
                               data-msg-required="">
                    </div>

                    <div class="form-group">
                        <div style="position: relative;">
                            <input type="text" name="captcha" placeholder="验证码" class="form-control captcha">
                            <?php $__CAPTCHA_SRC=url('/captcha/new').'?height=32&width=150&font_size=18'; ?>
<img src="<?php echo $__CAPTCHA_SRC; ?>" onclick="this.src='<?php echo $__CAPTCHA_SRC; ?>&time='+Math.random();" title="换一张" class="captcha captcha-img verify_img" style="cursor: pointer;position:absolute;right:1px;top:1px;"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="redirect" value="">
                        <button class="btn btn-primary btn-block js-ajax-submit" type="submit" style="margin-left: 0px"
                                data-loadingmsg="<?php echo lang('LOADING'); ?>">
                            <?php echo lang('LOGIN'); ?>
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    //全局变量
    var GV = {
        ROOT: "__ROOT__/",
        WEB_ROOT: "__WEB_ROOT__/",
        JS_ROOT: "static/js/",
        APP: ''/*当前应用名*/
    };
</script>
<script src="__STATIC__/js/jquery.js"></script>
<script src="__STATIC__/js/wind.js"></script>
<script src="__STATIC__/js/admin.js"></script>
<script>
    (function () {
        document.getElementById('input_username').focus();
    })();
</script>
</body>
</html>
