<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKelompokPertanyaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_kelompok_pertanyaan', function (Blueprint $table) {
            $table->bigIncrements('kelompok_pertanyaan_id')->unsigned();
			$table->string('kelompok_pertanyaan_deskripsi', 100);
			$table->string('kelompok_pertanyaan_created_by', 100);
			$table->string('kelompok_pertanyaan_modified_by', 100);
			$table->timestamp('kelompok_pertanyaan_created_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('kelompok_pertanyaan_modified_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ms_kelompok_pertanyaan');
    }
}
