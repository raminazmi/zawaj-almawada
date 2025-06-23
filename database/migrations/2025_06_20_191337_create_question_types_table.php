<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionTypesTable extends Migration
{
    public function up()
    {
        Schema::create('question_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // مثال: اختيار من متعدد، صح/خطأ، نص قصير
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('question_types');
    }
}
