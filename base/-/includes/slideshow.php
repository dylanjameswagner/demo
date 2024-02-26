<?php /* slideshow.php */

	// Generates a list of images that combined with css and js allows
	// a fade in/out slide show. List is either genereated from a
	// directory of images or hard coded at the bottom.

	$base = '/base';
	$root = ($_SERVER['HTTP_HOST'] == 'localhost') ? '/Users/djw/Sites/dylanjameswagner.com' : NULL;
	$dir  = $base.'/wp-media/slideshow';
//	$dir  = '//placehold.it'; // http://placehold.it/800x600&text=Image+2

	// from /comp/
	function nav_scan($root = NULL,$dir = NULL,&$attr = NULL){ //,&$width = NULL,&$height = NULL
		global $image;

		$root = ($root) ? $root : $_SERVER['DOCUMENT_ROOT'];				// defaults to same root dir
		$dir = ($dir) ? $dir : dirname($_SERVER['PHP_SELF']).'/';			// defaults to same dir
		$scan = scandir($root.$dir);

		echo tab(2).'<ul>'.PHP_EOL;											// bof ul

		for ($i = 0; $i < count($scan); $i++){
			$parts = pathinfo($scan[$i]);

//			if ($scan[$i] != '.' && $scan[$i] != '..' && $scan[$i] != 'index.php' && $scan[$i] != 'favicon.ico'){
			if (!is_dir($root.$dir.$scan[$i]) && in_array($parts['extension'],array('jpg','png'))){ // allowed file types
				if (!$j){													// if ! first run 
					$image = ($_GET['image']) ? $_GET['image'] : $scan[$i];	// assign $image
//					list($width,$height,$type,$attr) = getimagesize($image); // get image info
				}
				$j++;														// increment

				echo tab(3).'<li'.active($scan[$i]).'><a href="?s='.$scan[$i].'"><span>'.str_pad($j,2,'0',STR_PAD_LEFT).'</span> <span>'.substr($parts['filename'],3).'</span></a></li>'.PHP_EOL;
			}
		}
		echo tab(2).'</ul>'.PHP_EOL;											// eof ul
	}
//	nav_scan();

	function custom_slideshow_old($dir){
		$scn = scandir($dir);
		$ran = rand(2,(count($scn) - 1));

		$output = tab(2).'<ul id="slideshow">'.PHP_EOL;

		for ($i = 0; $i < count($scn); $i++){
			if (!is_dir($dir.'/'.$scn[$i])){								// remove dir
				if ($i == $ran){ $class = ' class="active"'; }				// select random
				else {			  $class = ''; }

				$output .= tab(3).'<li'.$class.'"><a href="'.$dir.'/'.$scn[$i].'"><img src="'.$dir.'/'.$scn[$i].'" alt="'.$scn[$i].'"/></a></li>'.PHP_EOL;
			}
		}
		$output .= tab(2).'</ul><!--#slideshow-->'.PHP_EOL;

		echo $output;
	}
//	custom_slideshow_old($dir);

	function custom_content_slideshow($dir,$root = NULL){
		$root = ($root) ? $root : $_SERVER['DOCUMENT_ROOT'];
		$scan = scandir($root.$dir);											// scan dir
		$url = '';
		$ran = rand(2,(count($scn) - 1));									// random number
		$nav = '';

		$output = tab(3).'<ul id="slideshow">'.PHP_EOL;						// bof ul

		foreach($scan as $k => $f){
			$info = pathinfo($f);

			if (in_array($info['extension'],array('jpg','png','gif'))){		// allowed file types
				$i++;

//				if ($k == $ran){ $class = ' active'; }						// random
					if ($i == 1){ $class = ' active'; }						// first
				elseif ($i == 2){ $class = ' pending'; }					// second
				else {			  $class = ''; }

				$output .= tab(4).'<li class="slide slide-'.$i.$class.'">';
//				$output .= '<a href="'.$url.'/'.str_replace('_','/',strtolower(substr(substr($f,0,strpos($f,'.')),strpos($f,'_') + 1))).'">';
				$output .= '<img alt="'.(!is_numeric(substr($f,0,-4)) ? substr($f,0,-4) : 'Slide '.$i).'" src="'.$dir.'/'.$f.'"/>';
//				$output .= '</a>';
				$output .= tab(4).'<span class="slide-caption">'.(!is_numeric(substr($f,0,-4)) ? str_replace('-',' ',substr(substr($f,0,strpos($f,'.')),strpos($f,'_') + 1)) : 'Slide '.$i).'</span>';
				$output .= '</li>'.PHP_EOL;

				$nav .= tab(5).'<li class="'.$class.'"><a href="#'.$i.'">'.$i.'</a></li>';
			}
		}

		$output .= tab(3).'</ul><!--#slideshow-->'.PHP_EOL;					// eof ul
		$output .= tab(3).'<nav id="slideshow-menu">'.PHP_EOL;
		$output .= tab(4).'<ul>'.PHP_EOL;
		$output .= trim($nav).PHP_EOL;
		$output .= tab(4).'</ul>'.PHP_EOL;
		$output .= tab(3).'</nav><!--#slideshow-menu-->'.PHP_EOL;

		echo $output;
	}
	custom_content_slideshow($dir,$root);

?>
