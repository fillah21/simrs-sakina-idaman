<?php

namespace App\Http\Requests;

use App\Models\Agama;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AgamaRequest extends FormRequest
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
            'agama' => ['required', Rule::unique(Agama::class)->ignore($this->route('agama'))],
        ];
    }
}
