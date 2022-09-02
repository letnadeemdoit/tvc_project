@if(!is_null($childAlbum))
    <div class="brick">
        <div class="card border-0 text-white bg-transparent shadow-none">
            <a href="{{route('guest.photo-album.index', ['parent_id' => $album->id])}}">
                <img
                    src="{{ $album->getFileUrl() }}"
                    class="card-img"/>

            </a>
            <div class="p-0">
                <div class="card-block d-flex w-100 justify-content-between px-2 px-lg-4 px-xxl-5 img-card-text align-items-center align-items-center">
                    <h3 class="text-white mb-0">{{ $album->name ?? '' }}</h3>
                    <div class="d-flex align-items-center">
                        <img src="{{asset('/images/photo-album/camera.svg')}}"
                             class="img-fluid me-1 me-lg-2">
                        <span>{{ $nestedPhoto }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif(($nestedPhoto > 0))
    @foreach($albumPhotos as $photo)
        <div class="brick">
        <div class="card border-0 text-white bg-transparent shadow-none">
            <a href="" class="" data-fancybox="photo"
                   data-src="{{ $photo->getFileUrl('path') }}"
                   data-caption="{{ $photo->description }}"
                   data-sizes="(max-width: 600px) 480px, 800px"
            >
                <img
                        src="{{ $photo->getFileUrl('path') }}"
                        class="card-img"/>
            </a>
            <div class="p-0">
                <div class="card-block d-flex w-100 justify-content-between px-2 px-lg-4 px-xxl-5 img-card-text align-items-center align-items-center">
                    <h3 class="text-white mb-0">{{ $album->name ?? ''}}</h3>
                    <div class="d-flex align-items-center">
                            <img src="{{asset('/images/photo-album/camera.svg')}}"
                                 class="img-fluid me-1 me-lg-2">
{{--                            <span>{{count($album->photos)}}</span>--}}
                        </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@else
    <div class="brick">
        <div class="card border-0 text-white bg-transparent shadow-none">
            <a href="">
                <img
                    src="{{ $album->getFileUrl() }}"
                    class="card-img"/>

            </a>
            <div class="p-0">
                <div class="card-block d-flex w-100 justify-content-between px-2 px-lg-4 px-xxl-5 img-card-text align-items-center align-items-center">
                    <h3 class="text-white mb-0">{{ $album->name }}</h3>
                    <div class="d-flex align-items-center">
                        <img src="{{asset('/images/photo-album/camera.svg')}}"
                             class="img-fluid me-1 me-lg-2">
{{--                        <span>{{$album->description}}</span>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif

