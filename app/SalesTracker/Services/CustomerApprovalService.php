<?php
/**
 * Created by PhpStorm.
 * User: trees
 * Date: 12/25/16
 * Time: 1:47 PM
 */

namespace App\SalesTracker\Services;


use App\SalesTracker\Repositories\CustomerApprovalRepository;

class CustomerApprovalService
{
    /**
     * @var CustomerApprovalRepository
     */
    private $approvalRepository;

    /**
     * CustomerApprovalService constructor.
     * @param CustomerApprovalRepository $approvalRepository
     */
    public function __construct(CustomerApprovalRepository $approvalRepository)
    {
        $this->approvalRepository = $approvalRepository;
    }

    /**
     * @return array
     */
    public function customerList()
    {
        $data = $this->approvalRepository->customerListRepo();

        $distData = [];

        foreach ($data as $dis)
        {
            $distDataList = $this->approvalRepository->saleApproveRepo($dis->id);
            $distAdminList = $this->approvalRepository->adminApproveRepo($dis->id);

            $distData[] = [

                "distributor_id" => $dis->id,
                "company_name" => $dis->company_name,
                "contact_name" => $dis->contact_name,
                "approval" => $distDataList,
                "adminApproval" => $distAdminList,
            ];
        }
        return $distData;
    }

    /**
     * @param $request
     * @return static
     */
    public function saleManagerApprove($request)
    {

        $data = [

            "distributor_id" => $request->distributor_id,
            "salesmanager"   => $request->salesmanager,
            "sales_approval" => $request->sales_approval

        ];

        $approveData = $this->approvalRepository->insertSaleApprove($data);

        return $approveData;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saleManagerApproveUpdate($request)
    {

        $data = [

            "distributor_id" => $request->distributor_id,
            "sales_approval" => $request->sales_approval

        ];

        $approveData = $this->approvalRepository->insertSaleApproveUpdate($data);

        return $approveData;
    }

    /**
     * @param $request
     * @return static
     */
    public function saleManagerReject($request)
    {
        $data = [

            "distributor_id" => $request->distributor_id,
            "salesmanager"   => $request->salesmanager,
            "sales_approval" => $request->sales_approval,
            "sale_remark"    => $request->sale_remark

        ];

        $approveData = $this->approvalRepository->insertSaleReject($data);

        return $approveData;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function adminApprove($request)
    {
        $data = [

            "distributor_id" => $request->distributor_id,
            "admin"          => $request->admin,
            "admin_approval" => $request->admin_approval

        ];

        $approveData = $this->approvalRepository->updateAdminApprove($data);

        return $approveData;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function adminReject($request)
    {
        $data = [

            "distributor_id" => $request->distributor_id,
            "admin"          => $request->admin,
            "admin_approval" => $request->admin_approval,
            "admin_remark"   => $request->admin_remark

        ];

        $approveData = $this->approvalRepository->updateAdminReject($data);

        return $approveData;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function accountApprove($request)
    {
        $data = [

            "distributor_id"  => $request->distributor_id,
            "approval_status" => $request->approval_status

        ];

        $this->approvalRepository->updateDistStatus($request->distributor_id);

        $approveData = $this->approvalRepository->updateAccountApprove($data);

        return $approveData;
    }
}