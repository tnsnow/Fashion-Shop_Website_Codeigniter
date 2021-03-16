
function currency(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + '.' + '$2');
	}
	return x1 + x2;
}

$(document).ready(function(){

	var link = 'http://localhost/website_ban_hang_quan_ao';


	// update trạng thái diao dịch
	$('.status').click(function(){
		 status = $(this).attr("status");
		 id = $(this).attr("id");
		 $result = $("#mabomon");
		 $.ajax({
		 	url:link+'/admin/transaction/update_status',
		 	type:'post',
		 	async:true,
		 	dataType:'text',
		 	data:{'status':status , 'id':id},
		 	success:function(data)
		 	{
		 		
		 		
			}
		 	
		 });
	});
	
	
	$('.delivered').click(function(){
			
		 delivered = $(this).attr("delivered");
		 id = $(this).attr("id");
		 qty = $(this).attr("qty");
		 product_id = $(this).attr("product_id"); 
		 

		 $.ajax({
		 	url:link+'/admin/order/update_delivered',
		 	type:'post',
		 	async:true,
		 	dataType:'text',
		 	data:{'delivered':delivered , 'id':id,'qty':qty,'product_id' : product_id},
		 	success:function(data)
		 	{
		 		
		 		
			}
		 	
		 });
	});


	var $list_send 	= $('.list_send');//tim toi the co class = list_send
		$list_send.find('#submit').click(function(){ //tim toi the co id = submit,su kien click
			if(!confirm('Gửi liên hệ cho tất cả người dùng !'))
			{
				return false;
			}
			
			var email = new Array();
			$('[name="email[]"]:checked').each(function()
			{
				email.push($(this).val());
			});


			if (!email.length) return false;
			console.log(email)
			//link xoa du lieu
		    var url  = $(this).attr('url');
			//ajax để xóa
			$.ajax({
				url:link+'/admin/contact/sendEmailAll',
				type: 'POST',
				data : {'email': email},
				success: function(data)
				{
					console.log(data)
					window.location.href = link+'/admin/contact/sendEmailAll'
					
				}
				
			})
			return false;
		});



	
		$('#arrange').change(function(){
			 arrange = $('#arrange').find(":selected").val();
			 id = $(this).attr("cata_id");
			 $result = $("#catalog");
			 $.ajax({
			 	url:link+'/product/arrange',
			 	type:'post',
			 	async:true,
			 	dataType:'text',
			 	data:{'arrange':arrange , 'id':id},
			 	success:function(data)
			 	{
			 		$result.html(data);
				}
			 	
			 });
		});
		
		$('#order_product').change(function(){
			 arrange = $('#order_product').find(":selected").val();
			 $result = $("#product_list");
			 var links = $(location).attr('href');
			 var start = links.length - 2;
			 var number = links.substr(start, 2);
			 $.ajax({
			 	url:link+'/product/showProducts/'+ number,
			 	type:'post',
			 	async:true,
			 	dataType:'text',
			 	data:{'arrange':arrange},
			 	success:function(data)
			 	{
			 		
			 		$result.html(data);
				}
			 	
			 });
		});


		$('.seach_price').click(function(){

			from = $(this).attr('from');
			to 	 = $(this).attr('to');
			id 	 = $(this).attr('cata_id');

			$result = $("#catalog");

			$.ajax({
				url:link+'/product/searchPrice',
				typ:'get',
				async:true,
				dataType:'text',
				data:{'from':from,'to':to,'id':id},
				success:function(data)
			 	{
			 		$result.html(data);
				}

			});
		});

		var offset = 100;
		var duration = 500;
		jQuery(window).scroll(function() {
			if (jQuery(this).scrollTop() > offset) {
				jQuery('.back-to-top').fadeIn(duration);
			} else {
				jQuery('.back-to-top').fadeOut(duration);
			}
		});
		jQuery('.back-to-top').click(function(event) {
			event.preventDefault();
				jQuery('html, body').animate({scrollTop: 0}, duration);
			return false;
		})

		$('.add-cart').click(function (event) {
			event.preventDefault();
			var id = $(this).attr('data-id');
			var url = $(this).attr('href');

			$.ajax({
				url:link+'/cart/checkAmountProduct',
				type:'GET',
				async:true,
				dataType:'json',
				data:{'id':id},
				success:function(data)
				{
					if (data.flgCheck == true) {
						window.location.href = url;
					} else {
						alert('Số lượng sản phẩm không đủ để thêm vào giỏ hàng');
					}
				}
			});
		})

		$(".qty_cart_number").on('change', function(){
			var _that = $(this);
			var id = $(this).attr('data-id');
			var curentQty = $(this).attr('qty');
			var qty = $(this).val();

			if (qty <= 0) {
				_that.val(curentQty);
			}

			$.ajax({
				url:link+'/cart/checkQtyCart',
				type:'GET',
				async:true,
				dataType:'json',
				data:{'id':id, 'qty' : qty},
				success:function(data)
				{
					if (data.flgCheck == false) {
						_that.val(curentQty);
						alert('Số lượng sản phẩm không đủ để cập nhật vào giỏ hàng');
					}
				}
			});
		});

		$('.transport').change(function () {
			var transport = $(this).val();
			var total = $('.total-price').attr('totalCurrent');
			var shiping = 30000;
			var payment = '';

			if (transport == 'Chuyển phát nhanh') {
				payment = parseInt(total) + parseInt(shiping);
			} else {
				shiping = 0;
				payment = total;
			}

			$('.shiping').html(currency(shiping) + '₫');
			$('.payment').html(currency(payment) + '₫');
		});
});