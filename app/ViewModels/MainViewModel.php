<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Carbon;

class MainViewModel extends ViewModel
{
    public $popularMovies; 
    public $movie_genres;
    public $popularShows;
    public $show_genres;

    public function __construct($popularMovies, $movie_genres, $popularShows, $show_genres)
    {
        $this->popularMovies = $popularMovies; 
        $this->movie_genres = $movie_genres;
        $this->popularShows = $popularShows;
        $this->show_genres = $show_genres;
    }

    public function popularMovies(){
        return $this->formatMovies($this->popularMovies);
    }

    private function formatMovies($movies){

        return collect($movies)->map(function($movie){

            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function($value){
                return [$value => $this->movie_genres()->get($value)];
            })->implode(', ');

            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500'.$movie['poster_path'],
                'vote_average' => $movie['vote_average'] * 10 .'%',
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $genresFormatted
            ])->only([
                'poster_path', 'id', 'genre_ids', 'title', 'vote_average', 'overview', 'release_date', 'genres'
            ]);
        });

    }

    public function movie_genres(){

        return collect($this->movie_genres)->mapWithKeys(function($genre){
            return [$genre['id'] => $genre['name']];
        });

    }

    public function popularShows(){
        return $this->formatShows($this->popularShows);
    }

    private function formatShows($shows){

        return collect($shows)->map(function($show){

            $genresFormatted = collect($show['genre_ids'])->mapWithKeys(function($value){
                return [$value => $this->show_genres()->get($value)];
            })->implode(', ');

            return collect($show)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500'.$show['poster_path'],
                'vote_average' => $show['vote_average'] * 10 .'%',
                'first_air_date' => Carbon::parse($show['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
                'name' => (isset($show['name']))? $show['name']: 'Untitled'
            ])->only([
                'poster_path', 'id', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres'
            ]);
        });

    }

    public function show_genres(){

        return collect($this->show_genres)->mapWithKeys(function($genre){
            return [$genre['id'] => $genre['name']];
        });

    }
}
