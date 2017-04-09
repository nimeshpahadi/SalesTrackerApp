<?php
/**
 * Created by PhpStorm.
 * User: nimesh
 * Date: 4/9/17
 * Time: 1:58 PM
 */

namespace App\SalesTracker\Repositories\Web;


use App\SalesTracker\Entities\Distributor\CustomerArea;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Database\QueryException;

class CustomerAreaWebRepository
{
    /**
     * @var CustomerArea
     */
    private $customerArea;
    /**
     * @var Log
     */
    private $log;

    /**
     * CustomerAreaWebRepository constructor.
     * @param CustomerArea $customerArea
     * @param Log $log
     */
    public function __construct(CustomerArea $customerArea, Log $log)
    {
        $this->customerArea = $customerArea;
        $this->log = $log;
    }

    /**
     * @param $request
     * @return bool
     */
    public function store($request)
    {
        try {
            $this->customerArea->create($request);
            $this->log->info('Customer Area Created');
            return true;
        } catch (QueryException $exception) {
            $this->log->error('Customer Area Create Failed : ', [$exception->getMessage()]);
            return false;
        }
    }
}