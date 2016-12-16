<?php

	// -------------------------------------------------------------------- //
	// common.php

//	error_reporting(0);
	
	// date & timezone [(TZD)]
	putenv('TZ=US/Eastern');
	$timezone	= date('(T)');
	$modified	= date('Y-m-d', getlastmod());

	$date_us	= date('m-d-Y');											// [MM-DD-YYYY]
	$date_iso	= date('Y-m-d');											// [YYYY-MM-DD]
	$date_full	= date('l, F d Y');											// [Day, Month DD YYYY]
	$date2822	= date('r (T)');											// RFC2822 date & timezone

	$time_12	= date('h:i:sa');											// [HH:MM:SS(am/pm)]
	$time_24	= date('H:i:s');											// [HH:MM:SS]

	$datetime	= $date_iso.' '.$time_24;									// [YYYY-MM-DD HH:MM:SS]
		
	$datetime_full12 = $datefull.' '.$time_12.' '.date('O').' '.$timezone;	// [Day, Month DD YYYY HH:MM:SS(am/pm) +/-GMT (TZ)]
	$datetime_full24 = $datefull.' '.$time_24.' '.$timezone;				// [Day, Month DD YYYY HH:MM:SS +/-GMT (TZ)]

	// meta data - description & keywords --------------------------------- //
	function meta_description() {
		$ste_description_file = 'description.txt';

		if (file_exists($ste_description_file)) {
			echo trim(file_get_contents($ste_description_file));
		}
	}

	function meta_keywords() {
		$ste_keywords_file = 'keywords.txt';

		if (file_exists($ste_keywords_file)) {
			foreach (file($ste_keywords_file) as $k => $v) {
				if ($k) { echo ', '; } echo rtrim($v);
			}
		}
	}

	function stylesheet() {
		global $r, $s;

		$styles[] = $r.$s;

		if ($styles) {
			foreach ($styles as $style) {
				$file = 'css/'.$style.'.css';
				if (file_exists($file)) {
					echo "\t\t".'<link rel="stylesheet" type="text/css" href="'.$file.'"/>'."\n";
				}
			}
		}
	}

	function javascript() {
		global $r, $s;

		$scripts[] = $r.$s;

		if ($scripts) {
			foreach ($scripts as $script) {
				$file = 'js/'.$script.'.js';
				if (file_exists($file)) {
					echo "\t\t".'<script type="text/javascript" src="'.$file.'"></script>'."\n";
				}
			}
		}
	}

	function tab($depth) { // >> &$tab, $depth
		$tab = str_repeat("\t", $depth);
		return $tab;
	}

	// navigation --------------------------------------------------------- //
	function nav_next() {
		global $p, $r, $s;
		
		$tab = str_repeat("\t",5);

		if (strlen($p) >= 1 && strlen($p) <= 2) {
//			echo $tab.'<hr/>'."\n";
			echo $tab.'<p class="nav_next">';

			if ($p != '9c') {
			
				echo '<a href="?p=';

				if ($r == 'home') {	echo '1'; }
				else {
					if (!$s) { echo $r.'a'; } // >> _a
					elseif ($s == 'c') { echo $r+1; }
					else { echo $r; }

					if ($s && $s != 'c') { echo ''; } // >> _

					if ($s == 'a'){ echo 'b'; }
					elseif ($s == 'b') { echo 'c'; }
				}

				echo '">View Demo ';

				if ($r == 'home') {	echo '1'; }
				else {
					if (!$s) { echo $r.'a'; }
					elseif ($s == 'c') { echo $r+1; }
					else { echo $r; }

					if ($s == 'a'){ echo 'b'; }
					elseif ($s == 'b') { echo 'c'; }
				}
				echo '</a>';
			} else {
				echo 'Thanks for viewing my demo. :)';
			}
			echo '</p>'."\n";
		}
	}

/*	function fixcodeblocks($string) {
		return preg_replace_callback('#<(code|pre)([^>]*)>(((?!</?\1).)*|(?R))*</\1>#si', 'specialchars', $string);
	}
	function specialchars($matches) {
		return '<'.$matches[1].$matches[2].'>'.htmlspecialchars(substr(str_replace('<'.$matches[1].$matches[2].'>', '', $matches[0]), 0, -(strlen($matches[1]) + 3))).'</'.$matches[1].'>';
	}
	echo fixcodeblocks($html);
	
	// 
	function pre_entities($matches) {
		return str_replace($matches[1], htmlentities($matches[1]), $matches[0]);
	}
	
	// to html entities; assume content is in the "content" variable
	$content = preg_replace_callback('/<pre.*?>(.*?)<\/pre>/imsu', pre_entities, $content); */

	// page, parent & slug ------------------------------------------------ //
//	$n = $_SERVER['SCRIPT_NAME'];											// get var from filename
//	$p = substr(substr($n, strrpos($n, '/')+1), 0, -4);						// get filename, strip file extension & all preceeding characters including last forward slash

	$p = $_GET['p'];														// get var from url
//	$r = substr($p, 0, strpos($p, '_'));									// assign parent
	$r = substr($p, 0, 1);													// assign parent
	$s = substr($p, 1);														// assign slug

	if (!$p) { $p = 'home'; }												// assign $p if null
	if (!$r) { $r = $p; }													// assign $r if null

	function activeParent($page) {
		global $r; if ($page == $r) { echo ' active'; }
	}

	function activeSlug($page) {
		global $s; if ($page == $s) { echo ' active'; }
	}

?>
