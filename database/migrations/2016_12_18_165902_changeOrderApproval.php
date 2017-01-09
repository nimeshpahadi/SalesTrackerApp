<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeOrderApproval extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_approvals', function ($table) {

            $table->dropColumn('approval_status');
            $table->integer('salesmanager')->unsigned()->nullable();
            $table->integer('marketingmanager')->unsigned()->nullable();
            $table->integer('admin')->unsigned()->nullable();
            $table->string('sales_approval');
            $table->string('marketing_approval');
            $table->string('admin_approval');


            $table->foreign('salesmanager')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('marketingmanager')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
             $table->foreign('admin')->references('id')->on('users')
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
