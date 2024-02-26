/* development.js */

$(document).ready(function(){

	$('a.disabled').on('click',function(event){ event.preventDefault(); });
	$('a.development').on('click',function(event){ event.preventDefault(); alert('This feature is in development.'); });

/* development panel */

	var offset = $('#development').outerWidth() - 27;
	$('#development')
		.css({ right:'-'+offset+'px' })
		.hover(function(){ $(this).animate({ right:0 }); },
			   function(){ $(this).animate({ right:'-'+offset+'px' });
		});

	$('#development .toggle')
		.on('click',function(){
			$('#development').toggleClass('expanded');
			$('#development .information').slideToggle();

			$(this).find('span').toggle();			
		});

	$('#development .width').html($(document).width());
	$('#development .height').html($(document).height());
	$('#development .viewport').html($(window).height());
	$('#development .scroll').html($(document).scrollTop());

	$(window)
		.scroll(function(){ $('#development .viewport').html($(window).height());
							$('#development   .scroll').html($(document).scrollTop()); })
		.resize(function(){ $('#development    .width').html($(document).width());
							$('#development   .height').html($(document).height()); });

/* kitchen sink */

	// TODO: make navigation open section
	var hash = window.location.hash ? window.location.hash : null;

	$('#kitchen-sink #sections section:not(#section-01):not('+hash+')').addClass('collapse');

	$('#kitchen-sink #sections section h1.header')
		.css({ cursor:'pointer' })
		.on('click',function(){
			if ($(this).parent().hasClass('collapse')){ window.location.hash = $(this).parent().attr('id'); }

			$(this).parent().toggleClass('collapse');
		});

/* jquery-ui */

	$(function() {
		$('.jquery-ui-accordion').accordion();
	});
	
	$(function(){
		$('.jquery-ui-tabs').tabs();
	});

}); // end .ready
