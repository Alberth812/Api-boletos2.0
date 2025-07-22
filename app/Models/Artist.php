<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'genre',
        'bio',
        'image_url'
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_artists');
    }
}