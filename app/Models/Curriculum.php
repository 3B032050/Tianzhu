<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'course_category_id',
        'content',
        'method',
        'last_modified_by',
    ];

    public function category()
    {
        return $this->belongsTo(CurriculumCategory::class, 'curriculum_category_id');
    }

    // 這是多對多的關聯，一門課程可能有多個方法
    public function methods()
    {
        return $this->belongsToMany(CurriculumMethod::class, 'curriculum_method_relationship', 'curriculum_id', 'method_id');
    }

    // 這是多對多的關聯，一門課程可能有多個目標
    public function objectives()
    {
        return $this->belongsToMany(CurriculumObjective::class, 'curriculum_objective_relationship', 'curriculum_id', 'objective_id');
    }

    public function lastModifiedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'last_modified_by')->with('user');
    }
}
