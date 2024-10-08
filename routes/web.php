<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\JabatanPimpinanController;
use App\Http\Controllers\PimpinanController;
use App\Models\JabatanPimpinan;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan');
    Route::post('/jurusan', [JurusanController::class, 'store']);
    Route::get('/jurusan/edit/{id}', [JurusanController::class, 'edit'])->name('jurusan.edit');
    Route::post('/jurusan/update/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
    Route::get('/jurusan/create', [JurusanController::class, 'create'])->name('jurusan.create');
    Route::delete('/jurusan/{id}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi');
    Route::post('/prodi', [ProdiController::class, 'store']);
    Route::get('/prodi/edit/{id}', [ProdiController::class, 'edit'])->name('prodi.edit');
    Route::post('/prodi/update/{id}', [ProdiController::class, 'update'])->name('prodi.update');
    Route::get('/prodi/create', [ProdiController::class, 'create'])->name('prodi.create');
    Route::delete('/prodi/{id}', [ProdiController::class, 'destroy'])->name('prodi.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen');
    Route::post('/dosen', [DosenController::class, 'store']);
    Route::get('/dosen/edit/{id}', [DosenController::class, 'edit'])->name('dosen.edit');
    Route::post('/dosen/update/{id}', [DosenController::class, 'update'])->name('dosen.update');
    Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
    Route::delete('/dosen/{id}', [DosenController::class, 'destroy'])->name('dosen.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan');
    Route::post('/ruangan', [RuanganController::class, 'store']);
    Route::get('/ruangan/edit/{id}', [RuanganController::class, 'edit'])->name('ruangan.edit');
    Route::post('/ruangan/update/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
    Route::get('/ruangan/create', [RuanganController::class, 'create'])->name('ruangan.create');
    Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
    Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('/mahasiswa/edit/{id}', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/update/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/jabatan_pimpinan', [JabatanPimpinanController::class, 'index'])->name('jabatan_pimpinan');
    Route::get('/jabatan_pimpinan/create', [JabatanPimpinanController::class, 'create'])->name('jabatan_pimpinan.create');
    Route::post('/jabatan_pimpinan', [JabatanPimpinanController::class, 'store'])->name('jabatan_pimpinan.store');
    Route::get('/jabatan_pimpinan/edit/{id}', [JabatanPimpinanController::class, 'edit'])->name('jabatan_pimpinan.edit');
    Route::put('/jabatan_pimpinan/update/{id}', [JabatanPimpinanController::class, 'update'])->name('jabatan_pimpinan.update');
    Route::delete('/jabatan_pimpinan/{id}', [JabatanPimpinanController::class, 'destroy'])->name('jabatan_pimpinan.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/pimpinan', [PimpinanController::class, 'index'])->name('pimpinan');
    Route::get('/pimpinan/create', [PimpinanController::class, 'create'])->name('pimpinan.create');
    Route::post('/pimpinan', [PimpinanController::class, 'store'])->name('pimpinan.store');
    Route::get('/pimpinan/edit/{id}', [PimpinanController::class, 'edit'])->name('pimpinan.edit');
    Route::put('/pimpinan/update/{id}', [PimpinanController::class, 'update'])->name('pimpinan.update');
    Route::delete('/pimpinan/{id}', [PimpinanController::class, 'destroy'])->name('pimpinan.destroy');
});
require __DIR__.'/auth.php';
