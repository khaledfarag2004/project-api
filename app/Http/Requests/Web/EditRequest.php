<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            "mobile" => "string|min:11|max:11|regex:/^([0-9\s\-\+\(\)]*)$/",
            "address" => "string",
            "role" => "required|string|in:user,admin",
            "country" => "string",
            "is_verified" => "required|boolean",
        ];
    }
}
