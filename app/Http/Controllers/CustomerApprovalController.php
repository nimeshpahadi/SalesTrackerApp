<?php
/**
 * Created by PhpStorm.
 * User: trees
 * Date: 12/25/16
 * Time: 1:22 PM
 */

namespace App\Http\Controllers;


use App\SalesTracker\Services\CustomerApprovalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CustomerApprovalController extends Controller
{
    /**
     * @var CustomerApprovalService
     */
    private $approvalService;

    /**
     * CustomerApprovalController constructor.
     * @param CustomerApprovalService $approvalService
     */
    public function __construct(CustomerApprovalService $approvalService)
    {
        $this->approvalService = $approvalService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $customerList = $this->approvalService->customerList();

        return view('distributor/customer_approve_list', compact('customerList'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function createSaleApprove(Request $request)
    {
        $this->approvalService->saleManagerApprove($request);

        Session::put('url.intended', URL::previous());

        return Redirect::intended('/')->withSuccess('customer approved by sales manager ');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function updateSaleApprove(Request $request)
    {
        $this->approvalService->saleManagerApproveUpdate($request);

        Session::put('url.intended', URL::previous());

        return Redirect::intended('/')->withSuccess(' customer approval status updated by sales manager ');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function createSaleReject(Request $request)
    {
        $this->approvalService->saleManagerReject($request);

        Session::put('url.intended', URL::previous());

        return Redirect::intended('/')->withSuccess('customer rejected by sales manager');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminCustomerList()
    {
        $customerList = $this->approvalService->customerList();

        return view('distributor/adminApproveList', compact('customerList'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function createAdminApprove(Request $request)
    {
        $this->approvalService->adminApprove($request);

        Session::put('url.intended', URL::previous());

        return Redirect::intended('/')->withSuccess('customer approved by general manager');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function createAdminReject(Request $request)
    {
        $this->approvalService->adminReject($request);

        Session::put('url.intended', URL::previous());

        return Redirect::intended('/')->withSuccess('customer rejected by general manager');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function accountCustomerList()
    {
        $customerList = $this->approvalService->customerList();

        return view('distributor/accountApproveList', compact('customerList'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function updateAccountApprove(Request $request)
    {
        $this->approvalService->accountApprove($request);

        Session::put('url.intended', URL::previous());

        return Redirect::intended('/')->withSuccess('distributor status updated');
    }
}