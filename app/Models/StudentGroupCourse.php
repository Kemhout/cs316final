<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGroupCourse extends Model
{
    use HasFactory;
    protected $table = 'student_course';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_group_id', 
        'courses_id',
        'semester', 
        'department',
    ];
 
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
 
    /**
     * The roles that belong to the user.
     */
}
