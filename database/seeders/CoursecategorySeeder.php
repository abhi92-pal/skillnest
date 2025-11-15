<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Coursecategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoursecategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coursecategory::create([
            'name' => 'Web Development',
            'file' => NULL,
            'short_description' => 'Learn to build websites and web applications.',
            'status' => 'Active',
        ]);

        Coursecategory::create([
            'name' => 'Web Design',
            'file' => NULL,
            'short_description' => 'Learn to build websites and web applications.',
            'status' => 'Active',
        ]);

        Coursecategory::create([
            'name' => 'Data Science',
            'file' => NULL,
            'short_description' => 'Learn to build websites and web applications.',
            'status' => 'Active',
        ]);

        Coursecategory::create([
            'name' => 'Data Analytics',
            'file' => NULL,
            'short_description' => 'Learn to build websites and web applications.',
            'status' => 'Active',
        ]);

        
    }
}
