<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SimpanBukuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'buku_penulis_id' => 'required',
            'buku_kategori_id' => 'required',
            'buku_penerbit_id' => 'required',
            'buku_rak_id' => 'required',
            'buku_judul' => 'max:40|required',
            'buku_isbn' => 'max:16|numeric|required',
            'buku_thnterbit' => 'max:4|numeric|required',
        ];
    }
}


/*
Inputan kode buku maksimal berisi 4 huruf, dan inputan ini wajib diisi.
Inputan nama buku, penerbit buku, dan penulis buku minimal berisi 10 huruf, maksimal berisi 40 huruf dan wajib diisi.
Inputan tahun terbit maksimal berisi 4 angka dan inputan ini boleh dikosongkan nilainya.
Error Validasi yang telah dibuat harus ditampilkan di bawah tiap-tiap inputan yang sesuai.

<input name="bookcode" placeholder="Kode Buku"></br>
<input name="bookname" placeholder="Nama Buku"></br>
<input name="publisher" placeholder="Penerbit Buku"></br>
<input name="year" placeholder="Tahun Terbit"></br>
<input name="writer" placeholder="Penulis Buku"></br>

*/