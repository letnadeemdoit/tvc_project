<div class="brick">
    <div class="card border-0 text-white bg-transparent shadow-none">
        {{--    @if(!empty($album->image))--}}
        {{--        <a href="{{route('guest.photo-album.index', ['album' => $album['name']])}}">--}}
        {{--    <img--}}
        {{--        src="https://images.unsplash.com/photo-1661688625912-8d0191156923?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyNHx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60"--}}
        {{--        class="card-img"/>--}}
        {{--        </a>--}}
        {{--        @php--}}
        {{--        $albums  = \App\Models\Photo\Album::where('parent_id', $album->id)->first();--}}
        {{--        @endphp--}}
        @if(!empty($childAlbum))
            <a href="{{route('guest.photo-album.index', ['parent_id' => $album->id])}}">
                <img
                    src="{{ $album->getFileUrl() }}"
                    class="card-img"/>

            </a>
        @elseif($album->photos)
            @foreach($album->photos as $key => $photo)
                <a href="" class="" data-fancybox="photo"
                   data-src="{{ $photo->getFileUrl('path') }}"
                   data-caption="{{ $photo->description }}"
                >
                    <img
                        src="{{ $photo->getFileUrl('path') }}"
                        class="card-img"/>
                </a>
            @endforeach
        @else
            <img
                src="{{ $album->getFileUrl() }}"
                class="card-img"/>

        @endif

        <div class="p-0">
            <div
                class="card-block d-flex w-100 justify-content-between px-2 px-lg-4 px-xxl-5 img-card-text align-items-center align-items-center">
                <h3 class="text-white mb-0">{{ $album->name }}</h3>
                <div class="d-flex align-items-center">
                    <img src="{{asset('/images/photo-album/camera.svg')}}"
                         class="img-fluid me-1 me-lg-2">
                    <span>{{count($album->photos)}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
