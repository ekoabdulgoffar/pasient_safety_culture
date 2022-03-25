<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDkuesioner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dt_dkuesioner', function (Blueprint $table) {
            $table->bigIncrements('dkuesioner_id')->unsigned();
			$table->unsignedBigInteger('pertanyaan_id');
			$table->unsignedBigInteger('kuesioner_id')->nullable();
			$table->foreign('pertanyaan_id')->references('pertanyaan_id')->on('ms_pertanyaan');
			$table->foreign('kuesioner_id')->references('kuesioner_id')->on('ms_kuesioner');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dt_dkuesioner');
    }
}
