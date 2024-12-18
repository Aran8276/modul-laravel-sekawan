<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RakController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenerbitController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\InvertedAuthMiddleware;
use App\Http\Middleware\RoleMiddleware;

// Route::get('/tambahkan-buku', [BukuController::class, 'showView'])->name('view.buku');
// Route::post('/tambahkan-buku', [BukuController::class, 'postView'])->name('post.buku');

// Redirect jika kosong
Route::get('/', function () {
    return redirect('/login');
});

// Test bootstrap, CSS, dll
Route::get('/test-bootstrap', function () {
    return view('test-bootstrap');
});

// https://github.com/Aran8276/library-app/blob/main/app/Http/Middleware/CheckIsAdminRoleMiddleware.php
Route::get('/auth-test', function () {
    if (Auth::check())
        return Auth::user()->user_id;
    else
        return "Not logged in";
});

Route::controller(AuthController::class)->group(function () {
    Route::prefix('/api')->group(function () {
        Route::post('/login', 'loginPost')->name('action.login');
        Route::post('/register', 'registerPost')->name('action.register');
    });
});

Route::controller(PagesController::class)->group(function () {
    // Public
    Route::middleware(InvertedAuthMiddleware::class)->group(function () {
        Route::get('/login', 'loginPage')->name('login');
        Route::get('/register', 'registerPage')->name('register');
    });

    // Siswa
    Route::middleware(AuthMiddleware::class)->group(function () {
        Route::get('/dashboard', 'dashboardPage')->name('dashboard');
        Route::prefix('/buku')->group(function () {
            Route::get('/', 'bukuPage')->name('buku');
            Route::get('/{withCategoryFilter}', 'bukuPage')->name('buku.kategori');
            Route::get('/pinjam/{id}', 'pinjamBuku')->name('buku.pinjam');
        });
        Route::get('/peminjaman', 'peminjamanPage')->name('peminjaman');
        Route::get('/pengaturan', 'pengaturanPage')->name('pengaturan');

        Route::get('/logout', 'logout')->name('action.logout');
        Route::put('/pengaturan', [AuthController::class, 'updateProfile'])->name('action.update.profile');

        // Admin (middleware mungkin nanti)
        Route::middleware(RoleMiddleware::class)->group(function () {
            Route::prefix('/admin')->group(function () {
                // Tampilan View
                Route::get('/', function () {
                    return redirect('/dashboard');
                });
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

                    Route::controller(PeminjamanController::class)->group(function () {
                        Route::prefix('/peminjaman')->group(function () {
                            Route::post('/', 'store')->name('action.peminjaman.create');
                            Route::put('/{id}', 'update')->name('action.peminjaman.update');
                            Route::delete('/{id}', 'delete')->name('action.peminjaman.delete');
                        });
                    });
                });
            });
        });
    });
});
/*
Buku, Kategori Buku, Peminjaman, Peminjaman Detail, Penulis, Rak, User
*/

// Route::get('/siswa', function () {
//     return view('nama-view');
// });




Route::get('/createrak', [PagesController::class, 'create_rak'])->name('createrak');
