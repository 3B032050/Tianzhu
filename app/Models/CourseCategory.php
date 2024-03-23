<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_1_modified_by',
        'last_2_modified_by',
        'last_3_modified_by',
        'last_4_modified_by',
        'last_5_modified_by',
        'order_by',
        'status',
    ];

    // 這是反向的一對一關聯，一個分類有一門課程
    public function courses()
    {
        return $this->hasMany(Course::class, 'course_category_id');
    }
}
