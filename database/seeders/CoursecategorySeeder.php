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
            'file' => 'images/coursecategory/work-1.jpg',
            'short_description' => 'Learn to build websites and web applications.',
            'status' => 'Active',
        ]);

        Coursecategory::create([
            'name' => 'Web Design',
            'file' => 'images/coursecategory/work-2.jpg',
            'short_description' => 'Learn to build websites and web applications.',
            'status' => 'Active',
        ]);

        Coursecategory::create([
            'name' => 'Data Science',
            'file' => 'images/coursecategory/work-3.jpg',
            'short_description' => 'Learn to build websites and web applications.',
            'status' => 'Active',
        ]);

        Coursecategory::create([
            'name' => 'Data Analytics',
            'file' => 'images/coursecategory/work-4.jpg',
            'short_description' => 'Learn to build websites and web applications.',
            'status' => 'Active',
        ]);

        Coursecategory::create([
            'name' => 'Photography',
            'file' => 'images/coursecategory/work-5.jpg',
            'short_description' => 'Learn to build websites and web applications.',
            'status' => 'Active',
        ]);

        Coursecategory::create([
            'name' => 'Health',
            'file' => 'images/coursecategory/work-6.jpg',
            'short_description' => 'Learn to build websites and web applications.',
            'status' => 'Active',
        ]);

        Coursecategory::create([
            'name' => 'Audio Video',
            'file' => 'images/coursecategory/work-7.jpg',
            'short_description' => 'Learn to build websites and web applications.',
            'status' => 'Active',
        ]);

        Coursecategory::create([
            'name' => 'IT & Software',
            'file' => 'images/coursecategory/work-8.jpg',
            'short_description' => 'Learn to build websites and web applications.',
            'status' => 'Active',
        ]);

        Coursecategory::create([
            'name' => 'Music',
            'file' => 'images/coursecategory/work-9.jpg',
            'short_description' => 'Learn to build websites and web applications.',
            'status' => 'Active',
        ]);

        
    }
}
