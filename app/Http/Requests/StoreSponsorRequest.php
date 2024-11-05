<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSponsorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:sponsors,email',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The sponsor name is required.',
            'name.string' => 'The sponsor name must be a string.',
            'name.max' => 'The sponsor name may not be greater than 255 characters.',
            'email.required' => 'The email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already associated with another sponsor.',
            'phone.max' => 'The phone number may not be greater than 20 characters.',
            'company.max' => 'The company name may not be greater than 255 characters.',
        ];
    }
}
