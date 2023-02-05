@extends('layouts.app')

@section('content')

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
                    <a href="{{ route('movies.index') }}" class="btn btn-warning"><span class="far fa-paper-plane"></span> View All Movies</a>
                </div>
            </div>

        </div>
    </section>

    {{-- Popular Shows Section --}}
    <section class="popular-sec py-md-5 py-sm-4 py-3">
        <div class="container">

            <div class="row">
                <div class="col">
                    <h5 class="text-uppercase text-white font-weight-bold mb-2"><i class="fas fa-fire-alt"></i> Popular Shows</h5>
                </div>
            </div>

            <div class="row">

                @foreach($popularShows as $show)
                    <x-show-card :show="$show"/>
                @endforeach

            </div>

            <div class="row text-center mt-3">
                <div class="col">
                    <a href="{{ route('tv-shows.index') }}" class="btn btn-warning"><span class="far fa-paper-plane"></span> View All Shows</a>
                </div>
            </div>

        </div>
    </section>

@endsection