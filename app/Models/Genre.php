<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Genre extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['tmdb_id', 'title', 'slug'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }

}
