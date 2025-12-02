<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'role' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(12345678),
        ]);
        
        $teacher_user = User::create([
                        'name' => 'Teacher User',
                        'role' => 'Teacher',
                        'email' => 'teacher@gmail.com',
                        'password' => Hash::make(12345678),
                    ]);

        $teacher_user->teacher()->create([
            'designation' => 'Head Of The Department, IT',
            'about' => 'I am an ambitious workaholic, but apart from that, pretty simple person.'
        ]);
    }
}
