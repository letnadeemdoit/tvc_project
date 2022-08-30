<div class="container padding-bottom massonary-container">
    <div class="masonry">
        @foreach($data as $dt)
            <livewire:photo-album.photo-album-card :album="$dt" wire:key="{{ $dt->id }}" />
        @endforeach
    </div>
</div>
