<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $fillable = [
        'name',
        'description',
        'avatar'
    ];

    public function animes()
    {
        return $this->belongsToMany(Anime::class, 'anime_studio');
    }
}
