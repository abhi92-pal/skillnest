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
        Questiontype::create(['name' => 'MCQ', 'created_at' => now(), 'updated_at' => now()]);
        Questiontype::create(['name' => 'Short Question', 'created_at' => now(), 'updated_at' => now()]);
        Questiontype::create(['name' => 'Descriptive', 'created_at' => now(), 'updated_at' => now()]);
    }
}
