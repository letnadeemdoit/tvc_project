<div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-3">
    @if(isset($blog))
        <div class="card blog-card">
            <div class="w-100">
                <button class="btn  position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                    BLOG</button>
                <a href="{{route('guest.blog-details', $blog->BlogId)}}">
                    @if(isset($blog->BlogImage) && !empty($blog->BlogImage))
                    <img src="{{ Storage::url($blog->BlogImage) }}" class="card-img-top  position-relative" style="height: 290px !important;object-fit: cover" alt="..." />
                    @else
                        <img src="/images/blog-images/house-1.png" class="card-img-top  position-relative" style="height: 290px !important;object-fit: cover" alt="..." />
                    @endif
                </a>


            </div>
            <div class="card-body p-2">
                <div class="w-80 mx-auto margin-negative bg-white position-relative z-index-2 p-5 rounded-3" style="height: 200px">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="user-img d-flex align-items-center">
                            {{--                        @if(!is_null($userimage))--}}
                            {{--                            <img src="{{ Storage::url($userimage) }}" class="img-fluid position-relative" alt="...">--}}
                            <img src="/images/blog-images/rounded-image.png" class="img-fluid position-relative" alt="...">

                            <div class="ps-3">
                                <strong class="mb-1 text-black fs-4">{{$blog->Author}}</strong>
                                <p>{{\Carbon\Carbon::parse($blog->BlogDate)->format('d M Y')}}</p>
                            </div>
                        </div>
                        <div class="dropdown" x-data>
                            <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle list-btn" id="connectionsDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi-three-dots-vertical"></i>
                            </button>

                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end blog-dropdown" aria-labelledby="connectionsDropdown2">
                                <a class="btn btn-white dropdown-item blog-dropdown-item" href="#"
                                   data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{ $blog->BlogId }}Modal"
                                >
                                    <i class="bi-trash me-1"></i>Delete Blog
                                </a>
                                <a class="btn btn-white dropdown-item blog-dropdown-item" href="#" wire:click="getBlogId({{ $blog->BlogId }})"
                                   data-bs-toggle="modal" data-bs-target="#addBlogCommentModal">
                                    <i class="bi-pencil me-1"></i> Add Comment
                                </a>
                                <a class="btn btn-white dropdown-item blog-dropdown-item" href="#" @click.prevent="window.livewire.emit('readBlogComments', {{$blog->BlogId}})">
                                    <i class="bi-book me-1"></i> Read Comment
                                </a>

                                {{--                            <a class="dropdown-item text-danger" href="#">Delete Blog</a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="paragraph-text pt-3 text-black text-center text-md-start">
                        <p>	{!!  Str::limit($blog->Content, 80)  !!}</p>
                    </div>
                </div>
                @php
                    $blogcomments = App\Models\Blog\BlogComment::where('BlogId', $blog->BlogId )->get();
                    $numberofcomments = count($blogcomments);
                @endphp
                <div class="card-footer px-0 pb-0">
                    <ul class="d-flex list-unstyled ul-card-footer justify-content-between">
                        <li><img src="/images/blog-images/love.png" class="img-fluid me-1"><span>200 Likes</span></li>
                        <li><img src="/images/blog-images/comment.svg" class="img-fluid me-1"><span>{{$numberofcomments}} Comments</span></li>
                        <li><img src="/images/blog-images/eye.png" class="img-fluid me-1"><span>200 Views</span></li>
                    </ul>
                </div>
            </div>

            <x-modals.delete-confirmation :id="$blog->BlogId" action="destroy({{$blog->BlogId}})"/>
            {{--            @livewire('blog.blog-cards.blog-comments', ['BlogId'=>$blog->BlogId])--}}
            @include('livewire.blog.blog-cards.blog-comments')

        </div>
    @endif
</div>



@pushonce('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            window.livewire.on('openModal', (id) => {
                $(`#ce${id}`).modal('show');
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            window.livewire.on('hideModal', (reload = false) => {
                $('.hideableModal').each(function () {
                    $(this).modal('hide');
                });
                if (reload) {
                    window.location.reload();
                } else {
                    $('.modal-backdrop').remove();
                    $('body').css('overflow', '');
                    $('body').css('padding-right', '');
                    $('body').removeClass('modal-open');
                }
            });
        });
    </script>
@endpushonce
