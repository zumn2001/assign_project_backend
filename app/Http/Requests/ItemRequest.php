<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'item_name' => 'required',
            'owner_name' => 'required',
            'category_id' => 'required',
            'phone' => 'required',
            'price' => 'required',
            'address' => 'required',
            'location' => 'required',
            'description' => 'required',
            'item_condition' => 'required',
            'item_type' => 'required',
            'status' => 'required',
            'image_id' => 'required'
         ];
    }
}
