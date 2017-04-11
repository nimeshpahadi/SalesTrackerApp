<?php
/**
 * Created by PhpStorm.
 * User: nimesh
 * Date: 4/10/17
 * Time: 2:35 PM
 */

namespace App\Http\Controllers\Api\Distributor;


use App\Http\Controllers\Controller;
use App\SalesTracker\Services\Api\Distributor\CustomerAreaApiService;
use App\SalesTracker\Services\ApiValidation\AreaValidation;
use Illuminate\Http\Request;

class CustomerAreaApiController extends Controller
{
    /**
     * @var CustomerAreaApiService
     */
    private $areaApiService;
    /**
     * @var AreaValidation
     */
    private $areaValidation;

    /**
     * CustomerAreaApiController constructor.
     * @param CustomerAreaApiService $areaApiService
     * @param AreaValidation $areaValidation
     */
    public function __construct(CustomerAreaApiService $areaApiService, AreaValidation $areaValidation)
    {
        $this->areaApiService = $areaApiService;
        $this->areaValidation = $areaValidation;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $data = $request->all();

        $t = $this->areaValidation->check($data);

        if ($t != null)
        {
            return $t;
        }

        $response = $this->areaApiService->create($data);

        return response()->json($response);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, $id)
    {
        $data = $request->all();

        $t = $this->areaValidation->editValidation($data);

        if ($t != null)
        {
            return $t;
        }

        $response = $this->areaApiService->edit($data, $id);

        return response()->json($response);
    }
}