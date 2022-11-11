<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Fine;
use App\Models\Staff;
use App\Models\Borrow;
use App\Models\Member;
use App\Models\Returns;
use App\Models\BorrowItem;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\StaffRegistration;
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
        $fieldWidth = [8,35,40,60,32,32,40,30]; //275

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
            $nama = "";
            if ( $borrow->editor ) {
                $nama = $borrow->editor->nama;
            }elseif( $borrow->creator ){
                $nama = $borrow->creator->nama;
            }else{
                $nama = "-";
            }
            $pdf->Ln(8);
            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell($fieldWidth[0],8,$no,1,0,'C',0);
            $pdf->Cell($fieldWidth[1],8,$borrow->kode_peminjaman,1,0,'L',0);
            $pdf->Cell($fieldWidth[2],8,$borrow->member->nis,1,0,'L',0);
            $pdf->Cell($fieldWidth[3],8,$borrow->member->nama,1,0,'L',0);
            $pdf->Cell($fieldWidth[4],8,Carbon::parse($borrow->tanggal_pinjam)->format('d/m/Y'),1,0,'R',0);
            $pdf->Cell($fieldWidth[5],8,Carbon::parse($borrow->tanggal_tempo)->format('d/m/Y'),1,0,'R',0);
            $pdf->Cell($fieldWidth[6],8,$borrow->status,1,0,'C',0);
            $pdf->Cell($fieldWidth[7],8,strtok($nama," "),1,0,'L',0);
            $no++;
        
        }


        $now = Carbon::now()->format('d-m-Y\ H:i:s');
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
        $fieldWidth = [8,45,45,60,40,40,40]; //275

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
            $pdf->Cell($fieldWidth[6],8, $return->editor ? strtok($return->editor->nama , " ") : strtok($return->creator->nama , " ") ,1,0,'L',0);
            $no++;
        
        }


        $now = Carbon::now()->format('d-m-Y\ H:i:s');
        $pdf->output('I','Report Pengembalian Buku '.$now.'.pdf',false);
        exit;
	}

    // Pengembalian
    public function fineReport()
    {
        // Ambil data sesuai filter
        $fines = Fine::when(request()->tanggal_awal && request()->tanggal_akhir, function($q){
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
        ->when(request()->days, function($q){
            return $q->where('waktu_tenggat',request()->days);
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
            $pdf->Cell(275,0,'Report Denda Peminjaman',0,0,'C',0);
            $pdf->Ln(6);

            //Keterangan
            $member = Member::where('id',request()->member_id)->first();
            
            $nama = (request()->member_id ? 'Nama : '.$member->nama.' | ' : '');
            $telat = (request()->days ? ' | Telat : '.request()->days.' Hari' : '');
            $tanggal_awal = (request()->tanggal_awal ? Carbon::parse(request('tanggal_awal'))->format('d/m/Y') : '');
            $tanggal_akhir = (request()->tanggal_akhir ? Carbon::parse(request('tanggal_akhir'))->format('d/m/Y') : '');

            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell(275,0,'( '.$nama.'Tanggal : '.$tanggal_awal.' - '.$tanggal_akhir.$telat.' ) ',0,0,'C',0);    
            $pdf->Ln(10);
     
        // Field dan isi data
        $fields = ['No.','Kode Peminjaman','NIS','Nama Peminjam','Tanggal Kembali','Telat','Denda','Nama Penjaga'];
        $fieldWidth = [8,45,45,60,40,25,25,25]; //275

        foreach ($fields as $key => $value) {
            $pdf->SetFont('Helvetica','',10);
            if ( $key == 0 || $key == 5) {
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'C',0);
            }elseif($key == 4 || $key == 6){
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'R',0);
            }else{
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'L',0);
            }
        }
            
        $no = 1;
        foreach ($fines as $key => $fine) {
            $pdf->Ln(8);
            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell($fieldWidth[0],8,$no,1,0,'C',0);
            $pdf->Cell($fieldWidth[1],8,$fine->borrow->kode_peminjaman,1,0,'L',0);
            $pdf->Cell($fieldWidth[2],8,$fine->member->nis,1,0,'L',0);
            $pdf->Cell($fieldWidth[3],8,$fine->member->nama,1,0,'L',0);
            $pdf->Cell($fieldWidth[4],8,Carbon::parse($fine->tanggal_kembali)->format('d/m/Y'),1,0,'R',0);
            $pdf->Cell($fieldWidth[5],8,$fine->waktu_tenggat.' Hari',1,0,'C',0);
            $pdf->Cell($fieldWidth[6],8,$fine->total,1,0,'R',0);
            $pdf->Cell($fieldWidth[7],8, $fine->editor ? strtok($fine->editor->nama , " ") : strtok($fine->creator->nama , " ") ,1,0,'L',0);
            $no++;
        
        }


        $now = Carbon::now()->format('d-m-Y\ H:i:s');
        $pdf->output('I','Report Denda Peminjaman '.$now.'.pdf',false);
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
            if (request()->status == 2) {
                $status = " | Status : Disetujui";
            }elseif(request()->status == 3){
                $status = " | Status : Ditolak";
            }elseif(request()->status == 1){
                $status = " | Status : Menunggu persetujuan";
            }else{
                $status = "";
            }

            $tanggal_awal = (request()->tanggal_awal ? Carbon::parse(request('tanggal_awal'))->format('d/m/Y') : '');
            $tanggal_akhir = (request()->tanggal_akhir ? Carbon::parse(request('tanggal_akhir'))->format('d/m/Y') : '');

            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell(275,0,'( '.$kelas.$jurusan.$jenis_kelamin.$tahun_lahir.'Tanggal : '.$tanggal_awal.' - '.$tanggal_akhir.$status.' ) ',0,0,'C',0);    
            $pdf->Ln(10);
     
        // Field dan isi data
        $fields = ['No.','NIS','Nama','Jenis Kelamin','Kelas','Jurusan','Tanggal Lahir','Tanggal Pendaftaran','Status','Nama Penjaga'];
        $fieldWidth = [8,30,55,25,13,15,25,35,40,35]; //275

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
            if ($member->status == 2) {
                $status = "Disetujui";
            }elseif($member->status == 3){
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
            $pdf->Cell($fieldWidth[9],8, $member->editor ? strtok($member->editor->nama , " ") : strtok($member->creator->nama , " ") ,1,0,'L',0);
            $no++;
        
        }


        $now = Carbon::now()->format('d-m-Y\ H:i:s');
        $pdf->output('I','Report Pendaftaran Anggota '.$now.'.pdf',false);
        exit;
	}

    // Pendaftaran Staff
    public function staffRegistrationReport()
    {
        // Ambil data sesuai filter
        $staffRegistrations =  StaffRegistration::when(request()->tanggal_awal && request()->tanggal_akhir, function($q){
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
            $pdf->Cell(275,0,'Report Pendaftaran Staff',0,0,'C',0);
            $pdf->Ln(6);

            //Keterangan kelas jurusan jenis kelamin tanggal lahir
            $jenis_kelamin = (request()->jenis_kelamin ? 'Jenis Kelamin : '.request()->jenis_kelamin.' | ' : '');
            $tahun_lahir = (request()->tahun_lahir ? 'Tahun Lahir : '.request()->tahun_lahir.' | ' : '');
            $status = "";
            if (request()->status == 2) {
                $status = " | Status : Disetujui";
            }elseif(request()->status == 3){
                $status = " | Status : Ditolak";
            }elseif(request()->status == 1){
                $status = " | Status : Menunggu persetujuan";
            }else{
                $status = "";
            }

            $tanggal_awal = (request()->tanggal_awal ? Carbon::parse(request('tanggal_awal'))->format('d/m/Y') : '');
            $tanggal_akhir = (request()->tanggal_akhir ? Carbon::parse(request('tanggal_akhir'))->format('d/m/Y') : '');

            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell(275,0,'( '.$jenis_kelamin.$tahun_lahir.'Tanggal : '.$tanggal_awal.' - '.$tanggal_akhir.$status.' ) ',0,0,'C',0);    
            $pdf->Ln(10);
     
        // Field dan isi data
        $fields = ['No.','Nama','Email','Jenis Kelamin','Tanggal Lahir','Nomor Telepon','Pendaftaran','Status','Admin'];
        $fieldWidth = [8,50,55,25,25,35,25,25,30]; //275

        foreach ($fields as $key => $value) {
            $pdf->SetFont('Helvetica','',10);
            if ( $key == 0 || $key == 7) {
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'C',0);
            }elseif($key == 4 || $key == 6){
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'R',0);
            }else{
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'L',0);
            }
        }
            
        $no = 1;
        foreach ($staffRegistrations as $key => $staff) {
            if ($staff->status == 2) {
                $status = "Disetujui";
            }elseif($staff->status == 3){
                $status = "Ditolak";
            }else{
                $status = "Menunggu";
            }
            $pdf->Ln(8);
            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell($fieldWidth[0],8,$no,1,0,'C',0);
            $pdf->Cell($fieldWidth[1],8,$staff->nama,1,0,'L',0);
            $pdf->Cell($fieldWidth[2],8,$staff->email,1,0,'L',0);
            $pdf->Cell($fieldWidth[3],8,$staff->jenis_kelamin,1,0,'L',0);
            $pdf->Cell($fieldWidth[4],8,Carbon::parse($staff->tanggal_lahir)->format('d/m/Y'),1,0,'R',0);
            $pdf->Cell($fieldWidth[5],8,$staff->nomor_telepon,1,0,'L',0);
            $pdf->Cell($fieldWidth[6],8,Carbon::parse($staff->created_at)->format('d/m/Y'),1,0,'R',0);
            $pdf->Cell($fieldWidth[7],8,$status,1,0,'C',0);
            $pdf->Cell($fieldWidth[8],8, $staff->editor ? strtok($staff->editor->nama , " ") : strtok($staff->creator->nama , " ") ,1,0,'L',0);
            $no++;
        
        }


        $now = Carbon::now()->format('d-m-Y\ H:i:s');
        $pdf->output('I','Report Pendaftaran Staff '.$now.'.pdf',false);
        exit;
	}

      // Anggota
      public function memberReport()
      {
          // Ambil data sesuai filter
          $members =  Member::when(request()->tanggal_awal && request()->tanggal_akhir, function($q){
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
              ->when(request()->user, function($q){
                  return $q->where('signed',request()->user);
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
              $pdf->Cell(275,0,'Report Anggota',0,0,'C',0);
              $pdf->Ln(6);
  
              //Keterangan kelas jurusan jenis kelamin tanggal lahir
              $kelas = (request()->kelas ? 'Kelas : '.request()->kelas.' | ' : '');
              $jurusan = (request()->jurusan ? 'Jurusan : '.request()->jurusan.' | ' : '');
              $jenis_kelamin = (request()->jenis_kelamin ? 'Jenis Kelamin : '.request()->jenis_kelamin.' | ' : '');
              $tahun_lahir = (request()->tahun_lahir ? 'Tahun Lahir : '.request()->tahun_lahir.' | ' : '');
              $status = "";
              if(request()->status == 2){
                $status = "| Status : Aktif ";
              }elseif(request()->status == 1){
                $status = "| Status : Nonaktif ";
              }else{
                $status = "";
              }
              $user = "";
              if(request()->user == 2){
                $user = "| User : Aktif ";
              }elseif(request()->user == 1){
                $user = "| User : Nonaktif ";
              }else{
                $user = "";
              }
  
              $tanggal_awal = (request()->tanggal_awal ? Carbon::parse(request('tanggal_awal'))->format('d/m/Y') : '');
              $tanggal_akhir = (request()->tanggal_akhir ? Carbon::parse(request('tanggal_akhir'))->format('d/m/Y') : '');
  
              $pdf->SetFont('Helvetica','',10);
              $pdf->Cell(275,0,'( '.$kelas.$jurusan.$jenis_kelamin.$tahun_lahir.'Tanggal : '.$tanggal_awal.' - '.$tanggal_akhir.$status.$user.' ) ',0,0,'C',0);    
              $pdf->Ln(10);
       
          // Field dan isi data
          $fields = ['No.','NIS','Nama','Jenis Kelamin','Kelas','Jurusan','Tanggal Lahir','Tanggal Pendaftaran','Status','User','Nama Penjaga'];
          $fieldWidth = [8,30,50,25,13,15,25,35,25,25,30]; //275
  
          foreach ($fields as $key => $value) {
              $pdf->SetFont('Helvetica','',10);
              if ( $key == 0 || $key == 8 || $key == 9) {
                  $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'C',0);
              }elseif($key == 6 || $key == 7){
                  $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'R',0);
              }else{
                  $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'L',0);
              }
          }
              
          $no = 1;
          foreach ($members as $key => $member) {
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
              $pdf->Cell($fieldWidth[8],8,($member->status == 2 ? "Aktif" : "Nonaktif"),1,0,'C',0);
              $pdf->Cell($fieldWidth[9],8,($member->signed == 2 ? "Terdaftar" : "Tidak"),1,0,'C',0);
              $pdf->Cell($fieldWidth[10],8, $member->editor ? strtok($member->editor->nama , " ") : strtok($member->creator->nama , " ") ,1,0,'L',0);
              $no++;
          
          }
  
  
          $now = Carbon::now()->format('d-m-Y\ H:i:s');
          $pdf->output('I','Report Anggota '.$now.'.pdf',false);
          exit;
      }

        //Staff
    public function staffReport()
    {
        // Ambil data sesuai filter
        $staffs =  Staff::when(request()->tanggal_awal && request()->tanggal_akhir, function($q){
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
            ->when(request()->user, function($q){
                return $q->where('signed',request()->user);
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
            $pdf->Cell(275,0,'Report Staff',0,0,'C',0);
            $pdf->Ln(6);

            //Keterangan kelas jurusan jenis kelamin tanggal lahir
            $jenis_kelamin = (request()->jenis_kelamin ? 'Jenis Kelamin : '.request()->jenis_kelamin.' | ' : '');
            $tahun_lahir = (request()->tahun_lahir ? 'Tahun Lahir : '.request()->tahun_lahir.' | ' : '');
            $user = "";
            if (request()->user == 2) {
                $user = " | User : Terdaftar";
            }elseif(request()->user == 1){
                $user = " | User : Tidak";
            }else{
                $user = "";
            }

            $tanggal_awal = (request()->tanggal_awal ? Carbon::parse(request('tanggal_awal'))->format('d/m/Y') : '');
            $tanggal_akhir = (request()->tanggal_akhir ? Carbon::parse(request('tanggal_akhir'))->format('d/m/Y') : '');

            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell(275,0,'( '.$jenis_kelamin.$tahun_lahir.'Tanggal : '.$tanggal_awal.' - '.$tanggal_akhir.$user.' ) ',0,0,'C',0);    
            $pdf->Ln(10);
     
        // Field dan isi data
        $fields = ['No.','Nama','Email','Jenis Kelamin','Tanggal Lahir','Nomor Telepon','Pendaftaran','User','Admin'];
        $fieldWidth = [8,50,55,25,25,35,25,25,30]; //275

        foreach ($fields as $key => $value) {
            $pdf->SetFont('Helvetica','',10);
            if ( $key == 0 || $key == 7) {
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'C',0);
            }elseif($key == 4 || $key == 6){
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'R',0);
            }else{
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'L',0);
            }
        }
            
        $no = 1;
        $staffName = "-";
        foreach ($staffs as $key => $staff) {
            if($staff->editor){
                $staffName = $staff->editor->nama;
            }elseif($staff->creator){
                $staffName = $staff->editor->nama;
            }else{
                $staffName = "-";
            }
            $pdf->Ln(8);
            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell($fieldWidth[0],8,$no,1,0,'C',0);
            $pdf->Cell($fieldWidth[1],8,$staff->nama,1,0,'L',0);
            $pdf->Cell($fieldWidth[2],8,$staff->email,1,0,'L',0);
            $pdf->Cell($fieldWidth[3],8,$staff->jenis_kelamin,1,0,'L',0);
            $pdf->Cell($fieldWidth[4],8,Carbon::parse($staff->tanggal_lahir)->format('d/m/Y'),1,0,'R',0);
            $pdf->Cell($fieldWidth[5],8,$staff->nomor_telepon,1,0,'L',0);
            $pdf->Cell($fieldWidth[6],8,Carbon::parse($staff->created_at)->format('d/m/Y'),1,0,'R',0);
            $pdf->Cell($fieldWidth[7],8,($staff->signed == 2 ? "Terdaftar" : "Tidak"),1,0,'C',0);
            $pdf->Cell($fieldWidth[8],8, strtok($staffName , " ") ,1,0,'L',0);
            $no++;
        
        }


        $now = Carbon::now()->format('d-m-Y\ H:i:s');
        $pdf->output('I','Report Staff '.$now.'.pdf',false);
        exit;
	}

    
    // Book
    public function bookReport()
    {
        // Ambil data sesuai filter
        $books = Book::join('tb_stocks', 'tb_books.id', '=', 'tb_stocks.book_id')
        ->when(request()->tanggal_awal && request()->tanggal_akhir, function($q){
            return $q->whereBetween(('tglMasuk'),request()->tanggal_awal,request()->tanggal_akhir);
        })
        ->when(request()->tanggal_akhir, function($q){
            return $q->whereBetween('tglMasuk',[0000-00-00, request()->tanggal_akhir]);
        })
        ->when(request()->tanggal_awal, function($q){
            return $q->whereBetween('tglMasuk',[request()->tanggal_awal,'2099-10-17']);
        })
        ->when(request()->penulis,function($q){
            return $q->where('penulis',request()->penulis);
        })
        ->when(request()->kategori,function($q){
            return $q->where('kategori',request()->kategori);
        })
        ->when(request()->penerbit,function($q){
            return $q->where('penerbit',request()->penerbit);
        })
        ->when(request()->tahun_terbit,function($q){
            return $q->where(DB::raw('YEAR(tglTerbit)'),request()->tahun_terbit);
        })
        ->when(request()->status == 2,function($q){
            return $q->where('stok_akhir','>','0');
        })
        ->when(request()->status == 1,function($q){
            return $q->where('stok_akhir','<=','0');
        })
        ->when(true, function($q){
            return $q->where('tb_books.id','!=',NULL);
        })
        ->get();
        
        // FPDF
        $pdf = new Fpdf('L','mm','A4');
        

        $pdf->AliasNbPages();
        $pdf->AddPage();
        // Header
            // Judul
            $pdf->SetFont('Helvetica','B',16);
            $pdf->Cell(275,0,'Report Buku',0,0,'C',0);
            $pdf->Ln(6);

            //Keterangan
            $penulis = (request()->penulis ? 'Penulis : '.request()->penulis.' | ' : '');
            $kategori = (request()->kategori ? 'Kategori : '.request()->kategori.' | ' : '');
            $penerbit = (request()->penerbit ? 'Penerbit : '.request()->penerbit.' | ' : '');
            $tahun_terbit = (request()->tahun_terbit ? 'Tahun Terbit : '.request()->tahun_terbit.' | ' : '');
            $status = "";
            if(request()->status == 2){
                $status = ' | Stok : Tersedia';
            }elseif(request()->status == 1){
                $status = ' | Stok : Tidak Tersedia';
            }else{
                $status = "";
            }
            $tanggal_awal = (request()->tanggal_awal ? Carbon::parse(request('tanggal_awal'))->format('d/m/Y') : '');
            $tanggal_akhir = (request()->tanggal_akhir ? Carbon::parse(request('tanggal_akhir'))->format('d/m/Y') : '');

            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell(275,0,'( '.$penulis.$kategori.$penerbit.$tahun_terbit.'Tanggal : '.$tanggal_awal.' - '.$tanggal_akhir.$status.' ) ',0,0,'C',0);    
            $pdf->Ln(10);
     
        // Field dan isi data
        $fields = ['No.','ISBN','Judul','Penulis','Kategori','Penerbit','Tahun Terbit','Tanggal Masuk','Stok'];
        $fieldWidth = [8,30,50,25,25,70,25,30,15]; //275

        foreach ($fields as $key => $value) {
            $pdf->SetFont('Helvetica','',10);
            if ( $key == 0 || $key == 8) {
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'C',0);
            }elseif($key == 7 || $key == 6){
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'R',0);
            }else{
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'L',0);
            }
        }
            
        $no = 1;
        foreach ($books as $key => $book) {
            $pdf->Ln(8);
            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell($fieldWidth[0],8,$no,1,0,'C',0);
            $pdf->Cell($fieldWidth[1],8,$book->isbn,1,0,'L',0);
            $pdf->Cell($fieldWidth[2],8,$book->judul,1,0,'L',0);
            $pdf->Cell($fieldWidth[3],8,strtok($book->penulis , " ") ,1,0,'L',0);
            $pdf->Cell($fieldWidth[4],8,$book->kategori,1,0,'L',0);
            $pdf->Cell($fieldWidth[5],8,$book->penerbit,1,0,'L',0);
            $pdf->Cell($fieldWidth[6],8,Carbon::parse($book->tglTerbit)->format('Y'),1,0,'R',0);
            $pdf->Cell($fieldWidth[7],8,Carbon::parse($book->tglMasuk)->format('d-m-Y'),1,0,'R',0);
            $pdf->Cell($fieldWidth[8],8,($book->stok_akhir > 0 ? $book->stok_akhir : '-'),1,0,'C',0);
            $no++;
        
        }


        $now = Carbon::now()->format('d-m-Y\ H:i:s');
        $pdf->output('I','Report Buku '.$now.'.pdf',false);
        exit;
	}

    // Borrow Item
    public function borrowItemReport()
    {
        // Ambil data sesuai filter
        $books = Borrow::join('borrow_item', 'trx_borrows.id', '=', 'borrow_item.borrow_id')
        ->join('tb_books','borrow_item.book_id','=','tb_books.id')
        ->when(request()->tanggal_awal && request()->tanggal_akhir, function($q){
            return $q->whereBetween(('tanggal_pinjam'),request()->tanggal_awal,request()->tanggal_akhir);
        })
        ->when(request()->tanggal_akhir, function($q){
            return $q->whereBetween('tanggal_pinjam',[0000-00-00, request()->tanggal_akhir]);
        })
        ->when(request()->tanggal_awal, function($q){
            return $q->whereBetween('tanggal_pinjam',[request()->tanggal_awal,'2099-10-17']);
        })
        ->when(request()->isbn,function($q){
            return $q->where('isbn',request()->isbn);
        })
        ->when(request()->judul,function($q){
            return $q->where('judul',request()->judul);
        })
        ->when(request()->penerbit,function($q){
            return $q->where('penerbit',request()->penerbit);
        })
        ->when(request()->kode_peminjaman,function($q){
            return $q->where('kode_peminjaman',request()->kode_peminjaman);
        })
        ->when(request()->status,function($q){
            return $q->where('finished',request()->status);
        })
        ->when(request()->member_id,function($q){
            return $q->where('member_id',request()->member_id);
        })
        ->when(true, function($q){
            return $q->where('trx_borrows.id','!=',NULL);
        })
        ->get();
        
        // FPDF
        $pdf = new Fpdf('L','mm','A4');
        

        $pdf->AliasNbPages();
        $pdf->AddPage();
        // Header
            // Judul
            $pdf->SetFont('Helvetica','B',16);
            $pdf->Cell(275,0,'Report Histori Buku',0,0,'C',0);
            $pdf->Ln(6);

            //Keterangan isbn judul kode_peminjaman status member_id
            $isbn = (request()->isbn ? 'Isbn : '.request()->isbn.' | ' : '');
            $judul = (request()->judul ? 'Judul : '.request()->judul.' | ' : '');
            $kode_peminjaman = (request()->kode_peminjaman ? 'Kode : '.request()->kode_peminjaman.' | ' : '');
            $member_id = (request()->member_id ? 'Nama Anggota : '.strtok(request()->nama ," ").' | ' : '');
            $status = "";
            if(request()->status == 2){
                $status = ' | Status : Selesai';
            }elseif(request()->status == 1){
                $status = ' | Status : Dipinjam';
            }else{
                $status = "";
            }
            $tanggal_awal = (request()->tanggal_awal ? Carbon::parse(request('tanggal_awal'))->format('d/m/Y') : '');
            $tanggal_akhir = (request()->tanggal_akhir ? Carbon::parse(request('tanggal_akhir'))->format('d/m/Y') : '');

            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell(275,0,'( '.$isbn.$judul.$kode_peminjaman.$member_id.'Tanggal : '.$tanggal_awal.' - '.$tanggal_akhir.$status.' ) ',0,0,'C',0);    
            $pdf->Ln(10);
     
        // Field dan isi data
        $fields = ['No.','ISBN','Judul','Kode Peminjaman','Anggota','Tanggal Pinjam','Tanggal Kembali','Status','Penjaga'];
        $fieldWidth = [8,30,70,35,25,30,30,25,25]; //275

        foreach ($fields as $key => $value) {
            $pdf->SetFont('Helvetica','',10);
            if ( $key == 0 || $key == 7) {
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'C',0);
            }elseif($key == 5 || $key == 6){
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'R',0);
            }else{
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'L',0);
            }
        }
            
        $no = 1;
        foreach ($books as $key => $book) {
            $pdf->Ln(8);
            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell($fieldWidth[0],8,$no,1,0,'C',0);
            $pdf->Cell($fieldWidth[1],8,$book->isbn,1,0,'L',0);
            $pdf->Cell($fieldWidth[2],8,$book->judul,1,0,'L',0);
            $pdf->Cell($fieldWidth[3],8,$book->kode_peminjaman ,1,0,'L',0);
            $pdf->Cell($fieldWidth[4],8,strtok($book->member->nama, " "),1,0,'L',0);
            $pdf->Cell($fieldWidth[5],8,Carbon::parse($book->tanggal_pinjam)->format('d-m-Y'),1,0,'R',0);
            $pdf->Cell($fieldWidth[6],8,($book->finished == 2 ? Carbon::parse($book->updated_at)->format('d-m-Y') : '-'),1,0,'R',0);
            $pdf->Cell($fieldWidth[7],8,$book->finished == 1 ? "Dipinjam" : "Selesai",1,0,'C',0);
            $pdf->Cell($fieldWidth[8],8,$book->updated_by ? strtok($book->editor->nama, " ") : strtok($book->creator->nama, " "),1,0,'L',0);
            $no++;
        
        }


        $now = Carbon::now()->format('d-m-Y\ H:i:s');
        $pdf->output('I','Report Buku '.$now.'.pdf',false);
        exit;
	}

    // Peringkat Buku
    public function borrowRankReport()
    {
        // Ambil data sesuai filter
        $books = BorrowItem::join('tb_books', 'borrow_item.book_id', '=', 'tb_books.id')
            ->when(request()->tanggal_awal && request()->tanggal_akhir, function($q){
                $endDate = Carbon::parse(request('tanggal_akhir'))->addHours(23)->addMinutes(59)->addSeconds(59);
                return $q->whereBetween(('borrow_item.created_at'),[request()->tanggal_awal,$endDate]);
                })
            ->when(request()->tanggal_akhir, function($q){
                $endDate = Carbon::parse(request('tanggal_akhir'))->addHours(23)->addMinutes(59)->addSeconds(59);
                return $q->whereBetween('borrow_item.created_at',[0000-00-00, $endDate]);
            })
            ->when(request()->tanggal_awal, function($q){
                return $q->whereBetween('borrow_item.created_at',[request()->tanggal_awal,'2099-10-17']);
            })
            ->when(request()->penulis,function($q){
                return $q->where('penulis',request()->penulis);
            })
            ->when(request()->kategori,function($q){
                return $q->where('kategori',request()->kategori);
            })
            ->when(request()->penerbit,function($q){
                return $q->where('penerbit',request()->penerbit);
            })
            ->when(request()->tahun_terbit,function($q){
                return $q->where(DB::raw('YEAR(tglTerbit)'),request()->tahun_terbit);
            })
            ->when(true, function($q){
                return $q->where('borrow_item.id','!=',NULL);
        })
        ->select(DB::raw('*, count(book_id) as count'))
        ->groupby('book_id')
        ->orderby('count','DESC')
        ->get();
        
        // FPDF
        $pdf = new Fpdf('L','mm','A4');
        

        $pdf->AliasNbPages();
        $pdf->AddPage();
        // Header
            // Judul
            $pdf->SetFont('Helvetica','B',16);
            $pdf->Cell(275,0,'Report Peringkat Buku',0,0,'C',0);
            $pdf->Ln(6);

            $penulis = (request()->penulis ? 'Penulis : '.request()->penulis.' | ' : '');
            $kategori = (request()->kategori ? 'Kategori : '.request()->kategori.' | ' : '');
            $penerbit = (request()->penerbit ? 'Penerbit : '.request()->penerbit.' | ' : '');
            $tahun_terbit = (request()->tahun_terbit ? 'Tahun Terbit : '.request()->tahun_terbit.' | ' : '');
            $tanggal_awal = (request()->tanggal_awal ? Carbon::parse(request('tanggal_awal'))->format('d/m/Y') : '');
            $tanggal_akhir = (request()->tanggal_akhir ? Carbon::parse(request('tanggal_akhir'))->format('d/m/Y') : '');

            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell(275,0,'( '.$penulis.$kategori.$penerbit.$tahun_terbit.'Tanggal : '.$tanggal_awal.' - '.$tanggal_akhir.' ) ',0,0,'C',0);    
            $pdf->Ln(10);
     
        // Field dan isi data
        $fields = ['No.','ISBN','Judul','Penulis','Kategori','Penerbit','Tahun Terbit','Dipinjam'];
        $fieldWidth = [8,30,70,30,25,70,25,20]; //275

        foreach ($fields as $key => $value) {
            $pdf->SetFont('Helvetica','',10);
            if ( $key == 0 || $key == 7) {
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'C',0);
            }elseif($key == 6){
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'R',0);
            }else{
                $pdf->Cell($fieldWidth[$key],8,$fields[$key],1,0,'L',0);
            }
        }
            
        $no = 1;
        foreach ($books as $key => $book) {
            $pdf->Ln(8);
            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell($fieldWidth[0],8,$no,1,0,'C',0);
            $pdf->Cell($fieldWidth[1],8,$book->isbn,1,0,'L',0);
            $pdf->Cell($fieldWidth[2],8,$book->judul,1,0,'L',0);
            $pdf->Cell($fieldWidth[3],8,strtok($book->penulis, " ") ,1,0,'L',0);
            $pdf->Cell($fieldWidth[4],8,$book->kategori ,1,0,'L',0);
            $pdf->Cell($fieldWidth[5],8,$book->penerbit ,1,0,'L',0);
            $pdf->Cell($fieldWidth[6],8,Carbon::parse($book->tglTerbit)->format('Y'),1,0,'R',0);
            $pdf->Cell($fieldWidth[7],8,$book->count,1,0,'C',0);
            $no++;
        
        }


        $now = Carbon::now()->format('d-m-Y\ H:i:s');
        $pdf->output('I','Report Peringkat Buku '.$now.'.pdf',false);
        exit;
	}


}