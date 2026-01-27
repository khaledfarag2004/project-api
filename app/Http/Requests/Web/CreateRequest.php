<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            "name" => "required|string",
            "email" => "required|email",
            "password" => "required|string",
            "mobile" => "required|string|min:11|max:11|unique:users|regex:/^([0-9\s\-\+\(\)]*)$/",
            "country" => "string",
            "role" => "required|string|in:user,admin",
            "is_verified" => "required|boolean",

        ];
    }
}
