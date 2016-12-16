$(document).ready(function() {
	// insert element
	$('<p class="close insert"><input type="button" value="Close"/></p>')
		.prependTo('#disclaimer');

	// hide parent element when clicked
	$('.close').click(function() {
		$(this)
			.parent()
			.fadeTo('medium',0)
			.slideUp('fast')
	});
});
