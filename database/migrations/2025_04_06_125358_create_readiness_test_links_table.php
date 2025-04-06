<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReadinessTestLinksTable extends Migration
{
    public function up()
    {
        Schema::create('readiness_test_links', function (Blueprint $table) {
            $table->id();
            $table->string('link')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('readiness_test_links');
    }
}
