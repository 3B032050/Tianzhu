<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonSense extends Model
{
    use HasFactory;

    protected $fillable = [
        'common_sense_category_id',
        'title',
        'content',
    ];

    public function category()
    {
        return $this->belongsTo(CommonSenseCategory::class, 'common_sense_category_id');
    }
}
