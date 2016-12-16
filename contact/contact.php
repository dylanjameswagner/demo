<?php
	
	$msg = NULL;

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)):

//		extract($_POST);
		foreach ($_POST as $k => $v):
			$$k = Trim(stripslashes($v));
		endforeach;

		$stateInit = $state.'Selected';
		$$stateInit = ' selected="selected"';

		$preferenceInit = $preference.'Checked';
		$$preferenceInit = ' checked="checked"';

		// validation
		$validated = true;

		$required = array('Name','Email','Phone','Message');

		foreach ($required as $v):
			$title = $v;
			$slug = strtolower($v);
			$slugInit = $slug.'Error';

			if ($$slug == NULL):
				$validated = false;
				$errors[] = $title.' is required.';
				$$slugInit = ' error';
			elseif($slug == 'email'):
				if (!eregi("^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,4}\$",$$slug)):
					$validated = false;
					$errors[] = $title.' appears to be invalid.';
					$$slugInit = ' error';
				endif;
			else:
				$$slugInit = NULL;
			endif;
		endforeach;

		if ($validated):

			$recipient	= 'dwagner@keywebconcepts.com';
			$subject	= 'Client Lead | example.com';

			// email
			$body  = '';
			$body .= 'Name: '.$name;
			$body .= "\n\n";
			$body .= 'Phone: '.$phone;
			$body .= "\n";
			$body .= 'Email: '.$email;
			$body .= "\n\n";

			if ($preference):

			$body .= 'Preference: '.$preference;
			$body .= "\n\n";

			endif;

			if ($address && $city && $state && $zip):

			$body .= 'Address:';
			$body .= "\n";
			$body .= $address;
			$body .= "\n".($unit ? $unit."\n" : NULL);
			$body .= $city.', '.$state.' '.$zip;
			$body .= "\n\n";

			endif;

			$body .= 'Message:';
			$body .= "\n";
			$body .= $message;

			if (mail($recipient,$subject,$body,'From: '.$name.' <'.($email ? $email : $recipient).'>')):
				$msg = 'success';
			else:
				$msg = 'failed';
			endif; // mail

		else: // !$validated

			$msg = 'error';

		endif; // $validated

?>
<?php endif; // REQUEST_METHOD == POST && !empty $_POST ?>

<?php switch ($msg): ?>
<?php case 'success' ?>

			<div id="notice" class="row notice thanks">
				<p>Your message has been sent.</p>
				<p>Thank you.</p>
			</div>

<?php break; ?>
<?php case 'failed' ?>

			<div id="notice" class="row notice thanks">
				<p>The server was unable to send your message.</p>
				<p>Please contact <a href="mailto:<?php echo $recipient; ?>"><?php echo $recipient; ?></a> directly.</p>
			</div>

<?php break; ?>
<?php case 'error': ?>

			<div id="notice" class="row notice error">
				<p>Please check all required fields.</p>
				<ul>
<?php foreach ($errors as $error): ?>
					<li><?php echo $error; ?></li>
<?php endforeach; ?>
				</ul>
			</div>

<?php break; ?>
<?php endswitch; ?>

<?php if ($msg != 'success'): ?>

		<form class="<?php // echo $msg; ?>" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">

			<p class="name required<?php echo $nameError; ?>"><label for="name">Name <small>Required</small></label>
				<input type="text" name="name" id="name" value="<?php echo $name; ?>"/></p>

			<p class="email required<?php echo $emailError; ?>"><label for="email">Email <small>Required</small></label>
				<input type="text" name="email" id="email" value="<?php echo $email; ?>"/></p>

			<p class="phone required<?php echo $phoneError; ?>"><label for="phone">Phone <small>Required</small></label>
				<input type="text" name="phone" id="phone" value="<?php echo $phone; ?>"/></p>

			<p class="address"><label for="address">Address</label>
				<input type="text" name="address" id="address" value="<?php echo $address; ?>"/></p>
			<p class="unit">
				<label for="unit">Unit</label>
				<input type="text" name="unit" id="unit" value="<?php echo $unit; ?>"/></p>

			<div class="row">

			<p class="col city"><label for="city">City</label>
				<input type="text" name="city" id="city" value="<?php echo $city; ?>"/></p>

			<p class="col state"><label for="state">State</label>
				<select id="state" name="state">
					<option value="-1">Select</option>
					<option value="AL"<?php echo $ALSelected; ?>>Alabama</option>
					<option value="AK"<?php echo $AKSelected; ?>>Alaska</option>
					<option value="AZ"<?php echo $AZSelected; ?>>Arizona</option>
					<option value="AR"<?php echo $ARSelected; ?>>Arkansas</option>
					<option value="CA"<?php echo $CASelected; ?>>California</option>
					<option value="CO"<?php echo $COSelected; ?>>Colorado</option>
					<option value="CT"<?php echo $CTSelected; ?>>Connecticut</option>
					<option value="DE"<?php echo $DESelected; ?>>Delaware</option>
					<option value="DC"<?php echo $DCSelected; ?>>District Of Columbia</option>
					<option value="FL"<?php echo $FLSelected; ?>>Florida</option>
					<option value="GA"<?php echo $GASelected; ?>>Georgia</option>
					<option value="HI"<?php echo $HISelected; ?>>Hawaii</option>
					<option value="ID"<?php echo $IDSelected; ?>>Idaho</option>
					<option value="IL"<?php echo $ILSelected; ?>>Illinois</option>
					<option value="IN"<?php echo $INSelected; ?>>Indiana</option>
					<option value="IA"<?php echo $IASelected; ?>>Iowa</option>
					<option value="KS"<?php echo $KSSelected; ?>>Kansas</option>
					<option value="KY"<?php echo $KYSelected; ?>>Kentucky</option>
					<option value="LA"<?php echo $LASelected; ?>>Louisiana</option>
					<option value="ME"<?php echo $MESelected; ?>>Maine</option>
					<option value="MD"<?php echo $MDSelected; ?>>Maryland</option>
					<option value="MA"<?php echo $MASelected; ?>>Massachusetts</option>
					<option value="MI"<?php echo $MISelected; ?>>Michigan</option>
					<option value="MN"<?php echo $MNSelected; ?>>Minnesota</option>
					<option value="MS"<?php echo $MSSelected; ?>>Mississippi</option>
					<option value="MO"<?php echo $MOSelected; ?>>Missouri</option>
					<option value="MT"<?php echo $MTSelected; ?>>Montana</option>
					<option value="NE"<?php echo $NESelected; ?>>Nebraska</option>
					<option value="NV"<?php echo $NVSelected; ?>>Nevada</option>
					<option value="NH"<?php echo $NHSelected; ?>>New Hampshire</option>
					<option value="NJ"<?php echo $NJSelected; ?>>New Jersey</option>
					<option value="NM"<?php echo $NMSelected; ?>>New Mexico</option>
					<option value="NY"<?php echo $NYSelected; ?>>New York</option>
					<option value="NC"<?php echo $NCSelected; ?>>North Carolina</option>
					<option value="ND"<?php echo $NDSelected; ?>>North Dakota</option>
					<option value="OH"<?php echo $OHSelected; ?>>Ohio</option>
					<option value="OK"<?php echo $OKSelected; ?>>Oklahoma</option>
					<option value="OR"<?php echo $ORSelected; ?>>Oregon</option>
					<option value="PA"<?php echo $PASelected; ?>>Pennsylvania</option>
					<option value="RI"<?php echo $RISelected; ?>>Rhode Island</option>
					<option value="SC"<?php echo $SCSelected; ?>>South Carolina</option>
					<option value="SD"<?php echo $SDSelected; ?>>South Dakota</option>
					<option value="TN"<?php echo $TNSelected; ?>>Tennessee</option>
					<option value="TX"<?php echo $TXSelected; ?>>Texas</option>
					<option value="UT"<?php echo $UTSelected; ?>>Utah</option>
					<option value="VT"<?php echo $VTSelected; ?>>Vermont</option>
					<option value="VA"<?php echo $VASelected; ?>>Virginia</option>
					<option value="WA"<?php echo $WASelected; ?>>Washington</option>
					<option value="WV"<?php echo $WVSelected; ?>>West Virginia</option>
					<option value="WI"<?php echo $WISelected; ?>>Wisconsin</option>
					<option value="WY"<?php echo $WYSelected; ?>>Wyoming</option>
				</select></p>
			
			<p class="col zip"><label for="zip">Zip</label>
				<input type="text" size="5" maxlength="5" name="zip" id="zip" value="<?php echo $zip; ?>"/></p>

			</div>

			<p class="message required<?php echo $messageError; ?>"><label for="message">Message <small>Required</small></label>
				<textarea rows="10" cols="20" name="message" id="message"><?php echo $message; ?></textarea></p>

			<p class="referrer"><label for="referrer">How did you find us?</label>
				<input type="text" id="referrer" name="referrer" value="<?php echo $referrer; ?>"/></p>

			<p class="row preference"><label for"preference">Contact Preference</label>
				<label><input type="radio" id="preference1" name="preference" value="email"<?php echo $emailChecked; ?>/> Email</label>
				<label><input type="radio" id="preference2" name="preference" value="phone"<?php echo $phoneChecked; ?>/> Phone</label></p>

			<p class="sumbit"><input type="submit" class="button" name="submit" value="Submit"/></p>

		</form>

<?php endif; // $msg != success ?>
