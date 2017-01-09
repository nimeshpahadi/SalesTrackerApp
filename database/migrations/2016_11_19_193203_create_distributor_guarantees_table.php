<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributorGuaranteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributor_guarantees', function (Blueprint $table) {
//            $table->increments('id');
            $table->integer('distributor_id')->unsigned();
            $table->string('type');
            $table->bigInteger('amount')->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('distributor_id')->references('id')->on('distributor_details')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['distributor_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distributor_guarantees');
    }
}
