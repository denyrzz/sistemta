<?php

use App\Models\Mahasiswa;
use App\Models\MhsSempro;
use App\Models\PengajuanPkl;
use App\Models\JabatanPimpinan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MhsTaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\MhsPklController;
use App\Http\Controllers\SemproController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\NilaiPklController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\SidangTaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MhsSemproController;
use App\Http\Controllers\SidangPklController;
use App\Http\Controllers\TempatPklController;
use App\Http\Controllers\UsulanPklController;
use App\Http\Controllers\MhsLogbookController;
use App\Http\Controllers\BimbinganTAController;
use App\Http\Controllers\NilaiSemproController;
use App\Http\Controllers\MhsBimbinganController;
use App\Http\Controllers\VerifikasiTAController;
use App\Http\Controllers\KaprodiSemproController;
use App\Http\Controllers\NilaiSidangTaController;
use App\Http\Controllers\VerifikasiPKLController;
use App\Http\Controllers\NilaiSidangPklController;
use App\Http\Controllers\DosenPembimbingController;
use App\Http\Controllers\JabatanPimpinanController;
use App\Http\Controllers\VerifikasiSemproController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/logout', [Controller::class, 'destroyUser'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('permissions', App\Http\Controllers\PermissionController::class);
Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

Route::resource('roles', App\Http\Controllers\RoleController::class);
Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::resource('users', App\Http\Controllers\UserController::class)->except(['show']);
Route::get('users/createMhs', [App\Http\Controllers\UserController::class, 'createMhs'])->name('users.createMhs');;
Route::post('users/storeMhs', [App\Http\Controllers\UserController::class, 'storeMhs'])->name('users.storeMhs');
Route::get('users/createDsn', [App\Http\Controllers\UserController::class, 'createDsn'])->name('users.createDsn');;
Route::post('users/storeDsn', [App\Http\Controllers\UserController::class, 'storeDsn'])->name('users.storeDsn');;


Route::middleware(['auth'])->group(function () {
    // Jurusan Routes
    Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
    Route::get('/jurusan/create', [JurusanController::class, 'create'])->name('jurusan.create');
    Route::post('/jurusan', [JurusanController::class, 'store'])->name('jurusan.store');
    Route::get('/jurusan/{id}/edit', [JurusanController::class, 'edit'])->name('jurusan.edit');
    Route::put('/jurusan/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
    Route::delete('/jurusan/{id}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');

    // Prodi Routes
    Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi.index');
    Route::get('/prodi/create', [ProdiController::class, 'create'])->name('prodi.create');
    Route::post('/prodi', [ProdiController::class, 'store'])->name('prodi.store');
    Route::get('/prodi/{id}/edit', [ProdiController::class, 'edit'])->name('prodi.edit');
    Route::put('/prodi/{id}', [ProdiController::class, 'update'])->name('prodi.update');
    Route::delete('/prodi/{id}', [ProdiController::class, 'destroy'])->name('prodi.destroy');

    // Dosen Routes
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
    Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
    Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
    Route::get('/dosen/{id}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
    Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');
    Route::delete('/dosen/{id}', [DosenController::class, 'destroy'])->name('dosen.destroy');
    Route::get('/dosen/export', [DosenController::class, 'export'])->name('dosen.export');
    Route::post('/dosen/import', [DosenController::class, 'import'])->name('dosen.import');
    Route::get('/dosen/{id}', [DosenController::class, 'show'])->name('dosen.show');


    // Ruangan Routes
    Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan.index');
    Route::get('/ruangan/create', [RuanganController::class, 'create'])->name('ruangan.create');
    Route::post('/ruangan', [RuanganController::class, 'store'])->name('ruangan.store');
    Route::get('/ruangan/{id}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');
    Route::put('/ruangan/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
    Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');

    // Mahasiswa Routes
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
    Route::get('/mahasiswa/export', [MahasiswaController::class, 'export'])->name('mahasiswa.export');
    Route::post('/mahasiswa/import', [MahasiswaController::class, 'import'])->name('mahasiswa.import');

    // Jabatan Pimpinan Routes
    Route::get('/jabatan_pimpinan', [JabatanPimpinanController::class, 'index'])->name('jabatan_pimpinan.index');
    Route::get('/jabatan_pimpinan/create', [JabatanPimpinanController::class, 'create'])->name('jabatan_pimpinan.create');
    Route::post('/jabatan_pimpinan', [JabatanPimpinanController::class, 'store'])->name('jabatan_pimpinan.store');
    Route::get('/jabatan_pimpinan/{id}/edit', [JabatanPimpinanController::class, 'edit'])->name('jabatan_pimpinan.edit');
    Route::put('/jabatan_pimpinan/{id}', [JabatanPimpinanController::class, 'update'])->name('jabatan_pimpinan.update');
    Route::delete('/jabatan_pimpinan/{id}', [JabatanPimpinanController::class, 'destroy'])->name('jabatan_pimpinan.destroy');

    // Pimpinan Routes
    Route::get('/pimpinan', [PimpinanController::class, 'index'])->name('pimpinan.index');
    Route::get('/pimpinan/create', [PimpinanController::class, 'create'])->name('pimpinan.create');
    Route::post('/pimpinan', [PimpinanController::class, 'store'])->name('pimpinan.store');
    Route::get('/pimpinan/{id}/edit', [PimpinanController::class, 'edit'])->name('pimpinan.edit');
    Route::put('/pimpinan/{id}', [PimpinanController::class, 'update'])->name('pimpinan.update');
    Route::delete('/pimpinan/{id}', [PimpinanController::class, 'destroy'])->name('pimpinan.destroy');

    // Sesi Routes
    Route::get('/sesi', [SesiController::class, 'index'])->name('sesi.index');
    Route::get('/sesi/create', [SesiController::class, 'create'])->name('sesi.create');
    Route::post('/sesi', [SesiController::class, 'store'])->name('sesi.store');
    Route::get('/sesi/{id}/edit', [SesiController::class, 'edit'])->name('sesi.edit');
    Route::put('/sesi/{id}', [SesiController::class, 'update'])->name('sesi.update');
    Route::delete('/sesi/{id}', [SesiController::class, 'destroy'])->name('sesi.destroy');

    // Tempat PKL Routes
    Route::get('/tempat_pkl', [TempatPklController::class, 'index'])->name('tempat_pkl.index');
    Route::get('/tempat_pkl/create', [TempatPklController::class, 'create'])->name('tempat_pkl.create');
    Route::post('/tempat_pkl', [TempatPklController::class, 'store'])->name('tempat_pkl.store');
    Route::get('/tempat_pkl/{id}/edit', [TempatPklController::class, 'edit'])->name('tempat_pkl.edit');
    Route::put('/tempat_pkl/{id}', [TempatPklController::class, 'update'])->name('tempat_pkl.update');
    Route::delete('/tempat_pkl/{id}', [TempatPklController::class, 'destroy'])->name('tempat_pkl.destroy');

    Route::get('/usulan_pkl', [UsulanPklController::class, 'index'])->name('usulan_pkl.index');
    Route::post('/usulan_pkl/store', [UsulanPklController::class, 'store'])->name('usulan_pkl.store');
    Route::delete('/usulan_pkl/{id}', [UsulanPklController::class, 'destroy'])->name('usulan_pkl.destroy');
    Route::get('/usulan_pkl/{id}/edit', [UsulanPklController::class, 'edit'])->name('usulan_pkl.edit');
    Route::put('/usulan_pkl/{id}', [UsulanPklController::class, 'update'])->name('usulan_pkl.update');
    Route::get('/usulan_pkl/kaprodi', [UsulanPklController::class, 'indexprodi'])->name('usulan_pkl.indexprodi');
    Route::put('/usulan_pkl/update/kaprodi', [UsulanPklController::class, 'updateDospem'])->name('usulan_pkl.updateDospem');
    Route::post('/usulan_pkl/{id}/confirm', [UsulanPklController::class, 'confirm'])->name('usulan_pkl.confirm');

    Route::get('/mhs_pkl', [MhsPklController::class, 'index'])->name('mhs_pkl.index');
    Route::put('mhs_pkl/update/{id}', [MhsPklController::class, 'update'])->name('mhs_pkl.update');
    Route::get('mhs_pkl/edit/{id}', [MhsPklController::class, 'edit'])->name('mhs_pkl.edit');

    Route::get('mhs/logbook', [MhsLogbookController::class, 'index'])->name('mhs_logbook.index');
    Route::post('mhs/logbook', [MhsLogbookController::class, 'store'])->name('mhs_logbook.store');
    Route::get('/mhs/logbook/create', [MhsLogbookController::class, 'create'])->name('mhs_logbook.create');

    Route::get('dosenpembimbing', [DosenPembimbingController::class, 'index'])->name('dosen.pembimbing.index');
    Route::get('logbook/pkl/{mhs_pkl_id}', [DosenPembimbingController::class, 'showLogbook'])->name('dosen.pembimbing.showLogbook');
    Route::put('dosenpembimbing/{logbookId}/validasi', [DosenPembimbingController::class, 'updateValidasi'])->name('dosenpembimbing.updateValidasi');
    Route::put('dosenpembimbing/updatePenilaian/{id}', [DosenPembimbingController::class, 'updatePenilaian'])->name('dosen.pembimbing.updatePenilaian');

    Route::get('verif_berkas_pkl', [VerifikasiPKLController::class, 'index'])->name('verif_berkas.index');
    Route::patch('verif_berkas/{id_pkl}/verifikasi', [VerifikasiPKLController::class, 'verifikasi'])->name('verif_berkas.verifikasi');
    Route::get('verif_berkas/{id_pkl}/edit', [VerifikasiPKLController::class, 'edit'])->name('verif_berkas.edit');
    Route::patch('/verif_berkas/update/{id_pkl}', [VerifikasiPKLController::class, 'update'])->name('verif_berkas.update');

    Route::get('/sidang_pkl', [SidangPklController::class, 'index'])->name('sidang_pkl.index');
    Route::put('/sidang_pkl/update/{id_pkl}', [SidangPklController::class, 'update'])->name('sidang_pkl.update');
    Route::get('/surat_tugas/{id}', [SidangPklController::class, 'generatePDF'])->name('surat_tugas_pkl.generatePDF');

    Route::get('/nilai_sidang_pkl', [NilaiSidangPklController::class, 'index'])->name('nilai_sidang_pkl.index');
    Route::put('/nilai_sidang_pkl/update/{id_pkl}', [NilaiSidangPklController::class, 'update'])->name('nilai_sidang_pkl.update');
    Route::post('/nilai-sidang-pkl/{id}', [NilaiSidangPklController::class, 'store'])->name('nilai_sidang_pkl.store');

    Route::get('/mhs_sempro', [MhsSemproController::class, 'index'])->name('mhs_sempro.index');
    Route::post('/mhs_sempro/store', [MhsSemproController::class, 'store'])->name('mhs_sempro.store');
    Route::put('/mhs_sempro/update/{id}', [MhsSemproController::class, 'update'])->name('mhs_sempro.update');
    Route::get('/mhs_sempro/edit/{id}', [MhsSemproController::class, 'edit'])->name('mhs_sempro.edit');
    Route::delete('/mhs_sempro/{id}', [MhsSemproController::class, 'destroy'])->name('mhs_sempro.destroy');

    Route::get('/kaprodi/pengajuan_sempro', [KaprodiSemproController::class, 'index'])->name('pengajuan_sempro.index');
    Route::put('/kaprodi_sempro/{id}/verify', [KaprodiSemproController::class, 'verify'])->name('kaprodi_sempro.verify');

    Route::get('/kaprodi/sempro', [SemproController::class, 'index'])->name('sempro.index');
    Route::put('/kaprodi/sempro/store/{id}', [SemproController::class, 'store'])->name('sempro.store');
    Route::put('/kaprodi/sempro/update/{id}', [SemproController::class, 'update'])->name('sempro.update');
    Route::get('/kaprodi/surat_tugas/{id}', [SemproController::class, 'generatePDF'])->name('surat_tugas_sempro.generatePDF');

    Route::get('verif_berkas_sempro', [VerifikasiSemproController::class, 'index'])->name('verif_berkas_sempro.index');
    Route::patch('verif_berkas_sempro/{id_sempro}/verifikasi', [VerifikasiSemproController::class, 'verifikasi'])->name('verif_berkas_sempro.verifikasi');
    Route::get('verif_berkas_sempro/{id_sempro}/edit', [VerifikasiSemproController::class, 'edit'])->name('verif_berkas_sempro.edit');
    Route::patch('/verif_berkas_sempro/update/{id_sempro}', [VerifikasiSemproController::class, 'update'])->name('verif_berkas_sempro.update');

    Route::get('/nilai_sempro', [NilaiSemproController::class, 'index'])->name('nilai_sempro.index');
    Route::put('/nilai_sempro/update/{id_sempro}', [NilaiSemproController::class, 'update'])->name('nilai_sempro.update');
    Route::post('/nilai_sempro/{id}', [NilaiSemproController::class, 'store'])->name('nilai_sempro.store');

    Route::get('/mhs_ta', [MhsTaController::class, 'index'])->name('mhs_ta.index');
    Route::post('/mhs_ta/store', [MhsTaController::class, 'store'])->name('mhs_ta.store');
    Route::put('/mhs_ta/update/{id}', [MhsTaController::class, 'update'])->name('mhs_ta.update');
    Route::get('/mhs_ta/edit/{id}', [MhsTaController::class, 'edit'])->name('mhs_ta.edit');
    Route::delete('/mhs_ta/{id}', [MhsTaController::class, 'destroy'])->name('mhs_ta.destroy');

    Route::get('verif_berkas_ta', [VerifikasiTAController::class, 'index'])->name('verif_berkas_ta.index');
    Route::patch('verif_berkas_ta/{id_ta}/verifikasi', [VerifikasiTAController::class, 'verifikasi'])->name('verif_berkas_ta.verifikasi');
    Route::get('verif_berkas_ta/{id_ta}/edit', [VerifikasiTAController::class, 'edit'])->name('verif_berkas_ta.edit');
    Route::patch('/verif_berkas_ta/update/{id_ta}', [VerifikasiTAController::class, 'update'])->name('verif_berkas_ta.update');

    Route::get('mhs/bimbingan', [MhsBimbinganController::class, 'index'])->name('mhs_bimbingan.index');
    Route::post('mhs/bimbingan', [MhsBimbinganController::class, 'store'])->name('mhs_bimbingan.store');
    Route::get('/mhs/bimbingan/create', [MhsBimbinganController::class, 'create'])->name('mhs_bimbingan.create');

    Route::get('/sidang_ta', [SidangTaController::class, 'index'])->name('sidang_ta.index');
    Route::put('/sidang_ta/update/{id_ta}', [SidangTaController::class, 'update'])->name('sidang_ta.update');
    Route::get('/surat_tugas/{id}', [SidangTaController::class, 'generatePDF'])->name('surat_tugas_ta.generatePDF');
    Route::put('/sidang-ta/{id}', [SidangTaController::class, 'store'])->name('sidang_ta.store');

    Route::get('/nilai_ta', [NilaiSidangTaController::class, 'index'])->name('nilai_ta.index');
    Route::post('/nilai_ta/{id}', [NilaiSidangTaController::class, 'store'])->name('nilai_ta.store');
    Route::put('/nilai_ta/update/{id}', [NilaiSidangTaController::class, 'update'])->name('nilai_ta.update');

    Route::get('/bimbingan-ta', [BimbinganTAController::class, 'index'])->name('dosen.bimbingan.index');
    Route::get('/bimbingan-ta/{sempro_id}', [BimbinganTAController::class, 'showBimbingan'])->name('dosen.bimbingan.show');
    Route::post('/bimbingan-ta/{bimbinganId}/update', [BimbinganTAController::class, 'updateValidasi'])->name('dosen.bimbingan.update');
});
require __DIR__ . '/auth.php';
