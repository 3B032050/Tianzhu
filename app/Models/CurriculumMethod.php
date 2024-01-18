<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // 這是多對多的關聯，一個方法可能屬於多門課程
    public function curricula()
    {
        return $this->belongsToMany(Curriculum::class, 'curriculum_method_relationship', 'method_id', 'curriculum_id');
    }
}
