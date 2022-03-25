<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePertanyaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_pertanyaan', function (Blueprint $table) {
            $table->bigIncrements('pertanyaan_id')->unsigned();
			$table->unsignedBigInteger('jenis_pertanyaan_id');
			$table->unsignedBigInteger('kelompok_pertanyaan_id')->nullable();;
			$table->string('pertanyaan_', 200);
			$table->string('pertanyaan_keterangan', 200);
			$table->string('pertanyaan_created_by', 100);
			$table->string('pertanyaan_modified_by', 100);
			$table->timestamp('pertanyaan_created_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('pertanyaan_modified_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
			$table->foreign('jenis_pertanyaan_id')->references('jenis_pertanyaan_id')->on('ms_jenis_pertanyaan');
			$table->foreign('kelompok_pertanyaan_id')->references('kelompok_pertanyaan_id')->on('ms_kelompok_pertanyaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ms_pertanyaan');
    }
}
