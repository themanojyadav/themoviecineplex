<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>World Cineplex</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <livewire:styles>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    </head>
    <body>
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark site-navbar sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="/"><span class="fas fa-film"></span> World Cineplex</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mr-3">
                        <li class="nav-item @if(request()->is('/')){{'active'}} @endif">
                            <a class="nav-link" href="{{ route('homepage') }}">Home</a>
                        </li>
                        <li class="nav-item @if(request()->is('movies') || request()->is('movies/*')){{'active'}} @endif">
                            <a class="nav-link" href="{{ route('movies.index') }}">Movies</a>
                        </li>
                        <li class="nav-item @if(request()->is('tv-shows') || request()->is('tv-shows/*')){{'active'}} @endif">
                            <a class="nav-link" href="{{ route('tv-shows.index') }}">TV Shows</a>
                        </li>
                        <li class="nav-item @if(request()->is('actors') || request()->is('actors/*')){{'active'}} @endif">
                            <a class="nav-link" href="{{ route('actors.index') }}">Actors</a>
                        </li>
                        
                    </ul>

                    <livewire:search-dropdown>
                    
                </div>
            </div>
        </nav>

        @yield('content')
        
        
        <footer class="site-bottom-footer text-white pt-3">
            <div class="container">
                <div class="row light-border-bottom">
                    <div class="col mb-3">
                        <div class="sbf-ul-col py-2 text-center">
                            <div class="footer-logo-col mb-2">
                                <a class="navbar-brand text-white" href="/"><span class="fas fa-film"></span> World Cineplex</a>
                            </div>
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item"><a href="{{ route('about-us') }}" class="text-white">About Us</a></li>
                                <li class="list-inline-item"><a href="{{ route('privacy-policy') }}" class="text-white">Privacy Policy</a></li>
                                <li class="list-inline-item"><a href="{{ route('disclaimer') }}" class="text-white">Disclaimer</a></li>
                                <li class="list-inline-item"><a href="{{ route('terms-conditions') }}" class="text-white">Terms & Conditions</a></li>
                                <li class="list-inline-item"><a href="{{ route('contact-us') }}" class="text-white">Contact Us</a></li>
                            </ul>

                            <div class="footer-tmdb-logo-col mt-3">
                                <div class="footer-tmdb-col">
                                    <a href="https://www.themoviedb.org" target="_BLANK" title="Special thanks to The Movie Database"><img src="{{ asset('img/tmdb_logo.svg') }}" alt="The movie database" class="footer-tmdb-logo-img"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col text-center">
                        <p class="mb-0">{{ date('Y') }} &copy; All Copyrights Reserved; <span class="text-orange">The World Cineplex</span></p>
                    </div>
                </div>
            </div>
        </footer>
        <script src="{{ asset('js/app.js') }}"></script>
        
        <livewire:scripts>

        @yield('pages-custom-script')

    </body>
</html>
