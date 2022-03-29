<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDtPostTest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dt_post_test', function (Blueprint $table) {
            $table->bigIncrements('dtpost_test_id')->unsigned();
			$table->unsignedBigInteger('post_test_id');
			$table->unsignedBigInteger('pertanyaan_post_id');
			$table->foreign('post_test_id')->references('post_test_id')->on('ms_post_test');
			$table->foreign('pertanyaan_post_id')->references('pertanyaan_post_id')->on('ms_pertanyaan_post');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dt_post_test');
    }
}
