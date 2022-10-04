<div class="container padding-bottom massonary-container">
    @if(isset($data) && count($data) > 0)

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-no-gutter">
                <li class="breadcrumb-item"><a href="{{route('guest.photo-album.index')}}">Photo Album</a></li>
                @if(isset($album->name))
                <li class="breadcrumb-item active" aria-current="page">{{$album->name ?? ''}}</li>
                @endif
            </ol>
        </nav>
        <div class="masonry">
            @foreach($data as $dt)
                @if($dt instanceof \App\Models\Photo\Album && ($dt->nestedAlbums->count() > 0 or $dt->photos->count() > 0))
                    <div class="brick">
                        <livewire:photo-album.album-card :album="$dt" wire:key="{{ $dt->id }}"/>
                    </div>
                @elseif($dt instanceof \App\Models\Photo\Photo)
                    <div class="brick">
                        <livewire:photo-album.photo-card :photo="$dt" wire:key="{{ $dt->id }}"/>
                    </div>
                @endif
            @endforeach
        </div>

    @else
        @include('partials.no-data-available',['title' => 'No Photo Albums have been created yet!'])
    @endif

    @push('scripts')
        @if(!is_null($album))
            <script>
                let album_title = document.querySelector('#page-title');
                album_title.innerText = '{{ $album->name }}';
                let breadcrumb = document.querySelector('#breadcrumb');
                breadcrumb.innerText = '{{ $album->name }}';
            </script>
        @endif
    @endpush
</div>
