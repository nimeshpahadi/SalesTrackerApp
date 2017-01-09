<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributor_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name')->unique();
            $table->string('contact_name');
            $table->string('email')->unique()->nullable();
            $table->bigInteger('mobile')->unique();
            $table->bigInteger('phone');
            $table->string('zone');
            $table->string('district');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->string('lead_source');
            $table->string('type');
            $table->boolean('status')->nullable();
            $table->date('open_date')->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distributor_details');
    }
}