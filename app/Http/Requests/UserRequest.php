<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'nama' => 'required',
            'email' => ['required', 'email:dns', Rule::unique(User::class)->ignore($this->route('user'))],
            'password' => 'nullable|confirmed',
            'role' => ['required', Rule::in(['admin', 'pegawai'])],
        ];

        if ($this->isMethod('POST')) {
            $rules['password'] = 'required|confirmed';
        }

        return $rules;
    }
}
