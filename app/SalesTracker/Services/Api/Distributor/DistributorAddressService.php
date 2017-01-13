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

        $distAddress = [];

        if ($serviceAddress['type']=='Billing') {

            $distAddress = $this->getAddress($serviceAddress, "Billing");
        }

        if ($serviceAddress['type']=='Shipping') {

            $distAddress = $this->getAddress($serviceAddress, "Shipping");
        }

        if ($serviceAddress['type']=='Both') {

            $distAddress = [
                $this->getAddress($serviceAddress, "Billing"),
                $this->getAddress($serviceAddress, "Shipping")
            ];
        }

        if ($this->addressRepository->insertAddress($distAddress)) {

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

    /**
     * @param $address
     * @param $type
     * @return array
     */
    public function getAddress($address, $type)
    {
        return [

            "zone"           => $address['zone'],
            "district"       => $address['district'],
            "city"           => $address['city'],
            "latitude"       => $address['latitude'],
            "longitude"      => $address['longitude'],
            "phone"          => $address['phone'],
            "mobile"         => $address['mobile'],
            "fax"            => $address['fax'],
            "type"           => $type,
            "distributor_id" => $address['distributor_id']

        ];
    }
}