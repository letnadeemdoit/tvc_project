<div>
    <div class="card border-0 text-white bg-transparent" style="box-shadow: 0px 11px 24px rgba(132, 133, 133, 0.16)">
        <a href="{{route('guest.photo-album.index', ['parent_id' => $album->id])}}">
            <img
                src="{{ $album->getFileUrl() }}"
                class="card-img"/>

        </a>
        <div class="p-0">
            <div
                class="card-block d-flex w-100 justify-content-between ps-3 ps-sm-2 ps-xl-3 pe-5 img-card-text text-break align-items-center align-items-center">
                <h3 class="text-white mb-0 d-inline-block text-truncate" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" style="max-width:175px;">{{ $album->name ?? '' }}</h3>
                <div class="d-flex align-items-center"  style="min-width:40px;">
                    <div class="d-flex align-items-center me-2">
                        <img src="{{asset('/images/photo-album/nested-album.svg')}}"
                             class="img-fluid " style="width: 25px">
                        <span class="ms-2">{{ $this->albumsCount }}</span>
                    </div>
                    <div class="d-flex align-items-center ms-3">
                        <img src="{{asset('/images/photo-album/camera.svg')}}"
                             class="img-fluid" style="width: 25px">
                        <span class="ms-2">{{ $this->photosCount }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
