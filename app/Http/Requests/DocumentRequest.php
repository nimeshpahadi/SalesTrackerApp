<?php
/**
 * Created by PhpStorm.
 * User: nimesh
 * Date: 4/6/17
 * Time: 12:31 PM
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => 'required|integer|max:255',
            'document_type' => 'required|max:255',
            'document_name' => 'required',
        ];
    }
}