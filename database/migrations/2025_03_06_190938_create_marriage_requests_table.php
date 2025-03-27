<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarriageRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('marriage_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('target_user_id')->constrained('users')->cascadeOnDelete();
            $table->string('request_number', 50)->unique();
            $table->enum('applicant_type', ['male', 'female']);
            $table->enum('status', ['pending', 'approved', 'rejected', 'engaged'])->default('pending');
            $table->string('compatibility_test_link')->default('/exam/pledge');
            $table->integer('compatibility_test_result')->nullable();
            $table->boolean('test_link_sent')->default(false);
            $table->enum('admin_approval_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->unsignedBigInteger('exam_id')->nullable();
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('marriage_requests');
    }
}
