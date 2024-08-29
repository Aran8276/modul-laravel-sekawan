<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tambahkan-buku', [BukuController::class, 'showView'])->name('view.buku');
Route::post('/tambahkan-buku', [BukuController::class, 'postView'])->name('post.buku');
Route::get('/test-bootstrap', function () {
    return view('test-bootstrap');
});

Route::controller(PagesController::class)->group(function () {
    // Public
    Route::get('/login', 'loginPage')->name('login');
    Route::get('/register', 'registerPage')->name('register');

    // Siswa
    Route::get('/dashboard', 'dashboardPage')->name('dashboard');
    Route::get('/buku', 'bukuPage')->name('buku');
    Route::get('/peminjaman', 'peminjamanPage')->name('peminjaman');
    Route::get('/pengaturan', 'pengaturanPage')->name('pengaturan');

    // Admin (middleware mungkin nanti)
    Route::prefix('/admin')->group(function () {
        Route::get('/dashboard', 'adminDashboardPage')->name('admin.dashboard');
        Route::get('/buku/{action}', 'adminBukuPage')->name('admin.buku');
        Route::get('/kategori/{action}', 'adminKategoriPage')->name('admin.kategori');
        Route::get('/penulis/{action}', 'adminPenulisPage')->name('admin.penulis');
        Route::get('/penerbit/{action}', 'adminPenerbitPage')->name('admin.penerbit');
        Route::get('/peminjaman/{action}', 'adminPeminjamanPage')->name('admin.peminjaman');
        Route::get('/pengaturan', 'adminPengaturanPage')->name('admin.pengaturan');
    });
});
