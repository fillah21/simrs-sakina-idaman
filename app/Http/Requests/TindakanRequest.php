<?php

namespace App\Http\Requests;

use App\Models\Tindakan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TindakanRequest extends FormRequest
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
            'layanan_id' => 'required',
            'nama_tindakan' => ['required', Rule::unique(Tindakan::class)->ignore($this->route('tindakan'))],
            'harga_tindakan' => 'required|numeric',
        ];
    }
}
