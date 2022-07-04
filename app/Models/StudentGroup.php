<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGroup extends Model
{
    use HasFactory;
    protected $table = 'student_group';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
 
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
 
    /**
     * The roles that belong to the user.
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_course');
    }
}
