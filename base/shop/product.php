<?php

	$base = '/base';

	$pageTitle			= 'Product';
	$pageDescription	= '';
	$pageKeywords		= '';

	$product_id			= '00000';
	$product_title		= 'Dapibus Vestibulum';
	$product_desc		= 'Curabitur blandit tempus porttitor. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Donec id elit non mi porta gravida at eget metus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Vestibulum id ligula porta felis euismod semper.';
	$product_price		= '5.00';
	$product_size		= array('Small','Medium','Large');

?>
<?php include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/header.php'; ?>

			<article id="primary" class="article">

<?php product($product_id,$product_title,$product_desc,$product_price,$product_size); ?>

				<hr/>

				<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
					<p>
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="P88WZKZDZR3VE">
					<input type="image" width="107" height="26" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
					<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</p>
				</form>

			</article><!--#primary.article-->

<?php include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/footer.php'; ?>
