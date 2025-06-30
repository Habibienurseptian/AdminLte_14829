<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToPeriksasTable extends Migration
{
    public function up()
    {
        Schema::table('periksas', function (Blueprint $table) {
            $table->string('status')->default('belum')->after('biaya_periksa');
        });
    }

    public function down()
    {
        Schema::table('periksas', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
