<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyPlan extends Model
{
    use HasFactory;
    protected $table = 'study_plans';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'courses_id',
        'studys_plan_group',
        'majors_id',
        'semester', 
        'department',
        'academic_year',
        'year_level',
        'name',
        'group_name',
    ];

}
