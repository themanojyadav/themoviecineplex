<?php

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

Route::get('/', 'MainController@index')->name('homepage');

Route::get('/privacy-policy', 'MainController@privacy_policy')->name('privacy-policy');
Route::get('/about-us', 'MainController@about_us')->name('about-us');
Route::get('/disclaimer', 'MainController@disclaimer')->name('disclaimer');
Route::get('/terms-conditions', 'MainController@terms_conditions')->name('terms-conditions');
Route::get('/contact-us', 'MainController@contact_us')->name('contact-us');

// Movies Routes Start
Route::get('/movies', 'MoviesController@index')->name('movies.index');

Route::get('/movies/now-playing-movies', 'MoviesController@nowPlayingMovies')->name('movies.now-playing-movies');
Route::get('/movies/now-playing-movies/page/{page?}', 'MoviesController@nowPlayingMovies');

Route::get('/movies/popular-movies', 'MoviesController@popularMovies')->name('movies.popular-movies');
Route::get('/movies/popular-movies/page/{page?}', 'MoviesController@popularMovies');

Route::get('/movies/top-rated-movies', 'MoviesController@topRatedMovies')->name('movies.top-rated-movies');
Route::get('/movies/top-rated-movies/page/{page?}', 'MoviesController@topRatedMovies');

Route::get('/movies/{movie}', 'MoviesController@show')->name('movies.show');
// Movies Routes End


// Actors Routes Start
Route::get('/actors', 'ActorsController@index')->name('actors.index');
Route::get('/actors/page/{page?}', 'ActorsController@index');
Route::get('/actors/{actor}', 'ActorsController@show')->name('actors.show');
// Actors Routes End


// TV Shows Routes Start
Route::get('/tv-shows', 'TvShowsController@index')->name('tv-shows.index');

Route::get('/tv-shows/airing-today', 'TvShowsController@aringTodayShows')->name('tv-shows.airing-today');
Route::get('/tv-shows/airing-today/page/{page?}', 'TvShowsController@aringTodayShows');

Route::get('/tv-shows/top-rated-tv-shows', 'TvShowsController@topRatedShows')->name('tv-shows.top-rated-tv-shows');
Route::get('/tv-shows/top-rated-tv-shows/page/{page?}', 'TvShowsController@topRatedShows');

Route::get('/tv-shows/popular-tv-shows', 'TvShowsController@popularShows')->name('tv-shows.popular-tv-shows');
Route::get('/tv-shows/popular-tv-shows/page/{page?}', 'TvShowsController@popularShows');

Route::get('/tv-shows/{show}', 'TvShowsController@show')->name('tv-shows.show');
// TV Shows Routes End