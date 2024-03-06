<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'content',
        'is_feature',
        'file',
        'status',
        'last_modified_by',
    ];

    protected $casts = [
        'title' => 'string',
        'content' => 'string',
        'is_feature' => 'bool',
        'file'=>'string',
    ];
    public function post_comments(): HasMany
    {
        return $this->hasMany(Post_comment::class);
    }

    public function lastModifiedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'last_modified_by')->with('user');
    }
}
