<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'nip' => 'required',
            'nik' => 'required',
            'phone' => 'nullable',
            'address' => 'required',
            'email' => 'nullable|email',
            'password' => 'required',
            'organization_id' => 'required',
            'is_online' => 'required',
            'is_active' => 'required',
        ];
    }
}
