<?php
/**
 * Created by PhpStorm.
 * User: trees
 * Date: 1/12/17
 * Time: 10:55 AM
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";

        return [
            'discount'        => 'required|integer',
            'vat'             => 'required|integer',
            'shipping_charge' => 'required|integer',
            'grand_total'     => array('required', 'regex:'.$regex),
        ];
    }
}