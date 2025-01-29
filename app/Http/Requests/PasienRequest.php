<?php

namespace App\Http\Requests;

use App\Models\Pasien;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PasienRequest extends FormRequest
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
        $rules = [
            'nama_pasien' => 'required',
            'nik' => ['required', 'max:16', 'min:16', Rule::unique(Pasien::class)->ignore($this->route('pasien'))],
            'jk' => ['required', Rule::in(['L', 'P'])],
            'alamat' => 'required',
            'status_nikah' => ['required', Rule::in(['Belum Menikah', 'Menikah', 'Janda/Duda'])],
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'provinsi_id' => 'required',
            'kabupaten_id' => 'required',
            'kecamatan_id' => 'required',
            'kelurahan_id' => 'required',
            'agama_id' => 'required',
            'pekerjaan_id' => 'required',
            'pendidikan_id' => 'required',
        ];

        // if ($this->isMethod('POST')) {
        //     $rules['password'] = 'required|confirmed';
        // }

        return $rules;
    }
}
