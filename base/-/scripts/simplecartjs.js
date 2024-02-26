/* simplecart.js */

$(document).ready(function(){

	if (typeof simpleCart == 'function'){
		simpleCart({
			 checkout: {
				 type:	'PayPal'
//				,email: 'hello@dylanjameswagner.com'
				,email: 'seller_1357848876_biz.dylanjameswagner.com'
			}
			,taxRate: 0.06
			,cartStyle: 'table'
			,cartColumns: [
				 { view: 'image', attr: 'thumb', label: false }
				,{ attr: 'name', label: 'Name' }
				,{ attr: 'size', label: 'Size' }
				,{ view: 'currency', attr: 'price', label: 'Price' }
//				,{ view: 'decrement', label: false }
//				,{ attr: 'quantity', label: 'Qty' }
				,{ view: function(item,column){
					return  ''
						+ '<a href="javascript:;" class="simpleCart_decrement">-</a>'
						+ ' '+item.quantity()+' '
						+ '<a href="javascript:;" class="simpleCart_increment">+</a>';
					}
					,attr: 'quantity'
					,label: 'Quantity'
				 }
//				,{ view: 'increment', label: false }
				,{ view: 'currency', attr: 'total', label: 'SubTotal' }
				,{ view: 'remove', text: 'Remove', label: false }
				,{ view: 'link', attr: 'link', text: 'View' }
			]
		});

		// add to cart feedback
		simpleCart.bind('afterAdd',function(item){
			$('#simplecart-cart').show();

			$('.item_add')
				.after('<span>Added</span>')
				.next()
				.css({
					 position:	'relative'
					,top:		'2px'
					,left:		'10px'
				})
				.animate({
					 position:	'relative'
					,left:		'+=35px'
					,opacity:	'toggle'
				},1000,function() {
					$(this).remove();
				});
		});

/* cookies */

//	cookieErase('view');

	// get/set cookie
	if (cookieRead('view')){ $('.view').attr('class',cookieRead('view')); }
	else {					 cookieWrite('view',$('.view').attr('class')); }

	$('.view-menu').show();

	$('.view-menu a')
		.on('click',function(event){ event.preventDefault();
			var value = 'view '+$(this).attr('class'); // add class to view

			$('.view').attr('class',value);

			cookieWrite('view',value);
	});

/* cart interaction */

//		if ($('.simpleCart_quantity').text() == 0){
//			$('#simplecart-cart').hide();
//		}

//		if ($('.item_size')){ $('.item_add').attr('disabled','disabled'); }

/* $('.item-name') // create links to product cart 
			.live('click',function(e){
				var src = $(this).closest('.itemContainer').find('img').attr('src');
				window.location = '?p='+src.substring(src.lastIndexOf('shop/'),src.lastIndexOf('/')).replace(/\//g,'_');
			});
*/
		// FIXME: this does not work correctly
/* function textEmpty(){
alert(simpleCart.quantity());
			if (simpleCart.quantity() == 0){
//				$('.simpleCart_items').after('<p id="empty" class="jc">Your cart is empty.<br/> <a href="/shop/">Start Shopping</a></p>');
//				$('.simpleCart_checkout,.simpleCart_empty').remove();
			};
		};
*/
//		if ($('.simpleCart_cart table')){ textEmpty(); }; // checks when info is loaded // replaces content

/*	$('.simpleCart_empty')
			.live('click',function(event){
				if (!confirm('Are you sure you want to empty your cart?')){
					alert('neg');
					event.preventDefault();
				};
			});
*/
//		$('.simpleCart_empty,.item-remove,.item-decrement')w
//			.live('click',function(event){
//				textEmpty();
//			});

	} // endif typeof simpleCart

}); // end .ready
