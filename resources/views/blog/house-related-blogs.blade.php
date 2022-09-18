<div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-2">

        <div class="card blog-card mb-4">
            <div class="w-100">
                <a href="{{route('guest.blog.show', $blog->slug)}}">
                <img src="{{ $blog->getFileUrl() }}" class="card-img-top  position-relative" style="height: 310px !important;object-fit: cover" alt="..." />
                </a>

            </div>
            <div class="card-body p-2">
            <div class="w-90 mx-auto margin-negative bg-white position-relative z-index-2 px-3 py-3 rounded-1" style="min-height: 150px">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="user-img d-flex align-items-center">
                        @if(!empty($blog->user->profile_photo_url) && !is_null($blog->user->profile_photo_url))
                            <img
                                src="{{ $blog->user->profile_photo_url }}"
                                class="avatar-initials img-fluid position-relative rounded-circle"
                                alt="{{ $blog->user->name ?? '' }}"
                                style="width:50px !important;height:50px !important;object-fit: cover;"
                            >
                        @else
                            <img
                                src="/images/blog-images/beach.png"
                                class="avatar-initials img-fluid position-relative rounded-circle"
                                alt="..."
                                style="width:50px !important;height:50px !important;object-fit: cover;"
                            >
                        @endif

                        <div class="ps-3">
                            <h5 class="mb-1 fw-bold" style="color: #2A3342">{{ Str::upper('By '.$blog->Author) }}</h5>
                            <p class="mb-0 fs-13 pt-1 txt-clr">{{\Carbon\Carbon::parse($blog->BlogDate)->format('d M Y')}}</p>
                        </div>
                    </div>
                </div>
                <div class="paragraph-text pt-3 text-black">
                    <h5 class="mb-1 fw-500" style="color: #2A3342">{{ Str::limit($blog->Subject, 55) }}</h5>
{{--                    <p class="text-dark-blue">{!!  (Str::limit(strip_tags($blog->Contents), 80))  !!}</p>--}}
                </div>
            </div>
        </div>
            <div class="card-footer px-0 pb-0 border-top-thick w-94">
                <ul class="d-flex list-unstyled ul-card-footer justify-content-between">

                    <li>
                        <livewire:blog.like-able-blog :post="$blog" />
                    </li>
                    <li><img src="/images/blog-images/comment.svg" class="img-fluid me-1"><span>{{ $blogcomments }} Comments</span></li>
                    <li><img src="/images/blog-images/eye.svg" class="img-fluid me-1"><span>{{ isset($existing_views) ? $existing_views : 0 }} Views</span></li>
                </ul>
            </div>
        </div>
</div>
