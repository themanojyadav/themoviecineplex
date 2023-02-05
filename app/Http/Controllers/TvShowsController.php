<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

use App\ViewModels\TvShowsViewModel;
use App\ViewModels\TvShowsCategoryViewModel;
use App\ViewModels\TvShowViewModel;

class TvShowsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $airingTodayShows = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/tv/airing_today')
                            ->json()['results'];

        $popularShows = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/tv/popular')
                            ->json()['results'];
        
        $genres = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/genre/tv/list')
                            ->json()['genres'];

                            
        $topRatedShows = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/tv/top_rated')
                            ->json()['results'];

                            
        $viewModel = new TvShowsViewModel($airingTodayShows, $popularShows, $topRatedShows, $genres);

        return view('tv_shows.index', $viewModel);
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/tv/'.$id.'?append_to_response=credits,videos,images')
                            ->json();
        
        $viewModel = new TvShowViewModel($show);
        return view('tv_shows.show', $viewModel);
    }

    
    /**
     * Airing Today Shows
     */
    public function aringTodayShows($page = 1)
    {
        $airingTodayShows = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/tv/airing_today?page='.$page)
                            ->json();
        
        $genres = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/genre/tv/list')
                            ->json()['genres'];
        
        if($airingTodayShows['total_pages'] == $page){
            abort(204);
        }

        $viewModel = new TvShowsCategoryViewModel($airingTodayShows['results'], $genres);

        return view('tv_shows.tv-shows', $viewModel)->with(['paging_path' => '/tv-shows/airing-today/page/{{#}}', 'heading_title' => 'Airing Today Shows']);
    }

    /**
     * Top Rated Shows 
     */
    public function topRatedShows($page = 1)
    {
        $topRatedShows = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/tv/top_rated?page='.$page)
                            ->json();
        
        $genres = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/genre/tv/list')
                            ->json()['genres'];
        
        if($topRatedShows['total_pages'] == $page){
            abort(204);
        }

        $viewModel = new TvShowsCategoryViewModel($topRatedShows['results'], $genres);

        return view('tv_shows.tv-shows', $viewModel)->with(['paging_path' => '/tv-shows/top-rated-tv-shows/page/{{#}}', 'heading_title' => 'Top Rated Shows']);
    }

    /**
     * Popular Shows 
     */
    public function popularShows($page = 1)
    {
        $popularShows = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/tv/popular?page='.$page)
                            ->json();
        
        $genres = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/genre/tv/list')
                            ->json()['genres'];
        
        if($popularShows['total_pages'] == $page){
            abort(204);
        }

        $viewModel = new TvShowsCategoryViewModel($popularShows['results'], $genres);

        return view('tv_shows.tv-shows', $viewModel)->with(['paging_path' => '/tv-shows/popular-tv-shows/page/{{#}}', 'heading_title' => 'Popular Shows']);
    }
    
}
