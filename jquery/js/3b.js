$(document).ready(function() {
	// innerfade
	$('#demo_innerfade').innerfade({
//		runningclass:		'innerfade',		// class applied to conatiner: innerfade
		animationtype:		'fade',				// fade, slide
		type:				'random_start',		// sequence, random, random_start
		speed:				1500,				// fade speed: slow, normal, fast
		timeout:			3500,				// time between fades in miliseconds
		containerheight:	'275px'				// auto // NO TRAILING COMMA!
	});
});
