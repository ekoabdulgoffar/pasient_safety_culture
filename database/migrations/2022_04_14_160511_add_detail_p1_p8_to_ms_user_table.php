<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailP1P8ToMsUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ms_user', function (Blueprint $table) {
            $table->string('user_p1', 500)->nullable();
			$table->string('user_p2', 500)->nullable();
			$table->string('user_p3', 500)->nullable();
			$table->string('user_p4', 500)->nullable();
			$table->string('user_p5', 500)->nullable();
			$table->string('user_p6', 500)->nullable();
			$table->string('user_p7', 500)->nullable();
			$table->string('user_p8', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ms_user', function (Blueprint $table) {
            //
        });
    }
}
