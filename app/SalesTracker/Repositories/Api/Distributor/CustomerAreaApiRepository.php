<?php
/**
 * Created by PhpStorm.
 * User: nimesh
 * Date: 4/10/17
 * Time: 2:39 PM
 */

namespace App\SalesTracker\Repositories\Api\Distributor;


use App\SalesTracker\Entities\Distributor\CustomerArea;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Database\QueryException;

class CustomerAreaApiRepository
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
     * CustomerAreaApiRepository constructor.
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
    public function create($request)
    {
        try
        {
            $this->customerArea->create($request);
            $this->log->info('Customer Area Created');
            return true;
        }
        catch (QueryException $exception)
        {
            $this->log->error('Customer Area Create Failed : ', [$exception->getMessage()]);
            return false;
        }
    }

    /**
     * @param $request
     * @param $id
     * @return bool
     */
    public function edit($request, $id)
    {
        try
        {
            $query = CustomerArea::find($id);
            $query->district = $request['district'];
            $query->area_name = $request['area_name'];
            $query->places = $request['places'];
            $query->update();
            $this->log->info('Customer Area Updated');
            return true;
        }
        catch (QueryException $exception)
        {
            $this->log->error('Customer Area Update Failed : ', [$exception->getMessage()]);
            return false;
        }
    }
}