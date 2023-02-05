<?php

namespace App\ViewModels;

use Illuminate\Support\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    public $show;

    public function __construct($show)
    {
        $this->show = $show;
    }

    public function show(){
        return collect($this->show)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500'.$this->show['poster_path'],
            'vote_average' => $this->show['vote_average'] * 10 .'%',
            'first_air_date' => Carbon::parse($this->show['first_air_date'])->format('M d, Y'),
            'genres' => collect($this->show['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->show['credits']['crew'])->take(4),
            'cast' => collect($this->show['credits']['cast'])->take(8),
            'images' => collect($this->show['images']['backdrops'])->take(9)
        ]);
    }

}
