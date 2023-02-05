@extends('layouts.app')

@section('content')
    
    @if(count($movies) > 0)
        {{-- Now Playing movies --}}
        <section class="now-playing-sec py-5">
            <div class="container">

                <div class="row">
                    <div class="col">
                        <h5 class="text-uppercase text-white font-weight-bold mb-2"><i class="fas fa-fire-alt"></i> {{ $heading_title }}</h5>
                    </div>
                </div>

                <div class="row movies-rows">

                    @foreach($movies as $movie)
                        <x-movie-card :movie="$movie" />
                    @endforeach

                </div>

                <div class="row text-center mt-4">
                    <div class="col">
                        <button class="btn btn-warning view-more-button"><span class="fas fa-sync"></span> Load More</button>
                    </div>
                </div>

                <div class="row mt-3">
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
    @endif

@endsection

@section('pages-custom-script')
    <script>
        var path = "{{ $paging_path }}";

        var elem = document.querySelector('.movies-rows');
        var infScroll = new InfiniteScroll( elem, {
            // options
            path: path,
            append: '.movies-col',
            history: false,
            button: '.view-more-button',
            // using button, disable loading on scroll 
            scrollThreshold: false,
            status: '.page-load-status'
        });

    </script>
@endsection