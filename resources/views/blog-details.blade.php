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
        <img src="{{asset('images/blog-images/blog.png')}}" class="w-100 blog-detail-image" alt="">
    </div>

    <div class="container">
        <div class="card border-0 rounded-20 py-3" style="margin-top: -70px;">
            <div class="card-body">
                <h1 class="text-w-50 lh-30">35 Stellar Graphic Design Blogs to Keep You Educated and Inspired</h1>

                <div class="d-flex align-items-center mt-4">
                    <div class="flex-shrink-0">
                        <img
                            class="avatar-img rounded-circle"
                            src="{{ auth()->user()->profile_photo_url }}"
                            :src="avatarUrl"
                            alt="Image"
                            width="60" height="60" style="object-fit: cover"
                        />
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h4 class="mb-0" style="color: #6D6D6D">{{ auth()->user()->first_name }}</h4>
                        <p class="mb-0" style="color: #B6B4B4">23 JUNE 202</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container my-5 pt-5">
        <div class="row">
            <div class="col-12 col-lg-9 pe-0 pe-lg-5">
                <div class="border-bottom">
                    <ul class="d-flex list-unstyled ul-card-footer mb-0">
                        <li class="me-2 me-md-3"><p class="ps-0"><span><img src="/images/blog-images/love.png"
                                                                            class="img-fluid me-1"></span>200 Likes</p>
                        </li>
                        <li class="me-2 me-md-3"><p class="ps-0"><span><img src="/images/blog-images/chat.png"
                                                                            class="img-fluid me-1"></span>400 Comments
                            </p></li>
                    </ul>
                </div>
                <div class="py-4">
                    @if(isset($blogDetail))

                        {!! !empty($blogDetail->Content) ? $blogDetail->Content : '' !!}
                    @endif

                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="mb-4">
                    <div class="input-group border rounded-1" style="border-color: #E8604C35 !important;">
                        <input type="text" class="form-control border-0 outline-0" placeholder="Search here..."
                               aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn"><i class="bi-search text-primary"></i></button>
                    </div>
                </div>
                <div class="card border-0 mb-4">
                    <div class="card-body">
                        <h4 class="mb-3">Latest Post</h4>
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-shrink-0">
                                <img
                                    class="avatar-img rounded-circle"
                                    src="{{ auth()->user()->profile_photo_url }}"
                                    :src="avatarUrl"
                                    alt="Image"
                                    width="60" height="60" style="object-fit: cover"
                                />
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0" style="color: #6D6D6D">{{ auth()->user()->first_name }}</h4>
                                <p class="mb-0" style="color: #B6B4B4">23 JUNE 202</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-shrink-0">
                                <img
                                    class="avatar-img rounded-circle"
                                    src="{{ auth()->user()->profile_photo_url }}"
                                    :src="avatarUrl"
                                    alt="Image"
                                    width="60" height="60" style="object-fit: cover"
                                />
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0" style="color: #6D6D6D">{{ auth()->user()->first_name }}</h4>
                                <p class="mb-0" style="color: #B6B4B4">23 JUNE 202</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-shrink-0">
                                <img
                                    class="avatar-img rounded-circle"
                                    src="{{ auth()->user()->profile_photo_url }}"
                                    :src="avatarUrl"
                                    alt="Image"
                                    width="60" height="60" style="object-fit: cover"
                                />
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0" style="color: #6D6D6D">{{ auth()->user()->first_name }}</h4>
                                <p class="mb-0" style="color: #B6B4B4">23 JUNE 202</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-shrink-0">
                                <img
                                    class="avatar-img rounded-circle"
                                    src="{{ auth()->user()->profile_photo_url }}"
                                    :src="avatarUrl"
                                    alt="Image"
                                    width="60" height="60" style="object-fit: cover"
                                />
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0" style="color: #6D6D6D">{{ auth()->user()->first_name }}</h4>
                                <p class="mb-0" style="color: #B6B4B4">23 JUNE 202</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-shrink-0">
                                <img
                                    class="avatar-img rounded-circle"
                                    src="{{ auth()->user()->profile_photo_url }}"
                                    :src="avatarUrl"
                                    alt="Image"
                                    width="60" height="60" style="object-fit: cover"
                                />
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="mb-0" style="color: #6D6D6D">{{ auth()->user()->first_name }}</h4>
                                <p class="mb-0" style="color: #B6B4B4">23 JUNE 202</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 mb-4 categories-card">
                    <div class="card-body">
                        <h4 class="mb-3">Categories</h4>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h4 class="fw-normal" style="color: #6D6D6D">Beach House</h4>
                            </div>
                            <div>
                                <p class="mb-0 border-primary category-count">5</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h4 class="fw-normal" style="color: #6D6D6D">Town House</h4>
                            </div>
                            <div>
                                <p class="mb-0 border-primary category-count">5</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h4 class="fw-normal" style="color: #6D6D6D">Beach House</h4>
                            </div>
                            <div>
                                <p class="mb-0 border-primary category-count">5</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h4 class="fw-normal" style="color: #6D6D6D">Tiny House</h4>
                            </div>
                            <div>
                                <p class="mb-0 border-primary category-count">5</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h4 class="fw-normal" style="color: #6D6D6D">Luxery House</h4>
                            </div>
                            <div>
                                <p class="mb-0 border-primary category-count">5</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 mb-4 tags-card">
                    <div class="card-body">
                        <h4 class="mb-3">Tags</h4>
                        <div>
                            <span>
                                <a href="" class="btn btn-sm me-3 btn-soft-primary mb-3">Business</a>
                            </span>
                            <span>
                                <a href="" class="btn btn-sm me-3 btn-soft-primary mb-3">Graphic Design</a>
                            </span>
                            <span>
                                <a href="" class="btn btn-sm me-3 btn-soft-primary mb-3">Technoly</a>
                            </span>
                            <span>
                                <a href="" class="btn btn-sm me-3 btn-soft-primary mb-3">App Development</a>
                            </span>
                            <span>
                                <a href="" class="btn btn-sm me-3 btn-soft-primary mb-3">Website Design</a>
                            </span>
                            <span>
                                <a href="" class="btn btn-sm me-3 btn-soft-primary mb-3">Business Idea</a>
                            </span>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row mb-5">
            <div class="col-12 col-lg-6">
                <div class="d-flex justify-content-between">
                    <h4>15 comments</h4>
                    <div><label for="">Sort By</label>
                        <select name="" id="" class="border px-3 py-1 rounded" style="background-color: #CDD0D5">
                            <option value="">Sort</option>
                            <option value="">Sort</option>
                            <option value="">Sort</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-12 col-lg-6">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <img src="{{asset('images/images-home/smiling-girl.jpg')}}" class="rounded-1" width="50"
                             height="50" style="object-fit: cover" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="border">
                            <textarea name="" id="" cols="30" class="form-control border-0" rows="3"></textarea>
                        </div>
                        <div class="text-start text-lg-end py-3 px-3" style="background-color: #2D394C10">
                            <button class="btn btn-secondary px-5" style="background-color: #2D394C">Post</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5 mb-3">
            <div class="col-12 col-lg-6">
                <div class="d-flex w-100">
                    <div class="flex-shrink-0">
                        <img src="{{asset('images/images-home/smiling-girl.jpg')}}" class="rounded-1" width="50"
                             height="50" style="object-fit: cover" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3 mb-3">
                        <h5 class="mb-0">Courteny Hendry</h5>
                        <p class="mb-0" style="font-size: 12px">Ultricies ultricies interdum dolor sodales. Vitae
                            feugiat vitae vitae quis id consectetur. Aenean urna, lectus enim suscipit eget. Tristique
                            bibendum nib.</p>
                        <p class="mb-0" style="font-size: 12px">
                            <span class="me-1">
                                <a href="" class="text-muted">Like</a>
                            </span>.
                            <span class="mx-1">
                                <a href="" class="text-muted">Reply</a>
                            </span>.
                            <span class="mx-1 text-muted">
                                24h
                            </span>
                        </p>
                    </div>
                </div>

                <div class="sub-comment ms-2 ps-2 ms-lg-5">
                    <div class="d-flex w-100">
                        <div class="flex-shrink-0">
                            <img src="{{asset('images/images-home/smiling-girl.jpg')}}" class="rounded-1" width="50"
                                 height="50" style="object-fit: cover" alt="...">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0">Courteny Hendry</h5>
                            <p class="mb-0" style="font-size: 12px">Ultricies ultricies interdum dolor sodales. Vitae
                                feugiat vitae vitae quis id consectetur. Aenean urna, lectus enim suscipit eget.
                                Tristique bibendum nib.</p>
                            <p class="mb-0" style="font-size: 12px">
                            <span class="me-1">
                                <a href="" class="text-muted">Like</a>
                            </span>.
                                <span class="mx-1">
                                <a href="" class="text-muted">Reply</a>
                            </span>.
                                <span class="mx-1 text-muted">
                                24h
                            </span>
                            </p>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="row mt-5 mb-3">
            <div class="col-12 col-lg-6">
                <div class="d-flex w-100">
                    <div class="flex-shrink-0">
                        <img src="{{asset('images/images-home/smiling-girl.jpg')}}" class="rounded-1" width="50"
                             height="50" style="object-fit: cover" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3 mb-3">
                        <h5 class="mb-0">Courteny Hendry</h5>
                        <p class="mb-0" style="font-size: 12px">Ultricies ultricies interdum dolor sodales. Vitae
                            feugiat vitae vitae quis id consectetur. Aenean urna, lectus enim suscipit eget. Tristique
                            bibendum nib.</p>
                        <p class="mb-0" style="font-size: 12px">
                            <span class="me-1">
                                <a href="" class="text-muted">Like</a>
                            </span>.
                            <span class="mx-1">
                                <a href="" class="text-muted">Reply</a>
                            </span>.
                            <span class="mx-1 text-muted">
                                24h
                            </span>
                        </p>
                    </div>
                </div>

                <div class="sub-comment ms-2 ps-2 ms-lg-5">
                    <div class="d-flex w-100">
                        <div class="flex-shrink-0">
                            <img src="{{asset('images/images-home/smiling-girl.jpg')}}" class="rounded-1" width="50"
                                 height="50" style="object-fit: cover" alt="...">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0">Courteny Hendry</h5>
                            <p class="mb-0" style="font-size: 12px">Ultricies ultricies interdum dolor sodales. Vitae
                                feugiat vitae vitae quis id consectetur. Aenean urna, lectus enim suscipit eget.
                                Tristique bibendum nib.</p>
                            <p class="mb-0" style="font-size: 12px">
                            <span class="me-1">
                                <a href="" class="text-muted">Like</a>
                            </span>.
                                <span class="mx-1">
                                <a href="" class="text-muted">Reply</a>
                            </span>.
                                <span class="mx-1 text-muted">
                                24h
                            </span>
                            </p>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="row mt-5 mb-3">
            <div class="col-12 col-lg-6">
                <button class="w-100 btn btn-primary">Load 13 More comments</button>
            </div>
        </div>


    </div>

    <div class="container my-5 py-5">
        <h3>Keep Reading</h3>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="card ">
                    <div class="w-100">
                        <button class="btn  position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                            HOUSE
                        </button>
                        <a href="">
                            <img src="/images/blog-images/house-1.png" class="card-img-top  position-relative"
                                 alt="..."/>
                        </a>
                    </div>
                    <div class="card-body">
                        <p>Hi Everyone! I am excited to have you sharing in our new vacation calendar.</p>
                        <div class="">
                            <ul class="d-flex justify-content-between list-unstyled ul-card-footer">
                                <li><p><span><img src="/images/blog-images/love.png" class="img-fluid me-1"></span>200
                                        Likes</p></li>
                                <li><p><span><img src="/images/blog-images/chat.png" class="img-fluid me-1"></span>34
                                        Comments</p></li>
                                <li><p><span><img src="/images/blog-images/eye.png" class="img-fluid me-1"></span>200
                                        Likes</p></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="card ">
                    <div class="w-100">
                        <button class="btn  position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                            HOUSE
                        </button>
                        <a href="">
                            <img src="/images/blog-images/house-1.png" class="card-img-top  position-relative"
                                 alt="..."/>
                        </a>
                    </div>
                    <div class="card-body">
                        <p>Hi Everyone! I am excited to have you sharing in our new vacation calendar.</p>
                        <div class="">
                            <ul class="d-flex justify-content-between list-unstyled ul-card-footer">
                                <li><p><span><img src="/images/blog-images/love.png" class="img-fluid me-1"></span>200
                                        Likes</p></li>
                                <li><p><span><img src="/images/blog-images/chat.png" class="img-fluid me-1"></span>34
                                        Comments</p></li>
                                <li><p><span><img src="/images/blog-images/eye.png" class="img-fluid me-1"></span>200
                                        Likes</p></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="card ">
                    <div class="w-100">
                        <button class="btn  position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                            HOUSE
                        </button>
                        <a href="">
                            <img src="/images/blog-images/house-1.png" class="card-img-top  position-relative"
                                 alt="..."/>
                        </a>
                    </div>
                    <div class="card-body">
                        <p>Hi Everyone! I am excited to have you sharing in our new vacation calendar.</p>
                        <div class="">
                            <ul class="d-flex justify-content-between list-unstyled ul-card-footer">
                                <li><p><span><img src="/images/blog-images/love.png" class="img-fluid me-1"></span>200
                                        Likes</p></li>
                                <li><p><span><img src="/images/blog-images/chat.png" class="img-fluid me-1"></span>34
                                        Comments</p></li>
                                <li><p><span><img src="/images/blog-images/eye.png" class="img-fluid me-1"></span>200
                                        Likes</p></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-guest-layout>

