<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // 這是一對一的關聯，一門課程屬於一個分類
    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id');
    }

    // 這是多對多的關聯，一門課程可能有多個方法
    public function methods()
    {
        return $this->belongsToMany(CourseMethod::class, 'course_method_relationship', 'course_id', 'method_id');
    }

    // 這是多對多的關聯，一門課程可能有多個目標
    public function objectives()
    {
        return $this->belongsToMany(CourseObjective::class, 'course_objective_relationship', 'course_id', 'objective_id');
    }
}
