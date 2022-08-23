<x-guest-layout>
    @push('stylesheets')
        <style>
            .blog-detail-image {
                height: 400px;
                object-fit: cover;
            }

            .rounded-20 {
                border-radius: 20px;
            }

            .lh-30 {
                line-height: 35px;
            }

            .text-w-50 {
                width: 50% !important;
            }

            .categories-card .category-count {
                border-radius: 6px;
                border: 2px solid #E8604C;
                padding: 6px 10px;

            }

            .sub-comment {
                border-left: 1px dashed #00000030;
                margin-left: 55px !important;
            }

            @media (max-width: 992px) {
                .text-w-50 {
                    width: 100% !important;
                }
            }

            @media (max-width: 992px) {
                .sub-comment {
                    border-left: 1px dashed #00000030;
                    margin-left: 25px !important;
                }
            }
        </style>
    @endpush

    <div class="">
            <img src="{{ $post->getFileUrl() }}" class="w-100 blog-detail-image" alt="" />
    </div>

    <div class="container">
        <div class="card border-0 rounded-20 py-3" style="margin-top: -70px;">
            <div class="card-body">
                <h1 class="text-w-50 lh-30">{{ $post->Subject ? $post->Subject : '' }}</h1>

                <div class="d-flex align-items-center mt-4">
                    <div class="flex-shrink-0">
{{--                        <img--}}
{{--                            class="avatar-img rounded-circle"--}}
{{--                            src="{{ auth()->user()->profile_photo_url }}"--}}
{{--                            :src="avatarUrl"--}}
{{--                            alt="Image"--}}
{{--                            width="60" height="60" style="object-fit: cover"--}}
{{--                        />--}}
                        <img src="/images/blog-images/rounded-image.png" class="img-fluid position-relative" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h4 class="mb-0" style="color: #6D6D6D">{{ auth()->user()->first_name }}</h4>
                        <p class="mb-0" style="color: #B6B4B4"><small>{{\Carbon\Carbon::parse($post->BlogDate)->format('d M Y')}}</small></p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container my-5 pt-5">
        <div class="row">
            <div class="col-12 col-lg-9 pe-0 pe-lg-5">
                <div class="border-bottom">
                    <ul class="d-flex list-unstyled ul-card-footer mb-0">
                        <li class="me-2 me-md-3">
                            <livewire:blog.like-able-blog :post="$post" />
                        </li>
                        <li class="me-2 me-md-3"><p class="ps-0" id="content"><span><img src="/images/blog-images/comment.svg"
                                                                            class="img-fluid me-2"></span>
{{--                                {{$total_comments}} --}}
                                Comments
                            </p></li>
                        <li class="me-2 me-md-3"><p class="ps-0"><span><img src="/images/blog-images/eye.svg"
                                                                            class="img-fluid me-2"></span> {{ $existing_views }} Views
                            </p></li>
                    </ul>
                </div>
                <div class="py-4">
                    {!! $post->Content !!}
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <livewire:blog.latest-post :user="$user" :post="$post" />

                <div class="card border-0 mb-4 categories-card">
                    <div class="card-body">
                        <h4 class="mb-3">Categories</h4>
                        @foreach($categories as $category)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h4 class="fw-normal" style="color: #6D6D6D">{{ $category->name }}</h4>
                            </div>
                            <div>
                                <p class="mb-0 border-primary category-count">{{ $category->blogs_count }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="card border-0 mb-4 tags-card">
                    <div class="card-body">
                        <h4 class="mb-3">Tags</h4>
                        <div>
                            <span>
                                <a href="" class="btn btn-sm me-3 btn-soft-primary mb-3">Business</a>
                            </span>
                            <span>
                                <a href="" class="btn btn-sm me-3 btn-soft-primary mb-3">Graphic Design</a>
                            </span>
                            <span>
                                <a href="" class="btn btn-sm me-3 btn-soft-primary mb-3">Technology</a>
                            </span>
                            <span>
                                <a href="" class="btn btn-sm me-3 btn-soft-primary mb-3">App Development</a>
                            </span>
                            <span>
                                <a href="" class="btn btn-sm me-3 btn-soft-primary mb-3">Website Design</a>
                            </span>
                            <span>
                                <a href="" class="btn btn-sm me-3 btn-soft-primary mb-3">Business Idea</a>
                            </span>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v14.0" nonce="tCpUTx77"></script>

        <div class="fb-comments" data-href="{{ route('guest.blog.show', $post->BlogId) }}" data-width="" data-numposts="3">

        </div>
{{--            <livewire:blog.post-comment :user="$user" :blog="$post" />--}}
{{--        <div class="row mt-5 mb-3">--}}
{{--            <div class="col-12 col-lg-6">--}}
{{--                <div class="d-flex w-100">--}}
{{--                    <div class="flex-shrink-0">--}}
{{--                        <img src="{{asset('images/images-home/smiling-girl.jpg')}}" class="rounded-1" width="50"--}}
{{--                             height="50" style="object-fit: cover" alt="...">--}}
{{--                    </div>--}}
{{--                    <div class="flex-grow-1 ms-3 mb-3">--}}
{{--                        <h5 class="mb-0">Courteny Hendry</h5>--}}
{{--                        <p class="mb-0" style="font-size: 12px">Ultricies ultricies interdum dolor sodales. Vitae--}}
{{--                            feugiat vitae vitae quis id consectetur. Aenean urna, lectus enim suscipit eget. Tristique--}}
{{--                            bibendum nib.</p>--}}
{{--                        <p class="mb-0" style="font-size: 12px">--}}
{{--                            <span class="me-1">--}}
{{--                                <a href="" class="text-muted">Like</a>--}}
{{--                            </span>.--}}
{{--                            <span class="mx-1">--}}
{{--                                <a href="" class="text-muted">Reply</a>--}}
{{--                            </span>.--}}
{{--                            <span class="mx-1 text-muted">--}}
{{--                                24h--}}
{{--                            </span>--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}



{{--            </div>--}}
{{--        </div>--}}


{{--        <div class="row mt-5 mb-3">--}}
{{--            <div class="col-12 col-lg-6">--}}
{{--                <button class="w-100 btn btn-primary">Load 13 More comments</button>--}}
{{--            </div>--}}
{{--        </div>--}}


    </div>

    <div class="container mt-5 py-5">
        <h3>Keep Reading</h3>


        <div class="row">
            @foreach($relatedBlog as $blog)
                <livewire:blog.house-related-blog :blog="$blog" />
            @endforeach

        </div>
    </div>


</x-guest-layout>

@push('scripts')
    <script>

        const myTimeout = setTimeout(updateComment, 5000);

        function updateComment() {
            var cms = document.getElementsByClassName('_50f7')[0].textContent;
            console.log(cms);
            document.getElementById("content").innerHTML = cms;
        }
    </script>
@endpush


