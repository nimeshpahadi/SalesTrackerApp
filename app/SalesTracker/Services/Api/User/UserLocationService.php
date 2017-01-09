<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/29/16
 * Time: 1:52 PM
 */

namespace App\SalesTracker\Services\Api\User;

use App\SalesTracker\Repositories\Api\BaseRepository;
use App\SalesTracker\Repositories\Api\User\UserApiRepository;
use App\SalesTracker\Repositories\Api\User\UserLocationRepository;
use App\SalesTracker\Services\Api\BaseService;

class UserLocationService extends BaseService
{
    /**
     * @var UserLocationRepository
     */
    private $locationRepository;
    /**
     * @var UserApiRepository
     */
    private $apiRepository;
    /**
     * @var BaseRepository
     */
    private $baseRepository;

    /**
     * UserLocationService constructor.
     * @param UserLocationRepository $locationRepository
     * @param UserApiRepository $apiRepository
     * @param BaseRepository $baseRepository
     */
    public function __construct(UserLocationRepository $locationRepository, UserApiRepository $apiRepository,
                                BaseRepository $baseRepository)
    {
        $this->locationRepository = $locationRepository;
        $this->apiRepository      = $apiRepository;
        $this->baseRepository     = $baseRepository;
    }

    /**
     * @param $serviceLocation
     * @return array
     */
    public function createLocationService($serviceLocation)
    {
        if(!$this->validateToken($this->apiRepository, $serviceLocation['api_token'])) {

            return $this->tokenMessage();
        }

        $this->storeData($this->baseRepository, $serviceLocation);

        $locationService = [

            "user_id"   => $serviceLocation['user_id'],
            "latitude"  => $serviceLocation['latitude'],
            "longitude" => $serviceLocation['longitude']

        ];

    if ($this->locationRepository->createLocationRepo($locationService)) {

            $resp = [

                "status"       => "true",
                "token_status" => "true",
                "message"      => "User Location created"

            ];

            return $resp;
        }

        $respo = [

            "status"       => "false",
            "token_status" => "true",
            "message"      => "Oops !!! Something went wrong"

        ];

        return $respo;
    }
}