<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"themes/admin_simpleboot3/admin\main\index.html";i:1529057057;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
<?php function _get_system_widget($name){ switch($name): case "CmfHub": ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">交流方式</h3>
            </div>
            <div class="panel-body home-info">
                <ul class="list-unstyled">
                    <li><em>云九科技官网</em> <span><a href="http://www.ccapp.com.cn" target="_blank">www.ccapp.com.cn</a></span>
                    </li>
                    <li><em>联系电话</em> <span>028-68730190</span></li>
                    <li><em>技术支持QQ</em> <span>3289457575</span></li>
                    <li><em>商务QQ</em> <span>183199337</span></li>
                    <li><em>联系邮箱</em> <span>ccapp@ccapp.com.cn</span></li>
                </ul>
            </div>
        </div>
    <?php break; endswitch; } ?>

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
<style>
    .home-info li em {
        float: left;
        width: 120px;
        font-style: normal;
        font-weight: bold;
    }

    .home-info ul {
        padding: 0;
        margin: 0;
    }

    .panel {
        margin-bottom: 0;
    }

    .grid-sizer {
        width: 10%;
    }

    .grid-item {
        margin-bottom: 5px;
        padding: 5px;
    }

    .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
        padding-left: 5px;
        padding-right: 5px;
        float: none;
    }

    .MainContributors,
    .Contributors,
    .Custom1,
    .Custom2,
    .Custom3,
    .Custom4,
    .Custom5{
       display: none; 
    }

</style>
<?php 
    \think\Hook::listen('admin_before_head_end',$temp5b5c1bb5c86bd,null,false);
 ?>
</head>
<body>
<div class="wrap">
    <?php if(empty($has_smtp_setting) || (($has_smtp_setting instanceof \think\Collection || $has_smtp_setting instanceof \think\Paginator ) && $has_smtp_setting->isEmpty())): ?>
        <div class="grid-item col-md-12">
            <div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-bottom: 0;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>提示!</strong> 邮箱配置未完成,无法进行邮件发送!
                <a href="#" data-dismiss="alert" aria-label="Close"
                   onclick="parent.openapp('<?php echo url('Mailer/index'); ?>','admin_mailer_index','邮箱配置');">现在设置</a>
            </div>
        </div>
    <?php endif; if(!extension_loaded('fileinfo')): ?>
        <div class="grid-item col-md-12">
            <div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-bottom: 0;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>提示!</strong> php_fileinfo扩展没有开启，无法正常上传文件！
            </div>
        </div>
    <?php endif; ?>

    <div class="grid-item col-md-12" id="thinkcmf-notices-grid" style="display:none;">
        <div class="dashboard-box">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo lang('SYSTEM_NOTIFICATIONS'); ?></h3>
                </div>
                <div class="panel-body home-info">
                    <ul id="thinkcmf-notices" class="list-unstyled">
                        <li>
                            <img src="__TMPL__/public/assets/images/loading.gif" style="vertical-align: middle;"/>
                            <span style="display: inline-block; vertical-align: middle;">加载中...</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="home-grid">
        <!-- width of .grid-sizer used for columnWidth -->
        <div class="grid-sizer"></div>
        <?php if(is_array($dashboard_widgets) || $dashboard_widgets instanceof \think\Collection || $dashboard_widgets instanceof \think\Paginator): if( count($dashboard_widgets)==0 ) : echo "" ;else: foreach($dashboard_widgets as $key=>$vo): if($vo['is_system']): ?>
                <div class="grid-item col-md-12 <?php echo $vo['name']; ?>" data-system="1" data-widget="<?php echo $vo['name']; ?>">
                    <div class="dashboard-box"><?php echo _get_system_widget($vo['name']); ?></div>
                </div>
                <?php else: if(isset($dashboard_widget_plugins[$vo['name']])): ?>
                    <div class="grid-item col-md-<?php echo $dashboard_widget_plugins[$vo['name']]['width']; ?>" data-system="0"
                         data-widget="<?php echo $vo['name']; ?>">
                        <div class="dashboard-box"><?php echo $dashboard_widget_plugins[$vo['name']]['view']; ?></div>
                    </div>
                <?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<script src="__STATIC__/js/admin.js"></script>
<?php 
    $lang_set=defined('LANG_SET')?LANG_SET:'';
    $thinkcmf_version=defined('THINKCMF_VERSION')?THINKCMF_VERSION:'';
 ?>
<script>

    Wind.css('dragula');
    Wind.use('masonry', 'imagesloaded', 'dragula', function () {
        var $homeGrid = $('.home-grid').masonry({
            // set itemSelector so .grid-sizer is not used in layout
            itemSelector: '.grid-item',
            // use element for option
            columnWidth: '.grid-sizer',
            percentPosition: true,
            horizontalOrder: false,
            transitionDuration: 0
        });

        $homeGrid.masonry('on', 'layoutComplete', function (event, laidOutItems) {
        });


        $homeGrid.masonry();

        var containers = [];
        $('.home-grid .grid-item').each(function () {
            containers.push(this);
        });
        dragula(containers, {
            isContainer: function (el) {
                return false; // only elements in drake.containers will be taken into account
            },
            moves: function (el, source, handle, sibling) {
                return true; // elements are always draggable by default
            },
            accepts: function (el, target, source, sibling) {
                return true; // elements can be dropped in any of the `containers` by default
            },
            invalid: function (el, handle) {
                return false; // don't prevent any drags from initiating by default
            },
            direction: 'vertical',             // Y axis is considered when determining where an element would be dropped
            copy: false,                       // elements are moved by default, not copied
            copySortSource: false,             // elements in copy-source containers can be reordered
            revertOnSpill: false,              // spilling will put the element back where it was dragged from, if this is true
            removeOnSpill: false,              // spilling will `.remove` the element, if this is true
            mirrorContainer: document.body,    // set the element that gets mirror elements appended
            ignoreInputTextSelection: true     // allows users to select input text, see details below
        }).on('drop', function (el, target, source, sibling) {
            var $target          = $(target);
            var targetClasses    = $target.attr('class');
            var targetDataWidget = $target.data('widget');
            var targetDataSystem = $target.data('system');
            var $source          = $(source);
            var sourceClasses    = $source.attr('class');
            var sourceDataWidget = $source.data('widget');
            var sourceDataSystem = $source.data('system');
            $(source).append($(target).find('.dashboard-box').not('.gu-transit'));
            $(target).append(el);
            $target.attr('class', sourceClasses);
            $target.data('widget', sourceDataWidget);
            $target.data('system', sourceDataSystem);

            $source.attr('class', targetClasses);
            $source.data('widget', targetDataWidget);
            $source.data('system', targetDataSystem);
            $homeGrid.masonry();

            _widgetSort();
        }).on('shadow', function (el, container, source) {
            $homeGrid.masonry();
        });


    });

    function _widgetSort() {

        var widgets = [];
        $('.home-grid .grid-item').each(function () {
            var $this = $(this);

            widgets.push({
                name: $this.data('widget'),
                is_system: $this.data('system')
            });
        });

        $.ajax({
            url: "<?php echo url('main/dashboardWidget'); ?>",
            type: 'post',
            dataType: 'json',
            data: {widgets: widgets},
            success: function (data) {

            },
            error: function () {

            },
            complete: function () {

            }
        });
    }

    // //获取官方通知
    // $.getJSON("http://www.thinkcmf.com/service/sms_jsonp.php?lang=<?php echo $lang_set; ?>&v=<?php echo $thinkcmf_version; ?>&callback=?",
    //     function (data) {
    //         var tpl      = '<li><em class="title"></em><span class="content"></span></li>';
    //         var $notices = $("#thinkcmf-notices");
    //         $notices.empty();
    //         if (data.length > 0) {
    //             $('#thinkcmf-notices-grid').show();
    //             $.each(data, function (i, n) {
    //                 var $tpl = $(tpl);
    //                 $(".title", $tpl).html(n.title);
    //                 $(".content", $tpl).html(n.content);
    //                 $notices.append($tpl);
    //             });
    //         } else {
    //             $notices.append("<li>^_^,<?php echo lang('NO_NOTICE'); ?>~~</li>");
    //         }

    //     });
</script>
<?php 
    \think\Hook::listen('admin_before_body_end',$temp5b5c1bb5c86bd,null,false);
 ?>
</body>
</html>