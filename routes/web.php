<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\Guru\GuruController;
use App\Http\Controllers\GuruPiketController;
use App\Http\Controllers\Admin\SesiController;
use App\Http\Controllers\Guru\SesiguruController;
use App\Http\Controllers\Admin\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|


*/
// halaman index awal absen

Route::get('/', [AbsensiController::class, 'absen'])->name('absen');
Route::post('/insertabsen', [AbsensiController::class, 'insertabsen'])->name('insertabsen');
// end halaman index



// guru
Route::get('/loginguru', [SesiguruController::class, 'loginguru'])->name('loginguru');
Route::post('/loginguru', [SesiguruController::class, 'logguru']);

Route::middleware(['auth.guru'])->group(function () {
    // Routes untuk masuk ke halaman guru
    Route::get('/guru', [GuruController::class, 'index'])->name('guru');
    Route::get('/logoutguru', [SesiguruController::class, 'logoutguru']);

    Route::get('/guru/absen/harian', [GuruController::class, 'absenHarianGuru'])->name('absenHarianGuru');
    Route::get('/guru/absen/mingguan', [GuruController::class, 'absenMingguanGuru'])->name('absenMingguanGuru');
    Route::get('/guru/absen/bulan-ini', [GuruController::class, 'absenBulananGuru'])->name('absensiBulanGuru');
});
//end guru



// admin
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [SesiController::class, 'login'])->name('login');
    Route::post('/login', [SesiController::class, 'log']);
});
Route::get('/home', function () {
    return redirect('/admin');
});
Route::middleware(['auth'])->group(function () {
    //Routes untuk masuk ke halaman admin
    Route::get('/admin', [EmployeeController::class, 'index'])->name('admin');
    Route::get('/admin/akses/admin', [EmployeeController::class, 'aksesAdmin'])->name('aksesAdmin');
    Route::get('/admin/akses/guru', [EmployeeController::class, 'aksesGuru'])->name('aksesGuru');
    // Rte untuk absensi harian
    Route::get('/admin/absensi/harian', [EmployeeController::class, 'absensiHari'])->name('absensi.harian');

    // Rute untuk absensi minggu ini
    Route::get('/admin/absensi/minggu-ini', [EmployeeController::class, 'absensiMingguIni'])->name('absensi.minggu_ini');

    // Rute untuk absensi bulan ini
    Route::get('/admin/absensi/bulan-ini', [EmployeeController::class, 'absensiBulanIni'])->name('absensi.bulan_ini');

    Route::get('/logout', [SesiController::class, 'logout']);



    // tentang Crud admin
    Route::get('/tambahdata/admin', [EmployeeController::class, 'tambahdataAdmin'])->name('tambahdataAdmin');
    Route::post('/insertdata/admin', [EmployeeCOntroller::class, 'insertdataAdmin'])->name('insertdataAdmin');

    Route::get('/timezone', [EmployeeController::class, 'timezone']);
    // tentang crud Guru
    // Routes untuk masuk form tambah data
    Route::get('/tambahdata', [EmployeeController::class, 'tambahdata'])->name('tambahdata');
    // Routes untuk POST masuk data ke dalam database
    Route::post('/insertdata', [EmployeeController::class, 'insertdata'])->name('insertdata');


    // Routes untuk masuk form update data
    Route::get('/tampildata/{id}', [EmployeeController::class, 'tampildata'])->name('tampildata');
    // Routes untuk POST update data
    Route::post('/updatedata/{id}', [EmployeeController::class, 'updatedata'])->name('updatedata');


    //routes Delete Data
    Route::get('/delete/{id}', [EmployeeController::class, 'deleteGuru'])->name('deleteGuru');
    // end data guru



    Route::get('/admin/{id}', [EmployeeController::class, 'tampildataAdmin'])->name('tampildataAdmin');
    Route::post('/insert/admin/{id}', [EmployeeController::class, 'updatetdataAdmin'])->name('updatetdataAdmin');

    Route::get('/delete/admin/{id}', [EmployeeController::class, 'deleteAdmin'])->name('deleteAdmin');
    // end data admin

    // export pdf
    Route::get('/exportpdf', [EmployeeController::class, 'exportpdf'])->name('exportpdf');
    Route::get('/exportpdf/mingguan', [EmployeeController::class, 'exportpdfMingguan'])->name('exportpdfMingguan');
    Route::get('/exportpdf/bulanan', [EmployeeController::class, 'exportpdfBulanan'])->name('exportBulanan');

    // export excel
    Route::get('/exportexcel', [EmployeeController::class, 'exportexcel'])->name('exportexcel');
    Route::get('/exportexcel/migguan', [EmployeeController::class, 'exportexcelMingguan'])->name('exportexcelMingguan');
    Route::get('/exportexcel/bulanan', [EmployeeController::class, 'exportexcelBulanan'])->name('exportexcelBulanan');

    // digram data absen
    Route::get('/admin/diagram/data-X', [EmployeeController::class, 'diagramDataX'])->name('diagramDataX');
    Route::get('/admin/diagram/data-XI', [EmployeeController::class, 'diagramDataXI'])->name('diagramDataXI');
    Route::get('/admin/diagram/data-XII', [EmployeeController::class, 'diagramDataXII'])->name('diagramDataXII');
    // end diagram data absen
});
// end admin