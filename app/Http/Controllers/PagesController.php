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
        // ini sangat complex guys ternyata (buku)
        if (!in_array($action, ['show', 'create', 'edit', 'delete', 'create-rak', 'edit-rak', 'delete-rak'])) {
            return abort(404);
        }

        $rak_all = Rak::all();
        $buku_all = Buku::with(['penulis', 'kategori', 'penerbit', 'rak'])->get();
        $buku_fk = $buku_all->map(function ($buku) {
            return [
                'buku_id' => $buku->buku_id,
                'buku_judul' => $buku->buku_judul,
                'buku_isbn' => $buku->buku_isbn,
                'buku_thnterbit' => $buku->buku_thnterbit,
                'buku_penulis' => $buku->penulis->penulis_nama,
                'buku_kategori' => $buku->kategori->kategori_nama,
                'buku_penerbit' => $buku->penerbit->penerbit_nama,
                'buku_rak' => $buku->rak->rak_lokasi,
            ];
        });

        if ($action == 'edit-rak') {
            $data = Rak::find($request->id);
            return view('general.buku', [
                'level'  => 'admin',
                'action' => $action,
                'editID' => $request->id,
                'data_rak' => $data,
            ]);
        }

        if ($action == 'create') {
            $rak_fk_field = Rak::select('rak_id', 'rak_nama', 'rak_lokasi')->get();
            $penulis_fk_field = Penulis::select('penulis_id', 'penulis_nama')->get();
            $kategori_fk_field = Kategori::select('kategori_id', 'kategori_nama')->get();
            $penerbit_fk_field = Penerbit::select('penerbit_id', 'penerbit_nama')->get();
            $data = [
                'rak' => $rak_fk_field,
                'penulis' => $penulis_fk_field,
                'kategori' => $kategori_fk_field,
                'penerbit' => $penerbit_fk_field,
            ];

            // return $data;

            return view('general.buku', [
                'level'  => 'admin',
                'action' => $action,
                'editID' => $request->id,
                'data_fk' => $data,
            ]);
        }

        if ($action == 'edit') {
            $rak_fk_field = Rak::select('rak_id', 'rak_nama', 'rak_lokasi')->get();
            $penulis_fk_field = Penulis::select('penulis_id', 'penulis_nama')->get();
            $kategori_fk_field = Kategori::select('kategori_id', 'kategori_nama')->get();
            $penerbit_fk_field = Penerbit::select('penerbit_id', 'penerbit_nama')->get();

            $buku_all = Buku::with(['penulis', 'kategori', 'penerbit', 'rak'])->where('buku_id', $request->id)->get();
            $buku_fk_select = $buku_all->map(function ($buku) {
                return [
                    'buku_id' => $buku->buku_id,
                    'buku_judul' => $buku->buku_judul,
                    'buku_isbn' => $buku->buku_isbn,
                    'buku_thnterbit' => $buku->buku_thnterbit,
                    'buku_penulis' => $buku->penulis->penulis_nama,
                    'buku_kategori' => $buku->kategori->kategori_nama,
                    'buku_penerbit' => $buku->penerbit->penerbit_nama,
                    'buku_rak' => $buku->rak->rak_lokasi,
                ];
            });

            $data_fk = [
                'rak' => $rak_fk_field,
                'penulis' => $penulis_fk_field,
                'kategori' => $kategori_fk_field,
                'penerbit' => $penerbit_fk_field,
            ];

            // return $buku_fk_select;

            return view('general.buku', [
                'level'  => 'admin',
                'action' => $action,
                'editID' => $request->id,
                'data_buku' => $buku_fk_select,
                'data_fk' => $data_fk,
            ]);
        }

        if ($action == 'delete') {
            $data = Buku::find($request->id);
            BukuController::delete($request->id);
            return redirect()->route('admin.buku', ['action' => 'show'])->with('success', 'Buku ' . $data->buku_nama . ' berhasil dihapus!');
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
            'data_buku' => $buku_fk,
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
