<?php
/**
 * Created by PhpStorm.
 * User: prakash
 * Date: 11/20/16
 * Time: 9:15 AM
 */

namespace App\SalesTracker\Services;


use App\SalesTracker\Repositories\DistributorRepository;

class DistributorService
{

    /**
     * @var DistributorRepository
     */
    public $distributorRepository;

    public function __construct(DistributorRepository $distributorRepository)
    {
        $this->distributorRepository = $distributorRepository;
    }

    /**
     * store distributor
     * @param $request
     */
    public function storedistributor($request)
    {
        $formData = $request->all();
        $formData = array_except($formData, ['_token', 'to', 'remove']);
        $storerdistributor = $this->distributorRepository->storesDistributor($formData);
        return $storerdistributor;
    }


    /**
     * @return DistributorRepository
     */
    public function update_distributor($request, $id)
    {
        $data = $this->distributorRepository->updatedistributor($request, $id);

        return $data;
    }

    /**
     * get all distributor list
     * @return mixed
     */
    public function distributor_list()
    {
        $distributor = $this->distributorRepository->distributorslist();
        return $distributor;

    }

    /**
     * delete specific distributor
     * @param $id
     * @return mixed
     */
    public function deleteDistributor($id)
    {
        $distributordelete = $this->distributorRepository->deleteDistributorID($id);
        return $distributordelete;

    }

    /**
     * store the guarantee
     * @return DistributorRepository
     */
    public function guaranteestore($request)
    {
        $formData = $request->all();
        $data=[

            "distributor_id" => isset($formData['distributor_id'])?$formData['distributor_id']:"",
            "type"           => isset($formData['type'])?$formData['type']:"",
            "bank_name"      => isset($formData['bank_name'])?$formData["bank_name"]:null,
            "cheque_no"      => isset($formData['cheque_no'])?$formData["cheque_no"]:null,
            "amount"         => isset($formData['amount'])?$formData["amount"]:"",
            "remark"         => isset($formData['remark'])?$formData["remark"]:null,

        ];

        $store_guarantee = $this->distributorRepository->guarantee_store($data);
        return $store_guarantee;
    }


    /**
     * create address for specific distributor
     * @param $request
     * @return mixed
     */
    public function create_address($request)
    {
        $formData = $request->all();

        $type = (int)trim($formData['type']);
        $data = [];
        $billing = $this->formatShippingAndBilling($formData, "Billing");
        $shipping = $this->formatShippingAndBilling($formData, "Shipping");

        if ($type == 3) {
            $data = [
                $shipping,
                $billing
            ];
        }

        if ($type == 1) {
            $data = $billing;
        }
        if ($type == 2) {
            $data = $shipping;
        }

        $createAddress = $this->distributorRepository->createAddress($data);
//        dd($createAddress);
        return $createAddress;
    }


    /**
     * helping function for create_address
     * @param $formData
     * @param $type
     * @return array
     */
    public function formatShippingAndBilling($formData, $type)
    {
        return [

            "distributor_id" => $formData['distributor_id'],
            "type" => $type,
            "zone" => $formData['zone'],
            "district" => $formData['district'],
            "city" => $formData['city'],
            "latitude" => $formData['latitude'],
            "longitude" => $formData['longitude'],
            "phone" => $formData['phone'],
            "mobile" => $formData['mobile'],
            "fax" => $formData['fax'],

        ];
    }

    /**
     * @return DistributorRepository
     */

    /**
     * create tracking
     * @param $request
     */
    public function create_tracking($request)
    {
        $formData = $request->all();
        $formData = array_except($formData, ['_token', 'to', 'remove']);

        $createTracking = $this->distributorRepository->createTrackings($formData);
        return $createTracking;
    }

    public function update_dis_address($id,$request)
    {

        $formData = $request->all();
        $type = (int)trim($formData['type']);
        $data = [];
        $billing = $this->formatShippingAndBilling($formData, "Billing");
        $shipping = $this->formatShippingAndBilling($formData, "Shipping");

        if ($type == 1) {
            $data = $billing;
        }
        if ($type == 2) {
            $data = $shipping;
        }

        $updateAddress = $this->distributorRepository->updatedisaddress($id,$data);
        return $updateAddress;

    }

    public function update_dis_guarantee($request, $id)
    {
        $data = $this->distributorRepository->updatedisguarantee($request, $id);
        return $data;
    }

    public function deleteDistributorAddress($id)
    {
        $addressdelete = $this->distributorRepository->deleteDistributor_Address($id);
        return $addressdelete;

    }

    public function select_distributor($id)
    {
        $data = $this->distributorRepository->select_distributorID($id);
        return $data;
    }

    public function getaddress($id)
    {
        $data = $this->distributorRepository->select_distributoraddress($id);
        $address = [
            "Shipping" => [],
            "Billing" => []
        ];
        foreach ($data as $add) {
            $add = $add->toArray();
            if ($add['type'] == "Billing") {
                $address["Billing"] = $add;
            }
            if ($add['type'] == "Shipping") {
                $address["Shipping"] = $add;
            }
        }


        return $address;
    }

    public function getguarantee($id)
    {
        $data = $this->distributorRepository->select_distributorguarantee($id);
        return $data;
    }

    public function shippingAddress($id)
    {
        $data = $this->distributorRepository->shipping_address($id);
        return $data;
    }



    public function gettracking($id)
    {
        $data = $this->distributorRepository->select_distributortracking($id);
        return $data;
    }

    public function storeMinute($request)
    {
        $formData = $request->all();

        $formData = array_except($formData, ['_token', 'to', 'remove']);
        $data = $this->distributorRepository->storeMinute($formData);
        return $data;
    }

    public function getMinute($id)
    {
        $data = $this->distributorRepository->getMinute($id);
        return $data;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getBillingAmount($id)
    {
        $data = $this->distributorRepository->getBillingRepo($id);

        return $data;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getPayingAmount($id)
    {
        $data = $this->distributorRepository->getPayingRepo($id);

        return $data;
    }

    public function getaddressbyid($did,$id)
    {
        $data = $this->distributorRepository->select_address($did,$id);

        return $data;
    }

    public function billingAddress($id)
    {
        $data = $this->distributorRepository->billing_address($id);
        return $data;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getCustomerArea($request)
    {
        return $this->distributorRepository->getCustomerArea($request);
    }
}