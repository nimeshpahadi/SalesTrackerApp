<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/28/16
 * Time: 1:26 PM
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\SalesTracker\Services\Api\ProductApiService;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    /**
     * @var ProductApiService
     */
    public $apiService;

    /**
     * ProductApiController constructor.
     * @param ProductApiService $apiService
     */
    public function __construct(ProductApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductList(Request $request)
    {
        $products = $this->apiService->getServiceProduct($request);

        return response()->json($products);
    }
}