/* custom.js */

jQuery(document).ready(function($){

/* layout equalize height */

	$(window).on('load resize',function(){ equalizeHeight('.post-text','offset'); });

	function equalizeHeight(selector,type){
		if ($(window).width() > 480){
			// reset
			$(selector)
				.css({
					 'height':'auto'
//					,'min-height':'0'
//					,'max-height':'none'
				});

			if (type == 'offset'){

				// equalize by offset
				var top		= 0;
				var height	= 0;
				var heights = {};

				$(selector)
					.each(function(i){
						top		= $(this).offset().top > top ? $(this).offset().top : top;
						height	= $(this).height() > height  ? $(this).height()		: height;

						heights[$(this).offset().top] = height;
					});

				$(selector)
					.each(function(i){
						$(this)
							.height(heights[$(this).offset().top]);
					});

			} // type == offset
			else {

				// equalize by all
				var heights = [];

				$(selector)
					.each(function(i){
							heights[i] = $(this).height(); // heights.push($(this).height());
						})
					.height(Math.max.apply(Math,heights));

			} // else
		} // width >= 768
		else {

			// reset
			$(selector)
				.css({
					 'height':'auto'
//					,'min-height':'0'
//					,'max-height':'none'
				});

		} // else
	} // equalizeHeight

}); // .ready
