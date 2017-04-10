<?php
/**
 * Created by PhpStorm.
 * User: nimesh
 * Date: 4/10/17
 * Time: 2:37 PM
 */

namespace App\SalesTracker\Services\Api\Distributor;


use App\SalesTracker\Repositories\Api\BaseRepository;
use App\SalesTracker\Repositories\Api\Distributor\CustomerAreaApiRepository;
use App\SalesTracker\Repositories\Api\User\UserApiRepository;
use App\SalesTracker\Services\Api\BaseService;

class CustomerAreaApiService extends BaseService
{
    /**
     * @var CustomerAreaApiRepository
     */
    private $areaApiRepository;
    /**
     * @var UserApiRepository
     */
    private $user;
    /**
     * @var BaseRepository
     */
    private $baseRepository;

    /**
     * CustomerAreaApiService constructor.
     * @param CustomerAreaApiRepository $areaApiRepository
     * @param UserApiRepository $user
     * @param BaseRepository $baseRepository
     */
    public function __construct(CustomerAreaApiRepository $areaApiRepository,
                                UserApiRepository $user, BaseRepository $baseRepository)
    {
        $this->areaApiRepository = $areaApiRepository;
        $this->user = $user;
        $this->baseRepository = $baseRepository;
    }

    /**
     * @param $request
     * @return array
     */
    public function create($request)
    {
        if (!$this->validateToken($this->user, $request['api_token']))
        {
            return $this->tokenMessage();
        }

        $places = explode(",", trim($request['places']));

        foreach ($places as $key => $value)
        {
            if (trim($value) == "")
            {
                unset($places[$key]);
            }
        }

        $this->storeData($this->baseRepository, $request);

        $request['places'] = json_encode($places);

        $data = [
            'district' => $request['district'],
            'area_name' => $request['area_name'],
            'places' => $request['places']
        ];

        if ($this->areaApiRepository->create($data))
        {
            $respo = [
                "status" => "true",
                "token_status" => "true",
                "message" => "customer area created !!!"
            ];

            return $respo;
        }

        $respo = [
            "status" => "false",
            "token_status" => "true",
            "message" => "oops !!! something went wrong"
        ];

        return $respo;

    }
}