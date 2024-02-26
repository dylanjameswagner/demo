$(document).ready(function() {
	$('<ul id="nav_paged" class="navigation insert">' +
		'<li>Page <span>#</span> of <span>#</span></li>' +
		'<li class="back">&laquo; <a href="#">back</a></li>' +
		'<li class="next"><a href="#">next</a> &raquo;</li>' +
		'</ul><!-- #nav_paged -->')
			.appendTo('#demo');
	
	TABLE.paginate('.paginate', 10);
});

var TABLE = {};

TABLE.paginate = function(table, pageLength) {
	// content
	var $table = $(table);
	var $rows = $table.find('tbody > tr');

	var pages = Math.ceil($rows.length / pageLength) - 1;
	var page = 0;

	var $nav  = $('#nav_paged')
		$nav.find('li:first span:first').text(page + 1); // page
		$nav.find('li:first span:last').text(pages + 1); // pages
	var $back = $nav.find('.back');
		$back
			.addClass('disabled')
			.children()
			.click(function(e) {
				pagination('<');
				e.preventDefault();
			});
	var $next = $nav.find('.next');
		$next
			.children()
			.click(function(e) {
				pagination('>');
				e.preventDefault();
			});

	// show initial rows
	$rows
		.hide()
		.slice(0,pageLength)
		.show();

	pagination = function(direction) {
		reveal = function(page) {
			$back.removeClass('disabled');
			$next.removeClass('disabled');
  
			$rows
				.hide()
				.slice(page * pageLength, page * pageLength + pageLength)
				.show();
	
			$nav.find('li:first span:first').text(page + 1); // update page
		};

		// back & next  
		if (direction == '<') { // back
			if (page > 1) {
				reveal(page -= 1);
			} else if (page == 1) {
				reveal (page -= 1);
				$back.addClass('disabled');
			}
		} else {
			if (page < pages - 1) {
				reveal(page += 1);
			} else if (page == pages - 1) {
				reveal(page += 1);
				$next.addClass('disabled');
			}
		}
	}
}
