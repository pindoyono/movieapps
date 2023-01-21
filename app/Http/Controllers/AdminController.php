<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Movie;
use App\Models\Serie;
use App\Models\User;

class AdminController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        $movies = Movie::all();
        $series = Serie::all();
        $casts = Cast::all();

        return view('admins.index', compact('users', 'movies', 'series', 'casts'));
    }
}
