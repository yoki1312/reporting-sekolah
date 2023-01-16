<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\CustomLoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HasilUjianController;
use App\Http\Controllers\JenjangController;
use App\Http\Controllers\ReferensiSelect2Controller;
use App\Http\Controllers\KategoriUjianController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\UserController;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('dataLogin', function () {
    return view('login');
});

Route::get('/gt', function () {
    
    $data = DB::select("SELECT tc.id_kecamatan, ta.id_kategori_ujian, sum( jumlah_benar ) nilai, tx.total_peserta, sum( jumlah_benar ) / tx.total_peserta as rata_rata, td.nama_kecamatan FROM t_nilai_ujian ta LEFT JOIN m_user tb ON tb.id_user = ta.id_user LEFT JOIN m_sekolahan tc ON tc.id_sekolahan = tb.id_sekolah left join m_kecamatan td on td.id_kecamatan = tc.id_kecamatan left join (SELECT id_kecamatan, count( ta.id_user ) total_peserta FROM m_user ta LEFT JOIN m_sekolahan tb ON tb.id_sekolahan = ta.id_sekolah WHERE tb.id_jenjang = 1 GROUP BY tb.id_kecamatan ) tx on tx.id_kecamatan = tc.id_kecamatan WHERE tc.id_jenjang = 1 GROUP BY tc.id_kecamatan, tc.id_jenjang, ta.id_kategori_ujian");
    $data = collect($data)->groupBy(['id_kecamatan','id_kategori_ujian'])->toArray();
    $arr = array();
    $arr[] = array('Kecamatan','Pedagogik','Profesional Umum','Kepribadian','Sosial','Merdeka Belajar','PKB');
    foreach($data as $key => $val){
        $nama_kec = $val[1][0]->nama_kecamatan;
        $arr[] = array(
            $val[1][0]->rata_rata,
            $val[2][0]->rata_rata,
            $val[3][0]->rata_rata,
            $val[4][0]->rata_rata,
            $val[5][0]->rata_rata,
            $val[6][0]->rata_rata,
        );
    }
    printJSON($arr);
});
// Route::get('/getdataKS', function () {
//     $d = DB::select("SELECT
// 	id_user,
// 	`BENAR MANAJERIAL` manajerial,
// 	`BENAR PKB` pkb,
// 	`BENAR SUPERVISI`  supervisi,
// 	`BENAR KEWIRAUSAHAAN` kwu,
// 	`BENAR MERDEKA BELAJAR` merdeka 
// FROM
// 	ka_tk");
//     foreach($d as $k){
//         DB::table('t_nilai_ujian')->insert([
//             'id_user' => $k->id_user,
//             'id_kategori_ujian' => 7,
//             'jumlah_benar' => $k->manajerial,
//         ]);
//         DB::table('t_nilai_ujian')->insert([
//             'id_user' => $k->id_user,
//             'id_kategori_ujian' => 8,
//             'jumlah_benar' => $k->pkb,
//         ]);
//         DB::table('t_nilai_ujian')->insert([
//             'id_user' => $k->id_user,
//             'id_kategori_ujian' => 12,
//             'jumlah_benar' => $k->supervisi,
//         ]);
//         DB::table('t_nilai_ujian')->insert([
//             'id_user' => $k->id_user,
//             'id_kategori_ujian' => 10,
//             'jumlah_benar' => $k->kwu,
//         ]);
//         DB::table('t_nilai_ujian')->insert([
//             'id_user' => $k->id_user,
//             'id_kategori_ujian' => 11,
//             'jumlah_benar' => $k->merdeka,
//         ]);
       
//     }
// });
// Route::get('/getdata', function () {
//     $d = DB::select("select id_user,  pedagogik, umum, kepribadian, sosial, merdeka, pkb from smp ");
//     foreach($d as $k){
//         DB::table('t_nilai_ujian')->insert([
//             'id_user' => $k->id_user,
//             'id_kategori_ujian' => 1,
//             'jumlah_benar' => $k->pedagogik,
//         ]);
//         DB::table('t_nilai_ujian')->insert([
//             'id_user' => $k->id_user,
//             'id_kategori_ujian' => 2,
//             'jumlah_benar' => $k->umum,
//         ]);
//         DB::table('t_nilai_ujian')->insert([
//             'id_user' => $k->id_user,
//             'id_kategori_ujian' => 3,
//             'jumlah_benar' => $k->kepribadian,
//         ]);
//         DB::table('t_nilai_ujian')->insert([
//             'id_user' => $k->id_user,
//             'id_kategori_ujian' => 4,
//             'jumlah_benar' => $k->sosial,
//         ]);
//         DB::table('t_nilai_ujian')->insert([
//             'id_user' => $k->id_user,
//             'id_kategori_ujian' => 5,
//             'jumlah_benar' => $k->merdeka,
//         ]);
//         DB::table('t_nilai_ujian')->insert([
//             'id_user' => $k->id_user,
//             'id_kategori_ujian' => 6,
//             'jumlah_benar' => $k->pkb,
//         ]);
//         // dd($k);
//     }
// });
Route::get('/dashboard-data', function () {
        return view('dashboard');
    });
Route::get('/dashboard-statistik', function () {
        return view('statistik');
    });
Route::middleware(['auth'])->group(function () {
    Route::get('/statistik', function () {
        return view('statistik');
    });
    Route::get('/', function () {
        return view('dashboard');
    });
    Route::resource('jenjang', JenjangController::class);
    Route::resource('user', UserController::class);
    Route::resource('absensi_kehadiran', AbsensiController::class);
    Route::resource('hasil_ujian', HasilUjianController::class);
    Route::post('exportPdf/hasil_ujian', [HasilUjianController::class,'hasil_ujianExportPdf']);
    Route::resource('kategori_ujian', KategoriUjianController::class);
    Route::resource('kecamatan', KecamatanController::class);
    Route::resource('sekolah', SekolahController::class);
    Route::get('hasil_ujian/detail/{id_guru}', [HasilUjianController::class,'show']);
    Route::get('resetPassword/{id_sekolahan}', [SekolahController::class,'resetPassword']);
    Route::post('gantiPassword', [SekolahController::class,'gantiPassword']);
    Route::get('hasil_ujian_pdf_detail/detail/{id_guru}', [HasilUjianController::class,'hasil_ujian_pdf_detail']);
    
});
Route::post('dashboard/jumlah_peserta', [DashboardController::class,'jumlah_peserta']);
Route::post('dashboard/jumlah_peserta_absen', [DashboardController::class,'jumlah_peserta_absen']);
Route::post('dashboard/jumlah_sekolah', [DashboardController::class,'jumlah_sekolah']);
Route::post('dashboard/rata_rata_nilai', [DashboardController::class,'rata_rata_nilai']);
Route::get('dashboard/hasil_ujian', [DashboardController::class,'hasil_ujian']);
Route::get('dashboard/hasil_ujian_rata2', [DashboardController::class,'hasil_ujian_rata2']);
Route::get('dashboard/hasil_ujian_guru', [DashboardController::class,'hasil_ujian_guru']);
Route::post('referensi/sekolahSelect2', [ReferensiSelect2Controller::class, 'select2sekolah']);
Route::post('referensi/jenjangSelect2', [ReferensiSelect2Controller::class, 'select2jenjang']);
Route::post('referensi/kecamatanSelect2', [ReferensiSelect2Controller::class, 'select2kecamatan']);
Route::post('referensi/bidangSelect2', [ReferensiSelect2Controller::class, 'select2bidang']);

Route::post('login/auth', [CustomLoginController::class, 'postLogin']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', function () {
    Session::flush();
    Auth::logout();
    return redirect('/');
})->name('logout');
Auth::routes();
