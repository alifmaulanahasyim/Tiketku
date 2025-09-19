<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\PemesananController;
use App\Http\Controllers\Admin\KelolaPemesananController;
use App\Http\Controllers\Admin\DestinasiWisataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama (opsional)
Route::get('/', function () {
    return view('welcome');
});

// ---------------------
// ROUTES UNTUK USER
// ---------------------
// Route detail destinasi user (harus di luar prefix pemesanan)
Route::get('/destinasi/{id}', [\App\Http\Controllers\User\MenuController::class, 'show'])->name('user.destinasi.show');
Route::prefix('pemesanan')->name('pemesanan.')->group(function () {
    Route::get('/', [PemesananController::class, 'create'])->name('create');   // Form Pemesanan
    Route::post('/', [PemesananController::class, 'store'])->name('store');    // Simpan Pemesanan
    Route::get('/bill/{id}', [PemesananController::class, 'bill'])->name('bill'); // Bill setelah pesan
    Route::get('/bill/{id}/pdf', [PemesananController::class, 'exportPdf'])->name('bill.pdf'); // Export bill ke PDF
});

// Halaman menu objek wisata untuk user
use App\Http\Controllers\User\MenuController;
Route::get('/menu', [MenuController::class, 'index'])->name('user.menu');

// Endpoint untuk menampilkan form pemesanan (untuk modal)
Route::get('/pemesanan/form/{id}', [PemesananController::class, 'showForm'])->name('pemesanan.form');

// ---------------------
// ROUTES UNTUK ADMIN
// ---------------------
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/pemesanan', [KelolaPemesananController::class, 'index'])->name('pemesanan.index');   // Daftar Pemesanan
    Route::get('/pemesanan/{id}/edit', [KelolaPemesananController::class, 'edit'])->name('pemesanan.edit'); // Edit Pemesanan
    Route::put('/pemesanan/{id}', [KelolaPemesananController::class, 'update'])->name('pemesanan.update'); // Update Pemesanan
    Route::delete('/pemesanan/{id}', [KelolaPemesananController::class, 'destroy'])->name('pemesanan.destroy'); // Hapus Pemesanan

    // Kelola destinasi wisata
    Route::get('/destinasi', [DestinasiWisataController::class, 'index'])->name('destinasi.index');
    Route::get('/destinasi/tambah', [DestinasiWisataController::class, 'create'])->name('destinasi.create');
    Route::post('/destinasi/tambah', [DestinasiWisataController::class, 'store'])->name('destinasi.store');
    Route::get('/destinasi/{id}/edit', [DestinasiWisataController::class, 'edit'])->name('destinasi.edit');
    Route::put('/destinasi/{id}', [DestinasiWisataController::class, 'update'])->name('destinasi.update');
    Route::delete('/destinasi/{id}', [DestinasiWisataController::class, 'destroy'])->name('destinasi.destroy');
});
