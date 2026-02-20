<?php

namespace Database\Seeders;

use App\Models\Questiontype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Questiontype::create(['name' => 'MCQ', 'sortid' => 1, 'will_have_ans_choice' => 'Yes', 'created_at' => now(), 'updated_at' => now()]);
        Questiontype::create(['name' => 'Short Question', 'sortid' => 2, 'will_have_ans_choice' => 'No', 'created_at' => now(), 'updated_at' => now()]);
        Questiontype::create(['name' => 'Descriptive', 'sortid' => 3, 'will_have_ans_choice' => 'No', 'created_at' => now(), 'updated_at' => now()]);
    }
}
