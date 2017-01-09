<?php
/**
 * Created by PhpStorm.
 * User: trees
 * Date: 12/7/16
 * Time: 1:21 PM
 */

namespace App\SalesTracker\Services\ApiValidation;


use Illuminate\Support\Facades\Validator;

class MinuteValidation
{
    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check($request)
    {
        $minute = $this->minuteValidator($request);

        $errors = $minute->errors()->toArray();

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
    public function minuteValidator($data)
    {
        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";

        return Validator::make($data,[

            'user_id'        => 'required|integer',
            'distributor_id' => 'required|integer',
            'report'         => 'required|max:500',
            'latitude'       => array('required', 'regex:'.$regex),
            'longitude'      => array('required', 'regex:'.$regex),

        ]);
    }
}