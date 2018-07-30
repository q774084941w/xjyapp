var myChart = echarts.init(document.getElementById('Daily_sales'));
var b    = null;
var strs = new Array();
var str  = new Array();
var c    = new Array();
var d    = new Array();
(function(){
    var xmlhttp;
    if (window.XMLHttpRequest)
    {
        //  IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
        xmlhttp=new XMLHttpRequest();
    }
    else
    {
        // IE6, IE5 浏览器执行代码
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            b = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET","Daily_sales",false);
    xmlhttp.send();
}()); 

strs=b.split(";"); //字符分割
for (i=0;i<strs.length-1 ;i++ ) 
{ 
    str[i]=strs[i].split(",");
}
for (i=0;i<str.length;i++ ) 
{ 
    c.push(str[i][0]);
    d.push(str[i][1]);
}
option = {
    title: {
        text: '订单数'
    },
    tooltip: {
        trigger: 'axis'
    },
    grid: {
        left: '3%',
        right: '1%',
        bottom: '3%',
        containLabel: true
    },
    toolbox: {
        feature: {
            saveAsImage: {}
        }
    },
    xAxis: {
        type: 'category',
        data: c
    },
    yAxis: {
        type: 'value'
    },
    series: [
        {
            name:'订单数',
            type:'line',
            step: 'start',
            data:d
        }
    ]
};

myChart.setOption(option);