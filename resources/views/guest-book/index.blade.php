
<x-guest-layout>
    @push('stylesheets')
        <style>

            .card-01{
                background-image: url("/images/guest-book/quotes.svg") !important;
                background-repeat: no-repeat;
                background-position: top left;
                background-size: 55px;
                background-position-x: 9.5%;
                background-position-y: 4%;
            }

            .card-01{
                border-top-left-radius: 12px;
                border-top-right-radius: 12px;
            }
            .card-01 .bg-card-body{
                background-color: #E8604C;
            }
            .card-01 .card-body {
                position: relative;
                padding-top: 40px;
                border-bottom-left-radius: 12px;
                border-bottom-right-radius: 12px;
            }
            .card-01 .badge-box img{
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
                width: auto!important;
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
                background: url("https://images.pexels.com/photos/195825/pexels-photo-195825.jpeg?h=350&auto=compress&cs=tinysrgb")
                no-repeat;
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
    @endpush

    @include('partials.sub-page-hero-section', ['title' => 'Guest Book'])

    <section class=" bg-light pt-55">
        <div class="bg-guest shadow-1-strong rounded text-center  d-flex justify-content-center align-items-center">
            <h1 class="text-primary font-vintage mb-0">Guest Book</h1>
        </div>
        <h1 class="pt-2 text-center poppins-bold">Read guest reviews here</h1>

        <div class="container mt-80 pb-5">
            <div class="row guest-row">

                @if(isset($data))
                    @foreach($data as $dt)
                        @if($loop->iteration % 2 == 0)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card card-01 shadow-lg my-4 my-md-0" style="min-height: 380px">
                                    <div class="guest-card-description pt-75 pb-4 px-5" style="min-height: 270px;">
                                        <h4>{{$dt->title }}</h4>
                                        {!! $dt->content     !!}</div>
                                    <div class="card-body   bg-card-body pb-5">
                                        <span class="badge-box py-4">
                                            <img src="{{$dt->getFileUrl('image')}}"
                                                 alt="{{ $dt->title ?? '' }}"
                                                 class="rounded-circle" width="60"/>
                                        </span>
                                        <h4 class="card-title text-center mb-1 mt-3 text-white fw-normal">{{$dt->name}}</h4>
                                        <p class="card-text text-center text-white-light fw-light">{{date('Y-m-d',strtotime($dt->created_at))}}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card card-01 shadow-lg" style="min-height: 380px">
                                    <div class="guest-card-description pt-75 pb-4 px-5" style="min-height: 270px;">
                                        <h4>{{$dt->title }}</h4>
                                        {!! $dt->content     !!}
                            </div>
                            <div class="card-body pb-5">
                        <span class="badge-box py-4">
                            <img src="{{$dt->getFileUrl('image')}}"
                                         alt="{{ $dt->name ?? '' }}"
                                         class="rounded-circle" width="60"/>
                                        </span>
                                        <h4 class="card-title text-center mt-3 mb-1 text-white fw-normal">{{$dt->name}}</h4>
                                        <p class="card-text text-center text-white-70 fw-light">{{date('Y-m-d',strtotime($dt->created_at))}}</p>
                                    </div>
                                </div>
                            </div> -->
                        @endif
                    @endforeach
                @endif

            </div>
        </div>
    </section>

</x-guest-layout>

