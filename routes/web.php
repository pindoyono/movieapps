<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use App\Http\Livewire\CastIndex;
use App\Http\Livewire\EpisodeIndex;
use App\Http\Livewire\GenreIndex;
use App\Http\Livewire\MovieIndex;
use App\Http\Livewire\SeasonIndex;
use App\Http\Livewire\SerieIndex;
use App\Http\Livewire\TagIndex;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::view('/', 'welcome')->name('home');
Route::view('/dashboard', 'dashboard')->name('dashboard');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('movies', MovieIndex::class, 'index')->name('movies.index');
    Route::get('series', SerieIndex::class, 'index')->name('series.index');
    Route::get('series/{serie}/seasons', SeasonIndex::class, 'index')->name('seasons.index');
    Route::get('series/{serie)/seasons/{season}/episodes', EpisodeIndex::class, 'index')->name('episodes.index');
    Route::get('/episodes/{episode:slug}', [SerieController::class, 'showEpisode'])->name('episodes.show');
    Route::get('genres', GenreIndex::class, 'index')->name('genres.index');
    Route::get('casts', CastIndex::class, 'index')->name('casts.index');
    Route::get('tags', TagIndex::class, 'index')->name('tags.index');
});

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware(['auth'])->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});
