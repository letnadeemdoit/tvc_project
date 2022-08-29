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
        <img src="{{asset('images/blog-images/blog.png')}}" class="w-100 blog-detail-image" alt=""/>
    </div>
    <main style="background-color:#fff !important;">
        <div class="container">
            <div class="card border-0 rounded-20 py-3 shadow-none" style="margin-top: -70px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="text-w-50 lh-30">{{$localGuide->title ?? ''}}</h1>
                        <a style="cursor: text" class="btn btn-soft-primary px-5">{{$localGuide->category->name}}</a>
                    </div>
                    <div class="d-flex align-items-center mt-4">
                        <div class="flex-shrink-0">
                            <img
                                class="rounded-circle border-rounded-red"
                                src="{{ auth()->user()->profile_photo_url }}"
                                :src="avatarUrl"
                                alt="Image"
                                width="60" height="60" style="object-fit: cover"
                            />
                        </div>
                        <div class="flex-grow-1 ms-3 d-block d-sm-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0 text-dark" style="color: #6D6D6D">{{ auth()->user()->first_name }}</h4>
                                <p class="mb-0" style="color: #B6B4B4">
                                    <small>{{$localGuide->address}}</small><span
                                        class="color-blue ps-2">
                                        <a href="https://google.com/maps?q={{$localGuide->address}}" target="_blank"
                                           class="color-blue fw-normal">View</a>
                                    </span></p>
                                <div class="d-flex align-items-center ">
                                    <ul class="d-block d-sm-flex list-unstyled recipe-card-footer justify-content-between mb-2">

                                        @if(isset($avgRating))
                                            <li>
                                                <span class="text-primary fw-bolder fs-4">
                                                    {{ $avgRating ?? 0}}.0
                                                </span>
                                                @php
                                                    $i = 0;
                                                @endphp

                                                @while (++$i <= ($avgRating ?? 0))
                                                    <span class="fa fa-star checked"></span>
                                                @endwhile
                                                @php
                                                    $r = 1;
                                                    $t_rating = 5;
                                                @endphp

                                                @for ($r; $r <= $t_rating - $avgRating; $r++)
                                                    <img
                                                        src="{{asset('images/local-guide/star-rating-light-icon.svg')}}"
                                                        style="width: 17px;margin-top: -1px" alt="">
                                                @endfor

                                                <a href="{{route('guest.local-guide.show',$localGuide->id)}}">
                                                    <span class="ps-2 text-dark">({{$localGuide->reviews->count()}} Reviews)</span>
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                                <span class="text-primary fw-bolder fs-4">
                                                   0
                                                </span>
                                                <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}"
                                                     style="width: 17px"
                                                     alt="">
                                                <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}"
                                                     style="width: 17px"
                                                     alt="">
                                                <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}"
                                                     style="width: 17px"
                                                     alt="">
                                                <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}"
                                                     style="width: 17px"
                                                     alt="">
                                                <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}"
                                                     style="width: 17px"
                                                     alt="">
                                                <a href="{{route('guest.local-guide.show',$localGuide->id)}}">
                                                    <span class="ps-2 text-dark">(0 Reviews)</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="container my-5 pt-5">
            <div class="row">
                <div class="col-12 col-lg-9 pe-0 pe-lg-5">
                    <div class="border-bottom">
                        <p class="mb-0" style="font-size: 12px"><span
                                class="mx-1 text-muted">{{date('Y-m-d | h:m A',strtotime($localGuide->datetime))}}</span>
                        </p>
                    </div>
                    <div class="py-4">
                        {!! $localGuide->description !!}
                    </div>
                </div>

                <div class="col-12 col-lg-3">

                    <livewire:local-guide.single-guide.latest-guides :user="$user" :post="$localGuide"/>

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

        <livewire:review.review-form :local-guide="$localGuide"/>

        @if(isset($relatedGuides) && count($relatedGuides) > 0)
            <div class="container my-5 py-5">
                <h3>Keep Reading</h3>
                <div class="row">
                    @foreach($relatedGuides as $dt)
                        <div class="col-md-6 col-xl-4 mb-4 item">
                            <div class="card blog-card rounded-2">
                                <div class="card-header border-0 pt-3 pb-1">
                                    <div class="d-block d-sm-flex justify-content-between align-items-center">
                                        <div class="user-img d-flex align-items-center">
                                            <img

                                                src="{{ $dt->user->profile_photo_url }}"
                                                class="avatar-initials img-fluid position-relative rounded-circle border-rounded-red"
                                                alt="{{ $dt->user->name ?? '' }}"
                                            >
                                            <div class="ps-2">
                                                <b class="mb-1 text-black fs-4 title-fs text-capitalize">{{$dt->user->first_name}} {{$dt->user->last_name}}</b>
                                                <p class="mb-0 date-fs">{{ substr($dt->address , 0 ,25) }} <a href="#"
                                                                                                              class="color-blue fw-normal">View</a>
                                                </p>
                                            </div>
                                        </div>
                                        <a class="btn btn-primary-light fs-13 my-3 my-md-0">{{$dt->category->name}}</a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between pt-3">
                                        <b class="text-dark">{{ substr($dt->title , 0, 30) }}</b>
                                        <p class="mb-0">{{date('Y-m-d | h:m A',strtotime($dt->datetime))}}</p>
                                    </div>
                                </div>
                                <div class="w-100">
                                    <a class="btn  position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                                        HOUSE</a>
                                    <a href="{{route('guest.local-guide.show',$dt->id)}}">
                                        <img src="{{$dt->getFileUrl('image')}}"
                                             class="card-img-top  position-relative p-2"
                                             style="height: 320px !important;object-fit: cover;border-radius:17px;"
                                             alt="{{ $dt->title ?? '' }}"/>
                                    </a>
                                </div>
                                <div class="card-body p-2">
                                    <div class="card-footer px-1 pb-0 border-0 pt-1">
                                        <ul class="d-block d-sm-flex list-unstyled recipe-card-footer justify-content-between mb-2">

                                            @if(isset($avgRating))
                                                <li>
                                                    <span class="text-primary fw-bolder fs-4">
                                                        {{ $avgRating ?? 0}}.0
                                                    </span>
                                                    @php
                                                        $i = 0;
                                                    @endphp

                                                    @while (++$i <= ($avgRating ?? 0))
                                                        <span class="fa fa-star checked"></span>
                                                    @endwhile
                                                    @php
                                                        $r = 1;
                                                        $t_rating = 5;
                                                    @endphp

                                                    @for ($r; $r <= $t_rating - $avgRating; $r++)
                                                        <img
                                                            src="{{asset('images/local-guide/star-rating-light-icon.svg')}}"
                                                            style="width: 17px;margin-top: -1px" alt="">
                                                    @endfor

                                                    <a href="{{route('guest.local-guide.show',$dt->id)}}">
                                                        <span
                                                            class="ps-2 text-dark">({{$dt->reviews->count()}} Reviews)</span>
                                                    </a>
                                                </li>
                                            @else
                                                <li>
                                                    <span class="text-primary fw-bolder fs-4">
                                                       0
                                                    </span>
                                                    <img
                                                        src="{{asset('images/local-guide/star-rating-light-icon.svg')}}"
                                                        style="width: 17px"
                                                        alt="">
                                                    <img
                                                        src="{{asset('images/local-guide/star-rating-light-icon.svg')}}"
                                                        style="width: 17px"
                                                        alt="">
                                                    <img
                                                        src="{{asset('images/local-guide/star-rating-light-icon.svg')}}"
                                                        style="width: 17px"
                                                        alt="">
                                                    <img
                                                        src="{{asset('images/local-guide/star-rating-light-icon.svg')}}"
                                                        style="width: 17px"
                                                        alt="">
                                                    <img
                                                        src="{{asset('images/local-guide/star-rating-light-icon.svg')}}"
                                                        style="width: 17px"
                                                        alt="">
                                                    <a href="{{route('guest.local-guide.show',$dt->id)}}">
                                                        <span class="ps-2 text-dark">(0 Reviews)</span>
                                                    </a>
                                                </li>
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </main>

</x-guest-layout>

