<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'position',
        'last_modified_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lastModifiedByAdmin()
    {
        return $this->belongsTo(Admin::class, 'last_modified_by')->with('user');
    }
}


