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
            $table->string('state', 100);
            $table->string('tribe', 100);
            $table->enum('lineage', ['1', '2', '3']);
            $table->enum('marital_status', ['single', 'married', 'widowed', 'divorced']);
            $table->boolean('has_children');
            $table->unsignedTinyInteger('children_count')->nullable();
            $table->enum('education_level', ['illiterate', 'general', 'diploma', 'bachelor', 'master', 'phd']);
            $table->enum('work_sector', ['government', 'private', 'self_employed', 'unemployed']);
            $table->string('job_title', 255);
            $table->decimal('monthly_income', 10, 2);
            $table->string('religion', 255);
            $table->text('genetic_diseases')->nullable();
            $table->text('infectious_diseases')->nullable();
            $table->text('psychological_disorders')->nullable();
            $table->enum('housing_type', ['independent', 'family_annex', 'family_room', 'no_preference']);
            $table->text('health_status');
            $table->boolean('has_disability');
            $table->text('disability_details')->nullable();
            $table->boolean('has_deformity');
            $table->text('deformity_details')->nullable();
            $table->boolean('wants_children');
            $table->boolean('infertility');
            $table->boolean('is_smoker')->nullable()->default(false);
            $table->enum('religiosity_level', ['high', 'medium', 'low']);
            $table->enum('prayer_commitment', ['yes', 'sometimes', 'no']);
            $table->text('personal_description');
            $table->text('partner_expectations');
            $table->string('compatibility_test_link')->nullable();
            $table->integer('compatibility_test_result')->nullable();
            $table->boolean('test_link_sent')->default(false);
            $table->enum('admin_approval_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('marriage_requests');
    }
}
