<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'grade';
    use HasFactory;
    protected $fillable = [
        'g1', 'g2', 'g3', 'g4', 'g5', 'g6', 'g7'
    ];
}
