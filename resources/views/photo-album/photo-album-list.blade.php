<div class="container padding-bottom massonary-container">
    @if(isset($data) && count($data) > 0)
        <div class="masonry">
            @foreach($data as $dt)
            @if($dt instanceof \App\Models\Photo\Album && ($dt->nestedAlbums->count() > 0 or $dt->photos->count() > 0))
                <div class="brick">
                    <livewire:photo-album.album-card :album="$dt" wire:key="{{ $dt->id }}" />
                </div>
            @elseif($dt instanceof \App\Models\Photo\Photo)
                <div class="brick">
                    <livewire:photo-album.photo-card :photo="$dt" wire:key="{{ $dt->id }}" />
                </div>
            @endif
        @endforeach
        </div>
    @else
        @include('partials.no-data-available',['title' => 'Album'])
    @endif

    @push('scripts')
        @if(!is_null($album))
            <script>
                let album_title = document.querySelector('#page-title');
                album_title.innerText = '{{ $album->name }}';
            </script>
        @endif
    @endpush
</div>
