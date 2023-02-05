@extends('layouts.app')

@section('content')
    
    @if(count($nowPlayingMovies) > 0)
        {{-- Now Playing movies --}}
        <section class="now-playing-sec py-md-5 py-sm-4 py-3 light-border-bottom">
            <div class="container">

                <div class="row">
                    <div class="col">
                        <h5 class="text-uppercase text-white font-weight-bold mb-2"><i class="fas fa-fire-alt"></i> Now Playing</h5>
                    </div>
                </div>

                <div class="row">

                    @foreach($nowPlayingMovies as $movie)
                        <x-movie-card :movie="$movie" />
                    @endforeach

                </div>

                <div class="row text-center mt-3">
                    <div class="col">
                        <a href="{{ route('movies.now-playing-movies') }}" class="btn btn-warning"><span class="far fa-paper-plane"></span> View All</a>
                    </div>
                </div>

            </div>
        </section>
    @endif

    {{-- Popular Movies Section --}}
    <section class="popular-sec py-md-5 py-sm-4 py-3 light-border-bottom">
        <div class="container">

            <div class="row">
                <div class="col">
                    <h5 class="text-uppercase text-white font-weight-bold mb-2"><i class="fas fa-fire-alt"></i> Popular Movies</h5>
                </div>
            </div>

            <div class="row">

                @foreach($popularMovies as $movie)
                    <x-movie-card :movie="$movie"/>
                @endforeach

            </div>

            <div class="row text-center mt-3">
                <div class="col">
                    <a href="{{ route('movies.popular-movies') }}" class="btn btn-warning"><span class="far fa-paper-plane"></span> View All</a>
                </div>
            </div>
            

        </div>
    </section>

    {{-- Top Rated movies --}}
    <section class="top-rated-sec py-md-5 py-sm-4 py-3">
        <div class="container">

            <div class="row">
                <div class="col">
                    <h5 class="text-uppercase text-white font-weight-bold mb-2"><i class="fas fa-star"></i> Top Rated</h5>
                </div>
            </div>

            <div class="row">

                @foreach($topRatedMovies as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach

            </div>

            <div class="row text-center mt-3">
                <div class="col">
                    <a href="{{ route('movies.top-rated-movies') }}" class="btn btn-warning"><span class="far fa-paper-plane"></span> View All</a>
                </div>
            </div>

        </div>
    </section>

@endsection