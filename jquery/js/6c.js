$(document).ready(function() {
	// all .dialogs
	$('.dialog').each(function(index) {
		$(this).before('<p class="insert">Dialog: <a href="' + $(this).attr('id') + '" class="dialog_link">' + $(this).attr('title') + '</a></p>');
		$('a.dialog_link').click(function() {
			$('#' + $(this).attr('href')).dialog('open');
			return false;
		});
		$(this).dialog({
			autoOpen: false,
			width: '75%',
			height: 500,
			modal: true,
			resizable: false,
		});
	});

	// redefine sepecific .dialogs
	$('#test.dialog').dialog({
		width: 'auto',
		height: 'auto',
		modal: true,
		resizable: false,
		buttons: {
				Accept: function() {
					$(this).dialog('close');
					// Update Rating
				},
				Decline: function() {
					$(this).dialog('close');
					// Submit Rating
				}
			}
	});
});
