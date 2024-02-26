<?php
/*

	// -------------------------------------------------------------------- //
	// weatherbug.php

*/

//	$wb_api = 'A4448160454';	// reg'd to inbham.com a Black Tie Publication w/ Dylan James Wagner's phone number 267-207-9625
	$wb_api = 'A4539291347';	// reg'd to Dylan James Wagner

//	$wb_zip = '35212';			// Birmingham, AL
//	$wb_zip = '70130';			// New Orleans, LA
//	$wb_zip = '17112';			// Harrisburg, PA
	$wb_zip = '17402';			// York, PA

//	$wb_ico = '45x38';
//	$wb_ico = '40x34';
//	$wb_ico = '35x29';
//	$wb_ico = '30x25';
//	$wb_ico = '25x21';
	$wb_ico = '20x17';
//	$wb_ico = '15x13';

	function weatherbug($wb_api,$wb_zip,$wb_ico){

		$wb_xml = 'http://'.$wb_api.'.api.wxbug.net/getLiveWeatherRSS.aspx?ACode='.$wb_api.'&zipCode='.$wb_zip.'&UnitType=0&OutputType=1';

		$xml = simplexml_load_file($wb_xml);				// get the xml
		$aws = $xml->children('http://www.aws.com/aws');	// this allows for xml:namespaces

		// build the weather information
		$wb_now  = '<img src="http://img.weather.weatherbug.com/forecast/icons/localized/'.$wb_ico.'/en/trans'.substr(strrchr($aws->ob->{'current-condition'}->attributes(), '/'),0,-4).'.png" alt="'.trim($aws->ob->{'current-condition'}).'"/>';
		$wb_now .= ' <span>'.$aws->ob->{'current-condition'}.'</span>';
		$wb_now .= ' <span>&middot; '.round($aws->ob->temp).str_replace('&deg;','&deg; ',str_replace('&amp;','&',$aws->ob->temp->attributes())).'</span>';

		if ($aws->ob->{'wind-speed'} != 'N/A'){
//			$wb_now .= ' <span>'.$aws->ob->{'wind-speed'}.' '.$aws->ob->{'wind-speed'}->attributes().' '.$aws->ob->{'wind-direction'}.'</span>';
		}

//		$wb_now .= ' &middot; '.$aws->ob->humidity.$aws->ob->humidity->attributes().' Humidity';

//		echo '<p style="position: absolute; color: #ccc;"><a href="'.$aws->WebURL.'" style="color: #ccc;">'.$wb_now.'</a></p>';
//		echo '(<a href="'.$wb_xml.'" style="color: #ccc;">XML</a>)';

		$output = '<p id="weatherbug">'.$wb_now.'</p>';

		echo $output;
	}
	weatherbug($wb_api,$wb_zip,$wb_ico);

?>
