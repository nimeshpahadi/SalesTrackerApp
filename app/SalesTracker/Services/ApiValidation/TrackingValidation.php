<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/24/16
 * Time: 2:54 PM
 */

namespace App\SalesTracker\Services\ApiValidation;

use Illuminate\Support\Facades\Validator;

class TrackingValidation
{
    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check($request)
    {
        $visit = $this->trackingValidator($request);

        $errors = $visit->errors()->toArray();

        if (!empty($errors)) {

            $response = [

                "status"  => "false",
                "message" => $errors

            ];

            return response()->json($response);
        }
    }

    /**
     * @param $data
     * @return mixed
     */
    public function trackingValidator($data)
    {
        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";

        return Validator::make($data, [

            'user_id'              => 'required|integer',
            'distributor_id'       => 'required|integer',
            'stage'                => 'required|max:255',
            'business_probability' => 'required|integer',
            'activity'             => 'required|max:255',
            'latitude'             => array('required', 'regex:'.$regex),
            'longitude'            => array('required', 'regex:'.$regex),

        ]);
    }
}