/* custom.slides.js */

jQuery(document).ready(function($){

/* simple */

	if ($('#slides.simple').length && $('#slides').length){
		$('.slide-selector').removeClass('hide');

		$('.slide-selector a')
			.on('click',function(event){ event.preventDefault();
				var thisID = $(this).attr('href').substr(1);

				$('#slides').addClass('none');

				$('.slide').removeClass('active');
				$('#slide-'+thisID).addClass('active');
		
				$('.slide-selector li').removeClass('active');
				$(this).parent().addClass('active');
			});
	} // #slides

/* transition */

	if ($('#slides.transition').length && $('#slides').length){
		var pause = 4000;

		$('.slide-order').removeClass('hide');
		$('.slide-selector').removeClass('hide');

		$('#slides')
			.on('mouseout',function(){
				$('#slides').removeClass('none');
			});

		$('.slide-menu a')
			.on('click',function(event){ event.preventDefault();
				var ref = $('#slides').offset().top;
				var offset = $(window).width() > 600 ? $('#wpadminbar').outerHeight() : 0;

				if ($(window).scrollTop() + offset > ref){
					$(window).scrollTop(ref - offset);
				}

				$('#slides').addClass('none');

				transition($(this).attr('href').substr(1));
			}); // on

		$(document).keydown(function(event){ 
				 if (event.which == 37){ $('#slide-order-prev a').click(); }
			else if (event.which == 39){ $('#slide-order-next a').click(); }
		});

		$('.slide')
			.on('touchstart',function(event){
				// do something
			});

		var focused = true;
		window.onfocus = function(){ focused =  true; };
		window.onblur  = function(){ focused = false; };

		function transition(thisID){
			if (focused && (thisID || !($('#slides:hover').length))){

/*
			// timestamp
			var d = new Date();
				h = d.getHours();
				m = d.getMinutes();
				s = d.getSeconds();
			console.log (('0'+h).slice(-2)+':'+('0'+m).slice(-2)+':'+('0'+s).slice(-2),focused,thisID);
*/
				if (thisID){
					$('#slides .pending')
						.removeClass('pending');

					$('#slide-'+thisID+', #slide-selector-'+thisID)
						.addClass('pending');
				} // thisID

				$('#slides .previous')
					.removeClass('previous');

				$('#slides .active')
					.addClass('previous')
					.removeClass('active');

				$('#slides .pending')
					.addClass('active');

				$('#slides .pending.active')
					.each(function(index,event){

						var $first = $(this).siblings().first();
						var $last  = $(this).siblings().last();

						var $prev = $(this).prev();
						var $next = $(this).next();

						$('.slide-menu-prev a').attr('href',($prev.length ? $prev :  $last).children('a').attr('href'));
						$('.slide-menu-next a').attr('href',($next.length ? $next : $first).children('a').attr('href'));

						if ($next.length){	$next.addClass('pending'); }
						else {				$first.addClass('pending'); }

					}); // each

				$('#slides .pending.active')
					.removeClass('pending');

			} // focused && thisID || !#slides:hover
		} // transition

		setInterval(transition,pause);

	} // #slides

}); // .ready
