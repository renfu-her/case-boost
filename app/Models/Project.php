<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'budget',
        'remote',
        'preferred_roles',
    ];

    protected $casts = [
        'remote' => 'boolean',
        'preferred_roles' => 'array',
        'budget' => 'decimal:0'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}

