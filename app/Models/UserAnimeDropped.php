<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAnimeDropped extends Model
{
    use HasFactory;
    protected $table = 'users_anime_dropped';
    protected $fillable = [
        'user_id',
        'anime_id',
    ];
}
