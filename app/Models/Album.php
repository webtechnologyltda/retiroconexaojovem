<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'title',
        'is_active',
        'photos',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'photos' => 'array',
    ];
}
