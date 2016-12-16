$(document).ready(function() {
	$('#demo_nav li a').hover(function() {
		$(this).animate({paddingTop: '+=10px'}, 200);
	}, function() {
		$(this).animate({paddingTop: '-=10px'}, 200);
	});
});
