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
        Questiontype::create(['name' => 'MCQ', 'will_have_ans_choice' => 'Yes', 'created_at' => now(), 'updated_at' => now()]);
        Questiontype::create(['name' => 'Short Question', 'will_have_ans_choice' => 'No', 'created_at' => now(), 'updated_at' => now()]);
        Questiontype::create(['name' => 'Descriptive', 'will_have_ans_choice' => 'No', 'created_at' => now(), 'updated_at' => now()]);
    }
}
