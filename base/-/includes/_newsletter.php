<style>
	.alert {
		border: 1px solid #c00;
		padding: 10px 12px 6px;
		background: rgba(204,0,0,.2); }
	.alert.passed {
		border-color: #093;
		background: rgba(0,153,51,.2); }
</style>

<?php
	$success = false;
	$alert = array();

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		if (validate_email($_POST['newsletterEmail'])){
			$success = true;

			$file = fopen($_SERVER['DOCUMENT_ROOT'].'/newsletter.txt','a');
			fprintf($file,"%s\r\n",$_POST['newsletterEmail']);
			fclose($file);

			$alert[] = 'Email Accepted, Thank you';
		} else {
			$alert[] = 'Email is not valid';
		}
	}
	if (!$success){
		$content .= PHP_EOL.

					'<form class="newsletter" method="post" action="newsletter.php">
						<h3 class="newsletter-title">Join Our Mailing List!</h3>
						<p><label for="newsletterEmail">Email</label>
							<input type="text" id="newsletterEmail" name="newsletterEmail" value="Email"/>
							<input type="submit" value="Submit"/>
						</p>
					</form>'.PHP_EOL;
	}
	if ($alert){
		$content .= '<p class="alert';
		if ($success){ $content .= ' passed'; }
		$content .= '">';
		foreach ($alert AS $k => $v){
			$content .= $v.'<br/>'.PHP_EOL;
		}
		$content .= '</p>'.PHP_EOL;
	}
	echo $content;
?>
	<hr/>
	<pre>
<?php
	readfile($_SERVER['DOCUMENT_ROOT'].'/newsletter.txt');
?>
	</pre>

<?php
	/**
	Validate an email address.
	Provide email address (raw input)
	Returns true if the email address has the email 
	address format and the domain exists.
	*/
	function validate_email($email){
		$isValid = true;
		$atIndex = strrpos($email,'@');

		if (is_bool($atIndex) && !$atIndex){											$isValid = false; }
		else {
			$domain = substr($email,$atIndex+1);
			$local = substr($email,0,$atIndex);
			$localLen = strlen($local);
			$domainLen = strlen($domain);

			if ($localLen < 1 || $localLen > 64){										$isValid = false; } // local part length exceeded
			elseif ($domainLen < 1 || $domainLen > 255){								$isValid = false; } // domain part length exceeded
			elseif ($local[0] == '.' || $local[$localLen-1] == '.'){					$isValid = false; } // local part starts or ends with '.'
			elseif (preg_match('/\\.\\./', $local)){									$isValid = false; } // local part has two consecutive dots
			elseif (!preg_match('/^[A-Za-z0-9\\-\\.]+$/',$domain)){					$isValid = false; } // character not valid in domain part
			elseif (preg_match('/\\.\\./', $domain)){									$isValid = false; } // domain part has two consecutive dots
			elseif (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
					 str_replace("\\\\","",$local))){ // character not valid in local part unless // local part is quoted
				if (!preg_match('/^"(\\\\"|[^"])+"$/',str_replace("\\\\","",$local))){ $isValid = false; }
			}
			if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))){	$isValid = false; }
		}
		return $isValid;
	}
?>
