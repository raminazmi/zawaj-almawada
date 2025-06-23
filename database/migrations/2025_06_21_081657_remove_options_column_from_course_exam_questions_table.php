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
            Schema::table('course_exam_questions', function (Blueprint $table) {
                // This will check if the column exists before trying to drop it.
                if (Schema::hasColumn('course_exam_questions', 'options')) {
                    $table->dropColumn('options');
                }
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('course_exam_questions', function (Blueprint $table) {
                // If we ever need to roll back, we can add the column back.
                $table->text('options')->nullable();
            });
        }
    };