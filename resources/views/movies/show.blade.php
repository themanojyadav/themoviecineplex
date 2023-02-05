@extends('layouts.app')

@section('content')
    <section class="show-movie-sec py-5 text-white">
        <div class="container">

            <div class="row">

                <div class="col-md-4 col-sm-12 col-12">
                    <div class="sm-img-col">
                        @if($movie['poster_path'])
                            <img src="{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="w-100 show-poster-img">
                        @else
                            <img src="{{asset('img/movie-poster-no-image.jpg')}}" alt="{{ $movie['title'] }}" class="w-100 show-poster-img">
                        @endif
                    </div>
                </div>

                <div class="col-md-8 col-sm-12 col-12">
                    <div class="sm-det-col px-3 py-md-2 pt-4">
                        <h2 class="font-weight-bolder">{{ $movie['title'] }}</h2>
                        <div class="sm-rdg-col">
                            <span class="fa fa-star text-orange"></span>{{ $movie['vote_average'] }} | <span class="sm-rdg-date">{{ $movie['release_date'] }}</span> | 
                            <span class="sm-rdg-genre">
                                {{ $movie['genres'] }}
                            </span>
                        </div>

                        <div class="sm-desc-col my-4">
                            <p>
                                {{ $movie['overview'] }}
                            </p>
                        </div>

                        <div class="tmdb-col mb-4">
                            <a href="https://www.themoviedb.org" target="_BLANK"><img src="{{ asset('img/tmdb_logo.svg') }}" alt="The movie database" class="show-tmdb-logo-img"></a>
                        </div>

                        <div class="sm-feat-crew-col">
                            <h6 class="font-weight-bold text-orange">Featured Crew</h6>
                            <div class="row">

                                @foreach($movie['crew'] as $crew)
                                        <div class="col-md-3 col-sm-6 col-12 mt-md-0 mt-2">
                                            <h6 class="mb-0">{{ $crew['name'] }}</h6>
                                            <small>{{ $crew['department'] }}</small>
                                        </div>
                                @endforeach
                                
                            </div>
                        </div>

                        @if($movie['videos']['results'])
                            <div class="sm-btn-col mt-4">
                                <button class="btn btn-warning" data-toggle="modal" data-target="#videoModal"><i class="fa fa-play-circle"></i> Watch Trailer</a>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <iframe id="videoPlayer" class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}" allowfullscreen></iframe>
                                              </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Modal End --}}
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </section>    

    {{-- Cast --}}
    <section class="show-cast-sec py-4 light-border-bottom">
        <div class="container">

            <div class="row">
                <div class="col">
                    <h4 class="text-white font-weight-bold mb-3"><i class="fa fa-users"></i> Cast</h4>
                </div>
            </div>

            <div class="row">

                @foreach($movie['cast'] as $cast)
                    <div class="col-md-3 col-sm-6 col-12 mb-3">
                        <a href="{{route('actors.show', $cast['id'])}}">
                            <div class="card">
                                @if($cast['profile_path'])
                                    <img src="{{ 'https://image.tmdb.org/t/p/w300/'.$cast['profile_path'] }}" alt="Cast Image" class="w-100 card-img-top">

                                @else
                                    <img src="{{ asset('img/cast-no-image.jpg') }}" alt="No IMage" class="w-100 card-img-top">
                                @endif
                                <div class="card-body">
                                    <h5>{{ $cast['name'] }}</h5>
                                    <h6>{{ $cast['character'] }}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach


            </div>
        </div>
    </section>

    {{-- Images --}}
    @if(count($movie['images']) > 0)
        <section class="show-cast-sec py-4">
            <div class="container">

                <div class="row">
                    <div class="col">
                        <h4 class="text-white font-weight-bold mb-3"><i class="far fa-images"></i> Images</h4>
                    </div>
                </div>

                <div class="row">

                    @foreach($movie['images'] as $image)
                        <div class="col-md-4 col-sm-6 col-12 mb-3">
                            <div class="card">
                                <a data-fancybox="gallery" href="{{ 'https://image.tmdb.org/t/p/original/'.$image['file_path'] }}">
                                <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$image['file_path'] }}" alt="Cast Image" class="w-100 card-img-top">
                            </a>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </section>
    @endif
@endsection