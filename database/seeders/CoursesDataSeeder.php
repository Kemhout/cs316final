<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CoursesDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authors = [
            [
                'name' => 'Management II',
                'code_name' => 'BUS 202',
                'type_of_course' => 'Core',
                'department' => NULL,
                'professor' => 'Mr. John',
                'credit' => 3,
                'semester' => 4,
		'require' => 'AA',
            ],
            [
                'name' => 'Business Analytics',
                'code_name' => 'BUS 212',
                'type_of_course' => 'Core',
                'department' => NULL,
                'professor' => 'Mr. John',
                'credit' => 3,
                'semester' => 4,
		'require' => 'AA',
            ],
        ];

        foreach($authors as $author) {
            Course::create($author); 
        }
    }
}