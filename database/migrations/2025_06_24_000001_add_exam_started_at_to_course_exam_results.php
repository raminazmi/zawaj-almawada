<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course_exam_results', function (Blueprint $table) {
            $table->dateTime('exam_started_at')->nullable()->after('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('course_exam_results', function (Blueprint $table) {
            $table->dropColumn('exam_started_at');
        });
    }
};
