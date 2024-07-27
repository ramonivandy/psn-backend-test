<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'title'         => 'required|string|max:255',
            'name'          => 'required|string',
            'gender'        => 'required|string',
            'phone_number'  => 'required|numeric|min_digits:8|max_digits:14',
            'image'         => 'required|string|',
            'email'         => 'required|email',
        ];
    }
}
