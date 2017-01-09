<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/24/16
 * Time: 2:47 PM
 */

namespace App\Http\Controllers\Api\Distributor;


use App\Http\Controllers\Controller;
use App\SalesTracker\Services\Api\Distributor\DistributorTrackingService;
use App\SalesTracker\Services\ApiValidation\TrackingValidation;
use Illuminate\Http\Request;

class DistributorTrackingController extends Controller
{
    /**
     * @var DistributorTrackingService
     */
    public $trackingService;
    /**
     * @var TrackingValidation
     */
    public $trackingValidation;

    /**
     * DistributorTrackingController constructor.
     * @param DistributorTrackingService $trackingService
     * @param TrackingValidation $trackingValidation
     */
    public function __construct(DistributorTrackingService $trackingService, TrackingValidation $trackingValidation)
    {
        $this->trackingService    = $trackingService;
        $this->trackingValidation = $trackingValidation;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createTracking(Request $request)
    {
        $data = $request->all();

        $t = $this->trackingValidation->check($data);

        if ($t != null) {

            return $t;
        }

        $response = $this->trackingService->createTrackingService($data);

        return response()->json($response);
    }
}