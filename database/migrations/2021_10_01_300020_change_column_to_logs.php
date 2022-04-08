<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnToLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logs', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->after('id');
            $table->unsignedInteger('dokumen_id')->nullable()->after('kegiatan');
            $table->string('kegiatan', 1000)->nullable()->change();
            $table->dropColumn('id_dokumen');
            $table->dropColumn('id_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
