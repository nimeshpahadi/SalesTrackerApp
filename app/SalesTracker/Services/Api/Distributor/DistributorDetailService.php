<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/21/16
 * Time: 11:30 AM
 */

namespace App\SalesTracker\Services\Api\Distributor;


use App\SalesTracker\Repositories\Api\BaseRepository;
use App\SalesTracker\Repositories\Api\Distributor\DistributorDetailRepository;
use App\SalesTracker\Repositories\Api\User\UserApiRepository;
use App\SalesTracker\Services\Api\BaseService;

class DistributorDetailService extends BaseService
{
    /**
     * @var DistributorDetailRepository
     */
    public $detailRepository;
    /**
     * @var UserApiRepository
     */
    public $user;
    /**
     * @var BaseRepository
     */
    public $baseRepository;

    /**
     * DistributorDetailService constructor.
     * @param DistributorDetailRepository $detailRepository
     * @param UserApiRepository $user
     * @param BaseRepository $baseRepository
     */
    public function __construct(DistributorDetailRepository $detailRepository, UserApiRepository $user,
                                BaseRepository $baseRepository)
    {
        $this->detailRepository = $detailRepository;
        $this->user             = $user;
        $this->baseRepository   = $baseRepository;
    }

    /**
     * @param $serviceDetails
     * @return array
     */
    public function createDetailService($serviceDetails)
    {
        if (!$this->validateToken($this->user, $serviceDetails['api_token'])) {

            return $this->tokenMessage();
        }

        $this->storeData($this->baseRepository, $serviceDetails);

        $details = [

            "company_name" => $serviceDetails['company_name'],
            "contact_name" => $serviceDetails['contact_name'],
            "email"        => $serviceDetails['email'],
            "mobile"       => $serviceDetails['mobile'],
            "phone"        => $serviceDetails['phone'],
            "zone"         => $serviceDetails['zone'],
            "district"     => $serviceDetails['district'],
            "latitude"     => $serviceDetails['latitude'],
            "longitude"    => $serviceDetails['longitude'],
            "lead_source"  => $serviceDetails['lead_source'],
            "type"         => $serviceDetails['type'],
            "open_date"    => $serviceDetails['open_date'],
            "status"       => $serviceDetails['status'],
            "vat_no"       => $serviceDetails['vat_no'],

            ];

        if ($this->detailRepository->insertDetails($details)) {

            $respo = [

                "status"       => "true",
                "token_status" => "true",
                "message"      => "distributor details created!"

            ];

            return $respo;
            }

        $respo = [

            "status"       => "false",
            "token_status" => "true",
            "message"      => "oops !!! something went wrong"

            ];

        return $respo;
    }

    /**
     * @param $id
     * @param $request
     * @return array
     */
    public function getService($id, $request)
    {

        if(!$this->validateToken($this->user, $request['api_token'])) {

            return $this->tokenMessage();
        }

        $distributor    = $this->detailRepository->getDistDetail($id);
        $order_billings = $this->detailRepository->getOrderBillings($id);

        if ($distributor==null) {

            $query = [

                "status"       => "false",
                "token_status" => "true",
                "message"      => "distributor not found"

            ];

            return $query;
        }

        $distributor = (array)$distributor[0];
        $order_billings = (array)$order_billings[0];

        $data = [

            "company_name"   => $distributor['company_name'],
            "contact_name"   => $distributor['contact_name'],
            "email"          => $distributor['email'],
            "mobile"         => $distributor['mobile'],
            "phone"          => $distributor['phone'],
            "zone"           => $distributor['zone'],
            "district"       => $distributor['district'],
            "latitude"       => $distributor['latitude'],
            "longitude"      => $distributor['longitude'],
            "lead_source"    => $distributor['lead_source'],
            "type"           => $distributor['type'],
            "open_date"      => $distributor['open_date'],
            "status"         => $distributor['status'],
            "billing_amount" => $order_billings['billing_amount'],
            "paid_amount"    => $distributor['paid_amount'],
            "total_due"      => $order_billings['billing_amount'] - $distributor['paid_amount'],
            "vat_no"         => $distributor['vat_no'],

        ];

        $detailData                 = [];
        $detailData['status']       = "true";
        $detailData['token_status'] = "true";

        $address = $this->detailRepository->getDistAddress($id);

        $distAddress = [

            "billing"  => [],
            "shipping" => []

        ];

        foreach ($address as $ad) {

            $ad = (array)$ad;

            if ($ad['type']=='billing') {

                  $distAddress['billing'][] = [

                      "zone"      =>  $ad['zone'],
                      "district"  =>  $ad['district'],
                      "city"      =>  $ad['city'],
                      "latitude"  =>  $ad['latitude'],
                      "longitude" =>  $ad['longitude'],
                      "phone"     =>  $ad['phone'],
                      "mobile"    =>  $ad['mobile'],
                      "fax"       =>  $ad['fax']

                ];
            }

            if ($ad['type']=='shipping') {

                  $distAddress['shipping'][] = [
                      "zone"      =>  $ad['zone'],
                      "district"  =>  $ad['district'],
                      "city"      =>  $ad['city'],
                      "latitude"  =>  $ad['latitude'],
                      "longitude" =>  $ad['longitude'],
                      "phone"     =>  $ad['phone'],
                      "mobile"    =>  $ad['mobile'],
                      "fax"       =>  $ad['fax']

                  ];
            }
        }

        $data['address'] = $distAddress;

        $detailData['distributor_details'][] = $data;

        return $detailData;
    }

    /**
     * @param $request
     * @return array
     */
    public function getServiceList($request)
    {
        if (!$this->validateToken($this->user, $request['api_token'])) {

            return $this->tokenMessage();
        }

        $detailList = $this->detailRepository->getAllDetail();

        $dataList                 = [];
        $dataList["status"]       = "true";
        $dataList["token_status"] = "true";

        foreach ($detailList as $list) {

            $dataList["distributors"][] = [

                "id" => $list->id,
                "company_name" => $list->company_name,
                "contact_name" => $list->contact_name,
                "status"       => $list->status,

                "address"      => [

                    "zone"         => $list->zone,
                    "district"     => $list->district,
                    "latitude"     => $list->latitude,
                    "longitude"    => $list->longitude

                ]
            ];
        }

        return $dataList;
    }
}