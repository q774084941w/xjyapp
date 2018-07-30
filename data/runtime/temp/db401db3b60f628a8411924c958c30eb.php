<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:46:"themes/admin_simpleboot3/admin\seller\map.html";i:1511766889;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp&key=2XNBZ-CBJRO-VZLW7-SL2AS-P7N42-RSBDU"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<title>获取坐标</title>
<style type="text/css">
*{
    margin:0px;
    padding:0px;
}
body, button, input, select, textarea {
    font: 12px/16px Verdana, Helvetica, Arial, sans-serif;
}
p{
    width:603px;
    padding-top:3px;
    overflow:hidden;
}
#container {
   min-width:603px;
   min-height:500px;
}
</style>

<script>
var init = function() {
    var map = new qq.maps.Map(document.getElementById("container"),{
        center: new qq.maps.LatLng(30.65711090271882, 104.06593322753906),
        zoom: 12,
        panControl: false,
        zoomControl: false,

    });
    //绑定单击事件添加参数
    qq.maps.event.addListener(map, 'click', function(event) {
        // alert('您点击的位置为: [' + event.latLng.getLat() + ', ' +
        // event.latLng.getLng() + ']');
        window .close();
        window .opener.document.getElementById("lat").value=event.latLng.getLat();
        window .opener.document.getElementById("lng").value=event.latLng.getLng();
        window .opener.document.getElementById("edit_lat").value=event.latLng.getLat();
        window .opener.document.getElementById("edit_lng").value=event.latLng.getLng();

    });

}
</script>
</head>
<body onload="init()">
<div id="container"></div>
</body>
</html>

