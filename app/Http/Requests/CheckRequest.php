<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckRequest extends FormRequest{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        $rules = [
            'scopes' => 'required|array'
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
            'scopes.required' => config('exceptions.SCOPE_REQUIRED'),
            'scopes.array' => config('exceptions.SCOPE_ARRAY')
        ];
    }


}
