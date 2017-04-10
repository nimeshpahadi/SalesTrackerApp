<?php
/**
 * Created by PhpStorm.
 * User: nimesh
 * Date: 4/9/17
 * Time: 1:37 PM
 */

namespace App\SalesTracker\Services\Web;


use App\SalesTracker\Repositories\Web\CustomerAreaWebRepository;

class CustomerAreaWebService
{
    /**
     * @var CustomerAreaWebRepository
     */
    private $areaWebRepository;

    /**
     * CustomerAreaWebService constructor.
     * @param CustomerAreaWebRepository $areaWebRepository
     */
    public function __construct(CustomerAreaWebRepository $areaWebRepository)
    {
        $this->areaWebRepository = $areaWebRepository;
    }

    /**
     * @param $request
     * @return bool
     */
    public function store($request)
    {
        return $this->areaWebRepository->store($request);
    }

    public function getCustomerAreaList()
    {
        return $this->areaWebRepository->getCustomerAreaList();
    }

    public function getId($id)
    {
        return $this->areaWebRepository->getId($id);
    }

    public function update($request, $id)
    {
        return $this->areaWebRepository->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->areaWebRepository->destroy($id);
    }
}