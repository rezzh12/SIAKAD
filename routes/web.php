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
Route::get('admin/home',
    [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home')->middleware('is_admin');
Route::get('admin/data_siswa',
    [App\Http\Controllers\AdminController::class, 'data_siswa'])->name('admin.siswa')->middleware('is_admin');
Route::post('admin/data_siswa', 
    [App\Http\Controllers\AdminController::class, 'submit_siswa'])->name('admin.siswa.submit')->middleware('is_admin');
Route::patch('admin/data_siswa/update', 
    [App\Http\Controllers\AdminController::class, 'update_siswa'])->name('admin.siswa.update')->middleware('is_admin');
Route::post('admin/data_siswa/delete/{id}',
    [App\Http\Controllers\AdminController::class, 'delete_siswa'])->name('admin.siswa.delete')->middleware('is_admin');
Route::get('admin/ajaxadmin/dataSiswa/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataSiswa']);
Route::post('admin/data_siswa/import', 
    [App\Http\Controllers\AdminController::class, 'importSiswa'])->name('admin.siswa.import')->middleware('is_admin');

    Route::get('admin/jurusan',
        [App\Http\Controllers\AdminController::class, 'jurusan'])->name('admin.jurusan')->middleware('is_admin');
    Route::post('admin/jurusan', 
        [App\Http\Controllers\AdminController::class, 'submit_jurusan'])->name('admin.jurusan.submit')->middleware('is_admin');
    Route::patch('admin/jurusan/update', 
        [App\Http\Controllers\AdminController::class, 'update_jurusan'])->name('admin.jurusan.update')->middleware('is_admin');
    Route::get('admin/ajaxadmin/dataJurusan/{id}', 
        [App\Http\Controllers\AdminController::class, 'getDataJurusan']);
    Route::post('admin/jurusan/delete/{id}',
        [App\Http\Controllers\AdminController::class, 'delete_jurusan'])->name('admin.jurusan.delete')->middleware('is_admin');

Route::get('admin/tingkatan',
    [App\Http\Controllers\AdminController::class, 'tingkatan'])->name('admin.tingkatan')->middleware('is_admin');
Route::post('admin/tingkatan', 
    [App\Http\Controllers\AdminController::class, 'submit_tingkatan'])->name('admin.tingkatan.submit')->middleware('is_admin');
Route::patch('admin/tingkatan/update', 
    [App\Http\Controllers\AdminController::class, 'update_tingkatan'])->name('admin.tingkatan.update')->middleware('is_admin');
Route::get('admin/ajaxadmin/dataTingkatan/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataTingkatan']);
Route::post('admin/tingkatan/delete/{id}',
    [App\Http\Controllers\AdminController::class, 'delete_tingkatan'])->name('admin.tingkatan.delete')->middleware('is_admin');

    Route::get('admin/kelas',
        [App\Http\Controllers\AdminController::class, 'kelas'])->name('admin.kelas.tingkatan.jurusan')->middleware('is_admin');
    Route::post('admin/kelas', 
        [App\Http\Controllers\AdminController::class, 'submit_kelas'])->name('admin.kelas.submit')->middleware('is_admin');
    Route::patch('admin/kelas/update', 
        [App\Http\Controllers\AdminController::class, 'update_kelas'])->name('admin.kelas.update')->middleware('is_admin');
    Route::get('admin/ajaxadmin/dataKelas/{id}', 
        [App\Http\Controllers\AdminController::class, 'getDataKelas']);
    Route::post('admin/kelas/delete/{id}',
        [App\Http\Controllers\AdminController::class, 'delete_kelas'])->name('admin.kelas.delete')->middleware('is_admin');

Route::get('admin/ruangan',
    [App\Http\Controllers\AdminController::class, 'ruangan'])->name('admin.ruangan')->middleware('is_admin');
Route::post('admin/ruangan', 
    [App\Http\Controllers\AdminController::class, 'submit_ruangan'])->name('admin.ruangan.submit')->middleware('is_admin');
Route::patch('admin/ruangan/update', 
    [App\Http\Controllers\AdminController::class, 'update_ruangan'])->name('admin.ruangan.update')->middleware('is_admin');
Route::get('admin/ajaxadmin/dataRuangan/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataRuangan']);
Route::post('admin/ruangan/delete/{id}',
    [App\Http\Controllers\AdminController::class, 'delete_ruangan'])->name('admin.ruangan.delete')->middleware('is_admin');

    Route::get('admin/mapel',
        [App\Http\Controllers\AdminController::class, 'mapel'])->name('admin.mapel')->middleware('is_admin');
    Route::post('admin/mapel', 
        [App\Http\Controllers\AdminController::class, 'submit_mapel'])->name('admin.mapel.submit')->middleware('is_admin');
    Route::patch('admin/mapel/update', 
        [App\Http\Controllers\AdminController::class, 'update_mapel'])->name('admin.mapel.update')->middleware('is_admin');
    Route::get('admin/ajaxadmin/dataMapel/{id}', 
        [App\Http\Controllers\AdminController::class, 'getDataMapel']);
    Route::post('admin/mapel/delete/{id}',
        [App\Http\Controllers\AdminController::class, 'delete_mapel'])->name('admin.mapel.delete')->middleware('is_admin');

Route::get('admin/akademik',
    [App\Http\Controllers\AdminController::class, 'akademik'])->name('admin.akademik')->middleware('is_admin');
Route::post('admin/akademik', 
    [App\Http\Controllers\AdminController::class, 'submit_akademik'])->name('admin.akademik.submit')->middleware('is_admin');
Route::patch('admin/akademik/update', 
    [App\Http\Controllers\AdminController::class, 'update_akademik'])->name('admin.akademik.update')->middleware('is_admin');
Route::get('admin/ajaxadmin/dataAkademik/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataAkademik']);
Route::post('admin/akademik/delete/{id}',
    [App\Http\Controllers\AdminController::class, 'delete_akademik'])->name('admin.akademik.delete')->middleware('is_admin');

    Route::get('admin/kurikulum',
        [App\Http\Controllers\AdminController::class, 'kurikulum'])->name('admin.kurikulum')->middleware('is_admin');
    Route::post('admin/kurikulum', 
        [App\Http\Controllers\AdminController::class, 'submit_kurikulum'])->name('admin.kurikulum.submit')->middleware('is_admin');
    Route::patch('admin/kurikulum/update', 
        [App\Http\Controllers\AdminController::class, 'update_kurikulum'])->name('admin.kurikulum.update')->middleware('is_admin');
    Route::get('admin/ajaxadmin/dataKurikulum/{id}', 
        [App\Http\Controllers\AdminController::class, 'getDataKurikulum']);
    Route::post('admin/kurikulum/delete/{id}',
        [App\Http\Controllers\AdminController::class, 'delete_kurikulum'])->name('admin.kurikulum.delete')->middleware('is_admin');

Route::get('admin/data_guru',
    [App\Http\Controllers\AdminController::class, 'data_guru'])->name('admin.guru')->middleware('is_admin');
Route::post('admin/data_guru', 
    [App\Http\Controllers\AdminController::class, 'submit_guru'])->name('admin.guru.submit')->middleware('is_admin');
Route::patch('admin/data_guru/update', 
    [App\Http\Controllers\AdminController::class, 'update_guru'])->name('admin.guru.update')->middleware('is_admin');
Route::post('admin/data_guru/delete/{id}',
    [App\Http\Controllers\AdminController::class, 'delete_guru'])->name('admin.guru.delete')->middleware('is_admin');
Route::get('admin/ajaxadmin/dataGuru/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataGuru']);
Route::post('admin/data_guru/import', 
    [App\Http\Controllers\AdminController::class, 'importGuru'])->name('admin.guru.import')->middleware('is_admin');

    Route::get('admin/jadwal',
        [App\Http\Controllers\AdminController::class, 'jadwal'])->name('admin.jadwal')->middleware('is_admin');
    Route::post('admin/jadwal', 
        [App\Http\Controllers\AdminController::class, 'submit_jadwal'])->name('admin.jadwal.submit')->middleware('is_admin');
    Route::patch('admin/jadwal/update', 
        [App\Http\Controllers\AdminController::class, 'update_jadwal'])->name('admin.jadwal.update')->middleware('is_admin');
    Route::get('admin/ajaxadmin/dataJadwal/{id}', 
        [App\Http\Controllers\AdminController::class, 'getDataJadwal']);
    Route::post('admin/jadwal/delete/{id}',
        [App\Http\Controllers\AdminController::class, 'delete_jadwal'])->name('admin.jadwal.delete')->middleware('is_admin');


Route::get('admin/walikelas',
    [App\Http\Controllers\AdminController::class, 'walikelas'])->name('admin.walikelas')->middleware('is_admin');
Route::post('admin/walikelas', 
    [App\Http\Controllers\AdminController::class, 'submit_walikelas'])->name('admin.walikelas.submit')->middleware('is_admin');
Route::patch('admin/walikelas/update', 
    [App\Http\Controllers\AdminController::class, 'update_walikelas'])->name('admin.walikelas.update')->middleware('is_admin');
Route::get('admin/ajaxadmin/dataWalikelas/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataWalikelas']);
Route::post('admin/walikelas/delete/{id}',
    [App\Http\Controllers\AdminController::class, 'delete_walikelas'])->name('admin.walikelas.delete')->middleware('is_admin');

    Route::get('admin/nilai_siswa',
        [App\Http\Controllers\AdminController::class, 'nilai_siswa'])->name('admin.nilai')->middleware('is_admin');
    Route::post('admin/nilai_siswa', 
        [App\Http\Controllers\AdminController::class, 'submit_nilai'])->name('admin.nilai.submit')->middleware('is_admin');
    Route::patch('admin/nilai_siswa/update', 
        [App\Http\Controllers\AdminController::class, 'update_nilai'])->name('admin.nilai.update')->middleware('is_admin');
    Route::get('admin/ajaxadmin/dataNilai/{id}', 
        [App\Http\Controllers\AdminController::class, 'getDataNilai']);
    Route::post('admin/nilai_siswa/delete/{id}',
        [App\Http\Controllers\AdminController::class, 'delete_nilai'])->name('admin.nilai.delete')->middleware('is_admin');

Route::get('admin/riwayat_nilai/{id}',
    [App\Http\Controllers\AdminController::class, 'riwayat_nilai'])->name('admin.riwayat')->middleware('is_admin');
Route::post('admin/riwayat_nilai', 
    [App\Http\Controllers\AdminController::class, 'submit_riwayat'])->name('admin.riwayat.submit')->middleware('is_admin');
Route::patch('admin/riwayat_nilai/update', 
    [App\Http\Controllers\AdminController::class, 'update_riwayat'])->name('admin.riwayat.update')->middleware('is_admin');
Route::get('admin/ajaxadmin/dataRiwayat/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataRiwayat']);
Route::post('admin/riwayat_nilai/delete/{id}',
    [App\Http\Controllers\AdminController::class, 'delete_riwayat'])->name('admin.riwayat.delete')->middleware('is_admin');
Route::get('admin/riwayat_nilai/tampil/{id}',
    [App\Http\Controllers\AdminController::class, 'all_nilai'])->name('admin.tampil')->middleware('is_admin');

Route::get('admin/data_user',
    [App\Http\Controllers\AdminController::class, 'data_user'])->name('admin.pengguna')->middleware('is_admin');
Route::post('admin/data_user', 
    [App\Http\Controllers\AdminController::class, 'submit_user'])->name('admin.pengguna.submit')->middleware('is_admin');
Route::patch('admin/data_user/update', 
    [App\Http\Controllers\AdminController::class, 'update_user'])->name('admin.pengguna.update')->middleware('is_admin');
Route::post('admin/data_user/delete/{id}',
    [App\Http\Controllers\AdminController::class, 'delete_user'])->name('admin.pengguna.delete')->middleware('is_admin');
Route::get('admin/ajaxadmin/dataUser/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataUser']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('user.home');

Auth::routes();
Route::get('siswa/home',
    [App\Http\Controllers\SiswaController::class, 'index'])->name('siswa.home')->middleware('is_siswa');
Route::get('siswa/jadwal',
    [App\Http\Controllers\SiswaController::class, 'jadwal'])->name('siswa.jadwal')->middleware('is_siswa');
Route::get('siswa/nilai',
    [App\Http\Controllers\SiswaController::class, 'nilai'])->name('siswa.nilai')->middleware('is_siswa');

Auth::routes();
Route::get('walikelas/home',
    [App\Http\Controllers\WalikelasController::class, 'index'])->name('walikelas.home')->middleware('is_walikelas');
Route::get('walikelas/jadwal',
    [App\Http\Controllers\WalikelasController::class, 'jadwal'])->name('walikelas.jadwal')->middleware('is_walikelas');
Route::get('walikelas/nilai',
    [App\Http\Controllers\WalikelasController::class, 'nilai'])->name('walikelas.nilai')->middleware('is_walikelas');
Route::get('walikelas/riwayat_nilai/{id}',
    [App\Http\Controllers\WalikelasController::class, 'riwayat_nilai'])->name('walikelas.riwayat')->middleware('is_walikelas');
Route::post('walikelas/riwayat_nilai', 
    [App\Http\Controllers\WalikelasController::class, 'submit_riwayat'])->name('walikelas.riwayat.submit')->middleware('is_walikelas');
Route::patch('walikelas/riwayat_nilai/update', 
    [App\Http\Controllers\WalikelasController::class, 'update_riwayat'])->name('walikelas.riwayat.update')->middleware('is_walikelas');
    Route::post('walikelas/riwayat_nilai/delete/{id}',
    [App\Http\Controllers\WalikelasController::class, 'delete_riwayat'])->name('walikelas.riwayat.delete')->middleware('is_walikelas');
Route::get('walikelas/ajaxadmin/dataRiwayat/{id}', 
    [App\Http\Controllers\WalikelasController::class, 'getDataRiwayat']);
Route::get('walikelas/laporan',
    [App\Http\Controllers\WalikelasController::class, 'laporan'])->name('walikelas.laporan')->middleware('is_walikelas');
Route::get('walikelas/print/{id}',
    [App\Http\Controllers\WalikelasController::class, 'print'])->name('walikelas.laporan.print')->middleware('is_walikelas');

    Auth::routes();
    Route::get('guru/home',
        [App\Http\Controllers\GuruController::class, 'index'])->name('guru.home')->middleware('is_guru');
    Route::get('guru/jadwal',
        [App\Http\Controllers\GuruController::class, 'jadwal'])->name('guru.jadwal')->middleware('is_guru');
    Route::get('guru/nilai',
        [App\Http\Controllers\GuruController::class, 'nilai'])->name('guru.nilai')->middleware('is_guru');
    Route::get('guru/riwayat_nilai/{id}',
        [App\Http\Controllers\GuruController::class, 'riwayat_nilai'])->name('guru.riwayat')->middleware('is_guru');
    Route::post('guru/riwayat_nilai', 
        [App\Http\Controllers\GuruController::class, 'submit_riwayat'])->name('guru.riwayat.submit')->middleware('is_guru');
    Route::patch('guru/riwayat_nilai/update', 
        [App\Http\Controllers\GuruController::class, 'update_riwayat'])->name('guru.riwayat.update')->middleware('is_guru');
        Route::post('guru/riwayat_nilai/delete/{id}',
        [App\Http\Controllers\GuruController::class, 'delete_riwayat'])->name('guru.riwayat.delete')->middleware('is_guru');
    Route::get('guru/ajaxadmin/dataRiwayat/{id}', 
        [App\Http\Controllers\GuruController::class, 'getDataRiwayat']);
