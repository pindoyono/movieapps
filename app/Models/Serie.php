<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    protected $fillable = ['tmdb_id', 'name', 'created_year', 'poster_path', 'slug'];

    // public function getSearchResult(): SearchResult
    // {
    //     $url = route('series.show', $this->slug);

    //     return new \Spatie\Searchable\SearchResult(
    //         $this,
    //         $this->name,
    //         $url
    //     );
    // }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }
}
