<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessActivitiesTable extends Migration
{
    public function up()
    {
        Schema::create('business_activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->enum('activity_type', [
                'محلات تأجير الخيام',
                'محلات تأجير القاعات',
                'محلات الأثاث',
                'مستلزمات الأعراس',
                'محلات التصميم والتصوير',
                'مطاعم تقديم الولائم'
            ]);
            $table->string('state');
            $table->boolean('offers_rewards');
            $table->enum('status', ['مقبول', 'مرفوض', 'قيد الانتظار'])->default('قيد الانتظار');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('business_activities');
    }
}
