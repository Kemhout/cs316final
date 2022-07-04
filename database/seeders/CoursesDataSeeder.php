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
                'name' => 'Khmer Studies I',
                'code_name' => 'KHM 101',
                'type_of_course' => 'F-KHStudies',
                'department' => NULL,
                'professor' => 'Mr. John',
                'credit' => 3,
                'require' => 'Yes',
                'semester' => 1,
            ],
            [
                'name' => 'Calculus I',
                'code_name' => 'MATH 131',
                'type_of_course' => 'F-MathSciTech',
                'department' => NULL,
                'professor' => 'Mr. John',
                'credit' => 3,
                'require' => 'No',
                'semester' => 1,
            ],
            [
                'name' => 'Pre-Calculus',
                'code_name' => 'MATH 126',
                'type_of_course' => 'F-MathSciTech',
                'department' => NULL,
                'professor' => 'Mr. John',
                'credit' => 3,
                'require' => 'No',
                'semester' => 1,
            ],
            [
                'name' => 'Introductory Economics',
                'code_name' => 'ECON 100',
                'type_of_course' => 'F-SocSci',
                'department' => NULL,
                'professor' => 'Mr. John',
                'credit' => 3,
                'require' => 'Yes',
                'semester' => 1,
            ],
            [
                'name' => 'Academic English I',
                'code_name' => 'ENGL 101',
                'type_of_course' => 'F-Eng',
                'department' => NULL,
                'professor' => 'Mr. John',
                'credit' => 3,
                'require' => 'No',
                'semester' => 1,
            ],
            [
                'name' => 'Principles of Programming I ',
                'code_name' => 'CS 125',
                'type_of_course' => 'F-Core',
                'department' => 'CS',
                'professor' => 'Mr. John',
                'credit' => 3,
                'require' => 'Yes',
                'semester' => 1,
            ],
            [
                'name' => 'Khmer Studies II',
                'code_name' => 'KHM 102',
                'type_of_course' => 'F-KHStudies',
                'department' => NULL,
                'professor' => 'Mr. John',
                'credit' => 3,
                'require' => 'Yes',
                'semester' => 2,
            ],
            [
                'name' => 'Microeconomics',
                'code_name' => 'ECON 201',
                'type_of_course' => 'F-SocSci',
                'department' => NULL,
                'professor' => 'Mr. John',
                'credit' => 3,
                'require' => 'Yes',
                'semester' => 2,
            ],
            [
                'name' => 'Academic English II',
                'code_name' => 'ENGL 102',
                'type_of_course' => 'F-Eng',
                'department' => NULL,
                'professor' => 'Mr. John',
                'credit' => 4,
                'require' => 'No',
                'semester' => 2,
            ],
            [
                'name' => 'Principles of Programming II',
                'code_name' => 'CS 126',
                'type_of_course' => 'F-Core',
                'department' => 'CS',
                'professor' => 'Mr. John',
                'credit' => 3,
                'require' => 'Yes',
                'semester' => 2,
            ],
            [
                'name' => 'IT Applications for Business Purposes ',
                'code_name' => 'MIS 112',
                'type_of_course' => 'F-MathSciTech',
                'department' => NULL,
                'professor' => 'Mr. John',
                'credit' => 3,
                'require' => 'No',
                'semester' => 2,
            ],
        ];

        foreach($authors as $author) {
            Course::create($author); 
        }
    }
}