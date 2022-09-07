<div>
    <div class="mb-4">
        <div class="input-group  rounded-1 border-color-primary">
            <input
                type="search"
                class="form-control border-end-0"
                placeholder="Search here..."
                aria-label="Search boards"
                wire:model.debounce.500ms="search"
            />
            <div class="input-group-prepend input-group-text border-start-0">
                <div wire:loading wire:target="search">
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <i class="bi-search text-primary" wire:loading.remove wire:target="search"></i>
            </div>
        </div>
    </div>
    <div class="card border-0 mb-4">
        <div class="card-body">
            <h4 class="mb-3">Latest  Local Guide</h4>
            @foreach($data as $dt)
                <div class="d-flex align-items-center mb-4">
                    <div class="flex-shrink-0">

                        <img
                            src="{{$dt->getFileUrl('image')}}"
                            class="avatar-initials rounded-circle"
                            alt="{{ $dt->title ?? '' }}"
                        />

{{--                        <img src="/images/blog-images/rounded-image.png" class="img-fluid position-relative" alt="...">--}}
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <a href="{{route('guest.local-guide.show', $dt->id)}}">
                            <h4 class="mb-0" style="color: #6D6D6D">{{ $dt->title }}</h4>
                        </a>
                        <p class="mb-0" style="color: #B6B4B4">{{\Carbon\Carbon::parse($dt->BlogDate)->format('d M Y')}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
