/*

	// -------------------------------------------------------------------- //
	// script.js
	
	// to-do:
	// table striping
	// ol margin for 100+
	// strip comments from external pre load
	// toTitleCase() - http://stackoverflow.com/questions/196972/convert-string-to-proper-case-with-javascript

*/

	// jquery ------------------------------------------------------------- //
	$(document).ready(function() {
		// remove anything with class .no-script -------------------------- //
		$('.no-script').remove();											// remove .no-script elements

		// load external files into pre ----------------------------------- //
		var file	= window.location.search.substr(window.location.search.indexOf('=') + 1);

		$('#jquery pre')
			.data('jquery', $('#jquery pre').html())									// existing content
			.html('loading...\n\n').load('js/' + file + '.js',function(response, status, xhr) {
				if (status == 'success') {
					$(this).html($(this).html().replace(/[<>]/g,function(m) { return {'<':'&lt;','>':'&gt;'}[m]})).append(tab(7));
					$('#jquery h3').html('<a href="js/' + file + '.js"><code>' + file + '.js</code></a> jQuery');
				} else {
					$(this).html($(this).data('jquery'));
				}
			});

		$('#xhtml pre')
			.data('xhtml', $('#xhtml pre').html())									// existing content
			.html('loading...\n\n').load('php/' + file + '.php #demo',{'p':file},function(response, status, xhr) {
				if (window.location.search != '' && file != 'home' && status == 'success') {
					$(this).html($(this).html().replace(/[<>]/g,function(m) { return {'<':'&lt;','>':'&gt;'}[m] }).replace(/\t{5}/g, '')).append('\n' + tab(7));
					$('#xhtml h3').html('<a href="php/' + file + '.php"><code>' + file + '.php</code></a> XHTML');
				} else {
					$(this).html($(this).data('xhtml'));
				}
			});

		$('#css pre')
			.data('css', $('#css pre').html())									// existing content
			.html('loading...\n\n').load('css/' + file + '.css',function(response, status, xhr) {
				if (status == 'success' && response) {
					$(this).append(tab(7));
					$('#css h3').html('<a href="css/' + file + '.css"><code>' + file + '.css</code></a> CSS');
				} else {
					$(this).html($(this).data('css'));
				}
			});
		
/*		$.ajax({
			url: 'js/' + file + '.js',
			cache: true,
			success: function(html){
				alert('success');
				$(this).html($(this).html().replace(/[<>]/g, function(m) { return {'<':'&lt;','>':'&gt;'}[m]})).append(tab(7));
				$('#jquery h3').html('<a href="js/' + file + '.js"><code>' + file + '.js</code></a> jQuery');
			}
		}); */
		
/*		$(function() {
			$.ajax({
				url : '/page-doesnt-exist',
				success : function() {
					$('#debug').html('page found');
				},
				error : function(xhr, d, e) {
					if (xhr.status == 404) {
						// page not found
						$('#debug').html('page not found');
						// $('div').load('goodpage.html'); // show a good page instead
					}
				}
			});
		}); */

		// local links ---------------------------------------------------- //			
		$.localScroll({ filter: ':not(.no-scroll)' });						// uses jquery.scrollTo & jquery.localScroll // scrolls ALL local links

		// tooltips ------------------------------------------------------- // 
		$('*[title]').hover(function(e) {									// hover in
			var titleText = $(this).attr('title');							// store title value

			$(this)															// remove title attribute
				.data('tipText', titleText)									// inserts titleText into data array
				.removeAttr('title');

			$(this).click(function(e) {									
				$(this).attr('title', $(this).data('tipText'));				// return title attribute
				$('.tooltip').remove();										// remove tooltip
			});

			$('<p/>')														// create <p/> to replace title tooltip
				.addClass('tooltip')
				.text(titleText)
				.append('<span/>')											// create <span/> inside <p/>
				.appendTo('body')
				.css('top', (e.pageY + 20) + 'px')
				.css('left', (e.pageX - 26) + 'px')
				.fadeIn('slow');
		}, function() {														// hover out
			$(this).attr('title', $(this).data('tipText'));					// return title attribute
			$('.tooltip').remove();											// remove tooltip
		}).mousemove(function(e) {											// mouse move
			$('.tooltip')
				.css('top', (e.pageY + 20) + 'px')
				.css('left', (e.pageX - 26) + 'px');
		});

		// expandable ----------------------------------------------------- // 
		$('.navigation.expandable > li > ul')
			.hide()
			.click(function(e){
				e.stopPropagation();
		});
		$('.navigation.expandable > li').toggle(function() {
			$(this)
				.css('background-position', 'right -58px')
				.find('ul').slideDown();
		}, function() {
			$(this)
				.css('background-position', 'right 3px')
				.find('ul').slideUp();
		});

		// accordion ------------------------------------------------------ // 
		$('.navigation.accordion > li ul')
			.click(function(e){
				e.stopPropagation();
		})
			.filter(':not(:first)')
			.hide();
		
		$('.navigation.accordion > li').click(function() {
			var selfClick = $(this).find('ul:first').is(':visible');

			if (selfClick){
				return;
			}

			$(this)
				.parent()
				.find('> li ul:visible')
				.slideToggle()

			$(this)
				.parent()
				.children()
				.removeClass('active');

			$(this)
				.addClass('active')
				.find('ul:first')
				.stop(true, true)
				.slideToggle();
		});

		// view source button --------------------------------------------- //
		// #source-code
		// Remy's method
//		var pre = document.createElement('pre');
//			pre.id = "source-code";
//			pre.innerHTML = ('<!DOCTYPE html>\n<html>\n' + document.documentElement.innerHTML + '\n</html>').replace(/[<>]/g, function(m) { return {'<':'&lt;','>':'&gt;'}[m]});

		// csstricks method
		var html = $('html').html();

		$(function() {
//			
//			<p class="close"><a title="Close View Source" href="#"><img src="http://css-tricks.com/examples/ViewSourceButton/images/x.png" alt="Close View Source"/></a></p>
//		</div>
//			$('body').append('<div id="source-code"></div>').html('<p class="close"><a title="Close View Source" href="#"><img src="http://css-tricks.com/examples/ViewSourceButton/images/x.png" alt="Close View Source"/></a></p>');
/*			$('<div/>', {
				'id':		'source-code',
				'html':		'<p class="close"><a title="Close View Source" href="#"><img src="http://css-tricks.com/examples/ViewSourceButton/images/x.png" alt="Close View Source"/></a></p>'
			}).appendTo('body');*/
			$('<pre/>', {
				'class':	'xprettyprint',
				'html':		'&lt;!DOCTYPE html PUBLIC\n' + // '&lt;!DOCTYPE html>\n' +
							'\t"-//W3C//DTD XHTML 1.0 Strict//EN"\n' +
							'\t"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">\n\n' +
							'&lt;html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">\n' +
							'\t' +
							$('html').html()
								.replace(/[<>]/g, function(m) { return {'<':'&lt;','>':'&gt;'}[m]}) +
//								.replace(/((ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?)/gi,'<a href="$1">$1</a>') + // linkify (remove trailing "+" on previous line)
							'\n' +
							'&lt;/html>\n'
			}).appendTo("#source-code");
			prettyPrint();													// prettify
		});

		// misc ----------------------------------------------------------- //
		// date insertion
		$(function() { $("#deadline").datepicker({ dateFormat: 'yy-mm-dd' }); });	// date insertion [YYYY-MM-DD]

//		$(function() { $("table").tablesorter(); });						// table sorter

//		$('table tbody tr:odd').addClass('alt');							// table striping			

/*		$('textarea').resizable({											// textarea resizing
		    grid : [20, 20],
			minWidth : 153,
			minHeight : 30
//			maxHeight : 220,
//			containment: 'parent'
		}); */

}); // eof $(document).ready(function() {

	// functions ------------------------------------------------------ //
	function tab(depth) {
		var r = '';

		for (var i=0; i<depth ;i++) {
			r += '\t';
		}
		return r;
	};

	function toTitleCase(str, glue){
		/*
		 * @param String str The text to be converted to titleCase.
		 * @param Array glue the words to leave in lowercase. 
		 */
		glue = (glue) ? glue : new Array('of','for','and');

		return str.replace(/(\w)(\w*)/g, function(_, i, r){
			var j = i.toUpperCase() + (r != null ? r : '');

			return (glue.indexOf(j.toLowerCase())<0) ? j : j.toLowerCase();
		});
	};
