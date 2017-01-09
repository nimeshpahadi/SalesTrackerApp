<?php
/**
 * Created by PhpStorm.
 * User: trees
 * Date: 12/7/16
 * Time: 11:29 AM
 */

namespace App\Http\Controllers\Api\Distributor;


use App\Http\Controllers\Controller;
use App\SalesTracker\Services\Api\Distributor\DistributorMinuteService;
use App\SalesTracker\Services\ApiValidation\MinuteValidation;
use Illuminate\Http\Request;

class DistributorMinuteController extends Controller
{
    /**
     * @var DistributorMinuteService
     */
    private $minuteService;
    /**
     * @var MinuteValidation
     */
    private $minuteValidation;

    /**
     * DistributorMinuteController constructor.
     * @param DistributorMinuteService $minuteService
     * @param MinuteValidation $minuteValidation
     */
    public function __construct(DistributorMinuteService $minuteService, MinuteValidation $minuteValidation)
    {
        $this->minuteService    = $minuteService;
        $this->minuteValidation = $minuteValidation;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createMinute(Request $request)
    {
        $data = $request->all();

        $t = $this->minuteValidation->check($data);

        if ($t!=null) {

            return $t;
        }

        $response = $this->minuteService->createMinuteService($data);

        return response()->json($response);
    }
}