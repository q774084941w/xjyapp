/**
 * Created by Administrator on 2018/6/21.
 */


var clickOne= '';
var clickParent= '';
//选择
function clickOneTo(a)
{
    //var menu   = $('#menu_id').val();
    //var result = isnull(menu,'服务厅');
    // if(result){
    clickOne = $(a).parent().parent();
    clickParent = $(a).parent().parent().parent();

    $('#myModal').modal();
    //}
}

//判断是否为空
function isnull(a,string) {
    if(a=='' || a==undefined || a==null)
    {
        bootbox.alert(string+'不能为空');
        return false;
    }
    else
    {
        return true;
    }
}


//确认
$('#confirm').click(function ()
{
    var arr = new Array();
    var have = new Array();
    var i = 0;
    $('.tra_id').each(function ()
    {
        have[i] = $(this).val();
        i++;
    });
    var k = 0;
    $('[name="checkItem"]').each(function ()
    {
        var ret = $(this).prop('checked');
        if(ret)
        {
            var tra_id = $(this).parent().next().text();

            var result = isInArray(have,tra_id);
            if(!result)
            {
                arr[k] = tra_id;
                k++;
            }
        }
    });
    if(arr.length!=0 && arr!== undefined ){
        ajaxToPost(arr);
    }else {
        $('#myModal').modal('hide');
    }

});

// 最后一个空白
function theLastOne(key) {
    var one = clickParent.children('tr').length;
    var two = clickParent.find('span').length;
    if(one==two){
        clickParent.append("<tr>" +
         "<td>"+key+"</td>" +
         "<td>"+
         "<button type=\"button\" class=\"btn btn-success \"  onclick=\"clickOneTo(this)\" name=\"selectOne\" style=\"float: right;margin-right: 20px\">" +
         "选择" +
         "</button></td>" +
         "<td></td>" +
         "<td></td>" +
         "<td></td>" +
         "<td></td>" +
         "</tr>");
    }
}


//导入字符串
function stringtoIN(msg) {
    var key = clickOne.children().eq(0).text();
    $.each(msg,function (k)
    {
        if(k==0)
        {
            clickOne.empty();
            changThisOne(key,this)
        }else {
            appendOne(key,this);
        }

        key++;
    });
    theLastOne(key);
    $('#myModal').modal('hide');
    all();
}


// 添加数据
function appendOne(key,a) {
    clickParent.append("<tr>" +
        "<td>"+key+"<input type='hidden' name='tra_id[]' value='"+a.tra_id+"' class='tra_id'/></td>" +
        "<td><span style='width: 80%;float: left;'>"+
        "<input type=\"text\" class=\" form-control\" name='tra_name["+a.tra_id+"]' value='"+a.name+"("+a.cateName+")' readonly> " +
        "</span> " +
        "<button type=\"button\" class=\"btn btn-success \"  onclick=\"clickOneTo(this)\" name=\"selectOne\" style=\"float: right;margin-right: 20px\">" +
        "选择" +
        "</button></td>" +
        "<td>"+a.traffic_number+"</td>" +
        "<td class=\"before\">"+a.stock+"</td>" +
        "<td><input type='text' class=\" form-control\" name='actual["+a.tra_id+"]' value='"+a.stock+"' onblur='all()'/></td>" +
        "<td><input type='text' class=\" form-control\" name='why["+a.tra_id+"]' value=''/></td>" +
        "</tr>");
}

function changThisOne(key,a) {
    clickOne.append(
        "<td>"+key+"<input type='hidden' name='tra_id[]' value='"+a.tra_id+"' class='tra_id'/></td>" +
        "<td><span style='width: 80%;float: left;'>"+
        "<input type=\"text\" class=\" form-control\" name='tra_name["+a.tra_id+"]' value='"+a.name+"("+a.cateName+")' readonly> " +
        "</span> " +
        "<button type=\"button\" class=\"btn btn-success \"  onclick=\"clickOneTo(this)\" name=\"selectOne\" style=\"float: right;margin-right: 20px\">" +
        "选择" +
        "</button></td>" +
        "<td>"+a.traffic_number+"</td>" +
        "<td class=\"before\">"+a.stock+"</td>" +
        "<td><input type='text' class=\" form-control\" name='actual["+a.tra_id+"]' value='"+a.stock+"' onblur='all()'/></td>" +
        "<td><input type='text' class=\" form-control\" name='why["+a.tra_id+"]' value=''/></td>"
        );
}

/**
 * 使用循环的方式判断一个元素是否存在于一个数组中
 * @param {Object} arr 数组
 * @param {Object} value 元素值
 */
function isInArray(arr,value)
{
    for(var i = 0; i < arr.length; i++)
    {
        if(value === arr[i])
        {
            return true;
        }
    }
    return false;
}


// 计算总价
function all() {
    var all_before=0;
    var all_stock=0;
    $('.before').each(function () {
        all_before  += Number($(this).text());
        all_stock   += Number($(this).next().children().eq(0).val());
    });
    var id = $('#all_before');
    id.empty();
    id.next().empty();
    id.text(all_before);
    id.next().text(all_stock);
}

/*初始化*/
$(document).ready(function () {
    ajaxToGet(0)
});

//筛选功能
$('#submit_menu').click(function () {
    var formdata = new FormData($('#seller_menu_form')[0]);
    ajaxToGet(formdata);
});

/*填写数据菜单*/
function seller_menu_table(msg) {
    var seller_menu_table = $('#seller_menu_table');
    seller_menu_table.empty();
    seller_menu_table.append("<thead>" +
        "<tr class=\"success\"> " +
        "<th width=\"60%\">序号</th> " +
        "<th width=\"20%\">商品名</th> " +
        "<th width=\"20%\">分类</th> " +
        "</tr>" +
        "</thead>");
    $.each(msg,function () {
        seller_menu_table.append("<tr>" +
            "<td>" + this.tra_id+"</td>" +
            "<td>" + this.name + "</td>" +
            "<td>" + this.cateName  + "</td>" +
            "</tr>")
    })
}

/*全选框*/
function initTableCheckbox() {
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
    var $checkItemTd = $('<td><input type="checkbox" name="checkItem" /></td>');
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


// 二级请求
$('#menu_parent_id').change(function () {
    var parent_id 		= $(this).val();
    ajaxChildren(parent_id);
});


// 填写数据
function takeMenuChild(msg) {
    var menu_child_id 	= $('#menu_child_id');
    menu_child_id.empty();
    menu_child_id.append("<option value=''>请选择类型</option>");
    $(msg).each(function () {
        menu_child_id.append("<option value='"+this.id+"'>"+this.name+"</option>");
    })
}