<?php

namespace App\Http\Requests;

use Flasher\Laravel\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
                "name"=>['required' ,'string' ,'min:3'],
                "desc"=>['required' ,'string' ,'min:10' ],
                "category_id"=>['exists:categories,id'],
                "comment_able"=>['in:on,off,1,0'],
                "images"=>['nullable'],
                "images.*"=>['image' ,'mimes:png,jpg'],
                "small_desc"=>['required' ,'min:20','max:170'],
                'status'=>['nullable','in:1,0'],

            ];





        // $data = [
        //     "name" => ['required', 'string', 'min:3'],
        //     "desc" => ['required', 'string', 'min:10'],
        //     "category_id" => ['exists:categories,id'],
        //     "comment_able" => ['in:on,off,1,0'],
        //         "images.*"=>['image' ,'mimes:png,jpg'],

        //     "small_desc" => ['required', 'min:20', 'max:170'],
        //     'status' => ['nullable', 'in:1,0'],
        // ];

        // if ($this->is('api/account/posts/update/*')) {
        //     $data['images'] = ['nullable'];

        // } else {
        //     $data['images'] = ['required'];

        // }

        // return $data;
    }
}
