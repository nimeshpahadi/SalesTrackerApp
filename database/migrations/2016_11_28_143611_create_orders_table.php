<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('distributor_id')->unsigned();
            $table->integer('quantity');
            $table->integer('price');
            $table->string('priority');
            $table->string('payment_term');
            $table->date('proposed_delivery_date');
            $table->timestamps();
            $table->foreign('product_id')->references('id')
                                         ->on('products')
                                         ->onUpdate('cascade')
                                         ->onDelete('cascade');
            $table->foreign('user_id')->references('id')
                                      ->on('users')
                                      ->onUpdate('cascade')
                                      ->onDelete('cascade');
            $table->foreign('distributor_id')->references('id')
                                             ->on('distributor_details')
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
        Schema::dropIfExists('orders');
    }
}