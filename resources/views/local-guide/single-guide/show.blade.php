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
                padding: 5px 10px;
                min-width: 43px;
                max-width: 43px;
                text-align: center;

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
        <img
{{--            src="{{ $localGuide->getFileUrl('image') }}"--}}

            @if(isset($localGuide->image))
            src="{{$localGuide->getFileUrl('image')}}"
            @elseif(!is_null($localGuide->user->house->image))
            src="{{ $localGuide->user->house->getFileUrl() }}"
            @else
            src="{{$localGuide->getFileUrl('image')}}"
            @endif


            class="w-100 blog-detail-image" alt=""/>
    </div>
    <main style="background-color:#fff !important;">
        <div class="container">
            <div class="card border-0 rounded-20 py-3 shadow-none p-4" style="margin-top: -70px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h1 class="text-w-50 lh-30 fs-card-title text-break text-capitalize">{{$localGuide->title ?? ''}}</h1>
                        <p class="mb-0 badge badge-primary fs-13 fw-semi-bold ms-2 ms-sm-0"
                           style="padding: 10px 20px !important;">{{$localGuide->category->name ?? ''}}</p>
                    </div>
                    <div class="d-flex mt-4">
                        <div class="flex-shrink-0">
                            <img
                                class="rounded-circle border-rounded-red"
                                src="{{ $localGuide->user->profile_photo_url }}"
                                :src="avatarUrl"
                                alt="Image"
                                width="60" height="60" style="object-fit: cover"
                            />
                        </div>
                        <div class="flex-grow-1 ms-3 d-block d-sm-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0 text-dark text-capitalize"
                                    style="color: #6D6D6D">{{ $localGuide->user->first_name }} {{ $localGuide->user->last_name }}</h4>
                                <p class="mb-0" style="color: #B6B4B4">
                                    <small class="fw-500 text-light-grey">{{$localGuide->address}}</small><span
                                        class="color-blue ps-2">
                                        <a href="https://google.com/maps?q={{$localGuide->address}}" target="_blank"
                                           class="color-blue fw-normal">View</a>
                                    </span></p>
                                <div class="d-flex align-items-center ">
                                    <ul class="d-block d-sm-flex list-unstyled recipe-card-footer justify-content-between mb-2 align-items-center">

                                        @if(isset($avgRating))
                                            {{--                                                <span class="text-primary fw-bolder fs-4">--}}
                                            {{--                                                    {{ $avgRating ?? 0}}.0--}}
                                            {{--                                                </span>--}}
                                            @php
                                                $i = 0;
                                            @endphp

                                            @while (++$i <= ($avgRating ?? 0))
                                                {{--                                                    <li class="fa fa-star checked"></li>--}}
                                                <img
                                                    src="{{asset('images/local-guide/review-star.svg')}}"
                                                    style="width: 17px;margin-top: -1px" alt="">
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
                                                <span class="ps-2 text-light-grey">({{$localGuide->reviews->count()}} Reviews)</span>
                                            </a>
                                        @else
                                            {{--                                                <span class="text-primary fw-bolder fs-4">--}}
                                            {{--                                                   0--}}
                                            {{--                                                </span>--}}
                                            <div class="d-flex align-items-center">
                                                <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}"
                                                     style="width: 17px;margin-top: -3px"
                                                     alt="">
                                                <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}"
                                                     style="width: 17px;margin-top: -3px"
                                                     alt="">
                                                <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}"
                                                     style="width: 17px;margin-top: -3px"
                                                     alt="">
                                                <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}"
                                                     style="width: 17px;margin-top: -3px"
                                                     alt="">
                                                <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}"
                                                     style="width: 17px;margin-top: -3px"
                                                     alt="">
                                                <a href="{{route('guest.local-guide.show',$localGuide->id)}}">
                                                    <span class="ps-2 text-light-grey">(0 Reviews)</span>
                                                </a>
                                            </div>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="container my-2 my-md-5 pt-5">

            <div class="row">
                <div class="col-12 col-lg-9 pe-0 pe-lg-5 scrollbar-custom">

                    <div id="style-3" style="overflow-x: scroll
                    ">
                        <div class="border-bottom">
                            <p class="mb-3" style="font-size: 12px"><span
                                    class="mx-1 text-muted">{{ $localGuide->datetime }}</span>
                            </p>
                        </div>
                        <div class="py-4">
                            {!! $localGuide->description !!}
                        </div>
                    </div>

                    @php

                        $address = $localGuide->address;
                        $apiKey = env('GOOGLE_MAPS_API_KEY');
                        $geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false&key='.$apiKey);
                        $geo = json_decode($geo, true);

                        if (isset($geo['status']) && ($geo['status'] == 'OK')) {
                          $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
                          $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
                        }

                    @endphp


                    <div class="row my-5 pt-5">
                        <div class="col-12">
                            @if(isset($geo['status']) && ($geo['status'] == 'OK'))
                                <iframe src="https://maps.google.com/maps?q={{$latitude ?? 0}},{{$longitude ?? 0 }}&hl=es;z=14&output=embed"
                                        class="w-100" height="350" style="border:0;"
                                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            @endif

                        </div>
                    </div>


                    <livewire:review.review-form :local-guide="$localGuide"/>


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
                                        <p class="mb-0 border-primary category-count text-primary">
                                            {{ $category->local_guides_count < 10 ? '0'.$category->local_guides_count : $category->local_guides_count }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>



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
                                                alt="{{ $dt->user->name ?? '' }}" style="object-fit: cover;"
                                            >
                                            <div class="ps-2">
                                                <b class="mb-1 text-black fs-4 title-fs text-capitalize">{{$dt->user->first_name}} {{$dt->user->last_name}}</b>
                                                <p class="mb-0 date-fs fw-500">{{ substr($dt->address , 0 ,15) }} <a
                                                        href="#"
                                                        class="color-blue fw-normal">View</a>
                                                </p>
                                            </div>
                                        </div>
                                        <a class="mb-0 badge badge-primary fs-13 fw-normal p-2 mt-3 mt-sm-0">{{$dt->category->name ?? ''}}</a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between pt-3">
                                        <a href="{{route('guest.local-guide.show',$dt->id)}}">
                                            <p class="text-dark mb-0"
                                               style="font-weight: 500">{{ substr($dt->title, 0, 15) }}</p>
                                        </a>

                                        <p class="mb-0">{{ $dt->datetime }}</p>
                                    </div>
                                </div>
                                <div class="w-100">
                                    <a class="btn  position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                                        HOUSE</a>

                                    <a href="{{route('guest.local-guide.show',$dt->id)}}">
                                        <img

                                            {{--                                            src="{{$dt->getFileUrl('image')}}"--}}
                                            @if(isset($dt->image))
                                            src="{{$dt->getFileUrl('image')}}"
                                            @elseif(!is_null($dt->user->house->image))
                                            src="{{ $dt->user->house->getFileUrl() }}"
                                            @else
                                            src="{{$dt->getFileUrl('image')}}"
                                            @endif
                                            class="card-img-top  position-relative p-2"
                                            style="height: 320px !important;object-fit: cover;border-radius:17px;"
                                            alt="{{ $dt->title ?? '' }}"/>
                                    </a>
                                </div>
                                <div class="card-body p-2">
                                    <div class="card-footer px-1 pb-0 border-0 pt-1">
                                        <div
                                            class="d-block d-sm-flex list-unstyled recipe-card-footer mb-2 align-items-center">

                                            @if(isset($dt->reviews_count))
                                                <span class="text-primary fw-bolder fs-4 pe-2">
                                                        {{ $dt->reviews_count ?? 0}}.0
                                                    </span>
                                                @php
                                                    $i = 0;
                                                @endphp

                                                @while (++$i <= ($dt->reviews_count ?? 0))
                                                    <span class="fa fa-star checked"></span>
                                                @endwhile
                                                @php
                                                    $r = 1;
                                                    $t_rating = 5;
                                                @endphp

                                                @for ($r; $r <= $t_rating - $dt->reviews_count; $r++)
                                                    <img
                                                        src="{{asset('images/local-guide/star-rating-light-icon.svg')}}"
                                                        style="width: 17px;margin-top: -1px" alt="">
                                                @endfor

                                                <a href="{{route('guest.local-guide.show',$dt->id)}}">
                                                        <span
                                                            class="ps-2 text-light-grey">({{$dt->reviews->count()}} Reviews)</span>
                                                </a>
                                            @else
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
                                                    <span class="ps-2 text-light-grey">(0 Reviews)</span>
                                                </a>
                                            @endif

                                        </div>
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

