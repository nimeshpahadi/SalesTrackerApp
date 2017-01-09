<?php

namespace App\Http\Controllers\Auth;

use App\FactoryinchargeWarehouse;
use App\Http\Requests\RegisterRequest;
use App\Roleuser;
use App\SalesTracker\Services\UserService;
use App\User;
use Illuminate\Http\Request;
use League\Flysystem\Exception;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/user';
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
{
    $this->userService = $userService;
}

    public function register(RegisterRequest $request)
    {
        if ($user = $this->create($request->all()))
        {
            $userRole = [
                'user_id' => $user->id,
                'role_id' => $request->get('role')
            ];
            if ($user['role']=4)
            {
                $assignWarehouse=[
                    'user_id' => $user->id,
                    'warehouse_id' => $request->get('warehouse_id')

                ];
                $this->assignWarehouse($assignWarehouse);

            }
            
            $this->assignRole($userRole);

            return redirect('/user')->withSuccess("user added!");
        }
        return back()->withErrors("Something went wrong");
    }


    protected function create(array $data)
    {
        try {

            return User::create([
                'fullname' => $data['fullname'],
                'username' => $data['username'],
                'department' => $data['department'],
                'role' => $data['role'],
                'reportsto' => $data['reportsto'],
                'warehouse_id' => $data['warehouse_id'],
                'email' => $data['email'],
                'contact' => $data['contact'],
                'password' => bcrypt($data['password']),

            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    protected function assignRole(array $data)
    {
        return Roleuser::create($data);
    }
    protected function assignWarehouse(array $data)
    {
        return FactoryinchargeWarehouse::create($data);
    }


    public function password($id)
    {
        $user = $this->userService->selectUsers($id);
        return view('user.password',compact('user'));
    }

    public function changepassword(RegisterRequest $request, $id)
    {
        if ($this->userService->changePassword($request, $id)) {
            return redirect('/home')->withSuccess('password Changed');
        }
        return back()->withErrors('old password may be wrong');
    }
    public function resetpassword(RegisterRequest $request, $id)
    {
        if ($this->userService->resetPassword($request, $id)) {
            return redirect('/home')->withSuccess('password reset');
        }
        return back()->withErrors('something may be wrong');
    }
}
