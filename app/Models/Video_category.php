<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Video_category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'last_modified_by',
    ];
    public function video(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    public function lastModifiedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'last_modified_by')->with('user');
    }
}
