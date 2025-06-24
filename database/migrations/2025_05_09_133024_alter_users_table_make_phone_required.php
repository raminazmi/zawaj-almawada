<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class AlterUsersTableMakePhoneRequired extends Migration
{
    public function up()
    {
        // تحديث القيم NULL إلى قيمة افتراضية
        DB::table('users')->whereNull('phone')->update(['phone' => 'غير محدد']);

        // تعديل العمود ليصبح NOT NULL
        DB::statement('ALTER TABLE users MODIFY phone VARCHAR(255) NOT NULL');
    }

    public function down()
    {
        DB::statement('ALTER TABLE users MODIFY phone VARCHAR(255) NULL');
        DB::table('users')->where('phone', 'غير محدد')->update(['phone' => null]);
    }
}
