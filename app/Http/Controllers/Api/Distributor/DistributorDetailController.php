<?php

namespace App\Http\Controllers\Api\Distributor;


use App\Http\Controllers\Controller;
use App\SalesTracker\Services\Api\Distributor\DistributorDetailService;
use App\SalesTracker\Services\ApiValidation\DetailValidation;
use Illuminate\Http\Request;

class DistributorDetailController extends Controller
{
    /**
     * @var DistributorDetailService
     */
    public $detailService;
    /**
     * @var DetailValidation
     */
    public $detailValidation;

    /**
     * DistributorDetailController constructor.
     * @param DistributorDetailService $detailService
     * @param DetailValidation $detailValidation
     */
    public function __construct(DistributorDetailService $detailService, DetailValidation $detailValidation)
    {
        $this->detailService    = $detailService;
        $this->detailValidation = $detailValidation;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createDetails(Request $request)
    {
        $data = $request->all();

        $t = $this->detailValidation->check($data);

        if ($t != null) {
            return $t;
        }

        $response = $this->detailService->createDetailService($data);

        return response()->json($response);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDetails($id, Request $request)
    {
        $data = $this->detailService->getService($id, $request);

        return response()->json($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDetailsList(Request $request)
    {
        $detailList = $this->detailService->getServiceList($request);

        return response()->json($detailList);
    }
}