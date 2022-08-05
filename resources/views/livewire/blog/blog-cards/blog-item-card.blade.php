<div class="col-12 col-md-6 col-lg-3 mb-3">
    @if(isset($blog))
    <div class="card ">
        <div class="w-100">
            <button class="btn  position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                HOUSE</button>
            <img src="/images/blog-images/house-1.png" class="card-img-top  position-relative" alt="..." />
        </div>
        <div class="card-body">
            <div class="w-80 mx-auto margin-negative bg-white position-relative z-index-2 p-5 rounded-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="user-img d-flex">
                        <img src="/images/blog-images/rounded-image.png" class="img-fluid position-relative" alt="...">
                        <div class="ps-3">
                            <span class="mb-1">{{$blog->Author}}</span>
                            <span>{{\Carbon\Carbon::parse($blog->BlogDate)->format('d/m/Y h:i A')}}</span>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="connectionsDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi-three-dots-vertical"></i>
                        </button>

                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="connectionsDropdown2">
                            <a class="btn btn-white dropdown-item" href="#" wire:click="getBlogId({{ $blog->BlogId }})"
                               data-bs-toggle="modal" data-bs-target="#addBlogCommentModal">
                                <i class="bi-pencil me-1"></i> Add Comment
                            </a>
                            <a class="btn btn-white dropdown-item" href="#" wire:click="readBlogComments({{ $blog->BlogId }})"
                               data-bs-toggle="modal" data-bs-target="#ReadBlogCommentModal">
                                <i class="bi-book me-1"></i> Read Comment
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="btn btn-white dropdown-item" href="#"
                               data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{ $blog->BlogId }}Modal"
                            >
                                <i class="bi-trash me-1"></i>Delete Blog
                            </a>
{{--                            <a class="dropdown-item text-danger" href="#">Delete Blog</a>--}}
                        </div>
                    </div>
                </div>
                <div class="paragraph-text pt-3">
        <p>	Hi Everyone! I am excited to have you sharing in our new vacation calendar. This is a long awaited site. that will finally allow us  to know about house.</p>
                </div>
            </div>
            @php
                $blogcomments = App\Models\Blog\BlogComment::where('BlogId', $blog->BlogId )->get();
                $numberofcomments = count($blogcomments);
            @endphp
            <div class="card-footer px-2">
                <ul class="d-flex list-unstyled ul-card-footer">
                    <li><p><span><img src="/images/blog-images/love.png" class="img-fluid me-1"></span>200 Likes</p> </li>
                    <li><p><span><img src="/images/blog-images/chat.png" class="img-fluid me-1"></span>{{$numberofcomments}} Comments</p></li>
                    <li><p><span><img src="/images/blog-images/eye.png" class="img-fluid me-1"></span>200 Likes</p></li>
                </ul>
            </div>
        </div>

            <x-modals.delete-confirmation :id="$blog->BlogId" action="destroy({{$blog->BlogId}})"/>
{{--            @livewire('blog.blog-cards.blog-comments', ['BlogId'=>$blog->BlogId])--}}
                @include('livewire.blog.blog-cards.blog-comments')
</div>
@endif
</div>


@push('customJs')
@endpush
