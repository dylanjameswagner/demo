			<nav id="header-menu">
				<h3 class="menu-label assistive-text">Header Menu</h3>
				<ul class="navigation">
					<li<?php active('home'); ?>><a href="<?php base(); ?>/">Home</a></li>
					<li<?php active('page parent'); ?>><a href="<?php base(); ?>/page/">Page</a>
						<ul>
							<li<?php active('child'); ?>><a href="<?php base(); ?>/page/child/">Child</a></li>
							<li<?php active('child parent'); ?>><a href="<?php base(); ?>/page/child/">Child</a>
								<ul>
									<li<?php active('grandchild'); ?>><a href="<?php base(); ?>/page/child/grandchild/">Grandchild</a></li>
									<li<?php active('grandchild parent'); ?>><a href="<?php base(); ?>/page/child/grandchild/">Grandchild</a>
										<ul>
											<li<?php active('great-grandchild'); ?>><a href="<?php base(); ?>/page/child/grandchild/great-grandchild/">Great Grandchild</a></li>
										</ul>
									</li>
									<li<?php active('grandchild'); ?>><a href="<?php base(); ?>/page/child/grandchild/">Grandchild</a></li>
								</ul>
							</li>
							<li<?php active('child'); ?>><a href="<?php base(); ?>/page/child/">Child</a></li>
						</ul>	
					</li>
					<li<?php active('shop parent'); ?>><a href="<?php base(); ?>/shop/">Shop</a>
						<ul>
							<li<?php active('cart'); ?>><a href="<?php base(); ?>/shop/cart/">Cart</a></li>
							<li<?php active('product'); ?>><a href="<?php base(); ?>/shop/product/">Product</a></li>
						</ul>	
					</li>
				</ul><!--.navigation-->
			</nav><!--#header-menu-->

			<nav id="user-menu">
				<h3 class="menu-label assistive-text">User Menu</h3>
				<ul class="navigation">
					<li<?php active('account'); ?>><a href="<?php base(); ?>/account/">Account</a></li>
<?php if ($user): ?>
					<li<?php active('logout'); ?>><a href="<?php base(); ?>/logout/">Logout</a></li>
<?php else: ?>
					<li<?php active('login'); ?>><a href="<?php base(); ?>/login/">Login</a></li>
<?php endif; ?>
					<li id="simplecart-cart"<?php // active('cart'); ?>><a href="<?php base(); ?>/shop/cart/">Cart:&nbsp; <span class="simpleCart_quantity">0</span> items</a></li>
				</ul><!--.navigation-->
			</nav><!--#user-menu-->
