<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToCourseExamQuestionsTable extends Migration
{
    public function up()
    {
        Schema::table('course_exam_questions', function (Blueprint $table) {
            $table->foreignId('question_type_id')->after('id')->nullable()->constrained('question_types');
            $table->string('correct_answer')->nullable()->change(); // للسماح بأنواع أسئلة مختلفة
        });
    }

    public function down()
    {
        Schema::table('course_exam_questions', function (Blueprint $table) {
            $table->dropForeign(['question_type_id']);
            $table->dropColumn('question_type_id');
            $table->string('correct_answer')->change();
        });
    }
}