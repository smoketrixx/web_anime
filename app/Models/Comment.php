<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'user_id',
        'anime_id',
        'comment_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }

    public function parentComment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'comment_id');
    }
}
