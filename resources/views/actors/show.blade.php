@extends('layouts.app')

@section('content')
    <section class="show-movie-sec py-5 text-white">
        <div class="container">

            <div class="row">

                <div class="col-md-4 col-sm-12 col-12">
                    <div class="sm-img-col">
                        @if($actor['profile_path'])
                            <img src="{{ $actor['profile_path'] }}" alt="{{ $actor['name'] }}" class="w-100 show-poster-img">
                        @else
                            <img src="{{asset('img/movie-poster-no-image.jpg')}}" alt="{{ $actor['name'] }}" class="w-100 show-poster-img">
                        @endif
                    </div>

                    <div class="sm-social-col mt-3 text-center">
                        <ul class="list-unstyled">
                            @if($social['facebook'])
                            <li class="d-inline-block">
                                <a href="{{ $social['facebook'] }}" class="text-white mr-4" target="_BLANK"><span class="fab fa-facebook-square fa-2x"></span></a>
                            </li>
                            @endif

                            @if($social['instagram'])
                            <li class="d-inline-block">
                                <a href="{{ $social['instagram'] }}" class="text-white mr-4" target="_BLANK"><span class="fab fa-instagram fa-2x"></span></a>
                            </li>
                            @endif

                            @if($social['twitter'])
                            <li class="d-inline-block">
                                <a href="{{ $social['twitter'] }}" class="text-white mr-4" target="_BLANK"><span class="fab fa-twitter fa-2x"></span></a>
                            </li>
                            @endif

                            @if($actor['homepage'])
                                <li class="d-inline-block">
                                    <a href="{{ $actor['homepage'] }}" target="_BLANK" class="text-white mr-4"><span class="fa fa-globe fa-2x"></span></a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="col-md-8 col-sm-12 col-12">
                    <div class="sm-det-col px-3 py-md-2 pt-4">
                        <h2 class="font-weight-bolder">{{ $actor['name'] }}</h2>
                        <div class="sm-rdg-col">
                            <span class="fa fa-birthday-cake text-orange"></span> {{ $actor['birthday'] }}  ({{ $actor['age'].' years old' }})

                            <div>
                                <span class="text-orange">Place of birth:</span> {{ $actor['place_of_birth'] }}
                            </div>
                        </div>

                        <div class="sm-desc-col my-4">
                            <p>
                                {{ $actor['biography'] }}
                            </p>
                        </div>

                        <div class="tmdb-col mb-4">
                            <a href="https://www.themoviedb.org" target="_BLANK"><img src="{{ asset('img/tmdb_logo.svg') }}" alt="The movie database" class="show-tmdb-logo-img"></a>
                        </div>

                        
                    </div>
                </div>

            </div>

        </div>
    </section>   
    
    @if(count($knownForTitles) > 0)
    {{-- Known for --}}
    <section class="actor-known-for-sec py-4 light-border-bottom">
        <div class="container">

            <div class="row">
                <div class="col">
                    <h4 class="text-white font-weight-bold mb-3"><i class="fa fa-star"></i> Known for (Based on popularity)</h4>
                </div>
            </div>

            <div class="row">

                @foreach($knownForTitles as $movie)
                    <div class="col-md-3 col-sm-6 col-12 mb-3">
                        <a href="{{route('movies.show', $movie['id'])}}">
                            <div class="card">
                                
                                <img src="{{ $movie['poster_path'] }}" alt="Poster" class="w-100 card-img-top">
                                
                                <div class="card-body">
                                    <h5>{{ $movie['title'] }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    @endif;

    {{-- Credits --}}
    <section class="show-credits-sec py-4 light-border-bottom">
        <div class="container">

            <div class="row">
                <div class="col">
                    <h4 class="text-white font-weight-bold mb-3"><i class="fa fa-users"></i> Credits</h4>
                </div>
            </div>

            <div class="row">

                <div class="col-12">
                    <ul>
                       @foreach($credits as $credit)
                            <li class="text-white">{{ $credit['release_year'] }}: {{ $credit['title'] }} as {{ $credit['character'] }}</li>
                        @endforeach
                    </ul>
                </div>


            </div>
        </div>
    </section>

    
@endsection