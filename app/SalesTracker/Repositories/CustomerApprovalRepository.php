<?php
/**
 * Created by PhpStorm.
 * User: trees
 * Date: 12/25/16
 * Time: 2:09 PM
 */

namespace App\SalesTracker\Repositories;


use App\SalesTracker\Entities\CustomerApproval;
use App\SalesTracker\Entities\CustomerApprovalRemarks;
use App\SalesTracker\Entities\Distributor\DistributorDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class CustomerApprovalRepository
{
    /**
     * @var DistributorDetails
     */
    private $distributorDetails;
    /**
     * @var CustomerApproval
     */
    private $customerApproval;
    /**
     * @var CustomerApprovalRemarks
     */
    private $customerApprovalRemarks;

    /**
     * CustomerApprovalRepository constructor.
     * @param DistributorDetails $distributorDetails
     * @param CustomerApproval $customerApproval
     * @param CustomerApprovalRemarks $customerApprovalRemarks
     */
    public function __construct(DistributorDetails $distributorDetails,
                                CustomerApproval $customerApproval,
                                CustomerApprovalRemarks $customerApprovalRemarks)
    {
        $this->distributorDetails = $distributorDetails;
        $this->customerApproval = $customerApproval;
        $this->customerApprovalRemarks = $customerApprovalRemarks;
    }

    /**
     * @return mixed
     */
    public function customerListRepo()
    {
        $query = DB::table('distributor_details')
            ->select('*')
            ->where('distributor_details.status', 0)
            ->get();
        return $query;
    }

    /**
     * @param $id
     * @return array
     */
    public function saleApproveRepo($id)
    {
        $query = DB::table('customer_approvals')
            ->select('customer_approvals.*', 'users.username', 'roles.display_name')
            ->join('users', 'users.id', 'customer_approvals.salesmanager')
            ->join('role_user', 'role_user.user_id', 'users.id')
            ->join('roles', 'roles.id', 'role_user.role_id')
            ->where('customer_approvals.distributor_id', $id)
            ->first();

        return (array)$query;
    }

    public function adminApproveRepo($id)
    {
        $query = DB::table('customer_approvals')
            ->join('users', 'users.id', 'customer_approvals.admin')
            ->join('role_user', 'role_user.user_id', 'users.id')
            ->join('roles', 'roles.id', 'role_user.role_id')
            ->select('customer_approvals.*', 'users.username', 'roles.display_name')
            ->where('distributor_id', $id)
            ->first();

        return (array)$query;
    }

    public function checkSaleData($id)
    {
        $query = $this->customerApproval->select('*')
                                ->where('distributor_id', $id)
                                ->first();

        return $query;
    }

    /**
     * @param $request
     * @return static
     */
    public function insertSaleApprove($request)
    {
        return $this->customerApproval->create($request);
    }

    /**
     * @param $request
     * @return static
     */
    public function insertSaleApproveRemark($request)
    {
        return $this->customerApprovalRemarks->create($request);

    }

    /**
     * @param $request
     * @return mixed
     */
    public function insertSaleApproveUpdate($request)
    {
        $id = $request['distributor_id'];

        $query = $this->customerApproval->select('*')
                                        ->where('distributor_id', $id)
                                        ->first();

        $query->sales_approval = $request['sales_approval'];
        $query->salesmanager = $request['salesmanager'];
        $query->sale_remark = $request['sale_remark'];
        $query->sale_remark = $request['sale_remark'];

        $query->save();

        return $query;
    }

    /**
     * @param $request
     * @return static
     */
    public function insertAdminApprove($request)
    {
        return $this->customerApproval->create($request);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function updateAdminApprove($request)
    {
        $id = $request['distributor_id'];

        $query = $this->customerApproval->select('*')
            ->where('distributor_id', $id)
            ->first();

        $query->admin_approval = $request['admin_approval'];
        $query->admin_remark = $request['admin_remark'];
        $query->admin = $request['admin'];

        $query->save();

        return $query;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function updateAccountApprove($request)
    {
        $id = $request['distributor_id'];

        $query = $this->customerApproval
            ->where('distributor_id', $id)
            ->update(['approval_status'=> $request['approval_status']]);
        return $query;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function updateDistStatus($id)
    {
        $query = DB::table('distributor_details')
                        ->where('id', $id)
                        ->update(['status'=> 1]);

        return $query;

    }
}