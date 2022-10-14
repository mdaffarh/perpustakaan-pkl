<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class FPDFController extends Controller
{
    public function index()
    {
        $pdf = new Fpdf('p','mm',array(100,120));
    
        $pdf->AliasNbPages();
        $pdf->AddPage();	
        
        $pdf->SetFont('Arial','B',12);
        $pdf->SetX(10);
        $pdf->Cell(40,10,"No. Prescription",0,0,'L',0);
        $pdf->Cell(5,10,":",0,0,'L',0);
        $pdf->Cell(60,10,"1A",0,1,'L',0);
        
        $pdf->Line(10,$pdf->GetY(),85,$pdf->GetY());
        
        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',18);
        $pdf->SetX(10);
        $pdf->Cell(40,10,"No. Antrian",0,0,'L',0);
        $pdf->Cell(5,10,":",0,0,'L',0);
        $pdf->Cell(60,10,"2B",0,1,'L',0);
        
        $pdf->output();
        exit;
	}
}
