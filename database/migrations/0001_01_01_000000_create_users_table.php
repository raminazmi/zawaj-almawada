<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('membership_number', 6)->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('google_id')->nullable();
            $table->string('age')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('skin_color')->nullable();
            $table->string('state', 100)->nullable();
            $table->string('tribe', 100)->nullable();
            $table->enum('lineage', ['1', '2', '3'])->nullable();
            $table->enum('marital_status', ['single', 'married', 'widowed', 'divorced'])->nullable();
            $table->boolean('has_children')->nullable();
            $table->unsignedTinyInteger('children_count')->nullable();
            $table->enum('education_level', ['illiterate', 'general', 'diploma', 'bachelor', 'master', 'phd'])->nullable();
            $table->enum('work_sector', ['government', 'private', 'self_employed', 'unemployed'])->nullable();
            $table->string('job_title', 255)->nullable();
            $table->decimal('monthly_income', 10, 2)->nullable();
            $table->string('religion', 255)->nullable();
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
            $table->boolean('is_smoker')->nullable();
            $table->enum('religiosity_level', ['high', 'medium', 'low'])->nullable();
            $table->enum('prayer_commitment', ['yes', 'sometimes', 'no'])->nullable();
            $table->text('personal_description')->nullable();
            $table->text('partner_expectations')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('is_active')->default(false);
            $table->string('password');
            $table->rememberToken();
            $table->enum('status', ['available', 'pending', 'engaged'])->default('available');
            $table->boolean('is_admin')->default(false);
            $table->enum('admin_role', ['main', 'sub'])->nullable();
            $table->enum('profile_status', ['default', 'pending', 'approved', 'rejected'])->default('default');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
