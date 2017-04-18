<?php

namespace App\Http\Requests;

use App\SalesTracker\Entities\Distributor\DistributorDetails;
use Illuminate\Foundation\Http\FormRequest;

class DistributorDetailRequest extends FormRequest
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
                    'company_name' => 'required|max:255|unique:distributor_details',
                    'contact_name' => 'required|max:255',
                    'email' => 'required|email|unique:distributor_details',
                    'mobile' => 'required|min:10|unique:distributor_details',
                    'phone' => 'required|min:6',
                    'zone' => 'required|max:25',
                    'district' => 'required|max:25',
                    'latitude' => 'required',
                    'longitude' => 'required',
                    'lead_source' => 'required',
                    'type' => 'required',
                    'open_date' => 'required',
                    'area_id' => 'required|integer',
                ];
            }
            case 'PUT':
            case 'PATCH':
                {
                return [
                    'company_name' => 'required|max:255',/*|unique:distributor_details,'.$dis->id,*/
                    'contact_name' => 'required|max:255',
                    'email' => 'required|email',/*|unique:distributor_details,'.$dis->id,*/
                    'mobile' => 'required|min:10',/*|unique:distributor_details,'.$dis->id,*/
                    'phone' => 'required|min:6',
                    'zone' => 'required|max:25',
                    'district' => 'required|max:25',
                    'latitude' => 'required',
                    'longitude' => 'required',
                    'lead_source' => 'required',
                    'type' => 'required',
                    'open_date' => 'required',
                    'area_id' => 'required|integer',
                ];
            }
            default:break;
        }
    }
}
