<div class="container padding-bottom massonary-container pt-5">

    @push('stylesheets')
        <style>
            .toast-success {
                background-color: #088008 !important;
                color: #ffffff !important;
            }
        </style>
    @endpush

    <nav aria-label="breadcrumb" class="mb-5 text-end">

        <div class="d-block d-sm-flex justify-content-center justify-content-sm-between align-items-center">
            <ol class="breadcrumb breadcrumb-no-gutter mb-0 d-flex justify-content-center mb-3 mb-sm-0">
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

                        <li class="breadcrumb-item"><a
                                href="{{route('guest.photo-album.index', ['parent_id' => $lta->id , 'sort_order' => 'desc'])}}">{{$lta->name}}</a>
                        </li>
                    @endforeach

                    <li class="breadcrumb-item active" aria-current="page">{{$album->name}}</a></li>
                @endif
            </ol>

            @if(isset($album))
                <div class="dropdown text-center text-sm-end d-flex">
                    @auth
                        @if(!auth()->user()->is_guest)
                            <div class="me-4" x-data>
                                <a
                                    class="btn btn-sm btn-soft-primary"
                                    href="#!"
                                    @click.prevent="window.livewire.emit('showPhotoCUModal', true)"
                                >
                                    <i class="bi-plus me-1"></i> Add New Photo
                                </a>
                            </div>
                        @endif
                    @endauth
                    <div>
                        Order By:
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                                data-bs-toggle="dropdown" aria-expanded="false" style="min-width: 160px;">
                            {{$sort_order == 'desc' ? 'Newest' : 'Oldest'}}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <li><a class="dropdown-item {{ $sort_order == 'desc' ? 'active' : ''}}"
                                   href="{{route('guest.photo-album.index', ['parent_id' => $album->id, 'sort_order' => 'desc' ])}}"
                                    {{--                               wire:click.prevent="$set('sort_order', 'desc')"--}}
                                >
                                    Newest</a>
                            </li>
                            <li><a class="dropdown-item {{ $sort_order == 'asc' ? 'active' : ''}}"
                                   href="{{route('guest.photo-album.index', ['parent_id' => $album->id, 'sort_order' => 'asc'])}}"
                                    {{--                               wire:click.prevent="$set('sort_order', 'asc')"--}}
                                >
                                    Oldest</a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </nav>
    @if(isset($data) && count($data) > 0)
        <div class="masonry">
            @foreach($data as $dt)
                {{--                @if($dt instanceof \App\Models\Photo\Album && ($dt->nestedAlbums->count() > 0 or $dt->photos->count() > 0))--}}
                @if($dt instanceof \App\Models\Photo\Album)
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
