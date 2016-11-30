<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Giang_VienRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => "required|max:50|min:3",
            'mgv'  => "max:50|min:1",
            'email'=> "email|max:50|min:3"
            //
        ];
    }

}
