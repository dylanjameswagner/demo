<?php

	// -------------------------------------------------------------------- //
	// contact.php

?>
					<form id="contact_form" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$recipient_name		= 'Dylan James Wagner';
		$recipient_email	= 'dylanjameswagner@gmail.com';
		$recipient			= $recipient_name.' <'.$recipient_email.'>';

		$sender				= $name.' <'.$email.'>';
		$date				= $datetime.' '.$timezone;

		$subject			= 'dylanjameswagner.com/jquery/';

		if ($_POST['submit'] == 'Preview Message') {
		
			if (!empty($_POST)) {
				extract($_POST);											// corisponding named var

				// preview ------------------------------------------------ //
				$preview  = tab(6).'<h6>Mail Preview</h6>';
				$preview .= tab(6).'<div id="preview">';
				$preview .= tab(7).'<p><strong>Preview:</strong> Check your message for errors.<br />'."\n";
				$preview .= tab(7).'Click <em>Back</em> to edit or <em>Submit</em> to send.</p>'."\n";

				// preview
				$preview .= tab(3).'<strong>To:</strong> '.$recipient_name.' &lt;<a href="mailto:'.$recipient_email.'">'.$recipient_email.'</a>&gt;<br />'."\n";
				$preview .= tab(2).'<p><strong>From:</strong> '.$name.' &lt;<a href="mailto:'.$email.'">'.$email.'</a>&gt;<br />'."\n";
				$preview .= tab(3).'<strong>Date:</strong> '.$date.'</p>'."\n\n";
				$preview .= tab(2).'<p><strong>Subject:</strong> '.$subject.'</p>'."\n";
				$preview .= tab(2).'<p><strong>Company:</strong> '.$company.'<br />'."\n";
				$preview .= tab(3).'<strong>Name:</strong> '.$name.'<br />'."\n";
//				$preview .= tab(3).'<strong>Address:</strong> '.$street.$apt.'<br />'."\n";
//				$preview .= tab(3).$city.', '.$state.' '.$code.'</p>'."\n";
				$preview .= tab(2).'<p><strong>Phone:</strong> '.$phone.'<br />'."\n";
//				$preview .= tab(3).'<strong>Mobile:</strong> '.$mobile.'<br />'."\n";
//				$preview .= tab(3).'<strong>Fax:</strong> '.$fax.'</p>'."\n";
//				$preview .= tab(2).'<p><strong>URL:</strong> '.$url.'</p>'."\n";
//				$preview .= tab(2).'<p><strong>Birthdate:</strong> '.$birthdate.'</p>'."\n";
				$preview .= tab(2).'<p><strong>Deadline:</strong> '.$deadline.'</p>'."\n";
				$preview .= tab(2).'<p><strong>Message:</strong> <span class="contact_preview_text">'.$message.'</span></p>'."\n";
				$preview .= tab(2).'<p><strong>referrer:</strong> '.$referrer.'</p>'."\n";

				$preview .= tab(7).'<dl>'."\n";

				foreach ($_POST as $k => $v) {
					if ($k !== 'submit') {
						$preview .= tab(8).'<dt>';

						if ($k == 'email') { $preview .= 'E-mail'; } // hyphenate email
						else {				 $preview .= ucwords($k); }

						$preview .= '</dt> <dd>';

						if (is_array($v)) {
							foreach ($v as $k2 => $v2) {
								if ($k2) {	 $preview .= ', '; }
											 $preview .= $v2;
							}
						} else {
							if (!$v) {		 $preview .= '&nbsp;'; }
							else {			 $preview .= $v; }
						}
						$preview .= '</dd>'."\n";
					}
				}
				$preview .= tab(7).'</dl>'."\n";
				$preview .= tab(6).'</div>';

				echo $preview;
?>
						<p id="contact_send"><input type="button" name="back" value="Back" onclick="history.go(-1);return true;"/> <input type="submit" name="submit" value="Send Message"/></p>
<?php
			} else {
				echo tab(6).'<p>you have not filled out the form.</p>';
			}
		} else {
			// content ---------------------------------------------------- //
			// plain
			$content_plain  = 'To: '.$recipient."\n";
//			$content_plain .= 'From: '.$sender."\n";
			$content_plain .= 'Date: '.$date."\n\n";
			$content_plain .= 'Subject: '.$subject."\n";

			$content_plain .= 'Company: '.$company."\n";
			$content_plain .= 'Name: '.$name."\n\n";
//			$content_plain .= 'Address: '.$address."\n\n";
			$content_plain .= 'Phone: '.$phone."\n\n";
//			$content_plain .= 'Mobile: '.$mobile."\n\n";
//			$content_plain .= 'Fax: '.$fax."\n";
//			$content_plain .= 'URL: '.$url."\n";
//			$content_plain .= 'Birthdate: '.$birthdate."\n";
			$content_plain .= 'Message:'."\n".$message."\n\n";
			$content_plain .= 'Referrer: '.$referrer."\n";

			// xhtml
			$content_xhtml  = '<!DOCTYPE html PUBLIC'."\n";
			$content_xhtml .= tab(1).'"-//W3C//DTD XHTML 1.0 Strict//EN"'."\n";
			$content_xhtml .= tab(1).'"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'."\n\n";
			$content_xhtml .= '<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">'."\n\n";
			$content_xhtml .= tab(1).'<head>'."\n";
			$content_xhtml .= tab(2).'<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>'."\n";
			$content_xhtml .= tab(2).'<meta http-equiv="content-style-type" content="text/css"/>'."\n\n";
			$content_xhtml .= tab(2).'<title>'.$subject.'</title>'."\n\n";
			$content_xhtml .= tab(2).'<link rel="stylesheet" type="text/css" href="http://dylanjameswagner.com/jquery/css/email.css" />'."\n";
			$content_xhtml .= tab(1).'</head>'."\n\n";
			$content_xhtml .= tab(1).'<body>'."\n";

			$content_xhtml .= $preview."\n"; // see below
			
			$content_xhtml .= tab(2).'</body>'."\n\n";
			$content_xhtml .= '</html>'."\n";

			// build ------------------------------------------------------ //
			$boundary = 'x_Multipart_x'.md5(mt_rand()).'x_Boundary_x';

			// header
			$header  = 'MIME-Version: 1.0'."\r\n";
			$header .= 'To: '.$recipient."\r\n";
			$header .= 'From: '.$sender."\r\n";
//			$header .= 'Cc: '.$sender2."\r\n";
//			$header .= 'Bcc: '.$sender3."\r\n";
			$header .= 'Reply-To: '.$sender_email."\r\n";
			$header .= 'Date: '.$date."\r\n";
			$header .= 'Subject: '.$subject."\r\n";
			$header .= 'Content-Type: multipart/mixed; boundary="{'.$boundary.'}"'."\r\n";
			$header .= 'Content-Transfer-Encoding: 7bit'."\r\n";
			$header .= 'Content-Description:'."\r\n\n"; // maybe only one \n
			$header .= 'This is a multi-part message in MIME format.'."\r\n\n"; // maybe only one \n

			// plain
			$content  = '--'.$boundary."\n";
			$content .= 'Content-Type: text/plain; charset=iso-8859-1'."\n";
			$content .= 'Content-Transfer-Encoding: 7bit'."\n";
			$content .= $content_plain."\n\n";

			// xhtml
			$content .= '--'.$boundary."\n";
			$content .= 'Content-Type: text/plain; charset=iso-8859-1'."\n";
			$content .= 'Content-Transfer-Encoding: base64'."\n";
			$content .= $content_xhtml."\n\n";
			
			// send ------------------------------------------------------- //
			if (mail($recipient_email, $subject, $content, $header)) {
				// copy to sender
				// mail($sender_email, $subject, $content, $header);
				echo '<p><strong>Notice:</strong> Your message has been sent.</p>'."\n";
				echo '<p>Thank You.<p>'."\n";
			} else {
				echo '<p class="alert"><strong>Warning:</strong> Your message could not be sent. Please contact the site administrator.<br /><br />'."\n";
				echo tab(1).'<a href="mailto:'.$recipient.'">'.$recipient.'</a></p>'."\n";
			}
		}
	} else {
?>
						<h3 class="labels">Contact Form</h3>
						<p id="contact_company"><label for="company">Company</label> <input type="text" id="company" name="company" class="company"/></p>
						<p id="contact_name"><label for="name">Name <small>Required</small></label> <input type="text" id="name" name="name" class="name required"/></p>
						<p id="contact_email"><label for="email">E-mail <small>Required</small></label> <input type="text" id="email" name="email" class="email required"/></p>
						<p id="contact_phone"><label for="phone">Phone</label> <input type="text" id="phone" name="phone" class="phone"/></p>
						<p id="contact_referrer"><label for="referrer">How did you find me?</label> <input type="text" id="referrer" name="referrer"/></p>
						<p id="contact_subject"><label for="subject">Area of Inquiry</label>
							<select id="subject" name="subject">
								<option value="General Inquiry">General Inquiry</option>
								<option value="Web Design">Web Design</option>
								<option value="Graphic Design">Graphic Design</option>
								<option value="Identity Design">Identity Design</option>
							</select></p>
						<p id="contact_deadline"><label for="deadline">Project Deadline</label> <input type="text" id="deadline" name="deadline" class="date"/></p>
						<p id="contact_message"><label for="message">Message <small>Required</small></label> <textarea id="message" name="message" class="required" cols="40" rows="12"></textarea></p>
						<p id="contact_method"><span>Contact Preference</span> <label><input type="radio" id="method[]" name="method" value="Phone"/> Phone</label> <label><input type="radio" id="radio[]" name="method" value="E-mail" checked="checked"/> E-mail</label></p>
						<p id="contact_method"><span>Checkboxes</span> <label><input type="checkbox" id="checkbox[]" name="checkbox[]" value="Item1"/> Item1</label> <label><input type="checkbox" id="checkbox[]" name="checkbox[]" value="Item2"/> Item2</label></p>
						<p id="contact_captcha"><label for="captcha">Human Verification Question <small>Required</small></label> <span><b>seven + four =</b> <input type="text" id="captcha" name="captcha" class="required"/></span></p>
						<p id="contact_preview"><input type="submit" name="submit" value="Preview Message"/></p>
<?php
	}
?>
					</form><!-- #contact_form -->
