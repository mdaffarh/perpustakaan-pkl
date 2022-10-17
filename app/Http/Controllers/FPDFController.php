<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Borrow;
use App\Models\Member;
use App\Models\Returns;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MemberRegistration;
use Illuminate\Support\Facades\DB;


class FPDFController extends Controller
{
    // Peminjaman
    public function borrowReport()
    {
        // Ambil data sesuai filter
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
            
            $nama = (request()->member_id ? 'Nama : '.$member->nama.' | ' : '');
            $status = (request()->status ? ' | Status : '.request()->status : '');
            $tanggal_awal = (request()->tanggal_awal ? Carbon::parse(request('tanggal_awal'))->format('d/m/Y') : '');
            $tanggal_akhir = (request()->tanggal_akhir ? Carbon::parse(request('tanggal_akhir'))->format('d/m/Y') : '');

            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell(275,0,'( '.$nama.'Tanggal : '.$tanggal_awal.' - '.$tanggal_akhir.$status.' ) ',0,0,'C',0);    
            $pdf->Ln(10);
     
        // Field dan isi data
        $fields = ['No.','Kode Peminjaman','NIS','Nama Peminjam','Tanggal Pinjam','Tanggal Tempo','Status','Nama Penjaga'];
        $fieldWidth = [8,35,40,50,27,27,40,50]; //275

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
            $pdf->Cell($fieldWidth[7],8,$borrow->editor ? $borrow->editor->nama : $borrow->creator->nama,1,0,'L',0);
            $no++;
        
        }


        $now = Carbon::now();
        $pdf->output('I','Report Peminjaman Buku '.$now.'.pdf',false);
        exit;
	}

    // Pengembalian
    public function returnReport()
    {
        // Ambil data sesuai filter
        $returns = Returns::when(request()->tanggal_awal && request()->tanggal_akhir, function($q){
            return $q->whereBetween('tanggal_kembali',[request()->tanggal_awal,request()->tanggal_akhir]);
        })
        ->when(request()->tanggal_akhir, function($q){
            return $q->whereBetween('tanggal_kembali',[0000-00-00,request()->tanggal_akhir]);
        })
        ->when(request()->tanggal_awal, function($q){
            return $q->whereBetween('tanggal_kembali',[request()->tanggal_awal,'2099-10-17']);
        })
        ->when(request()->member_id,function($q){
            return $q->where('member_id',request()->member_id);
        })
        ->when(request()->status, function($q){
            return $q->where('dikembalikan',request()->status);
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
            $pdf->Cell(275,0,'Report Pengembalian Buku',0,0,'C',0);
            $pdf->Ln(6);

            //Keterangan
            $member = Member::where('id',request()->member_id)->first();
            
            $nama = (request()->member_id ? 'Nama : '.$member->nama.' | ' : '');
            $status = (request()->status == "Sudah" ? ' | Status : Selesai' : '');
            $tanggal_awal = (request()->tanggal_awal ? Carbon::parse(request('tanggal_awal'))->format('d/m/Y') : '');
            $tanggal_akhir = (request()->tanggal_akhir ? Carbon::parse(request('tanggal_akhir'))->format('d/m/Y') : '');

            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell(275,0,'( '.$nama.'Tanggal : '.$tanggal_awal.' - '.$tanggal_akhir.$status.' ) ',0,0,'C',0);    
            $pdf->Ln(10);
     
        // Field dan isi data
        $fields = ['No.','Kode Pengembalian','NIS','Nama Peminjam','Tanggal Kembali','Status','Nama Penjaga'];
        $fieldWidth = [8,45,45,50,40,40,50]; //275

        foreach ($fields as $key => $value) {
            $pdf->SetFont('Helvetica','',10);
            if ( $key == 0 || $key == 5) {
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'C',0);
            }elseif($key == 4){
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'R',0);
            }else{
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'L',0);
            }
        }
            
        $no = 1;
        foreach ($returns as $key => $return) {
            $pdf->Ln(8);
            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell($fieldWidth[0],8,$no,1,0,'C',0);
            $pdf->Cell($fieldWidth[1],8,$return->kode_pengembalian,1,0,'L',0);
            $pdf->Cell($fieldWidth[2],8,$return->member->nis,1,0,'L',0);
            $pdf->Cell($fieldWidth[3],8,$return->member->nama,1,0,'L',0);
            $pdf->Cell($fieldWidth[4],8,Carbon::parse($return->tanggal_kembali)->format('d/m/Y'),1,0,'R',0);
            $pdf->Cell($fieldWidth[5],8,$return->dikembalikan == "Sudah" ? "Selesai" : "Belum dikembalikan",1,0,'C',0);
            $pdf->Cell($fieldWidth[6],8, $return->editor ? $return->editor->nama : $return->creator->nama ,1,0,'L',0);
            $no++;
        
        }


        $now = Carbon::now();
        $pdf->output('I','Report Pengembalian Buku '.$now.'.pdf',false);
        exit;
	}

    // Pendaftaran Anggota
    public function memberRegistrationReport()
    {
        // Ambil data sesuai filter
        $memberRegistrations =  MemberRegistration::when(request()->tanggal_awal && request()->tanggal_akhir, function($q){
            $endDate = Carbon::parse(request('tanggal_akhir'))->addHours(23)->addMinutes(59)->addSeconds(59);
            return $q->whereBetween(('created_at'),[request()->tanggal_awal,$endDate]);
            })
            ->when(request()->tanggal_akhir, function($q){
                $endDate = Carbon::parse(request('tanggal_akhir'))->addHours(23)->addMinutes(59)->addSeconds(59);
                return $q->whereBetween('created_at',[0000-00-00, $endDate]);
            })
            ->when(request()->tanggal_awal, function($q){
                return $q->whereBetween('created_at',[request()->tanggal_awal,'2099-10-17']);
            })
            ->when(request()->status, function($q){
                return $q->where('status',request()->status);
            })
            ->when(request()->kelas,function($q){
                return $q->where('kelas',request()->kelas);
            })
            ->when(request()->jurusan,function($q){
                return $q->where('jurusan',request()->jurusan);
            })
            ->when(request()->jenis_kelamin,function($q){
                return $q->where('jenis_kelamin',request()->jenis_kelamin);
            })
            ->when(request()->tahun_lahir,function($q){
                return $q->where(DB::raw('YEAR(tanggal_lahir)'),request()->tahun_lahir);
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
            $pdf->Cell(275,0,'Report Pendaftaran Anggota',0,0,'C',0);
            $pdf->Ln(6);

            //Keterangan kelas jurusan jenis kelamin tanggal lahir
            $kelas = (request()->kelas ? 'Kelas : '.request()->kelas.' | ' : '');
            $jurusan = (request()->jurusan ? 'Jurusan : '.request()->jurusan.' | ' : '');
            $jenis_kelamin = (request()->jenis_kelamin ? 'Jenis Kelamin : '.request()->jenis_kelamin.' | ' : '');
            $tahun_lahir = (request()->tahun_lahir ? 'Tahun Lahir : '.request()->tahun_lahir.' | ' : '');
            $status = "";
            if (request()->status == 1) {
                $status = " | Status : Disetujui";
            }elseif(request()->status == 2){
                $status = " | Status : Ditolak";
            }else{
                $status = " | Status : Menunggu persetujuan";
            }

            $tanggal_awal = (request()->tanggal_awal ? Carbon::parse(request('tanggal_awal'))->format('d/m/Y') : '');
            $tanggal_akhir = (request()->tanggal_akhir ? Carbon::parse(request('tanggal_akhir'))->format('d/m/Y') : '');

            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell(275,0,'( '.$kelas.$jurusan.$jenis_kelamin.$tahun_lahir.'Tanggal : '.$tanggal_awal.' - '.$tanggal_akhir.$status.' ) ',0,0,'C',0);    
            $pdf->Ln(10);
     
        // Field dan isi data
        $fields = ['No.','NIS','Nama','Jenis Kelamin','Kelas','Jurusan','Tanggal Lahir','Tanggal Pendaftaran','Status','Nama Penjaga'];
        $fieldWidth = [8,30,50,25,13,15,35,35,20,45]; //275

        foreach ($fields as $key => $value) {
            $pdf->SetFont('Helvetica','',10);
            if ( $key == 0 || $key == 8) {
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'C',0);
            }elseif($key == 6 || $key == 7){
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'R',0);
            }else{
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'L',0);
            }
        }
            
        $no = 1;
        foreach ($memberRegistrations as $key => $member) {
            if ($member->status == 1) {
                $status = "Disetujui";
            }elseif($member->status == 2){
                $status = "Ditolak";
            }else{
                $status = "Menunggu persetujuan";
            }
            $pdf->Ln(8);
            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell($fieldWidth[0],8,$no,1,0,'C',0);
            $pdf->Cell($fieldWidth[1],8,$member->nis,1,0,'L',0);
            $pdf->Cell($fieldWidth[2],8,$member->nama,1,0,'L',0);
            $pdf->Cell($fieldWidth[3],8,$member->jenis_kelamin,1,0,'L',0);
            $pdf->Cell($fieldWidth[4],8,$member->kelas,1,0,'L',0);
            $pdf->Cell($fieldWidth[5],8,$member->jurusan,1,0,'L',0);
            $pdf->Cell($fieldWidth[6],8,Carbon::parse($member->tanggal_lahir)->format('d/m/Y'),1,0,'R',0);
            $pdf->Cell($fieldWidth[7],8,Carbon::parse($member->created_at)->format('d/m/Y'),1,0,'R',0);
            $pdf->Cell($fieldWidth[8],8,$status,1,0,'C',0);
            $pdf->Cell($fieldWidth[9],8, $member->editor ? $member->editor->nama : $member->creator->nama ,1,0,'L',0);
            $no++;
        
        }


        $now = Carbon::now();
        $pdf->output('I','Report Pengembalian Buku '.$now.'.pdf',false);
        exit;
	}
}