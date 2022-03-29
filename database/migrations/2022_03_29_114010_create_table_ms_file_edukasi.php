<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMsFileEdukasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_file_edukasi', function (Blueprint $table) {
            $table->bigIncrements('edu_id')->unsigned();
			$table->string('edu_desk_pdf', 100)->nullable();
			$table->string('edu_file_pdf', 100)->nullable();
			$table->string('edu_desk_video', 100)->nullable();
			$table->string('edu_file_video', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ms_file_edukasi');
    }
}
