/**
 * Created by Administrator on 2018/6/21.
 */
var allprice = 0;
$('#Scavenger_take').click(function () {
    $(this).css('background-color','#32e744');
    $('#Scavenger').focus();
});
$('#Scavenger').blur(function () {
    $('#Scavenger_take').css('background-color','#E74C3C');
});

$('[name="my_table_all_thing"]').click(function () {
    var order_id = $(this).next().val();
    details(order_id);
});



$('#xg').on('shown.bs.modal',function(e){
    $('#price').focus(); //通过ID找到对应输入框，让其获得焦点
});


$('#addOne').click(function () {
    $("input[type='checkbox']").attr('checked',false);
});

/*  支付方式选择*/
function backgroundcolor(a) {
    $(a).parent().parent().children().css('background-color','');
    $(a).parent().css('background-color','#e9e67e');
}




//计算价格
function typeToClear(a)
{
    var all = 0;
    var val      = parseInt($(a).val());

    $('input[name="checkItem[]"]').each(function () {
        var oldOne = $(this).val();
        var type   = $(this).prop('checked');
        if	(oldOne!=undefined && oldOne!=null && oldOne!='')
        {
            oldOne     = oldOne.split(',');
            var price  = oldOne[0]*oldOne[1];
            if (type && val && val>=10 && val<=100)
            {
                all += price*(val/100);
            }
            else
            { 
                all += price;
            }
        }
        
    });

    all = parseFloat(all).toFixed(2);
    allprice = all;
    $("[name='order[order_price]']").val(all);
    $("#Surplus").text(all);

    CouponsSubtract("[name='Coupons']");
    //二次验证密码
    /*var thisOne = $(a).parent().next().children();
    thisOne.eq(1).val('');
    thisOne.eq(0).attr('class','btn btn-danger');*/
}

/*再次验证*/
$('[name="go_back_to"]').click(function () {
    $('#go_back_to_this_one').css('display','')
});

function discountThis()
{
    var discount = $('#discount');
    typeToClear(discount);
}

/*打折全选框*/
function initTableCheckbox()
{
    var $thr = $('#foodList thead tr');
    var $checkAllTh = $('<th><input type="checkbox" id="checkAll" name="checkAll" onchange="discountThis()" /></th>');
    /*将全选/反选复选框添加到表头最前，即增加一列*/
    $thr.prepend($checkAllTh);
    /*“全选/反选”复选框*/
    var $checkAll = $thr.find('input');
    $checkAll.click(function(event){
        /*将所有行的选中状态设成全选框的选中状态*/
        $tbr.find('input').prop('checked',$(this).prop('checked'));
        /*并调整所有选中行的CSS样式*/
        if ($(this).prop('checked')) {
            $tbr.find('input').parent().parent().addClass('warning');
        } else{
            $tbr.find('input').parent().parent().removeClass('warning');
        }
        /*阻止向上冒泡，以防再次触发点击操作*/
        event.stopPropagation();
    });
    /*点击全选框所在单元格时也触发全选框的点击操作*/
    $checkAllTh.click(function(){
        $(this).find('input').click();
    });
    var $tbr = $('#foodList tbody tr');
    var $checkItemTd = $('<td><input type="checkbox" name="checkItem[]" onclick="discountThis()"/></td>');
    /*每一行都在最前面插入一个选中复选框的单元格*/
    $tbr.prepend($checkItemTd);
    /*点击每一行的选中复选框时*/
    $tbr.find('input').click(function(event){
        /*调整选中行的CSS样式*/
        $(this).parent().parent().toggleClass('warning');
        /*如果已经被选中行的行数等于表格的数据行数，将全选框设为选中状态，否则设为未选中状态*/
        $checkAll.prop('checked',$tbr.find('input:checked').length == $tbr.length ? true : false);
        /*阻止向上冒泡，以防再次触发点击操作*/
        event.stopPropagation();
    });
    /*点击每一行时也触发该行的选中操作*/
    $tbr.click(function(){
        $(this).find('input').click();
    });
}

/*初始化加菜*/
$(document).ready(function ()
{
    ajaxToGet(0)
});

/*加菜全选框*/
function initTableCheckbox2()
{
    var $thr = $('#seller_menu_table thead tr');
    var $checkAllTh = $('<th><input type="checkbox" id="checkAll" name="checkAll" /></th>');
    /*将全选/反选复选框添加到表头最前，即增加一列*/
    $thr.prepend($checkAllTh);
    /*“全选/反选”复选框*/
    var $checkAll = $thr.find('input');
    $checkAll.click(function(event){
        /*将所有行的选中状态设成全选框的选中状态*/
        $tbr.find('input').prop('checked',$(this).prop('checked'));
        /*并调整所有选中行的CSS样式*/
        if ($(this).prop('checked')) {
            $tbr.find('input').parent().parent().addClass('warning');
        } else{
            $tbr.find('input').parent().parent().removeClass('warning');
        }
        /*阻止向上冒泡，以防再次触发点击操作*/
        event.stopPropagation();
    });
    /*点击全选框所在单元格时也触发全选框的点击操作*/
    $checkAllTh.click(function(){
        $(this).find('input').click();
    });
    var $tbr = $('#seller_menu_table tbody tr');
    var $checkItemTd = $('<td><input type="checkbox" name="food[]" /></td>');
    /*每一行都在最前面插入一个选中复选框的单元格*/
    $tbr.prepend($checkItemTd);
    /*点击每一行的选中复选框时*/
    $tbr.find('input').click(function(event){
        /*调整选中行的CSS样式*/
        $(this).parent().parent().toggleClass('warning');
        /*如果已经被选中行的行数等于表格的数据行数，将全选框设为选中状态，否则设为未选中状态*/
        $checkAll.prop('checked',$tbr.find('input:checked').length == $tbr.length ? true : false);
        /*阻止向上冒泡，以防再次触发点击操作*/
        event.stopPropagation();
    });
    /*点击每一行时也触发该行的选中操作*/
    $tbr.click(function(){
        $(this).find('input').click();
    });
}

/*填写数据菜单*/
function seller_menu_table(msg)
{
    var seller_menu_table = $('#seller_menu_table');
    seller_menu_table.empty();

    seller_menu_table.append("<thead>" +
        "<tr class=\"success\"> " +
        "<th width=\"60%\">菜品名字</th> " +
        "<th width=\"20%\">价格</th> " +
        "<th width=\"20%\">数量</th> " +
        "</tr>" +
        "</thead>");
    
    $.each(msg,function () {
        seller_menu_table.append("<tr>" +
            "<td>" +
            "<input readonly type=\"text\" class=\"form-control\"   value=\""+this.food_name+"\" >" +
            "<input type='hidden' value='"+this.id+"' class='seller_menu_id'>" +
            "</td>" +
            "<td>" +
            "<input readonly type=\"text\" class=\"form-control\"  value=\""+this.price+"\" >" +
            "</td>" +
            "<td>" +
            "<input type=\"number\" class=\"form-control\"  min=\"1\" value=\"1\" name=\"number["+this.id+"]\">" +
            "</td>" +
            "</tr>")
    })
}

/*给加菜选择框值*/
function checkboxVal(msg)
{
    $('.seller_menu_id').each(function (k) {
        $(this).parent().prev().children().eq(0).val(msg[k].id)
    })
}

//加菜筛选功能
$('#submit_menu').click(function ()
{
    var formdata = new FormData($('#seller_menu_form')[0]);
    ajaxToGet(formdata);
});


// 二级请求
$('#menu_parent_id').change(function ()
{
    var parent_id 		= $(this).val();
    ajaxChildren(parent_id);
});

// 填写数据
function takeMenuChild(msg)
{
    var menu_child_id 	= $('#menu_child_id');
    menu_child_id.empty();
    menu_child_id.append("<option value=''>请选择菜系</option>");
    $(msg).each(function () {
        menu_child_id.append("<option value='"+this.id+"'>"+this.name+"</option>");
    })
}


function cashierString(msg)
{
    $('#menu_name').append(msg.name+"厅");
    $('#tb_id').append("餐桌号："+msg.tb_id);
    nickname = msg.nickname;
    if(msg.nickname==null ||msg.nickname==undefined ||msg.nickname=='' ){
        nickname = '匿名用户';
    }
    allprice = msg.allPrice;
    $('#nick_name').append("昵称："+nickname);
    $('#mobile').append("电话："+msg.mobile);
    $('#score').append("积分"+msg.score);
    $('[name="order_id"]').val(msg.order_id);
    $('#order_id').val(msg.order_id);
    $('#print_order').append(msg.print_order);
    $('#foodList').append(msg.food_data);
    $('#order_id_in').append('订单号：'+msg.order_id);
    $('#order_time').append('下单时间：'+msg.order_time);
    initTableCheckbox();
    remarks();
}

    function remarks()
    {
        var remarks = $('.remarks').eq(0).text();
        $('#thisRemark').text(remarks)
    }

//换台
$('[name="rest_menu_id"]').click(function ()
{
    var menu_id = $(this).attr('menu_id');
    ajaxRest(menu_id);
    $(this).parent().children().each(function () {
        $(this).removeClass('active');
    });
    $(this).addClass('active')
});


$('#changeOne').click(function ()
{
    $('#myModal').modal('hide');
    ajaxRest();
    $('#changeOneModal').modal();
});


function restToText(msg)
{
    var rest_table_body = $('#rest_table_body');
    rest_table_body.empty();
    $.each(msg,function () {
        rest_table_body.append(
            "<label for=\"rest_table_id"+this.id+"\"  class=\"col-md-2 Table-list-li Table-list-li\" >" +
            "<input type='radio' name='table_id' value='"+this.id+"' id='rest_table_id"+this.id+"' onchange='changeThisColor(this)' style='display:none;'>" +
            "<h4 class=\"Service-hall-name\">"+this.name+" 厅</h4> " +
            "<div class=\"contet-Table\"> " +
            "<h4 class=\"Table-number\"> "+this.tb_id+" 号 </h4> " +
            "<h3 class=\"status\">空  闲</h3> " +
            "</div> " +
            "<p class=\"Table-type\"><i> </i> <font>"+this.table_name+"</font></p> " +
            "</label>")
    })
}


function changeThisColor(a)
{
    $(a).parent().parent().children().css('background-color','#6EB452');
    $(a).parent().css('background-color','red');
}

//改变金额
function changSurplus()
{
    var all = 0;
    $('.reduce').each(function () {
        all += $(this).val()*1;
    });
    $("#Surplus").text(Math.floor((allprice-all)*100)/100);
}

//更改支付方式
function changeThisType(a)
{
    var type = $(a).prev().prop('checked');
    if (type)
    {
        $(a).css('background-color','#0e6f5c');
        $('.merge').css('display','none');
        $('#oneOffPayment').css('display','');
    }
    else
    {
        $(a).css('background-color','red');
        $('.merge').css('display','');
        $('#oneOffPayment').css('display','none');
    }
}

//优惠价格
function CouponsSubtract(a)
{
    var Coupons = $(a).val();
    all = parseFloat(allprice-Coupons).toFixed(2);
    $("[name='order[order_price]']").val(all);
    $("#Surplus").text(all);
}
