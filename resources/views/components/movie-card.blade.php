<div class="col-md-3 col-sm-6 col-12 movies-col">
                        
    <div class="ps-movie-col">
        <a href="{{ route('movies.show', $movie['id']) }}">
            <div class="card">
                    <img src="{{ $movie['poster_path'] }}" class="card-img-top" alt="{{ $movie['title'] }}">
                
                <div class="card-body p-3">
                    <h5 class="card-title">{{ $movie['title'] }}</h5>
                    <div class="ps-col-rating-col">
                        <span class="fa fa-star text-orange"></span>{{ $movie['vote_average'] }} | <span>{{ $movie['release_date'] }}</span>
                    </div>
                    <div class="ps-col-info-col">
                        {{ $movie['genres'] }}
                    </div>
                </div>
            </div>
        </a>
    </div>

</div>