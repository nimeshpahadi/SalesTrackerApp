<?php
/**
 * Created by PhpStorm.
 * User: trees
 * Date: 12/8/16
 * Time: 12:53 PM
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\SalesTracker\Services\Api\PaymentApiService;
use App\SalesTracker\Services\ApiValidation\PaymentValidation;
use Illuminate\Http\Request;

class PaymentApiController extends Controller
{
    /**
     * @var PaymentApiService
     */
    private $paymentApiService;
    /**
     * @var PaymentValidation
     */
    private $paymentValidation;

    /**
     * PaymentApiController constructor.
     * @param PaymentApiService $paymentApiService
     * @param PaymentValidation $paymentValidation
     */
    public function __construct(PaymentApiService $paymentApiService, PaymentValidation $paymentValidation)
    {
        $this->paymentApiService = $paymentApiService;
        $this->paymentValidation = $paymentValidation;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPayment(Request $request)
    {
        $data = $request->all();

        $t = $this->paymentValidation->check($data);

        if ($t!=null) {
            return $t;
        }

        $payment = $this->paymentApiService->createPaymentService($data);

        return response()->json($payment);
    }

    public function getPaymentList(Request $request, $id)
    {
        $getPaymentList = $this->paymentApiService->getPaymentList($request, $id);

        return response()->json($getPaymentList);
    }
}