<?php

namespace App\Http\Controllers;

use App\Models\Penulis;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\SimpanPenulisRequest;

class PenulisController extends Controller
{
    public function store(SimpanPenulisRequest $request)
    {
        $id = Str::random(16);

        $data = [
            'penulis_id' => $id,
            'penulis_nama' => $request->penulis_nama,
            'penulis_tmptlahir' => $request->penulis_tmptlahir,
            'penulis_tgllahir' => $request->penulis_tgllahir,
        ];

        Penulis::create($data);

        return redirect()->route('admin.penulis', ['action' => 'show'])->with('success', 'Penulis baru berhasil ditambahkan!');
    }

    public function update(SimpanPenulisRequest $request, $id)
    {
        $data = [
            'penulis_nama' => $request->penulis_nama,
            'penulis_tmptlahir' => $request->penulis_tmptlahir,
            'penulis_tgllahir' => $request->penulis_tgllahir,
        ];

        Penulis::where('penulis_id', $id)->update($data);

        return redirect()->route('admin.penulis', ['action' => 'show'])->with('success', 'Penulis ' . $request->penulis_nama . ' berhasil diupdate!');
    }

    public static function delete($id)
    {
        Penulis::where('penulis_id', $id)->delete();
    }
}
