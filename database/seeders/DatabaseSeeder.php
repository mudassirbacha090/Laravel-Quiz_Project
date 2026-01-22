<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Mcq;
use App\Models\UserAnswer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Clear existing data (respect foreign keys)
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        UserAnswer::truncate();
        Quiz::truncate();
        Mcq::truncate();
        Category::truncate();
        Admin::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Create test admin
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@queiz.com',
            'password' => 'admin123',
        ]);

        // Create categories
        $category1 = Category::create([
            'name' => 'General Knowledge',
            'creator' => 'admin',
        ]);

        $category2 = Category::create([
            'name' => 'Science',
            'creator' => 'admin',
        ]);

        // Create quizzes for General Knowledge
        $quiz1 = Quiz::create([
            'name' => 'World Capitals',
            'category_id' => $category1->id,
        ]);

        // Add MCQs to World Capitals
        Mcq::create([
            'question' => 'What is the capital of France?',
            'a' => 'London',
            'b' => 'Paris',
            'c' => 'Berlin',
            'd' => 'Madrid',
            'correct_ans' => 'B',
            'quiz_id' => $quiz1->id,
            'category_id' => $category1->id,
            'admin_id' => 1,
        ]);

        Mcq::create([
            'question' => 'What is the capital of Japan?',
            'a' => 'Seoul',
            'b' => 'Bangkok',
            'c' => 'Tokyo',
            'd' => 'Beijing',
            'correct_ans' => 'C',
            'quiz_id' => $quiz1->id,
            'category_id' => $category1->id,
            'admin_id' => 1,
        ]);

        Mcq::create([
            'question' => 'What is the capital of India?',
            'a' => 'Mumbai',
            'b' => 'Delhi',
            'c' => 'Bangalore',
            'd' => 'Chennai',
            'correct_ans' => 'B',
            'quiz_id' => $quiz1->id,
            'category_id' => $category1->id,
            'admin_id' => 1,
        ]);

        // Create quizzes for Science
        $quiz2 = Quiz::create([
            'name' => 'Basic Physics',
            'category_id' => $category2->id,
        ]);

        // Add MCQs to Basic Physics
        Mcq::create([
            'question' => 'What is the SI unit of force?',
            'a' => 'Kilogram',
            'b' => 'Newton',
            'c' => 'Joule',
            'd' => 'Watt',
            'correct_ans' => 'B',
            'quiz_id' => $quiz2->id,
            'category_id' => $category2->id,
            'admin_id' => 1,
        ]);

        Mcq::create([
            'question' => 'What is the speed of light?',
            'a' => '100,000 km/s',
            'b' => '200,000 km/s',
            'c' => '300,000 km/s',
            'd' => '400,000 km/s',
            'correct_ans' => 'C',
            'quiz_id' => $quiz2->id,
            'category_id' => $category2->id,
            'admin_id' => 1,
        ]);

        Mcq::create([
            'question' => 'What is the atomic number of Oxygen?',
            'a' => '6',
            'b' => '8',
            'c' => '10',
            'd' => '12',
            'correct_ans' => 'B',
            'quiz_id' => $quiz2->id,
            'category_id' => $category2->id,
            'admin_id' => 1,
        ]);
    }
}
