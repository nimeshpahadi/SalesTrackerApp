<?php
/**
 * Created by PhpStorm.
 * User: prakash
 * Date: 11/11/16
 * Time: 4:51 AM
 */

namespace App\SalesTracker\Repositories;


use App\FactoryinchargeWarehouse;
use App\User;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use League\Flysystem\Exception;

class UserRepository
{
    /**
     * @var User
     */
    public $user;
    /**
     * @var Log
     */
    private $log;
    /**
     * @var FactoryinchargeWarehouse
     */
    private $factoryinchargeWarehouse;

    public function __construct(User $user, Log $log,FactoryinchargeWarehouse $factoryinchargeWarehouse)
    {
        $this->user = $user;
        $this->log = $log;
        $this->factoryinchargeWarehouse = $factoryinchargeWarehouse;
    }

    /**
     * select all user
     * @return mixed
     */
    public function getUser()
    {
        $query = $this->user->select('*');
        return $query->get();
    }

    /**
     * Select specific user
     * @param $id
     * @return mixed
     */
    public function selectUser($id)
    {
        $query = $this->user->find($id);
        return $query;
    }


    /**
     * update the users
     * @param $request
     * @param $id
     */
    public function updateuser($request, $id)
    {
        try {
            $query = $this->user->find($id);
            $query->fullname = $request->fullname;
            $query->username = $request->username;
            $query->department = $request->department;
            $query->reportsto = $request->reportsto;
            $query->email = $request->email;
            $query->contact = $request->contact;
            $query->save();
            $this->log->info("User Updated", ['id' => $id]);
            return true;

        } catch (QueryException $e) {
            $this->log->error("User Update Failed", ['id' => $id]);

            return false;
        }

    }

    /** delete the specific user
     * @param $id
     * @return mixed
     */
    public function deleteUserId($id)
    {
        try {
            $query = $this->user->find($id);
            $query->delete();
            $query;
            $this->log->info("User Deleted", ['id' => $id]);

            return true;
        } catch (Exception $e) {
            $this->log->error("User Delete Failed", ['id' => $id]);

            return false;
        }


    }

    public function ChangePassword($request, $id)
    {
        try {
            $data  = $this->user->find($id);

          if ( Hash::check($request['oldpassword'],$data->password)) {
              $data->password = bcrypt($request->password);
              $data->save();
              $this->log->info(" Password Changed ", ['id' => $id]);

              return true;
          }
        } catch (Exception $e) {
            $this->log->error("Password Changing Failed", ['id' => $id]);

            return false;
        }
    }

    public function ResetPassword($request, $id)
    {

        try {
            $data = $this->user->find($id);
            $data->password = bcrypt($request->password);
            $data->save();
            $this->log->info(" Password Reset ", ['id' => $id]);
            return true;
        } catch (Exception $e) {
            $this->log->error("Password Reseting Failed", ['id' => $id]);
            return false;
        }
    }

    public function getFactoryWarehouse($id)
    {
        $query = $this->factoryinchargeWarehouse->select('warehouses.name as wname','factoryincharge_warehouses.user_id as userid')
                ->join('warehouses','warehouses.id','factoryincharge_warehouses.warehouse_id')
            ->where('user_id',$id);
        return $query->first();

    }


}













