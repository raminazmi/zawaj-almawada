<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuestionTypeSeeder extends Seeder
{
    public function run()
    {
        \DB::table('question_types')->insert([
            ['name' => 'اختيار من متعدد'],
            ['name' => 'صح أو خطأ'],
            ['name' => 'نص قصير'],
        ]);
    }
}
