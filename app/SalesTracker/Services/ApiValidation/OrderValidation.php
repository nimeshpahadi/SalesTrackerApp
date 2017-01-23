<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/28/16
 * Time: 4:18 PM
 */

namespace App\SalesTracker\Services\ApiValidation;

use Illuminate\Support\Facades\Validator;

class OrderValidation
{
    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check($request)
    {
        $order = $this->orderValidator($request);

        $errors = $order->errors()->toArray();

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
    public function orderValidator($data)
    {
        return Validator::make($data, [

            'user_id'                => 'required|integer',
            'distributor_id'         => 'required|integer',
            'product_id'             => 'required|integer',
            'quantity'               => 'required|integer',
            'price'                  => 'required|integer',
            'priority'               => 'required|max:255|alpha',
            'proposed_delivery_date' => 'required|date',
            'order_remark'           => 'required'

        ]);
    }

    public function checkUpdate($request)
    {
        $orderUpdate = $this->orderUpdateValidator($request);

        $errors = $orderUpdate->errors()->toArray();

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
    public function orderUpdateValidator($data)
    {
        return Validator::make($data, [

            'product_id'             => 'required|integer',
            'quantity'               => 'required|integer',
            'price'                  => 'required|integer',
            'priority'               => 'required|max:255|alpha',
            'proposed_delivery_date' => 'required|date',
            'order_remark'           => 'required'

        ]);
    }
}