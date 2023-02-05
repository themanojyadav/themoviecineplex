<div class="col-md-3 col-sm-6 col-12 tv-shows-col">
                        
    <div class="ps-movie-col">
        <a href="{{ route('tv-shows.show', $show['id']) }}">
            <div class="card">
                    <img src="{{ $show['poster_path'] }}" class="card-img-top" alt="{{ $show['name'] }}">
                
                <div class="card-body p-3">
                    <h5 class="card-title">{{ $show['name'] }}</h5>
                    <div class="ps-col-rating-col">
                        <span class="fa fa-star text-orange"></span>{{ $show['vote_average'] }} | <span>{{ $show['first_air_date'] }}</span>
                    </div>
                    <div class="ps-col-info-col">
                        {{ $show['genres'] }}
                    </div>
                </div>
            </div>
        </a>
    </div>

</div>