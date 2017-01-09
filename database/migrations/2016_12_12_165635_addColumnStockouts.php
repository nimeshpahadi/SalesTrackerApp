<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnStockouts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_outs', function ($table) {
            $table->dropForeign('stock_outs_warehouse_id_foreign');
            $table->dropForeign('stock_outs_product_id_foreign');

            $table->dropColumn('warehouse_id');
            $table->dropColumn('created_by');
            $table->dropColumn('product_id');
            $table->integer('dispatched_by')->unsigned();
            $table->integer('order_out_id')->unsigned();

            $table->foreign('dispatched_by')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('order_out_id')->references('id')->on('order_outs')
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

    }
}
