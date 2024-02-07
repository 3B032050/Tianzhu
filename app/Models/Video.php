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
        'video_content',
    ];
    public function video_category(): BelongsTo
    {
        return $this->belongsTo(Video_category::class);
    }
}
