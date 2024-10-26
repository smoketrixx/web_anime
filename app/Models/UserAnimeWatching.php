<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAnimeWatching extends Model
{
    //
    protected $table = 'users_anime_watching';
    use HasFactory;
    protected $fillable = [
        'user_id',
        'anime_id',
    ];
}
