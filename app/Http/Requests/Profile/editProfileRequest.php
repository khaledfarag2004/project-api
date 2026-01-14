<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class editProfileRequest extends FormRequest
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
            'email' => 'email|unique:users|nullable',
            'mobile' => 'numeric|unique:users|nullable',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'name' => 'string|nullable',
            'country' => 'string|nullable',
            'the-address' => 'string|nullable',
        ];
    }
}
