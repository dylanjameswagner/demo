/* slideshow/slideshow-menu */

$(document).ready(function(){

	if ($('#slideshow').length){
		var time = 4000;
		var fade = 1500;

		$('#slideshow-menu').show();
		$('#slideshow-menu a')
			.on('click',function(event){ event.preventDefault();
				var i = $(this).attr('href').substr(1);
				var j = parseInt(i) + 1;

				$(this).css({ cursor: 'default' });

				// FIXME: this doesnt work
				$('#slideshow .active').removeClass('active');
				$('#slideshow .pending').removeClass('pending');
				$('#slideshow .slide-'+i).addClass('active').addClass(j);
				$('#slideshow .slide-'+(j > 6 ? 1 : j)).addClass('pending');
			});

		function slideshow(){
			if (!$('#slideshow:hover').length){

				$('#slideshow .active')
					.fadeOut(fade,function(){
						$(this).appendTo('#slideshow');

						$('#slideshow .active, #slideshow-menu .active')
							.removeClass('active');

						$('#slideshow .pending, #slideshow-menu .pending')
							.addClass('active')
							.removeClass('pending');

						$('#slideshow .active, #slideshow-menu .active').next()
							.addClass('pending')
							.show();

						var next = $('#slideshow-menu .active').next().length ? $('#slideshow-menu .active').next() : $('#slideshow-menu li:first');
							next.addClass('pending');
					});

			} // end if hover

			setTimeout(slideshow,time);
		} // end function

		setTimeout(slideshow,time);

	} // end if

}); // end .ready
