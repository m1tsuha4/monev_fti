<?php

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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class,'logout']);

Route::middleware('auth')->group(function () {

    Route::group(['prefix' => 'jurusan'], function () {
        Route::get('/', [App\Http\Controllers\UserController::class, 'jurusan_index'])->name('jurusan.home');

        Route::group(['prefix' => 'users'], function () {
             Route::get('/', [App\Http\Controllers\UserController::class, 'jurusan'])->name('jurusan.user');
             Route::get('/data', [App\Http\Controllers\UserController::class, 'jurusan_data']);
             Route::post('/create', [App\Http\Controllers\UserController::class, 'jurusan_store']);
             Route::get('/edit/{id}', [App\Http\Controllers\UserController::class, 'jurusan_edit']);
             Route::post('/update/{id}', [App\Http\Controllers\UserController::class, 'jurusan_update']);
             Route::get('/delete/{id}', [App\Http\Controllers\UserController::class, 'jurusan_delete']);
        });

        Route::group(['prefix' => 'tahun-akademik'], function () {
          Route::get('/', [App\Http\Controllers\TahunAkademikController::class, 'index'])->name('jurusan.tahun_akademik');
          Route::get('/data', [App\Http\Controllers\TahunAkademikController::class, 'data']);
          Route::post('/create', [App\Http\Controllers\TahunAkademikController::class, 'create']);
          Route::get('/edit/{id}', [App\Http\Controllers\TahunAkademikController::class, 'edit']);
          Route::post('/update/{id}', [App\Http\Controllers\TahunAkademikController::class, 'update']);
          Route::get('/delete/{id}', [App\Http\Controllers\TahunAkademikController::class, 'delete']);
     });

        Route::group(['prefix' => 'prodi'], function () {
             Route::get('/', [App\Http\Controllers\ProdiController::class, 'index'])->name('jurusan.prodi');
             Route::get('/data', [App\Http\Controllers\ProdiController::class, 'data']);
             Route::post('/create', [App\Http\Controllers\ProdiController::class, 'create']);
             Route::get('/edit/{id}', [App\Http\Controllers\ProdiController::class, 'edit']);
             Route::post('/update/{id}', [App\Http\Controllers\ProdiController::class, 'update']);
             Route::get('/delete/{id}', [App\Http\Controllers\ProdiController::class, 'delete']);
        });

        Route::group(['prefix' => 'matakuliah'], function () {
             Route::get('/', [App\Http\Controllers\MatakuliahController::class, 'index'])->name('jurusan.matakuliah');
             Route::get('/data', [App\Http\Controllers\MatakuliahController::class, 'data']);
             Route::post('/create', [App\Http\Controllers\MatakuliahController::class, 'create']);
             Route::get('/edit/{id}', [App\Http\Controllers\MatakuliahController::class, 'edit']);
             Route::post('/update/{id}', [App\Http\Controllers\MatakuliahController::class, 'update']);
             Route::get('/delete/{id}', [App\Http\Controllers\MatakuliahController::class, 'delete']);
        });

        Route::group(['prefix' => 'kategori-berkas'], function () {
             Route::get('/', [App\Http\Controllers\BerkasController::class, 'index'])->name('jurusan.kategori_berkas');
             Route::get('/data', [App\Http\Controllers\BerkasController::class, 'data']);
             Route::post('/create', [App\Http\Controllers\BerkasController::class, 'create']);
             Route::get('/edit/{id}', [App\Http\Controllers\BerkasController::class, 'edit']);
             Route::post('/update/{id}', [App\Http\Controllers\BerkasController::class, 'update']);
             Route::get('/delete/{id}', [App\Http\Controllers\BerkasController::class, 'delete']);
        });

        Route::group(['prefix' => 'kategori-penilaian'], function () {
             Route::get('/', [App\Http\Controllers\BerkasController::class, 'penilaian_index'])->name('jurusan.kategori_penilaian');
             Route::get('/data', [App\Http\Controllers\BerkasController::class, 'penilaian_data']);
             Route::post('/create', [App\Http\Controllers\BerkasController::class, 'penilaian_create']);
             Route::get('/edit/{id}', [App\Http\Controllers\BerkasController::class, 'penilaian_edit']);
             Route::post('/update/{id}', [App\Http\Controllers\BerkasController::class, 'penilaian_update']);
             Route::get('/delete/{id}', [App\Http\Controllers\BerkasController::class, 'penilaian_delete']);
        });

        Route::group(['prefix' => 'kelas-perkuliahan'], function () {
             Route::get('/', [App\Http\Controllers\KelasPerkuliahanController::class, 'index'])->name('jurusan.kelas_perkuliahan');
             Route::get('/data', [App\Http\Controllers\KelasPerkuliahanController::class, 'data']);
             Route::post('/create', [App\Http\Controllers\KelasPerkuliahanController::class, 'create']);
             Route::get('/edit/{id}', [App\Http\Controllers\KelasPerkuliahanController::class, 'edit']);
             Route::post('/update/{id}', [App\Http\Controllers\KelasPerkuliahanController::class, 'update']);
             Route::get('/delete/{id}', [App\Http\Controllers\KelasPerkuliahanController::class, 'delete']);
        });

        Route::group(['prefix' => 'monitoring'], function () {
          Route::get('/', [App\Http\Controllers\MonitoringController::class, 'jurusan_monitoring_index'])->name('jurusan.monitoring');
          Route::get('/detail/{id}', [App\Http\Controllers\MonitoringController::class, 'jurusan_monitoring_detail']);
        });

        Route::group(['prefix' => 'laporan-penilaian'], function () {
          Route::get('/', [App\Http\Controllers\MonitoringController::class, 'jurusan_penilaian_index'])->name('jurusan.penilaian');
          Route::get('/detail/{id}', [App\Http\Controllers\MonitoringController::class, 'jurusan_penilaian_detail']);
        });

    });
    //belum
    Route::group(['prefix' => 'gkm'], function () {
        Route::get('/', [App\Http\Controllers\MonitoringController::class, 'gkm_index'])->name('gkm.home');

        Route::group(['prefix' => 'monev'], function () {
          Route::get('/', [App\Http\Controllers\MonitoringController::class, 'gkm_index'])->name('gkm.monev');
          Route::get('/detail/{id}', [App\Http\Controllers\MonitoringController::class, 'gkm_detail']);
          Route::post('/update/{id}', [App\Http\Controllers\MonitoringController::class, 'gkm_update']);
        });
    });

    Route::group(['prefix' => 'dosen'], function () {
        Route::get('/', [App\Http\Controllers\UserController::class, 'dosen_index'])->name('dosen.home');

        Route::group(['prefix' => 'kelas-perkuliahan'], function () {
          Route::get('/', [App\Http\Controllers\KelasPerkuliahanController::class, 'dosen_index'])->name('dosen.kelas-perkuliahan');
          Route::get('/data', [App\Http\Controllers\KelasPerkuliahanController::class, 'dosen_data']);
          Route::get('/detail/{id}', [App\Http\Controllers\KelasPerkuliahanController::class, 'dosen_detail']);
            // belum
          Route::get('/detail/kontrak/detail/{id}', [App\Http\Controllers\BerkasController::class, 'detail_kontrak']);
          Route::get('/detail/kontrak/create/{id}', [App\Http\Controllers\BerkasController::class, 'create_kontrak']);
          Route::post('/detail/kontrak/store', [App\Http\Controllers\BerkasController::class, 'store_kontrak']);
          Route::get('/detail/kontrak/edit/{id}', [App\Http\Controllers\BerkasController::class, 'edit_kontrak']);
          Route::post('/detail/kontrak/update', [App\Http\Controllers\BerkasController::class, 'update_kontrak']);


          Route::group(['prefix' => 'berkas'], function () {
               Route::post('/create/{id}', [App\Http\Controllers\BerkasController::class, 'upload_berkas']);
               Route::get('/edit/{id}/{id1}', [App\Http\Controllers\BerkasController::class, 'edit_berkas']);
               Route::post('/update/{id}', [App\Http\Controllers\BerkasController::class, 'update_berkas']);
          });

          Route::get('/delete/{id}', [App\Http\Controllers\KelasPerkuliahanController::class, 'dosen_delete']);

          Route::group(['prefix' => 'monitoring'], function () {
               Route::get('/{id}', [App\Http\Controllers\MonitoringController::class, 'dosen_index'])->name('dosen.monitoring');
               Route::post('/create', [App\Http\Controllers\MonitoringController::class, 'dosen_create']);
          });

        });

        Route::group(['prefix' => 'monev'], function () {
          Route::get('/', [App\Http\Controllers\MonitoringController::class, 'verifikator_index'])->name('verifikator.monev');
          Route::get('/detail/{id}', [App\Http\Controllers\MonitoringController::class, 'verifikator_detail']);
          Route::post('/create', [App\Http\Controllers\MonitoringController::class, 'verifikator_create']);
          Route::post('/update', [App\Http\Controllers\MonitoringController::class, 'verifikator_update']);

          Route::get('/kontrak/detail/{id}', [App\Http\Controllers\BerkasController::class, 'verifikator_kontrak']);
        });

     });

     Route::get('/berkas/{id}/{id1}', [App\Http\Controllers\BerkasController::class, 'pdf']);
    Route::get('/berkas-dokumen/{id1}/{id3}', [App\Http\Controllers\BerkasController::class, 'pdf1']);
     Route::get('/bukti/{id}', [App\Http\Controllers\BerkasController::class, 'bukti']);

     Route::get('/kelengkapan-berkas/{id}', [App\Http\Controllers\BerkasController::class, 'kelengkapan_dokumen']);
     Route::get('/soal-uts/{id}', [App\Http\Controllers\BerkasController::class, 'soal_uts']);
     Route::get('/soal-uas/{id}', [App\Http\Controllers\BerkasController::class, 'soal_uts']);

     Route::get('/bap/{id}/{status}', [App\Http\Controllers\BerkasController::class, 'bap']);

     Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile']);
     Route::post('/profile/update', [App\Http\Controllers\UserController::class, 'profile_update']);
});
