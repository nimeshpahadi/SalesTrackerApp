<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table("users")->insert([
            "fullname" => "Admin",
            "username" => "admin",
            "email" => "admin@admin.com",
            "department" => "Marketing",
            "password" => bcrypt("admin123"),
            "contact" => "1234567890",
            "reportsto" => 1,

        ]);

    }
}
