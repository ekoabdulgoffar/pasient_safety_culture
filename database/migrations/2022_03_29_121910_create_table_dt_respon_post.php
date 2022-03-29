<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDtResponPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dt_respon_post', function (Blueprint $table) {
            $table->bigIncrements('drespon_post')->unsigned();
			$table->unsignedBigInteger('respon_post_id');
			$table->unsignedBigInteger('dtpost_test_id');
			$table->string('drespon_jawaban', 200);
			$table->foreign('respon_post_id')->references('respon_post_id')->on('tr_respon_post');
			$table->foreign('dtpost_test_id')->references('dtpost_test_id')->on('dt_post_test');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dt_respon_post');
    }
}
