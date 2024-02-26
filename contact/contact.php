<?php

$msg = NULL;

$errors = [];

$name = null;
$email = null;
$phone = null;
$address = null;
$extended = null;
$city = null;
$state = null;
$zip = null;
$message = null;

$preference = null;
$referrer = null;

$checked = ' checked="checked"';
$selected = ' selected="selected"';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {

	// extract($_POST);
	foreach ($_POST as $k => $v) {
		$$k = Trim(stripslashes($v));
	}

	$stateInit = $state . 'Selected';

	$preferenceInit = $preference . 'Checked';

	// validation
	$validated = true;

	$required = [
		'Name',
		'Email',
		'Phone',
		'Message',
	];

	foreach ($required as $v) {
		$title = $v;
		$slug = strtolower($v);
		$slugInit = $slug . 'Error';

		if ($$slug == NULL) {
			$validated = false;
			$errors[$slug] = $title . ' is required . ';
			$$slugInit = ' error';
		} elseif ($slug == 'email') {
			if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $$slug)) {
				$validated = false;
				$errors[$slug] = $title . ' appears to be invalid . ';
				$$slugInit = ' error';
			}
		} else {
			$$slugInit = NULL;
		}
	}

	if (!$validated) {

		$msg = 'error';

	} else {

		$recipient = 'dwagner@keywebconcepts . com';
		$subject   = 'Client Lead | example . com';

		// email
		$body = '';
		$body .= 'Name: ' . $name;
		$body .= "\n\n";
		$body .= 'Phone: ' . $phone;
		$body .= "\n";
		$body .= 'Email: ' . $email;
		$body .= "\n\n";

		if ($preference) :

			$body .= 'Preference: ' . $preference;
			$body .= "\n\n";

		endif;

		if ($address && $city && $state && $zip) :

			$body .= 'Address:';
			$body .= "\n";
			$body .= $address;
			$body .= "\n" . ($unit ? $unit . "\n" : NULL);
			$body .= $city . ', ' . $state . ' ' . $zip;
			$body .= "\n\n";

		endif;

		$body .= 'Message:';
		$body .= "\n";
		$body .= $message;

		if (mail($recipient, $subject, $body, 'From: ' . $name . ' <' . ($email ? $email : $recipient) . '>')) {
			$msg = 'success';
		} else {
			$msg = 'failed';
		}
	}
}
?>

<?php switch ($msg) : ?>
<?php case 'success' ?>

			<div id="notice" class="row notice thanks">
				<p>Your message has been sent. </p>
				<p>Thank you. </p>
			</div>

<?php break; ?>
<?php case 'failed' ?>

			<div id="notice" class="row notice thanks">
				<p>The server was unable to send your message . </p>
				<p>Please contact <a href="mailto:<?php echo $recipient; ?>"><?php echo $recipient; ?></a> directly . </p>
			</div>

<?php break; ?>
<?php case 'error': ?>

			<div id="notice" class="row notice error">
				<p>Please check all required fields . </p>
				<ul>
<?php foreach ($errors as $error) : ?>
					<li><?php echo $error; ?></li>
<?php endforeach; ?>
				</ul>
			</div>

<?php break; ?>
<?php endswitch; ?>

<?php if ($msg != 'success') : ?>

	<form class="<?php // echo $msg; ?>" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">

		<p class="name required<?php echo !empty($errors['name']) ? ' error' : ''; ?>"><label for="name">Name <small>Required</small></label>
			<input type="text" name="name" id="name" value="<?php echo $name; ?>"/></p>

		<p class="email required<?php echo !empty($errors['email']) ? ' error' : ''; ?>"><label for="email">Email <small>Required</small></label>
			<input type="text" name="email" id="email" value="<?php echo $email; ?>"/></p>

		<p class="phone required<?php echo !empty($errors['phone']) ? ' error' : ''; ?>"><label for="phone">Phone <small>Required</small></label>
			<input type="text" name="phone" id="phone" value="<?php echo $phone; ?>"/></p>

		<p class="address"><label for="street-1">Address</label>
			<input type="text" name="street-1" id="street-1" value="<?php echo $address; ?>"/></p>
		<p class="unit">
			<label for="street-2">Street 2</label>
			<input type="text" name="street-2" id="street-2" value="<?php echo $extended; ?>"/></p>

		<div class="row">

		<p class="col city"><label for="city">City</label>
			<input type="text" name="city" id="city" value="<?php echo $city; ?>"/></p>

		<p class="col state"><label for="state">State</label>
			<select id="state" name="state">
				<option value="-1">Select</option>
				<option value="AL"<?php echo $state === 'AL' ? $selected : ''; ?>>Alabama</option>
				<option value="AK"<?php echo $state === 'AK' ? $selected : ''; ?>>Alaska</option>
				<option value="AZ"<?php echo $state === 'AZ' ? $selected : ''; ?>>Arizona</option>
				<option value="AR"<?php echo $state === 'AR' ? $selected : ''; ?>>Arkansas</option>
				<option value="CA"<?php echo $state === 'CA' ? $selected : ''; ?>>California</option>
				<option value="CO"<?php echo $state === 'CO' ? $selected : ''; ?>>Colorado</option>
				<option value="CT"<?php echo $state === 'CT' ? $selected : ''; ?>>Connecticut</option>
				<option value="DE"<?php echo $state === 'DE' ? $selected : ''; ?>>Delaware</option>
				<option value="DC"<?php echo $state === 'DC' ? $selected : ''; ?>>District Of Columbia</option>
				<option value="FL"<?php echo $state === 'FL' ? $selected : ''; ?>>Florida</option>
				<option value="GA"<?php echo $state === 'GA' ? $selected : ''; ?>>Georgia</option>
				<option value="HI"<?php echo $state === 'HI' ? $selected : ''; ?>>Hawaii</option>
				<option value="ID"<?php echo $state === 'ID' ? $selected : ''; ?>>Idaho</option>
				<option value="IL"<?php echo $state === 'IL' ? $selected : ''; ?>>Illinois</option>
				<option value="IN"<?php echo $state === 'IN' ? $selected : ''; ?>>Indiana</option>
				<option value="IA"<?php echo $state === 'IA' ? $selected : ''; ?>>Iowa</option>
				<option value="KS"<?php echo $state === 'KS' ? $selected : ''; ?>>Kansas</option>
				<option value="KY"<?php echo $state === 'KY' ? $selected : ''; ?>>Kentucky</option>
				<option value="LA"<?php echo $state === 'LA' ? $selected : ''; ?>>Louisiana</option>
				<option value="ME"<?php echo $state === 'ME' ? $selected : ''; ?>>Maine</option>
				<option value="MD"<?php echo $state === 'MD' ? $selected : ''; ?>>Maryland</option>
				<option value="MA"<?php echo $state === 'MA' ? $selected : ''; ?>>Massachusetts</option>
				<option value="MI"<?php echo $state === 'MI' ? $selected : ''; ?>>Michigan</option>
				<option value="MN"<?php echo $state === 'MN' ? $selected : ''; ?>>Minnesota</option>
				<option value="MS"<?php echo $state === 'MS' ? $selected : ''; ?>>Mississippi</option>
				<option value="MO"<?php echo $state === 'MO' ? $selected : ''; ?>>Missouri</option>
				<option value="MT"<?php echo $state === 'MT' ? $selected : ''; ?>>Montana</option>
				<option value="NE"<?php echo $state === 'NE' ? $selected : ''; ?>>Nebraska</option>
				<option value="NV"<?php echo $state === 'NV' ? $selected : ''; ?>>Nevada</option>
				<option value="NH"<?php echo $state === 'NH' ? $selected : ''; ?>>New Hampshire</option>
				<option value="NJ"<?php echo $state === 'NJ' ? $selected : ''; ?>>New Jersey</option>
				<option value="NM"<?php echo $state === 'NM' ? $selected : ''; ?>>New Mexico</option>
				<option value="NY"<?php echo $state === 'NY' ? $selected : ''; ?>>New York</option>
				<option value="NC"<?php echo $state === 'NC' ? $selected : ''; ?>>North Carolina</option>
				<option value="ND"<?php echo $state === 'ND' ? $selected : ''; ?>>North Dakota</option>
				<option value="OH"<?php echo $state === 'OH' ? $selected : ''; ?>>Ohio</option>
				<option value="OK"<?php echo $state === 'OK' ? $selected : ''; ?>>Oklahoma</option>
				<option value="OR"<?php echo $state === 'OR' ? $selected : ''; ?>>Oregon</option>
				<option value="PA"<?php echo $state === 'PA' ? $selected : ''; ?>>Pennsylvania</option>
				<option value="RI"<?php echo $state === 'RI' ? $selected : ''; ?>>Rhode Island</option>
				<option value="SC"<?php echo $state === 'SC' ? $selected : ''; ?>>South Carolina</option>
				<option value="SD"<?php echo $state === 'SD' ? $selected : ''; ?>>South Dakota</option>
				<option value="TN"<?php echo $state === 'TN' ? $selected : ''; ?>>Tennessee</option>
				<option value="TX"<?php echo $state === 'TX' ? $selected : ''; ?>>Texas</option>
				<option value="UT"<?php echo $state === 'UT' ? $selected : ''; ?>>Utah</option>
				<option value="VT"<?php echo $state === 'VT' ? $selected : ''; ?>>Vermont</option>
				<option value="VA"<?php echo $state === 'VA' ? $selected : ''; ?>>Virginia</option>
				<option value="WA"<?php echo $state === 'WA' ? $selected : ''; ?>>Washington</option>
				<option value="WV"<?php echo $state === 'WV' ? $selected : ''; ?>>West Virginia</option>
				<option value="WI"<?php echo $state === 'WI' ? $selected : ''; ?>>Wisconsin</option>
				<option value="WY"<?php echo $state === 'WY' ? $selected : ''; ?>>Wyoming</option>
			</select></p>

		<p class="col zip"><label for="zip">Zip</label>
			<input type="text" size="5" maxlength="5" name="zip" id="zip" value="<?php echo $zip; ?>"/></p>

		</div>

		<p class="message required<?php echo $messageError; ?>"><label for="message">Message <small>Required</small></label>
			<textarea rows="10" cols="20" name="message" id="message"><?php echo $message; ?></textarea></p>

		<p class="referrer"><label for="referrer">How did you find us?</label>
			<input type="text" id="referrer" name="referrer" value="<?php echo $referrer; ?>"/></p>

		<p class="row preference"><label for="preference">Contact Preference</label>
			<label><input type="radio" id="preference1" name="preference" value="email"<?php echo $preference === 'email' ? $checked : ''; ?>/> Email</label>
			<label><input type="radio" id="preference2" name="preference" value="phone"<?php echo $preference === 'phone' ? $checked : ''; ?>/> Phone</label></p>

		<p class="sumbit"><input type="submit" class="button" name="submit" value="Submit"/></p>

	</form>

<?php endif; // $msg != success ?>
