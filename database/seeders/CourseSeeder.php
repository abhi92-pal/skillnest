<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Coursecategory;
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

        // for ($i = 1; $i <= 10; $i++) {
        //     $course = Course::create([
        //         'id' => (string) Str::uuid(),
        //         'name' => $faker->sentence(3),
        //         'short_description' => $faker->sentence(10),
        //         'long_description' => $faker->paragraphs(3, true),
        //         'price' => $faker->randomFloat(2, 50, 1000),
        //         'selling_price' => $faker->randomFloat(2, 25, 900),
        //         'duration_type' => $faker->randomElement(['Year', 'Month', 'Day', 'Hour']),
        //         'duration' => $faker->randomFloat(1, 1, 24),
        //         'reg_end_date' => $faker->optional()->date(),
        //         'no_of_semesters' => $faker->numberBetween(1, 8),
        //         'is_freezed' => 'Yes',
        //         'is_published' => 'Yes',
        //         'status' => 'Inactive',
        //     ]);

        //     // Attach 1–3 random categories to each course
        //     if (!empty($categories)) {
        //         $course->coursecategories()->attach(
        //             collect($categories)->random(rand(1, min(3, count($categories))))
        //         );
        //     }
        // }
    }
}
