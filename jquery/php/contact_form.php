<?php	

	// Name:		SiteBase CMS
	// Description:	A basic PHP/XHTML/CSS Content Managment System for hand coding.
	// Author:		Dylan James Wagner
	// E-mail:		dylanjameswagner@gmail.com
	// URL:			http://dylanjameswagner.com/
	// Project:		http://rudysmith.com/
	// Date:		2009-01-04
	// Version:		0.2

	// -------------------------------------------------------------- //
	// contact.php

	// Contact form.

	// to-do:
	// add check box to form asking if sender would like CC'd.
	// use the preview as actual content for the email.
	// look into constant contact check box.
	// revamp code to use functions.
	// use check file types for attachments

//	$inf = 2;
//	include ('configuration.php');
//	include ('common.php');

	// xhtml source tab depth
	function source_tab(&$tab, $tab_depth) {
		$tab = str_repeat("\t", $tab_depth);
	}
	// site contact information ------------------------------------- //
	// contact form multi recipients & allow attachments
	// details defined in contact information below
	$cnt_multi = false;
	$cnt_attach = false;

	$cnt_ste_name = 'info';
	$cnt_ste_email = $cnt_ste_name.'@'.$ste_domain;

	$cnt_subject = $ste_name.' &raquo; Contact Form';

	// multi recipient - display order & display case sensitive
	$cnt_multi_name[] = array('rudy', 'Rudy Smith');
	$cnt_multi_name[] = array('admin', 'Admin');
	$cnt_multi_name[] = array('info', 'Info');
	$cnt_multi_name[] = array('sales', 'Sales');

	// author contact information ----------------------------------- //
	$cnt_author_name = 'Rudy Smith Service, Inc.';
	$cnt_author_street = '425 N. Claiborne Ave.';
	$cnt_author_apt = '';
	$cnt_author_city = 'New Orleans';
	$cnt_author_state = 'LA';
	$cnt_author_code = '70112';
	$cnt_author_phone = '504-522-8123';
	$cnt_author_fax = '504-522-6957';
	$cnt_author_800 = '800-000-0000';
	$cnt_author_mobile = '000-000-0000';
	$cnt_author_email = $cnt_ste_email;
	$cnt_author_url = 'http://'.$ste_domain;

	// author xhtml formatting
	$cnt_author = '<div id="cnt_author">'."\n";
	$cnt_author .= "\t".'<p>'.$cnt_author_name.'<br />'."\n";
	$cnt_author .= "\t\t".$cnt_author_street.'<br />'."\n";
	$cnt_author .= "\t\t".$cnt_author_city.', '.$cnt_author_state.' '.$cnt_author_code.'</p>'."\n";

	$cnt_author .= "\t".'<p>Phone: '.$cnt_author_phone.'<br />'."\n";
//	$cnt_author .= "\t\t".'Fax: '.$cnt_author_fax.'<br />'."\n";
//	$cnt_author .= "\t\t".'Mobile: '.$cnt_author_mobile.'<br />'."\n";
//	$cnt_author .= "\t\t".'E-mail: <a href="mailto:'.$cnt_ste_email.'">'.$cnt_ste_email.'</a></p>'."\n";
	$cnt_author .= '</div>'."\n";

	// developer contact information -------------------------------- //
	// dylan james wagner
	$cnt_des_name = 'Dylan James Wagner';
	$cnt_des_street = '1427 Bourbon St.';
	$cnt_des_apt = 'Apt. A';
	$cnt_des_city = 'New Orleans';
	$cnt_des_state = 'LA';
	$cnt_des_code = '70116-2008';
	$cnt_des_phone = '000-000-0000';
	$cnt_des_fax = '000-000-0000';
	$cnt_des_800 = '800-000-0000';	
	$cnt_des_mobile = '267-207-9625';
	$cnt_des_email = 'dylanjameswagner@gmail.com';
	$cnt_des_url = 'http://dylanjameswagner.com';

	$cnt_des_label = 'Design:';
	$cnt_des_tagline = 'Creative Designer - Graphic &amp; Web.';

	// point2point
	$cnt_dev_name = 'point2point';
	$cnt_dev_street = 'P.O Box 850257';
	$cnt_dev_apt = '';
	$cnt_dev_city = 'New Orleans';
	$cnt_dev_state = 'LA';
	$cnt_dev_code = '70115';
	$cnt_dev_phone = '504-324-2993';
	$cnt_dev_fax = '866-338-6222';
	$cnt_dev_800 = '800-290-1892';
	$cnt_dev_mobile = '000-000-0000';
	
	// contact form items ------------------------------------------- //
	// display order & case sensitive
	// [name / id], [display name], [auto fill], [max length], [required]
	
//	$cnt_var[] = array('subject','Subject', $cnt_subject, '', false);
//	$cnt_var[] = array('company', 'Company', 'Mega Enterprises', '', false);
	$cnt_var[] = array('name', 'Name', 'John Q. Boss, CEO', '', true);
//	$cnt_var[] = array('street', 'Street', '123 S. Main Street', '', false);
//	$cnt_var[] = array('apt', 'Apt', 'Suite 4', '', false);
//	$cnt_var[] = array('city', 'City', 'Anytown', '', false);
//	$cnt_var[] = array('state', 'State', 'ST', 2, false);
//	$cnt_var[] = array('code', 'Postal Code', '12345-6789', 10, false);
//	$cnt_var[] = array('country', 'Country', 'USA', '', false);
	$cnt_var[] = array('email', 'E-mail', 'bossjq@megaenterprises.com', '', true);
	$cnt_var[] = array('text', 'Message', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Quisque nec quam at nunc semper iaculis. Aliquam ante ligula, varius eget, euismod ut, mattis sit amet, nisi. Morbi a dui. Duis id elit ut elit ultrices pellentesque.', '', true);
	$cnt_var[] = array('phone', 'Phone', '012-345-6789', 12, false);
//	$cnt_var[] = array('fax', 'Fax', '123-456-7890', 12, false);
//	$cnt_var[] = array('mobile', 'Mobile', '098-765-4321', 12, false);
	$cnt_var[] = array('referr', 'How did you find us?', 'Google web search', '', false);
	$cnt_var[] = array('url', 'URL', 'megaenterprises.com', '', false);
//	$cnt_var[] = array('birthdate', 'Birthdate', '1975-01-31', 8, false);

	// contact form max attachments, size & file types
	$cnt_attach_limit = 4;
	$cnt_attach_size = 512000;
	$cnt_attach_type = array('jpg', 'gif', 'png', 'eps', 'doc', 'pdf', 'psd', 'ai', 'zip', 'rar');
	
	source_tab($tab, 4);

	$cnt_self = '';

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		// basic settings ------------------------------------------- //
		$cnt_self = $_SERVER['PHP_SELF'];

		// check status of form
		$status = stripslashes($_POST['status']);

		// combine recipient info
		$cnt_recipient = $cnt_recipient_name.' <'.$cnt_recipient_email.'>';
		$cnt_date = $datetime.' '.$timezone;

		// collect sender info
		$cnt_sender_company = stripslashes($_POST['contact_sender_company']);
		$cnt_sender_name = stripslashes($_POST['contact_sender_name']);
		$cnt_sender_email = stripslashes($_POST['contact_sender_email']);
		$cnt_sender_subject = stripslashes($_POST['contact_sender_subject']);
		$cnt_sender_text = stripslashes($_POST['contact_sender_text']);
		$cnt_sender_street = stripslashes($_POST['contact_sender_street']);
		$cnt_sender_apt = stripslashes($_POST['contact_sender_apt']);
		$cnt_sender_city = stripslashes($_POST['contact_sender_city']);
		$cnt_sender_state = stripslashes($_POST['contact_sender_state']);
		$cnt_sender_code = stripslashes($_POST['contact_sender_code']);
		$cnt_sender_country = stripslashes($_POST['contact_sender_country']);
		$cnt_sender_phone = stripslashes($_POST['contact_sender_phone']);
		$cnt_sender_mobile = stripslashes($_POST['contact_sender_mobile']);
		$cnt_sender_fax = stripslashes($_POST['contact_sender_fax']);
		$cnt_sender_url = stripslashes($_POST['contact_sender_url']);
		$cnt_sender_birthdate = stripslashes($_POST['contact_sender_birthdate']);
		$cnt_sender_referr = stripslashes($_POST['contact_sender_referr']);

		// optional fill
		if (!$cnt_sender_subject) { $cnt_sender_subject = ''; } else { $cnt_sender_subject = ' | '.$cnt_sender_subject; }
		if (!$cnt_sender_company) { $cnt_sender_company = 'N/A'; }
		if (!$cnt_sender_street) { $cnt_sender_street = 'N/A'; }
		if (!$cnt_sender_apt) { $cnt_sender_apt = ''; } else { $cnt_sender_apt = ' '.$cnt_sender_apt; }
		if (!$cnt_sender_city) { $cnt_sender_city = 'N/A'; }
		if (!$cnt_sender_state) { $cnt_sender_state = 'N/A'; }
		if (!$cnt_sender_code) { $cnt_sender_code = 'N/A'; }
		if (!$cnt_sender_country) { $cnt_sender_country = 'N/A'; }
		if (!$cnt_sender_phone) { $cnt_sender_phone = 'N/A'; }
		if (!$cnt_sender_mobile) { $cnt_sender_mobile = 'N/A'; }
		if (!$cnt_sender_fax) { $cnt_sender_fax = 'N/A'; }
		if (!$cnt_sender_url) { $cnt_sender_url = 'N/A'; }
		if (!$cnt_sender_birthdate) { $cnt_sender_birthdate = 'N/A'; }
		if (!$cnt_sender_referr) { $cnt_sender_referr = 'N/A'; }

		// combine sender inf
		$cnt_subject = $cnt_subject.' '.$cnt_sender_subject;
		$cnt_sender = $cnt_sender_name.' <'.$cnt_sender_email.'>';
		$cnt_sender_address = $cnt_sender_street.' '.$cnt_sender_apt."\n";
		$cnt_sender_address .= $cnt_sender_city.', '.$cnt_sender_state.' '.$cnt_sender_code;

		// message content ------------------------------------------ //
		$cnt_content_mime_boundary = 'x_Multipart_x'.md5(mt_rand()).'x_Boundary_x';

		// content plain
		$cnt_content_plain = 'Subject: '.$cnt_subject."\n";
//		$cnt_content_plain .= 'From: '.$cnt_sender."\n";
		$cnt_content_plain .= 'To: '.$cnt_recipient."\n";
		$cnt_content_plain .= 'Date: '.$cnt_date."\n\n";

		$cnt_content_plain .= 'Company: '.$cnt_sender_company."\n";
		$cnt_content_plain .= 'Name: '.$cnt_sender_name."\n\n";
//		$cnt_content_plain .= 'Address: '.$cnt_sender_address."\n\n";
		$cnt_content_plain .= 'Phone: '.$cnt_sender_phone."\n\n";
//		$cnt_content_plain .= 'Fax: '.$cnt_sender_fax."\n";
//		$cnt_content_plain .= 'Mobile: '.$cnt_sender_mobile."\n\n";
//		$cnt_content_plain .= 'URL: '.$cnt_sender_url."\n";
//		$cnt_content_plain .= 'Birthdate: '.$cnt_sender_birthdate."\n";
		$cnt_content_plain .= 'Message:'."\n";
		$cnt_content_plain .= $cnt_sender_text."\n\n";

		$cnt_content_plain .= 'referr: '.$cnt_sender_referr."\n\n";

		// content xhtml
		$cnt_content_html = "\t".'<p><strong>Subject:</strong> '.$cnt_subject.'</p>'."\n";
		$cnt_content_html .= "\t".'<p><strong>From:</strong> '.$cnt_sender_name.' &lt;<a href="mailto:'.$cnt_sender_email.'">e-mail</a>&gt;<br />'."\n";
		$cnt_content_html .= "\t\t".'<strong>To:</strong> '.$cnt_recipient_name.' &lt;<a href="mailto:'.$cnt_recipient_email.'">e-mail</a>&gt;<br />'."\n";
		$cnt_content_html .= "\t\t".'<strong>Date:</strong> '.$cnt_date.'</p>'."\n\n";

		$cnt_content_html .= "\t".'<p><strong>Company:</strong> '.$cnt_sender_company.'<br />'."\n";
		$cnt_content_html .= "\t\t".'<strong>Name:</strong> '.$cnt_sender_name.'<br />'."\n";
//		$cnt_content_html .= "\t\t".'<strong>Address:</strong> '.$cnt_sender_street.$cnt_sender_apt.'<br />'."\n";
//		$cnt_content_html .= "\t\t".$cnt_sender_city.', '.$cnt_sender_state.' '.$cnt_sender_code.'</p>'."\n";
		$cnt_content_html .= "\t".'<p><strong>Phone:</strong> '.$cnt_sender_phone.'<br />'."\n";
//		$cnt_content_html .= "\t\t".'<strong>Mobile:</strong> '.$cnt_sender_mobile.'<br />'."\n";
//		$cnt_content_html .= "\t\t".'<strong>Fax:</strong> '.$cnt_sender_fax.'</p>'."\n";
//		$cnt_content_html .= "\t".'<p><strong>URL:</strong> '.$cnt_sender_url.'</p>'."\n";
//		$cnt_content_html .= "\t".'<p><strong>Birthdate:</strong> '.$cnt_sender_birthdate.'</p>'."\n";
		$cnt_content_html .= "\t".'<p><strong>Message:</strong> <span class="contact_preview_text">'.$cnt_sender_text.'</span></p>'."\n";

		$cnt_content_html .= "\t".'<p><strong>referr:</strong> '.$cnt_sender_referr.'</p>'."\n";

		// content xhtml wrapper
		$cnt_html = '<!DOCTYPE html PUBLIC'."\n";
		$cnt_html .= "\t".'"-//W3C//DTD XHTML 1.0 Strict//EN"'."\n";
		$cnt_html .= "\t".'"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'."\n\n";
		$cnt_html .= '<html xmlns="http://www.w3.org/1999/xhtml" dir="'.$ste_language_dir.'" lang="'.$ste_language.'">'."\n\n";
		$cnt_html .= '<head>'."\n\n";
		$cnt_html .= "\t".'<meta http-equiv="content-type" content="'.$ste_incoding.'" />'."\n";
		$cnt_html .= "\t".'<meta http-equiv="content-style-type" content="text/css" />'."\n\n";
		$cnt_html .= "\t".'<title>'.$cnt_subject.'</title>'."\n\n";
		$cnt_html .= "\t".'<link rel="stylesheet" type="text/css" title="e-mail" href="'.$ste_url.'/css/e-mail.css" />'."\n\n";
		$cnt_html .= '</head>'."\n\n";
		$cnt_html .= '<body>'."\n\n";
		$cnt_html .= $cnt_content_html."\n\n";
		$cnt_html .= '</body>'."\n\n";
		$cnt_html .= '</html>'."\n";

		// create e-mail -------------------------------------------- //
		// header
		$cnt_header = 'MIME-Version: 1.0'."\n";
		$cnt_header .= 'To: '.$cnt_recipient."\n";
		$cnt_header .= 'From: '.$cnt_sender."\n";
//		$cnt_header .= 'Cc: '.$cnt_sender."\n";
		$cnt_header .= 'Reply-To: '.$cnt_sender."\n";
		$cnt_header .= 'Date: '.$cnt_date."\n";
		$cnt_header .= 'Subject: '.$cnt_subject."\n";
		$cnt_header .= 'Content-Type: multipart/mixed; boundary="{'.$cnt_content_mime_boundary.'}"'."\n";
		$cnt_header .= 'Content-Transfer-Encoding: 7bit'."\n";
		$cnt_header .= 'Content-Description:'."\n\n";
		$cnt_header .= 'This is a multi-part message in MIME format.'."\n\n";

		// plain message
		$cnt_body = '--'.$cnt_content_mime_boundary."\n";
		$cnt_body .= 'Content-Type: '.$email_incoding."\n";
		$cnt_body .= 'Content-Transfer-Encoding: 7bit'."\n";
		$cnt_body .= $cnt_content_plain."\n\n";

		// xhtml message
		$cnt_body .= '--'.$cnt_content_mime_boundary."\n";
		$cnt_body .= 'Content-Type: '.$email_incoding."\n";
		$cnt_body .= 'Content-Transfer-Encoding: base64'."\n";
		$cnt_body .= $cnt_html."\n\n";

		// attachments ---------------------------------------------- //
		if ($cnt_attach) {

			$cnt_attach_size;
			$cnt_attach_type;

			foreach ($_FILES['file']['error'] as $key => $error) {

				if ($error == UPLOAD_ERR_OK) {

					$tmp_name = $_FILES['file']['tmp_name'][$key];
					$name = $_FILES['file']['name'][$key];
					$type = $_FILES['file']['type'][$key];
					$size = $_FILES['file']['size'][$key];

					// put names of images into array
					$images[] = $name;

					if (file_exists($tmp_name)){

						if(is_uploaded_file($tmp_name)){

							 $file = fopen($tmp_name, 'rb');
							 $data = fread($file,filesize($tmp_name));
							 fclose($file);
							 $data = chunk_split(base64_encode($data));

						}

					}

					$cnt_body .= '--'.$cnt_content_mime_boundary."\n";
					$cnt_body .= 'Content-Type: '.$type.'; name="'.$name.'"'."\n";
					$cnt_body .= 'Content-Transfer-Encoding: base64'."\n";
					$cnt_body .= 'Content-Disposition: attachment; filename="'.$name.'"'."\n";
					$cnt_body .= $data."\n\n";

				}

			}

		}

		$cnt_body .= '--{'.$cnt_content_mime_boundary.'}--'."\n";
		
		// print error check ---------------------------------------- //
		error_reporting(0);

		// put any errors into an array
		$errors_array = array();

		// test to see if the form was actually posted from our form
		$page = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

		if (!ereg($page, $_SERVER['HTTP_REFERER'])) {

			$errors_array[] = 'Invalid referer.';

		}

		// check to see if the required fields were filled
		if (!$_POST['contact_sender_name']) {

			$errors_array[] = 'Name is required.';

		}

		// validate email
		if (!$_POST['contact_sender_email']) {

			$errors_array[] = 'E-mail is required.';

		} else {

			if (!eregi("^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,4}\$", $cnt_sender_email)) {

				$errors_array[] = 'E-mail appears to be invalid.';

			}

		}

		if (!$_POST['contact_sender_phone']) {

			$errors_array[] = 'Phone is required.';

		}						

		if (!$_POST['contact_sender_text']) {

			$errors_array[] = 'Message is required.';

		}

		// error report --------------------------------------------- //
		// if no errors show preview and send
		if (count($errors_array) > 0) {

			echo "\t\t\t\t\t".'<p class="contact_preview_warning"><strong>Warning:</strong> Your message has not yet been sent; the form contained errors.<br /><br />'."\n";
			echo "\t\t\t\t\t\t".'Please go back and edit / enter the required infrmation.</p>'."\n";
			echo "\t\t\t\t\t".'<ul>'."\n";

			foreach ($errors_array as $err) {

				echo "\t\t\t\t\t\t".'<li class="contact_preview_error"><strong>Error:</strong> '.$err.'</li>'."\n";

			}

			echo "\t\t\t\t\t".'</ul>'."\n";
?>
<form action="<?php echo $cnt_self; ?>" method="post">
	<p><input type="button" value="Back" class="form_button" onclick="history.go(-1);return true;" /></p>
</form>
<?php

		} else {

			// preview & send --------------------------------------- //
			// check if message has been previewed & approved
			if ($status == 'send') {

				// send recipient, subject, body & header
				if (mail($cnt_recipient_email, $cnt_subject, $cnt_body, $cnt_header)) {

					// copy to sender
					// mail($cnt_sender_email, $cnt_subject, $cnt_header, $cnt_body);

					echo '<p class="contact_preview_sent"><strong>Notice:</strong> Your message has been sent.</p>'."\n";
					echo '<p class="contact_preview_sent">Thank You.<p>'."\n";

				} else {

					echo '<p class="contact_preview_warning\"><strong>Warning:</strong> Your message could not be sent. Please contact the site administrator.<br /><br />'."\n";
					echo "\t".'<a href="mailto:'.$cnt_recipient_email.'">'.$cnt_recipient_email.'</a></p>'."\n";

				}
?>
<form action="<?php echo $cnt_self; ?>" method="post">
	<p><input type="button" value="Back" class="form_button" onclick="history.go(-2);return true;" /></p>
</form>
<?php

			} else {

				// preview
				// preview all element of message before it is sent
				echo '<p class="contact_preview_notice"><strong>Preview:</strong> Check your message for errors.<br />'."\n";
				echo "\t".'Click <em>Back</em> to edit or <em>Submit</em> to send.</p>'."\n";

				$cnt_preview = $tab.'<div class="contact_preview">'."\n";
				$cnt_preview .= $tab.$cnt_content_html;
				$cnt_preview .= $tab.'</div>'."\n";

				echo $cnt_preview;

?>
<form action="<?php echo $cnt_self; ?>" method="post" enctype="multipart/form-data">
	<input type="hidden" name="status" value="send" />
	<input type="hidden" name="contact_sender_company" value="<?php echo $cnt_sender_company; ?>" />
	<input type="hidden" name="contact_sender_name" value="<?php echo $cnt_sender_name; ?>" />
	<input type="hidden" name="contact_sender_email" value="<?php echo $cnt_sender_email; ?>" />
	<input type="hidden" name="contact_sender_phone" value="<?php echo $cnt_sender_phone; ?>" />
	<input type="hidden" name="contact_sender_text" value="<?php echo $cnt_sender_text; ?>" />
	<input type="hidden" name="contact_sender_referr" value="<?php echo $cnt_sender_referr; ?>" />
	<p><input type="submit" value="Submit" class="form_button" />
		<input type="button" value="Back" class="form_button" onclick="history.go(-1);return true;" /></p>
</form>
<?php

			}

		}

	} else {

		// display form --------------------------------------------- //
		// the beginning or back to it
		echo $tab.'<input type="hidden" name="status" value="preview" />'."\n";

		// display recipient select options
		if ($cnt_multi) {

			echo $tab.'<p><label>Recipient<span> *</span><br />'."\n";
			echo $tab."\t".'<select id="contact_recipient_name" name="contact_recipient_name">'."\n";

			foreach ($cnt_multi_name as $k => $v) {

				list($tmp_name, $tmp_email) = $v;

				$recipient_name = $tmp_name;
				$recipient_item = strtolower($tmp_email);

				echo $tab."\t\t".'<option value="'.$recipient_item.'">'.$recipient_name.'</option>'."\n";

			}

			echo $tab."\t".'</select></label></p>'."\n";

		}
		
		// cc sender
//		echo '<p><label><input type="checkbox" id="sender_copy" value="yes" />Send yourself a copy of this e-mail.</label></p>'."\n";

		// display input & textareas
		foreach ($cnt_var as $k => $v) {

			list($id, $label, $value, $max_length, $required) = $v;

			// hacked in classes for phone and referr
			$class = '';
			if ($id == 'phone' || $id == 'referr') { $class = 'input_left'; }
			if ($id == 'phone') { $class .= ' form_input_phone'; }
			if ($id == 'referr') { $class .= ' form_input_referr'; }

			echo $tab.'<p id="'.$id.'"><label>'.$label;
			
			if ($required) {
				echo ' <span>*</span>';
			}

			echo '<br />'."\n";

			// textarea
			if ($id == 'text') {
//				name="contact_sender_text"
				echo $tab."\t".'<span><textarea id="contact_sender_'.$id.'" cols="30" rows="7">';

				// autofill
				if ($cms_inf && $inf == 2) {
					echo $value;
				}

				echo '</textarea></span>';

			} else {
//				name="contact_sender_'.$id.'"
				echo $tab."\t".'<input type="text" id="contact_sender_'.$id.'"';

				if ($value) {

					echo ' value="';

					// url protocol
					if ($id == 'url') {
						echo 'http://';
					}

					// autofill
					if ($cms_inf && $inf == 2) {
						echo $value;
					}
				
					echo '"';

				}
				
				if ($max_length) {
					echo ' maxlength="'.$max_length.'"';
				}

				echo ' />';

			}

			echo '</label></p>'."\n";

		}

		// file attachments
		if ($cnt_attach && $i = 1) {

			while ($i <= $cnt_attach_limit) {

				// max_file_size must precede the file input field
				echo $tab.'<p id="attachment'.$i.'"><label>Attachment #'.$i.'<br />'."\n";
				echo $tab."\t".'<input type="hidden" name="max_file_size" value="'.$cnt_attach_size.'" />'."\n";
				echo $tab."\t".'<input type="file" name="file[]" class="form_input_file" /></label></p>'."\n";

				$i++;

			}

		}

		echo $tab.'<p>* Requried</p>'."\n";
		echo $tab.'<p class="fc"><input type="submit" value="Preview" class="form_button" />'."\n";
		echo $tab."\t".'<input type="reset" value="Reset" class="form_button" /></p>'."\n";

	}

?>
