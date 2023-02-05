<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MoviesCategoryViewModel;
use App\ViewModels\MovieViewModel;


class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topRatedMovies = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/movie/top_rated')
                            ->json()['results'];
        
        $popularMovies = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/movie/popular')
                            ->json()['results'];

        $genres = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/genre/movie/list')
                            ->json()['genres'];

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/movie/now_playing')
                            ->json()['results'];

        
        $viewModel = new MoviesViewModel($popularMovies, $nowPlayingMovies, $topRatedMovies,$genres);

        return view('movies.index', $viewModel);
    }

    /**
     * Now playing Movies
     */
    public function nowPlayingMovies($page = 1)
    {

        $genres = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/genre/movie/list')
                            ->json()['genres'];

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/movie/now_playing?page='.$page)
                            ->json();

        
        if($nowPlayingMovies['total_pages'] == $page){
            abort(204);
        }

        $viewModel = new MoviesCategoryViewModel($nowPlayingMovies['results'], $genres);

        return view('movies.movies', $viewModel)->with(['paging_path' => '/movies/now-playing-movies/page/{{#}}', 'heading_title' => 'Now Playing Movies']);   
    }

    /**
     * Popular Movies
     */
    public function popularMovies($page = 1)
    {

        $genres = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/genre/movie/list')
                            ->json()['genres'];

        $popularMovies = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/movie/popular?page='.$page)
                            ->json();

        
        if($popularMovies['total_pages'] == $page){
            abort(204);
        }

        $viewModel = new MoviesCategoryViewModel($popularMovies['results'], $genres);

        return view('movies.movies', $viewModel)->with(['paging_path' => '/movies/popular-movies/page/{{#}}', 'heading_title' => 'Popular Movies']);   
    }


    /**
     * Top Rated Movies
     */
    public function topRatedMovies($page = 1)
    {

        $genres = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/genre/movie/list')
                            ->json()['genres'];

        $topRatedMovies = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/movie/top_rated?page='.$page)
                            ->json();

        
        if($topRatedMovies['total_pages'] == $page){
            abort(204);
        }

        $viewModel = new MoviesCategoryViewModel($topRatedMovies['results'], $genres);

        return view('movies.movies', $viewModel)->with(['paging_path' => '/movies/top-rated-movies/page/{{#}}', 'heading_title' => 'Top Rated Movies']);   
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,images')
                            ->json();
        
        $viewModel = new MovieViewModel($movie);
        return view('movies.show', $viewModel);
    }

    
}
