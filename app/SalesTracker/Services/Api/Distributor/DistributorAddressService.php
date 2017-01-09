<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/21/16
 * Time: 10:23 PM
 */

namespace App\SalesTracker\Services\Api\Distributor;

use App\SalesTracker\Repositories\Api\BaseRepository;
use App\SalesTracker\Repositories\Api\Distributor\DistributorAddressRepository;
use App\SalesTracker\Repositories\Api\User\UserApiRepository;
use App\SalesTracker\Services\Api\BaseService;

class DistributorAddressService extends BaseService
{
    /**
     * @var DistributorAddressRepository
     */
    public $addressRepository;
    /**
     * @var UserApiRepository
     */
    public $user;
    /**
     * @var BaseRepository
     */
    private $baseRepository;

    /**
     * DistributorAddressService constructor.
     * @param DistributorAddressRepository $addressRepository
     * @param UserApiRepository $user
     * @param BaseRepository $baseRepository
     */
    public function __construct(DistributorAddressRepository $addressRepository, UserApiRepository $user,
                                BaseRepository $baseRepository)
    {
        $this->addressRepository = $addressRepository;
        $this->user              = $user;
        $this->baseRepository    = $baseRepository;
    }

    /**
     * @param $serviceAddress
     * @return array
     */
    public function addressService($serviceAddress)
    {
        if (!$this->validateToken($this->user, $serviceAddress['api_token'])) {

            return $this->tokenMessage();
        }

        $this->storeData($this->baseRepository, $serviceAddress);

        $address=[

            "type"           => $serviceAddress['type'],
            "zone"           => $serviceAddress['zone'],
            "district"       => $serviceAddress['district'],
            "city"           => $serviceAddress['city'],
            "latitude"       => $serviceAddress['latitude'],
            "longitude"      => $serviceAddress['longitude'],
            "phone"          => $serviceAddress['phone'],
            "mobile"         => $serviceAddress['mobile'],
            "fax"            => $serviceAddress['fax'],
            "distributor_id" => $serviceAddress['distributor_id'],

        ];

        if ($this->addressRepository->insertAddress($address)) {

            $respo = [

                "status"       => "true",
                "token_status" => "true",
                "message"      => "Distributor address created!"

            ];

            return $respo;
        }

        $respo = [

            "status"       => "false",
            "token_status" => "true",
            "message"      => "Oops !!! something went wrong"

        ];

        return $respo;
    }
}