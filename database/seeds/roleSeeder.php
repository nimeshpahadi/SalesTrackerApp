<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table("roles")->insert([
            "name" => "admin",
            "display_name" => "Admin",
            "description" => "can view all",
        ]);

        DB::table("roles")->insert([
            "name" => "salesmanager",
            "display_name" => "SalesManager",
            "description" => "1. review revenue generation   2.Order Management",
        ]);

        DB::table("roles")->insert([
            "name" => "accountmanagersales",
            "display_name" => "Account Manager-Sales",
            "description" => "Account manager for the sale",
        ]);

        DB::table("roles")->insert([
            "name" => "factoryincharge",
            "display_name" => "Factory Incharge",
            "description" => "Inventory management and Order disptch",
        ]);

        DB::table("roles")->insert([
            "name" => "salesman",
            "display_name" => "Salesman",
            "description" => "sends order and can view their order in web",
        ]);

        DB::table("roles")->insert([
            "name" => "generalmanager",
            "display_name" => "General Manager",
            "description" => "general manager for whole system",
        ]);

        DB::table("roles")->insert([
            "name" => "director",
            "display_name" => "Director",
            "description" => "Director for all",
        ]);

        DB::table("roles")->insert([
            "name" => "account",
            "display_name" => "Account",
            "description" => "views Accounts",
        ]);


    }
}
