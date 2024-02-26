$(document).ready(function() {
$('#demo').html('<p class="insert"><label>Search City or Zip <input type="text" id="search" name="search"/></label></p>');
$('#search').change(function() {
	var zip = $('#search').val();

	$('#demo').html('<p>Loading Weather Data...</p>');

	$.ajaxSetup ({ cache: false });

	$.getJSON('http://www.worldweatheronline.com/feed/weather.ashx?callback=?',{
		'q':17112,
		'format':'json',
		'number_of_days':2,
		'key':'e5105b4a87145321101111'
	},function(data){
		$('#demo')
			.html('<h3>Weather for ' + data.data.request[0].type + ' ' + data.data.request[0].query + ':</h3>')
			.append('<dl/>');

		$.each(data.data.current_condition[0], function(key,value) {
			if ($.isArray(value)) {
				$.each(value[0], function(k,v) {
					if (key == 'weatherIconUrl') {
						value = '<img src="' + v + '" alt=""/>';
					} else {
						value = v;
					}
				});
			};
			$('<dt>' + key + '</dt> <dd>' + value + '</dd>')
				.appendTo('#demo dl')
				.fadeIn();
		}); // end $.each
	});
});
});
