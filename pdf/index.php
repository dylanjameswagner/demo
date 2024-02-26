<?php
	// commom ------------------------------------------------------- //
	// timezone [(TZD)]
	putenv('TZ=US/Central');
	$timezone = date('(T)');

	function check_ext($file, $allowed = array(), $case_sensitive = false) {
		if (!is_array($allowed)) { $allowed = array($allowed); }	// make sure $allowed is an array
		$file_ext = preg_replace('/^.*\./', '', $file);				// get file extension (everything after last .)

		// case sensitivity
		if (!$case_sensitive) {
			foreach (array_keys($allowed) as $k) {					// convert keys to lc
				$allowed[$k] = strtolower($allowed[$k]);
			}
			$file_ext = strtolower($file_ext);						// convert extension to lc
		}

		// check for match
		if (in_array($file_ext, $allowed)) {
			return true;
		} else {
			echo 'false';
			echo '['.$file_ext.'] ['.$allowed.']';
			return false;
		}
	}

	// watermark_pdf ------------------------------------------------ //
	function watermark_pdf($file_old, $file_new = '', $mark_txt = '', $mark_img = '', $mark_img_rotate = NULL, $destination = '', $protected = NULL, $unit = '') {
		define('FPDF_PATH', 'fpdf/');
		define('FPDI_PATH', 'fpdi/');

		require('fpdf/fpdf.php');
		require('fpdi/fpdi.php');
		
		require('fpdf_rotation.php');								// FPDF_Protection - http://www.fpdf.org/en/script/script37.php
		require('fpdf_protection.php');								// FPDF_Rotation - http://www.fpdf.org/en/script/script2.php

		// extend fpdf
		class PDF extends FPDF_Protection {}						// extendes PDF with FPDF_Protection > FPDF_Rotation > FPDF

		// process file --------------------------------------------- //
		// validate pdf extension
		if ($file_old && check_ext($file_old, 'pdf')) {
			if (!$file_new) {										// create new file name based on existing file name
				$path_info = pathinfo($file_old);

				$modifier =	'_'.date('Ymd-HisT');					// datetime
//				$modifier =	'_new';									// text

				$file_new = $path_info['filename'].$modifier.'.'.$path_info['extension'];
			}
			if (!$destination) {	$destination = 'I'; }			// I(inline) D(download) F(? save) S(? string)]
			if (!$unit) {			$unit = 'in'; }					// mm cm in pt

//			$pdf = new FPDF('P', 'in', 'Letter');					// [P(portait) L(landscape) (default is P)] [, mm cm in pt (default is mm] [, A3 A4 A5 Letter Legal array(100, 150) (default is A4)]
//			$pdf =& new FPDI('P', $unit);							// initiate fpdi
			$pdf =& new PDF('P', $unit);							// initiate

			$count = $pdf->setSourceFile($file_old);				// set source file - count pages

			// set permissions
			if ($protected) {										// t f
				$pdf->SetProtection(array('print', 'annot-forms'));	// array(print copy modify annot-forms) [, user_pass} [, owner_pass])
			}

			// process each page
			for ($i = 1; $i <= $count; $i++) {
				$tpl = $pdf->importPage($i);						// import page() [, box(/MediaBox /BleedBox /TrimBox /CropBox /ArtBox)]
				$doc = $pdf->getTemplateSize($tpl);					// array (w, h)

//				$pdf->SetDisplayMode('default', 'default');			// zoom (default fullpage fullwidth real) [, layout (default single continuous two)]
				$pdf->SetDisplayMode('fullpage', 'single');			// zoom (default fullpage fullwidth real) [, layout (default single continuous two)]

				$pdf->SetMargins(1, 1);								// margins left, top, [, right] (default 1cm)

				$pdf->SetFont('Helvetica', 'B', 12);				// family [, style (- B I U)] [, size (in pt)]
				$pdf->SetTextColor(255, 0, 0);						// rgb r [, g] [, b]

				// embed font - dir fpdf/font/
				$pdf->AddFont('AGForeignerULBPlainMedium','','ad4f6142779ee088a45cdfd626fbb3c4_agfor28.php');	// family [, style (- B I U)] [, file (.php)]
				$pdf->SetFont('AGForeignerULBPlainMedium', '', 12);				// family [, style (- B I U)] [, size (in pt)]

				// embed font - dir fpdf/font/
				$pdf->AddFont('arialic_hollow','','2f93628450b99d0da67b4402682d1e73_arialic_hollow.php');	// family [, style (- B I U)] [, file (.php)]
				$pdf->SetFont('arialic_hollow', '', 12);				// family [, style (- B I U)] [, size (in pt)]

//				$pdf->AddPage('P', 'Letter');									// [P L] [, A3 A4 A5 Letter Legal array(w, h)]
				$pdf->AddPage('', array($doc['w'], $doc['h']));					// [P L] [, A3 A4 A5 Letter Legal array(w, h)]

				// background field
				$pdf->SetFillColor(255);										// rgb r [, g] [, b]
				$pdf->Rect(0, 0, $doc['w'], $doc['h'], 'F');					// x, y, w, h [, style (D(draw) F(fill) DF FD)]

				// get hypotenuse & angle
				$hyp = sqrt(($doc['w'] * $doc['w']) + ($doc['h'] * $doc['h']));	// hypotenuse
				$ang = rad2deg(acos($doc['w'] / $hyp));							// angle corner to corner

				// import page content ------------------------------ //
				$pdf->useTemplate($tpl, 0, 0, $doc['w'], $doc['h']);			// template [, x] [, y] [, w] [, h]

				// watermark image ---------------------------------- //
				if ($mark_img && file_exists($mark_img)) {
					$path_info = pathinfo($mark_img);
					$img = $path_info['filename'].'_'.$size.'.'.$path_info['extension'];

					// check if image exists
					if (!file_exists($img)) { $img = $mark_img; }	// a

					// get/set w, h & units
					list($w, $h) = getimagesize($img);
					if (!$unit || $unit == 'mm') {					// mm or false
						$w = ($w * 25.4) / 72;
						$h = ($h * 25.4) / 72;
					} else if ($unit == 'cm') {						// cm
						$w = ($w * 2.54) / 72;
						$h = ($h * 2.54) / 72;
					} else if ($unit == 'in') {						// in
						$w = $w / 72;
						$h = $h / 72;
					} else {										// pt (or px)
						// nothing
					}

					// rotated image -------------------------------- //
//					if ($mark_img_rotate) {
						// scale image to fit doc hyp
						if ($w > ($hyp * .8)) {
							$per = ($w - ($w - $hyp)) / $w;
	
							$w = $hyp * .8;
							$h = ($h * $per) * .8;
						} else {}
	
						// set margins rotated image - centered v & h
						$x = $doc['w'] * ((($hyp - $w) / 2) / $hyp);			// adjusted x
						$y = $doc['h'] * (($hyp - (($hyp - $w) / 2)) / $hyp);	// adjusted y
	
						// adjusted for height of image
						$x = $x - ($h / 3.25);									// adjusted x
						$y = $y - ($h / 2.5);									// adjusted y
	
						// apply rotated image
						$pdf->RotatedImage($img, $x, $y, $w, $h, $ang);			// file, x, y, w, h, angle
//					} else {
						// centered image ------------------------------- //
						// scale image to fit doc w
						if ($w > $doc['w']) {
							if ($w > $h) { $per = ($w - ($w - $doc['w'])) / $w; }
							else {		   $per = ($doc['h'] - $w) / $doc['h']; }
	
							$w = $doc['w'] * .85;
							$h = ($h * $per) * .85;
						}
	
						// set margins for image - center v & h
						$x = ($doc['w'] - $w) / 2;
						$y = ($doc['h'] - $h) / 2;
	
						// apply image
						$pdf->Image($img, $x, $y, $w, $h);						// file, x, y [, w] [, h] [, type] [, link]
//					}
				} // watermark image

				// import page content ------------------------------ //
//				$pdf->useTemplate($tpl, 0, 0, $doc['w'], $doc['h']);			// template [, x] [, y] [, w] [, h]

				// watermark text ----------------------------------- //
				if ($mark_txt) {
					// scale font size based on hypotenuse
					if ($hyp > 8) {	 $font_size = 18; } // 24
					if ($hyp > 10) { $font_size = 30; } // 30
					if ($hyp > 20) { $font_size = 44; } // 48
					if ($hyp > 30) { $font_size = 60; } // 60

					if ($font_size) { $pdf->SetFontSize($font_size); }			// size (in pt)

					// set margins - centered v & h
					$w = $pdf->GetStringWidth($mark_txt);						// string width
					$x = $doc['w'] * ((($hyp - $w) / 2) / $hyp);				// adjusted x
					$y = $doc['h'] * (($hyp - (($hyp - $w) / 2)) / $hyp);		// adjusted y

					// adjust for font size (estimated height)
//					$x = $x + (($font_size / 72) / 2);							// adjusted x
					$y = $y + (($font_size / 72) / 2);							// adjusted y

					// apply rotated text
					$pdf->RotatedText($x, $y, ' '.$mark_txt, $ang);				// x, y, text, angle

					// reset font & size
					$pdf->SetFont('Helvetica', 'B', 12);						// family [, style (- B I U)] [, size (in pt)]
//					$pdf->SetFontSize(12);										// size (in pt)
				} // watermark text

				// page info ---------------------------------------- //
				$txt = $doc['w'].$unit.' x '.$doc['h'].$unit;					// dimensions
//				$txt .= ' H ['.$hyp.']';										// hypotenuse (used to gauge scale for fonts & images)
//				$txt .= ' A ['.$ang.']';										// angle
//				$txt .= ' I ['.$img.']';										// watermark image
//				$txt .= ' P ['.$per.']';										// watermark image percent of original size
//				$pdf->Text(.28, .45, $txt);										// x, y, text

				// page number -------------------------------------- //
				if ($count > 1) {
					$txt = $pdf->PageNo();										// page #
					$w	 = $pdf->GetStringWidth($txt);							// string
//					$pdf->Text($doc['w'] - (.25 + $w), $doc['h'] - .25, $txt);	// x, y, text
				}

				// date processed ----------------------------------- //
				$txt = date('l, g:i:a (T)');									// date
//				$pdf->Text(.28, $doc['h'] - .25, $txt);							// x, y, text

				// not being used ----------------------------------- //
//				$pdf->Cell('', '', $txt, 0, 1, 'C');							// w [, h] [, text] [, border (0 1 L T R B)] [, position after (0(right) 1(new line) 2(below))] [, align (L C R)] [, fill] [, link]
//				$pdf->Write(1, $txt);											// h, text [, link]
//				$pdf->Ln(1);													// h (default is previous cell h)
			} // process each page
			$pdf->Output($file_new, $destination);								// [name (default doc.pdf)] [, destination I(inline) D(download) F(? save) S(? string)]
		} // validate pdf extension
	}

//	$file = '11x17DonnelyPlanPg1.pdf';
	$file = '11x17DonnelyPlanPg9.pdf';

	// file_old, file_new, txt, img, img_rotate, destination, protected, unit
	watermark_pdf($file, '', 'COPYRIGHT © '.date('Y').' GO2PLANS. All rights reserved.', 'watermark.gif', false, '', false, '');
?>
