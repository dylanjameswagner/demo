<?php
/* https://mytechscraps.wordpress.com/2014/05/15/accessing-google-calendar-using-the-php-api/ */
require_once __DIR__.'/google-api-php-client-master/src/Google/Client.php';
require_once __DIR__.'/google-api-php-client-master/src/Google/Service/Calendar.php';

// Service Account info
$client_id = 'replace with Service Account Client Id';
$service_account_name = 'replace with Service Account Email Address';
$key_file_location = 'replace with Service Account Private Key filename';

// Calendar id
$calName = 'replace with Calendar ID';


$client = new Google_Client();
$client->setApplicationName("Calendar test");

$service = new Google_Service_Calendar($client);

$key = file_get_contents($key_file_location);
$cred = new Google_Auth_AssertionCredentials(
 $service_account_name,
 array('https://www.googleapis.com/auth/calendar.readonly'),
 $key
);

$client->setAssertionCredentials($cred);

$cals = $service->calendarList->listCalendarList();
print_r($cals);
//exit;

// Convert recurring events to single events
// Look for events in the next week - now to now+1week
$params = array(
 'singleEvents' => TRUE,
 'timeMin' => (new DateTime())->format(DateTime::RFC3339),
 'timeMax' => (new DateTime())->add(new DateInterval('P1W'))->format(DateTime::RFC3339),
);
$events = $service->events->listEvents($calName, $params);

foreach ($events->getItems() as $event) {
 echo "Summary:  ", $event->getSummary(), "\n";
 echo "Location: ", $event->getLocation(), "\n";
 echo "Start:    ", fmt_gdate($event->getStart()), "\n";
 echo "End:      ", fmt_gdate($event->getEnd()), "\n";
}

function fmt_gdate( $gdate ) {
  if ($val = $gdate->getDateTime()) {
    return (new DateTime($val))->format( 'd/m/Y H:i' );
  } else if ($val = $gdate->getDate()) {
    return (new DateTime($val))->format( 'd/m/Y' ) . ' (all day)';
  }
}
