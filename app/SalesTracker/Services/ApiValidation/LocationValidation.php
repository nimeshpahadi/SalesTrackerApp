<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/29/16
 * Time: 1:54 PM
 */

namespace App\SalesTracker\Services\ApiValidation;

use Illuminate\Support\Facades\Validator;

class LocationValidation
{
    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check($request)
    {
        $t = $this->locationValidator($request);
        $errors = $t->errors()->toArray();

        if (!empty($errors)) {

            $r['message'] = $errors;
            $r['status']  = "false";

            return response()->json($r);
        }
    }

    /**
     * @param $data
     * @return mixed
     */
    public function locationValidator($data)
    {
        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";

        $v = Validator::make($data, [
            'user_id'   => 'required|integer',
            'latitude'  => array('required', 'regex:'.$regex),
            'longitude' => array('required', 'regex:'.$regex),
        ]);

        return $v;
    }
}