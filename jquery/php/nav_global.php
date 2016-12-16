<?php

	// -------------------------------------------------------------------- //
	// nav_global.php
																			
	// Auto generated from an array in the configuration file. Creates
	// an unordered list with automatic href, with variables, to item
	// slug and non-link marker for current navigational item.

	// ARRAY MUST START WITH HOME

	// to-do:
	// generate from tabbed text file
	// ecode html entities - replace/remove in slug
	// kill depth at one (for top level only nav)

?>
				<h3 class="labels">Global Navigation</h3>
				<ul id="nav_global" class="navigation">
<?php

	// gerate array from a text file - incomplete
	function nav_global_text() {
		$ste_keywords_file = 'navigation.txt';
		
		echo '<pre>';
		if (file_exists($ste_keywords_file)) {
			foreach (file($ste_keywords_file) as $k => $v) {
//				if ($k) { echo ', '; } 												// if k > 0 echo comma space
				echo rtrim('<a href="#">'.$v.'</a>').'<br/>';
			}
		}
		echo '</pre>';
	}

	// navigation items in an array
//	$nav_global = array('Home', array('Campus', array('Facilities', 'Floorplans', 'Parking Policy', 'Computer Labs'), 'Library', 'Bookstore', 'Community Gallery', 'Housing', array('Local Info', 'Healthcare', 'Shopping', 'Restaurants', 'Entertainment', 'Parks')), array('Programs', array('General Education', 'Courses', 'Faculty'), array('Graphic Design', 'Gallery','Courses', 'Faculty', 'Graduate Profiles'), array('Fashion Marketing', 'Gallery', 'Courses', 'Faculty', 'Graduate Profiles'), array('Interior Design', 'Gallery', 'Courses', 'Faculty', 'Graduate Profiles'), array('Media Arts and Animation', 'Gallery', 'Courses', 'Faculty', 'Graduate Profiles'), array('Web Design and Interactive Media', 'Gallery', 'Courses', 'Faculty', 'Graduate Profiles')), array('Resources', 'Financial Aid', 'Student Affairs', 'IT Department', 'Career Services', 'FAQ'), array('Contact', 'Map and Directions'));
//	$nav_global = array('Home', array('demo 1'), array('demo 2'), array('demo 3'), array('demo 4'), array('demo 5'), array('demo 6'), array('demo 7'), array('demo 8'), array('demo 9'), array('credits'), array('contact'));
	$nav_global = array('Home', 'demo 1', 'demo 2', 'demo 3', 'demo 4', 'demo 5', 'demo 6', 'demo 7', 'demo 8', 'demo 9', 'credits', 'contact');

	// generate navigation list items - incomplete
	function nav_global($array, $depth = 0, $parent = '', $level = 0) {
		global $p;

		$tab = str_repeat("\t", $depth + 4);										// source tab indentation

		foreach($array as $k => $v) {
			if (is_array($v)) {
				nav_global($v, $depth + 1, $parent);								// re-run function, array, depth, parent
			} else {
				$page = $p;															// active page
				$text = $v;															// array string
				$root = substr($page, 0, strpos($page, '_'));						// top level parent			
				$slug = strtolower(preg_replace('/\s+/', '-', $v)); 				// lowercase, replace spaces
				$href = substr($parent.'_'.$slug, 1);								// combine parent & slug, strip leading underscore

				if (!$depth && !$k) {	 $parent = ''; }							// first run, assign parent
				elseif ($depth && !$k) { $parent = $parent.'_'.$slug; }

				if ($depth && !$k) { echo $tab; }									// source tab indent
				else {				 echo $tab."\t"; }

				echo '<li class="'.$href;											// bof li, class slug

				if ($depth && !$k) {							 echo ' parent'; }	// marker, class parent
				if ($page == $href || (!$k && $root == $slug)) { echo ' active'; }	// marker, class active

				echo '">';															//

				if ($page == $href) { echo '<strong>'; }							// bof strong or a
				else {				  echo '<a href="?p='.$href.'">'; }				//

//				echo preg_replace('/-/', ' ', $text);								// mixedcase, restore spaces
				echo $text;															// display text

				if ($page == $href) { echo '</strong>'; }							// eof strong or a
				else {				  echo '</a>'; }								//

//				echo $k.' '.$depth;
//				echo ' R['.$root.']';
//				echo ' P['.$parent.']';
//				echo ' G['.$page.']';
//				echo ' H['.$href.']';

				if ((!$depth && !$k) || ($depth && $k)) { echo '</li>'."\n"; }		// eof li
				else {
					if ($depth && $k) { echo "\n"; }								// bof ul
					else { echo "\n".$tab."\t".'<ul>'."\n"; }						//
				}
			}
		}
		if ($depth) {
			if (!$level || $depth <= $level) {
				echo $tab."\t".'</ul>'."\n";										// eof ul
				echo $tab;															// eof li
			}
			echo '</li>'."\n";														//
		}
	}
	nav_global($nav_global);														// run function, array, depth, parent
?>
				</ul><!-- #nav_global -->
