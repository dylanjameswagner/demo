$(document).ready(function() {
	TABLE.repeatHeader('table', 10)
});

var TABLE = {};

TABLE.repeatHeader = function(table, every) {
	$(table).each(function() {
		var $this = $(this);
//		var rowsLen = $this.find('tr:not(:first)').length;
		var rowsLen = $this.find('tbody tr').length;

		$(this).find('tr:first')
			.clone()
			.insertAfter($this.find('tr:nth-child(' + every + 'n)'))
			.addClass('insert');

		// remove last clone
		if((rowsLen) % every === 0) {
			$this.find('tr:last').remove();
		};
	});
};
