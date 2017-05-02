<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            //
              'business_name' => 'required|min:2|max:150',
              'business_phone'=>'required|numeric|min:10',
              'business_email'=> 'unique:clients,business_email',
              'business_zip'=>'max:5',
              'state'=>'min:2|max:3',
              'avatar'=>'max:1024'
        ];
    }
}
