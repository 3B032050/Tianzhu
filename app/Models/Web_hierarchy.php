<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Web_hierarchy extends Model
{
    use HasFactory;

    protected $fillable = [
        'web_id',
        'parent_id',
    ];

    public function web_content()
    {
        return $this->hasOne(Web_content::class);
    }
}
