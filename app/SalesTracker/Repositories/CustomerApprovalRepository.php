<?php
/**
 * Created by PhpStorm.
 * User: trees
 * Date: 12/25/16
 * Time: 2:09 PM
 */

namespace App\SalesTracker\Repositories;


use App\SalesTracker\Entities\CustomerApproval;
use App\SalesTracker\Entities\Distributor\DistributorDetails;
use Illuminate\Support\Facades\DB;

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
     * CustomerApprovalRepository constructor.
     * @param DistributorDetails $distributorDetails
     * @param CustomerApproval $customerApproval
     */
    public function __construct(DistributorDetails $distributorDetails, CustomerApproval $customerApproval)
    {
        $this->distributorDetails = $distributorDetails;
        $this->customerApproval = $customerApproval;
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
            ->join('users', 'users.id', 'customer_approvals.salesmanager')
            ->join('role_user', 'role_user.user_id', 'users.id')
            ->join('roles', 'roles.id', 'role_user.role_id')
            ->select('customer_approvals.*', 'users.username', 'roles.display_name')
            ->where('distributor_id', $id)
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
     * @return mixed
     */
    public function insertSaleApproveUpdate($request)
    {
        $id = $request['distributor_id'];

        $query = $this->customerApproval->select('*')
                                        ->where('distributor_id', $id)
                                        ->first();

        $query->sales_approval = $request['sales_approval'];

        $query->save();

        return $query;
    }

    /**
     * @param $request
     * @return static
     */
    public function insertSaleReject($request)
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

        $query->admin = $request['admin'];
        $query->admin_approval = $request['admin_approval'];

        $query->save();

        return $query;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function updateAdminReject($request)
    {
        $id = $request['distributor_id'];

        $query = $this->customerApproval->select('*')
            ->where('distributor_id', $id)
            ->first();

        $query->admin          = $request['admin'];
        $query->admin_approval = $request['admin_approval'];
        $query->admin_remark   = $request['admin_remark'];

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