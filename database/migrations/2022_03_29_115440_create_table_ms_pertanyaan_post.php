<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMsPertanyaanPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_pertanyaan_post', function (Blueprint $table) {
            $table->bigIncrements('pertanyaan_post_id')->unsigned();
			$table->string('pertanyaan_post_', 200);
			$table->string('pertanyaan_post_pilihan', 500);
			$table->string('pertanyaan_post_kunci', 500);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ms_pertanyaan_post');
    }
}
