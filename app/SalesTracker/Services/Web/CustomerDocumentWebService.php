<?php
/**
 * Created by PhpStorm.
 * User: nimesh
 * Date: 4/6/17
 * Time: 11:01 AM
 */

namespace App\SalesTracker\Services\Web;


use App\SalesTracker\Repositories\Web\CustomerDocumentWebRepository;
use Illuminate\Support\Facades\File;

class CustomerDocumentWebService
{
    /**
     * @var CustomerDocumentWebRepository
     */
    private $documentWebRepository;

    /**
     * CustomerDocumentWebService constructor.
     * @param CustomerDocumentWebRepository $documentWebRepository
     */
    public function __construct(CustomerDocumentWebRepository $documentWebRepository)
    {
        $this->documentWebRepository = $documentWebRepository;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCustomerDetails($id)
    {
        return $this->documentWebRepository->getCustomerDetails($id);
    }

    /**
     * @param $request
     * @return bool
     */
    public function uploadDocument($request)
    {
        $fileName = $request['customer_id'] .'_'.rand(0, 10000).'.'.$request['document_name']->getClientOriginalExtension();

        $destinationPath = storage_path('app/public/customer/').$request['customer_id'].'_'.'customer';

        if (!File::exists($destinationPath))
        {
            File::makeDirectory($destinationPath, 0775, true, true);
        }

        $request['document_name']->move($destinationPath, $fileName);

        $request['document_name'] = $fileName;

        $customerDocument = $this->documentWebRepository->uploadDocument($request);

        return $customerDocument;
    }

    /**
     * @param $customer_id
     * @return mixed
     */
    public function getCustomerDocument($customer_id)
    {
        return $this->documentWebRepository->getCustomerDocument($customer_id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteDocument($id)
    {
        $data = $this->documentWebRepository->getCustomerDocumentData($id);

        $destinationPath = storage_path('app/public/customer/').$data->customer_id.'_'.'customer'.'/'.$data->document_name;

        if (File::exists($destinationPath))
        {
            File::delete($destinationPath);
        }

        return $this->documentWebRepository->deleteDocument($id);
    }
}