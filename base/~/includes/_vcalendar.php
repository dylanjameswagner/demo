<?php

	// implementation is incomplete

	$d = ($_GET['d'] ? $_GET['d'] : NULL);
	$t = ($_GET['t'] ? $_GET['t'] : NULL);
//	$l = ($_GET['l'] ? $_GET['l'] : NULL);

	$bof = date_format(date_create('2012-04-25 19:00:00'),'Ymd\THis\Z');
//	$eof = date_format(date_create('2012-04-26 02:00:00'),'Ymd\THis\Z');

	if ($t && $d){

	    header('Content-Type: text/calendar; charset=utf-8');
    	header('Content-Disposition: attachment; filename="'.$t.'-'.$bof.'.ics"');

?>
BEGIN:VCALENDAR
VERSION:2.0
BEGIN:VEVENT
UID:emailaddress@example.com
DTSTAMP:20120425T000000Z
DTSTART:20120425
SUMMARY:<?php echo $t."\r"; ?>
DESCRIPTION: This is the description.
END:VEVENT
END:VCALENDAR
<?php

	} // end if

?>
