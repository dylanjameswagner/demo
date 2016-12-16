$(document).ready(function() {
	function scroller() {
		$('#demo_scroller ul li:first').animate({
			marginLeft: '-=142px'
		}, 5000, 'linear', function() {
			$(this).css('margin-left', '0').appendTo($(this).parent());
			scroller();
		});
	};
	scroller();
});
