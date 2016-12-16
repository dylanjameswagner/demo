<?php

	// -------------------------------------------------------------------- //
	// form.php

	extract($_POST);

	if (empty($_POST)) {
		echo '<p>you have not filled out the form.</p>';
	}
	
	foreach ($_POST as $k => $v) {
		echo $k.' : '.$v.'<br/>';
	}
?>
