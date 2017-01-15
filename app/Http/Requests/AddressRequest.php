<?php
/**
 * Created by PhpStorm.
 * User: prakash
 * Date: 11/30/16
 * Time: 1:21 AM
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'type' => 'required',
            'zone' => 'required',
            'district' => 'required',
            'city' => 'required|max:255',
            'mobile' => 'required|min:10',
            'phone' => 'required|min:6',
            'latitude' => 'required',
            'longitude' => 'required',
            'fax' => 'min:6',

        ];


    }
}