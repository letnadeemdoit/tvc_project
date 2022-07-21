<x-guest-layout>
    @push('stylesheets')

    @endpush

    <header>
        <div class="position-relative d-flex align-items-center" style=" background-image: url('/images/images-home/hero-image.png'); background-size: cover;background-position: center;background-repeat: no-repeat;height: 700px;">

            <div class="container">

                <p class="mb-1 display-3 text-primary font-vintage">Keep Track of when</p>
                <h1 class="h1 py-4">Your Vacation <br> Home is in Use</h1>
                <button type="button" class="btn btn-lg btn-signup btn-primary shadow-lg my-4">SIGN UP</button>
                <div class="position-relative mt-3 max-width">
                    <img src="/images/images-home/rounded-arrow.png"
                         class="img-fluid position-absolute end-0 mt-n100 d-none d-lg-block" alt="arrow"/>
                    <p class="display-4 font-poppins text-primary">Only $20 <span class="fs-6">per year</span></p>
                </div>

            </div>
        </div>
    </header>

    <section class="my-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 text-center text-lg-start">
                    <!-- Jumbotron -->
                    <div
                        class="py-4 text-center  rounded mb-5 text-white bg-process-img mb-0">
                        <h1 class="h2 text-start text-primary font-vintage">Find Your Vacation House</h1>
                    </div>
                    <div class="pt-3">
                        <h4>What is the Vacation Calendar?</h4>
                        <p class="pe-0 pe-lg-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tortor felis pellentesque velit, et
                            sed pharetra. Nunc, faucibus orci malesuada id sit fusce mi, nec. Blandit sed sit neque
                            faucibus morbi feugiat quis. Odio egestas dictum lorem fermentum a eget lacus. Vulputate
                            morbi curabitur adipiscing facilisi. Convallis pulvinar pharetra suscipit eget blandit
                            nisl. </p>
                        <button type="button" class="btn btn-lg btn-signup btn-primary shadow-lg mt-3">SIGN UP</button>
                    </div>
                </div>
                <div class="col-lg-3 mt-4 mt-lg-0 offset-lg-1">
                    <div class="text-center d-none d-lg-block">
                        <img src="/images/images-home/left-arrow.png" class="img-fluid ms-auto mb-3"/>
                    </div>
                    <div class="card  border-0 rounded-3 bg-card-1 me-3">
                        <div class="d-block text-center d-lg-flex justify-content-center justify-content-lg-start align-items-lg-center h-100 position-absolute w-100">
                            <div class="bg-white rounded-pill p-4 rounded-icon">
                                <img src="/images/images-home/card-img-1.png" class="img-fluid" alt="calculator" />
                            </div>
                        </div>
                        <div class="card-body pt-5 padding-top">
                            <h3 class="card-title">Organize your vacation home schedule</h3>
                            <p class="card-text">Spend more time enjoying your getaway home</p>

                        </div>
                    </div>
                    <div class="text-center d-none d-lg-block">
                        <img src="/images/images-home/right-arrow.png" class="img-fluid me-auto mb-3"/>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card  border-0 my-4 my-lg-0 rounded-3 bg-card-2">
                        <div class="d-block  d-lg-flex text-center justify-content-center justify-content-lg-start w-100 align-items-center h-100 position-absolute">
                            <div class="bg-white rounded-pill p-4 rounded-icon">
                                <img src="/images/images-home/card-img-2.png" class="img-fluid" alt="message" />
                            </div>
                        </div>
                        <div class="card-body pt-5 padding-top">
                            <h3 class="card-title">Share information on the house bulletin board and house blog</h3>
                            <p class="card-text">Direct all of your guests to a single location that has all of the house
                                details.</p>

                        </div>
                    </div>
                    <div class="card  border-0 mt-2 rounded-3 bg-card-3">
                        <div class="d-block d-lg-flex text-center justify-content-center justify-content-lg-start w-100 align-items-center h-100 position-absolute">
                            <div class="bg-white rounded-pill p-4 rounded-icon">
                                <img src="/images/images-home/card-img-3.png" class="img-fluid" alt="users" />
                            </div>
                        </div>
                        <div class="card-body pt-5 padding-top">
                            <h3 class="card-title">Let friends and family see when they can visit</h3>
                            <p class="card-text">Allows visitors to see when the house is going to be free.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--   cards-section   --}}

    <section class="py-5 bg-cards-section">
        <div class="container py-5">
            <div
                class="features-img  text-center shadow-1-strong rounded  text-white d-flex justify-content-center">
                <h1 class="text-primary font-vintage mb-0">Find Your Vacation House</h1>
            </div>
            <h3 class="text-center text-white mt-2">Vacation Calendar makes it simple</h3>
            <div class="row py-5">
                <div class="col-lg-4">
                    <!-- Card -->
                    <div class="card p-2">
                        <img class="card-img-top" src="/images/images-home/bulletin-image.png" alt="Card image cap" />
                        <div class="card-body">
                            <h3 class="card-title">Card title</h3>
                            <p class="card-text">This is a longer card with supporting text below as a natural
                                lead-in to additional content. This content is a little bit longer.</p>
                            <button class="btn btn-lg w-100 btn-primary text-white">Learn More</button>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <div class="col-lg-4 my-4 my-lg-0">
                    <!-- Card -->
                    <div class="card p-2">
                        <img class="card-img-top" src="/images/images-home/vacations-image.png" alt="Card image cap" />
                        <div class="card-body">
                            <h3 class="card-title">Card title</h3>
                            <p class="card-text">This is a longer card with supporting text below as a natural
                                lead-in to additional content. This content is a little bit longer.</p>
                            <button class="btn btn-lg w-100 btn-primary text-white">Learn More</button>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <div class="col-lg-4">
                    <!-- Card -->
                    <div class="card p-2">
                        <img class="card-img-top" src="/images/images-home/blog-image.png" alt="Card image cap" />
                        <div class="card-body">
                            <h3 class="card-title">Card title</h3>
                            <p class="card-text">This is a longer card with supporting text below as a natural
                                lead-in to additional content. This content is a little bit longer.</p>
                            <button class="btn btn-lg w-100 btn-primary text-white">Learn More</button>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
            </div>
        </div>
    </section>
    {{-- section 3   --}}

    <section class=" my-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div
                        class="py-4 text-center shadow-1-strong rounded mb-5 text-white bg-process-img" />
                    <h1 class="mb-0 h2 text-start font-vintage text-primary">Find Your Vacation House</h1>
                </div>
                <div class="pt-3">
                    <h4>What is the Vacation Calendar?</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tortor felis pellentesque velit, et
                        sed pharetra. Nunc, faucibus orci malesuada id sit fusce mi, nec. Blandit sed sit neque
                        faucibus morbi feugiat quis. Odio egestas dictum lorem fermentum a eget lacus. Vulputate
                        morbi curabitur adipiscing facilisi. Convallis pulvinar pharetra suscipit eget blandit
                        nisl. </p>
                    {{--          nav tabs           --}}
                    <div class="images-nav-tabs">
                        <ul class="nav nav-tabs border-bottom-0 d-flex justify-content-center justify-content-lg-start" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                    <img src="{{asset('/images/images-home/envelope.png')}}" width="30px" class="d-none d-lg-block" />
                                    <p class="mb-0 pt-2">House Blog</p>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                    <img src="{{asset('/images/images-home/card.png')}}" width="30px" class="d-none d-lg-block" />
                                    <p class="mb-0 pt-2">House Photo Album</p>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="true">
                                    <img src="{{asset('/images/images-home/user.png')}}" width="30px" class="d-none d-lg-block" />
                                    <p class="mb-0 pt-2">Account Management</p>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="shopping-tab" data-bs-toggle="tab" data-bs-target="#shopping" type="button" role="tab" aria-controls="shopping" aria-selected="true">
                                    <img src="{{asset('/images/images-home/user-2.png')}}" width="30px" class="d-none d-lg-block" />
                                    <p class="mb-0 pt-2">User Management</p>
                                </button>
                            </li>

                        </ul>
                    </div>
                    {{--           nav tabs end             --}}
                </div>
            </div>
            <div class="col-lg-6 offset-lg-1">
                <div id="big-image">
                    <img src="{{asset('/images/images-home/tab-image-1.png')}}" class="img-fluid" alt="tab-image" />
                    <img src="{{asset('/images/images-home/blog-image.png')}}" class="img-fluid" alt="tab-image" />
                    <img src="{{asset('/images/images-home/bulletin-image.png')}}" class="img-fluid" alt="tab-image" />
                    <img src="{{asset('/images/images-home/hero-image.png')}}" class="img-fluid" alt="tab-image" />
                </div>
            </div>
        </div>
    </section>
    <section class="p-2 p-lg-5 bg-social-feed">
        <div class="container">
            <div
                class=" mt-5 mb-2 text-center shadow-1-strong rounded  text-white social-img">
                <h1 class="text-primary font-vintage">Find your vacation house</h1>
            </div>
            <h3 class="text-center text-white">Vacation Calendar makes it simple</h3>

            <div class="row mt-4">
                <div class="col-md-4 col-lg-3">
                    @include('partials.social-media-feed-card')
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            $(function () {
                $("#big-image img:eq(0)").nextAll().hide();
                $(".images-nav-tabs .nav-item").click(function (e) {
                    var index = $(this).index();
                    $("#big-image img").eq(index).show().siblings().hide();
                });
            });
        </script>
    @endpush
</x-guest-layout>

