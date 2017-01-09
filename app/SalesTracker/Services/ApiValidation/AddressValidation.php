<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/23/16
 * Time: 2:22 PM
 */

namespace App\SalesTracker\Services\ApiValidation;

use Illuminate\Support\Facades\Validator;

class AddressValidation
{
    /**
     * @param $address
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkAddress($address)
    {
        $t = $this->addressValidator($address);
        $errors = $t->errors()->toArray();
        if (!empty($errors)) {
            $r['message'] = $errors;
            $r['status'] = false;

            return response()->json($r);
        }
    }

    /**
     * @param $data
     * @return mixed
     */
    public function addressValidator($data)
    {
        return Validator::make($data, [
            'distributor_id' => 'required|integer',
            'type'           => 'required',
            'district'       => 'required',
            'city'           => 'required',
            'latitude'       => 'required',
            'longitude'      => 'required',
            'mobile'         => 'required|regex:/[0-9]{10}/',
            'phone'          => 'required|regex:/[0-9]{9}/',
            'fax'            => 'required|regex:/[0-9]{9}/',
            'zone'           => 'required'

        ]);
    }
}