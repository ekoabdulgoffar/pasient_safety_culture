<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTrResponPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_respon_post', function (Blueprint $table) {
            $table->bigIncrements('respon_post_id')->unsigned();
			$table->unsignedBigInteger('user_id');
			$table->string('respon_post_status', 200);
			$table->timestamp('respon_post_datetime')->default(\DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('tr_respon_post');
    }
}
