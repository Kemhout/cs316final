<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Course extends Model
{
    use HasFactory;
    use SearchableTrait;

    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'name', 'code_name', 'type_of_course', 'credit', 'grade', 'studyOrNot'
    ];

    protected $searchable = [
        'columns' => [
            'courses.name' => 10,
            'courses.code_name' => 5,
        ]
    ];

    public function majors()
    {
        return $this->belongsToMany(User::class, 'study_plans');
    }
}
