<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\RiwayatKesehatanController;
use App\Http\Controllers\Admin\ObatController;
use App\Http\Controllers\Admin\PenggunaanObatController;
use App\Http\Controllers\Admin\PetugasUKSController;
use App\Http\Controllers\Admin\JadwalUKSController as AdminJadwalUKSController;
use App\Http\Controllers\Admin\LaporanKesehatanController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\KonsultasiController as UserKonsultasiController;
use App\Http\Controllers\User\JadwalUKSController as UserJadwalUKSController;
use App\Http\Controllers\User\EdukasiKesehatanController as UserEdukasiKesehatanController;

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

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Penggunaan Obat
    Route::get('/penggunaan-obat/riwayat', [PenggunaanObatController::class, 'riwayat'])
        ->name('penggunaan-obat.riwayat');
    Route::resource('penggunaan-obat', PenggunaanObatController::class)
        ->except(['show']);

    // Resource routes
    Route::resource('siswa', SiswaController::class);
    Route::resource('riwayat-kesehatan', RiwayatKesehatanController::class);
    Route::resource('obat', ObatController::class);
    Route::resource('petugas-uks', PetugasUKSController::class);
    Route::resource('jadwal-uks', AdminJadwalUKSController::class)->except(['show']);
    Route::get('/jadwal-uks/events', [AdminJadwalUKSController::class, 'getEvents'])->name('jadwal-uks.events');
    Route::resource('laporan-kesehatan', LaporanKesehatanController::class);
});


Route::prefix('user')->middleware(['auth', 'role:user'])->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // Konsultasi
    Route::get('/konsultasi/riwayat', [UserKonsultasiController::class, 'riwayat'])
        ->name('konsultasi.riwayat');
    Route::resource('konsultasi', UserKonsultasiController::class)->except(['show']);

    // Riwayat Kunjungan UKS
    // Route::resource('kunjungan-uks', UserKunjunganUKSController::class);

    // Edukasi Kesehatan
    Route::resource('edukasi-kesehatan', UserEdukasiKesehatanController::class);

    // Jadwal UKS
    Route::resource('jadwal-uks', UserJadwalUKSController::class)->except(['show']);
    Route::get('/jadwal-uks/events', [UserJadwalUKSController::class, 'getEvents'])->name('jadwal-uks.events');

    // Peringatan Dini
    // Route::resource('peringatan-dini', UserPeringatanDiniController::class);
});


require __DIR__ . '/auth.php';
