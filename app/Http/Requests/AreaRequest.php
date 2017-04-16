<?php
/**
 * Created by PhpStorm.
 * User: nimesh
 * Date: 4/16/17
 * Time: 11:57 AM
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class AreaRequest extends FormRequest
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
        switch ($this->method())
        {
            case 'POST': {
                return [
                    'district' => 'required|max:255',
                    'area_name' => 'required|max:255',
                    'places' => 'required|max:255',
                ];
            }

            case 'PUT':
            case 'PATCH': {
            return [
                'district' => 'required|max:255',
                'area_name' => 'required|max:255',
                'places' => 'required|max:255',
            ];
        }
            default:break;
        }
    }
}