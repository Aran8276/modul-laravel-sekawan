<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\SimpanKategoriRequest;

class KategoriController extends Controller
{
    public function store(SimpanKategoriRequest $request)
    {
        $id = Str::random(16);

        $data = [
            'kategori_id' => $id,
            'kategori_nama' => $request->kategori_nama,
        ];

        Kategori::create($data);

        return redirect()->route('admin.kategori', ['action' => 'show'])->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    public function update(SimpanKategoriRequest $request, $id)
    {
        $data = [
            'kategori_nama' => $request->kategori_nama,
        ];

        Kategori::where('kategori_id', $id)->update($data);

        return redirect()->route('admin.kategori', ['action' => 'show'])->with('success', 'Kategori ' . $request->kategori_nama . ' berhasil diupdate!');
    }

    public static function delete($id)
    {
        Kategori::where('kategori_id', $id)->delete();
    }
}
