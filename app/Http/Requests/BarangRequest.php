<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode_barang' => 'required|string|max:30',
            'nama_barang' => 'required|string|max:150',
            'kategori_id' => 'required|integer',
            'satuan_id' => 'required|integer',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ];
    }
}
