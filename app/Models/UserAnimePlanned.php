<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAnimePlanned extends Model
{
    //
    protected $table = 'users_anime_planned';
    use HasFactory;
    protected $fillable = [
        'user_id',
        'anime_id',
    ];
}
