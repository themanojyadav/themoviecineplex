<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

use Illuminate\Support\Carbon;

class ActorViewModel extends ViewModel
{
    public $actor;
    public $social;
    public $credits;

    public function __construct($actor, $social, $credits)
    {
        $this->actor = $actor;
        $this->social = $social;
        $this->credits = $credits;
    }

    public function actor(){
        return collect($this->actor)->merge([
            'birthday' => Carbon::parse($this->actor['birthday'])->format('M d, Y'),
            'age' => Carbon::parse($this->actor['birthday'])->age,
            'profile_path' => $this->actor['profile_path'] 
                ? 'https://image.tmdb.org/t/p/w300'.$this->actor['profile_path']
                : asset('img/actor-profile-no-image.jpg')
        ]);
    }

    public function social(){
        return collect($this->social)->merge([
            'facebook' => $this->social['facebook_id']? 'https://facebook.com/'.$this->social['facebook_id'] : null,
            'twitter' => $this->social['twitter_id']? 'https://twitter.com/'.$this->social['twitter_id'] : null,
            'instagram' => $this->social['instagram_id']? 'https://instagram.com/'.$this->social['instagram_id'] : null,
        ]);
    }

    public function knownForTitles(){
        $castTitles = collect($this->credits)->get('cast');

        return collect($castTitles)->where('media_type', 'movie')->sortByDesc('popularity')->take(8)->map(function($movie){
            return collect($movie)->merge([
                'poster_path' => $movie['poster_path']
                    ? 'https://image.tmdb.org/t/p/w500'.$movie['poster_path']
                    :  asset('img/known-for-no-image.jpg'),
                'title' => (isset($movie['title']))? $movie['title']: 'Untitled'
            ]);
        });
    }

    public function credits(){
        $castMovies = collect($this->credits)->get('cast');

        return collect($castMovies)->map(function($movie){

            // For release date
            if(isset($movie['release_date'])){
                $release_date = $movie['release_date'];
            }
            elseif(isset($movie['first_air_date'])){
                $release_date = $movie['first_air_date'];
            }
            else{
                $release_date = '';
            }

            // For title
            if(isset($movie['title'])){
                $title = $movie['title'];
            }
            elseif(isset($movie['name'])){
                $title = $movie['name'];
            }
            else{
                $title = 'Untitled';
            }

            return collect($movie)->merge([
                'release_date' => Carbon::parse($release_date)->format('M d, Y'),
                'release_year' => isset($release_date)? Carbon::parse($release_date)->format('Y') : 'Future',
                'title' => $title,
                'character' => (isset($movie['character']) && $movie['character']) ? $movie['character']: 'Not Defined'
            ]);
        })->sortByDesc('release_year');
    }
}
