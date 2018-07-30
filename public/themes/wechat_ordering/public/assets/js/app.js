
/******* 菜单页面 *******/

// 菜单列表 点击
$(".Dishes-menu .scroll-view-item ").on("click",function(){
	$(".Dishes-menu .scroll-view-item").removeClass('scroll-view-item-activ');
	$(this).addClass('scroll-view-item-activ');
});

// 购物车 隐藏 展示
$(".total,.shopping-icon").on("click",function(){
	var bindtap = $(".total").attr('bindtap');
	var z_num_shop = parseInt($(".z-num-shop").text());
	if(z_num_shop > 0){
		if(bindtap == 1){
			$(".mask").fadeOut();
			$(".footer-shopping-Selected-products").fadeOut();
			$(".total").attr('bindtap','');
		}else{
			$(".mask").fadeIn();
			$(".footer-shopping-Selected-products").fadeIn();
			$(".total").attr('bindtap',1);
		}
	}
});

$(".mask").on("click",function(){
	$(".footer-shopping-Selected-products").fadeOut();
	$(this).fadeOut();
});

//清空购物车
$(".emptied-shopping").on("click",function(){
	$(".footer-shopping-Selected-products,.mask").hide();
	$(".shop-chaked-list .Dishes-list").html('');
	$(".z-num-shop").text(0);	
	$(".z-num-shop").hide();
	$(".Total-price").text('0.00');
	$(".Dishes-num-size").text(0);
	$(".plus-round-Reduce, .Dishes-num-size").hide();
	$('#Notactive-button').hide();
	$('#active-Selected').show();
    sesssionTo('jj',0);
});

//购物车数量增加  .Dishes-maxlist-right .Dishes-list .plus-round-add
$(".Dishes-list .plus-round-add").click(function(){
	addshop($(this));
	
});
$(".shop-chaked-list .Dishes-list").on("click",".plus-round-add",function(){
	addshop($(this));
});

/*function addshop(thiss){
	var arr 		= new Array();
	var Dishesnum 	= thiss.parent('.Dishes-num');  //商品数量
	var foodname 	= thiss.attr('data-foodname'); //当前位置 所在商品名称
	var dataprice	= parseFloat(thiss.attr('data-price')); //当前位置 所在单价
	var id			= parseInt(thiss.attr('data-id'));  //商品id
	var znumshop 	= parseInt($(".z-num-shop").text());  //总数量
	var Totalprice 	= parseFloat($(".Total-price").text());
	var key = 1;
	znumshop++;
	$(".z-num-shop").show();
	$(".Total-price").text((Totalprice+dataprice));
	$(".z-num-shop").text(znumshop);
		var narr   = new Array(id,1,foodname,dataprice);
    sesssionTo(narr,1);
	$(".shop-chaked-list .Dishes-list .plus-round-add").each(function(){
		var shop_chaked_dataid = parseInt($(this).attr('data-id'));
		arr.push(shop_chaked_dataid);
  	});

  	if($.inArray(id, arr) == -1)
  	{
		$(".shop-chaked-list .Dishes-list").append(
		'			<view class="Service-fee Service-fee-list Dishes-list-id-'+ id +'">'+
		'                <text class="fl">' + foodname +'</text>'+
		'                <view class="fr Dishes-num"> '+
		'                  <text class="price"> ￥ ' + dataprice +' </text>'+
		'                  <view class="plus-round plus-round-Reduce" data-foodname="' + foodname +'" data-id="' + id +'" data-price="' + dataprice +'" bindtap="SelectedamountReduce">-</view>'+
		'                  <text class="Dishes-num-size">1</text>'+
		'                  <view class="plus-round plus-round-add" data-foodname="' + foodname +'" data-id="' + id +'" data-price="' + dataprice +'" bindtap="SelectedamountAdd">+</view>'+
		'                </view>'+
		'                <view class="clear"></view>'+
		'           </view>'
		);
	}
	$(".Dishes-list-id-" + id).find('.Dishes-num-size').text((parseInt(Dishesnum.find('.Dishes-num-size').text())+1));
	// Dishesnum.find('.Dishes-num-size').text((parseInt(Dishesnum.find('.Dishes-num-size').text())+1));
	Dishesnum.find('.plus-round-Reduce').css('display','inline-block');
	Dishesnum.find('.Dishes-num-size').css('display','inline-block');
}*/

//购物车数量减少  .Dishes-maxlist-right .Dishes-list .plus-round-Reduce
$(".Dishes-list .plus-round-Reduce").on("click",function(){
	Reduceshop($(this));
});
$(".shop-chaked-list .Dishes-list").on("click",".plus-round-Reduce",function(){
	Reduceshop($(this));
});

/*function Reduceshop(thiss){
	var Dishesnum 	= thiss.parent('.Dishes-num');
	var foodname 	= thiss.attr('data-foodname'); //当前位置 所在商品名称
	var dataprice	= parseFloat(thiss.attr('data-price'));
	var id			= parseInt(thiss.attr('data-id'));
	var znumshop 	= parseInt($(".z-num-shop").text());
	var Totalprice 	= parseFloat($(".Total-price").text());
	var Dishesnumsize = (parseInt(Dishesnum.find('.Dishes-num-size').text()));
	Dishesnumsize--;
	znumshop--;
	$(".Total-price").text((Totalprice-dataprice));
	if(znumshop >=0){
		$(".z-num-shop").text(znumshop);
	}
	if(znumshop <1){
		$(".z-num-shop").hide();
		$(".footer-shopping-Selected-products,.mask").hide();
		$('#Notactive-button').hide();
		$('#active-Selected').show();
	}

	// Dishesnum.find('.Dishes-num-size').text(Dishesnumsize);
	$(".Dishes-list-id-" + id).find('.Dishes-num-size').text(Dishesnumsize);
	if(Dishesnumsize <= 0){
		// Dishesnum.find('.plus-round-Reduce,.Dishes-num-size').hide();
		$(".Dishes-list-id-" + id).find('.plus-round-Reduce,.Dishes-num-size').hide();
		$(".shop-chaked-list .Dishes-list-id-" + id).remove();
	}

}*/

//餐桌显示
$("#active-Selected").click(function(){
	var z_num_shop = parseInt($(".z-num-shop").text());
	if(z_num_shop > 0){
		$(this).hide();
		$(".booking-select,#Notactive-button,.footer-shopping-Selected-products,.mask").fadeIn();
	}else{
		layer.msg('你还未选择菜品，请选择！');
	}
})

//下单表单判断
function verification() {  
    var food = '';
    $(".shop-chaked-list .Dishes-list .Service-fee-list").each(function(){
    	var num = parseInt($(this).find('.Dishes-num-size').text());
    	var id  = parseInt($(this).find('.plus-round-add').attr('data-id'));
    	food += id + '*' + num + ';';
  	}); 
	$("#food").val(food);

	var addfood_order_id = $('#addfood_order_id').val();

	if(!addfood_order_id){
	 	if($("#reserve_class").val() == '') {  
	        layer.msg('请选择餐桌！');  
	        return false;  
	    } 
	}
   
    if($('#food').val() == '') {  
        layer.msg('菜品数量最少为1');  
        return false;  
    }
 
    return true; 
}

function Scavenging() {
    var food = '';
    $(".shop-chaked-list .Dishes-list .Service-fee-list").each(function(){
        var num = parseInt($(this).find('.Dishes-num-size').text());
        var id  = parseInt($(this).find('.plus-round-add').attr('data-id'));
        food += id + '*' + num + ';';
    });
    $("#food").val(food);

    if($('#food').val() == '') {
        layer.msg('菜品数量最少为1');
        return false;
    }

    return true;
}

//预订餐桌下单表单判断
function reservrscation() {  
	var reserve_class = $("#reserve_class").val();

    if(reserve_class == '') {  
        layer.msg('请先选择服务厅，再选择餐桌！');  
        return false;  
    }  

    return true; 
}

//餐桌选择
$("#Notable_types").on("click",".booking-numname",function(){
  var countrest = parseInt($(this).attr('data-countrest'));
  if(countrest<1){
  	layer.msg('暂无空位！');
  	return false;
  }

  $("#Notable_types .booking-numname").removeClass('isusing');
  $(this).addClass('isusing');
  var menu_id = $(this).attr('data-id');
  
  $("#reserve_class").val($(this).attr('data-table-id'));
  $("#reserve_class").val(menu_id);

});
//餐桌选择
$("#Notable_types2").on("click",".booking-numname",function(){
  var countrest = parseInt($(this).attr('data-countrest'));
  if(countrest!=1){
  	layer.msg('已经有人在使用！');
  	return false;
  }

  $("#Notable_types2 .booking-numname").removeClass('isusing');
  $(this).addClass('isusing');
  var menu_id = $(this).attr('data-id');

  $("#reserve_class").val($(this).attr('data-table-id'));
  $("#reserve_class").val(menu_id);

});

function not_open() {
	layer.msg('商家还未开通此功能');
}
