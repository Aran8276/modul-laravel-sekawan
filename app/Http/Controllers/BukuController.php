<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\SimpanBukuRequest;

class BukuController extends Controller
{
    public function store(SimpanBukuRequest $request)
    {
        $id = Str::random(16);

        $data = [
            'buku_id' => $id,
            'buku_penulis_id' => $request->buku_penulis_id,
            'buku_kategori_id' => $request->buku_kategori_id,
            'buku_penerbit_id' => $request->buku_penerbit_id,
            'buku_rak_id' => $request->buku_rak_id,
            'buku_judul' => $request->buku_judul,
            'buku_isbn' => $request->buku_isbn,
            'buku_thnterbit' => $request->buku_thnterbit,
        ];

        Buku::create($data);

        if ($request->hasFile('buku_gambar')) {
            $data = $request->file('buku_gambar');
            Buku::imageUpload($id, $data);
            return redirect()->route('admin.buku', ['action' => 'show'])->with('success', 'Buku baru berhasil ditambahkan!');
        }

        return redirect()->route('admin.buku', ['action' => 'show'])->with('success', 'Buku baru berhasil ditambahkan!');
    }

    public function update(SimpanBukuRequest $request, $id)
    {
        $data = [
            'buku_penulis_id' => $request->buku_penulis_id,
            'buku_kategori_id' => $request->buku_kategori_id,
            'buku_penerbit_id' => $request->buku_penerbit_id,
            'buku_rak_id' => $request->buku_rak_id,
            'buku_judul' => $request->buku_judul,
            'buku_isbn' => $request->buku_isbn,
            'buku_thnterbit' => $request->buku_thnterbit,
        ];

        Buku::where('buku_id', $id)->update($data);

        if ($request->hasFile('buku_gambar')) {
            $data = $request->file('buku_gambar');
            Buku::imageUpload($id, $data);
            return redirect()->route('admin.buku', ['action' => 'show'])->with('success', 'Buku baru berhasil ditambahkan!');
        }

        return redirect()->route('admin.buku', ['action' => 'show'])->with('success', 'Buku ' . $request->buku_nama . ' berhasil diupdate!');
    }

    public static function delete($id)
    {
        Buku::imageDelete($id);
        Buku::where('buku_id', $id)->delete();
    }
}
