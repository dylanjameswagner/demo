<?php

	// -------------------------------------------------------------------- //
	// contact.php

	// recaptcha ---------------------------------------------------------- //
	include 'recaptcha/recaptchalib.php';

	$key_public = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
	$key_private = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

	$resp = NULL; // the response from reCAPTCHA
	$error = NULL; // the error code from reCAPTCHA, if any

?>
					<h3 class="jc">Send Us A Message:</h3>
					<form id="contact-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		if (!empty($_POST)){
			extract($_POST);														// corresponding named var

			$required = array($name,$email,$message);								// required fields

			if (in_array(NULL,$required)){ $msg = 'Please fill out all required fields.'; }
			else {							$msg = 'Thank you for your interest.';

/* errors array
	// check to see if the required fields were filled
		if (!$_POST['contact_sender_name']){

			$errors_array[] = 'Name is required.';

		}

		// validate email
		if (!$_POST['contact_sender_email']){

			$errors_array[] = 'E-mail is required.';

		} else {

			if (!eregi("^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,4}\$", $cnt_sender_email)){

				$errors_array[] = 'E-mail appears to be invalid.';

			}

		}

		if (!$_POST['contact_sender_phone']){

			$errors_array[] = 'Phone is required.';

		}

		if (!$_POST['contact_sender_text']){

			$errors_array[] = 'Message is required.';

		}

		// error report --------------------------------------------- //
		// if no errors show preview and send
		if (count($errors_array) > 0){

			echo "\t\t\t\t\t".'<p class="contact_preview_warning"><strong>Warning:</strong> Your message has not yet been sent; the form contained errors.<br /><br />'.PHP_EOL;
			echo "\t\t\t\t\t\t".'Please go back and edit / enter the required infrmation.</p>'.PHP_EOL;
			echo "\t\t\t\t\t".'<ul>'.PHP_EOL;

			foreach ($errors_array as $err){

				echo "\t\t\t\t\t\t".'<li class="contact_preview_error"><strong>Error:</strong> '.$err.'</li>'.PHP_EOL;

			}

			echo "\t\t\t\t\t".'</ul>'.PHP_EOL;
*/

				if ($_POST["recaptcha_response_field"]){								// captcha response
					$resp = recaptcha_check_answer ($key_private,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);

					if ($resp->is_valid){												// captcha passed
						echo "You got it!";

						$recipient_name		= 'Trusted Property Group';
						$recipient_email	= 'dylanjameswagner@gmail.com';
						$recipient			= $recipient_name.' <'.$recipient_email.'>';

						$sender_name		= $name;
						$sender_email		= $email;
						$sender				= $sender_name.' <'.$sender_email.'>';

						$date				= $datetime.' '.$timezone;

						$subject			= 'trustedpropertygroup.com';


					// preview -------------------------------------------------------- //
					$preview .= tab(6).'<fieldset>';
					$preview .= tab(7).'<legend>Message Preview</legend>';
					$preview .= tab(7).'<p class="jc">Please check your message for errors.<br/>'.PHP_EOL;

					// preview
					$preview .= tab(7).'<p><strong>To:</strong>&nbsp; '.$recipient_name.' &lt;<a href="mailto:'.$recipient_email.'">'.$recipient_email.'</a>&gt;<br/>'.PHP_EOL;
					$preview .= tab(8).'<strong>From:</strong>&nbsp; '.$name.' &lt;<a href="mailto:'.$email.'">'.$email.'</a>&gt;<br/>'.PHP_EOL;
//					$preview .= tab(8).'<strong>Date:</strong>&nbsp; '.$date.'</p>'.PHP_EOL;
//					$preview .= tab(7).'<p><strong>Subject:</strong>&nbsp; '.$subject.'</p>'.PHP_EOL;
//					$preview .= tab(7).'<p><strong>Company:</strong>&nbsp; '.$company.'<br/>'.PHP_EOL;
//					$preview .= tab(7).'<p><strong>Name:</strong>&nbsp; '.$name.'</p>'.PHP_EOL;
//					$preview .= tab(7).'<p><strong>Address:</strong>&nbsp; '.$street.$apt.'<br/>'.PHP_EOL;
//					$preview .= tab(8).$city.', '.$state.' '.$code.'</p>'.PHP_EOL;
					$preview .= tab(7).'<p><strong>Phone:</strong>&nbsp; '.$phone.'<br/>'.PHP_EOL;
//					$preview .= tab(8).'<strong>Mobile:</strong>&nbsp; '.$mobile.'<br/>'.PHP_EOL;
//					$preview .= tab(8).'<strong>Fax:</strong>&nbsp; '.$fax.'</p>'.PHP_EOL;
//					$preview .= tab(7).'<p><strong>URL:</strong>&nbsp; '.$url.'</p>'.PHP_EOL;
//					$preview .= tab(7).'<p><strong>Birthdate:</strong>&nbsp; '.$birthdate.'</p>'.PHP_EOL;
//					$preview .= tab(7).'<p><strong>Deadline:</strong>&nbsp; '.$deadline.'</p>'.PHP_EOL;
					$preview .= tab(7).'<p><strong>Message:</strong><br/>'.PHP_EOL;
					$preview .= tab(8).'<span class="contact_preview_text">'.$message.'</span></p>'.PHP_EOL;
					$preview .= tab(7).'<p><strong>Referrer:</strong>&nbsp; '.$referrer.'</p>'.PHP_EOL;

/*					$preview .= tab(7).'<dl>'.PHP_EOL;

					foreach ($_POST as $k => $v){
						if ($k !== 'submit'){
							$preview .= tab(8).'<dt>';

							if ($k == 'email'){ $preview .= 'E-mail'; } // hyphenate email
							else {				 $preview .= ucwords($k); }

							$preview .= '</dt> <dd>';

							if (is_array($v)){
								foreach ($v as $k2 => $v2){
									if ($k2){	 $preview .= ', '; }
												 $preview .= $v2;
								}
							} else {
								if (!$v){		 $preview .= '&nbsp;'; }
								else {			 $preview .= $v; }
							}
							$preview .= '</dd>'.PHP_EOL;
						}
					}
					$preview .= tab(7).'</dl>'.PHP_EOL;
*/
					$preview .= tab(6).'</fieldset>'.PHP_EOL;

					if ($_POST['submit'] == 'Preview Message'){

						echo $preview;													// display preview
?>
						<div>
							<input type="hidden" name="name" value="<?php echo $name; ?>"/>
							<input type="hidden" name="email" value="<?php echo $email; ?>"/>
							<input type="hidden" name="phone" value="<?php echo $phone; ?>"/>
							<input type="hidden" name="message" value="<?php echo $message; ?>"/>
							<input type="hidden" name="referrer" value="<?php echo $referrer; ?>"/>
							<input type="hidden" name="method" value="<?php echo $method; ?>"/>
						</div>
						<p class="jr"><input type="button" name="edit" value="Edit" onclick="history.go(-1);return true;"/>&nbsp; <input type="submit" name="submit" value="Send Message"/></p>
<?php
					} else {
						// content ---------------------------------------------------- //
						// plain
//						$content_text  = 'To: '.$recipient.PHP_EOL;
						$content_text .= 'From:  '.$sender."\n\n";
						$content_text .= 'Date:  '.$date."\n\n";
//						$content_text .= 'Subject:  '.$subject.PHP_EOL;

//						$content_text .= 'Company:  '.$company.PHP_EOL;
						$content_text .= 'Name:  '.$name."\n\n";
//						$content_text .= 'Address:  '.$address."\n\n";
						$content_text .= 'Phone:  '.$phone."\n\n";
//						$content_text .= 'Mobile:  '.$mobile."\n\n";
//						$content_text .= 'Fax:  '.$fax.PHP_EOL;
//						$content_text .= 'URL:  '.$url.PHP_EOL;
//						$content_text .= 'Birthdate:  '.$birthdate.PHP_EOL;
						$content_text .= 'Message:'.PHP_EOL.$message."\n\n";
						$content_text .= 'Referrer:  '.$referrer.PHP_EOL;

						// html
						$content_html  = '<!DOCTYPE html PUBLIC'.PHP_EOL;
						$content_html .= tab(1).'"-//W3C//DTD XHTML 1.0 Strict//EN"'.PHP_EOL;
						$content_html .= tab(1).'"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'."\n\n";
						$content_html .= '<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">'."\n\n";
						$content_html .= tab(1).'<head>'.PHP_EOL;
						$content_html .= tab(2).'<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>'.PHP_EOL;
						$content_html .= tab(2).'<meta http-equiv="content-style-type" content="text/css"/>'."\n\n";
						$content_html .= tab(2).'<title>'.$subject.'</title>'."\n\n";
						$content_html .= tab(2).'<link rel="stylesheet" type="text/css" href="http://dylanjameswagner.com/jquery/styles/email.css" />'.PHP_EOL;
						$content_html .= tab(1).'</head>'."\n\n";
						$content_html .= tab(1).'<body>'.PHP_EOL;

						$content_html .= $preview; // see below

						$content_html .= tab(1).'</body>'.PHP_EOL;
						$content_html .= '</html>'.PHP_EOL;

						// build ------------------------------------------------------ //
						$boundary = 'x_Multipart_x'.md5(mt_rand()).'x_Boundary_x';

						// header
						$header  = 'MIME-Version: 1.0'."\r\n";
//						$header .= 'To: '.$recipient;
						$header .= 'From: '.$sender."\r\n";
//						$header .= 'Cc: '.$sender2."\r\n";
//						$header .= 'Bcc: '.$sender3."\r\n";
//						$header .= 'Reply-To: '.$sender_email."\r\n";
//						$header .= 'Date: '.$date."\r\n";
//						$header .= 'Subject: '.$subject."\r\n";

//						$header .= 'Content-Type: multipart/mixed; boundary="{'.$boundary.'}"'."\r\n";
//						$header .= 'Content-Transfer-Encoding: 7bit'."\r\n";
//						$header .= 'Content-Description:'."\r\n";
//						$header .= 'This is a multi-part message in MIME format.'."\r\n";

						// plain
						$content  = '--'.$boundary."\r\n";
						$content .= 'Content-Type: text/plain; charset=UTF-8'."\r\n";
						$content .= 'Content-Transfer-Encoding: 7bit'."\r\n";
						$content .= $content_text."\n\n";

						// xhtml
						$content .= '--'.$boundary.PHP_EOL;
						$content .= 'Content-Type: text/plain; charset=UTF-8'.PHP_EOL;
						$content .= 'Content-Transfer-Encoding: base64'.PHP_EOL;
						$content .= $content_html."\n\n";

/* send html email
$name = strip_tags($fname." ".$lname);

$to = 'cgloss1@gmail.com';

$subject = "Approve or Deny $name";

$headers = "From: Trusted Property Group\r\n";
$headers .= "Reply-To: ". strip_tags($email) . "\r\n";
$headers .= "CC:\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$message = '<html><body>';
$message .= '<img src="http://www.cgloss.com/tpg/lib/images/tgp_logo.png" alt="Trusted Property Group" />';
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . $name . "</td></tr>";

foreach($_POST as $key => $value){
	$unseen=array(fname,lname,password,confirmpwd,submit);
	if (in_array($key, $unseen)){continue;}
	$message .= "<tr><td><strong>".str_replace('_',' ',$key).":</strong></td><td>" . strip_tags($value) . "</td></tr>";
}

$message .= "<tr><td><strong>Approve or Deny:</strong> </td><td>" . '<a href="http://www.cgloss.com/tpg/?rel=admin&adminlink&name='.$name.'&type='.$register_type.'&process=approved&id='.$id.'">approve</a> or <a href="http://www.cgloss.com/tpg/?rel=admin&adminlink&name='.$name.'&type='.$register_type.'&process=denied&id='.$id.'">deny</a>' . "</td></tr>";

$message .= "</table>";
$message .= "</body></html>";

mail($to, $subject, $message, $headers);

//	end send html email */

							// send ------------------------------------------------------- //
							if (mail($recipient_email,$subject,$content_text,$header)){
								// copy to sender
								// mail($sender_email, $subject, $content, $header);
								echo '<p class="jc"><strong>Notice:</strong> Your message has been sent.</p>'.PHP_EOL;
								echo '<p class="jc">Thank You.<p>'.PHP_EOL;
							} else {
								echo '<p class="alert jc"><strong>Warning:</strong> Your message could not be sent. Please contact the site administrator.<br/><br/>'.PHP_EOL;
								echo tab(1).'<a href="mailto:'.$recipient.'">'.$recipient.'</a></p>'.PHP_EOL;
							} // end if mail
						} // end if post submit preview
					} else {
						$error = $resp->error;													// set the error code so that we can display it
						$msg = '<p class="alert">'.$error.'</p>';
					} // end if captcha passed
				} else {
					echo tab(6).'<p>You have not filled out the form.</p>';
				} // end if captcha passed
			} // end if required
		} // end if !empty post
	} else {
?>
						<h3 class="labels">Contact Form</h3>
<?php
		if ($msg){
?>
						<p class="alert"><?php echo $msg; ?></p>
<?php
		} // end if $msg
?>
						<fieldset>
							<p id="contact-name"><label for="name">Name: <small>Required</small></label>			<input type="text" id="name" name="name" class="name required" value="<?php echo $name; ?>"/></p>
							<p id="contact-email"><label for="email">E-mail: <small>Required</small></label>		<input type="text" id="email" name="email" class="email required" value="<?php echo $email; ?>"/></p>
							<p id="contact-phone"><label for="phone">Phone:</label>									<input type="text" id="phone" name="phone" class="phone required" value="<?php echo $phone; ?>"/></p>
							<p id="contact-message"><label for="message">Message: <small>Required</small></label>	<textarea id="message" name="message" class="required" cols="40" rows="12"><?php echo $message; ?></textarea></p>
							<p id="contact-referrer"><label for="referrer">How did you find us?</label>				<input type="text" id="referrer" name="referrer" value="<?php echo $referrer; ?>"/></p>
							<p id="contact-method"><span>Preference:</span>											<label><input type="radio" id="method1" name="method" value="E-mail"<?php if ($method == 'E-mail'){ ?> checked="checked"<?php } ?>/> E-mail</label>
																													<label><input type="radio" id="method2" name="method" value="Phone"<?php if ($method == 'Phone'){ ?> checked="checked"<?php } ?>/> Phone</label></p>
<!--						<p id="contact-captcha"><label for="captcha">Human Verification Question <small>Required</small></label> <span><b>seven + four =</b> <input type="text" id="captcha" name="captcha" class="required"/></span></p> -->
						</fieldset>
						<script>
							var RecaptchaOptions = { theme : 'clean' };
						</script>
<?php echo recaptcha_get_html($key_public,$error); ?>
						<p id="preview" class="jr"><input type="submit" name="submit" value="Preview Message"/></p>
<?php
	} // end if request_method post
?>
					</form><!--#contact_form-->
