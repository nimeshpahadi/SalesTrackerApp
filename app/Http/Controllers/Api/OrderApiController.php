<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/28/16
 * Time: 4:07 PM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\SalesTracker\Services\Api\OrderApiService;
use App\SalesTracker\Services\ApiValidation\OrderValidation;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    /**
     * @var OrderApiService
     */
    public $apiService;
    /**
     * @var OrderValidation
     */
    public $orderValidation;

    /**
     * OrderApiController constructor.
     * @param OrderApiService $apiService
     * @param OrderValidation $orderValidation
     */
    public function __construct(OrderApiService $apiService, OrderValidation $orderValidation)
    {
        $this->apiService      = $apiService;
        $this->orderValidation = $orderValidation;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createOrder(Request $request)
    {
        $data = $request->all();

        $validation = $this->orderValidation->check($data);

        if($validation!=null) {
            return $validation;
        }

        $orders = $this->apiService->createOrderService($data);

        return response()->json($orders);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrder($id, Request $request)
    {
        $orderData = $this->apiService->getServiceOrder($id, $request);

        return response()->json($orderData);
    }

    /**
     * @param Request $request
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function updateOrder(Request $request, $id)
    {
        $data = $request->all();

        $validation = $this->orderValidation->checkUpdate($data);

        if($validation!=null) {
            return $validation;
        }

        $ordersUpdate = $this->apiService->updateOrderService($request, $id);

        return $ordersUpdate;
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserOrder(Request $request, $id)
    {
        $orderList = $this->apiService->getUserOrderList($request, $id);

        return response()->json($orderList);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDistOrder(Request $request, $id)
    {
        $orderList = $this->apiService->getDistOrderList($request, $id);

        return response()->json($orderList);
    }
}