<?php

namespace App\Http\Requests;

use App\Models\Layanan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LayananRequest extends FormRequest
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
            'instalasi_id' => 'required',
            'inisial_layanan' => 'required',
            'nama_layanan' => ['required', Rule::unique(Layanan::class)->ignore($this->route('layanan'))],
            'harga_layanan' => 'required|numeric',
            'wajib_rujukan' => 'required',
        ];
    }
}
