@extends('layouts.app')

@section('content')
    
    {{-- Actors movies --}}
    <section class="actors-sec py-md-4 py-sm-4 py-3 light-border-bottom">
        <div class="container">

            <div class="row">
                <div class="col">
                    <h5 class="text-uppercase text-white font-weight-bold mb-2"><i class="fas fa-fire-alt"></i> Actors</h5>
                </div>
            </div>

            <div class="row actors-rows">

                @foreach($popularActors as $actor)
                    <div class="col-md-3 actors-col">
                        
                        <div class="ps-movie-col">
                            <a href="{{ route('actors.show', $actor['id']) }}">
                                <div class="card">
                                        <img src="{{ $actor['profile_path'] }}" class="card-img-top" alt="{{ $actor['name'] }}">
                                    
                                    <div class="card-body p-3">
                                        <h5 class="card-title">{{ $actor['name'] }}</h5>
                                        <div class="ps-col-info-col text-truncate">
                                            {{ $actor['known_for'] }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    
                    </div>
                @endforeach

            </div>

            <div class="row text-center mt-4">
                <div class="col">
                    <button class="btn btn-warning view-more-button"><span class="fas fa-sync"></span> Load More</button>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col text-center">
                    <div class="page-load-status" style="display: none;">
                        <div class="infinite-scroll-request spinner-border text-light mx-auto" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>

                        <p class="infinite-scroll-last text-orange text-lg">End of content</p>
                        <p class="infinite-scroll-error text-orange text-lg">No more pages to load</p>
                    </div>
                </div>
            </div>

        </div>
    </section>


@endsection

@section('pages-custom-script')
    <script>
        var elem = document.querySelector('.actors-rows');
        var infScroll = new InfiniteScroll( elem, {
            // options
            path: '/actors/page/@{{#}}',
            append: '.actors-col',
            history: false,
            button: '.view-more-button',
            // using button, disable loading on scroll 
            scrollThreshold: false,
            status: '.page-load-status'
        });

    </script>
@endsection