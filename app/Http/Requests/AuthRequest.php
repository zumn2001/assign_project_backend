<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class AuthRequest extends FormRequest
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
        if (request()->route()->getName() == 'register') {
            return [
                "name" => "required|max:20",
                "email" => "required|email|unique:users,email",
                "password" => "required|min:4|max:20",
            ];
        } else {
            return [
                "email" => "required|email",
                "password" => "required|min:4|max:20",
            ];
        }

    }
    public function messages()
    {
        return [
            'required' => 'You must fill :attribute'
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator , response()->json([
            'errors' => $validator->errors()
        ] , 403));
    }
}
