<div>
@if($childAlbum > 0 )
    <div class="brick">
        <div class="card border-0 text-white bg-transparent" style="box-shadow: 0px 11px 24px rgba(132, 133, 133, 0.16)">
            <a href="{{route('guest.photo-album.index', ['parent_id' => $album->id])}}">
                <img
                    src="{{ $album->getFileUrl() }}"
                    class="card-img"/>

            </a>
            <div class="p-0">
                <div class="card-block d-flex w-100 justify-content-between px-2 px-lg-4 px-xxl-5 img-card-text align-items-center align-items-center">
                    <h3 class="text-white mb-0">{{ $album->name ?? '' }}</h3>
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center">
                          <img src="{{asset('/images/photo-album/nested-album.svg')}}"
                               class="img-fluid " style="width: 25px">
                          <span class="ms-2">{{ $childAlbum }}</span>
                      </div>
                        <div class="d-flex align-items-center ms-3">
                            <img src="{{asset('/images/photo-album/camera.svg')}}"
                                 class="img-fluid" style="width: 25px">
                            <span class="ms-2">{{ $nestedPhoto }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif(($nestedPhoto > 0))
    @foreach($albumPhotos as $photo)
        <div class="brick">
        <div class="card border-0 text-white bg-transparent" style="box-shadow: 0px 11px 24px rgba(132, 133, 133, 0.16)">
            <a href="" class="" data-fancybox="photo"
                   data-src="{{ $photo->getFileUrl('path') }}"
                   data-caption="{{ $photo->description }}"
                   data-sizes="(max-width: 600px) 480px, 800px"
            >
                <img
                        src="{{ $photo->getFileUrl('path') }}"
                        class="card-img"/>
            </a>
        </div>
    </div>
    @endforeach
@else
    <div class="brick">
        <div class="card border-0 text-white bg-transparent" style="box-shadow: 0px 11px 24px rgba(132, 133, 133, 0.16)">
            <a href="" class="" data-fancybox="photo"
               data-src="{{ $album->getFileUrl() }}"
               data-caption="{{ $album->description }}"
               data-sizes="(max-width: 600px) 480px, 800px"
            >
                <img
                    src="{{ $album->getFileUrl() }}"
                    class="card-img"/>
            </a>
        </div>
    </div>

@endif
{{--    page-title--}}
   @push('scripts')
    <script>
         let album_title = document.querySelector('#page-title');
             @if(request()->has('parent_id'))
             album_title.innerText = '{{ $album->name }}';
             @endif
    </script>

    @endpush
</div>


