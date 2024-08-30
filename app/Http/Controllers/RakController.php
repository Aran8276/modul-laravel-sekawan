<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\SimpanRakRequest;

class RakController extends Controller
{
    public function store(SimpanRakRequest $request)
    {
        $id = Str::random(16);

        $data = [
            'rak_id' => $id,
            'rak_nama' => $request->rak_nama,
            'rak_lokasi' => $request->rak_lokasi,
            'rak_kapasitas' => $request->rak_kapasitas,
        ];

        Rak::create($data);

        return redirect()->route('admin.buku', ['action' => 'show'])->with('success', 'Rak baru berhasil ditambahkan!');
    }

    public function update(SimpanRakRequest $request, $id)
    {
        $data = [
            'rak_nama' => $request->rak_nama,
            'rak_lokasi' => $request->rak_lokasi,
            'rak_kapasitas' => $request->rak_kapasitas,
        ];

        Rak::where('rak_id', $id)->update($data);

        return redirect()->route('admin.buku', ['action' => 'show'])->with('success', 'Rak ' . $request->rak_nama . ' berhasil diupdate!');
    }

    public static function delete($id)
    {
        Rak::where('rak_id', $id)->delete();
    }
}
