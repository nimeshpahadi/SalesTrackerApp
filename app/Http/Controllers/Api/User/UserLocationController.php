<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/29/16
 * Time: 1:52 PM
 */

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\SalesTracker\Services\Api\User\UserLocationService;
use App\SalesTracker\Services\ApiValidation\LocationValidation;
use Illuminate\Http\Request;

class UserLocationController extends Controller
{
    /**
     * @var UserLocationService
     */
    private $locationService;
    /**
     * @var LocationValidation
     */
    private $locationValidation;

    /**
     * UserLocationController constructor.
     * @param UserLocationService $locationService
     * @param LocationValidation $locationValidation
     */
    public function __construct(UserLocationService $locationService, LocationValidation $locationValidation)
    {
        $this->locationService    = $locationService;
        $this->locationValidation = $locationValidation;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createUserLocation(Request $request)
    {
        $data = $request->all();

        $validation = $this->locationValidation->check($data);

        if ($validation!=null) {

            return $validation;
        }

        $location = $this->locationService->createLocationService($data);

        return response()->json($location);
    }
}