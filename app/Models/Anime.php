<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class Anime extends Model
{
    use HasFactory;
    protected $fillable = [
        'russian_name',
        'original_name',
        'english_name',
        'avatar',
        'description',
        'rating',
        'current_episodes',
        'total_episodes',
        'status_id',
        'original_source_id',
        'issue_date',
        'mpaa_rating_id',
        'studio_id'
    ];

    protected $casts = [
        'issue_date' => 'date',
        'rating' => 'decimal:2'
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function originalSource()
    {
        return $this->belongsTo(OriginalSource::class);
    }

    public function mpaaRating()
    {
        return $this->belongsTo(MpaaRating::class);
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function completedByUsers()
    {
        return $this->belongsToMany(User::class, 'users_anime_completed')
            ->withTimestamps();
    }

    public function droppedByUsers()
    {
        return $this->belongsToMany(User::class, 'users_anime_dropped')
            ->withTimestamps();
    }

    public function plannedByUsers()
    {
        return $this->belongsToMany(User::class, 'users_anime_planned')
            ->withTimestamps();
    }

    public function watchingByUsers()
    {
        return $this->belongsToMany(User::class, 'users_anime_watching')
            ->withTimestamps();
    }
}
