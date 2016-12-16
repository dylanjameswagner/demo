$(document).ready(function() {
	var colorOriginal = $('#demo p').css('color');

	$('#demo p').hover(function() {
		$(this).animate({color: 'red'}, 100);
	}, function() {
		$(this).animate({color: colorOriginal}, 2000);
	});

	$('#demo p').click(function() {
		$(this).effect('explode', {}, 500);
	});
});
