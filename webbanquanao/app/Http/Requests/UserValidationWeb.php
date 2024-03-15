<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserValidationWeb extends FormRequest
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
            "name"=>"required|min:3",
            "email"=> "required|email",
            "phone"=>"required|digits:10",
            "password"=> "required|min:8",
            "address"=> "required|min:5",
            "role"=> "required",
            "filepath"=> "required",
            "desc"=>"required"
        ];
    }
}
