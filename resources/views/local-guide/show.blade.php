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
        {{--        @if(isset($blogDetail->BlogImage) && !empty($blogDetail->BlogImage))--}}
        {{--            <img src="{{ Storage::url($blogDetail->BlogImage) }}" class="w-100 blog-detail-image" alt="" />--}}
        {{--        @else--}}
        <img src="{{asset('images/blog-images/blog.png')}}" class="w-100 blog-detail-image" alt="" />
        {{--        @endif--}}
        {{--        <img src="{{asset('images/blog-images/blog.png')}}" class="w-100 blog-detail-image" alt="">--}}
    </div>

    <div class="container">
        <div class="card border-0 rounded-20 py-3" style="margin-top: -70px;">
            <div class="card-body">
                {{--                <h1 class="text-w-50 lh-30">{{ $blogDetail->Subject ? $blogDetail->Subject : '' }}</h1>--}}
                <h1 class="text-w-50 lh-30">{{$localGuide->title ?? ''}}</h1>

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
                        <p class="mb-0" style="color: #B6B4B4"><small>{{date('Y-m-d | h:m A',strtotime($localGuide->datetime))}}</small></p>
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
                            <livewire:local-guide.single-guide.like-able-guide :user="$user" :post="$localGuide" />
                        </li>
                        <li class="me-2 me-md-3"><p class="ps-0"><span><img src="/images/blog-images/comment.svg"
                                                                            class="img-fluid me-2"></span> {{$localGuide->comments->count()}} Comments
                            </p></li>
                        <li class="me-2 me-md-3"><p class="ps-0"><span><img src="/images/blog-images/eye.svg"
                                                                            class="img-fluid me-2"></span> {{ $existingViews }} Views
                            </p></li>
                    </ul>
                </div>
                <div class="py-4">

                    {!! $localGuide->description !!}
                </div>
            </div>
            <div class="col-12 col-lg-3">

                <livewire:local-guide.single-guide.latest-guides :user="$user" :post="$localGuide" />

                <div class="card border-0 mb-4 categories-card">
                    <div class="card-body">
                        <h4 class="mb-3">Categories</h4>
                        @foreach($categories as $category)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <a href="{{ route('guest.local-guide.index', ['category' => $category->slug]) }}">
                                        <h4 class="fw-normal" style="color: #6D6D6D">{{ $category->name }}</h4>
                                    </a>
                                </div>
                                <div>
                                    <p class="mb-0 border-primary category-count text-primary">{{ $category->local_guides_count }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v14.0" nonce="tCpUTx77" target="_top"></script>

        <div class="fb-comments" data-href="{{ route('guest.local-guide.show', $localGuide->id) }}" data-width="" data-numposts="3">

        </div>

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

        {{--                <div class="sub-comment ms-2 ps-2 ms-lg-5">--}}
        {{--                    <div class="d-flex w-100">--}}
        {{--                        <div class="flex-shrink-0">--}}
        {{--                            <img src="{{asset('images/images-home/smiling-girl.jpg')}}" class="rounded-1" width="50"--}}
        {{--                                 height="50" style="object-fit: cover" alt="...">--}}
        {{--                        </div>--}}
        {{--                        <div class="flex-grow-1 ms-3">--}}
        {{--                            <h5 class="mb-0">Courteny Hendry</h5>--}}
        {{--                            <p class="mb-0" style="font-size: 12px">Ultricies ultricies interdum dolor sodales. Vitae--}}
        {{--                                feugiat vitae vitae quis id consectetur. Aenean urna, lectus enim suscipit eget.--}}
        {{--                                Tristique bibendum nib.</p>--}}
        {{--                            <p class="mb-0" style="font-size: 12px">--}}
        {{--                            <span class="me-1">--}}
        {{--                                <a href="" class="text-muted">Like</a>--}}
        {{--                            </span>.--}}
        {{--                                <span class="mx-1">--}}
        {{--                                <a href="" class="text-muted">Reply</a>--}}
        {{--                            </span>.--}}
        {{--                                <span class="mx-1 text-muted">--}}
        {{--                                24h--}}
        {{--                            </span>--}}
        {{--                            </p>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}


        {{--            </div>--}}
        {{--        </div>--}}



    </div>

    <div class="container my-5 py-5">
        <h3>Keep Reading</h3>

        <div class="row">
            @foreach($relatedGuides as $dt)
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="card blog-card rounded-2">
                        <div class="card-header border-0 pt-3 pb-1">
                            <div class="d-block d-sm-flex justify-content-between align-items-center">
                                <div class="user-img d-flex align-items-center">

                                    {{--                            <img src="/images/blog-images/house-7.png" class="img-fluid position-relative" alt="...">--}}
                                    <img

                                        src="{{$dt->getFileUrl('image')}}"
                                        class="avatar-initials img-fluid position-relative rounded-circle border-rounded-red"
                                        alt="{{ $dt->title ?? '' }}"
                                    >

                                    <div class="ps-2">
                                        <b class="mb-1 text-black fs-4 title-fs text-capitalize">{{$dt->user->first_name}} {{$dt->user->last_name}}</b>
                                        <p class="mb-0 date-fs">{{ $dt->city }} <a href="#" class="color-blue fw-normal">View</a> </p>
                                    </div>
                                </div>
                                {{--                                        <a class="btn btn-primary-light fs-13 my-3 my-md-0">{{$dt->category->name}}</a>--}}
                            </div>
                            <div class="d-flex align-items-center justify-content-between pt-3">
                                <b class="text-dark">{{$dt->title}}</b>
                                <p class="mb-0">{{date('Y-m-d | h:m A',strtotime($dt->datetime))}}</p>
                            </div>
                        </div>
                        <div class="w-100">
                            <a class="btn  position-absolute text-index featured-btn mt-3 ms-3">FEATURE HOUSE</a>
                            <a href="{{route('guest.local-guide.show',$dt->title)}}">
                                <img src="/images/blog-images/house-5.png" class="card-img-top  position-relative p-2" style="height: 320px !important;object-fit: cover;border-radius:17px;" alt="..." />
                            </a>


                        </div>
                        <div class="card-body p-2">
                            <div class="card-footer px-1 pb-0 border-0 pt-1">
                                <ul class="d-block d-sm-flex list-unstyled recipe-card-footer justify-content-between mb-2">
                                    <li>
                                        <span class="text-primary fw-bolder fs-4">5.0</span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <a href="{{route('guest.local-guide.show',$dt->id)}}">
                                            <span class="ps-2 text-dark">({{$dt->reviews->count()}} Reviews)</span>
                                        </a>
                                    </li>
                                    <li class="pt-2 pt-md-0"><img src="/images/local-guide/chat-comment.svg" class="img-fluid me-1">
                                        <a href="{{route('guest.local-guide.show',$dt->id)}}">
                                            <span class="text-dark">{{$dt->comments->count()}}  Comments</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>


</x-guest-layout>





{{--<div class="container my-5">--}}
{{--    <div class="row my-5">--}}

{{--        <div class="col-lg-6">--}}
{{--            --}}{{--  comment Compenent--}}
{{--            <livewire:comment.comment-form :local-guide="$localGuide" />--}}
{{--        </div>--}}

{{--        <div class="col-lg-6">--}}
{{--            --}}{{--  Star Rating Component--}}
{{--            <livewire:review.review-form :local-guide="$localGuide" />--}}
{{--        </div>--}}

{{--    </div>--}}
{{--</div>--}}
