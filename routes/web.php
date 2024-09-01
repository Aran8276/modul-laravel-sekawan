<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RakController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenerbitController;


// Route::get('/tambahkan-buku', [BukuController::class, 'showView'])->name('view.buku');
// Route::post('/tambahkan-buku', [BukuController::class, 'postView'])->name('post.buku');

// Redirect jika kosong
Route::get('/', function () {
    return redirect('/login');
});

// Test bootstrap & CSS
Route::get('/test-bootstrap', function () {
    return view('test-bootstrap');
});

Route::controller(PagesController::class)->group(function () {
    // Public
    Route::get('/login', 'loginPage')->name('login');
    Route::get('/register', 'registerPage')->name('register');

    // Siswa
    Route::get('/dashboard', 'dashboardPage')->name('dashboard');
    Route::prefix('/buku')->group(function () {
        Route::get('/', 'bukuPage')->name('buku');
        Route::get('/{withCategoryFilter}', 'bukuPage')->name('buku.kategori');
        Route::get('/pinjam/{id}', 'pinjamBuku')->name('buku.pinjam');
    });
    Route::get('/peminjaman', 'peminjamanPage')->name('peminjaman');
    Route::get('/pengaturan', 'pengaturanPage')->name('pengaturan');


    // Admin (middleware mungkin nanti)
    Route::prefix('/admin')->group(function () {
        // Tampilan View
        Route::get('/dashboard', 'adminDashboardPage')->name('admin.dashboard');
        Route::get('/buku/{action}', 'adminBukuPage')->name('admin.buku');
        Route::get('/kategori/{action}', 'adminKategoriPage')->name('admin.kategori');
        Route::get('/penulis/{action}', 'adminPenulisPage')->name('admin.penulis');
        Route::get('/penerbit/{action}', 'adminPenerbitPage')->name('admin.penerbit');
        Route::get('/peminjaman/{action}', 'adminPeminjamanPage')->name('admin.peminjaman');
        Route::get('/pengaturan', 'adminPengaturanPage')->name('admin.pengaturan');

        // CRUD API
        Route::prefix('/api')->group(function () {
            Route::controller(RakController::class)->group(function () {
                Route::prefix('/rak')->group(function () {
                    Route::post('/', 'store')->name('action.rak.create');
                    Route::put('/{id}', 'update')->name('action.rak.update');
                    Route::delete('/{id}', 'delete')->name('action.rak.delete');
                });
            });

            Route::controller(PenulisController::class)->group(function () {
                Route::prefix('/penulis')->group(function () {
                    Route::post('/', 'store')->name('action.penulis.create');
                    Route::put('/{id}', 'update')->name('action.penulis.update');
                    Route::delete('/{id}', 'delete')->name('action.penulis.delete');
                });
            });

            Route::controller(PenerbitController::class)->group(function () {
                Route::prefix('/penerbit')->group(function () {
                    Route::post('/', 'store')->name('action.penerbit.create');
                    Route::put('/{id}', 'update')->name('action.penerbit.update');
                    Route::delete('/{id}', 'delete')->name('action.penerbit.delete');
                });
            });

            Route::controller(KategoriController::class)->group(function () {
                Route::prefix('/kategori')->group(function () {
                    Route::post('/', 'store')->name('action.kategori.create');
                    Route::put('/{id}', 'update')->name('action.kategori.update');
                    Route::delete('/{id}', 'delete')->name('action.kategori.delete');
                });
            });

            Route::controller(BukuController::class)->group(function () {
                Route::prefix('/buku')->group(function () {
                    Route::post('/', 'store')->name('action.buku.create');
                    Route::put('/{id}', 'update')->name('action.buku.update');
                    Route::delete('/{id}', 'delete')->name('action.buku.delete');
                });
            });
        });
    });
});

    /*
Buku, Kategori Buku, Peminjaman, Peminjaman Detail, Penulis, Rak, User
*/
