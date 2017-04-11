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

    /**
     * @return mixed
     */
    public function getCustomerAreaList()
    {
        return $this->customerArea->select('*')->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getId($id)
    {
        return $this->customerArea->select('*')->where('id', $id)->first();
    }

    /**
     * @param $request
     * @param $id
     * @return bool
     */
    public function update($request, $id)
    {
        try {
            $query = CustomerArea::find($id);
            $query->district = $request->district;
            $query->area_name = $request->area_name;
            $query->places = $request->places;
            $query->update();
            $this->log->info('Customer Area Updated !!!');
            return true;
        } catch (QueryException $exception) {
            $this->log->error('Customer Area Update Failed : ', [$exception->getMessage()]);
            return false;
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id)
    {
        try {
            $query = $this->customerArea->find($id);
            $query->delete();
            $this->log->info("Customer Area Deleted");
            return true;
        } catch (QueryException $exception) {
            $this->log->error("Customer AreaDeletion Failed : ", [$exception->getMessage()]);
            return false;
        }
    }

    public function getCustomerArea()
    {
        return $this->customerArea->select('area_name')->get();
    }
}