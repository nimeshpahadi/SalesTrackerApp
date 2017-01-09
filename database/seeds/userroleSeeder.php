<?php

use Illuminate\Database\Seeder;

class userroleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users=[ "admin"];
        $roles=[ "admin"];

        foreach ($users as $index=>$value)
        {

            $roleData = DB::table('roles')
                ->select('id')
                ->where('name', $roles[$index])->first();

            $userData = DB::table('users')
                ->select('id')
                ->where('username', $value)->first();

            DB::table('role_user')
                ->insert([
                    "role_id" => $roleData->id,
                    "user_id" => $userData->id
                ]);
        }



    }
}
