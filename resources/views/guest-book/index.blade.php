<x-guest-layout>
    @push('stylesheets')
        <style>

            /*.card-01 {*/
            /*    background-image: url("/images/guest-book/quotes.svg") !important;*/
            /*    background-repeat: no-repeat;*/
            /*    background-position: top left;*/
            /*    background-size: 55px;*/
            /*    background-position-x: 9.5%;*/
            /*    background-position-y: 4%;*/
            /*}*/

            .card-01 {
                border-top-left-radius: 12px;
                border-top-right-radius: 12px;
            }

            .bg-card-body:nth-child(even) {
                background-color: #E8604C;
            }

            .bg-card-body:nth-child(odd) {
                background-color: #2A3342;
            }

            .card-01 .card-body {
                position: relative;
                padding-top: 40px;
                border-bottom-left-radius: 9px;
                border-bottom-right-radius: 9px;
            }

            .card-01 .badge-box img {
                position: absolute;
                top: -36px;
                left: 50%;
                width: 70px;
                height: 70px;
                margin-left: -32px;
                text-align: center;
                border: 3px solid #fff;
            }

            .card-01 .badge-box i {
                background: #006eff;
                color: #fff;
                border-radius: 50%;
                width: 50px;
                height: 50px;
                line-height: 50px;
                text-align: center;
                font-size: 20px;
            }

            .card-01 .height-fix {
                height: 455px;
                overflow: hidden;
            }

            .card-01 .height-fix .card-img-top {
                width: auto !important;
            }

            .card-01 .profile-box {
                background-size: cover;
                float: left;
                width: 100%;
                text-align: center;
                padding: 30px 0;
                position: relative;
                overflow: hidden;
            }

            .card-01 .profile-box:before {
                filter: blur(10px);
                background: url("https://images.pexels.com/photos/195825/pexels-photo-195825.jpeg?h=350&auto=compress&cs=tinysrgb") no-repeat;
                background-size: cover;
                width: 120%;
                position: absolute;
                content: "";
                height: 120%;
                left: -10%;
                top: 0;
                z-index: 0;
            }

            .card-01 .profile-box img {
                width: 170px;
                height: 170px;
                position: relative;
                border: 5px solid #fff;
            }

            .card-01.height-fix .fa {
                color: #fff;
                font-size: 22px;
                margin-right: 18px;
            }
        </style>

        <style type="text/css">
            .read-more-show {
                cursor: pointer;
                color: #ed8323;
            }

            .read-more-hide {
                cursor: pointer;
                color: #ed8323;
            }

            .hide_content {
                display: none;
            }
        </style>
    @endpush

    @include('partials.sub-page-hero-section', ['title' => 'Guest Book'])

    <section class=" bg-light">
        <div class="section-padding">
                <div class="bg-guest shadow-1-strong rounded text-center  d-flex justify-content-center align-items-center">
                    <h1 class="text-primary font-vintage mb-0">Guest Book</h1>
                </div>
                <h1 class="pt-2 text-center poppins-bold">Read guest reviews here</h1>
            </div>
        @if(isset($data) && count($data) > 0)
            <div class="container mt-2 mb-5">
                <div class="row">

                    @foreach($data as $dt)
                            @if($loop->iteration % 2 == 0)
                                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                    <div class="card card-01 shadow-lg" style="min-height: 380px">
                                        <div class="guest-card-description pb-4 ps-4 pe-2" style="min-height: 270px;">
                                            <img src="{{asset('/images/guest-book/quotes.svg')}}" width="55"
                                                 class="img-fluid margin-left-negative pt-3">
                                            @if(isset($dt->content) && strlen($dt->content) > 130)
                                                <h3 class="pt-1">{{ substr($dt->title , 0, 25) }}</h3>
                                            @else
                                                <h3 class="pt-1">{{ $dt->title , 0, 25 }}</h3>
                                            @endif
                                            <div class="text-light-secondary">
                                                {!! substr($dt->content,0,130) !!}
                                                @if(isset($dt->content) && strlen($dt->content) > 130)
                                                <a href="#" class="text-primary text-decoration-underline" data-bs-toggle="modal"
                                                   data-bs-target="#guestBook{{$dt->id}}Modal">Read More</a>
                                                    @endif

                                            </div>
                                        </div>
                                        <div class="card-body bg-dark-blue pb-5">
                            <span class="badge-box py-4">
                                <img src="{{$dt->getFileUrl('image')}}"
                                     alt="{{ $dt->name ?? '' }}"
                                     class="rounded-circle" width="60" style="object-fit: cover;" />
                                            </span>
                                            <h4 class="card-title text-center mt-3 mb-1 text-white fw-normal">{{$dt->name}}</h4>
                                            <p class="card-text text-center text-white-light fw-light fs-10">{{date('Y-m-d',strtotime($dt->created_at))}}</p>
                                        </div>
                                    </div>
                                </div>

                                {{--            modal starts            --}}
                                <div class="modal guest-modal fade" id="guestBook{{$dt->id}}Modal" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-transparent border-0">

                                            <div class="modal-body">
                                                <div class="card card-01 shadow-lg border-0" style="min-height: 380px">
                                                    <div class="modal-header text-end pt-3 pe-2">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="guest-card-description pb-4 ps-4 pe-2"
                                                         style="min-height: 270px;">
                                                        <img src="{{asset('/images/guest-book/quotes.svg')}}" width="55"
                                                             class="img-fluid margin-left-negative">
                                                        <div class="guest-card-cont">
                                                            <h3 class="pt-1">{{$dt->title }}</h3>
                                                            <p> {!! $dt->content !!}</p>
                                                        </div>
                                                    </div>
                                                    <div class="card-body bg-dark-blue pb-5">
                                                        <span class="badge-box py-4">
                                                            <img src="{{$dt->getFileUrl('image')}}"
                                                                 alt="{{ $dt->name ?? '' }}"
                                                         class="rounded-circle" width="60"/>
                                                                </span>
                                                        <h4 class="card-title text-center mt-3 mb-1 text-white fw-normal">{{$dt->name}}</h4>
                                                        <p class="card-text text-center text-white-light fw-light fs-10">{{date('Y-m-d',strtotime($dt->created_at))}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{--            modal ends                --}}
                            @else
                                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                    <div class="card card-01 shadow-lg my-4 my-md-0 border-0" style="min-height: 380px">
                                        <div class="guest-card-description pb-4 ps-4 pe-2" style="min-height: 270px;">
                                            <img src="{{asset('/images/guest-book/quotes.svg')}}" width="55"
                                                 class="img-fluid margin-left-negative pt-3">

                                            @if(isset($dt->content) && strlen($dt->content) > 130)
                                            <h3 class="pt-1">{{ substr($dt->title , 0, 25) }}</h3>
                                            @else
                                                <h3 class="pt-1">{{ $dt->title , 0, 25 }}</h3>
                                            @endif

                                            <div class="text-light-secondary">
                                                {!! substr($dt->content,0,130) !!}
                                                @if(isset($dt->content) && strlen($dt->content) > 130)
                                                <a href="#" class="text-primary text-decoration-underline" data-bs-toggle="modal"
                                                   data-bs-target="#guestBook{{$dt->id}}Model">Read More</a>
                                                @endif
                                            </div>


                                            {{--                                        {!! $dt->content     !!}--}}
                                        </div>
                                        <div class="card-body bg-primary pb-5">
                                            <span class="badge-box py-4">
                                                <img src="{{$dt->getFileUrl('image')}}"
                                                     alt="{{ $dt->name ?? '' }}"
                                                     class="rounded-circle" width="60" style="object-fit: cover;"/>
                                            </span>
                                            <h4 class="card-title text-center mb-1 mt-3 text-white fw-normal">{{$dt->name}}</h4>
                                            <p class="card-text text-center text-white-light fw-light fs-10">{{date('Y-m-d',strtotime($dt->created_at))}}</p>
                                        </div>
                                    </div>
                                </div>
                                {{--              modal              --}}
                                <div class="modal guest-modal fade" id="guestBook{{$dt->id}}Model" tabindex="-1" aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-transparent border-0">

                                            <div class="modal-body">
                                                <div class="card card-01 shadow-lg my-4 my-md-0 border-0">
                                                    <div class="modal-header text-end pt-3 pe-2">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="guest-card-description pb-4 ps-4 pe-2"
                                                         style="min-height: 270px;">
                                                        <img src="{{asset('/images/guest-book/quotes.svg')}}" width="55"
                                                             class="img-fluid margin-left-negative">
                                                        <div class="guest-card-cont">
                                                            <h3 class="pt-1">{{$dt->title }}</h3>
                                                            <p> {!! $dt->content !!}</p>
                                                        </div>


                                                        {{--                                        {!! $dt->content     !!}--}}
                                                    </div>
                                                    <div class="card-body bg-primary pb-5">
                                            <span class="badge-box py-4">
                                                <img src="{{$dt->getFileUrl('image')}}"
                                                     alt="{{ $dt->name ?? '' }}"
                                                     class="rounded-circle" width="60"/>
                                            </span>
                                                        <h4 class="card-title text-center mb-1 mt-3 text-white fw-normal">{{$dt->name}}</h4>
                                                        <p class="card-text text-center text-white-light fw-light fs-10">{{date('Y-m-d',strtotime($dt->created_at))}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--              modal ends              --}}
                            @endif
                        @endforeach

                </div>
            </div>
        @else
            @include('partials.no-data-available',['title' => 'Guest Review'])
        @endif

        <div class="container padding-bottom " style="padding-top: 80px">
{{--            @if(!auth()->user()->is_guest)--}}
                <livewire:guest-book.leav-a-review-guest-book :user="$user"/>
{{--             @endif--}}
        </div>

    </section>


    @push('scripts')
        <script type="text/javascript">
            // Hide the extra content initially, using JS so that if JS is disabled, no problemo:
            $('.read-more-content').addClass('hide_content')
            $('.read-more-show, .read-more-hide').removeClass('hide_content')

            // Set up the toggle effect:
            $('.read-more-show').on('click', function (e) {
                $(this).next('.read-more-content').removeClass('hide_content');
                $(this).addClass('hide_content');
                e.preventDefault();
            });

            // Changes contributed by @diego-rzg
            $('.read-more-hide').on('click', function (e) {
                var p = $(this).parent('.read-more-content');
                p.addClass('hide_content');
                p.prev('.read-more-show').removeClass('hide_content'); // Hide only the preceding "Read More"
                e.preventDefault();
            });
        </script>
    @endpush()
</x-guest-layout>

