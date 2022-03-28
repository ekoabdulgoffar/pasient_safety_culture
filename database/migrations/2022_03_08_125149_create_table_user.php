<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_user', function (Blueprint $table) {
            $table->bigIncrements('user_id')->unsigned();
			$table->string('user_username', 100)->nullable();;
			$table->string('user_password', 100)->nullable();;
			$table->string('user_email', 100)->nullable();;
			$table->string('user_name', 100)->nullable();;
			$table->string('user_phone', 100)->nullable();;
			$table->integer('user_status');
			$table->string('user_created_by', 100);
			$table->string('user_modified_by', 100);
			$table->timestamp('user_created_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('user_modified_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
			$table->string('user_npa', 50)->nullable();
			$table->integer('user_jenis_kelamin')->nullable();
			$table->date('user_tanggal_lahir')->nullable();
			$table->string('user_alamat', 200)->nullable();
			$table->string('user_pendidikan_terakhir', 20)->nullable();
			$table->string('user_provinsi', 100)->nullable();
			$table->string('user_cabang_keanggotaan', 100)->nullable();
			$table->string('user_wilayah_keanggotaan', 100)->nullable();
			$table->string('user_role', 100)->nullable();
			$table->timestamp('user_last_login')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ms_user');
    }
}
