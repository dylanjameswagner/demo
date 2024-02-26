/*

	// -------------------------------------------------------------------- //
	// contact.js

*/

	// jquery ------------------------------------------------------------- //
	$(document).ready(function() {
		// validate
		$('#contact_form').validate({
			rules: {
				name:		{ required: true },
				email:		{ required: true,	email: true	},
				website:	{ url: true },
				password:	{ minlength: 6,		required: true },
				passconf:	{ equalTo: "#password" }
			}, success: function(label) {
				label.text('OK!').addClass('valid');
			}
		});

		$('#contact_form textarea').live('focus, blur, change', function(e) {
			if($(this).hasClass('error')) {
				$('#contact_preview').addClass('error');
			} else {
				$('#contact_preview').addClass('valid');
			};
		});
		

		if ($('#contact_message textarea:blank')) {
			$(this).parent().addClass('error');
		};
	});
