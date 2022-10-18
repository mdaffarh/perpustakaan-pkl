<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Fine;
use App\Models\Stock;
use App\Models\Borrow;
use App\Models\Member;
use App\Models\Returns;
use App\Models\Donation;
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
    // public function staffRegistration()
    // {
    //     // Filter
    //     $query = StaffRegistration::when(request()->tanggal_awal && request()->tanggal_akhir, function($q){
    //         $endDate = Carbon::parse(request('tanggal_akhir'))->addHours(23)->addMinutes(59)->addSeconds(59);
    //         return $q->whereBetween(('created_at'),[request()->tanggal_awal,$endDate]);
    //         })
    //         ->when(request()->tanggal_akhir, function($q){
    //             $endDate = Carbon::parse(request('tanggal_akhir'))->addHours(23)->addMinutes(59)->addSeconds(59);
    //             return $q->whereBetween('created_at',[0000-00-00, $endDate]);
    //         })
    //         ->when(request()->tanggal_awal, function($q){
    //             return $q->whereBetween('created_at',[request()->tanggal_awal,'2099-10-17']);
    //         })
    //         ->when(request()->status, function($q){
    //             return $q->where('status',request()->status);
    //         })
    //         ->when(request()->jenis_kelamin,function($q){
    //             return $q->where('jenis_kelamin',request()->jenis_kelamin);
    //         })
    //         ->when(request()->tahun_lahir,function($q){
    //             return $q->where(DB::raw('YEAR(tanggal_lahir)'),request()->tahun_lahir);
    //         })
    //         ->when(true, function($q){
    //             return $q->where('id','!=',NULL);
    //     })
    //     ->get();

    //     // Kirim data ke report
    //     if(request()->tanggal_awal){
    //         $tanggal_awal = request()->tanggal_awal;
    //     }else{
    //         $tanggal_awal = NULL;
    //     }
    //     if(request()->tanggal_akhir){
    //         $tanggal_akhir = Carbon::parse(request('tanggal_akhir'))->addHours(23)->addMinutes(59)->addSeconds(59);
    //     }else{
    //         $tanggal_akhir = NULL;
    //     }
    //     if(request()->status){
    //         $status = request()->status;
    //     }else{
    //         $status = NULL;
    //     }
    //     if(request()->jenis_kelamin){
    //         $jenis_kelamin = request()->jenis_kelamin;
    //     }else{
    //         $jenis_kelamin = NULL;
    //     }
    //     if(request()->tahun_lahir){
    //         $tahun_lahir = request()->tahun_lahir;
    //     }else{
    //         $tahun_lahir = NULL;
    //     }

    //     return view('report.staff-registrations.index',[
    //         'staffRegistrations' => $query,
    //         'tanggal_awal' => $tanggal_awal,
    //         'tanggal_akhir' => $tanggal_akhir,
    //         'status' => $status,
    //         'jenis_kelamin' => $jenis_kelamin,
    //         'tahun_lahir' => $tahun_lahir
    //     ]);
    // }

    // public function staffRegistrationSet()
    // {
    //     return view('report.staff-registrations.set',[
    //         'genders' => StaffRegistration::select(DB::raw('DISTINCT jenis_kelamin'))->get(),
    //         'status' => StaffRegistration::select(DB::raw('DISTINCT status'))->get(),
    //         'bornYears' => StaffRegistration::select(DB::raw('DISTINCT YEAR(tanggal_lahir) as tahun_lahir'))->orderBy('tahun_lahir')->get()
    //     ]);
    // }
}