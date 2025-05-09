<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStatusColumnInMarriageRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('marriage_requests', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected', 'engaged', 'awaiting_admin_approval'])
                ->default('pending')
                ->change();
        });
    }

    public function down()
    {
        Schema::table('marriage_requests', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected', 'engaged'])
                ->default('pending')
                ->change();
        });
    }
}
