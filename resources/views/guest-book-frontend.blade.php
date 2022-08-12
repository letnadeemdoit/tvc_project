
<x-guest-layout>
    @push('stylesheets')
        <style>
            .card-01{
                background-image: url("/images/guest-book/quotes.svg") !important;
                background-repeat: no-repeat;
                background-position: top left;
                background-size: auto;
                background-position-x: 9%;
            }
            .card-01{
                border-top-left-radius: 17px;
                border-top-right-radius: 17px;
            }

            .card-01 .card-body {
                position: relative;
                padding-top: 40px;
                border-bottom-left-radius: 17px;
                border-bottom-right-radius: 17px;
            }
            .card-01 .badge-box {
                position: absolute;
                top: -50px;
                left: 50%;
                width: 100px;
                height: 100px;
                margin-left: -50px;
                text-align: center;
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

    <section class=" bg-light pt-5">
        <div class="bg-guest shadow-1-strong rounded text-center  d-flex justify-content-center align-items-center">
            <h1 class="text-primary font-vintage mb-0">Guest Book</h1>
        </div>
        <h1 class="pt-2 text-center poppins-bold">Read guest reviews here</h1>

        <div class="container mt-80 pb-5">
            <div class="row guest-row">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card card-01 shadow-lg">
                        <p class="guest-card-description pt-100 pb-4 px-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Turpis nec viverra a pellentesque amet. Morbi eget cras donec at aliquam turpis enim. </p>
                        <div class="card-body bg-primary pb-3 pb-lg-5">
                            <span class="badge-box py-4"><img src="{{asset('/images/guest-book/girl.svg')}}" class="rounded-circle border-2 border-light" width="60"> </span>
                            <h4 class="card-title text-center mt-3 mb-1 text-white fw-normal">Jessika Albert</h4>
                            <p class="card-text font-vintage text-center text-white fw-light">Guest Review</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card card-01 shadow-lg my-4 my-md-0">
                        <p class="guest-card-description pt-100 pb-4 px-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Turpis nec viverra a pellentesque amet. Morbi eget cras donec at aliquam turpis enim. </p>
                        <div class="card-body bg-dark-blue pb-3 pb-lg-5">
                            <span class="badge-box py-4"><img src="{{asset('/images/blog-images/rounded-image.png')}}" class="rounded-circle" width="60"> </span>
                            <h4 class="card-title text-center mb-1 mt-3 text-white fw-normal">Jessika Albert</h4>
                            <p class="card-text font-vintage text-center text-white fw-light">Guest Review</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card card-01 shadow-lg">
                        <p class="guest-card-description pt-100 pb-4 px-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Turpis nec viverra a pellentesque amet. Morbi eget cras donec at aliquam turpis enim. </p>
                        <div class="card-body bg-primary pb-3 pb-lg-5">
                            <span class="badge-box py-4"><img src="{{asset('/images/blog-images/rounded-image.png')}}" class="rounded-circle" width="60"> </span>
                            <h4 class="card-title text-center mt-3 mb-1 text-white fw-normal">Jessika Albert</h4>
                            <p class="card-text font-vintage text-center text-white fw-light">Guest Review</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card card-01 shadow-lg">
                        <p class="guest-card-description pt-100 pb-4 px-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Turpis nec viverra a pellentesque amet. Morbi eget cras donec at aliquam turpis enim. </p>
                        <div class="card-body bg-primary pb-3 pb-lg-5">
                            <span class="badge-box py-4"><img src="{{asset('/images/blog-images/rounded-image.png')}}" class="rounded-circle" width="60"> </span>
                            <h4 class="card-title text-center mt-3 mb-1 text-white fw-normal">Jessika Albert</h4>
                            <p class="card-text font-vintage text-center text-white fw-light">Guest Review</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card card-01 shadow-lg my-4 my-md-0">
                        <p class="guest-card-description pt-100 pb-4 px-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Turpis nec viverra a pellentesque amet. Morbi eget cras donec at aliquam turpis enim. </p>
                        <div class="card-body bg-dark-blue pb-3 pb-lg-5">
                            <span class="badge-box py-4"><img src="/images/blog-images/rounded-image.png" class="rounded-circle" width="60"> </span>
                            <h4 class="card-title text-center mb-1 mt-3 text-white fw-normal">Jessika Albert</h4>
                            <p class="card-text font-vintage text-center text-white fw-light">Guest Review</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card card-01 shadow-lg">
                        <p class="guest-card-description pt-100 pb-4 px-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Turpis nec viverra a pellentesque amet. Morbi eget cras donec at aliquam turpis enim. </p>
                        <div class="card-body bg-primary pb-3 pb-lg-5">
                            <span class="badge-box py-4"><img src="/images/blog-images/rounded-image.png" class="rounded-circle" width="60"> </span>
                            <h4 class="card-title text-center mt-3 mb-1 text-white fw-normal">Jessika Albert</h4>
                            <p class="card-text font-vintage text-center text-white fw-light">Guest Review</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-guest-layout>

