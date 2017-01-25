<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/21/16
 * Time: 10:19 PM
 */

namespace App\Http\Controllers\Api\Distributor;

use App\Http\Controllers\Controller;
use App\SalesTracker\Services\Api\Distributor\DistributorAddressService;
use App\SalesTracker\Services\ApiValidation\AddressValidation;
use Illuminate\Http\Request;

class DistributorAddressController extends Controller
{
    /**
     * @var DistributorAddressService
     */
    public $addressService;
    /**
     * @var AddressValidation
     */
    public $addressValidation;

    /**
     * DistributorAddressController constructor.
     * @param DistributorAddressService $addressService
     * @param AddressValidation $addressValidation
     */
    public function __construct(DistributorAddressService $addressService, AddressValidation $addressValidation)
    {
        $this->addressService    = $addressService;
        $this->addressValidation = $addressValidation;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createAddress(Request $request)
    {
        $data = $request->all();

        $t = $this->addressValidation->checkAddress($data);

        if ($t != null) {

            return $t;
        }

        $response = $this->addressService->addressService($data);

        return response()->json($response);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAddress(Request $request, $id)
    {

        $data = $request->all();

        $t = $this->addressValidation->checkAddress($data);

        if ($t != null) {

            return $t;
        }

        $response = $this->addressService->updateAddressService($data, $id);

        return response()->json($response);
    }
}