<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRespon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_respon', function (Blueprint $table) {
            $table->bigIncrements('respon_id')->unsigned();
			$table->unsignedBigInteger('user_id');
			$table->timestamp('respon_datetime')->default(\DB::raw('CURRENT_TIMESTAMP'));
			$table->foreign('user_id')->references('user_id')->on('ms_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_respon');
    }
}
