<div class="navbar-search-col d-inline my-2 my-lg-0 w-25" x-data="{ isOpen: true }" @click.away="isOpen = false">
    <div class="input-group">
        <input 
            wire:model.debounce.500ms="search" 
            @focus = "isOpen = true"
            @keydown.escape.window = "isOpen = false"
            @keydown.shift.tab = "isOpen = false"
            type="text" 
            class="form-control navbar-search-input" 
            placeholder="Search" 
            aria-label="Search" 
            aria-describedby="basic-addon2">

        <span class="fa fa-search navbar-search-icon"></span>

        <div wire:loading class="spinner-border text-light navbar-search-spinner" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    @if(strlen($search) >= 1)
        <div class="navbar-search-result-col" x-show="isOpen">
            
                <ul class="list-group">
                    @if($searchResults->count() > 0)
                        @foreach($searchResults as $search)
                            <li class="list-group-item">
                                <a href="{{ route('movies.show', $search['id']) }}" class="text-white d-inline-flex align-items-center" @if($loop->last) @keydown.tab="isOpen=false" @endif>
                                    @if($search['poster_path'])
                                        <img src="{{ 'https://image.tmdb.org/t/p/w92/'.$search['poster_path'] }}" class="navbar-search-res-img">
                                    @else 
                                        <img src="{{ asset('img/search-res-no-image.jpg') }}" alt="N/I" class="navbar-search-res-img">
                                    @endif
                                    <span>{{ $search['title'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li class="list-group-item text-white">No result for "{{ $search }}"</li>
                    @endif
                </ul>
        </div>
    @endif
</div>