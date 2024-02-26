/* custom.js */

jQuery(document).ready(function($){

	var $marker = $('<div class="marker"><span class="marker-text orientation">0 × 0 @1x</span></div>');
		$marker.appendTo('body');

	$(window).on('load scroll resize',function(){

		$('.marker-text').text($marker.outerWidth() + ' × ' + $marker.outerHeight() + ' @' + (('devicePixelRatio' in window) ? devicePixelRatio : 1) + 'x');

		$('.measurements .screen').text(screen.width + ' × ' + screen.height);
		$('.measurements .viewport').text(window.innerWidth + ' × ' + window.innerHeight);

		var body = document.body,
    		html = document.documentElement;

		var width	= Math.max($('#content').outerWidth(),document.body.clientWidth),
			height	= Math.max($('#content').outerHeight(),body.scrollHeight, body.offsetHeight,html.clientHeight, html.scrollHeight, html.offsetHeight);

		$('.measurements .document').text(width + ' × ' + height);

	});

}); // .ready
