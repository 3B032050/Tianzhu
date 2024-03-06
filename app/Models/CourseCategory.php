<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_modified_by',
    ];

    // 這是反向的一對一關聯，一個分類有一門課程
    public function courses()
    {
        return $this->hasMany(Course::class, 'course_category_id');
    }

    public function lastModifiedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'last_modified_by')->with('user');
    }
}
