<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use App\ViewModels\MainViewModel;

class MainController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $popularMovies = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/movie/popular')
                            ->json()['results'];

        $movie_genres = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/genre/movie/list')
                            ->json()['genres'];

        $popularShows = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/tv/popular')
                            ->json()['results'];
        
        $show_genres = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/genre/tv/list')
                            ->json()['genres'];

        
        $viewModel = new MainViewModel($popularMovies, $movie_genres, $popularShows, $show_genres);

        return view('homepage', $viewModel);
    }

    public function privacy_policy(){
        return view('privacy-policy');
    }

    public function about_us(){
        return view('about-us');
    }

    public function disclaimer(){
        return view('disclaimer');
    }

    public function terms_conditions(){
        return view('terms-conditions');
    }

    public function contact_us(){
        return view('contact-us');
    }

}
