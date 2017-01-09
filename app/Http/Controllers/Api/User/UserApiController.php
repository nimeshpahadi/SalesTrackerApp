<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\SalesTracker\Services\Api\User\UserApiService;
use Illuminate\Http\Request;

class UserApiController extends Controller
{

    /**
     * @var UserApiService
     */
    public $service;

    /**
     * UserApiController constructor.
     * @param UserApiService $service
     */
    public function __construct(UserApiService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function showLogin(Request $request)
    {
        $data = $request->all();

        $response = $this->service->login($data);

        return response()->json($response);

    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getId($id, Request $request)
    {
        $id = $this->service->getServiceId($id, $request);

        return response()->json($id);
    }
}
