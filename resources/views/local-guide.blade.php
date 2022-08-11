
<x-guest-layout>
    @push('stylesheets')
    @endpush

    @include('partials.sub-page-hero-section', ['title' => 'Guest Book'])

    <section class=" bg-light pt-5">
        <div class="bg-guest shadow-1-strong rounded text-center  d-flex justify-content-center align-items-center">
            <h1 class="text-primary font-vintage mb-0">Guest Book</h1>
        </div>
        <h1 class="pt-2 text-center poppins-bold">Read guest reviews here</h1>
        <div class="container mt-80 pb-5">
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card blog-card rounded-2">
                        <div class="card-header border-0">
                            <div class="d-block d-md-flex justify-content-between align-items-center">
                                <div class="user-img d-flex align-items-center">

                                    {{--                            <img src="/images/blog-images/house-7.png" class="img-fluid position-relative" alt="...">--}}
                                    <img src="/images/blog-images/rounded-image.png" class="img-fluid position-relative rounded-0" alt="...">

                                    <div class="ps-1">
                                        <b class="mb-1 text-black fs-4 title-fs">John Smith</b>
                                        <p class="mb-0 date-fs">30 june 2020 <a href="#">View</a> </p>
                                    </div>
                                </div>
                                <a class="btn btn-primary-light fs-13 my-3 my-md-0">Food & Drink</a>
                            </div>
                            <div class="d-flex align-items-center justify-content-between pt-2">
                                <b class="text-dark">Amazing food experience!</b>
                                <p class="mb-0">02-03-2022 | 3:00 PM</p>
                            </div>
                        </div>
                        <div class="w-100">
                            <a class="btn  position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                                HOUSE</a>
                            <a href="">
                                <img src="/images/blog-images/house-5.png" class="card-img-top  position-relative rounded-3 p-2" style="height: 250px !important;object-fit: cover" alt="..." />
                            </a>


                        </div>
                        <div class="card-body p-2">
                            <div class="card-footer px-1 pb-0 border-0">
                                <ul class="d-block d-md-flex list-unstyled recipe-card-footer justify-content-between">
                                    <li>5.0 <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="ps-2">(34 Reviews)</span>
                                    </li>
                                    <li class="pt-2 pt-md-0"><img src="/images/blog-images/comment.svg" class="img-fluid me-1"><span>25 Comments</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card blog-card rounded-2">
                        <div class="card-header border-0">
                            <div class="d-block d-md-flex justify-content-between align-items-center">
                                <div class="user-img d-flex align-items-center">

                                    {{--                            <img src="/images/blog-images/house-7.png" class="img-fluid position-relative" alt="...">--}}
                                    <img src="/images/blog-images/rounded-image.png" class="img-fluid position-relative rounded-0" alt="...">

                                    <div class="ps-1">
                                        <b class="mb-1 text-black fs-4 title-fs">John Smith</b>
                                        <p class="mb-0 date-fs">30 june 2020 <a href="#">View</a> </p>
                                    </div>
                                </div>
                                <a class="btn btn-primary-light fs-13 my-3 my-md-0">Food & Drink</a>
                            </div>
                            <div class="d-flex align-items-center justify-content-between pt-2">
                                <b class="text-dark">Amazing food experience!</b>
                                <p class="mb-0">02-03-2022 | 3:00 PM</p>
                            </div>
                        </div>
                        <div class="w-100">
                            <a class="btn  position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                                HOUSE</a>
                            <a href="">
                                <img src="/images/blog-images/house-5.png" class="card-img-top  position-relative rounded-3 p-2" style="height: 250px !important;object-fit: cover" alt="..." />
                            </a>


                        </div>
                        <div class="card-body p-2">
                            <div class="card-footer px-1 pb-0 border-0">
                                <ul class="d-block d-md-flex list-unstyled recipe-card-footer justify-content-between">
                                    <li>5.0 <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="ps-2">(34 Reviews)</span>
                                    </li>
                                    <li class="pt-2 pt-md-0"><img src="/images/blog-images/comment.svg" class="img-fluid me-1"><span>25 Comments</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card blog-card rounded-2">
                        <div class="card-header border-0">
                            <div class="d-block d-md-flex justify-content-between align-items-center">
                                <div class="user-img d-flex align-items-center">

                                    {{--                            <img src="/images/blog-images/house-7.png" class="img-fluid position-relative" alt="...">--}}
                                    <img src="/images/blog-images/rounded-image.png" class="img-fluid position-relative rounded-0" alt="...">

                                    <div class="ps-1">
                                        <b class="mb-1 text-black fs-4 title-fs">John Smith</b>
                                        <p class="mb-0 date-fs">30 june 2020 <a href="#">View</a> </p>
                                    </div>
                                </div>
                                <a class="btn btn-primary-light fs-13 my-3 my-md-0">Food & Drink</a>
                            </div>
                            <div class="d-flex align-items-center justify-content-between pt-2">
                                <b class="text-dark">Amazing food experience!</b>
                                <p class="mb-0">02-03-2022 | 3:00 PM</p>
                            </div>
                        </div>
                        <div class="w-100">
                            <a class="btn  position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                                HOUSE</a>
                            <a href="">
                                <img src="/images/blog-images/house-5.png" class="card-img-top  position-relative rounded-3 p-2" style="height: 250px !important;object-fit: cover" alt="..." />
                            </a>


                        </div>
                        <div class="card-body p-2">
                            <div class="card-footer px-1 pb-0 border-0">
                                <ul class="d-block d-md-flex list-unstyled recipe-card-footer justify-content-between">
                                    <li>5.0 <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="ps-2">(34 Reviews)</span>
                                    </li>
                                    <li class="pt-2 pt-md-0"><img src="/images/blog-images/comment.svg" class="img-fluid me-1"><span>25 Comments</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card blog-card rounded-2">
                        <div class="card-header border-0">
                            <div class="d-block d-md-flex justify-content-between align-items-center">
                                <div class="user-img d-flex align-items-center">

                                    {{--                            <img src="/images/blog-images/house-7.png" class="img-fluid position-relative" alt="...">--}}
                                    <img src="/images/blog-images/rounded-image.png" class="img-fluid position-relative rounded-0" alt="...">

                                    <div class="ps-1">
                                        <b class="mb-1 text-black fs-4 title-fs">John Smith</b>
                                        <p class="mb-0 date-fs">30 june 2020 <a href="#">View</a> </p>
                                    </div>
                                </div>
                                <a class="btn btn-primary-light fs-13 my-3 my-md-0">Food & Drink</a>
                            </div>
                            <div class="d-flex align-items-center justify-content-between pt-2">
                                <b class="text-dark">Amazing food experience!</b>
                                <p class="mb-0">02-03-2022 | 3:00 PM</p>
                            </div>
                        </div>
                        <div class="w-100">
                            <a class="btn  position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                                HOUSE</a>
                            <a href="">
                                <img src="/images/blog-images/house-5.png" class="card-img-top  position-relative rounded-3 p-2" style="height: 250px !important;object-fit: cover" alt="..." />
                            </a>


                        </div>
                        <div class="card-body p-2">
                            <div class="card-footer px-1 pb-0 border-0">
                                <ul class="d-block d-md-flex list-unstyled recipe-card-footer justify-content-between">
                                    <li>5.0 <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="ps-2">(34 Reviews)</span>
                                    </li>
                                    <li class="pt-2 pt-md-0"><img src="/images/blog-images/comment.svg" class="img-fluid me-1"><span>25 Comments</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card blog-card rounded-2">
                        <div class="card-header border-0">
                            <div class="d-block d-md-flex justify-content-between align-items-center">
                                <div class="user-img d-flex align-items-center">

                                    {{--                            <img src="/images/blog-images/house-7.png" class="img-fluid position-relative" alt="...">--}}
                                    <img src="/images/blog-images/rounded-image.png" class="img-fluid position-relative rounded-0" alt="...">

                                    <div class="ps-1">
                                        <b class="mb-1 text-black fs-4 title-fs">John Smith</b>
                                        <p class="mb-0 date-fs">30 june 2020 <a href="#">View</a> </p>
                                    </div>
                                </div>
                                <a class="btn btn-primary-light fs-13 my-3 my-md-0">Food & Drink</a>
                            </div>
                            <div class="d-flex align-items-center justify-content-between pt-2">
                                <b class="text-dark">Amazing food experience!</b>
                                <p class="mb-0">02-03-2022 | 3:00 PM</p>
                            </div>
                        </div>
                        <div class="w-100">
                            <a class="btn  position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                                HOUSE</a>
                            <a href="">
                                <img src="/images/blog-images/house-5.png" class="card-img-top  position-relative rounded-3 p-2" style="height: 250px !important;object-fit: cover" alt="..." />
                            </a>


                        </div>
                        <div class="card-body p-2">
                            <div class="card-footer px-1 pb-0 border-0">
                                <ul class="d-block d-md-flex list-unstyled recipe-card-footer justify-content-between">
                                    <li>5.0 <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="ps-2">(34 Reviews)</span>
                                    </li>
                                    <li class="pt-2 pt-md-0"><img src="/images/blog-images/comment.svg" class="img-fluid me-1"><span>25 Comments</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card blog-card rounded-2">
                        <div class="card-header border-0">
                            <div class="d-block d-md-flex justify-content-between align-items-center">
                                <div class="user-img d-flex align-items-center">

                                    {{--                            <img src="/images/blog-images/house-7.png" class="img-fluid position-relative" alt="...">--}}
                                    <img src="/images/blog-images/rounded-image.png" class="img-fluid position-relative rounded-0" alt="...">

                                    <div class="ps-1">
                                        <b class="mb-1 text-black fs-4 title-fs">John Smith</b>
                                        <p class="mb-0 date-fs">30 june 2020 <a href="#">View</a> </p>
                                    </div>
                                </div>
                                <a class="btn btn-primary-light fs-13 my-3 my-md-0">Food & Drink</a>
                            </div>
                            <div class="d-flex align-items-center justify-content-between pt-2">
                                <b class="text-dark">Amazing food experience!</b>
                                <p class="mb-0">02-03-2022 | 3:00 PM</p>
                            </div>
                        </div>
                        <div class="w-100">
                            <a class="btn  position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                                HOUSE</a>
                            <a href="">
                                <img src="/images/blog-images/house-5.png" class="card-img-top  position-relative rounded-3 p-2" style="height: 250px !important;object-fit: cover" alt="..." />
                            </a>


                        </div>
                        <div class="card-body p-2">
                            <div class="card-footer px-1 pb-0 border-0">
                                <ul class="d-block d-md-flex list-unstyled recipe-card-footer justify-content-between">
                                    <li>5.0 <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="ps-2">(34 Reviews)</span>
                                    </li>
                                    <li class="pt-2 pt-md-0"><img src="/images/blog-images/comment.svg" class="img-fluid me-1"><span>25 Comments</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-guest-layout>

