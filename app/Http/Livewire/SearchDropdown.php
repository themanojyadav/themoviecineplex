<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SearchDropdown extends Component
{
    public $search = '';

    public function render()
    {
        $searchResults= array();

        if(strlen($this->search) >= 1){
            $searchResults = Http::withToken(config('services.tmdb.token'))
                                ->get('https://api.themoviedb.org/3/search/movie?query='.$this->search)
                                ->json()['results'];
        }

        //dump($searchResults);
        return view('livewire.search-dropdown')->with(['searchResults' => collect($searchResults)->take(15)]);
    }
}
