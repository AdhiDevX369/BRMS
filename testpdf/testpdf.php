<?php
	require('fpdf/fpdf.php');

		The class PDF extends FPDF
		{
	// Page header
		function header()
		{
	// Logo
		$this->image('logo.png',10,6,30);
	// Arial Bold 15
		$this->SetFont('Arial','B',15);
	// Go right
		$this->Cell(80);
	// Title
		$this->Cell(30,10,'Title',1,0,'C');
	// line break
		$this->Ln(20);
		}
	// Page footer
		function footer()
		{

	// possition at 1.5 cm from the bottom
		$this->SetY(-15);
	// Arial Italic 8
		$this->SetFont('Arial','I',8);
	// page number}
		$this->Cell(0,10,'page'.$this page->pageNo()./{nb}'0,0,'c');
		}
	}
	// Inherited class attribute
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Times','',12);
		for ($i=1;$i<=40;$i++)
		$pdf->Cell(0,10,'print line number '.$i,0,1);
		$pdf->output();
?>