$(document).ready(function() {
	// hints
	$('input.clear, textarea.clear').each(function() {
		var label = $(this).prev().text().replace(' Required','');

		if ($(this).val() == '') {
			$(this).val(label);
		}

		$(this)
			.data('default', label)
			.addClass('blur')
			.focus(function() {
				$(this).removeClass('blur');
				if ($(this).val() == $(this).data('default') || '') {
					$(this).val('');
				}
			})
			.blur(function() {
				var default_val = $(this).data('default');

				if ($(this).val() == '') {
					$(this).addClass('blur');
					$(this).val($(this).data('default'));
				}
			});

		if ($(this).val() != label) {
			$(this).removeClass('blur');
		}
	});

	// maxlength
	$('.maxlength')
		.after('<span id="counter">' + (500 - $('.maxlength').val().length) + '</span>')
		.next()
//		.hide()
		.end()
		.keypress(function(e) {
			var current = $(this).val().length;

			console.log(current + ' ' + e.which);

			if (current >= 500) {
				if (e.which != 0 && e.which != 8) {
					e.preventDefault();
				}
			}
			$('#counter')
//				.show()
				.text(500 - current);
	});

	// validation
	$('#contact_form').validate({
		rules: {
			name:		{ required: true },
			email:		{ required: true,
						  email: true },
			website:	{ url: true },
			password:	{ minlength: 6,
						  required: true },
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
		$('#contact_message').addClass('error');
	};
});
