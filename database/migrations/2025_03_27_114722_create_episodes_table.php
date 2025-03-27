<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->integer('episode_number');
            $table->string('title');
            $table->string('url');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('episodes');
    }
}
