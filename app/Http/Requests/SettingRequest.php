<?php

namespace App\Http\Requests;

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
           "site_name"=>['required','string','min:3'],
           "email"=>['required','email'],
           "phone"=>['required','numeric'],
           "country"=>['required','string','min:3'],
           "city"=>['required','string','min:3'],
           "street"=>['required','string','min:3'],
           "facebook"=>['required'],
           "twitter"=>['required'],
           "instagram"=>['required'],
           "youtube"=>['required'],
           "small_desc"=>['required','min:120'],
           "logo"=>['nullable','image'],
           "favicon"=>['nullable','image'],

        ];
    }
}
