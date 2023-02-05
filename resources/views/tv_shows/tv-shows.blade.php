@extends('layouts.app')

@section('content')
    
    {{-- Airing Today Shows --}}
    <section class="tv-shows-sec py-md-5 py-sm-4 py-3 light-border-bottom">
        <div class="container">

            <div class="row">
                <div class="col">
                    <h5 class="text-uppercase text-white font-weight-bold mb-2"><i class="fas fa-fire-alt"></i> {{ $heading_title }}</h5>
                </div>
            </div>

            <div class="row tv-shows-row">

                @foreach($shows as $show)
                    <x-show-card :show="$show" />
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
        var path = "{{ $paging_path }}";

        var elem = document.querySelector('.tv-shows-row');
        var infScroll = new InfiniteScroll( elem, {
            // options
            path: path,
            append: '.tv-shows-col',
            history: false,
            button: '.view-more-button',
            // using button, disable loading on scroll 
            scrollThreshold: false,
            status: '.page-load-status'
        });

    </script>
@endsection