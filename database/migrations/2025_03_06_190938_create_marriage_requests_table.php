<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('marriage_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('applicant_type', ['male', 'female']);
            $table->string('request_number')->unique();

            // البيانات المشتركة
            $table->string('state');
            $table->integer('age');
            $table->integer('height');
            $table->integer('weight');
            $table->string('tribe');
            $table->enum('skin_color', ['white', 'wheat', 'brown']);
            $table->enum('lineage', ['1', '2', '3']);
            $table->enum('marital_status', ['single', 'married', 'widowed', 'divorced']);
            $table->boolean('has_children')->default(false);
            $table->integer('children_count')->nullable();
            $table->enum('education_level', ['illiterate', 'general', 'diploma', 'bachelor', 'master', 'phd']);
            $table->enum('work_sector', ['government', 'private', 'self_employed', 'unemployed']);
            $table->string('job_title');
            $table->decimal('monthly_income', 10, 2);
            $table->string('religion');
            $table->text('genetic_diseases')->nullable();
            $table->text('infectious_diseases')->nullable();
            $table->text('psychological_disorders')->nullable();
            $table->enum('housing_type', ['independent', 'family_annex', 'family_room']);
            $table->text('health_status');
            $table->boolean('has_disability')->default(false);
            $table->text('disability_details')->nullable();
            $table->boolean('has_deformity')->default(false);
            $table->text('deformity_details')->nullable();
            $table->boolean('wants_children')->default(true);
            $table->boolean('infertility')->default(false);
            $table->enum('religiosity_level', ['high', 'medium', 'low']);
            $table->enum('prayer_commitment', ['yes', 'sometimes', 'no']);
            $table->text('personal_description');

            // مواصفات الشريك المطلوب
            $table->text('partner_expectations');

            // حالة الطلب
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('target_user_id')->nullable()->constrained('users');
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('rejected_at')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('marriage_requests');
    }
};
