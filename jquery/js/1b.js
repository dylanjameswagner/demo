$(document).ready(function() {
	// insert element
	$('<p class="insert"><input type="button" class="count insert" value="Count Paragraphs"/></p>')
		.appendTo('#demo');

	// alert number of elements
	$('.count').click(function() {
		alert('There are ' + ($('#demo p').length - 1) + ' paragraphs total in this demo.'); // subtract 1 to account for the inserted one 
	});
});
