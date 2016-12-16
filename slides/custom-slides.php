<?php
	$type		= 'slide';
	$taxonomy 	= 'slide-category';
	$term		= $post->post_parent ? get_page($post->post_parent)->post_name : $post->post_name;

	$transition = 'fade-out'; // none, fade-out, shift, shift offset, shift offset fade-in, drop
	$transition = 'shift';
	$transition = 'shift offset';
	$transition = 'shift offset fade-in';
//	$transition = 'drop';
//	$transition = 'none';

	$args = array(
		 'post_type'		=> $type
		,'post_staus'		=> 'publish'
		,'posts_per_page'	=> -1
		,'orderby'			=> 'menu_order'
		,'order'			=> 'ASC'
//		,$taxonomy			=> $term // deprecated
		,'tax_query'		=> $post->post_name == 'home' ? NULL : array(array( // array of arrays // is_front_page()
			 'taxonomy'		=> $taxonomy
			,'terms'		=> $term
			,'field'		=> 'slug'
		))
	);
?>
<?php $query = new WP_Query($args); ?>
<?php if ($query->have_posts()): $content; ?>

			<section id="slides" class="articles slides page-image count-<?php echo $query->post_count; ?> <?php echo $transition; ?>">
				<div class="articles-inner slides-inner">

<?php while ($query->have_posts()): $query->the_post(); $i++; $array; ?>
<?php
										$class = '';
	if ($query->post_count == 1):		$class[] = 'active pending';
	else:
		if ($i == 1):					$class[] = 'active';	endif;
		if ($i == 2):					$class[] = 'pending';	endif;
		if ($i == $query->post_count):	$class[] = 'previous';	endif;
	endif; // post_count

		if ($i == 2):					$next = get_the_ID();
	elseif ($i == $query->post_count):	$prev = get_the_ID();
	endif;

	$array[get_the_ID()] = array(get_the_title(),($class ? ' '.implode(' ',$class) : NULL));
?>
					<article id="slide-<?php the_ID(); ?>" class="article slide slide-<?php echo $i; ?><?php echo $class ? ' '.implode(' ',$class) : NULL; ?>">

<?php custom_featured_image(array('href'=>'none')); ?>

							<div class="slide-text centered"><div class="slide-text-inner">

								<h1 class="slide-title title">
<?php if (class_exists('acf') && get_sub_field('slide_action_text') && (get_sub_field('slide_action_page') || get_sub_field('slide_action_url'))): ?>
									<a href="<?php echo get_sub_field('slide_action_url') ? get_sub_field('slide_action_url') : get_sub_field('slide_action_page'); ?>">
<?php endif; // class_exists acf && get_sub_field ?>
									<?php the_title(); echo PHP_EOL; ?>
<?php if (class_exists('acf') && get_sub_field('slide_action_text') && (get_sub_field('slide_action_page') || get_sub_field('slide_action_url'))): ?>
									</a>
<?php endif; // class_exists acf && get_sub_field ?>
								</h1>
<?php if (class_exists('acf') && get_field('subtitle')): ?>
								<h2 class="slide-subtitle title<?php echo get_post_type(); ?>-subtitle subtitle"><?php the_field('subtitle'); ?></h2>
<?php endif; // class_exists acf && get_field subtitle ?>
<?php if (get_the_content()): ?>
								<div class="slide-content content">
<?php the_content(); ?>
								</div><!--.slide-content-->
<?php endif; // get_the_content ?>

<?php if (class_exists('acf') && get_field('slide_actions')): ?>
								<p class="slide-action content">
<?php while (has_sub_field('slide_actions')): ?>

<?php if (get_sub_field('slide_action_text') && (get_sub_field('slide_action_page') || get_sub_field('slide_action_url'))): ?>
									<a<?php if (get_sub_field('slide_action_target')): ?> target="_blank"<?php endif; ?> class="button" href="<?php echo get_sub_field('slide_action_url') ? get_sub_field('slide_action_url') : get_sub_field('slide_action_page'); ?>"><?php the_sub_field('slide_action_text'); ?></a>
<?php endif; // get_sub_field ?>
<?php endwhile; // has_sub_field ?>
								</p>
<?php endif; // class_exists acf && get_field slide_actions ?>

							</div><!--.slide-text-inner--></div><!--.slide-text-->

							<?php custom_edit_post(); ?>

					</article><!--.slide-->

<?php endwhile; // have_posts ?>

<?php $i = NULL; ?>

				</div><!--.slides-->

<?php if ($query->post_count > 1): ?>

<?php if (true): // slide-order ?>
				<nav class="slide-menu slide-order hide">
					<ul class="slide-menu-list slide-order-list">
						<li id="slide-order-prev" class="slide-menu-item slide-menu-direction slide-menu-prev slide-order-item slide-order-direction"><a class="prev" href="#<?php echo $prev; ?>"><span class="meta-direction"><?php _e('Previous','custom'); ?></span> <span class="meta-title"><?php _e('Slide','custom'); ?></span></a></li>
						<li id="slide-order-next" class="slide-menu-item slide-menu-direction slide-menu-next slide-order-item slide-order-direction"><a class="next" href="#<?php echo $next; ?>"><span class="meta-direction"><?php _e('Next','custom'); ?></span> <span class="meta-title"><?php _e('Slide','custom'); ?></span></a></li>
					</ul><!--.slide-order-list-->
				</nav><!--.slide-order-->
<?php endif; ?>

				<nav class="slide-menu slide-selector hide">
					<ol class="slide-menu-list slide-selector-list">
<?php if (false): // slide-selector-prev // FIXME does not work with script ?>
						<li id="slide-selector-prev" class="slide-menu-item slide-menu-direction slide-menu-prev slide-selector-item slide-selector-direction"><a class="prev" href="#<?php echo $prev; ?>"><span class="meta-direction"><?php _e('Previous','custom'); ?></span> <span class="meta-title"><?php _e('Slide','custom'); ?></span></a></li>
<?php endif; ?>
<?php foreach ($array as $k => $v): $i++; ?>
						<li id="slide-selector-<?php echo $k; ?>" class="slide-menu-item slide-selector-item<?php echo $v[1]; ?>"><a href="#<?php echo $k; ?>"><span class="meta-title"><?php echo $v[0]; ?></span></a></li>
<?php endforeach; $i = NULL; ?>
<?php if (false): // slide-selector-next // FIXME does not work with script ?>
						<li id="slide-selector-next" class="slide-menu-item slide-menu-direction slide-menu-next slide-selector-item slide-selector-direction"><a class="next" href="#<?php echo $next; ?>"><span class="meta-direction"><?php _e('Next','custom'); ?></span> <span class="meta-title"><?php _e('Slide','custom'); ?></span></a></li>
<?php endif; ?>
					</ol><!--.slide-selector-list-->
				</nav><!--.slide-selector-->

<?php endif; // post_count ?>

			</section><!--#slides-->

<?php endif; // have_posts ?>
<?php wp_reset_postdata(); ?>
