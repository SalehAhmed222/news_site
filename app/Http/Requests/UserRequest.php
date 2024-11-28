<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=>['required','string','min:2'],
            'username'=>['required','unique:users,username'],
            'email'=>['required','unique:users,email'],
            'phone'=>['required','unique:users,phone'],
            'country'=>['required','min:2','max:15'],
            'city'=>['required','min:2','max:15'],
            'street'=>['required','min:2','max:15'],
            'status'=>['in:0,1'],
            'email_verified_at'=>['in:0,1'],
            'image'=>['required' ,'mimes:png,jpg'],
            'password'=>['required','confirmed'],
            'password_confirmation'=>['required'],

        ];
    }
}
