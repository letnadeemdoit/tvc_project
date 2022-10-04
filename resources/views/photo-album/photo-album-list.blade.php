<div class="container padding-bottom massonary-container">
    @if(isset($data) && count($data) > 0)

        <nav aria-label="breadcrumb" class="mb-5">
            <ol class="breadcrumb breadcrumb-no-gutter">
                <li class="breadcrumb-item"><a href="{{route('guest.photo-album.index')}}">Photo Album</a></li>
                @if(isset($album))
                    @php
                        $loopThroughAlbum = $album->parentAlbum;
                        $loopThroughAlbums = [];
                    @endphp
                    @while(true)
                        @if($loopThroughAlbum)
                            @php
                                $loopThroughAlbums[] = $loopThroughAlbum;
                                $loopThroughAlbum = $loopThroughAlbum->parentAlbum;
                            @endphp
                        @else
                            @break
                        @endif
                    @endwhile
                    @foreach(array_reverse($loopThroughAlbums) as $lta)
                        <li class="breadcrumb-item"><a href="{{route('guest.photo-album.index', ['parent_id' => $lta->id])}}">{{$lta->name}}</a></li>
                    @endforeach

                    <li class="breadcrumb-item active" aria-current="page">{{$album->name}}</a></li>
                @endif
            </ol>
            <div>
                <label for="sort_order">Sort By</label>
                <select name="sort_order" id="sort_order" wire:model.defer="sort_order" wire:change="changeSortOrder()" class="border px-3 py-1 rounded" style="background-color: #CDD0D5">
                    <option value="desc" >Newest</option>
                    <option value="asc">Oldest</option>
                </select>
            </div>
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
                {{--let breadcrumb = document.querySelector('#breadcrumb');--}}
                {{--breadcrumb.innerText = '{{ $album->name }}';--}}
            </script>
        @endif
    @endpush
</div>
