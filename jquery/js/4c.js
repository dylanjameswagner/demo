$(document).ready(function() {
	// see tooltips in script.js
/*	$('*[title]').hover(function(e) {									// hover in
		var titleText = $(this).attr('title');							// store title value

		$(this)															// remove title attribute
			.data('tipText', titleText)									// inserts titleText into data array
			.removeAttr('title');

		$(this).click(function(e) {									
			$(this).attr('title', $(this).data('tipText'));				// return title attribute
			$('.tooltip').remove();										// remove tooltip
		});

		$('<p/>')														// create <p/> to replace title tooltip
			.addClass('tooltip')
			.text(titleText)
			.append('<span/>')											// create <span/> inside <p/>
			.appendTo('body')
			.css('top', (e.pageY + 20) + 'px')
			.css('left', (e.pageX - 26) + 'px')
			.fadeIn('slow');
	}, function() {														// hover out
		$(this).attr('title', $(this).data('tipText'));					// return title attribute
		$('.tooltip').remove();											// remove tooltip
	}).mousemove(function(e) {											// mouse move
		$('.tooltip')
			.css('top', (e.pageY + 20) + 'px')
			.css('left', (e.pageX - 26) + 'px');
	}); */
});
