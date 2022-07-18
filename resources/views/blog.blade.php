
<x-guest-layout>
    @push('stylesheets')

    @endpush

        @include('partials.sub-page-hero-section')

    {{--  center text row  --}}
    <section class="bg-map bg-light pt-5">
        <div class="blog-text shadow-1-strong rounded text-center  d-flex justify-content-center">
            <h1 class="text-primary font-jost">Find Your Vacation House</h1>
        </div>
        <h3 class="pt-2 text-center">Choose your Category</h3>
        <div class="container  pt-5">
            <div class="row my-5  category-cards">
                <div class="col-12">
                    <ul class="nav nav-tabs border-bottom-0" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                    aria-selected="true">
                              <p class="mb-0 fs-3">All</p>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile" aria-selected="true">
                                <img src="/images/blog-images/beach.png" width="30px" />
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                    type="button" role="tab" aria-controls="contact" aria-selected="true">
                                <img src="/images/blog-images/building-house.png" width="30px" />
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="shopping-tab" data-bs-toggle="tab"
                                    data-bs-target="#shopping" type="button" role="tab" aria-controls="shopping"
                                    aria-selected="true">
                                <img src="/images/blog-images/tiny-house.png" width="30px" />
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="clipboard-tab" data-bs-toggle="tab"
                                    data-bs-target="#clipboard" type="button" role="tab" aria-controls="clipboard"
                                    aria-selected="true">
                                <img src="/images/blog-images/pool.png" width="30px" />
                            </button>
                        </li>
                    </ul>
                    <!-- dots img -->

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="d-block d-xl-flex  justify-content-center">
                                <div class="d-flex flex-column">
                                    <div class="card ">
                                        <div class="w-100">
                                            <button class="btn  position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                                                HOUSE</button>
                                            <img src="/images/blog-images/house-1.png" class="card-img-top  position-relative" alt="..." />
                                        </div>
                                        <div class="card-body">
                                            <div class="w-80 mx-auto margin-negative bg-white position-relative z-index-2 p-5 rounded-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="user-img d-flex">
                                                        <img src="/images/blog-images/rounded-image.png" class="img-fluid position-relative" alt="...">
                                                        <div class="ps-3">
                                                            <h3 class="mb-1">BY JOHN SMITH</h3>
                                                            <h5>23 June 2022</h5>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="connectionsDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi-three-dots-vertical"></i>
                                                        </button>

                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="connectionsDropdown2">
                                                            <a class="dropdown-item" href="#">Share connection</a>
                                                            <a class="dropdown-item" href="#">Block connection</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="paragraph-text pt-3">
                                                    <p>	Hi Everyone! I am excited to have you sharing in our new vacation calendar. This is a long awaited site. that will finally allow us  to know about house.</p>
                                                </div>
                                            </div>
                                            <div class="card-footer px-2">
                                                <ul class="d-flex list-unstyled ul-card-footer">
                                                    <li><p><span><img src="/images/blog-images/love.png" class="img-fluid me-1"></span>200 Likes</p> </li>
                                                    <li><p><span><img src="/images/blog-images/chat.png" class="img-fluid me-1"></span>20 Comments</p></li>
                                                    <li><p><span><img src="/images/blog-images/eye.png" class="img-fluid me-1"></span>200 Likes</p></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card -->
                                    <div class="card ">
                                        <div class="w-100">
                                            <button class="btn position-absolute text-index py-0 featured-btn mt-3 ms-3">FEATURE
                                                HOUSE</button>
                                            <img src="/images/blog-images/house-2.png" class="card-img-top  position-relative" alt="..." />
                                        </div>
                                        <div class="card-body">
                                            <div class="w-80 mx-auto margin-negative bg-white position-relative z-index-2 p-5 rounded-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="user-img d-flex">
                                                        <img src="/images/blog-images/rounded-image.png" class="img-fluid position-relative" alt="..." />
                                                        <div class="ps-3">
                                                            <h3 class="mb-1">BY JOHN SMITH</h3>
                                                            <h5>23 June 2022</h5>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="connectionsDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi-three-dots-vertical"></i>
                                                        </button>

                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="connectionsDropdown2">
                                                            <a class="dropdown-item" href="#">Share connection</a>
                                                            <a class="dropdown-item" href="#">Block connection</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="paragraph-text pt-3">
                                                    <p>	Hi Everyone! I am excited to have you sharing in our new vacation calendar. This is a long awaited site. that will finally allow us  to know about house.</p>
                                                </div>
                                            </div>
                                            <div class="card-footer px-2">
                                                <ul class="d-flex list-unstyled ul-card-footer">
                                                    <li><p><span><img src="/images/blog-images/love.png" class="img-fluid me-1" /></span>200 Likes</p> </li>
                                                    <li><p><span><img src="/images/blog-images/chat.png" class="img-fluid me-1" /></span>20 Comments</p></li>
                                                    <li><p><span><img src="/images/blog-images/eye.png" class="img-fluid me-1" /></span>200 Likes</p></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- End Card -->
                                    <div class="card ">
                                        <div class="w-100">
                                            <button class="btn position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                                                HOUSE</button>
                                            <img src="/images/blog-images/house-3.png" class="card-img-top  position-relative" alt="..." />
                                        </div>
                                        <div class="card-body">
                                            <div class="w-80 mx-auto margin-negative bg-white position-relative z-index-2 p-5 rounded-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="user-img d-flex">
                                                        <img src="/images/blog-images/rounded-image.png" class="img-fluid position-relative" alt="..." />
                                                        <div class="ps-3">
                                                            <h3 class="mb-1">BY JOHN SMITH</h3>
                                                            <h5>23 June 2022</h5>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="connectionsDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi-three-dots-vertical"></i>
                                                        </button>

                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="connectionsDropdown2">
                                                            <a class="dropdown-item" href="#">Share connection</a>
                                                            <a class="dropdown-item" href="#">Block connection</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="paragraph-text pt-3">
                                                    <p>	Hi Everyone! I am excited to have you sharing in our new vacation calendar. This is a long awaited site. that will finally allow us  to know about house.</p>
                                                </div>
                                            </div>
                                            <div class="card-footer px-2">
                                                <ul class="d-flex list-unstyled ul-card-footer">
                                                    <li><p><span><img src="/images/blog-images/love.png" class="img-fluid me-1" /></span>200 Likes</p> </li>
                                                    <li><p><span><img src="/images/blog-images/chat.png" class="img-fluid me-1" /></span>20 Comments</p></li>
                                                    <li><p><span><img src="/images/blog-images/eye.png" class="img-fluid me-1" /></span>200 Likes</p></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <!--  -->
                                <div class="d-flex flex-column mx-0 mx-lg-5">
                                    <div class="card ">
                                        <div class="w-100">
                                            <button class="btn position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                                                HOUSE</button>
                                            <img src="/images/blog-images/house-4.png" class="card-img-top  position-relative" alt="..." />
                                        </div>
                                        <div class="card-body">
                                            <div class="w-80 mx-auto margin-negative bg-white position-relative z-index-2 p-5 rounded-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="user-img d-flex">
                                                        <img src="/images/blog-images/rounded-image.png" class="img-fluid position-relative" alt="..." />
                                                        <div class="ps-3">
                                                            <h3 class="mb-1">BY JOHN SMITH</h3>
                                                            <h5>23 June 2022</h5>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="connectionsDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi-three-dots-vertical"></i>
                                                        </button>

                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="connectionsDropdown2">
                                                            <a class="dropdown-item" href="#">Share connection</a>
                                                            <a class="dropdown-item" href="#">Block connection</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="paragraph-text pt-3">
                                                    <p>	Hi Everyone! I am excited to have you sharing in our new vacation calendar. This is a long awaited site. that will finally allow us  to know about house.</p>
                                                </div>
                                            </div>
                                            <div class="card-footer px-2">
                                                <ul class="d-flex list-unstyled ul-card-footer">
                                                    <li><p><span><img src="/images/blog-images/love.png" class="img-fluid me-1" /></span>200 Likes</p> </li>
                                                    <li><p><span><img src="/images/blog-images/chat.png" class="img-fluid me-1" /></span>20 Comments</p></li>
                                                    <li><p><span><img src="/images/blog-images/eye.png" class="img-fluid me-1" /></span>200 Likes</p></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card ">
                                        <div class="w-100">
                                            <button class="btn position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                                                HOUSE</button>
                                            <img src="/images/blog-images/house-5.png" class="card-img-top  position-relative" alt="..." />
                                        </div>
                                        <div class="card-body">
                                            <div class="w-80 mx-auto margin-negative bg-white position-relative z-index-2 p-5 rounded-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="user-img d-flex">
                                                        <img src="/images/blog-images/rounded-image.png" class="img-fluid position-relative" alt="..." />
                                                        <div class="ps-3">
                                                            <h3 class="mb-1">BY JOHN SMITH</h3>
                                                            <h5>23 June 2022</h5>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="connectionsDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi-three-dots-vertical"></i>
                                                        </button>

                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="connectionsDropdown2">
                                                            <a class="dropdown-item" href="#">Share connection</a>
                                                            <a class="dropdown-item" href="#">Block connection</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="paragraph-text pt-3">
                                                    <p>	Hi Everyone! I am excited to have you sharing in our new vacation calendar. This is a long awaited site. that will finally allow us  to know about house.</p>
                                                </div>
                                            </div>
                                            <div class="card-footer px-2">
                                                <ul class="d-flex list-unstyled ul-card-footer">
                                                    <li><p><span><img src="/images/blog-images/love.png" class="img-fluid me-1" /></span>200 Likes</p> </li>
                                                    <li><p><span><img src="/images/blog-images/chat.png" class="img-fluid me-1" /></span>20 Comments</p></li>
                                                    <li><p><span><img src="/images/blog-images/eye.png" class="img-fluid me-1" /></span>200 Likes</p></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card ">
                                        <div class="w-100">
                                            <button class="btn position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                                                HOUSE</button>
                                            <img src="/images/blog-images/house-6.png" class="card-img-top  position-relative" alt="...">
                                        </div>
                                        <div class="card-body">
                                            <div class="w-80 mx-auto margin-negative bg-white position-relative z-index-2 p-5 rounded-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="user-img d-flex">
                                                        <img src="/images/blog-images/rounded-image.png" class="img-fluid position-relative" alt="..." />
                                                        <div class="ps-3">
                                                            <h3 class="mb-1">BY JOHN SMITH</h3>
                                                            <h5>23 June 2022</h5>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="connectionsDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi-three-dots-vertical"></i>
                                                        </button>

                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="connectionsDropdown2">
                                                            <a class="dropdown-item" href="#">Share connection</a>
                                                            <a class="dropdown-item" href="#">Block connection</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="paragraph-text pt-3">
                                                    <p>	Hi Everyone! I am excited to have you sharing in our new vacation calendar. This is a long awaited site. that will finally allow us  to know about house.</p>
                                                </div>
                                            </div>
                                            <div class="card-footer px-2">
                                                <ul class="d-flex list-unstyled ul-card-footer">
                                                    <li><p><span><img src="/images/blog-images/love.png" class="img-fluid me-1" /></span>200 Likes</p> </li>
                                                    <li><p><span><img src="/images/blog-images/chat.png" class="img-fluid me-1" /></span>20 Comments</p></li>
                                                    <li><p><span><img src="/images/blog-images/eye.png" class="img-fluid me-1" /></span>200 Likes</p></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!--  -->
                                <div class="d-flex flex-column">
                                    <div class="card ">
                                        <div class="w-100">
                                            <button class="btn position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                                                HOUSE</button>
                                            <img src="/images/blog-images/house-4.png" class="card-img-top  position-relative" alt="..." />
                                        </div>
                                        <div class="card-body">
                                            <div class="w-80 mx-auto margin-negative bg-white position-relative z-index-2 p-5 rounded-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="user-img d-flex">
                                                        <img src="/images/blog-images/rounded-image.png" class="img-fluid position-relative" alt="..." />
                                                        <div class="ps-3">
                                                            <h3 class="mb-1">BY JOHN SMITH</h3>
                                                            <h5>23 June 2022</h5>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="connectionsDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi-three-dots-vertical"></i>
                                                        </button>

                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="connectionsDropdown2">
                                                            <a class="dropdown-item" href="#">Share connection</a>
                                                            <a class="dropdown-item" href="#">Block connection</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="paragraph-text pt-3">
                                                    <p>	Hi Everyone! I am excited to have you sharing in our new vacation calendar. This is a long awaited site. that will finally allow us  to know about house.</p>
                                                </div>
                                            </div>
                                            <div class="card-footer px-2">
                                                <ul class="d-flex list-unstyled ul-card-footer">
                                                    <li><p><span><img src="/images/blog-images/love.png" class="img-fluid me-1 /"></span>200 Likes</p> </li>
                                                    <li><p><span><img src="/images/blog-images/chat.png" class="img-fluid me-1" /></span>20 Comments</p></li>
                                                    <li><p><span><img src="/images/blog-images/eye.png" class="img-fluid me-1" /></span>200 Likes</p></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card ">
                                        <div class="w-100">
                                            <button class="btn position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                                                HOUSE</button>
                                            <img src="/images/blog-images/house-2.png" class="card-img-top  position-relative" alt="..." />
                                        </div>
                                        <div class="card-body">
                                            <div class="w-80 mx-auto margin-negative bg-white position-relative z-index-2 p-5 rounded-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="user-img d-flex">
                                                        <img src="/images/blog-images/rounded-image.png" class="img-fluid position-relative" alt="..." />
                                                        <div class="ps-3">
                                                            <h3 class="mb-1">BY JOHN SMITH</h3>
                                                            <h5>23 June 2022</h5>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="connectionsDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi-three-dots-vertical"></i>
                                                        </button>

                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="connectionsDropdown2">
                                                            <a class="dropdown-item" href="#">Share connection</a>
                                                            <a class="dropdown-item" href="#">Block connection</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="paragraph-text pt-3">
                                                    <p>	Hi Everyone! I am excited to have you sharing in our new vacation calendar. This is a long awaited site. that will finally allow us  to know about house.</p>
                                                </div>
                                            </div>
                                            <div class="card-footer px-2">
                                                <ul class="d-flex list-unstyled ul-card-footer">
                                                    <li><p><span><img src="/images/blog-images/love.png" class="img-fluid me-1" /></span>200 Likes</p> </li>
                                                    <li><p><span><img src="/images/blog-images/chat.png" class="img-fluid me-1" /></span>20 Comments</p></li>
                                                    <li><p><span><img src="/images/blog-images/eye.png" class="img-fluid me-1" /></span>200 Likes</p></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card ">
                                        <div class="w-100">
                                            <button class="btn position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                                                HOUSE</button>
                                            <img src="/images/blog-images/house-1.png" class="card-img-top  position-relative" alt="...">
                                        </div>
                                        <div class="card-body">
                                            <div class="w-80 mx-auto margin-negative bg-white position-relative z-index-2 p-5 rounded-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="user-img d-flex">
                                                        <img src="/images/blog-images/rounded-image.png" class="img-fluid position-relative" alt="..." />
                                                        <div class="ps-3">
                                                            <h3 class="mb-1">BY JOHN SMITH</h3>
                                                            <h5>23 June 2022</h5>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="connectionsDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi-three-dots-vertical"></i>
                                                        </button>

                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="connectionsDropdown2">
                                                            <a class="dropdown-item" href="#">Share connection</a>
                                                            <a class="dropdown-item" href="#">Block connection</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="paragraph-text pt-3">
                                                    <p>	Hi Everyone! I am excited to have you sharing in our new vacation calendar. This is a long awaited site. that will finally allow us  to know about house.</p>
                                                </div>
                                            </div>
                                            <div class="card-footer px-2">
                                                <ul class="d-flex list-unstyled ul-card-footer">
                                                    <li><p><span><img src="/images/blog-images/love.png" class="img-fluid me-1" /></span>200 Likes</p> </li>
                                                    <li><p><span><img src="/images/blog-images/chat.png" class="img-fluid me-1" /></span>20 Comments</p></li>
                                                    <li><p><span><img src="/images/blog-images/eye.png" class="img-fluid me-1" /></span>200 Likes</p></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- ends -->
                            </div>
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

