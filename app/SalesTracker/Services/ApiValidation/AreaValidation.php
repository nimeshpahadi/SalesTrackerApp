<?php
/**
 * Created by PhpStorm.
 * User: nimesh
 * Date: 4/10/17
 * Time: 4:20 PM
 */

namespace App\SalesTracker\Services\ApiValidation;


use Illuminate\Support\Facades\Validator;

class AreaValidation
{
    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check($request)
    {
        $detail = $this->documentValidator($request);

        $errors = $detail->errors()->toArray();

        if (!empty($errors))
        {
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
            'district' => 'required|max:255',
            'area_name' => 'required|max:255',
            'places' => 'required|max:255',
        ]);
    }
}