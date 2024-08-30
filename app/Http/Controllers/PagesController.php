<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\Buku;
use App\Models\Penulis;
use App\Models\Kategori;
use App\Models\Penerbit;
use Illuminate\Http\Request;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\PenerbitController;

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

    // Admin (bisa di protek pakai middleware nanti) atau disini:  manipulasi level
    public function adminDashboardPage()
    {
        return view('general.dashboard', ['level'  => 'admin']);
    }

    public function adminBukuPage($action, Request $request)
    {
        if (!in_array($action, ['show', 'create', 'edit', 'delete', 'create-rak', 'edit-rak', 'delete-rak'])) {
            return abort(404);
        }
        $rak_all = Rak::all();

        if ($action == 'edit-rak') {
            $data = Rak::find($request->id);
            return view('general.buku', [
                'level'  => 'admin',
                'action' => $action,
                'editID' => $request->id,
                'data_rak' => $data,
            ]);
        }

        if ($action == 'delete-rak') {
            $data = Rak::find($request->id);
            RakController::delete($request->id);
            return redirect()->route('admin.buku', ['action' => 'show'])->with('success', 'Rak ' . $data->rak_nama . ' berhasil dihapus!');
        }

        return view('general.buku', [
            'level'  => 'admin',
            'action' => $action,
            'editID' => $request->id,
            'data_rak' => $rak_all,
        ]);
    }

    public function adminKategoriPage($action, Request $request)
    {
        if (!in_array($action, ['show', 'create', 'edit', 'delete'])) {
            return abort(404);
        }

        $data = Kategori::all();

        if ($action == 'edit') {
            $data = Kategori::find($request->id);
            return view('general.kategori', [
                'level'  => 'admin',
                'action' => $action,
                'editID' => $request->id,
                'data_kategori' => $data,
            ]);
        }

        if ($action == 'delete') {
            $data = Kategori::find($request->id);
            KategoriController::delete($request->id);
            return redirect()->route('admin.kategori', ['action' => 'show'])->with('success', 'Kategori ' . $data->kategori_nama . ' berhasil dihapus!');
        }

        return view('general.kategori', [
            'level'  => 'admin',
            'action' => $action,
            'editID' => $request->id,
            'data_kategori' => $data,
        ]);
    }

    public function adminPenulisPage($action, Request $request)
    {
        if (!in_array($action, ['show', 'create', 'edit', 'delete'])) {
            return abort(404);
        }

        $data = Penulis::all();

        if ($action == 'edit') {
            $data = Penulis::find($request->id);
            return view('general.penulis', [
                'level'  => 'admin',
                'action' => $action,
                'editID' => $request->id,
                'data_penulis' => $data,
            ]);
        }

        if ($action == 'delete') {
            $data = Penulis::find($request->id);
            PenulisController::delete($request->id);
            return redirect()->route('admin.penulis', ['action' => 'show'])->with('success', 'Penulis ' . $data->penulis_nama . ' berhasil dihapus!');
        }


        return view('general.penulis', [
            'level'  => 'admin',
            'action' => $action,
            'editID' => $request->id,
            'data_penulis' => $data,
        ]);
    }

    public function adminPenerbitPage($action, Request $request)
    {
        if (!in_array($action, ['show', 'create', 'edit', 'delete'])) {
            return abort(404);
        }

        $data = Penerbit::all();

        if ($action == 'edit') {
            $data = Penerbit::find($request->id);
            return view('general.penerbit', [
                'level'  => 'admin',
                'action' => $action,
                'editID' => $request->id,
                'data_penerbit' => $data,
            ]);
        }

        if ($action == 'delete') {
            $data = Penerbit::find($request->id);
            PenerbitController::delete($request->id);
            return redirect()->route('admin.penerbit', ['action' => 'show'])->with('success', 'Penerbit ' . $data->penerbit_nama . ' berhasil dihapus!');
        }

        return view('general.penerbit', [
            'level'  => 'admin',
            'action' => $action,
            'editID' => $request->id,
            'data_penerbit' => $data,
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
