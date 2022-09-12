<x-guest-layout>
    @push('stylesheets')

        <style>
            .w-60-h-60{
                width: 64px !important;
                height: 66px !important;
                object-fit: cover !important;
            }
            .social-feeds .card-text{
                font-size: 12px !important;
            }
        </style>

    @endpush

    <header>
        <div class="position-relative d-flex align-items-center hero-image">
            <div class="container text-center text-md-start">
                <p class="mb-1 display-4 text-primary font-vintage">Keep track of when</p>
                <h1 class="hero-text py-4 poppins-bold">Your Vacation <br> Home is in Use</h1>
                <a href="{{route('register')}}" class="btn btn-lg btn-signup btn-primary shadow-lg my-2">GET STARTED</a>
                <div class="position-relative mt-5 pt-2 pt-lg-5 max-width">
                    <img src="/images/images-home/rounded-arrow.svg"
                         class="img-fluid position-absolute end-0 mt-n100 d-none d-lg-block" alt="arrow" />
                    <i class="display-4 font-poppins">Just Over<span class="text-primary"> $3 </span><span class="fs-6 color-secondary">per
                                month</span></i>
                </div>

            </div>
        </div>
    </header>
    <div class="bg-lightGrey">
        <section>
            <div class="container">
                <div class="row align-items-center padding-y">
                    <div class="col-lg-5 col-xl-4 text-center text-lg-start">
                        <!-- Jumbotron -->
                        <div class="py-4 text-center  rounded mb-0 text-white bg-process-img">
                            <h1 class="h2 text-center text-lg-start text-primary font-vintage mb-0">Find Your Vacation House
                            </h1>
                        </div>
                        <div>
                            <h1 class="poppins-bold pt-2">What is the Vacation Calendar?</h1>
                            <p class="pe-0 pe-lg-4 lh-lg text-light-secondary">This is the main view of online calendar on
                                TheVacationCalendar.com which allows everyone to see when the vacation home is in
                                use.
                                When a vacation is scheduled the user can set the online calendar to show that the
                                house is occupied.
                                Users can choose to use color to enhance the calendar or to signify special meaning,
                                such as "would like to trade this vacation" for different time. </p>
                            <a href="{{route('register')}}"
                               class="btn btn-lg btn-signup btn-primary shadow-lg mt-3">SIGN UP</a>
                        </div>
                    </div>
                    <div class="col-lg-3 mt-4 mt-lg-0 offset-lg-1 offset-xl-2 d-none d-lg-block">
                        <div class="text-center d-none d-lg-block">
                            <img src="/images/images-home/left-arrow.svg" class="img-fluid ms-auto mb-3" />
                        </div>
                        <div
                            class="card  border-0 rounded-3 bg-card-1 me-0 me-lg-3 me-xl-5 margin-top text-center text-lg-start">
                            <div
                                class="d-block text-center d-lg-flex justify-content-center justify-content-lg-start align-items-lg-center h-100 position-absolute w-100">
                                <div class="bg-white rounded-pill p-4 rounded-icon">
                                    <img src="/images/images-home/card-img-1.svg" class="img-fluid" alt="calculator" />
                                </div>
                            </div>
                            <div class="card-body pt-5 padding-top">
                                <h3 class="card-title">Organize your vacation home schedule</h3>
                                <p class="card-text">Spend more time enjoying your getaway home.</p>

                            </div>
                        </div>
                        <div class="text-center d-none d-lg-block">
                            <img src="/images/images-home/right-arrow.svg" class="img-fluid me-auto my-3" />
                        </div>
                    </div>
                    <div class="col-lg-3 d-none d-lg-block">
                        <div class="card  border-0 my-4 my-lg-0 rounded-3 bg-card-2 margin-y text-center text-lg-start">
                            <div
                                class="d-block  d-lg-flex text-center justify-content-center justify-content-lg-start w-100 align-items-center h-100 position-absolute">
                                <div class="bg-white rounded-pill p-4 rounded-icon">
                                    <img src="/images/images-home/card-img-2.svg" class="img-fluid" alt="message" />
                                </div>
                            </div>
                            <div class="card-body pt-5 padding-top">
                                <h3 class="card-title">Share information on the house bulletin board and house blog</h3>
                                <p class="card-text">Direct all of your guests to a single location that has all of the
                                    house
                                    details.</p>

                            </div>
                        </div>
                        <div class="card  border-0 mt-3 mt-md-5 rounded-3 bg-card-3 text-center text-lg-start">
                            <div
                                class="d-block d-lg-flex text-center justify-content-center justify-content-lg-start w-100 align-items-center h-100 position-absolute">
                                <div class="bg-white rounded-pill p-4 rounded-icon">
                                    <img src="/images/images-home/card-img-3.svg" class="img-fluid" alt="users" />
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
        <section class="d-block d-lg-none mobile-cards">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <div
                            class="card  border-0 rounded-3 bg-card-1 me-0 me-lg-3 me-xl-5 margin-top text-center text-lg-start">
                            <div
                                class="d-block text-center d-lg-flex justify-content-center justify-content-lg-start align-items-lg-center h-100 position-absolute w-100">
                                <div class="bg-white rounded-pill p-4 rounded-icon">
                                    <img src="/images/images-home/card-img-1.svg" class="img-fluid" alt="calculator" />
                                </div>
                            </div>
                            <div class="card-body pt-5 padding-top">
                                <h3 class="card-title">Organize your vacation home schedule</h3>
                                <p class="card-text text-light-secondary">Spend more time enjoying your getaway home</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 margin-mobile-card">
                        <div class="card  border-0 rounded-3 bg-card-2 margin-y text-center text-lg-start">
                            <div
                                class="d-block  d-lg-flex text-center justify-content-center justify-content-lg-start w-100 align-items-center h-100 position-absolute">
                                <div class="bg-white rounded-pill p-4 rounded-icon">
                                    <img src="/images/images-home/card-img-2.svg" class="img-fluid" alt="message" />
                                </div>
                            </div>
                            <div class="card-body pt-5 padding-top">
                                <h3 class="card-title">Share information on the house bulletin board and house blog</h3>
                                <p class="card-text text-light-secondary">Direct all of your guests to a single location that has all of the
                                    house
                                    details.</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="card  border-0 mt-0 mt-lg-5 rounded-3 bg-card-3 text-center text-lg-start">
                            <div
                                class="d-block d-lg-flex text-center justify-content-center justify-content-lg-start w-100 align-items-center h-100 position-absolute">
                                <div class="bg-white rounded-pill p-4 rounded-icon">
                                    <img src="/images/images-home/card-img-3.svg" class="img-fluid" alt="users" />
                                </div>
                            </div>
                            <div class="card-body pt-5 padding-top">
                                <h3 class="card-title">Let friends and family see when they can visit</h3>
                                <p class="card-text text-light-secondary">Allows visitors to see when the house is going to be free.</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{--   cards-section   --}}

        <section class="section-min-h bg-cards-section">
            <div class="container pt-5 pt-md-5 pt-lg-3">
                <div
                    class="features-img-2  text-center shadow-1-strong rounded  text-white d-flex justify-content-center align-items-center">
                    <h1 class="text-primary font-vintage mb-0 pt-2">Find Your Vacation House</h1>
                </div>
                <h1 class="text-center text-white mt-3">Vacation Calendar makes it simple</h1>
                <div class="row py-5 feature-cards">
                    <div class="col-lg-4">
                        <!-- Card -->
                        <div class="card p-2 text-center text-lg-start">
                            <img class="card-img-top" src="/images/images-home/bulletin-image-card.svg"
                                 alt="Card image cap" />
                            <div class="card-body">
                                <h3 class="card-title">House Bulletin Board</h3>
                                <p class="card-text text-light-secondary">The House Bulletin Board is the perfect solution to that all
                                    important piece paper that is always getting misplaced. This is a great place for
                                    contact information, house instructions, rules, cleaning services.</p>
                                <a href="{{ route('guest.help') }}" class="btn btn-lg w-100 btn-primary text-white">Learn More<i
                                        class="fa-solid fa-arrow-right ps-2"></i></a>
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>
                    <div class="col-lg-4 my-4 my-lg-0">
                        <!-- Card -->
                        <div class="card p-2 text-center text-lg-start">
                            <img class="card-img-top" src="/images/images-home/managing-vacations-card.svg"
                                 alt="Card image cap" />
                            <div class="card-body">
                                <h3 class="card-title">Managing Vacations</h3>
                                <p class="card-text text-light-secondary">So this is the money shot of TheVacationCalendar.com. Using this
                                    simple screen anyone who is authorized to schedule a vacation can do so. The site
                                    checks that there are no conflicts on the online calendar <span
                                        class="text-content"> and prevents you from ever having multiple parties showing
                                        up at your vacation home at the same time.</span></p>
                                <a href="{{ route('guest.help') }}" class="btn btn-lg w-100 btn-primary text-white">Learn More <i
                                        class="fa-solid fa-arrow-right ps-2"></i></a>
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>
                    <div class="col-lg-4">
                        <!-- Card -->
                        <div class="card p-2 text-center text-lg-start">
                            <img class="card-img-top" src="/images/images-home/house-blog-card.svg" alt="Card image cap" />
                            <div class="card-body">
                                <h3 class="card-title">House Blog</h3>
                                <p class="card-text text-light-secondary">How have you ever lived without a vacation home blog?!?! Since the House Bulletin Board is only updated by the administrator of the house,
                                    the House Blog gives everyone a place to share thoughts, provide updates,<span
                                        class="text-content"> and generally make fun of
                                      each other.</span></p>
                                <a href="{{ route('guest.help') }}" class="btn btn-lg w-100 btn-primary text-white">Learn More <i
                                        class="fa-solid fa-arrow-right ps-2"></i></a>
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>
                </div>
            </div>
        </section>
        {{-- section 3   --}}

        <section class=" py-2 py-sm-5 bg-white">
            <div class="container mt-2 mt-sm-0">
                <div class="row align-items-center min-height">

                    <div class="col-lg-5">
                        <div class="py-4 text-center shadow-1-strong rounded mb-0 text-white bg-process-img text-margin" />
                        <h1 class="mb-0 h2 text-center text-lg-start font-vintage text-primary">Find Your Vacation House
                        </h1>
                    </div>
                    <div>
                        {{--          nav tabs           --}}
                        <div class="images-nav-tabs  mt-3 mt-md-2 mt-lg-1 row"><!-- tab content -->
                            <div class="col-12 order-2 order-lg-1 tab-content bg-waves min-h-200 text-center text-lg-start" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                     aria-labelledby="home-tab">
                                    <h1 class="poppins-bold">House Blog</h1>
                                    <p class="lh-lg text-light-secondary">How have you ever lived without a vacation home blog?!?! Since the
                                        House Bulletin Board is only updated by the administrator of the house, the
                                        House Blog gives everyone a place to share thoughts, provide updates, and
                                        generally make fun of each other.</p>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <h1 class="poppins-bold">House Photo Album</h1>
                                    <p class="lh-lg mb-1 text-light-secondary">This is another favorite for many of the site's users. Since people
                                        were getting more and more use out of the vacation homes thanks to the online
                                        calendar system in TheVacationCalendar.com, we needed to provide a way to
                                        memorialize the great times you are having.  <a class="moreless-button text-primary ms-2 text-decoration-underline d-inline-block d-md-none">Read more</a>
                                        <span class="moretext"> So we added a new photo album. It is
                                        pretty simple for the first iteration, just add photos and allow anyone to
                                        comment. As always, the Administrator has the ability to remove any photos or
                                            comments that are inappropriate.</span></p>

                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <h1 class="poppins-bold">Account Management</h1>
                                    <p class="lh-lg text-light-secondary">This is your basic profile page that allows the administrator to
                                        update passwords, change the site picture, and {cough}{cough} cancel the
                                        subscription.</p>
                                </div>
                                <div class="tab-pane fade" id="shopping" role="tabpanel" aria-labelledby="shopping-tab">
                                    <h1 class="poppins-bold">User Management</h1>
                                    <p class="lh-lg text-light-secondary">This simple screen lets the Administrator of the house control the
                                        users. If you forget your password you can either use the automated password
                                        reset functionality or you can call the Administrator and he/she can update your
                                        account in a few clicks using this screen.</p>
                                </div>
                            </div>
                            <!-- tab content ends -->
                            <ul class="col-12 order-1 order-lg-2 mb-4 mb-lg-0 nav nav-tabs border-bottom-0 d-flex justify-content-center justify-content-lg-start mt-2 padding-0"
                                id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#home" role="tab" aria-controls="home" aria-selected="true">
                                        <img src="{{asset('/images/images-home/envelope.svg')}}" class="img-fluid" />
                                        <p class="mb-0 pt-2 font-poppins">House Blog</p>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#profile" role="tab" aria-controls="profile"
                                            aria-selected="false">
                                        <img src="{{asset('/images/images-home/card.svg')}}" class="img-fluid" />
                                        <p class="mb-0 pt-2 font-poppins">House Photo Album</p>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#contact" role="tab" aria-controls="contact"
                                            aria-selected="true">
                                        <img src="{{asset('/images/images-home/user.svg')}}" class="img-fluid" />
                                        <p class="mb-0 pt-2 font-poppins">Account Management</p>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="shopping-tab" data-bs-toggle="tab"
                                            data-bs-target="#shopping" role="tab" aria-controls="shopping"
                                            aria-selected="true">
                                        <img src="{{asset('/images/images-home/user-2.svg')}}" class="img-fluid" />
                                        <p class="mb-0 pt-2 font-poppins">User Management</p>
                                    </button>
                                </li>

                            </ul>
                        </div>
                        {{--           nav tabs end             --}}
                    </div>
                </div>

                <div class="col-lg-6 col-xl-5 offset-lg-1 offset-xl-2 text-center">
                    <div id="big-image">
                        <img src="{{asset('/images/images-home/house-blog.png')}}" class="img-fluid" alt="tab-image" />
                        <img src="{{asset('/images/images-home/photo-album.png')}}" class="img-fluid" alt="tab-image" />
                        <img src="{{asset('/images/images-home/manage-account.png')}}" class="img-fluid" alt="tab-image" />
                        <img src="{{asset('/images/images-home/owner-administration.png')}}" class="img-fluid" alt="tab-image" />
                    </div>


                </div>
            </div>



        </section>
        <section class="p-2 p-lg-5 bg-social-feed social-feeds" style="border-bottom:2px solid #FFFFFF27">
            <div class="container d-none d-lg-block">
                <div
                    class="mt-70 mb-2 text-center shadow-1-strong rounded  text-white social-img d-flex justify-content-center align-items-center">
                    <h1 class="text-primary font-vintage pt-2 mb-0">Find Your Vacation House</h1>
                </div>
                <h1 class="text-center text-white">See our social media feed.</h1>

                <div class="d-flex justify-content-between margin-tb ">
                    <div class="w-100 m-2">
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/1-1.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/1-2.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/1-3.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->

                    </div>
                    <div class="w-100 m-2">
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/2-1.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/2-2.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/2-3.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->

                    </div>
                    <div class="w-100 m-2">
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/3-1.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/3-2.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/4-1.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->

                    </div>
                    <div class="w-100 m-2">
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/4-1.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/4-2.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/4-4.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->

                    </div>
                    <div class="w-100 m-2">
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/5-1.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/5-2.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/5-3.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->

                    </div>
                </div>

            </div>

            <div class="container d-block d-lg-none">
                <div
                    class="mt-70 mb-2 text-center shadow-1-strong rounded  text-white social-img d-flex justify-content-center align-items-center">
                    <h1 class="text-primary font-vintage pt-2 mb-0">Find Your Vacation House</h1>
                </div>
                <h1 class="text-center text-white">See our social media feed.</h1>

                <div class="row margin-tb ">

                    <div class="col-12 col-md-6">
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/1-1.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/1-2.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/1-3.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->

                    </div>

                    <div class="col-12 col-md-6">
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/1-1.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/1-2.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/1-3.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->

                    </div>

                    <div class="col-12 col-md-6">
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/3-1.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/3-2.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/4-1.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->

                    </div>

                    <div class="col-12 col-md-6">
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/4-1.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/4-2.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->
                        <!-- Card -->
                        <div class="card border-0 mb-3">
                            <div class="card-pinned">
                                <img class="card-img-top" src="{{asset('images/news-feed/4-4.png')}}" alt="Image Description"/>

                                <div class="card-pinned-bottom-start">
                                    <img class="img-fluid rounded-2 border border-3 border-white w-60-h-60"
                                         src="{{asset('images/images-home/smiling-girl.jpg')}}" alt="Image Description" width="60" height="50"/>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mt-2"><a class="text-dark" href="#">Objects and dimensions</a></h3>
                                <p class="card-text">Learn the simplest way to select the object and change dimensions.</p>
                            </div>
                        </div>
                        <!-- End Card -->

                    </div>

                    <div class="col-12 col-md-6">

                    </div>

                </div>



        </section>
    </div>
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
        <script>
            $("#toggle").on("click", function () {
                $(".text-content").toggleClass("show");
            });
        </script>
        <script>
            $('.moreless-button').click(function() {
                $('.moretext').slideToggle();
                if ($('.moreless-button').text() == "Read more") {
                    $(this).text("Read less")
                } else {
                    $(this).text("Read more")
                }
            });
        </script>
    @endpush
</x-guest-layout>
