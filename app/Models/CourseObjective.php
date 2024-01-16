<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseObjective extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
    ];

    // 這是多對多的關聯，一個目標可能屬於多門課程
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_objective_relationship', 'objective_id', 'course_id');
    }
}
