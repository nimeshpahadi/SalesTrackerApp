<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // $this->call(userSeeder::class);
       //    $this->call(roleSeeder::class);
        $this->call(userroleSeeder::class);
        $this->call(productSeeder::class);
        $this->call(warehouseSeeder::class);

    }
}
