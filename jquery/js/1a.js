$(document).ready(function() {
	// insert elements
	$('<p class="insert"><input type="button" value="Insert a Paragraph"/></p>')
		.appendTo('#demo');

	$('#demo .insert input').click(function() {
		$('<p class="insert">Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</p>')
			.fadeIn('medium')
			.appendTo('#demo');
	});
});
