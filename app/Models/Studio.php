<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Studio extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'avatar'
    ];

    public function anime()
    {
        return $this->hasMany(Anime::class);
    }

}
