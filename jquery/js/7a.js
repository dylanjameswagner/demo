$(document).ready(function() {
	ADS.fixedPosition('#left');
});

var ADS = {};
	ADS.fixedPosition = function(parent) {
		$(parent).each(function() {
			var ele = $(this);
			var timer = false;

			ele.data('top',ele.offset().top - 20); // - 10 subtract the position fixed top
			ele.data('bottom',ele.parent().offset().top + ele.parent().height() - ele.height() + 5);
			ele.data('left',ele.offset().left);
			ele.data('absolute',ele.data('bottom') - ele.parents('#content').offset().top + 0); // + 10 account for #content position relative

			// info display
			$('body').prepend('<p style="position: fixed; top: 5px; left: 20px;">scrollTop <strong>' + $(document).scrollTop() + '</strong><br/><span></span></p>');

			// initial positioning
			if ($(document).scrollTop() > ele.data('top')) {
				if ($(document).scrollTop() < ele.data('bottom')) { 	ele.css({ 'position': 'fixed', 'top': '10px' }); }
				else {													ele.css({ 'position': 'absolute', 'top': ele.data('absolute') + 'px' }); }					
			} else {													ele.css({ 'position': 'static', 'top': 'auto' }); }

			// scroll positioning
			$(window).scroll(function() {
				$('body p:first strong').text($(document).scrollTop()) // update info display
				if ($(document).scrollTop() > ele.data('top')) {
					if ($(document).scrollTop() < ele.data('bottom')) { ele.css({ 'position': 'fixed', 'top': '10px' }); $('body p:first span').text('fixed'); }
					else {												ele.css({ 'position': 'absolute', 'top': ele.data('absolute') + 'px' }); $('body p:first span').text('absolute'); }
				} else {												ele.css({ 'position': 'static', 'top': 'auto' }); $('body p:first span').text('static'); }
			});    
		});
	}
