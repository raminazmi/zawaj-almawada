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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('target_user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('request_number')->unique();
            $table->enum('applicant_type', ['male', 'female']);
            $table->enum('status', ['pending', 'approved', 'rejected', 'engaged'])->default('pending');
            $table->string('state')->nullable();
            $table->integer('age')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->string('tribe')->nullable();
            $table->enum('skin_color', ['white', 'wheat', 'brown'])->nullable();
            $table->enum('lineage', ['1', '2', '3'])->nullable();
            $table->enum('marital_status', ['single', 'married', 'widowed', 'divorced'])->nullable();
            $table->boolean('has_children')->nullable();
            $table->integer('children_count')->nullable();
            $table->enum('education_level', ['illiterate', 'general', 'diploma', 'bachelor', 'master', 'phd'])->nullable();
            $table->enum('work_sector', ['government', 'private', 'self_employed', 'unemployed'])->nullable();
            $table->string('job_title')->nullable();
            $table->decimal('monthly_income', 10, 2)->nullable();
            $table->string('religion')->nullable();
            $table->text('genetic_diseases')->nullable();
            $table->text('infectious_diseases')->nullable();
            $table->text('psychological_disorders')->nullable();
            $table->enum('housing_type', ['independent', 'family_annex', 'family_room', 'no_preference'])->nullable();
            $table->text('health_status')->nullable();
            $table->boolean('has_disability')->nullable();
            $table->text('disability_details')->nullable();
            $table->boolean('has_deformity')->nullable();
            $table->text('deformity_details')->nullable();
            $table->boolean('wants_children')->nullable();
            $table->boolean('infertility')->nullable();
            $table->boolean('is_smoker')->nullable(); // للشاب فقط
            $table->enum('religiosity_level', ['high', 'medium', 'low'])->nullable();
            $table->enum('prayer_commitment', ['yes', 'sometimes', 'no'])->nullable();
            $table->text('personal_description')->nullable();
            $table->text('partner_expectations')->nullable();
            $table->string('compatibility_test_link')->nullable();
            $table->string('real_name')->nullable();
            $table->string('village')->nullable();
            $table->boolean('admin_approved')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('marriage_requests');
    }
}
