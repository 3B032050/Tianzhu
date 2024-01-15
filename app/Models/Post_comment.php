<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post_comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'message',

    ];
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
