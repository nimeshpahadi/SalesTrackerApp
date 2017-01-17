<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerGuaranteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('distributor_guarantees', function (Blueprint $table) {
            $table->string('bank_name')->nullable();
            $table->string('cheque_no')->nullable();
            $table->string('remark')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('distributor_guarantees', function (Blueprint $table) {
            $table->dropColumn('bank_name');
            $table->dropColumn('cheque_no');
            $table->dropColumn('remark');

        });
    }
}
