<?php

namespace App\Models;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    use HasFactory;
    protected $fillable = ['tmdb_id', 'name', 'slug', 'poster_path'];

    public function getSearchResult(): SearchResult
    {
        $url = route('casts.show', $this->slug);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->name,
            $url
        );
    }

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'cast_movie')->latest();
    }
}
