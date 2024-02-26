/* colorbox */

$(document).ready(function(){

/* jquery.colorbox --------------------------------------------------- */

	if (typeof $.colorbox == 'function'){
		$('a[href*="placehold.it"],a[href$=".jpg"],a[href$=".png"],a[href$=".gif"]')
			.colorbox({
				 photo:				true					// false, display a link as a photo
				,opacity:			0.5						// 1, 0-1 overlay opacity
				,transition:		'elastic'				// none, elastic, fade
				,scalePhotos:		true					// true, false
				,maxWidth:			'95%'					// false, (~ %, 500, 500px)
				,maxHeight:			'95%'					// false, (~ %, 500, 500px)

				,preloading:		true					// true, false

				,slideshow:			true					// true, false
				,slideshowAuto:		false					// true, false
				,slideshowSpeed:	3000					// 2500
				,slideshowStart:	'start slideshow'		// start slideshow
				,slideshowStop:		'stop slideshow'		// stop slideshow

				,previous:			'back'					// previous
				,next:				'next'					// next
				,close:				'close'					// close
				,current:			'{current} of {total}'	// image {current} of {total} // NO TRAILING COMMA!
			});

		$('.gallery a,#product-gallery a')
			.colorbox({
				 rel:				'gallery'				// false, nofollow, (alt group selected elements)
				,opacity:			0.5						// 1, 0-1 overlay opacity
				,transition:		'elastic'				// none, elastic, fade
				,scalePhotos:		true					// true, false
				,maxWidth:			'95%'					// false, (~ %, 500, 500px)
				,maxHeight:			'95%'					// false, (~ %, 500, 500px)

				,preloading:		true					// true, false

				,slideshow:			true					// true, false
				,slideshowAuto:		false					// true, false
				,slideshowSpeed:	3000					// 2500
				,slideshowStart:	'start slideshow'		// start slideshow
				,slideshowStop:		'stop slideshow'		// stop slideshow

				,previous:			'back'					// previous
				,next:				'next'					// next
				,close:				'close'					// close
				,current:			'{current} of {total}'	// image {current} of {total} // NO TRAILING COMMA!
			});
	} // end if

}); // end .ready
