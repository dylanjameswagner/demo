<?php

	$base = '/base';

	$pageTitle			= 'Cart';
	$pageDescription	= '';
	$pageKeywords		= '';

?>
<?php include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/header.php'; ?>

			<article id="primary" class="article no-sidebar">

				<h1><?php echo pageName($pageTitle); ?></h1>

				<nav class="jc">
					<ul class="navigation">
						<li><a href="<?php base(); ?>/shop/">Continue Shopping</a></li>
						<li><a class="development simpleCart_checkout" href="javascript:;">Proceed to SimpleCart Checkout</a></li>
						<li><a class="development" href="<?php base(); ?>/shop/checkout/">Proceed to Checkout</a></li>
					</ul><!--.navigation-->
				</nav>

				<hr/>

				<div id="cart-list" class="simpleCart_items">
					<p class="jc"><span class="hidden">&hellip;</span>Loading&hellip;</p>
				</div><!--.simpleCart_items-->

				<hr/>

				<div id="cart-totals">
					<dl class="inline fr jr" style="width: 110px; padding-bottom: 1.4em;">
						<dt>Subtotal</dt> <dd><strong class="simpleCart_total">$0.00</strong></dd>
						<dt>Tax (<span class="simpleCart_taxRate">0</span>%)</dt> <dd class="simpleCart_tax">$0.00</dd>
						<dt>Shipping</dt> <dd class="simpleCart_shippingCost"><strong>Free</strong></dd>
						<dt>Total</dt> <dd><strong class="simpleCart_grandTotal">$0.00</strong></dd>
					</dl>
					<p><a href="javascript:;" class="simpleCart_empty">Empty Shopping Bag</a></p>
				</div>

				<hr/>

				<nav class="jc">
					<ul class="navigation">
						<li><a href="<?php base(); ?>/shop/">Continue Shopping</a></li>
						<li><a class="development simpleCart_checkout" href="javascript:;">Proceed to SimpleCart Checkout</a></li>
						<li><a class="development" href="<?php base(); ?>/shop/checkout/">Proceed to Checkout</a></li>
					</ul><!--.navigation-->
				</nav>

			</article><!--#primary.article-->

<?php include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/footer.php'; ?>
