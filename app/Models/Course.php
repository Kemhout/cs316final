<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'name', 'code_name', 'type_of_course', 'credit', 'grade', 'studyOrNot'
    ];

    public function student_group()
    {
        return $this->belongsToMany(User::class, 'student_course');
    }
}
