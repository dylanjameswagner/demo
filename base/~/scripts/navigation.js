/* navigation.js */

$(document).ready(function(){

	// accordion
	$('.accordion > li:first')
		.addClass('active');

	$('.accordion > li:not(:first) > ul')
		.hide();

	$('.accordion > li')
		.click(function(event){ event.preventDefault();
			$(this)
				.siblings()
				.removeClass('active')
				.find('ul:visible')
				.slideToggle();

			$(this)
				.toggleClass('active')
				.find('ul')
				.slideToggle();
		});

	// expandable
	$('.expandable > li > ul')
		.hide();

	$('.expandable > li')
		.click(function(event){ event.preventDefault();
			$(this)
				.toggleClass('active')
				.find('ul')
				.slideToggle();
		});

}); // end .ready
