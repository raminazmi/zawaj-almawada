<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('marriage_requests', function (Blueprint $table) {
            $table->string('partner_full_name')->nullable()->after('admin_approval_status');
            $table->string('partner_village')->nullable()->after('partner_full_name');
            $table->string('partner_test_link')->nullable()->after('partner_village');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('marriage_requests', function (Blueprint $table) {
            $table->dropColumn(['partner_full_name', 'partner_village', 'partner_test_link']);
        });
    }
};
