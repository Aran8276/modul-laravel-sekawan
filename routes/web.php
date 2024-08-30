<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RakController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenerbitController;

Route::get('/', function () {
    return redirect('/login');
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

        Route::prefix('/api')->group(function () {
            Route::post('/rak', [RakController::class, 'store'])->name('action.rak.create');
            Route::put('/rak/{id}', [RakController::class, 'update'])->name('action.rak.update');
            Route::delete('/rak/{id}', [RakController::class, 'delete'])->name('action.rak.delete');

            Route::post('/penulis', [PenulisController::class, 'store'])->name('action.penulis.create');
            Route::put('/penulis/{id}', [PenulisController::class, 'update'])->name('action.penulis.update');
            Route::delete('/penulis/{id}', [PenulisController::class, 'delete'])->name('action.penulis.delete');

            Route::post('/penerbit', [PenerbitController::class, 'store'])->name('action.penerbit.create');
            Route::put('/penerbit/{id}', [PenerbitController::class, 'update'])->name('action.penerbit.update');
            Route::delete('/penerbit/{id}', [PenerbitController::class, 'delete'])->name('action.penerbit.delete');

            Route::post('/kategori', [KategoriController::class, 'store'])->name('action.kategori.create');
            Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('action.kategori.update');
            Route::delete('/kategori/{id}', [KategoriController::class, 'delete'])->name('action.kategori.delete');
        });
    });
});

/*
Buku, Kategori Buku, Peminjaman, Peminjaman Detail, Penulis, Rak, User
*/