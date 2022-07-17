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
            'All',
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
            'CE Freshman',
            'CE Sophomore',
            'CE Junior',
            'CE Senior',
            'ITL Freshman',
            'ITL Sophomore',
            'ITL Junior',
            'ITL Senior',
            'BAF Freshman',
            'BAF Sophomore',
            'BAF Junior',
            'BAF Senior',
            'ARC Freshman',
            'ARC Sophomore',
            'ARC Junior',
            'ARC Senior',
            
         ];
    
        foreach ($studentGroups as $studentGroup) {
            StudentGroup::create(['name' => $studentGroup]);
        }
     }
}
