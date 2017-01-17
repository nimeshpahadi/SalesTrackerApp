<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRemarkInDistributorTrackings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('distributor_trackings', function (Blueprint $table) {
            $table->dropColumn('is_our_customer');
            $table->string('remark')->nullable();
            $table->string('loss_reason')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('distributor_trackings', function (Blueprint $table) {
            $table->string('is_our_customer');
            $table->dropColumn('remark');
            $table->string('loss_reason')->nullable(false)->change();
        });
    }
}
