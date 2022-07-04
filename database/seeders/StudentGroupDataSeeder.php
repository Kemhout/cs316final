<?php

namespace Database\Seeders;

use App\Models\StudentGroup;
use Illuminate\Database\Seeder;

class StudentGroupDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $studentGroups = [
            'BUS Freshman',
            'BUS Sophomore',
            'BUS Junior',
            'BUS Senior',
            'CS Freshman',
            'CS Sophomore',
            'CS Junior',
            'CS Senior',
            'MIS Freshman',
            'MIS Sophomore',
            'MIS Junior',
            'MIS Senior',
            'All',
         ];
    
        foreach ($studentGroups as $studentGroup) {
            StudentGroup::create(['name' => $studentGroup]);
        }
     }
}
