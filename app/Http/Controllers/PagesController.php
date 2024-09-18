<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\Buku;
use App\Models\User;
use App\Models\Penulis;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Peminjaman;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PeminjamanDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\PeminjamanController;

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

    public function bukuPage($withCategoryFilter = '')
    {
        $data_kategori = Kategori::all();

        if ($withCategoryFilter) {
            $buku_all = Buku::with(['penulis', 'kategori', 'penerbit', 'rak'])->where('buku_kategori_id', $withCategoryFilter)->get();
            $data = $buku_all->map(function ($buku) {
                return [
                    'buku_id' => $buku->buku_id,
                    'buku_judul' => $buku->buku_judul,
                    'buku_isbn' => $buku->buku_isbn,
                    'buku_thnterbit' => $buku->buku_thnterbit,
                    'buku_urlgambar' => $buku->buku_urlgambar,
                    'buku_penulis' => $buku->penulis->penulis_nama,
                    'buku_kategori' => $buku->kategori->kategori_nama,
                    'buku_penerbit' => $buku->penerbit->penerbit_nama,
                    'buku_rak' => $buku->rak->rak_lokasi,
                ];
            });

            return view('general.buku', [
                'data_buku' => $data,
                'data_kategori' => $data_kategori,
                'level'  => 'siswa',
                'action' => 'siswa'
            ]);
        }

        $buku_all = Buku::with(['penulis', 'kategori', 'penerbit', 'rak'])->get();
        $data = $buku_all->map(function ($buku) {
            return [
                'buku_id' => $buku->buku_id,
                'buku_judul' => $buku->buku_judul,
                'buku_isbn' => $buku->buku_isbn,
                'buku_thnterbit' => $buku->buku_thnterbit,
                'buku_urlgambar' => $buku->buku_urlgambar,
                'buku_penulis' => $buku->penulis->penulis_nama,
                'buku_kategori' => $buku->kategori->kategori_nama,
                'buku_penerbit' => $buku->penerbit->penerbit_nama,
                'buku_rak' => $buku->rak->rak_lokasi,
            ];
        });

        // return $data;

        return view('general.buku', [
            'data_buku' => $data,
            'data_kategori' => $data_kategori,
            'level'  => 'siswa',
            'action' => 'siswa'
        ]);
    }

    public function pinjamBuku($id)
    {
        // $user_id = 'VXQvbwjkAwEN9NWb';  
        $user_id = Auth::user()->user_id;  //USER ID BISA DIGANTI DISINI UTK SESSION NTI
        $buku_detail = Buku::where('buku_id', $id)->first();
        $peminjaman_id = Str::random(16);
        $current_date = date("Y-m-d");

        $data_peminjaman = [
            'peminjaman_id' => $peminjaman_id,
            'peminjaman_user_id' => $user_id,
            'peminjaman_tglpinjam' => $current_date,
            'peminjaman_tglkembali' => $current_date,
        ];

        $data_detail = [
            'peminjaman_detail_peminjaman_id' => $peminjaman_id,
            'peminjaman_detail_buku_id' => $id
        ];

        // Peminjaman::create($data_peminjaman);
        // PeminjamanDetail::create($data_detail);

        DB::table('peminjaman')->insert($data_peminjaman);
        DB::table('peminjaman_detail')->insert($data_detail);

        return redirect()->route('peminjaman')->with('success', 'Anda telah meminjam buku ' . $buku_detail['buku_judul'] . '!');
    }

    public function peminjamanPage()
    {
        // $user_id = 'VXQvbwjkAwEN9NWb';  
        $user_id = Auth::user()->user_id;  //USER ID BISA DIGANTI DISINI UTK SESSION NTI

        // Pemahaman lagi di https://laravel.com/docs/11.x/eloquent-relationships#querying-relationship-existence
        $peminjaman_detail_all = PeminjamanDetail::with(['peminjaman_content', 'buku_content'])
            ->whereHas(
                'peminjaman_content',
                function ($query) use ($user_id) { // use adalah menggunakan variabel `$user_id` di atas karena di function ini tertutup
                    return $query->where('peminjaman_user_id', $user_id);
                }
            )
            ->get();

        // return $peminjaman_detail_all;

        return view('general.peminjaman', [
            'level'  => 'siswa',
            'action' => 'siswa',
            'data' => $peminjaman_detail_all,
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
        // $buku_all = Buku::with(['penulis', 'kategori', 'penerbit', 'rak'])->get();

        $buku_all = DB::table('buku')
            ->join('penulis', 'buku.buku_penulis_id', '=', 'penulis.penulis_id')
            ->join('kategori', 'buku.buku_kategori_id', '=', 'kategori.kategori_id')
            ->join('rak', 'buku.buku_rak_id', '=', 'rak.rak_id')
            ->join('penerbit', 'buku.buku_penerbit_id', '=', 'penerbit.penerbit_id')
            ->select('buku.*', 'penulis.penulis_nama', 'kategori.kategori_nama', 'rak.rak_nama', 'rak.rak_lokasi', 'penerbit.penerbit_nama')
            ->paginate(10);


        // return $buku_all;
        // $buku_fk = $buku_all->map(function ($buku) {
        //     return [
        //         'buku_id' => $buku->buku_id,
        //         'buku_judul' => $buku->buku_judul,
        //         'buku_isbn' => $buku->buku_isbn,
        //         'buku_thnterbit' => $buku->buku_thnterbit,
        //         'buku_penulis' => $buku->penulis_nama,
        //         'buku_kategori' => $buku->kategori_nama,
        //         'buku_penerbit' => $buku->penerbit_nama,
        //         'buku_rak' => $buku->rak_lokasi,
        //     ];
        // });

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
            // Kompleks juga ini :(  syntax error, unexpected token ";" 
            $peminjamanIds = Peminjaman::whereHas('buku', function ($query) use ($request) {
                $query->where('buku_id', $request->id);
            })->pluck('peminjaman_id');

            Peminjaman::whereIn('peminjaman_id', $peminjamanIds)->delete();

            BukuController::delete($request->id);


            return redirect()->route('admin.buku', ['action' => 'show'])->with('success', 'Buku berhasil dihapus!');
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
            'data_buku' => $buku_all,
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
        if (!in_array($action, ['show', 'create', 'edit', 'delete', 'delete-index'])) {
            return abort(404);
        }

        $peminjaman_all = Peminjaman::with(['user', 'peminjamanDetail', 'buku'])->get();

        // return $peminjaman_all;

        if ($action == 'create') {
            $user_all = User::all();
            $buku_all = Buku::all();

            $data = [
                "user" => $user_all,
                "buku" => $buku_all,
            ];

            // return $data;

            return view('general.peminjaman', [
                'level'  => 'admin',
                'action' => $action,
                'data' => $data
            ]);
        }

        if ($action == 'edit') {
            $peminjaman_edit = Peminjaman::with(['user', 'peminjamanDetail', 'buku'])->where('peminjaman_id', $request->id)->get();

            // return $peminjaman_edit;

            return view('general.peminjaman', [
                'level'  => 'admin',
                'action' => $action,
                'editID' => $request->id,
                'data' => $peminjaman_edit
            ]);
        }

        if ($action == 'delete') {
            $data = Peminjaman::with(['user', 'peminjamanDetail'])->where('peminjaman_id', $request->id)->get();
            PeminjamanController::delete($request->id);
            return redirect()->route('admin.peminjaman', ['action' => 'show'])->with('success', 'Peminjaman ' . $data[0]['user']['user_username'] . ' berhasil dihapus!');
        }

        if ($action == 'delete-index') {
            PeminjamanController::deleteIndex();
            return redirect()->route('admin.peminjaman', ['action' => 'show'])->with('success', 'Semua Peminjaman yang selesai berhasil dihapus!');
        }

        // return $peminjaman_all;

        return view('general.peminjaman', [
            'level'  => 'admin',
            'action' => $action,
            'editID' => $request->id,
            'data' => $peminjaman_all,
        ]);
    }

    public function adminPengaturanPage()
    {
        return view('general.pengaturan', [
            'level'  => 'admin',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
