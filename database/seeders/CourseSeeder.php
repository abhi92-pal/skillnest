<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Coursecategory;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $categories = Coursecategory::pluck('id')->toArray();

        $course = Course::create([
                                'name' => 'Basics of Programming',
                                'short_description' => 'An introductory course on programming concepts.',
                                'long_description' => 'This course covers the fundamentals of programming including variables, control structures, data types, and basic algorithms.',
                                'price' => 25000,
                                'selling_price' => 20000,
                                'no_of_semesters' => 4,
                                'duration_type' => 'Year',
                                'duration' => 2,
                                'file_path' => 'courses/default_course_image.png',
                                'is_freezed' => 'No',
                                'is_published' => 'No',
                                'status' => 'Inactive',
                                'reg_end_date' => '2026-01-31',
                            ]);

                $course->coursecategories()->attach($categories);
                
                $semesters = Semester::where('exam_sequence', '<=', 4)->get();
                $admin = User::where('role', 'Admin')->where('status', 'Active')->first();
                $teacher = User::where('role', 'Teacher')->where('status', 'Active')->first();
                foreach ($semesters as $semester) {
                    $topic = $course->topics()->create([
                        'name' => 'Introduction to Programming',
                        'description' => 'This topic introduces the basics of programming languages and concepts.',
                        'created_by' => $admin->id,
                        'author_id' => $teacher->id,
                    ]);
                    $topic = $course->topics()->create([
                        'name' => 'Introduction to Programming2',
                        'description' => 'This topic introduces the basics of programming languages and concepts2.',
                        'created_by' => $admin->id,
                        'author_id' => $teacher->id,
                    ]);

                    $topic->semester_topics()->create([
                        'semester_id' => $semester->id
                    ]);
                }
                
    }
}
