<div>
<div class="mb-4">
    <div class="input-group  rounded-1 border-color-primary">
{{--        <form>--}}
            <!-- Search -->
{{--            <div class="input-group input-group-merge input-group-flush">--}}
                <input
                    type="search"
                    class="form-control border-end-0"
                    placeholder="Search here..."
                    aria-label="Search boards"
                    wire:model.debounce.500ms="search"
                />
{{--            </div>--}}
            <!-- End Search -->
{{--        </form>--}}
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
        <h4 class="mb-3">Latest Post</h4>
        @foreach($data as $dt)
        <div class="d-flex align-items-center mb-4">
            <div class="flex-shrink-0">
                <img
                    src="{{ $dt->getFileUrl() }}"
                    class="avatar-initials img-fluid position-relative rounded-circle"
                    alt="..."
                    style="width:60px !important;height:60px !important;object-fit: cover;"
                >
            </div>
            <div class="flex-grow-1 ms-3">
                <a href="{{route('guest.blog.show', $dt->slug)}}">
                <h4 class="mb-0" style="color: #6D6D6D">
                    {{ Str::limit($dt->Subject, 60) }}
                </h4>
                </a>
{{--                <p class="mb-0" style="color: #B6B4B4">{{\Carbon\Carbon::parse($dt->BlogDate)->format('d M Y')}}</p>--}}
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
