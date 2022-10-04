<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HasilUjianController;
use App\Http\Controllers\JenjangController;
use App\Http\Controllers\ReferensiSelect2Controller;
use App\Http\Controllers\KategoriUjianController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('dashboard');
});

Route::resource('jenjang', JenjangController::class);
Route::resource('user', UserController::class);
Route::resource('hasil_ujian', HasilUjianController::class);
Route::resource('kategori_ujian', KategoriUjianController::class);
Route::resource('kecamatan', KecamatanController::class);
Route::resource('sekolah', SekolahController::class);
Route::get('hasil_ujian/detail/{id_guru}', [HasilUjianController::class,'show']);
Route::post('referensi/sekolahSelect2', [ReferensiSelect2Controller::class, 'select2sekolah']);
Route::post('referensi/jenjangSelect2', [ReferensiSelect2Controller::class, 'select2jenjang']);
Route::post('referensi/kecamatanSelect2', [ReferensiSelect2Controller::class, 'select2kecamatan']);