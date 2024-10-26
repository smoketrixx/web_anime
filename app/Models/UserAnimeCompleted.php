<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class UserAnimeCompleted extends Model
{
    use HasFactory;
    protected $table = 'users_anime_completed';
    
    protected $fillable = [
        'user_id',
        'anime_id',
    ];
}
