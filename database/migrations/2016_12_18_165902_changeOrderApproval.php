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
        Schema::table('order_approvals', function ($table) {

            $table->string('approval_status');
            $table->dropForeign('order_approvals_salesmanager_foreign');
            $table->dropColumn('salesmanager')->nullable(false)->change();
            $table->dropForeign('order_approvals_marketingmanager_foreign');
            $table->dropColumn('marketingmanager')->nullable(false)->change();
            $table->dropForeign('order_approvals_admin_foreign');
            $table->dropColumn('admin')->nullable(false)->change();
            $table->dropColumn('sales_approval');
            $table->dropColumn('marketing_approval');
            $table->dropColumn('admin_approval');

        });
    }
}
