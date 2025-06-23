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
            Schema::table('course_exam_question_options', function (Blueprint $table) {
                // This will rename the 'option_text' column to 'text'
                $table->renameColumn('option_text', 'text');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('course_exam_question_options', function (Blueprint $table) {
                // This allows you to roll back the change if needed
                $table->renameColumn('text', 'option_text');
            });
        }
    };