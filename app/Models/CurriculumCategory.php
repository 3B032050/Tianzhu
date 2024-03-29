<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'last_modified_by',
        'order_by',
    ];

    // 這是反向的一對一關聯，一個分類有一門課程
    public function curricula()
    {
        return $this->hasMany(Curriculum::class, 'curriculum_category_id');
    }

    public function lastModifiedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'last_modified_by')->with('user');
    }
}
