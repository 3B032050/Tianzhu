<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_video_id',
        'video_category_id',
        'video_url',
        'video_id',
        'cover_url',
        'video_title',
        'last_modified_by',
    ];




    protected static function boot()
    {
        parent::boot();

        static::creating(function ($video) {
            $video->order_video_id = Video::max('order_video_id') + 1;
        });
    }
    public function video_category(): BelongsTo
    {
        return $this->belongsTo(Video_category::class);
    }

    public function lastModifiedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'last_modified_by')->with('user');
    }
}
