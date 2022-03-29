<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTrEdukasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_edukasi', function (Blueprint $table) {
            $table->bigIncrements('tr_edu_id')->unsigned();
			$table->unsignedBigInteger('edu_id');
			$table->unsignedBigInteger('user_id');
			$table->integer('tr_edu_isPdf')->nullable();
			$table->integer('tr_edu_isVideo')->nullable();;
			$table->timestamp('datetime_update')->default(\DB::raw('CURRENT_TIMESTAMP'));
			$table->foreign('edu_id')->references('edu_id')->on('ms_file_edukasi');
			$table->foreign('user_id')->references('user_id')->on('ms_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_edukasi');
    }
}
