<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course_exams', function (Blueprint $table) {
            $table->index(['start_time', 'end_time']);
        });
    }

    public function down(): void
    {
        Schema::table('course_exams', function (Blueprint $table) {
            $table->dropIndex(['start_time', 'end_time']);
        });
    }
};
