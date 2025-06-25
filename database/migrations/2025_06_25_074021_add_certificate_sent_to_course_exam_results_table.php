
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('course_exam_results', function (Blueprint $table) {
            if (!Schema::hasColumn('course_exam_results', 'certificate_sent')) {
                $table->boolean('certificate_sent')->default(false)->after('answers');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_exam_results', function (Blueprint $table) {
            if (Schema::hasColumn('course_exam_results', 'certificate_sent')) {
                $table->dropColumn('certificate_sent');
            }
        });
    }
};
