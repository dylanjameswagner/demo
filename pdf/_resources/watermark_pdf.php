<?php
	function watermark_pdf($pdf_original, $pdf_new, $img_watermark) {
		// Open original PDF path
		echo 'open pdf ['.$pdf_original.']<br />'."\n";

		// Open watermark file
		echo 'open image ['.$img_watermark.']<br />'."\n";

		// Apply watermark to every page in original PDF
		echo 'apply image to pdf<br />'."\n";

		// Save output as new watermarked PDF file
		echo 'save pdf ['.$pdf_new.']<br />'."\n";
	}
	watermark_pdf('original.pdf', 'new.pdf', 'img_watermark.png');
	
	try {
		$p = new PDFlib();
	
		// open new PDF file; insert a file name to create the PDF on disk
		if ($p->begin_document("", "") == 0) {
			die("Error: " . $p->get_errmsg());
		}
	
		$p->set_info("Creator", "hello.php");
		$p->set_info("Author", "Rainer Schaaf");
		$p->set_info("Title", "Hello world (PHP)!");
	
		$p->begin_page_ext(595, 842, "");
	
		$font = $p->load_font("Helvetica-Bold", "winansi", "");
	
		$p->setfont($font, 24.0);
		$p->set_text_pos(50, 700);
		$p->show("Hello world!");
		$p->continue_text("(says PHP)");
		$p->end_page_ext("");
	
		$p->end_document("");
	
		$buf = $p->get_buffer();
		$len = strlen($buf);
	
		header("Content-type: application/pdf");
		header("Content-Length: $len");
		header("Content-Disposition: inline; filename=hello.pdf");
		print $buf;
	}
	catch (PDFlibException $e) {
		die("PDFlib exception occurred in hello sample:\n" .
		"[" . $e->get_errnum() . "] " . $e->get_apiname() . ": " .
		$e->get_errmsg() . "\n");
	}
	catch (Exception $e) {
		die($e);
	}
	$p = 0;

// <img src="watermark.php?path=slides/01.jpg" alt="" />
?>
