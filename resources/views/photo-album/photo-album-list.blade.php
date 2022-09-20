<div class="container padding-bottom massonary-container">
    <div class="masonry">
{{--        @if(isset($data) && count($data) > 0)--}}
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
{{--        @else--}}
{{--            @include('partials.no-data-available',['title' => 'Album'])--}}
{{--        @endif--}}
    </div>

    @push('scripts')
        @if(!is_null($album))
            <script>
                let album_title = document.querySelector('#page-title');
                album_title.innerText = '{{ $album->name }}';
            </script>
        @endif
    @endpush
</div>
