<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Video_category extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_category_id',
        'category_name',
        'last_modified_by',
    ];
//    protected static function boot()
//    {
//        parent::boot();
//
//        static::creating(function ($video_category) {
//            $video_category->sorting_order = Video_category::max('order_category_id') + 1;
//        });
//    }
    public function video(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    public function lastModifiedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'last_modified_by')->with('user');
    }
}
