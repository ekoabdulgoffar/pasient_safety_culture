<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSkor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_skor', function (Blueprint $table) {
            $table->bigIncrements('skor_id')->unsigned();
			$table->integer('skor_max');
			$table->string('skor_deskripsi', 100);
			$table->string('skor_warna', 100);
			$table->string('skor_ikon', 200);
			$table->string('skor_created_by', 100);
			$table->string('skor_modified_by', 100);
			$table->timestamp('skor_created_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('skor_modified_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ms_skor');
    }
}
