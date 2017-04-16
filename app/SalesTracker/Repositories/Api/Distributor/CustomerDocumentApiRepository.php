<?php
/**
 * Created by PhpStorm.
 * User: nimesh
 * Date: 4/9/17
 * Time: 10:45 AM
 */

namespace App\SalesTracker\Repositories\Api\Distributor;


use App\SalesTracker\Entities\Distributor\CustomerDocument;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Database\QueryException;

class CustomerDocumentApiRepository
{
    /**
     * @var CustomerDocument
     */
    private $customerDocument;
    /**
     * @var Log
     */
    private $log;

    /**
     * CustomerDocumentApiRepository constructor.
     * @param CustomerDocument $customerDocument
     * @param Log $log
     */
    public function __construct(CustomerDocument $customerDocument, Log $log)
    {
        $this->customerDocument = $customerDocument;
        $this->log = $log;
    }

    /**
     * @param $request
     * @return static
     */
    public function create($request)
    {
        try {
            $this->customerDocument->create($request);
            $this->log->info('Customer Document Created');
            return true;
        } catch (QueryException $exception) {
            $this->log->error('Customer Document Create Failed : ', [$exception->getMessage()]);
            return false;
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCustomerDocument($id)
    {
        $query = $this->customerDocument->select('*')->where('customer_id', $id)->get();

        return $query;
    }
}