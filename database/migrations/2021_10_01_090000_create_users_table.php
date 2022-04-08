<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 50)->unique();
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->string('nik')->unique();
            $table->string('kk')->nullable();
            $table->string('nama');
            $table->string('foto');
            $table->UnsignedTinyInteger('user_group');
            $table->string('kode_ppat')->nullable();
            $table->string('hp')->nullable();
            $table->string('wa', 20)->nullable();
            $table->string('tg', 20)->nullable();
            $table->tinyInteger('status_user')->nullable();
            $table->dateTime('terakhir')->nullable();
            $table->string('token');
            $table->string('deskripsi')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
