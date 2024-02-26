<?php /* functions.php */
	
//	$path = substr(dirname(str_replace($base,'',$_SERVER['PHP_SELF'])),1);
//	$path = substr(str_replace($base,'',str_replace('/index','',str_replace('.php','',$_SERVER['PHP_SELF']))),1);
//	$path = str_replace($base,'',str_replace('/index','',str_replace('.php','',$_SERVER['PHP_SELF']))); // remove $base // remove file // remove extension
	$path = str_replace($base,'',str_replace('/index','',str_replace('.php','',$_SERVER['PHP_SELF']))); // remove $base // remove file // remove extension

//	$pageID = array_pop(explode('/',substr(dirname(str_replace($base,'',$_SERVER['PHP_SELF'])),1)));
	$pageID = array_pop(explode('/',substr($path,1)));
//	$pageID = str_replace('/','-',substr($path,1));
//	$pageID = basename($_SERVER['PHP_SELF'],'.php');
	$pageID = $pageID ? $pageID : 'home';
	$pageAncestors = explode('/',substr(dirname($path),1));

	switch ($_GET['error']){
		case '400': $msg = 'Error 400 Bad Request';			  break;
		case '401': $msg = 'Error 401 Unauthorized';		  break;
		case '403': $msg = 'Error 403 Forbidden';			  break;
		case '404': $msg = 'Error 404 Wrong Page';			  break;
		case '500': $msg = 'Error 500 Internal Server Error'; break;
	}

/* utility */

	function base(){
		echo $GLOBALS['base'];		
	}

	// FIXME: this need to be revised
	function active($item = ''){ global $pageID;
		echo ' class="'.($item ? $item : 'home').($page[count($page) - 1] == $item ? ' active' : NULL).($page[0] == $item && $page[0] != $page[count($page) - 1] ? ' parent' : NULL).'"';
	}

/* head */

	function pageID($content = NULL){ global $pageID;
		return !empty($content) ? $content : $pageID;
	}

	function pageClass($content = NULL){ global $pageAncestors;
		return !empty($content) ? $content : ' '.implode(' ',$pageAncestors);
	}

	function pageDescription($content = NULL){
		return !empty($content) ? $content : 'description';
	}

	function pageKeywords($content = NULL){
		return !empty($content) ? $content : 'keywords';
	}

	function pageTitle($content = NULL,$sep = '::'){ global $brandTitle,$brandTagline;
		$content = $content != 'Home' ? $content : NULL; // hide home
		return !empty($content) ? $content.' '.$sep.' '.$brandTitle : $brandTitle.($brandTagline ? ' '.$sep.' '.$brandTagline : NULL);
	}

/* content */

	function pageName($content = NULL){ global $brandTitle;
		return !empty($content) ? $content : $brandTitle;
	}

	function product($id,$title,$description,$price,$size){
		$price = money_format('%(#1n',$price); // ($item_price*=2);
?>
					<div id="product" class="simpleCart_shelfItem">
						<div id="product-gallery">
							<p id="product-image"><a href="//placehold.it/800x600&text=Image+1" title="<?php echo $title; ?>"><img width="350" alt="<?php echo $title; ?>" src="//placehold.it/800x600&text=Image+1"/><br/>
								<small>Click to Enlarge</small></a>
							</p>
							<ul>
								<li><a href="//placehold.it/800x600&text=Image+2" title="<?php echo $title; ?>"><img width="114" alt="<?php echo $title; ?>" src="//placehold.it/800x600&text=Image+2"/></a></li>
								<li><a href="//placehold.it/800x600&text=Image+3" title="<?php echo $title; ?>"><img width="114" alt="<?php echo $title; ?>" src="//placehold.it/800x600&text=Image+3"/></a></li>
								<li><a href="//placehold.it/800x600&text=Image+4" title="<?php echo $title; ?>"><img width="114" alt="<?php echo $title; ?>" src="//placehold.it/800x600&text=Image+4"/></a></li>
							</ul>
						</div><!--#product-gallery-->
						<div id="product-information">
							<h1 id="product-title" class="item_name"><?php echo $title; ?></h1>
							<p id="product-description"><?php echo $description; ?></p>
							<dl id="product-details" class="inline">
								<dt>Price</dt> <dd id="product-price" class="item_price"><?php echo $price; ?></dd>
								<dt>Product</dt> <dd id="product-id"><?php echo $id; ?></dd>
<?php	if ($size): ?>
								<dt>Size</dt> <dd><select class="item_size">
													<option>Select Size</option>
<?php		foreach ($size as $k => $v): ?>
													<option value="<?php echo $v; ?>"><?php echo $v; ?></option>
<?php		endforeach; ?>
												  </select></dd>
<?php 	endif; ?>
							</dl><!--.details-->
							<p id="product-form"><input type="text" class="item_quantity" value="1" size="2"/> <button class="item_add" value="<?php echo $id; ?>">Add to Cart</button></p>
						</div><!--.information-->

						<hr/>

						<img class="item_thumb" src="//placehold.it/80x60&text=Image+1"/>
						<p class="item_link"><?php echo dirname($_SERVER['PHP_SELF']).'/'; ?></p>
					</div><!--#product-->

					<hr/>

					<nav class="navigation">
						<ul>
							<li id="cart"><a href="<?php base(); ?>/shop/cart">View Cart</a></li>
							<li id="checkout"><a href="javascript:;" class="simpleCart_checkout">Proceed to Checkout</a></li>
						</ul>
					</nav>
<?php
	} // end product
?>
