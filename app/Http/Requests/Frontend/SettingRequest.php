<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'name'=>['required' ,'max:30','min:3'],
            'username'=>['required' ,'max:30','min:3','unique:users,username,'.auth()->user()->id],
            'email'=>['required' ,'email','unique:users,email,'.auth()->user()->id],
            'phone'=>['required' ,'numeric','unique:users,phone,'.auth()->user()->id],
            'country'=>['required' ,'max:30','min:3'],
            'city'=>['required' ,'max:30','min:3'],
            'street'=>['required' ,'max:30','min:3'],
            'image'=>['nullable' ,'image' ,'mimes:png,jpg'],


        ];
    }
}
