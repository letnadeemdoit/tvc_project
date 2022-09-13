<div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-2 item">
    <a href="{{route('guest.blog.show', $post->slug)}}">
        <div class="card blog-card mb-4">
        <div class="w-100">
            {{--            <button class="btn  position-absolute text-index featured-btn mt-3 ms-3">--}}
            {{--                FEATURE BLOG--}}
            {{--            </button>--}}


                <img src="{{ $post->getFileUrl() }}" class="card-img-top  position-relative" style="height: 310px !important;object-fit: cover" alt="..." />


        </div>
        <div class="card-body p-2">
            <div class="w-90 mx-auto margin-negative bg-white position-relative z-index-2 px-5 py-3 rounded-1" style="min-height: 210px">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="user-img d-flex align-items-center">

                        <img
                            src="{{ auth()->user()->profile_photo_url }}"
                            class="avatar-initials img-fluid position-relative rounded-circle"
                            alt="{{ auth()->user()->user_name ?? '' }}"
                        >

                        <div class="ps-3">
                            <strong class="mb-1 text-black fs-4">{{ $post->Author }}</strong>
                            <p class="mb-0 fs-13 txt-clr">{{\Carbon\Carbon::parse($post->BlogDate)->format('d M Y')}}</p>
                        </div>
                    </div>
{{--                    <div class="dropdown" x-data>--}}
{{--                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle list-btn" id="connectionsDropdown2" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                            <i class="bi-three-dots-vertical"></i>--}}
{{--                        </button>--}}
{{--                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end blog-dropdown" aria-labelledby="connectionsDropdown2">--}}
{{--                            <a class="btn btn-white dropdown-item blog-dropdown-item" href="#!"--}}
{{--                               data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{ $post->BlogId }}Modal"--}}
{{--                            >--}}
{{--                                <img src="{{asset('/images/blog-images/trash.svg')}}" class="img-fluid bg-dropdown-img me-1"> Delete Blog--}}
{{--                            </a>--}}
{{--                            <a class="btn btn-white dropdown-item blog-dropdown-item" href="#!"--}}
{{--                               wire:click="getBlogId({{ $post->BlogId }})" data-bs-toggle="modal" data-bs-target="#addBlogCommentModal"--}}
{{--                            >--}}
{{--                                <img src="{{asset('/images/blog-images/ad-comment.svg')}}" class="img-fluid bg-dropdown-img me-1"> Add Comment--}}
{{--                            </a>--}}
{{--                            <a class="btn btn-white dropdown-item blog-dropdown-item" href="#!"--}}
{{--                               @click.prevent="window.livewire.emit('readBlogComments', {{$post->BlogId}})"--}}
{{--                            >--}}
{{--                                <img src="{{asset('/images/blog-images/read-message.svg')}}" class="img-fluid bg-dropdown-img me-1"> Read Comment--}}
{{--                            </a>--}}
{{--                            --}}{{--                            <a class="dropdown-item text-danger" href="#">Delete Blog</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <div class="paragraph-text pt-3 text-black">
                    <p>{!!  (Str::limit(strip_tags($post->Contents), 80))  !!}</p>
                </div>
            </div>
            @php
                $blogcomments = App\Models\Blog\BlogComment::where('BlogId',$post->BlogId )->get();
                $numberofcomments = count($blogcomments);
            @endphp
            <div class="card-footer px-0 pb-0 border-top-thick w-94">
                <ul class="d-flex list-unstyled ul-card-footer justify-content-center">

                    <li class="">
                        <livewire:blog.like-able-blog :post="$post" />
                    </li>
                    <li class="middle-li-card-footer"><img src="/images/blog-images/comment.svg" class="" style="width: 15px"><span>Comments</span></li>
                    <li class=""><img src="/images/blog-images/eye.svg" class="" style="width: 15px"><span>{{ isset($existing_views) ? $existing_views : 0 }} Views</span></li>
                </ul>
            </div>
        </div>
    </div>
    </a>
</div>
