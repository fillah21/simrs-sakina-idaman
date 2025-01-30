<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PendaftaranRequest extends FormRequest
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
            'wajib_rujukan_layanan' => 'required',
            'wajib_rujukan_jaminan' => 'required',
            'wajib_keterangan_jaminan' => 'required',
            'pasien_id' => 'required',
            'waktu_kunjungan' => 'required',
            'instalasi_id' => 'required',
            'layanan_id' => 'required',
            'dokter_id' => 'required',
            'jaminan_id' => 'required',
            'no_jaminan' => 'nullable',
            'nama_penjamin' => 'nullable',
            'cara_masuk' => 'required',
            'rujukan' => 'nullable',
            'keluhan' => 'required',
            'tindakan_id' => 'required',
        ];

        if($this->input('wajib_keterangan_jaminan') == 1) {
            $rules['no_jaminan'] = "required";
            $rules['nama_penjamin'] = "required";
        }

        if($this->input('wajib_rujukan_layanan') == 1 && $this->input('wajib_rujukan_jaminan') == 1) {
            $rules['rujukan'] = "required";
        }

        return $rules;
    }
}
