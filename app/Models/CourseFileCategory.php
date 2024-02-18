<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseFileCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_file_category_name',

    ];
    public function coursefiles()
    {
        return $this->belongsToMany(CourseFile::class);
    }
}
