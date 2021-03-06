<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Course;;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserCourseExport implements FromCollection, WithHeadingRow
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {      
        $course = Course::select('name','code_name','type_of_course','credit','grade')->where('studyOrNot', 'Yes')->get();
        return $course;
    }

    public function headings(): array
    {
        return ['First Name', 'Last Name'];
    }
}
