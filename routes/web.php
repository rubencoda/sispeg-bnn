<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/beranda', [App\Http\Controllers\BerandaController::class, 'index'])->name('beranda');

// Change Password
Route::post('/change-password', [App\Http\Controllers\BerandaController::class, 'updatePassword'])->name('change-password');

// Data Pegawai
Route::group(['middleware' => 'role:superadmin|PENGELOLA-DATA-SUB-BAGIAN-UMUM'], function () {
    Route::get('/view-pegawai', [App\Http\Controllers\DataPegawaiController::class, 'index'])->name('view-pegawai');
    Route::get('/add-pegawai', [App\Http\Controllers\DataPegawaiController::class, 'create'])->name('add-pegawai');
    Route::post('/insert-pegawai', [App\Http\Controllers\DataPegawaiController::class, 'store'])->name('insert-pegawai');
    Route::get('/edit-pegawai/{id}', [App\Http\Controllers\DataPegawaiController::class, 'show'])->name('edit-pegawai');
    Route::put('/update-pegawai', [App\Http\Controllers\DataPegawaiController::class, 'update'])->name('update-pegawai');
    Route::get('/delete-pegawai/{id}', [App\Http\Controllers\DataPegawaiController::class, 'destroy'])->name('delete-pegawai');
    Route::get('/restore-pegawai/{id}', [App\Http\Controllers\DataPegawaiController::class, 'restore_data'])->name('restore-pegawai');
    Route::get('/pegawai-export', [App\Http\Controllers\DataPegawaiController::class, 'export'])->name('export-pegawai');
});

// Profile
Route::get('/profile-pegawai/{id}', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile-pegawai');
Route::get('/download-file/{fileurl}', [App\Http\Controllers\ProfileController::class, 'downloadfile'])->name('download-file');


// Perizinan Cuti
Route::get('/view-cuti', [App\Http\Controllers\PerizinanCutiController::class, 'index'])->name('view-cuti');
Route::get('/add-cuti', [App\Http\Controllers\PerizinanCutiController::class, 'create'])->name('add-cuti');
Route::post('/insert-cuti', [App\Http\Controllers\PerizinanCutiController::class, 'store'])->name('insert-cuti');
Route::group(['middleware' => 'role:KEPALA-SUB-BAGIAN-UMUM'], function () {
    Route::get('/first-approve/{id}', [App\Http\Controllers\PerizinanCutiController::class, 'first_approve'])->name('first-approve');
});
Route::group(['middleware' => 'role:KEPALA-BNNK-SIDOARJO'], function () {
    Route::get('/second-approve/{id}', [App\Http\Controllers\PerizinanCutiController::class, 'second_approve'])->name('second-approve');
});
Route::group(['middleware' => 'role:KEPALA-BNNK-SIDOARJO|KEPALA-SUB-BAGIAN-UMUM|superadmin'], function () {
    Route::get('/view-jenis-cuti', [App\Http\Controllers\PerizinanCutiController::class, 'jenis_cuti'])->name('view-jenis-cuti');
    Route::post('/insert-jenis-cuti', [App\Http\Controllers\PerizinanCutiController::class, 'insert_jenis_cuti'])->name('insert-jenis-cuti');
    Route::put('/update-jenis-cuti', [App\Http\Controllers\PerizinanCutiController::class, 'update_jenis_cuti'])->name('update-jenis-cuti');
    Route::get('/delete-jenis-cuti/{id}', [App\Http\Controllers\PerizinanCutiController::class, 'delete_jenis_cuti'])->name('delete-jenis-cuti');
    Route::get('/rejected-cuti/{id}', [App\Http\Controllers\PerizinanCutiController::class, 'rejected'])->name('rejected-cuti');
    Route::get('/view-skb-cuti', [App\Http\Controllers\PerizinanCutiController::class, 'index_skb_cuti'])->name('view-skb-cuti');
    Route::post('/store-skb-cuti', [App\Http\Controllers\PerizinanCutiController::class, 'store_skb_cuti'])->name('store-skb-cuti');
    Route::put('/update-skb-cuti', [App\Http\Controllers\PerizinanCutiController::class, 'update_skb_cuti'])->name('update-skb-cuti');
    Route::get('/delete-skb-cuti/{id}', [App\Http\Controllers\PerizinanCutiController::class, 'delete_skb_cuti'])->name('delete-skb-cuti');
});
Route::get('/generate-pdf', [App\Http\Controllers\PDFController::class, 'generatePDF'])->name('generate-pdf');
Route::get('/status-cuti', [App\Http\Controllers\PerizinanCutiController::class, 'status_cuti'])->name('status-cuti');
Route::group(['middleware' => 'role:KEPALA-BNNK-SIDOARJO'], function () {
    Route::get('/history-cuti', [App\Http\Controllers\PerizinanCutiController::class, 'history_cuti'])->name('history-cuti');
});

// Presensi
Route::group(['middleware' => 'role:superadmin|PENGELOLA-DATA-SUB-BAGIAN-UMUM'], function () {
    Route::get('/data-presensi', [App\Http\Controllers\PresensiController::class, 'dataView'])->name('data-presensi');
    Route::get('/presensi-export', [App\Http\Controllers\PresensiController::class, 'export'])->name('export-presensi');
});

// TTD Perizinan Cuti
Route::get('/ttd-kepalacabang', [App\Http\Controllers\PerizinanCutiController::class, 'ttd_kepalacabang'])->name('view-ttd-kepalacabang');
Route::post('/update-ttd-kepalacabang', [App\Http\Controllers\PerizinanCutiController::class, 'store_ttd_kc'])->name('update-ttd-kc');

Route::get('/ttd-kasubag', [App\Http\Controllers\PerizinanCutiController::class, 'ttd_kasubag'])->name('view-ttd-kasubag');
Route::post('/update-ttd-kasubag', [App\Http\Controllers\PerizinanCutiController::class, 'store_ttd_kasubag'])->name('update-ttd-kasubag');

Route::middleware(['auth', 'checkIpAddress'])->group(function () {
    Route::get('/view-presensi', [App\Http\Controllers\PresensiController::class, 'index'])->name('view-presensi');
    Route::get('/checkin-presensi', [App\Http\Controllers\PresensiController::class, 'check_in'])->name('checkin-presensi');
    Route::get('/checkout-presensi', [App\Http\Controllers\PresensiController::class, 'check_out'])->name('checkout-presensi');
    // Other attendance routes
});
