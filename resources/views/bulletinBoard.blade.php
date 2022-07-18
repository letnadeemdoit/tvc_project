<x-guest-layout>
    @push('stylesheets')

    @endpush

    <div class="bulletin-image">
        <div class="container h-100">
            <div class="row align-items-center h-100">
                <div class="col-12 text-center">
                    <h2 class="text-white fs-50 font-jost">Bulletin Board</h2>
                </div>
            </div>
        </div>
    </div>
    <section class="bg-waves bg-light">
        <div class="container  pt-5">
            <div class="row text-center">
                <div class="features-img shadow-1-strong rounded  text-white d-flex justify-content-center">
                    <h1 class="text-primary font-jost">Find Your Vacation House</h1>
                </div>
                <h3 class="pt-2">Choose your Category</h3>
            </div>
            <div class="row my-5  category-cards">
                <div class="col-12">
                    <ul class="nav nav-tabs border-bottom-0" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                    aria-selected="true">
                                <img src="/images/bulletin-images/clipboard.png" width="30px" />
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile" aria-selected="true">
                                <img src="/images/bulletin-images/fastfood.png" width="30px" />
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                    type="button" role="tab" aria-controls="contact" aria-selected="true">
                                <img src="/images/bulletin-images/volume.png" width="30px" />
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="shopping-tab" data-bs-toggle="tab"
                                    data-bs-target="#shopping" type="button" role="tab" aria-controls="shopping"
                                    aria-selected="true">
                                <img src="/images/bulletin-images/clock-img.png" width="30px" />
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="clipboard-tab" data-bs-toggle="tab"
                                    data-bs-target="#clipboard" type="button" role="tab" aria-controls="clipboard"
                                    aria-selected="true">
                                <img src="/images/bulletin-images/shopping-bag.png" width="30px" />
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="gallery-tab" data-bs-toggle="tab"
                                    data-bs-target="#gallery" type="button" role="tab" aria-controls="gallery"
                                    aria-selected="true">
                                <img src="/images/bulletin-images/calculator.png" width="30px" />
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="gallery-tab" data-bs-toggle="tab"
                                    data-bs-target="#gallery" type="button" role="tab" aria-controls="gallery"
                                    aria-selected="true">
                                <img src="/images/bulletin-images/Photo.png" width="30px" />
                            </button>
                        </li>
                    </ul>
                    <!-- dots img -->

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <section class="text-end">
                                <img src="/images/bulletin-images/Combined Shape.png" class="img-fluid bg-dots-orange" />
                            </section>
                            <div class="d-block d-xl-flex  justify-content-center">
                                <div class="d-flex flex-column">
                                    <div class="card">
                                        <img src="/images/bulletin-images/house-1.png" class="card-img-top" alt="..." />
                                        <div class="card-body">
                                            <h3 class="card-title">Beach House</h3>
                                            <div class="card-text">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,Lorem ipsum dolor sit amet, consectetur adipiscing elit,Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card -->
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <img src="/images/bulletin-images/round-rule.png" class="img-fluid" />
                                                <h3 class="card-title ps-3">House Rules</h3>
                                            </div>
                                            <div class="card-text">
                                                <ul class="pt-4">
                                                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                                    <li>Lobortis eros diam dolor in natoque magna commodo.</li>
                                                    <li>Lobortis eros diam dolor in natoque magna commodo.</li>
                                                    <li>Lobortis eros diam dolor in natoque magna commodo.</li>
                                                    <li>Lobortis eros diam dolor in natoque magna commodo. </li>
                                                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                                    <li>Lobortis eros diam dolor in natoque magna commodo.</li>
                                                    <li>Lobortis eros diam dolor in natoque magna commodo.</li>
                                                    <li>Lobortis eros diam dolor in natoque magna commodo.</li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Card -->
                                    <div class="card">
                                        <img src="/images/bulletin-images/house-3.png" class="card-img-top" alt="..." />
                                        <div class="card-body">
                                            <h3 class="card-title">Timings</h3>
                                            <div class="card-text pt-3">
                                                <div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h5><span>  <img src="/images/bulletin-images/clock.png" class="img-fluid" /></span> Mon-Thu</h5>
                                                        <h5>9:00 AM- 10:00 PM</h5>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center pt-3">
                                                        <h5 class="mb-0"><img src="/images/bulletin-images/clock.png"> Fri-Sat</h5>
                                                        <h5 class="mb-0">11:00 AM- 10:00 PM</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!--  -->
                                <div class="d-flex flex-column mx-0 mx-lg-5">
                                    <div class="card">
                                        <img src="/images/bulletin-images/house-4.png" class="card-img-top" alt="..." />
                                        <div class="card-body">
                                            <h3 class="card-title">Beach House</h3>
                                            <div class="card-text pt-3">
                                                <ul>
                                                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                                    <li>Lobortis eros diam dolor in natoque magna commodo.</li>
                                                    <li>Lobortis eros diam dolor in natoque magna commodo.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <img src="/images/bulletin-images/house-5.png" class="card-img-top" alt="..." />
                                        <div class="card-body">
                                            <h3 class="card-title">Daily Belvana Trainer</h3>
                                            <div class="card-text pt-3">
                                                <div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h5><span>  <img src="/images/bulletin-images/clock.png" class="img-fluid" /></span> Mon-Thu</h5>
                                                        <h5>9:00 AM- 10:00 PM</h5>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center pt-3">
                                                        <h5 class="mb-0"><img src="/images/bulletin-images/clock.png"> Fri-Sat</h5>
                                                        <h5 class="mb-0">11:00 AM- 10:00 PM</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="w-100">
                                            <button
                                                class="btn rounded-pill position-absolute text-index py-0 featured-btn mt-3 ms-3">FEATURE
                                                HOUSE</button>
                                            <img src="/images/bulletin-images/house-6.png" class="card-img-top  position-relative"
                                                 alt="..." />
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Daily Belvana Trainer</h5>
                                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Lobortis eros diam dolor in aenean natoque magna commodo.
                                                Elementum tristique nec eget.</p>
                                        </div>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="d-flex flex-column">
                                    <div class="card ">
                                        <img src="/images/bulletin-images/house-7.png" class="card-img-top" alt="..." />
                                        <div class="card-body">
                                            <h5 class="card-title">Daily Belvana Trainer</h5>
                                            <div class="card-text pt-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5><span>  <img src="/images/bulletin-images/clock.png" class="img-fluid" /></span> Mon-Thu</h5>
                                                    <h5>9:00 AM- 10:00 PM</h5>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center pt-3">
                                                    <h5 class="mb-0"><img src="/images/bulletin-images/clock.png" /> Fri-Sat</h5>
                                                    <h5 class="mb-0">11:00 AM- 10:00 PM</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card ">
                                        <div class="w-100">
                                            <button
                                                class="btn rounded-pill position-absolute text-index py-0 featured-btn mt-3 ms-3">FEATURE
                                                HOUSE</button>
                                            <img src="/images/bulletin-images/house-8.png" class="card-img-top  position-relative"
                                                 alt="..." />
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Daily Belvana Trainer</h5>
                                            <div class="card-text">
                                                <ul>
                                                    <li>Lorem ipsum dolor sit amet, consectetur magna.</li>
                                                    <li>Lobortis eros diam dolor in aenean natoque magna commodo</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <img src="/images/bulletin-images/house-9.png" class="card-img-top" alt="..." />
                                        <div class="card-body">
                                            <h3 class="card-title">Daily Belvana Trainer</h3>
                                            <p class="card-text pt-3">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Lobortis eros diam dolor in aenean natoque magna commodo.
                                                Elementum tristique nec eget.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- last flex cards -->
                                <div class="d-flex flex-column mx-0 mx-lg-5">

                                    <!-- Card -->
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <img src="/images/bulletin-images/volume-img.png" class="img-fluid" />
                                                <h3 class="card-title ps-3">Announcements</h3>
                                            </div>
                                            <div class="card-text">
                                                <ul class="pt-4">
                                                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                                    <li>Lobortis eros diam dolor in natoque magna commodo.</li>
                                                    <li>Lobortis eros diam dolor in natoque magna commodo.</li>
                                                    <li>Lobortis eros diam dolor in natoque magna commodo.</li>
                                                    <li>Lobortis eros diam dolor in natoque magna commodo. </li>
                                                    <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                                    <li>Lobortis eros diam dolor in natoque magna commodo.</li>
                                                    <li>Lobortis eros diam dolor in natoque magna commodo.</li>
                                                    <li>Lobortis eros diam dolor in natoque magna commodo.</li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Card -->

                                    <div class="card">
                                        <img src="/images/bulletin-images/house-10.png" class="card-img-top" alt="..." />
                                        <div class="card-body">
                                            <h3 class="card-title">Beach House</h3>
                                            <div class="card-text">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,Lorem ipsum dolor sit amet, consectetur adipiscing elit,Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <img src="/images/bulletin-images/house-11.png" class="card-img-top" alt="..." />
                                        <div class="card-body">
                                            <h3 class="card-title">Timings</h3>
                                            <div class="card-text pt-3">
                                                <div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h5><span>  <img src="/images/bulletin-images/clock.png" class="img-fluid" /></span> Mon-Thu</h5>
                                                        <h5>9:00 AM- 10:00 PM</h5>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center pt-3">
                                                        <h4 class="mb-0"><img src="/images/bulletin-images/clock.png" /> Fri-Sat</h4>
                                                        <h4 class="mb-0">11:00 AM- 10:00 PM</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- ends -->
                            </div>
                            <section class="text-center">
                                <img src="/images/bulletin-images/dark-dots.png" class="img-fluid cards-dots-green" />
                            </section>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...
                        </div>
                        <div class="tab-pane fade" id="shopping" role="tabpanel" aria-labelledby="shopping-tab">...
                        </div>
                        <div class="tab-pane fade" id="clipboard" role="tabpanel" aria-labelledby="clipboard-tab">
                            ...
                        </div>
                        <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
                            ...
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</x-guest-layout>

