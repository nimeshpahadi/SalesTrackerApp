<?php
/**
 * Created by PhpStorm.
 * User: prakash
 * Date: 11/24/16
 * Time: 10:05 PM
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class GuaranteeRequest extends FormRequest
{
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
            'distributor_id' => 'required|max:255',
            'type' => 'required',
        ];
    }
}