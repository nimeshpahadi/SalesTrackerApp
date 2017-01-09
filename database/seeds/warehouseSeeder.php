<?php

use Illuminate\Database\Seeder;

class warehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table("warehouses")->insert(
            [
                'name' => 'Aabukhaireni',
                'location' => "aabukhaireni"
            ]);
        DB::table("warehouses")->insert(
            [
                'name' => 'Jitpur',
                'location' => "jitpur"
            ]);
        DB::table("warehouses")->insert(
            [
                'name' => 'Rolpa',
                'location' => "rolpa"
            ]
        );
        DB::table("warehouse_product")->insert([
            "product_id" => "1",
            "warehouse_id" => "1",
        ]);
        DB::table("warehouse_product")->insert([
            "product_id" => "1",
            "warehouse_id" => "2",
        ]);
        DB::table("warehouse_product")->insert([
            "product_id" => "1",
            "warehouse_id" => "3",
        ]);
        DB::table("warehouse_product")->insert([
            "product_id" => "2",
            "warehouse_id" => "1",
        ]);
        DB::table("warehouse_product")->insert([
            "product_id" => "2",
            "warehouse_id" => "2",
        ]);

        DB::table("warehouse_product")->insert([
            "product_id" => "2",
            "warehouse_id" => "3",
        ]);
    }
}









