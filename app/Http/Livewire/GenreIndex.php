<?php

namespace App\Http\Livewire;

use App\Models\Genre;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class GenreIndex extends Component
{
    use WithPagination;

    public $tmdbId;
    public $title;
    public $genreId;

    public $search = '';
    public $sort = 'asc';
    public $perPage = 5;

    public $showGenreModal = false;

    protected $rules = [
        'title' => 'required',
    ];

    public function generateGenre()
    {
        // $user = Http::get('https://jsonplaceholder.typicode.com/users')->json();
        $user = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key=8a11aac3fb4ef5f1f9607ee7e0329793&language=en-US')->json();
        // dd($user["genres"]);
        foreach ($user["genres"] as $key => $value) {
            Genre::updateOrCreate(
                ['tmdb_id' => $value['id']],
                [

                    'title' => $value['name'],
                    'slug' => Str::slug($value['name']),
                ]);
        }
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Genre created']);
        //     $newGenre = Http::get('https://api.themoviedb.org/3/genre/'. $this->tmdbId .'?api_key=8a11aac3fb4ef5f1f9607ee7e0329793&language=en-US
        //                     ')->json();

        //     $genre = Genre::where('tmdb_id', $newGenre['id'])->first();
        //     if (!$genre) {
        //         Genre::create([
        //     'tmdb_id' => $newGenre['id'],
        //     'title'    => $newGenre['name'],
        //     'slug'    => Str::slug($newGenre['name']),
        // ]);
        //         $this->reset();
        //         $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Genre created']);
        //     } else {
        //         $this->dispatchBrowserEvent('banner-message', ['style' => 'danger', 'message' => 'Genre exisit']);
        //     }
    }

    public function showEditModal($id)
    {
        $this->genreId = $id;
        $this->loadGenre();
        $this->showGenreModal = true;
    }

    public function loadGenre()
    {
        $genre = Genre::findOrFail($this->genreId);
        $this->title = $genre->title;
    }

    public function updateGenre()
    {
        $this->validate();
        $genre = Genre::findOrFail($this->genreId);
        $genre->update([
            'title' => $this->title,
        ]);
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Genre updated']);
        $this->reset();
    }

    public function closeGenreModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function deleteGenre($id)
    {
        Genre::findOrFail($id)->delete();
        $this->dispatchBrowserEvent('banner-message', ['style' => 'success', 'message' => 'Genre deleted']);
        $this->reset();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'sort', 'perPage']);
    }
    public function render()
    {
        // $test = Genre::search('test')->get();
        // dd($test);
        return view('livewire.genre-index', [
            'genres' => Genre::search(trim($this->search))->orderBy('title', $this->sort)->paginate($this->perPage),
        ]);
    }
}
