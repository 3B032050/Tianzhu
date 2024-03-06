<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumObjective extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'last_modified_by',
    ];

    // 這是多對多的關聯，一個目標可能屬於多門課程
    public function curricula()
    {
        return $this->belongsToMany(Curriculum::class, 'curriculum_objective_relationship', 'objective_id', 'curriculum_id');
    }

    public function lastModifiedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'last_modified_by')->with('user');
    }
}
