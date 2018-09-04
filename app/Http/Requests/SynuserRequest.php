<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SynuserRequest extends FormRequest{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        $rules = [
            'user_id' => 'required|numeric',
            'name' => 'required|string'
        ];
        return $rules;
    }


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'user_id.required' => config('exceptions.USERID_REQUIRED'),
            'user_id.numeric' => config('exceptions.USERID_NUMERIC'),
            'name.required' => config('exceptions.USERNAME_REQUIRED'),
            'name.string' => config('exceptions.USERNAME_STRING'),
        ];
    }


}
