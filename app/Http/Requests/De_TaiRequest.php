<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class De_TaiRequest extends FormRequest
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
        	'gvid'       => 'required|integer',
        	'ten_de_tai' => 'required|string|min:3|max:999'
            //
        ];
    }
}
