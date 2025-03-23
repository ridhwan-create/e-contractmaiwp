<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('projections', function (Blueprint $table) {
            $table->decimal('remaining_projection', 15, 2)->after('amount')->default(0);
        });
    }

    public function down() {
        Schema::table('projections', function (Blueprint $table) {
            $table->dropColumn('remaining_projection');
        });
    }
};
