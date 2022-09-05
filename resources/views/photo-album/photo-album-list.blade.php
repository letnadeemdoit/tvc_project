<div class="container padding-bottom massonary-container">
    <div class="masonry">
        @foreach($data as $dt)
            @if($dt instanceof \App\Models\Photo\Album)
                <livewire:photo-album.album-card :album="$dt" wire:key="{{ $dt->id }}" />
            @elseif($dt instanceof \App\Models\Photo\Photo)
                <livewire:photo-album.photo-card :photo="$dt" wire:key="{{ $dt->id }}" />
            @endif
        @endforeach
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
