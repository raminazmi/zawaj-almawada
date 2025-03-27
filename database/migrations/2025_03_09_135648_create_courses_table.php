<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('course_description')->nullable();
            $table->string('ebook_url')->nullable();
            $table->string('youtube_playlist');
            $table->string('registration_link');
            $table->text('supporting_companies');
            $table->string('intro_video')->nullable();
            $table->string('exam_link')->nullable();
            $table->date('exam_date')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('honor_students')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
