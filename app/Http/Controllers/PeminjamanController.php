<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PeminjamanDetail;
use App\Http\Requests\SimpanPeminjamanRequest;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function store(SimpanPeminjamanRequest $request)
    {
        $peminjaman_id = Str::random(16);
        $current_date = date("Y-m-d");

        $data_peminjaman = [
            'peminjaman_id' => $peminjaman_id,
            'peminjaman_user_id' => $request->peminjaman_user_id,
            'peminjaman_tglpinjam' => $current_date,
            'peminjaman_tglkembali' => $current_date,
        ];

        $data_detail = [
            'peminjaman_detail_peminjaman_id' => $peminjaman_id,
            'peminjaman_detail_buku_id' => $request->peminjaman_detail_buku_id
        ];

        Peminjaman::create($data_peminjaman);
        PeminjamanDetail::create($data_detail);

        return redirect()->route('admin.peminjaman', ['action' => 'show'])->with('success', 'Peminjaman berhasil ditambahkan!');
    }

    public function update(SimpanPeminjamanRequest $request, $id)
    {
        $current_date = date("Y-m-d");
        $data = [
            'peminjaman_note' => $request->peminjaman_note,
            'peminjaman_denda' => $request->peminjaman_denda,
            'peminjaman_statuskembali' => 1,
            'peminjaman_tglkembali' => $current_date
        ];

        Peminjaman::where('peminjaman_id', $id)->update($data);

        return redirect()->route('admin.peminjaman', ['action' => 'show'])->with('success', 'Peminjaman berhasil diselesaikan!');
    }

    public static function delete($id)
    {
        Peminjaman::where('peminjaman_id', $id)->delete();
    }

    public static function deleteIndex()
    {
        Peminjaman::where('peminjaman_statuskembali', 1)->delete();
    }
}
