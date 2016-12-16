<?php

	// implementation is incomplete

	$title = ($_GET['t'] ? $_GET['t'] : NULL);

	if ($title){

	    header('Content-Type: text/x-vcard; charset=utf-8');
    	header('Content-Disposition: attachment; filename="'.$title.'.vcf"');

		echo '

			BEGIN:		VCARD
			VERSION:	3.0
			N:			Gump;Forrest
			FN:			Forrest Gump
			ORG:		Bubba Gump Shrimp Co.
			TITLE:		Shrimp Man
			TEL;TYPE=WORK,VOICE:		(111) 555-1212
			TEL;TYPE=HOME,VOICE:		(404) 555-1212
			EMAIL;TYPE=PREF,INTERNET:	forrestgump@example.com

			END:VCARD

		';

	} // end if

?>
