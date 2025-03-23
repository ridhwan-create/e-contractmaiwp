<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('projections', function (Blueprint $table) {
            $table->string('entity_code')->after('year');
            $table->string('fund_code')->after('entity_code');
            $table->string('asnaf_code')->after('fund_code');
            $table->string('department_code')->after('asnaf_code');
            $table->string('program_code')->after('department_code');
            $table->string('project_code')->after('program_code');
            $table->unsignedBigInteger('expense_code_id')->after('project_code');

            // Jika ada foreign key untuk kod belanja (expense_code_id)
            $table->foreign('expense_code_id')->references('id')->on('expense_codes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('projections', function (Blueprint $table) {
            $table->dropForeign(['expense_code_id']);
            $table->dropColumn([
                'entity_code',
                'fund_code',
                'asnaf_code',
                'department_code',
                'program_code',
                'project_code',
                'expense_code_id',
            ]);
        });
    }
};
