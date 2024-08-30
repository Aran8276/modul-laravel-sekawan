<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Support\Str;
use App\Http\Requests\SimpanPenerbitRequest;

class PenerbitController extends Controller
{
    public function store(SimpanPenerbitRequest $request)
    {
        $id = Str::random(16);

        $data = [
            'penerbit_id' => $id,
            'penerbit_nama' => $request->penerbit_nama,
            'penerbit_alamat' => $request->penerbit_alamat,
            'penerbit_notelp' => $request->penerbit_notelp,
            'penerbit_email' => $request->penerbit_email,
        ];

        Penerbit::create($data);

        return redirect()->route('admin.penerbit', ['action' => 'show'])->with('success', 'Penerbit baru berhasil ditambahkan!');
    }

    public function update(SimpanPenerbitRequest $request, $id)
    {
        $data = [
            'penerbit_nama' => $request->penerbit_nama,
            'penerbit_alamat' => $request->penerbit_alamat,
            'penerbit_notelp' => $request->penerbit_notelp,
            'penerbit_email' => $request->penerbit_email,
        ];

        Penerbit::where('penerbit_id', $id)->update($data);

        return redirect()->route('admin.penerbit', ['action' => 'show'])->with('success', 'Penerbit ' . $request->penerbit_nama . ' berhasil diupdate!');
    }

    public static function delete($id)
    {
        Penerbit::where('penerbit_id', $id)->delete();
    }
}
