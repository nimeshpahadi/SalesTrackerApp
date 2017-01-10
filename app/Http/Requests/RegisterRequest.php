<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        switch ($this->method()){
            case 'POST':{
                return [
                    'fullname' => 'required|max:255',
                    'username' => 'required|max:255|unique:users',
                    'department' => 'required',
                    'role' => 'required',
                    'reportsto' => 'required',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:6|confirmed',
                    'contact' => 'required|min:10|unique:users',
                ];
            }

            case 'PATCH': {
               return[
                   'password' => 'required|min:6|confirmed',
                   ];
            }
            case 'PUT':
                {
                    return [
                        'fullname' => 'required|max:255',
                        'username' => 'required|max:255',
                        'department' => 'required',
                        'role' => 'required',
                        'reportsto' => 'required',
                        'email' => 'required|email|max:255',
                        'contact' => 'required|min:10',
                    ];
                }
            default:break;
    }
}
}
