<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseFile extends Model
{
    use HasFactory;
    protected $table = 'courses_files';
    protected $fillable = [
        'title',
        'file',
    ];


}
