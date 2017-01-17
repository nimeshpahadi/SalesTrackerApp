<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStockOut extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_outs', function ($table) {
            $table->string('driver_name');
            $table->string('vechile_no');
            $table->string('driver_contact');

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('stock_outs', function ($table) {
            $table->dropColumn('driver_name');
            $table->dropColumn('vechile_no');
            $table->dropColumn('driver_contact');

        });

    }
}
