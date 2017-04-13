<?php
/**
 * Created by PhpStorm.
 * User: nimesh
 * Date: 4/6/17
 * Time: 12:56 PM
 */

namespace App\SalesTracker\Repositories\Web;


use App\SalesTracker\Entities\Distributor\CustomerDocument;
use App\SalesTracker\Entities\Distributor\DistributorDetails;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Database\QueryException;

class CustomerDocumentWebRepository
{
    /**
     * @var CustomerDocument
     */
    private $customerDocument;
    /**
     * @var DistributorDetails
     */
    private $distributorDetails;
    /**
     * @var Log
     */
    private $log;

    /**
     * CustomerDocumentWebRepository constructor.
     * @param CustomerDocument $customerDocument
     * @param DistributorDetails $distributorDetails
     * @param Log $log
     */
    public function __construct(CustomerDocument $customerDocument,
                                DistributorDetails $distributorDetails, Log $log)
    {
        $this->customerDocument = $customerDocument;
        $this->distributorDetails = $distributorDetails;
        $this->log = $log;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCustomerDetails($id)
    {
        return $this->distributorDetails->find($id);
    }

    /**
     * @param $request
     * @return bool
     */
    public function uploadDocument($request)
    {
        try {
            $this->customerDocument->create($request);
            $this->log->info('Customer Document Uploaded');
            return true;
        } catch (QueryException $exception) {
            $this->log->error('Customer Document Upload Failed : ', [$exception->getMessage()]);
            return false;
        }
    }

    /**
     * @param $customer_id
     * @return mixed
     */
    public function getCustomerDocument($customer_id)
    {
        return $this->customerDocument->select('*')->where('customer_id', $customer_id)->get();
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteDocument($id)
    {
        try {
            $query = $this->customerDocument->find($id);
            $query->delete();
            $this->log->info('File deleted');
            return true;
        } catch (QueryException $exception) {
            $this->log->error('File delete failed');
            return false;
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCustomerDocumentData($id)
    {
        return $this->customerDocument->select('*')->where('id', $id)->first();

    }
}