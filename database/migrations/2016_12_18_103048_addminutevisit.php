<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addminutevisit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('distributor_minutes', function ($table) {
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();

        });

        Schema::table('distributor_trackings', function ($table) {
            $table->double('latitude')->nullable();
            $table->integer('user_id')->unsigned();
            $table->double('longitude')->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
