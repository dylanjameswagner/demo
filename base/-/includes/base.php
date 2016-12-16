<?php /* base.php */

	ini_set('display_errors',false);
	setlocale(LC_MONETARY,'en_US');
//	putenv('TZ=US/Eastern');
//	putenv('TZ=US/Central');

	$checked  = ' checked="checked"';
	$selected = ' selected="selected"';

	$datetime = date('Y-m-d H:i:s');

/* utility */

	function tab($depth){
		return str_repeat("\t",$depth);
	}

	function pad($content,$depth,$char = '0'){
		return str_pad($content,$depth,$char,STR_PAD_LEFT);
	}

	function array_reorder($array,$oldIndex,$newIndex){
		array_splice(
			$array,
			$newIndex,
			count($array),
			array_merge(
				array_splice($array,$oldIndex,1),
				array_slice($array,$newIndex,count($array))
			)
		);
		return $array;
	}

	function strtotitle($str){
		$except = array('of','a','the','and','an','or','nor','but','is','if','then','else','when','at','from','by','on','off','for','in','out','over','to','into','with');
		$words  = explode(' ',$str);				// split string into an array

		foreach ($words as $k => $v){
			if ($k == 0 or !in_array($v,$except)){	// if first word and not except
				$words[$k] = ucwords($v);			// capitialize each word
			} // end if
		} // end foreach

		$title = implode(' ',$words);				// join the words back into a string

		return $title;
	}

	function validate_email($email){
		$isValid = true;							// true if format correct and domain exists
		$atIndex = strrpos($email,'@');

		if (is_bool($atIndex) && !$atIndex){											$isValid = false; }
		else {
			$domain = substr($email,$atIndex+1);
			$local = substr($email,0,$atIndex);
			$localLen = strlen($local);
			$domainLen = strlen($domain);

				if ($localLen < 1 || $localLen > 64){									$isValid = false; } // local part length exceeded
			elseif ($domainLen < 1 || $domainLen > 255){								$isValid = false; } // domain part length exceeded
			elseif ($local[0] == '.' || $local[$localLen-1] == '.'){					$isValid = false; } // local part starts or ends with '.'
			elseif (preg_match('/\\.\\./', $local)){									$isValid = false; } // local part has two consecutive dots
			elseif (!preg_match('/^[A-Za-z0-9\\-\\.]+$/',$domain)){						$isValid = false; } // character not valid in domain part
			elseif (preg_match('/\\.\\./', $domain)){									$isValid = false; } // domain part has two consecutive dots
			elseif (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
					 str_replace("\\\\","",$local))){ // character not valid in local part unless // local part is quoted
				if (!preg_match('/^"(\\\\"|[^"])+"$/',str_replace("\\\\","",$local))){	$isValid = false; }
			}
			if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))){	$isValid = false; }
		}
		return $isValid;
	}

/* debug */

	function get_request_headers(){
		$headers = array();
		foreach($_SERVER as $key => $value){
			if (strpos($key,'HTTP_') === 0){
				$headers[str_replace(' ','-',ucwords(str_replace('_',' ',strtolower(substr($key,5)))))] = '['.$key.'] '.$value;
			}
		}
		return $headers;
	}

?>
