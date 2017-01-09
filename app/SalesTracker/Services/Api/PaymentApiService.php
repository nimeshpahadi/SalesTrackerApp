<?php
/**
 * Created by PhpStorm.
 * User: trees
 * Date: 12/8/16
 * Time: 12:54 PM
 */

namespace App\SalesTracker\Services\Api;


use App\SalesTracker\Repositories\Api\BaseRepository;
use App\SalesTracker\Repositories\Api\PaymentApiRepository;
use App\SalesTracker\Repositories\Api\User\UserApiRepository;

class PaymentApiService extends BaseService
{
    /**
     * @var PaymentApiRepository
     */
    private $paymentApiRepository;
    /**
     * @var UserApiRepository
     */
    private $userApiRepository;
    /**
     * @var BaseRepository
     */
    private $baseRepository;

    /**
     * PaymentApiService constructor.
     * @param PaymentApiRepository $paymentApiRepository
     * @param UserApiRepository $userApiRepository
     * @param BaseRepository $baseRepository
     */
    public function __construct(PaymentApiRepository $paymentApiRepository, UserApiRepository $userApiRepository,
                                BaseRepository $baseRepository)
    {
        $this->paymentApiRepository = $paymentApiRepository;
        $this->userApiRepository    = $userApiRepository;
        $this->baseRepository       = $baseRepository;
    }

    /**
     * @param $paymentService
     * @return array
     */
    public function createPaymentService($paymentService)
    {
        if (!$this->validateToken($this->userApiRepository, $paymentService['api_token'])) {

            return $this->tokenMessage();
        }

        $this->storeData($this->baseRepository, $paymentService);

        $payment = [

            "user_id"        => $paymentService['user_id'],
            "distributor_id" => $paymentService['distributor_id'],
            "amount"         => $paymentService['amount'],
            "type"           => $paymentService['type']

        ];

        if ($this->paymentApiRepository->createPaymentRepo($payment)) {

            $resp = [

                "status"       => "true",
                "token_status" => "true",
                "message"      => "Payment created"

            ];

            return $resp;
        }

        $respo = [

            "status"       => "true",
            "token_status" => "true",
            "message"      => "Oops !!! Something went wrong"

        ];

        return $respo;
    }

    /**
     * @param $request
     * @param $id
     * @return array
     */
    public function getPaymentList($request, $id)
    {
        if (!$this->validateToken($this->userApiRepository, $request['api_token'])) {

            return $this->tokenMessage();
        }

        $paymentList = $this->paymentApiRepository->getAllPayment($id);

        if ($paymentList==null) {

            $response = [

                "status"        => "false",
                "token_status"  => "true",
                "message"       => "Distributor does not exist"

            ];

            return $response;
        }

        $paymentData = [];
        $paymentData["status"] = "true";
        $paymentData["token_status"] = "true";

        foreach ($paymentList as $list) {

            $paymentData['payment_list'][] = [

                "amount"           => $list->amount,
                "type"             => $list->type,
                "payment_date"     => $list->created_at

            ];

        }

        return $paymentData;
    }
}