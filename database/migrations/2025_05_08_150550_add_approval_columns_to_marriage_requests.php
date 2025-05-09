<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovalColumnsToMarriageRequests extends Migration
{
    public function up()
    {
        Schema::table('marriage_requests', function (Blueprint $table) {
            $table->boolean('user_approval')->nullable();
            $table->boolean('target_approval')->nullable();
        });
    }

    public function down()
    {
        Schema::table('marriage_requests', function (Blueprint $table) {
            $table->dropColumn('user_approval');
            $table->dropColumn('target_approval');
        });
    }
}
