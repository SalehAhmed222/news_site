<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' =>['required' ,'max:20','string'],
            'email' =>['required' ,'string','email'],
            'title' =>['required' ,'max:20','string'],
            'body' =>['required' ,'max:200','string'],
            'phone' =>['required' ,'numeric'],


        ];
    }
}
