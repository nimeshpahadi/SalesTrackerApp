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
        $places = explode(",", trim($request->places));

        foreach ($places as $key => $value) {
            if (trim($value) == "") {
                unset($places[$key]);
            }
        }

        $request->places = json_encode($places);

        $data = [
            'district' => $request->district,
            'area_name' => $request->area_name,
            'places' => $request->places
        ];

        return $this->areaWebRepository->store($data);
    }

    /**
     * @return mixed
     */
    public function getCustomerAreaList()
    {
        return $this->areaWebRepository->getCustomerAreaList();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getId($id)
    {
        return $this->areaWebRepository->getId($id);
    }

    /**
     * @param $request
     * @param $id
     * @return bool
     */
    public function update($request, $id)
    {
        return $this->areaWebRepository->update($request, $id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->areaWebRepository->destroy($id);
    }

    public function getCustomerArea()
    {
        return $this->areaWebRepository->getCustomerArea();
    }
}