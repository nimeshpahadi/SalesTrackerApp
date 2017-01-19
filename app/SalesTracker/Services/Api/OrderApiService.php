<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/28/16
 * Time: 4:09 PM
 */

namespace App\SalesTracker\Services\Api;


use App\SalesTracker\Repositories\Api\BaseRepository;
use App\SalesTracker\Repositories\Api\OrderApiRepository;
use App\SalesTracker\Repositories\Api\User\UserApiRepository;

class OrderApiService extends BaseService
{
    /**
     * @var UserApiRepository
     */
    public $userApiRepository;
    /**
     * @var OrderApiRepository
     */
    public $orderApiRepository;
    /**
     * @var BaseRepository
     */
    private $baseRepository;

    /**
     * OrderApiService constructor.
     * @param OrderApiRepository $orderApiRepository
     * @param UserApiRepository $userApiRepository
     * @param BaseRepository $baseRepository
     */
    public function __construct(OrderApiRepository $orderApiRepository, UserApiRepository $userApiRepository,
                                BaseRepository $baseRepository)
    {
        $this->userApiRepository  = $userApiRepository;
        $this->orderApiRepository = $orderApiRepository;
        $this->baseRepository     = $baseRepository;
    }

    /**
     * @param $serviceOrder
     * @return array
     */
    public function createOrderService($serviceOrder)
    {
        if (!$this->validateToken($this->userApiRepository, $serviceOrder['api_token'])) {

            return $this->tokenMessage();
        }

        $this->storeData($this->baseRepository, $serviceOrder);

        $orders = [

            "user_id"                => $serviceOrder['user_id'],
            "distributor_id"         => $serviceOrder['distributor_id'],
            "product_id"             => $serviceOrder['product_id'],
            "quantity"               => $serviceOrder['quantity'],
            "price"                  => $serviceOrder['price'],
            "priority"               => $serviceOrder['priority'],
            "proposed_delivery_date" => $serviceOrder['proposed_delivery_date'],
            "remark"                 => $serviceOrder['remark']

        ];

            if ($this->orderApiRepository->createOrderRepo($orders)) {

                $resp = [

                    "status"       => "true",
                    "token_status" => "true",
                    "message"      => "Distributor Order created"

                ];

                return $resp;
            }

            $respo = [

                "status"       => "false",
                "token_status" => "true",
                "message"      => "Oops!!! something went wrong"

            ];

            return $respo;
    }

    /**
     * @param $id
     * @param $request
     * @return array
     */
    public function getServiceOrder($id, $request)
    {
        if(!$this->validateToken($this->userApiRepository, $request['api_token'])) {

            return $this->tokenMessage();
        }

        $orderDetails = $this->orderApiRepository->getOrderDetails($id);

        if ($orderDetails==null) {

            $query = [

                "status"       => "false",
                "token_status" => "true",
                "message"      => "Order not found"

            ];

            return $query;
        }

        $orderDetails = (array)$orderDetails[0];

        $data = [];
        $data["status"] = "true";
        $data["token_status"] = "true";

        $data['order_details'][] = [

            "product_id"             => $orderDetails['product_id'],
            "user_id"                => $orderDetails['user_id'],
            "distributor_id"         => $orderDetails['distributor_id'],
            "quantity"               => $orderDetails['quantity'],
            "priority"               => $orderDetails['priority'],
            "proposed_delivery_date" => $orderDetails['proposed_delivery_date'],
            "remark"                 => $orderDetails['remark']


        ];

        return $data;
    }

    /**
     * @param $request
     * @param $id
     * @return array
     */
    public function updateOrderService($request, $id)
    {
        if(!$this->validateToken($this->userApiRepository, $request['api_token'])) {

            return $this->tokenMessage();
        }

        $orders= [

            "product_id"             => $request['product_id'],
            "quantity"               => $request['quantity'],
            "price"                  => $request['price'],
            "priority"               => $request['priority'],
            "proposed_delivery_date" => $request['proposed_delivery_date'],
            "remark"                 => $request['remark']


        ];

        $data = $this->orderApiRepository->updateOrderRepo($orders, $id);

        if ($data==null) {

            $query = [

                "status"       => "false",
                "token_status" => "true",
                "message"      => "Order not found"

            ];

            return $query;
        }

            $resp = [

                "status"       => "true",
                "token_status" => "true",
                "message"      => "Order updated"

            ];

            return $resp;
    }

    /**
     * @param $request
     * @param $id
     * @return array
     */
    public function getUserOrderList($request, $id)
    {
        if (!$this->validateToken($this->userApiRepository, $request['api_token'])) {

            return $this->tokenMessage();
        }

        $currentDate = date('Y/m/d');

        $orderList = $this->orderApiRepository->getUserOrder($id, $currentDate);

        if ($orderList==null) {

            $response = [

                "status"  => "false",
                "message" => "Order not found"

            ];

            return $response;
        }

        $orderData                 = [];
        $orderData["status"]       = "true";
        $orderData["token_status"] = "true";

        foreach ($orderList as $list) {

            $orderData["orders_list"][] = [

                "id"                     => $list->id,
                "distributor_id"         => $list->distributor_id,
                "distributor_name"       => $list->contact_name,
                "product_id"             => $list->product_id,
                "product_category"       => $list->sub_category,
                "quantity"               => $list->quantity,
                "price"                  => $list->price,
                "priority"               => $list->priority,
                "proposed_delivery_date" => $list->proposed_delivery_date,
                "remark"                 => $list->remark


            ];
        }

        return $orderData;
    }

    /**
     * @param $request
     * @param $id
     * @return array
     */
    public function getDistOrderList($request, $id)
    {
        if (!$this->validateToken($this->userApiRepository, $request['api_token'])) {

            return $this->tokenMessage();
        }

        $orderList = $this->orderApiRepository->getDistOrder($id);

        if ($orderList==null) {

            $response = [

                "status"  => "false",
                "message" => "Order not found"

            ];

            return $response;
        }

        $orderData                 = [];
        $orderData["status"]       = "true";
        $orderData["token_status"] = "true";

        foreach ($orderList as $list) {

            $orderData["orders_list"][] = [

                "id"                     => $list->id,
                "product_name"           => $list->sub_category,
                "quantity"               => $list->quantity,
                "price"                  => $list->price,
                "ordered_date"           => $list->created_at

            ];
        }

        return $orderData;
    }
}