@extends('layouts.app')

@section('content')
    
    {{-- Airing Today Shows --}}
    <section class="airing-today-sec py-md-5 py-sm-4 py-3 light-border-bottom">
        <div class="container">

            <div class="row">
                <div class="col">
                    <h5 class="text-uppercase text-white font-weight-bold mb-2"><i class="fas fa-fire-alt"></i> Airing Today</h5>
                </div>
            </div>

            <div class="row">

                @foreach($airingTodayShows as $show)
                    <x-show-card :show="$show" />
                @endforeach

            </div>

            <div class="row text-center mt-3">
                <div class="col">
                    <a href="{{ route('tv-shows.airing-today') }}" class="btn btn-warning"><span class="far fa-paper-plane"></span> View All</a>
                </div>
            </div>

        </div>
    </section>

    {{-- Now Playing Shows --}}
    <section class="now-playing-sec py-md-5 py-sm-4 py-3 light-border-bottom">
        <div class="container">

            <div class="row">
                <div class="col">
                    <h5 class="text-uppercase text-white font-weight-bold mb-2"><i class="fas fa-fire-alt"></i> Top Rated Shows</h5>
                </div>
            </div>

            <div class="row">

                @foreach($topRatedShows as $show)
                    <x-show-card :show="$show" />
                @endforeach

            </div>

            <div class="row text-center mt-3">
                <div class="col">
                    <a href="{{ route('tv-shows.top-rated-tv-shows') }}" class="btn btn-warning"><span class="far fa-paper-plane"></span> View All</a>
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
                    <a href="{{ route('tv-shows.popular-tv-shows') }}" class="btn btn-warning"><span class="far fa-paper-plane"></span> View All</a>
                </div>
            </div>

        </div>
    </section>

@endsection