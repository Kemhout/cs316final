<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'short_name',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'study_plans');
    }
}
