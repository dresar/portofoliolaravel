<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'bio',
        'about',
        'email',
        'phone',
        'location',
        'website',
        'avatar',
        'cover_image',
        'social_links',
        'resume',
        'years_experience',
        'projects_completed',
        'happy_clients',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];

    public static function getProfile()
    {
        return static::first() ?? static::create([
            'name' => 'Your Name',
            'title' => 'Full Stack Developer',
        ]);
    }
}

