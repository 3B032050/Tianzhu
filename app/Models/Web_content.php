<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Web_content extends Model
{
    use HasFactory;
    protected $fillable = [
        'web_id',
        'content',
    ];
    public function web_hierarchy()
    {
        return $this->belongsTo(Web_hierarchy::class);
    }
}
