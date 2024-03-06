<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseFile extends Model
{
    use HasFactory;
    protected $table = 'courses_files';
    protected $fillable = [
        'course_file_category_id',
        'title',
        'file',
        'status',
        'last_modified_by',
    ];
    public function coursefilecategory()
    {
        return $this->belongsTo(CourseFileCategory::class, 'course_file_category_id');
    }

    public function lastModifiedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'last_modified_by')->with('user');
    }
}
