<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAreaIdForeignInDistributorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('distributor_details', function (Blueprint $table) {
            $table->integer('area_id')->unsigned()->nullable();
            $table->string('area');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('distributor_details', function (Blueprint $table) {
            $table->dropColumn('area_id');
            $table->dropColumn('area');
        });
    }
}
