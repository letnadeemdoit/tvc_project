<div class="mb-4">
    <div class="input-group border rounded-1" style="border-color: #E8604C35 !important;">
        <input type="text" class="form-control border-0 outline-0" placeholder="Search here..."
               aria-label="Recipient's username" aria-describedby="button-addon2">
        <button class="btn"><i class="bi-search text-primary"></i></button>
    </div>
</div>
<div class="card border-0 mb-4">
    <div class="card-body">
        <h4 class="mb-3">Latest Post</h4>
        @foreach($data as $dt)
        <div class="d-flex align-items-center mb-4">
            <div class="flex-shrink-0">
{{--                <img--}}
{{--                    class="avatar-img rounded-circle"--}}
{{--                    src="{{ auth()->user()->first_name }}"--}}
{{--                    :src="avatarUrl"--}}
{{--                    alt="Image"--}}
{{--                    width="60" height="60" style="object-fit: cover"--}}
{{--                />--}}
                <img src="/images/blog-images/rounded-image.png" class="img-fluid position-relative" alt="...">
            </div>
            <div class="flex-grow-1 ms-3">
                <h4 class="mb-0" style="color: #6D6D6D">{{ $dt->Subject }}</h4>
                <p class="mb-0" style="color: #B6B4B4">{{\Carbon\Carbon::parse($dt->BlogDate)->format('d M Y')}}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
