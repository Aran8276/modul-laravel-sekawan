<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-array', [PagesController::class, 'testArray']);

Route::get('/tambahkan-buku', [BukuController::class, 'showView'])->name('view.buku');
Route::post('/tambahkan-buku', [BukuController::class, 'postView'])->name('post.buku');
Route::get('/test-bootstrap', function () {
    return view('test-bootstrap');
});

Route::controller(PagesController::class)->group(function () {
    Route::get('/login', 'loginPage')->name('login');
    Route::get('/register', 'registerPage')->name('register');
    Route::get('/dashboard', 'dashboardPage')->name('dashboard');

    Route::prefix('/admin')->group(function () {
        Route::get('/dashboard', 'adminDashboardPage')->name('dashboard.admin');
        Route::get('/buku/{action}', 'adminBukuPage')->name('dashboard.admin');
        Route::get('/kategori/{action}', 'adminKategoriPage')->name('dashboard.admin');
        Route::get('/penulis/{action}', 'adminPenulisPage')->name('dashboard.admin');
        Route::get('/penerbit/{action}', 'adminPenerbitPage')->name('dashboard.admin');
        Route::get('/peminjaman/{action}', 'adminPeminjamanPage')->name('dashboard.admin');
        Route::get('/pengaturan/{action}', 'adminPengaturanPage')->name('dashboard.admin');
    });
});
