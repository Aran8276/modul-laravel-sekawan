<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // Public / Authentikasi
    public function loginPage()
    {
        return view('public.login');
    }

    public function registerPage()
    {
        return view('public.register');
    }

    // Siswa
    public function dashboardPage()
    {
        return view('general.dashboard', [
            'level'  => 'siswa',
            'action' => 'siswa'
        ]);
    }

    public function bukuPage()
    {
        return view('general.buku', [
            'level'  => 'siswa',
            'action' => 'siswa'
        ]);
    }

    public function peminjamanPage()
    {
        return view('general.peminjaman', [
            'level'  => 'siswa',
            'action' => 'siswa'
        ]);
    }

    public function pengaturanPage()
    {
        return view('general.pengaturan', [
            'level'  => 'siswa',
            'action' => 'siswa'
        ]);
    }

    // Admin (bisa di protek pakai middleware nanti) atau disini: manipulasi level
    public function adminDashboardPage()
    {
        return view('general.dashboard', ['level'  => 'admin']);
    }

    public function adminBukuPage($action, Request $request)
    {
        if (!in_array($action, ['show', 'create', 'edit', 'delete'])) {
            return abort(404);
        }

        return view('general.buku', [
            'level'  => 'admin',
            'action' => $action,
            'editID' => $request->id,
        ]);
    }

    public function adminKategoriPage($action, Request $request)
    {
        if (!in_array($action, ['show', 'create', 'edit', 'delete'])) {
            return abort(404);
        }

        return view('general.kategori', [
            'level'  => 'admin',
            'action' => $action,
            'editID' => $request->id,
        ]);
    }

    public function adminPenulisPage($action, Request $request)
    {
        if (!in_array($action, ['show', 'create', 'edit', 'delete'])) {
            return abort(404);
        }

        return view('general.penulis', [
            'level'  => 'admin',
            'action' => $action,
            'editID' => $request->id,
        ]);
    }

    public function adminPenerbitPage($action, Request $request)
    {
        if (!in_array($action, ['show', 'create', 'edit', 'delete'])) {
            return abort(404);
        }

        return view('general.penerbit', [
            'level'  => 'admin',
            'action' => $action,
            'editID' => $request->id,
        ]);
    }

    public function adminPeminjamanPage($action, Request $request)
    {
        if (!in_array($action, ['show', 'create', 'edit', 'delete'])) {
            return abort(404);
        }

        return view('general.peminjaman', [
            'level'  => 'admin',
            'action' => $action,
            'editID' => $request->id,
        ]);
    }

    public function adminPengaturanPage()
    {
        return view('general.pengaturan', [
            'level'  => 'admin',
        ]);
    }
}
