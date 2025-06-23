<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseExamQuestionOptionsTable extends Migration
{
    public function up()
    {
        Schema::create('course_exam_question_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_exam_question_id')->constrained()->onDelete('cascade');
            $table->string('option_text');
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_exam_question_options');
    }
}