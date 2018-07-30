<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:53:"themes/admin_simpleboot3/admin\seller\selleredit.html";i:1527649498;s:43:"themes/admin_simpleboot3/public\header.html";i:1511766886;}*/ ?>
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
<!-- <script type="text/html" id="files-item-tpl">
    <li id="saved-file{id}">
        <input id="file-{id}" type="hidden" name="file_urls[]" value="{filepath}">
        <input class="form-control" id="file-{id}-name" type="text" name="file_names[]" value="{name}"
               style="width: 200px;" title="文件名称">
        <a id="file-{id}-preview" href="{preview_url}" target="_blank">下载</a>
        <a href="javascript:uploadOne('图片上传','#file-{id}','file');">替换</a>
        <a href="javascript:(function(){$('#saved-file{id}').remove();})();">移除</a>
    </li>
</script> -->
</head>
<body>
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<?php if(session('ADMIN_ID') == 1): ?>
            <li><a href="<?php echo url('Seller/index'); ?>">商家管理</a></li>
            <?php endif; ?>
            <li><a href="<?php echo url('Seller/sellerDetailed',array('id'=>$data['id'])); ?>">详细信息</a></li>
			<li class="active"><a href="#">信息管理</a></li>
		</ul>
		<form action="<?php echo url('Seller/sellerEditPost',array('id'=>$data['id'])); ?>" method="post" class="form-horizontal js-ajax-form margin-top-20">   <!-- js-ajax-form -->
        <div class="row">
            <div class="col-md-9">
                <table class="table table-bordered">
                    <tr>
                        <th width="100">店名<span class="form-required">*</span></th>
                        <td colspan="4">
                        <input class="form-control" type="text" name="post[seller_nickname]" id="keywords" required value="<?php echo $data['seller_nickname']; ?>"
                                   placeholder="请输入商家点名">
                        </td>
                    </tr>
                    <tr>
                        <th>地址<span class="form-required">*</span></th> 
                        <td>
                            <input class="form-control" type="text" name="post[seller_address]"
                                   id="title" required value="<?php echo $data['seller_address']; ?>" placeholder="请输入地址"/>
                        </td>
                        <th  width="8%">
                           <a href="javascript:show_child();">获取坐标</a> 
                        </th>
                        <td width="20%">
                            <input class="form-control" type="text" name="post[seller_lng]"
                                   id="lng" readonly value="<?php echo $data['seller_lng']; ?>" placeholder="经度"/>
                        </td>
                        <td width="20%">
                            <input class="form-control" type="text" name="post[seller_lat]"
                                   id="lat" readonly value="<?php echo $data['seller_lat']; ?>" placeholder="纬度"/>
                        </td>
                    </tr>
                    <tr>
                        <th>手机号<span class="form-required"></span></th>
                        <td colspan="4">
                            <input class="form-control" type="text" name="post[seller_tel]"
                                   id="title" value="<?php echo $data['seller_tel']; ?>" placeholder="请输入手机号"/>
                        </td>
                    </tr>
                    <tr>
                        <th>运营时间<span class="form-required"></span></th>
                        <td colspan="1">
                            <input class="form-control"  style="width:300px;" type="text" name="post[seller_time_start]"
                                   value="<?php echo $data['seller_time_start']; ?>" placeholder="请输入开始时间">
                            <span class="form-required">开始营业时间</span>
                        </td>
                        <td colspan="3">
                            <input class="form-control"  style="width:300px;" type="text" name="post[seller_time_end]"
                                   value="<?php echo $data['seller_time_end']; ?>" placeholder="请输入结束时间">
                            <span class="form-required">结束营业时间</span>
                        </td>
                    </tr>
                    <tr>
                        <th>满额配送<span class="form-required"></span></th>
                        <td colspan="4">
                            <input class="form-control" type="text" name="post[takeout_max]"
                                   id="title" required value="<?php echo $data['takeout_max']; ?>" placeholder="请输入所需金额"/>
                        </td>
                    </tr>
                    <tr>
                        <th>预定桌数</th>
                        <td colspan="4">
                            <input class="form-control" type="text" name="post[table]" id="keywords" value="<?php echo $data['table']; ?>"
                                   placeholder="输入可预订的桌数">
                        </td>
                    </tr>
                    <tr>
                        <th>商家描述</th>
                        <td colspan="4">
                            <input class="form-control" type="text" id="content" value="<?php echo $data['seller_introduce']; ?>" name="post[seller_introduce]" placeholder="输入商家的描述"></input>
                        </td>
                    </tr>
                    <tr>
                        <th>商家AppID</th>
                        <td colspan="4">
                            <input class="form-control" type="text" id="post[appid]" value="<?php echo $data['appid']; ?>" name="post[appid]" placeholder="输入商家微信唯一标识appid">
                        </td>
                    </tr> 
                    <tr>
                        <th>广告幻灯片</th>
                        <td colspan="4">
                            <ul id="photos" class="pic-list list-unstyled form-inline">
                                <?php if(!(empty($data['advet']) || (($data['advet'] instanceof \think\Collection || $data['advet'] instanceof \think\Paginator ) && $data['advet']->isEmpty()))): if(is_array($data['advet']) || $data['advet'] instanceof \think\Collection || $data['advet'] instanceof \think\Paginator): if( count($data['advet'])==0 ) : echo "" ;else: foreach($data['advet'] as $key=>$vo): $img_url=cmf_get_image_preview_url($vo); ?>
                                        <li id="saved-image<?php echo $key; ?>">
                                            <input id="photo-<?php echo $key; ?>" type="hidden" name="photo_urls[]"
                                                   value="<?php echo $vo; ?>">
                                            <img id="photo-<?php echo $key; ?>-preview"
                                                 src="<?php echo cmf_get_image_preview_url($vo); ?>"
                                                 style="height:36px;width: 36px;"
                                                 onclick="parent.imagePreviewDialog(this.src);">
                                            <a href="javascript:uploadOneImage('图片上传','#photo-<?php echo $key; ?>');">替换</a>
                                            <a href="javascript:(function(){$('#saved-image<?php echo $key; ?>').remove();})();">移除</a>
                                        </li>
                                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                            </ul>
                            <a href="javascript:uploadMultiImage('图片上传','#photos','photos-item-tpl');" id="zs"
                               class="btn btn-default btn-sm">选择图片</a>
                        </td>
                    </tr>
                    <!-- <tr>
                        <th>商家环境</th>
                        <td>
                            <ul id="photos" class="pic-list list-unstyled form-inline"></ul>
                            <a href="javascript:uploadMultiImage('图片上传','#photos','photos-item-tpl');"
                               class="btn btn-default btn-sm">选择图片</a>
                        </td>
                    </tr> -->
                    <!-- <tr>
                        <th>附件</th>
                        <td>
                            <ul id="files" class="pic-list list-unstyled form-inline">
                            </ul>
                            <a href="javascript:uploadMultiFile('附件上传','#files','files-item-tpl');"
                               class="btn btn-sm btn-default">选择文件</a>
                        </td>
                    </tr> -->
                </table>
                <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-12">
                        <button type="submit" class="btn btn-primary js-ajax-submit">修改</button>
                        <a class="btn btn-default" href="<?php echo url('Seller/index'); ?>">返回</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <table class="table table-bordered">
                    <tr>
                        <th><b>商家LOGO</b></th>
                    </tr>
                    <tr>
                        <td>
                            <div style="text-align: center;">
                                <input type="hidden" name="post[seller_logo]" id="thumbnail" value="<?php echo $data['seller_logo']; ?>">
                                <a href="javascript:uploadOneImage('图片上传','#thumbnail');">
                                    <img src="<?php if(empty($data['seller_logo'])): ?>__TMPL__/public/assets/images/default-thumbnail.png<?php else: ?><?php echo cmf_get_image_preview_url($data['seller_logo']); endif; ?>" id="thumbnail-preview" width="135" style="cursor: pointer"/>
                                </a>
                                <input type="button" class="btn btn-sm btn-cancel-thumbnail" value="取消图片">
                            </div>
                        </td>
                    </tr>
                    <?php if(session('ADMIN_ID') == 1): ?>
                    <tr>
                        <th><b>注册时间</b></th>
                    </tr>                  
                    <tr>
                        <td>
                            <input class="form-control  js-bootstrap-datetime"  type="text" name="post[create_time]"
                                   value="<?php echo date('Y-m-d H:i:s',$data['create_time']); ?>">
                        </td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <th><b>配送方式</b></th>
                    </tr>
                    <tr>
                        <td>
                            <select class="form-control" name="post[seller_type]">
                              <option <?php if($data['seller_type']==0): ?>selected = 'selected'<?php endif; ?> value ="0">外卖+点餐</option>
                              <option <?php if($data['seller_type']==1): ?>selected = 'selected'<?php endif; ?> value ="1">点餐</option>
                              <option <?php if($data['seller_type']==2): ?>selected = 'selected'<?php endif; ?> value ="2">外卖</option>
                            </select>
                        </td>
                    </tr>
                        <th>商家状态</th>
                    </tr>
                    <tr>
                        <td>
                            <select <?php if(session('ADMIN_ID') != 1): ?>readonly<?php endif; ?> class="form-control" name="post[seller_status]" id="more-template-select">
                                <option <?php if($data['seller_status']==0): ?> selected = 'selected'<?php endif; ?> value="0">禁用</option>
                                <option <?php if($data['seller_status']==1): ?>selected = 'selected'<?php endif; ?> value="1">正常</option>
                                <option <?php if($data['seller_status']==2): ?>selected = 'selected'<?php endif; ?> value="2">未验证</option>
                                
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
	</div>
	<script type="text/javascript" src="__STATIC__/js/admin.js"></script>
	<script type="text/javascript">
	    //编辑器路径定义
	    var editorURL = GV.WEB_ROOT;
	</script>
	<script type="text/javascript" src="__STATIC__/js/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" src="__STATIC__/js/ueditor/ueditor.all.min.js"></script>
	<script type="text/javascript">
	    $(function () {

	        editorcontent = new baidu.editor.ui.Editor();
	        editorcontent.render('content');
	        try {
	            editorcontent.sync();
	        } catch (err) {
	        }

	        $('.btn-cancel-thumbnail').click(function () {
	            $('#thumbnail-preview').attr('src', '__TMPL__/public/assets/images/default-thumbnail.png');
	            $('#thumbnail').val('');
	        });

            $("#thumbnail-preview").popover({title: '<b>注释</b>', content: "上传商品LOGO主图，如多规格值时将默认使用该图或分规格上传各规格主图；支持jpg、gif、png格式上传或从图片空间中选择，建议使用<b style='color:red'>尺寸50x50像素以上、大小不超过200KB的正方形图片,图片过大将加载过慢</b>，上传后的图片将会自动保存在图片空间的默认分类中。",trigger: 'hover',placement:'left',html: 'true'});

            $("#zs").popover({title: '<b>注释</b>', content: "1.最多可上传4张图片，超过4张将提示错误。<br />2. 图片质量要清晰，不能虚化，要保证亮度充足。<br />3.图片排序按照从上倒下展示，上面的图片靠前展示。<br />4. 请使用jpg、\jpeg、\png等格式、单张大小不超过500KB的正方形图片,图片过大将加载过慢。",trigger: 'hover',html: 'true'});

	    });
	</script>
</body>
</html>