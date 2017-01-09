<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_approvals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('distributor_id')->unsigned()->nullable();
            $table->string('approval_status');
            $table->integer('salesmanager')->unsigned()->nullable();
            $table->integer('admin')->unsigned()->nullable();
            $table->string('sales_approval');
            $table->string('admin_approval');
            $table->string('sale_remark');
            $table->string('admin_remark');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('distributor_id')->references('id')
                ->on('distributor_details')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('salesmanager')->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('admin')->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_approvals');
    }
}
