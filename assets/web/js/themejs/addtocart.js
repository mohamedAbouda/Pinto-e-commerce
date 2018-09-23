/* -------------------------------------------------------------------------------- /

	Magentech jQuery
	Created by Magentech
	v1.0 - 20.9.2016
	All rights reserved.

/ -------------------------------------------------------------------------------- */

	// Cart add remove functions
	var cart = {
		'add': function(product_id, quantity , target) {
			//actually add to cart (ajax nd shit)
			var data = {
				qty: quantity
			};
			if (product_id === '000' && $('input[name=color_id]:checked').length) {
				data.color_id = $('input[name=color_id]:checked').val();
			}
			if (product_id === '000' && $('input[name=size_id]:checked').length) {
				data.size_id = $('input[name=size_id]:checked').val();
			}
			$.ajax({
	            url: target,
	            type: 'GET',
	            data: data,
	            dataType: 'json',
	            success: function(response){
					//alert
					var title = 'Product added to Cart';
					var thumb = '<img src="'+response.product.image_url+'" alt="'+response.product.name+'">';
					var text = '<h3><a href="'+response.product.url+'">'+response.product.name+'"</a> added to <a href="#">shopping cart</a>!</h3>';
					addProductNotice(title, thumb, text, 'success');
					$('.cart-dropdown-count , .cart-header-count').text(response.cart.count);
					$('.cart-dropdown-total-price').text(response.cart.subtotal);
					$('li.cart>a').attr('title','Cart ('+response.cart.count+')');
	            }
	        });
		},
		'remove': function(row , rowId , target){
			var data = {
				rowId: rowId
			};
			$.ajax({
	            url: target,
	            type: 'GET',
	            data: data,
	            dataType: 'json',
	            success: function(response){
					//alert
					var title = 'Product removed from Cart';
					var thumb = '';
					var text = '';
					addProductNotice(title, thumb, text, 'success');
					$(row).parents('tr').remove();
					$('.cart-dropdown-total-price').text(response.data.cart_total);
					$('.cart-dropdown-count , .cart-header-count').text(response.data.cart_count);
					$('li.cart>a').attr('title','Cart ('+response.data.cart_count+')');
				}
	        });
		}
	}

	var wishlist = {
		'add': function(target) {
			$.ajax({
	            url: target,
	            type: 'GET',
	            dataType: 'json',
	            success: function(response){
					//alert
					var title = 'Product added to Wishlist';
					var thumb = '<img src="'+response.product.image_url+'" alt="'+response.product.name+'">';
					var text = '<h3><a href="'+response.product.url+'">'+response.product.name+'"</a> added to <a href="#">wishlist</a>!</h3>';
					addProductNotice(title, thumb, text, 'success');
					$('.wishlist-header-count').text(response.wishlist.count);
					$('#wishlist-total').attr('title' , 'Wish List ('+response.wishlist.count+')');
	            }
	        });
		}
	}
	var compare = {
		'add': function(product_id) {
			addProductNotice('Product added to compare', '<img src="image/demo/shop/product/e11.jpg" alt="">', '<h3>Success: You have added <a href="#">Apple Cinema 30"</a> to your <a href="#">product comparison</a>!</h3>', 'success');
		}
	}

	/* ---------------------------------------------------
		jGrowl – jQuery alerts and message box
	-------------------------------------------------- */
	function addProductNotice(title, thumb, text, type) {
		$.jGrowl.defaults.closer = false;
		//Stop jGrowl
		//$.jGrowl.defaults.sticky = true;
		var tpl = thumb + '<h3>'+text+'</h3>';
		$.jGrowl(tpl, {
			life: 4000,
			header: title,
			speed: 'slow',
			theme: type
		});
	}
