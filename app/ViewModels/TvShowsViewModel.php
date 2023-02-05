<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Carbon;

class TvShowsViewModel extends ViewModel
{
    public $airingTodayShows;
    public $popularShows;
    public $topRatedShows;
    public $genres;

    public function __construct($airingTodayShows, $popularShows, $topRatedShows, $genres)
    {
        $this->airingTodayShows = $airingTodayShows;
        $this->popularShows = $popularShows;
        $this->topRatedShows = $topRatedShows;
        $this->genres = $genres;
    }

    public function airingTodayShows(){
        return $this->formatShows($this->airingTodayShows);
    }

    public function popularShows(){
        return $this->formatShows($this->popularShows);
    }

    public function topRatedShows(){
        return $this->formatShows($this->topRatedShows);
    }

    private function formatShows($shows){

        return collect($shows)->map(function($show){

            $genresFormatted = collect($show['genre_ids'])->mapWithKeys(function($value){
                return [$value => $this->genres()->get($value)];
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

    public function genres(){

        return collect($this->genres)->mapWithKeys(function($genre){
            return [$genre['id'] => $genre['name']];
        });

    }
}
