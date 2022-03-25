<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableJenisPertanyaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_jenis_pertanyaan', function (Blueprint $table) {
            $table->bigIncrements('jenis_pertanyaan_id')->unsigned();
			$table->string('jenis_pertanyaan_deskripsi', 100);
			$table->string('jenis_pertanyaan_skala', 1000)->nullable();
			$table->string('jenis_pertanyaan_parameter', 1000)->nullable();
			$table->string('jenis_pertanyaan_created_by', 100);
			$table->string('jenis_pertanyaan_modified_by', 100);
			$table->timestamp('jenis_pertanyaan_created_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('jenis_pertanyaan_modified_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ms_jenis_pertanyaan');
    }
}
