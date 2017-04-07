<?php
/**
 * Created by PhpStorm.
 * User: nimesh
 * Date: 4/6/17
 * Time: 11:01 AM
 */

namespace App\SalesTracker\Services\Web;


use App\SalesTracker\Repositories\Web\CustomerDocumentWebRepository;

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
    public function getCustomerId($id)
    {
        $customerDocument = $this->documentWebRepository->getCustomerId($id);

        return $customerDocument;
    }

    /**
     * @param $request
     * @return bool
     */
    public function uploadDocument($request)
    {
        $fileName = $request['customer_id'] . '_' . rand(0, 10000) . '.' . $request['document_name']->getClientOriginalExtension();

        $destinationPath = storage_path('app/public/customer');

        $request['document_name']->move($destinationPath, $fileName);

        $request['document_name'] = $fileName;

        $customerDocument = $this->documentWebRepository->uploadDocument($request);

        return $customerDocument;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCustomerDocument($id)
    {
        return $this->documentWebRepository->getCustomerDocument($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteDocument($id)
    {
        return $this->documentWebRepository->deleteDocument($id);
    }
}