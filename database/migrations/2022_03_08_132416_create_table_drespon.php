<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDrespon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dt_drespon', function (Blueprint $table) {
            $table->bigIncrements('drespon_id')->unsigned();
			$table->unsignedBigInteger('respon_id');
			$table->unsignedBigInteger('dkuesioner_id');
			$table->string('drespon_jawaban', 200);
			$table->string('drespon_keterangan', 200);
			$table->foreign('respon_id')->references('respon_id')->on('tr_respon');
			$table->foreign('dkuesioner_id')->references('dkuesioner_id')->on('dt_dkuesioner');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dt_drespon');
    }
}
