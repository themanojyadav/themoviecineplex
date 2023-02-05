<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Carbon;

class TvShowsCategoryViewModel extends ViewModel
{
    public $shows;
    public $genres;

    public function __construct($shows, $genres)
    {
        $this->shows = $shows;
        $this->genres = $genres;
    }

    public function shows(){
        return $this->formatShows($this->shows);
    }

    private function formatShows($shows){

        return collect($shows)->map(function($show){

            $genresFormatted = collect($show['genre_ids'])->mapWithKeys(function($value){
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($show)->merge([
                'poster_path' => ($show['poster_path'])? 'https://image.tmdb.org/t/p/w500'.$show['poster_path']: asset('img/tv-show-poster-no-image.jpg'),
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
