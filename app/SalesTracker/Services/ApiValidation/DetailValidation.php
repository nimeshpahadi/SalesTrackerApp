<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/23/16
 * Time: 10:33 AM
 */

namespace App\SalesTracker\Services\ApiValidation;

use Illuminate\Support\Facades\Validator;

class DetailValidation
{
    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check($request)
    {
        $detail = $this->detailValidator($request);

        $errors = $detail->errors()->toArray();

        if (!empty($errors)) {

            $response = [

                "status"       => "false",
                "token_status" => "true",
                "message"      => $errors

            ];

            return response()->json($response);
        }
    }

    /**
     * @param $data
     * @return mixed
     */
    public function detailValidator($data)
    {
        return Validator::make($data, [

            'company_name' => 'required|max:255|unique:distributor_details',
            'contact_name' => 'required|max:255',
            'email'        => 'email|unique:distributor_details',
            'mobile'       => 'required|regex:/[0-9]{10}/|unique:distributor_details',
            'phone'        => 'required|regex:/[0-9]{9}/',
            'zone'         => 'required',
            'district'     => 'required',
            'latitude'     => 'required',
            'longitude'    => 'required',
            'vat_no'       => 'required'

        ]);
    }
}