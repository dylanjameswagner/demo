$(document).ready(function() {
	$('#demo_nav li a').click(function(e) {
		var url = $(this).attr('href') + ' #content > *';

		$('#demo_content')
//			.html('<p>loading...</p>\n')
			.load(url);

		e.preventDefault();
	})
});
