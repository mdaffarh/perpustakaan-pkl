<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Borrow;
use App\Models\Member;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class FPDFController extends Controller
{
    public function borrowReport()
    {
        // Isi tabel
        $borrows = Borrow::when(request()->tanggal_awal && request()->tanggal_akhir, function($q){
            return $q->whereBetween('tanggal_pinjam',[request()->tanggal_awal,request()->tanggal_akhir]);
        })
        ->when(request()->tanggal_akhir, function($q){
            return $q->whereBetween('tanggal_pinjam',[0000-00-00,request()->tanggal_akhir]);
        })
        ->when(request()->tanggal_awal, function($q){
            return $q->whereBetween('tanggal_pinjam',[request()->tanggal_awal,'2099-10-17']);
        })
        ->when(request()->member_id,function($q){
            return $q->where('member_id',request()->member_id);
        })
        ->when(request()->status, function($q){
            return $q->where('status',request()->status);
        })
        ->when(true, function($q){
            return $q->where('id','!=',NULL);
        })
        ->get();
        
        // FPDF
        $pdf = new Fpdf('L','mm','A4');
        
        $pdf->AliasNbPages();
        $pdf->AddPage();	
        // Header
            // Judul
            $pdf->SetFont('Helvetica','B',16);
            $pdf->Cell(275,0,'Report Peminjaman Buku',0,0,'C',0);
            $pdf->Ln(6);

            //Keterangan
            $member = Member::where('id',request()->member_id)->first();
            if(request()->member_id){
                $nama = $member->nama;
            }else{
                $nama = '-';
            }
            if(request()->status){
                $status = request()->status;
            }else{
                $status = 'Semua';
            }
            if(request()->tanggal_awal){
                $tanggal_awal = Carbon::parse(request('tanggal_awal'))->format('d/m/Y');
            }else{
                $tanggal_awal = '-';
            }
            if(request()->tanggal_akhir){
                $tanggal_akhir = Carbon::parse(request('tanggal_akhir'))->format('d/m/Y');
            }else{
                $tanggal_akhir = '-';
            }

            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell(275,0,'( Nama : '.$nama.' | Tanggal : '.$tanggal_awal.' - '.$tanggal_akhir.' | Status : '.$status.' ) ',0,0,'C',0);    
            $pdf->Ln(10);
     
        // Field
        $fields = ['No.','Kode Peminjaman','NIS','Nama Peminjam','Tanggal Pinjam','Tanggal Tempo','Status','Nama Penjaga'];
        $fieldWidth = [10,40,40,50,30,30,40,35]; //275

        foreach ($fields as $key => $value) {
            $pdf->SetFont('Helvetica','',10);
            if ( $key == 0 || $key == 6) {
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'C',0);
            }elseif($key == 4 || $key == 5){
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'R',0);
            }else{
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'L',0);
            }
        }
            
        $no = 1;
        
        foreach ($borrows as $key => $borrow) {
            $pdf->Ln(8);
            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell($fieldWidth[0],8,$no,1,0,'C',0);
            $pdf->Cell($fieldWidth[1],8,$borrow->kode_peminjaman,1,0,'L',0);
            $pdf->Cell($fieldWidth[2],8,$borrow->member->nis,1,0,'L',0);
            $pdf->Cell($fieldWidth[3],8,$borrow->member->nama,1,0,'L',0);
            $pdf->Cell($fieldWidth[4],8,Carbon::parse($borrow->tanggal_pinjam)->format('d/m/Y'),1,0,'R',0);
            $pdf->Cell($fieldWidth[5],8,Carbon::parse($borrow->tanggal_tempo)->format('d/m/Y'),1,0,'R',0);
            $pdf->Cell($fieldWidth[6],8,$borrow->status,1,0,'C',0);
            $pdf->Cell($fieldWidth[7],8,$borrow->creator->nama,1,0,'L',0);
            $no++;
        
        }

        $now = Carbon::now();
        $pdf->output('I','Report Peminjaman Buku '.$now.'.pdf',false);
        exit;
	}
}