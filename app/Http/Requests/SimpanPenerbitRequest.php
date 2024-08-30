<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SimpanPenerbitRequest extends FormRequest
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
            'penerbit_nama' => 'max:50|required',
            'penerbit_alamat' => 'max:50|required',
            'penerbit_notelp' => 'max:13|required',
            'penerbit_email' => 'max:50|required',
        ];
    }
}
