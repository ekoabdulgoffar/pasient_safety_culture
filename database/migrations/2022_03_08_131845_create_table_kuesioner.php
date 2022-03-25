<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKuesioner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_kuesioner', function (Blueprint $table) {
            $table->bigIncrements('kuesioner_id')->unsigned();
			$table->string('kuesioner_deskripsi', 200);
			$table->string('kuesioner_created_by', 100);
			$table->string('kuesioner_modified_by', 100);
			$table->timestamp('kuesioner_created_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('kuesioner_modified_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ms_kuesioner');
    }
}
