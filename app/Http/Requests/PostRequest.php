<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required',
            'slug' => 'required',
            'body' => 'nullable',
            'post_type' => 'required', 
            'status' => 'required',
            'is_headline' => 'required',
            'is_main_side' => 'required',
            'organization_id' => 'required',
            'shared_by' => 'nullable',
            'shared_status' => 'nullable',
            'feature_image' => 'nullable',
            'category_id' => 'required',
            'created_by' => 'required',
            'updated_by' => 'nullable',
        ];
    }
}
