<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pasiens', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('no_hp');
        });
    }

    public function down()
    {
        Schema::table('pasiens', function (Blueprint $table) {
            $table->dropColumn('photo');
        });
    }
};
