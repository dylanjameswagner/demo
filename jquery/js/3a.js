$(document).ready(function() {
	// colorbox
	$('#demo_colorbox a').colorbox({
		rel:			'md',					// false, auto groups selected elements
		opacity:		0.75,					// 1, 0-1 overlay opacity
		transition:		'none',					// elastic, fade, none
//		speed:			350,					// 350, transition speed in miliseconds
		scalePhotos:	true,					// true
//		width:			'90%',					// false
//		height:			'90%',					// false
		maxWidth:		'98%',					// false
		maxHeight:		'98%',					// false

		preloading:		true,					// true
//		photo:			false,					// false, force link as photo - image.php
//		href:			false,					// false, alt anchor url
//		title:			false,					// false, alt anchor 

		slideshow:		true,					// false
		slideshowAuto:	false,					// true
		slideshowSpeed:	5000,					// 2500
		slideshowStart:	"start slideshow",		// start slideshow
		slideshowStop:	"stop slideshow",		// stop slideshow

		previous:		'back',					// previous
		next:			'next',					// next
		close:			'close',				// close
		current:		'{current} of {total}'	// image {current} of {total} // NO TRAILING COMMA!

//		innerWidth:		false,					// false
//		innerHeight:	false,					// false
//		initialWidth:	'400',					// 400
//		initialHeight:	'400',					// 400
//		scrolling:		true,					// true
//		inline:			false,					// false
//		html:			false,					// false
//		iframe:			false,					// false

//		open:			false,					// false, opens with no action from user
//		overlayClose:	true,					// true

//		onOpen:			false,					// false
//		onLoad:			false,					// false
//		onComplete:		false,					// false
//		onCleanup:		false,					// false
//		onClosed:		false					// false
	});
});
