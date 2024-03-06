<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'video_category_id',
        'video_url',
        'video_id',
        'cover_url',
        'video_title',
        'last_modified_by',
    ];
    public function video_category(): BelongsTo
    {
        return $this->belongsTo(Video_category::class);
    }

    public function lastModifiedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'last_modified_by')->with('user');
    }
}
