/**
 * Created by Administrator on 2018/6/22.
 */

//加菜筛选功能
$('#submit_menu').click(function () {
    var formdata = new FormData($('#seller_menu_form')[0]);
    ajaxToGet(formdata);
});

/*填写数据菜单*/
function seller_menu_table(msg) {
    var seller_menu_table = $('#seller_menu_table');
    seller_menu_table.empty();

    seller_menu_table.append(
        "<tr> " +
        "<th width=\"75%\">菜品名字</th> " +
        "<th width=\"15%\">价格</th> " +
        "</tr>");

    $.each(msg,function () {
        seller_menu_table.append("<tr> " +
            "<td> " +
            "<div class=\"input-group\"> " +
            "<span class=\"input-group-addon\"> " +
            "<input type=\"checkbox\" name=\"food1\" value=\""+this.id+"\"> " +
            "</span> " +
            "<input readonly type=\"text\" class=\"form-control\" name='food_name' value=\""+this.food_name+"\" > " +
            "</div> " +
            "</td> " +
            "<td><input readonly type=\"text\" class=\"form-control\" name='food_price' value=\""+this.price+"\" ></td> " +
            "</tr>")
    })
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
    menu_child_id.append("<option value=''>请选择菜系</option>");
    $(msg).each(function () {
        menu_child_id.append("<option value='"+this.id+"'>"+this.name+"</option>");
    })
}




function all_price() {
    var allPrice=0;
    $('[name="price"]').each(function () {
        var price  = $(this).val();
        var number = $(this).parent().prev().children().eq(0).val();
        allPrice   += price*number;
    });
    $('#allPrice').val(allPrice)
}

$(document).ready(function () {
    all_price();
});

function getTdValue()
{
    var tableId = document.getElementById("testTbl");
    var str = 0;

    for(var i=1;i<tableId.rows.length;i++)
    {
        str += parseFloat(tableId.rows[i].cells[1].getElementsByTagName("INPUT")[0].value*tableId.rows[i].cells[2].getElementsByTagName("INPUT")[0].value);
    }

    document.getElementById("price").value = str;
}


function chk(){
    var obj=document.getElementsByName('food1');
    var food_name=document.getElementsByName('food_name');
    var food_price=document.getElementsByName('food_price');
    var tableId = document.getElementById("testTbl");
    var tmp = new Array();

    for(var i=1;i<tableId.rows.length;i++)
    {
        tmp.push(tableId.rows[i].cells[1].getElementsByTagName("INPUT")[0].name);
    }
    for(var i=0; i<obj.length; i++){
        if(obj[i].checked) {
            if(tmp.indexOf('food['+obj[i].value+']') == -1)
            {
                var newTr = testTbl.insertRow();
                var newTd0 = newTr.insertCell();
                var newTd1 = newTr.insertCell();
                var newTd2 = newTr.insertCell();
                var newTd3 = newTr.insertCell();

                newTd0.innerText = food_name[i].value;
                newTd1.innerHTML = '<input class="form-control" type="text" name="food['+obj[i].value+']" value="1">';
                newTd2.innerHTML = '<input readonly class="form-control" type="text" value="'+food_price[i].value+'">';
                newTd3.innerHTML = '<input type="button" class="btn btn-default" value="删除" onclick="res(this)">';
            }
        }
    }
    all_price();

}