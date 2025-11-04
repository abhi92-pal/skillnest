<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Semester::create(['name' => 'Semester 1', 'exam_sequence' => 1, 'created_at' => now(), 'updated_at' => now()]);
        Semester::create(['name' => 'Semester 2', 'exam_sequence' => 2, 'created_at' => now(), 'updated_at' => now()]);
        Semester::create(['name' => 'Semester 3', 'exam_sequence' => 3, 'created_at' => now(), 'updated_at' => now()]);
        Semester::create(['name' => 'Semester 4', 'exam_sequence' => 4, 'created_at' => now(), 'updated_at' => now()]);
        Semester::create(['name' => 'Semester 5', 'exam_sequence' => 5, 'created_at' => now(), 'updated_at' => now()]);
        Semester::create(['name' => 'Semester 6', 'exam_sequence' => 6, 'created_at' => now(), 'updated_at' => now()]);
        Semester::create(['name' => 'Semester 7', 'exam_sequence' => 7, 'created_at' => now(), 'updated_at' => now()]);
        Semester::create(['name' => 'Semester 8', 'exam_sequence' => 8, 'created_at' => now(), 'updated_at' => now()]);
        Semester::create(['name' => 'Semester 9', 'exam_sequence' => 9, 'created_at' => now(), 'updated_at' => now()]);
        Semester::create(['name' => 'Semester 10', 'exam_sequence' => 10, 'created_at' => now(), 'updated_at' => now()]);
        Semester::create(['name' => 'Semester 11', 'exam_sequence' => 11, 'created_at' => now(), 'updated_at' => now()]);
        Semester::create(['name' => 'Semester 12', 'exam_sequence' => 12, 'created_at' => now(), 'updated_at' => now()]);
        Semester::create(['name' => 'Semester 13', 'exam_sequence' => 13, 'created_at' => now(), 'updated_at' => now()]);
        Semester::create(['name' => 'Semester 14', 'exam_sequence' => 14, 'created_at' => now(), 'updated_at' => now()]);
        Semester::create(['name' => 'Semester 15', 'exam_sequence' => 15, 'created_at' => now(), 'updated_at' => now()]);
        Semester::create(['name' => 'Semester 16', 'exam_sequence' => 16, 'created_at' => now(), 'updated_at' => now()]);
    }
}
