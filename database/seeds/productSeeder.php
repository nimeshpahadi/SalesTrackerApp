<?php

use Illuminate\Database\Seeder;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("products")->insert(

            [
                'category' => 'Cement',
                'sub_category' => 'OPC',
                'name' => "Advance",
                'code' => "AD001",
                'description' => "construction",
                'price' => "890",
                'image' => "images.jpg"
            ]);
        DB::table("products")->insert(
            [
                'category' => 'Cement',
                'sub_category' => 'PPC',
                'name' => "Advance",
                'code' => "AD002",
                'description' => "construction building",
                'price' => "900",
                'image' => "images.jpg"
            ]

        );
    }
}
