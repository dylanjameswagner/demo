/* custom.js */

jQuery(document).ready(function($){

	var speed = 70;
	var current = 0;
	var direction = 'left';

	function backgroundScroll(){
		current -= 1;

		$('.slides').css('background-position',(direction == 'left') ? current+'px 0' : '0 ' + current+'px');
	}

	setInterval(backgroundScroll,speed);

}); // .ready
