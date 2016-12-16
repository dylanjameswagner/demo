/* script.js */

	// scrollTop 1 // effectively hiding the address bar
	// FIXME: this doesnt work.
//	window.addEventListener('load',function(){ setTimeout(function(){ window.scrollTo(0,1); },0); });

/* jquery */

$(document).ready(function(){

	if (typeof $.localScroll == 'function'){
		$.localScroll({ duration: 500 });
	}

	// TODO: fix typeof
//	if (typeof $.tablesorter == 'function'){
		$('.tablesorter').tablesorter(); 
//	}

	Rainbow.color();

/* textarea */

	// TODO: give option to change focus / event.keyCode == 18 option
	// TODO: limit for .maxlength
	$('textarea.tab')
		.keydown(function(event){
//			console.log(event.which);

			if (event.keyCode === 9){ event.preventDefault(); // 9 tab // prevent refocus
				// caret position/selection
				var start = this.selectionStart;
				var end = this.selectionEnd;

				var $this = $(this);
				var value = $this.val();

				$this.val(value.substring(0,start)+'\t'+ value.substring(end)); // set textarea value: text before caret + tab + text after caret

				this.selectionStart = this.selectionEnd = start + 1; // put caret at right position again (add one for the tab)
			}
		});

	$('textarea.maxlength')
		.each(function(index,element){
			var maxlength = 500;
			var count = $(this).val().length;

			// console.log('counter-'+index+' '+count);

			$(this)
				.after('<span class="counter"><span class="counter-'+index+'">'+$(this).val().length+'</span> of '+maxlength+'</span>')
				.keydown(function(event){
					var count = $(this).val().length;
					var nonChar = [8,9,16,17,18,37,38,39,40,91,93]; // 8 backspace, 9 tab, 16 shift, 17 control, 18 option, 37 left, 38 up, 39 right, 40 down, 91 left command, 93 right command

						 if (count !== 0 && event.keyCode === 8){ count--; }
					else if (inArray(event.which,nonChar)){		  count;   }
					else {										  count++; }

					// console.log(count+' '+event.which+(count === 0 ? ' zero' : ''));

					if (count >= maxlength && !inArray(event.which,nonChar)){ event.preventDefault(); } // allowed keydown

					if (count >= (maxlength - 50)){ $('.counter-'+index).addClass('alert'); }
					else {							$('.counter-'+index).removeClass('alert'); }

					$('.counter-'+index)
						.text(count);
				});
		});

	// tooltips
	var offsetX = 13;
	var offsetY =  6;

	$('*[title]')
		.mousemove(function(event){
			$('.tooltip')
				.css('top',(event.pageY + offsetY)+'px')
				.css('left',(event.pageX - offsetX)+'px');
		})
		.hover(function(event){
			var titleText = $(this).attr('title');

			$(this)
				.data('titleText',titleText)
				.addClass('title')
				.removeAttr('title');

			$(this).click(function(event){
				$(this).attr('title',$(this).data('titleText'));

				$('.tooltip')
					.remove();
			});

			if ($(this).prop('tagName') == 'A'){
				$('.tooltip').addClass('e'+$(this).prop('tagName'));
				offsetX = offsetX -  2;
				offsetY = offsetY + 12;
			}

			$('<p/>')
				.addClass('tooltip')
				.appendTo('body')
				.text(titleText)
				.css('top',(event.pageY + offsetY)+'px')
				.css('left',(event.pageX - offsetX)+'px')
				.fadeIn('slow');
		},
		function(event){
			$(this).attr('title',$(this).data('titleText'));

			$('.tooltip')
				.remove();

			offsetX = 13;
			offsetY =  6;
		});

/* return to top */

	$('#return').hide();
	$('#return')
		.on('click',function(){
			window.location.hash = '';
		});

	if ($(document).height() > $(window).height() && $(document).scrollTop() > $(window).height() / 3){			$('#return').toggleFade(); }

	$(window)
		.resize(function(){
			if ($(document).height() > $(window).height() && $(document).scrollTop() > $(window).height() / 3){ $('#return').fadeIn(); }
			else {																								$('#return').fadeOut(); }
		})
		.scroll(function(){
			if ($(document).scrollTop() > $(window).height() / 3){												$('#return').fadeIn(); }
			else {													 											$('#return').fadeOut(); }
		});

/* notice */

	setTimeout(function(){
		$('#notice')
			.css({ marginTop: 0 })
			.animate({ marginTop: -$('#notice').outerHeight(), opacity: 0 },400)
			.fadeOut('slow');
	},2000);

}); // end .ready
