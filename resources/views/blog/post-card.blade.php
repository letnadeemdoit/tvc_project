<div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-2">
    <div class="card blog-card mb-4">
        <div class="w-100">
{{--            <button class="btn  position-absolute text-index featured-btn mt-3 ms-3">--}}
{{--                FEATURE BLOG--}}
{{--            </button>--}}
            <a href="{{route('guest.blog.show', $post->slug)}}">
                <img src="{{ $post->getFileUrl() }}" class="card-img-top  position-relative" style="height: 310px !important;object-fit: cover" alt="..." />
            </a>


        </div>
        <div class="card-body p-2">
            <div class="w-80 mx-auto margin-negative bg-white position-relative z-index-2 p-5 rounded-1" style="min-height: 210px">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="user-img d-flex align-items-center">
                        <img src="/images/blog-images/rounded-image.png" class="img-fluid position-relative" alt="...">

                        <div class="ps-3">
                            <strong class="mb-1 text-black fs-4">{{$post->Author}}</strong>
                            <p class="mb-0 fs-13 pt-1">{{\Carbon\Carbon::parse($post->BlogDate)->format('d M Y')}}</p>
                        </div>
                    </div>
                    <div class="dropdown" x-data>
                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle list-btn" id="connectionsDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi-three-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end blog-dropdown" aria-labelledby="connectionsDropdown2">
                            <a class="btn btn-white dropdown-item blog-dropdown-item" href="#"
                               data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{ $post->BlogId }}Modal"
                            >
                                <i class="bi-trash me-2"></i>Delete Blog
                            </a>
                            <a class="btn btn-white dropdown-item blog-dropdown-item" href="#" wire:click="getBlogId({{ $post->BlogId }})"
                               data-bs-toggle="modal" data-bs-target="#addBlogCommentModal">
                                <i class="fa-solid fa-comment-medical me-2"></i> Add Comment
                            </a>
                            <a class="btn btn-white dropdown-item blog-dropdown-item" href="#" @click.prevent="window.livewire.emit('readBlogComments', {{$post->BlogId}})">
                                <i class="fa-solid fa-comments me-2"></i> Read Comment
                            </a>
                            {{--                            <a class="dropdown-item text-danger" href="#">Delete Blog</a>--}}
                        </div>
                    </div>
                </div>
                <div class="paragraph-text pt-3 text-black text-center text-md-start">
                    <p>{!!  (Str::limit(strip_tags($post->Content), 80))  !!}</p>
                </div>
            </div>
            @php
                $blogcomments = App\Models\Blog\BlogComment::where('BlogId', $post->BlogId )->get();
                $numberofcomments = count($blogcomments);
            @endphp
            <div class="card-footer px-0 pb-0 border-top-thick">
                <ul class="d-flex list-unstyled ul-card-footer justify-content-between">
                    <li><img src="/images/blog-images/love.png" class="img-fluid me-1"><span>200 Likes</span></li>
                    <li><img src="/images/blog-images/comment.svg" class="img-fluid me-1"><span>{{$numberofcomments}} Comments</span></li>
                    <li><img src="/images/blog-images/eye.png" class="img-fluid me-1"><span>200 Views</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
