<?php
/**
 * Created by PhpStorm.
 * User: trees
 * Date: 12/8/16
 * Time: 12:57 PM
 */

namespace App\SalesTracker\Services\ApiValidation;


use Illuminate\Support\Facades\Validator;

class PaymentValidation
{
    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check($request)
    {
        $payment = $this->paymentValidator($request);

        $errors = $payment->errors()->toArray();

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
    public function paymentValidator($data)
    {
        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";

        return Validator::make($data, [

            "user_id"        => 'required|integer',
            "distributor_id" => 'required|integer',
            "amount"         => array('required', 'regex:'.$regex),
            "type"           => 'required|alpha'

        ]);
    }
}