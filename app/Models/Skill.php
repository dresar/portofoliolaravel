<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'proficiency_level',
        'icon',
        'category',
        'order',
    ];

    protected $casts = [
        'proficiency_level' => 'integer',
    ];
}

