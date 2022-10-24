<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Fine;
use App\Models\Staff;
use App\Models\Stock;
use App\Models\Borrow;
use App\Models\Member;
use App\Models\Returns;
use App\Models\Donation;
use App\Models\BorrowItem;
use App\Models\BookDonation;
use Illuminate\Http\Request;
use App\Models\StaffRegistration;
use App\Models\MemberRegistration;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // Peminjaman
    public function borrow()
    {
        // Filter
        $query = Borrow::when(request()->tanggal_awal && request()->tanggal_akhir, function($q){
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

        // Kirim data ke report
        if(request()->member_id){
            $member_id = request()->member_id;
        }else{
            $member_id = NULL;
        }
        if(request()->status){
            $status = request()->status;
        }else{
            $status = NULL;
        }
        if(request()->tanggal_awal){
            $tanggal_awal = request()->tanggal_awal;
        }else{
            $tanggal_awal = NULL;
        }
        if(request()->tanggal_akhir){
            $tanggal_akhir = request()->tanggal_akhir;
        }else{
            $tanggal_akhir = NULL;
        }

        return view('report.borrows.index',[
            'borrows' => $query,
            'member_id' => $member_id,
            'status' => $status,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir
        ]);
    }

    public function borrowSet()
    {
        return view('report.borrows.set',[
            'members' => Borrow::select(DB::raw('DISTINCT member_id'))->get(),
            'status' => Borrow::select(DB::raw('DISTINCT status'))->get()
        ]);
    }

    // Pengembalian
    public function return()
    {
        // Filter
        $query = Returns::when(request()->tanggal_awal && request()->tanggal_akhir, function($q){
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

        // Kirim data ke report
        if(request()->member_id){
            $member_id = request()->member_id;
        }else{
            $member_id = NULL;
        }
        if(request()->status){
            $status = request()->status;
        }else{
            $status = NULL;
        }
        if(request()->tanggal_awal){
            $tanggal_awal = request()->tanggal_awal;
        }else{
            $tanggal_awal = NULL;
        }
        if(request()->tanggal_akhir){
            $tanggal_akhir = request()->tanggal_akhir;
        }else{
            $tanggal_akhir = NULL;
        }

        return view('report.returns.index',[
            'returns' => $query,
            'member_id' => $member_id,
            'status' => $status,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir
        ]);
    }

    public function returnSet()
    {
        return view('report.returns.set',[
            'members' => Returns::select(DB::raw('DISTINCT member_id'))->get(),
            'status' => Returns::select(DB::raw('DISTINCT dikembalikan'))->get()
        ]);
    }

        // Pengembalian
        public function Fine()
        {
            // Filter
            $query = Fine::when(request()->tanggal_awal && request()->tanggal_akhir, function($q){
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
    
            // Kirim data ke report
            if(request()->member_id){
                $member_id = request()->member_id;
            }else{
                $member_id = NULL;
            }
            if(request()->days){
                $days = request()->days;
            }else{
                $days = NULL;
            }
            if(request()->tanggal_awal){
                $tanggal_awal = request()->tanggal_awal;
            }else{
                $tanggal_awal = NULL;
            }
            if(request()->tanggal_akhir){
                $tanggal_akhir = request()->tanggal_akhir;
            }else{
                $tanggal_akhir = NULL;
            }
    
            return view('report.fines.index',[
                'fines' => $query,
                'member_id' => $member_id,
                'days' => $days,
                'tanggal_awal' => $tanggal_awal,
                'tanggal_akhir' => $tanggal_akhir
            ]);
        }
    
        public function fineSet()
        {
            return view('report.fines.set',[
                'members' => Fine::select(DB::raw('DISTINCT member_id'))->get(),
                'lateDays' => Fine::select(DB::raw('DISTINCT waktu_tenggat'))->orderBy('waktu_tenggat')->get()
            ]);
        }
    

    // Pendaftaran Anggota
    public function memberRegistration()
    {
        // Filter
        $query = MemberRegistration::when(request()->tanggal_awal && request()->tanggal_akhir, function($q){
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
            ->when(request()->status, function($q){
                return $q->where('status',request()->status);
            })
            ->when(true, function($q){
                return $q->where('id','!=',NULL);
        })
        ->get();

        // Kirim data ke report
        if(request()->tanggal_awal){
            $tanggal_awal = request()->tanggal_awal;
        }else{
            $tanggal_awal = NULL;
        }
        if(request()->tanggal_akhir){
            $tanggal_akhir = Carbon::parse(request('tanggal_akhir'))->addHours(23)->addMinutes(59)->addSeconds(59);
        }else{
            $tanggal_akhir = NULL;
        }
        if(request()->status){
            $status = request()->status;
        }else{
            $status = NULL;
        }
        if(request()->kelas){
            $kelas = request()->kelas;
        }else{
            $kelas = NULL;
        }
        if(request()->jurusan){
            $jurusan = request()->jurusan;
        }else{
            $jurusan = NULL;
        }
        if(request()->jenis_kelamin){
            $jenis_kelamin = request()->jenis_kelamin;
        }else{
            $jenis_kelamin = NULL;
        }
        if(request()->tahun_lahir){
            $tahun_lahir = request()->tahun_lahir;
        }else{
            $tahun_lahir = NULL;
        }

        return view('report.member-registrations.index',[
            'memberRegistrations' => $query,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'status' => $status,
            'kelas' => $kelas,
            'jurusan' => $jurusan,
            'jenis_kelamin' => $jenis_kelamin,
            'tahun_lahir' => $tahun_lahir
        ]);
    }

    public function memberRegistrationSet()
    {
        return view('report.member-registrations.set',[
            'genders' => MemberRegistration::select(DB::raw('DISTINCT jenis_kelamin'))->get(),
            'classes' => MemberRegistration::select(DB::raw('DISTINCT kelas'))->orderBy('kelas')->get(),
            'majors' => MemberRegistration::select(DB::raw('DISTINCT jurusan'))->get(),
            'status' => MemberRegistration::select(DB::raw('DISTINCT status'))->get(),
            'bornYears' => MemberRegistration::select(DB::raw('DISTINCT YEAR(tanggal_lahir) as tahun_lahir'))->orderBy('tahun_lahir')->get()
        ]);
    }

    // Pendaftaran Staff
    public function staffRegistration()
    {
        // Filter
        $query = StaffRegistration::when(request()->tanggal_awal && request()->tanggal_akhir, function($q){
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

        // Kirim data ke report
        if(request()->tanggal_awal){
            $tanggal_awal = request()->tanggal_awal;
        }else{
            $tanggal_awal = NULL;
        }
        if(request()->tanggal_akhir){
            $tanggal_akhir = Carbon::parse(request('tanggal_akhir'))->addHours(23)->addMinutes(59)->addSeconds(59);
        }else{
            $tanggal_akhir = NULL;
        }
        if(request()->status){
            $status = request()->status;
        }else{
            $status = NULL;
        }
        if(request()->jenis_kelamin){
            $jenis_kelamin = request()->jenis_kelamin;
        }else{
            $jenis_kelamin = NULL;
        }
        if(request()->tahun_lahir){
            $tahun_lahir = request()->tahun_lahir;
        }else{
            $tahun_lahir = NULL;
        }

        return view('report.staff-registrations.index',[
            'staffRegistrations' => $query,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'status' => $status,
            'jenis_kelamin' => $jenis_kelamin,
            'tahun_lahir' => $tahun_lahir
        ]);
    }

    public function staffRegistrationSet()
    {
        return view('report.staff-registrations.set',[
            'genders' => StaffRegistration::select(DB::raw('DISTINCT jenis_kelamin'))->get(),
            'status' => StaffRegistration::select(DB::raw('DISTINCT status'))->get(),
            'bornYears' => StaffRegistration::select(DB::raw('DISTINCT YEAR(tanggal_lahir) as tahun_lahir'))->orderBy('tahun_lahir')->get()
        ]);
    }
    // Anggota
    public function member()
    {
        // Filter
        $query = Member::when(request()->tanggal_awal && request()->tanggal_akhir, function($q){
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
            ->when(request()->status, function($q){
                return $q->where('status',request()->status);
            })
            ->when(request()->user, function($q){
                return $q->where('user',request()->user);
            })
            ->when(true, function($q){
                return $q->where('id','!=',NULL);
        })
        ->get();

        // Kirim data ke report
        if(request()->tanggal_awal){
            $tanggal_awal = request()->tanggal_awal;
        }else{
            $tanggal_awal = NULL;
        }
        if(request()->tanggal_akhir){
            $tanggal_akhir = Carbon::parse(request('tanggal_akhir'))->addHours(23)->addMinutes(59)->addSeconds(59);
        }else{
            $tanggal_akhir = NULL;
        }
        if(request()->status){
            $status = request()->status;
        }else{
            $status = NULL;
        }
        if(request()->kelas){
            $kelas = request()->kelas;
        }else{
            $kelas = NULL;
        }
        if(request()->jurusan){
            $jurusan = request()->jurusan;
        }else{
            $jurusan = NULL;
        }
        if(request()->jenis_kelamin){
            $jenis_kelamin = request()->jenis_kelamin;
        }else{
            $jenis_kelamin = NULL;
        }
        if(request()->tahun_lahir){
            $tahun_lahir = request()->tahun_lahir;
        }else{
            $tahun_lahir = NULL;
        }
        if(request()->user){
            $user = request()->user;
        }else{
            $user = NULL;
        }

        return view('report.members.index',[
            'members' => $query,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'status' => $status,
            'kelas' => $kelas,
            'jurusan' => $jurusan,
            'jenis_kelamin' => $jenis_kelamin,
            'tahun_lahir' => $tahun_lahir,
            'user' => $user
        ]);
    }

    public function memberSet()
    {
        return view('report.members.set',[
            'genders' => Member::select(DB::raw('DISTINCT jenis_kelamin'))->get(),
            'classes' => Member::select(DB::raw('DISTINCT kelas'))->orderBy('kelas')->get(),
            'majors' => Member::select(DB::raw('DISTINCT jurusan'))->get(),
            'status' => Member::select(DB::raw('DISTINCT status'))->get(),
            'bornYears' => Member::select(DB::raw('DISTINCT YEAR(tanggal_lahir) as tahun_lahir'))->orderBy('tahun_lahir')->get(),
            'users' => Member::select(DB::raw('DISTINCT signed'))->get()
        ]);
    }

    // Staff
    public function staff()
    {
        // Filter
        $query = Staff::when(request()->tanggal_awal && request()->tanggal_akhir, function($q){
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
            ->when(request()->jenis_kelamin,function($q){
                return $q->where('jenis_kelamin',request()->jenis_kelamin);
            })
            ->when(request()->tahun_lahir,function($q){
                return $q->where(DB::raw('YEAR(tanggal_lahir)'),request()->tahun_lahir);
            })
            ->when(request()->user,function($q){
                return $q->where('signed',request()->user);
            })
            ->when(true, function($q){
                return $q->where('id','!=',NULL);
        })
        ->get();

        // Kirim data ke report
        if(request()->tanggal_awal){
            $tanggal_awal = request()->tanggal_awal;
        }else{
            $tanggal_awal = NULL;
        }
        if(request()->tanggal_akhir){
            $tanggal_akhir = Carbon::parse(request('tanggal_akhir'))->addHours(23)->addMinutes(59)->addSeconds(59);
        }else{
            $tanggal_akhir = NULL;
        }
        if(request()->jenis_kelamin){
            $jenis_kelamin = request()->jenis_kelamin;
        }else{
            $jenis_kelamin = NULL;
        }
        if(request()->tahun_lahir){
            $tahun_lahir = request()->tahun_lahir;
        }else{
            $tahun_lahir = NULL;
        }
        if(request()->user){
            $user = request()->user;
        }else{
            $user = NULL;
        }

        return view('report.staffs.index',[
            'staffs' => $query,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'jenis_kelamin' => $jenis_kelamin,
            'tahun_lahir' => $tahun_lahir,
            'user' => $user
        ]);
    }

    public function staffSet()
    {
        return view('report.staffs.set',[
            'genders' => Staff::select(DB::raw('DISTINCT jenis_kelamin'))->get(),
            'bornYears' => Staff::select(DB::raw('DISTINCT YEAR(tanggal_lahir) as tahun_lahir'))->orderBy('tahun_lahir')->get(),
            'users' => Staff::select(DB::raw('DISTINCT signed'))->get()
        ]);
    }

    // Buku
    public function book()
    {
        // Filter
        $query = Book::join('tb_stocks', 'tb_books.id', '=', 'tb_stocks.book_id')
            ->when(request()->tanggal_awal && request()->tanggal_akhir, function($q){
                return $q->whereBetween('tglMasuk',request()->tanggal_awal,request()->tanggal_akhir);
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

        // Kirim data ke report
        if(request()->tanggal_awal){
            $tanggal_awal = request()->tanggal_awal;
        }else{
            $tanggal_awal = NULL;
        }
        if(request()->tanggal_akhir){
            $tanggal_akhir = request()->tanggal_akhir;
        }else{
            $tanggal_akhir = NULL;
        }
        if(request()->penulis){
            $penulis = request()->penulis;
        }else{
            $penulis = NULL;
        }
        if(request()->kategori){
            $kategori = request()->kategori;
        }else{
            $kategori = NULL;
        }
        if(request()->penerbit){
            $penerbit = request()->penerbit;
        }else{
            $penerbit = NULL;
        }
        if(request()->tahun_terbit){
            $tahun_terbit = request()->tahun_terbit;
        }else{
            $tahun_terbit = NULL;
        }
        if(request()->status){
            $status = request()->status;
        }else{
            $status = NULL;
        }

        return view('report.books.index',[
            'books' => $query,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'penulis' => $penulis,
            'kategori' => $kategori,
            'penerbit' => $penerbit,
            'tahun_terbit' => $tahun_terbit,
            'status' => $status,
        ]);
    }

    public function bookSet()
    {
        return view('report.books.set',[
            'years' => Book::select(DB::raw('DISTINCT year(tglTerbit) as year'))->orderBy('year')->get(),
            'categories' => Book::select(DB::raw('DISTINCT kategori'))->orderBy('kategori')->get(),
            'writters' => Book::select(DB::raw('DISTINCT penulis'))->orderBy('penulis')->get(),
            'publishers' => Book::select(DB::raw('DISTINCT penerbit'))->orderBy('penerbit')->get()
        ]);
    }

    // History Buku
    public function borrowItem()
    {
        // Filter
        $query = Borrow::join('borrow_item', 'trx_borrows.id', '=', 'borrow_item.borrow_id')
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
        
        // Kirim data ke report
        if(request()->tanggal_awal){
            $tanggal_awal = request()->tanggal_awal;
        }else{
            $tanggal_awal = NULL;
        }
        if(request()->tanggal_akhir){
            $tanggal_akhir = request()->tanggal_akhir;
        }else{
            $tanggal_akhir = NULL;
        }
        if(request()->isbn){
            $isbn = request()->isbn;
        }else{
            $isbn = NULL;
        }
        if(request()->judul){
            $judul = request()->judul;
        }else{
            $judul = NULL;
        }
        if(request()->kode_peminjaman){
            $kode_peminjaman = request()->kode_peminjaman;
        }else{
            $kode_peminjaman = NULL;
        }
        if(request()->member_id){
            $member_id = request()->member_id;
            $nama = Member::where('id',request()->member_id)->value('nama');
        }else{
            $member_id = NULL;
            $nama = NULL;
        }
        if(request()->status){
            $status = request()->status;
        }else{
            $status = NULL;
        }

        return view('report.borrow-items.index',[
            'borrowItems' => $query,
            'nama' => $nama,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'isbn' => $isbn,
            'judul' => $judul,
            'kode_peminjaman' => $kode_peminjaman,
            'member_id' => $member_id,
            'status' => $status,
        ]);
    }

    public function borrowItemSet()
    {
        $borrowItemTable = Borrow::join('borrow_item', 'trx_borrows.id', '=', 'borrow_item.borrow_id');
        return view('report.borrow-items.set',[
            'books' => BorrowItem::select(DB::raw('DISTINCT book_id'))->orderBy('book_id')->get(),
            'borrows' => $borrowItemTable->select(DB::raw('DISTINCT kode_peminjaman'))->orderBy('kode_peminjaman')->get(),
            'members' =>  $borrowItemTable->select(DB::raw('DISTINCT member_id'))->orderBy('member_id')->get(),
            'status' => BorrowItem::select(DB::raw('DISTINCT finished'))->orderBy('finished')->get()
        ]);
    }
    
    // History Buku
    public function borrowRank()
    {
        // Filter
        $query = BorrowItem::join('tb_books', 'borrow_item.book_id', '=', 'tb_books.id')
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
        
        // Kirim data ke report
        if(request()->tanggal_awal){
            $tanggal_awal = request()->tanggal_awal;
        }else{
            $tanggal_awal = NULL;
        }
        if(request()->tanggal_akhir){
            $tanggal_akhir = request()->tanggal_akhir;
        }else{
            $tanggal_akhir = NULL;
        }
        if(request()->penulis){
            $penulis = request()->penulis;
        }else{
            $penulis = NULL;
        }
        if(request()->kategori){
            $kategori = request()->kategori;
        }else{
            $kategori = NULL;
        }
        if(request()->penerbit){
            $penerbit = request()->penerbit;
        }else{
            $penerbit = NULL;
        }
        if(request()->tahun_terbit){
            $tahun_terbit = request()->tahun_terbit;
        }else{
            $tahun_terbit = NULL;
        }

        return view('report.borrow-ranks.index',[
            'borrowRanks' => $query,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'penulis' => $penulis,
            'kategori' => $kategori,
            'penerbit' => $penerbit,
            'tahun_terbit' => $tahun_terbit
        ]);
    }

    public function borrowRankSet()
    {
        $query = BorrowItem::join('tb_books', 'borrow_item.book_id', '=', 'tb_books.id');
        return view('report.borrow-ranks.set',[
            'writters' => $query->select(DB::raw('DISTINCT penulis'))->orderBy('penulis')->get(),
            'publishers' => $query->select(DB::raw('DISTINCT penerbit'))->orderBy('penerbit')->get(),
            'categories' => $query->select(DB::raw('DISTINCT kategori'))->orderBy('kategori')->get(),
            'years' => $query->select(DB::raw('DISTINCT YEAR(tglTerbit) as year'))->orderBy('year')->get()
        ]);
    }
}