<?php
/**
 * Created by PhpStorm.
 * User: nimesh
 * Date: 4/9/17
 * Time: 10:48 AM
 */

namespace App\SalesTracker\Services\ApiValidation;


use Illuminate\Support\Facades\Validator;

class DocumentValidation
{
    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check($request)
    {
        $detail = $this->documentValidator($request);

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
    public function documentValidator($data)
    {
        return Validator::make($data, [
            'customer_id' => 'required|integer|max:255',
            'document_type' => 'required|max:255',
            'document_name' => 'mimes:jpeg,jpg,png|required',
        ]);
    }
}