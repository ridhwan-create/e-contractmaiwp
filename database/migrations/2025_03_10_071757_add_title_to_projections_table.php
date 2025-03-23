<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('projections', function (Blueprint $table) {
            $table->string('title')->after('id');
        });
    }

    public function down()
    {
        Schema::table('projections', function (Blueprint $table) {
            $table->dropColumn('title');
        });
    }
};
