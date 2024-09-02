<?php

namespace App\Http\Controllers;

use App\Http\Requests\SimpanBukuRequest;
use App\Http\Requests\SimpanPeminjamanRequest;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function store(SimpanBukuRequest $request) {}

    public function update(SimpanBukuRequest $request, $id)
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
