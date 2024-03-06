<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonSenseCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_modified_by',
    ];

    public function common_sense()
    {
        return $this->hasMany(CommonSense::class, 'common_sense_category_id');
    }

    public function lastModifiedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'last_modified_by')->with('user');
    }
}
