<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\User;
use App\Models\Major;
use App\Models\Staff;
use App\Models\Stock;
use App\Models\Borrow;
use App\Models\Member;
use App\Models\School;
use App\Models\Returns;
use App\Models\StaffUser;
use App\Models\CategoryBook;
use Illuminate\Database\Seeder;
use App\Models\StaffRegistration;
use App\Models\MemberRegistration;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Book::factory(30)->create();
        // Anggota dan Staff
        foreach(range(11,30) as $iteration){
            $randomNumber1 = rand(1000000000000000,9999999999999999);
            $nip = $randomNumber1.$iteration;
            Staff::factory(1)->create(['nip' => $nip]);
            $randomNumber = rand(10000000,99999999);
            $nis = $randomNumber.$iteration;
            Member::factory(1)->create(['nis' => $nis]);
        }
        
        // Pendaftaran buat report doang
        // foreach(range(11,80) as $iteration){
        //     $randomNumber = rand(10000000,99999999);
        //     $nis = $randomNumber.$iteration;
        //     MemberRegistration::factory(1)->create(['nis' => $nis]);
        //     $randomNumber1 = rand(1000000000000000,9999999999999999);
        //     $nip = $randomNumber1.$iteration;
        //     StaffRegistration::factory(1)->create(['nip' => $nip]);
        // }
        
        // Buku dan Stock
        // foreach (range(11, 30) as $iteration) {
        //     $randomNumber = rand(10000000000,99999999999);
        //     $isbn = $randomNumber.$iteration;
        //     Book::factory(1)->create(['isbn' => $isbn]);
        // }
        
        // Borrow factory buat report doang
        // foreach (range(11, 70) as $iteration) {
        //     $randomNumber = rand(1000,9999);
        //     $randomNumber2 = rand(1000,9999);
        //     $kode = $randomNumber.'/PB/'.$randomNumber2.$iteration;
        //     Borrow::factory(1)->create(['kode_peminjaman' => $kode]);
        // }
        
        // Return factory buat report doang
        // foreach (range(11, 60) as $iteration) {
        //     $randomNumber = rand(1000,9999);
        //     $randomNumber2 = rand(1000,9999);
        //     $kode = $randomNumber.'/RB/'.$randomNumber2.$iteration;
        //     Returns::factory(1)->create(['kode_pengembalian' => $kode , 'borrow_id' => $iteration]);
        // }
        
        foreach (range(1, 20) as $iteration) {
            Stock::factory(1)->create(['book_id' => $iteration]);
        }

        // User
        $user = [
            [
                'staff_id' => 1,
                'username' => 'admin',
                'password' =>bcrypt('123'),
                'role'=> 'admin'
            ],
            [
                'staff_id' => 2,
                'username' => 'penjaga',
                'password' =>bcrypt('123'),
                'role'=> 'penjaga'
            ],
            [
                'member_id' => 1,
                'username' => 'anggota',
                'password' =>bcrypt('123')
            ],
        ];

        foreach($user as $key => $value) {
            Staff::where('id',1)->update(['signed' => 2]);
            Staff::where('id',2)->update(['signed' => 2]);
            Member::where('id',1)->update(['signed' => 2]);
            User::create($value);
        }    
            
        // Tabel Sekolah
        School::create([
            'nama' => 'SMK NEGERI 1 Cibinong',
            'alamat' => 'Jl. Karadenan No.7, Karadenan, Kec. Cibinong, Kabupaten Bogor, Jawa Barat 16111',
            'kota' => 'Kabupaten Bogor',
            'kode_pos' => '16111',
            'email' => 'admin@smkn1cibinong.sch.id',
            'website' => 'https://smkn1cibinong.sch.id/',
            'fax' => '622518665558',
            'nomor_telepon' => '622518663846'
        ]);

        //  Tabel Jurusan
            $majors = 
            [
                [
                    'short' => 'RPL',
                    'full' => 'Rekayasa Perangkat Lunak'
                ],
                [
                    'short' => 'TKJ',
                    'full' => 'Teknik Komputer dan Jaringan'
                ],
                [
                    'short' => 'SIJA',
                    'full' => 'Sistem Informasi Jaringan dan Aplikasi'
                ],
                [
                    'short' => "MM",
                    'full' => 'Multimedia'
                ],
                [
                    'short' => "DPIB",
                    'full' => 'Desain Pemodelan dan Informasi Bangunan'
                ],
                [
                    'short' => "TP",
                    'full' => 'Teknik Pemesinan'
                ],
                [
                    'short' => "TFLM",
                    'full' => 'Teknik Fabrikasi Logam dan Manufaktur'
                ],
                [
                    'short' => "TKR",
                    'full' => 'Teknik Kendaraan Ringan'
                ],
                [
                    'short' => "BKP",
                    'full' => 'Bisnis Konstruksi dan Properti'
                ],
                [
                        'short' => "TOI",
                        'full' => 'Teknik Otomasi Industri'
                ],
        ];

        foreach ($majors as $major) {
            Major::create($major);
        }    

        //  category Buku
        $categorys = 
        [
            [
                'category' => 'Novel'
            ],
            [
                'category' => 'Komik'
            ],
            [
                'category' => 'Ensiklopedia'
            ],
            [
                'category' => 'Biografi'
            ],
            [
                'category' => 'Majalah'
            ],
            [
                'category' => 'Kamus'
            ],
            [
                'category' => 'Buku Ilmiah'
            ],
            [
                'category' => 'Tafsir'
            ],
        ];

        foreach ($categorys as $category) {
            CategoryBook::create($category);
        }    
    }
}