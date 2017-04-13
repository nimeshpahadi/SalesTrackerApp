<?php
/**
 * Created by PhpStorm.
 * User: nimesh
 * Date: 4/6/17
 * Time: 10:58 AM
 */

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentRequest;
use App\SalesTracker\Services\Web\CustomerDocumentWebService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CustomerDocumentWebController extends Controller
{
    /**
     * @var CustomerDocumentWebService
     */
    private $documentWebService;

    /**
     * CustomerDocumentWebController constructor.
     * @param CustomerDocumentWebService $documentWebService
     */
    public function __construct(CustomerDocumentWebService $documentWebService)
    {
        $this->documentWebService = $documentWebService;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($id)
    {
        $customerId = $this->documentWebService->getCustomerDetails($id);

        return view('distributor/upload_document', compact('customerId'));
    }

    /**
     * @param Request $documentRequest
     * @return $this
     */
    public function store(Request $documentRequest)
    {
        $data = $documentRequest->all();

        if ($this->documentWebService->uploadDocument($data))
        {
            Session::put('url.intended', URL::previous());
            return Redirect::intended('/')->withSuccess("Customer Document Uploaded Successfully !!!");
        }

        return back()->withErrors("Something Went Wrong");
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $customerDocument = $this->documentWebService->getCustomerDocument($id);
        $customerDetails = $this->documentWebService->getCustomerDetails($id);

        return view('distributor/upload_document_show', compact('customerDocument', 'customerDetails'));

    }

    /**
     * @param $id
     * @return $this
     */
    public function destroy($id)
    {
        if ($this->documentWebService->deleteDocument($id))
        {
            Session::put('url.intended', URL::previous());
            return Redirect::intended('/')->withSuccess('Document Deleted');
        }

        return back()->withErrors('Something Went Wrong');
    }
}