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
        {{--        @if(isset($blogDetail->BlogImage) && !empty($blogDetail->BlogImage))--}}
        {{--            <img src="{{ Storage::url($blogDetail->BlogImage) }}" class="w-100 blog-detail-image" alt="" />--}}
        {{--        @else--}}
        <img src="{{asset('images/blog-images/blog.png')}}" class="w-100 blog-detail-image" alt=""/>
        {{--        @endif--}}
        {{--        <img src="{{asset('images/blog-images/blog.png')}}" class="w-100 blog-detail-image" alt="">--}}
    </div>
    <main style="background-color:#fff !important;">
        <div class="container">
            <div class="card border-0 rounded-20 py-3" style="margin-top: -70px;">
                <div class="card-body">
                    {{--                <h1 class="text-w-50 lh-30">{{ $blogDetail->Subject ? $blogDetail->Subject : '' }}</h1>--}}
                 <div class="d-block d-sm-flex justify-content-between align-items-center">
                    <h1 class="lh-30 mb-0">{{$localGuide->title ?? ''}}</h1>
                     <a class="btn btn-soft-primary px-5 mt-2 mt-sm-0">Food & Drink</a>
                 </div>
                    <div class="d-flex align-items-center mt-4">
                        <div class="flex-shrink-0">
                            <img
                                class="avatar-img rounded-circle border-rounded-red"
                                src="{{ auth()->user()->profile_photo_url }}"
                                :src="avatarUrl"
                                alt="Image"
                                width="60" height="60" style="object-fit: cover"
                            />
                        </div>
                        <div class="flex-grow-1 ms-3 d-flex">
                            <div>
                                <h4 class="mb-0 text-dark" style="color: #6D6D6D">{{ auth()->user()->first_name }}</h4>
                                <p class="mb-0 py-1" style="color: #B6B4B4">
                                    <small>{{date('Y-m-d | h:m A',strtotime($localGuide->datetime))}}</small><span
                                        class="color-blue ps-2">View</span></p>
                                <div class="d-flex align-items-center ">
                                    <ul class="list-unstyled d-flex mb-0">
                                        <li><img src="{{asset('/images/local-guide/review-star.svg')}}"></li>
                                        <li><img src="{{asset('/images/local-guide/review-star.svg')}}"></li>
                                        <li><img src="{{asset('/images/local-guide/review-star.svg')}}"></li>
                                        <li><img src="{{asset('/images/local-guide/review-star.svg')}}"></li>
                                        <li><img src="{{asset('/images/local-guide/review-star.svg')}}"></li>
                                    </ul>
                                    <span class="ps-2">(34 Reviews)</span>
                                </div>
                            </div>
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


                            <li class="me-2 me-md-3"><p class="ps-0">22-10-2022 | 3:00PM
                                </p></li>
                        </ul>
                    </div>
                    <div class="py-4">

                        {!! $localGuide->description !!}
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="mb-4">
                        <div class="input-group border rounded-1" style="border-color: #E8604C35 !important;">
                            <input type="text" class="form-control border-0 outline-0"
                                   placeholder="Search local guide..."
                                   aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn bg-white"><i class="bi-search text-primary"></i></button>
                        </div>
                    </div>
                    <div class="card border-0 mb-4">
                        <div class="card-body">
                            <h4 class="mb-3">Latest  Local Guide</h4>
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
                                    <h4 class="mb-0" style="color: #6D6D6D">Auth Name</h4>
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
                                    <h4 class="fw-normal" style="color: #6D6D6D">Luxury House</h4>
                                </div>
                                <div>
                                    <p class="mb-0 border-primary category-count">5</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container my-5">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="d-flex justify-content-between">
                        <h4>{{$localGuide->comments->count()}} Reviews</h4>
                        <div><label for="">Sort By</label>
                            <select name="" id="" class="border px-3 py-1 rounded" style="background-color: #CDD0D5">
                                <option value="">oldest</option>
                                <option value="">oldest</option>
                                <option value="">oldest</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row py-5 my-4">
                <div class="col-12 col-lg-6">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <div>
                                <h1 class="text-primary">5.0</h1>
                                <div class="rate">
                                  <ul class="list-unstyled d-flex">
                                      <li><img src="{{asset('/images/local-guide/review-star.svg')}}"></li>
                                      <li><img src="{{asset('/images/local-guide/review-star.svg')}}"></li>
                                      <li><img src="{{asset('/images/local-guide/review-star.svg')}}"></li>
                                      <li><img src="{{asset('/images/local-guide/review-star.svg')}}"></li>
                                      <li><img src="{{asset('/images/local-guide/review-star.svg')}}"></li>
                                  </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row align-items-center">
                                <div class="col-1">
                                    <span>5.0</span>
                                </div>
                                <div class="col-10">
                            <div class="progress">
                                <div class="progress-bar w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                                </div>
                                <div class="col-1">
                                    <span>(45)</span>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-1">
                                    <span>4.5</span>
                                </div>
                                <div class="col-10">
                                    <div class="progress">
                                        <div class="progress-bar w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <span>(45)</span>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-1">
                                    <span>3.0</span>
                                </div>
                                <div class="col-10">
                                    <div class="progress">
                                        <div class="progress-bar w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <span>(45)</span>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-1">
                                    <span>1.0</span>
                                </div>
                                <div class="col-10">
                                    <div class="progress">
                                        <div class="progress-bar w-25" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <span>(45)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">

                </div>
            </div>
            <div class="row mb-5 mt-5">
                <div class="col-12 col-lg-6">
                    <div class="d-flex justify-content-between">
                        <h4>{{$localGuide->comments->count()}} comments</h4>
                        <div><label for="">Sort By</label>
                            <select name="" id="" class="border px-3 py-1 rounded" style="background-color: #CDD0D5">
                                <option value="">oldest</option>
                                <option value="">oldest</option>
                                <option value="">oldest</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-12 col-lg-6">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <img src="{{asset('images/images-home/smiling-girl.jpg')}}" class="rounded-circle"
                                 width="50"
                                 height="50" style="object-fit: cover" alt="...">
                        </div>

                        <div class="flex-grow-1 ms-3">
                            <form>
                                <div class="rate my-2">
                                    <input type="radio" id="star5" wire:model.defer="state.rating" name="rating" value="5"/>
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" wire:model.defer="state.rating" name="rating" value="4"/>
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" wire:model.defer="state.rating" name="rating" value="3"/>
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" wire:model.defer="state.rating" name="rating" value="2"/>
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" wire:model.defer="state.rating" name="rating" value="1"/>
                                    <label for="star1" title="text">1 star</label>
                                </div>
                                <div class="border">
                        <textarea id="Content" name="Content" wire:model.defer="Content" class="form-control"
                                  placeholder="Description"
                                  rows="6"></textarea>
                                </div>
                                @error('Content')
                                <span class="text-danger fw-semi-bold"
                                      style="font-size: 13px !important;">{{$message}}</span>
                                @enderror

                                <div class="text-start text-lg-end py-3 px-3" style="background-color: #2D394C10">
                                    <button class="btn btn-secondary px-5" style="background-color: #2D394C">Review
                                    </button>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

            <div class="row mt-5 mb-3">
                <div class="col-12 col-lg-6">
                    <div class="d-flex w-100">
                        <div class="flex-shrink-0">
                            <img src="{{asset('images/images-home/smiling-girl.jpg')}}" class="rounded-circle"
                                 width="50"
                                 height="50" style="object-fit: cover" alt="...">
                        </div>
                        <div class="flex-grow-1 ms-3 mb-3">
                            <h5 class="mb-0">Courteny Hendry</h5>
                            <div class="rate my-2">
                                <input type="radio" id="star5" wire:model.defer="state.rating" name="rating" value="5"/>
                                <label for="star5" title="text">5 stars</label>
                                <input type="radio" id="star4" wire:model.defer="state.rating" name="rating" value="4"/>
                                <label for="star4" title="text">4 stars</label>
                                <input type="radio" id="star3" wire:model.defer="state.rating" name="rating" value="3"/>
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" wire:model.defer="state.rating" name="rating" value="2"/>
                                <label for="star2" title="text">2 stars</label>
                                <input type="radio" id="star1" wire:model.defer="state.rating" name="rating" value="1"/>
                                <label for="star1" title="text">1 star</label>
                            </div>
                            <p class="mb-0" style="font-size: 12px">Ultricies ultricies interdum dolor sodales. Vitae
                                feugiat vitae vitae quis id consectetur. Aenean urna, lectus enim suscipit eget.
                                Tristique
                                bibendum nib.</p>

                        </div>
                    </div>

                </div>
            </div>

            {{--        <div class="row mt-5 mb-3">--}}
            {{--            <div class="col-12 col-lg-6">--}}
            {{--                <div class="d-flex w-100">--}}
            {{--                    <div class="flex-shrink-0">--}}
            {{--                        <img src="{{asset('images/images-home/smiling-girl.jpg')}}" class="rounded-1" width="50"--}}
            {{--                             height="50" style="object-fit: cover" alt="...">--}}
            {{--                    </div>--}}
            {{--                    <div class="flex-grow-1 ms-3 mb-3">--}}
            {{--                        <h5 class="mb-0">Courteny Hendry</h5>--}}
            {{--                        <p class="mb-0" style="font-size: 12px">Ultricies ultricies interdum dolor sodales. Vitae--}}
            {{--                            feugiat vitae vitae quis id consectetur. Aenean urna, lectus enim suscipit eget. Tristique--}}
            {{--                            bibendum nib.</p>--}}
            {{--                        <p class="mb-0" style="font-size: 12px">--}}
            {{--                            <span class="me-1">--}}
            {{--                                <a href="" class="text-muted">Like</a>--}}
            {{--                            </span>.--}}
            {{--                            <span class="mx-1">--}}
            {{--                                <a href="" class="text-muted">Reply</a>--}}
            {{--                            </span>.--}}
            {{--                            <span class="mx-1 text-muted">--}}
            {{--                                24h--}}
            {{--                            </span>--}}
            {{--                        </p>--}}
            {{--                    </div>--}}
            {{--                </div>--}}

            {{--                <div class="sub-comment ms-2 ps-2 ms-lg-5">--}}
            {{--                    <div class="d-flex w-100">--}}
            {{--                        <div class="flex-shrink-0">--}}
            {{--                            <img src="{{asset('images/images-home/smiling-girl.jpg')}}" class="rounded-1" width="50"--}}
            {{--                                 height="50" style="object-fit: cover" alt="...">--}}
            {{--                        </div>--}}
            {{--                        <div class="flex-grow-1 ms-3">--}}
            {{--                            <h5 class="mb-0">Courteny Hendry</h5>--}}
            {{--                            <p class="mb-0" style="font-size: 12px">Ultricies ultricies interdum dolor sodales. Vitae--}}
            {{--                                feugiat vitae vitae quis id consectetur. Aenean urna, lectus enim suscipit eget.--}}
            {{--                                Tristique bibendum nib.</p>--}}
            {{--                            <p class="mb-0" style="font-size: 12px">--}}
            {{--                            <span class="me-1">--}}
            {{--                                <a href="" class="text-muted">Like</a>--}}
            {{--                            </span>.--}}
            {{--                                <span class="mx-1">--}}
            {{--                                <a href="" class="text-muted">Reply</a>--}}
            {{--                            </span>.--}}
            {{--                                <span class="mx-1 text-muted">--}}
            {{--                                24h--}}
            {{--                            </span>--}}
            {{--                            </p>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}


            {{--            </div>--}}
            {{--        </div>--}}

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
                    <div class="card blog-card">
                        <div class="w-100">
                            <button class="btn  position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                                HOUSE
                            </button>
                            <a href="">
                                <img src="/images/blog-images/house-3.png" class="card-img-top  position-relative"
                                     style="height: 250px !important;object-fit: cover" alt="..."/>
                            </a>


                        </div>
                        <div class="card-body p-2">
                            <div class="w-80 mx-auto margin-negative bg-white position-relative z-index-2 p-5 rounded-3"
                                 style="height: 220px">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="user-img d-flex align-items-center">

                                        {{--                            <img src="/images/blog-images/house-7.png" class="img-fluid position-relative" alt="...">--}}
                                        <img src="/images/blog-images/rounded-image.png"
                                             class="img-fluid position-relative"
                                             alt="...">

                                        <div class="ps-3">
                                            <strong class="mb-1 text-black fs-4">John Smith</strong>
                                            <p>30 june 2020</p>
                                        </div>
                                    </div>
                                    <div class="dropdown" x-data>
                                        <button type="button"
                                                class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle list-btn"
                                                id="connectionsDropdown2" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                            <i class="bi-three-dots-vertical"></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end blog-dropdown"
                                             aria-labelledby="connectionsDropdown2">
                                            <a class="btn btn-white dropdown-item blog-dropdown-item" href="#"
                                               data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal"
                                            >
                                                <i class="bi-trash me-1"></i>Delete Blog
                                            </a>
                                            <a class="btn btn-white dropdown-item blog-dropdown-item" href="#"
                                               wire:click="getBlogId()"
                                               data-bs-toggle="modal" data-bs-target="#addBlogCommentModal">
                                                <i class="bi-pencil me-1"></i> Add Comment
                                            </a>
                                            <a class="btn btn-white dropdown-item blog-dropdown-item" href="#"
                                               @click.prevent="window.livewire.emit('readBlogComments')">
                                                <i class="bi-book me-1"></i> Read Comment
                                            </a>

                                            {{--                            <a class="dropdown-item text-danger" href="#">Delete Blog</a>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="paragraph-text pt-3 text-black text-center text-md-start">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                </div>
                            </div>
                            <div class="card-footer px-1 pb-0">
                                <ul class="d-flex list-unstyled ul-card-footer justify-content-between">
                                    <li><img src="/images/blog-images/love.png"
                                             class="img-fluid me-1"><span>200 Likes</span></li>
                                    <li><img src="/images/blog-images/comment.svg"
                                             class="img-fluid me-1"><span>Comments</span></li>
                                    <li><img src="/images/blog-images/eye.png"
                                             class="img-fluid me-1"><span>200 Views</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mb-3">
                    <div class="card blog-card">
                        <div class="w-100">
                            <button class="btn  position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                                HOUSE
                            </button>
                            <a href="">
                                <img src="/images/blog-images/house-4.png" class="card-img-top  position-relative"
                                     style="height: 250px !important;object-fit: cover" alt="..."/>
                            </a>


                        </div>
                        <div class="card-body p-2">
                            <div class="w-80 mx-auto margin-negative bg-white position-relative z-index-2 p-5 rounded-3"
                                 style="height: 220px">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="user-img d-flex align-items-center">

                                        {{--                            <img src="/images/blog-images/house-7.png" class="img-fluid position-relative" alt="...">--}}
                                        <img src="/images/blog-images/rounded-image.png"
                                             class="img-fluid position-relative"
                                             alt="...">

                                        <div class="ps-3">
                                            <strong class="mb-1 text-black fs-4">John Smith</strong>
                                            <p>30 june 2020</p>
                                        </div>
                                    </div>
                                    <div class="dropdown" x-data>
                                        <button type="button"
                                                class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle list-btn"
                                                id="connectionsDropdown2" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                            <i class="bi-three-dots-vertical"></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end blog-dropdown"
                                             aria-labelledby="connectionsDropdown2">
                                            <a class="btn btn-white dropdown-item blog-dropdown-item" href="#"
                                               data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal"
                                            >
                                                <i class="bi-trash me-1"></i>Delete Blog
                                            </a>
                                            <a class="btn btn-white dropdown-item blog-dropdown-item" href="#"
                                               wire:click="getBlogId()"
                                               data-bs-toggle="modal" data-bs-target="#addBlogCommentModal">
                                                <i class="bi-pencil me-1"></i> Add Comment
                                            </a>
                                            <a class="btn btn-white dropdown-item blog-dropdown-item" href="#"
                                               @click.prevent="window.livewire.emit('readBlogComments')">
                                                <i class="bi-book me-1"></i> Read Comment
                                            </a>

                                            {{--                            <a class="dropdown-item text-danger" href="#">Delete Blog</a>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="paragraph-text pt-3 text-black text-center text-md-start">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                </div>
                            </div>
                            <div class="card-footer px-1 pb-0">
                                <ul class="d-flex list-unstyled ul-card-footer justify-content-between">
                                    <li><img src="/images/blog-images/love.png"
                                             class="img-fluid me-1"><span>200 Likes</span></li>
                                    <li><img src="/images/blog-images/comment.svg"
                                             class="img-fluid me-1"><span>Comments</span></li>
                                    <li><img src="/images/blog-images/eye.png"
                                             class="img-fluid me-1"><span>200 Views</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mb-3">
                    <div class="card blog-card">
                        <div class="w-100">
                            <button class="btn  position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                                HOUSE
                            </button>
                            <a href="">
                                <img src="/images/blog-images/house-5.png" class="card-img-top  position-relative"
                                     style="height: 250px !important;object-fit: cover" alt="..."/>
                            </a>


                        </div>
                        <div class="card-body p-2">
                            <div class="w-80 mx-auto margin-negative bg-white position-relative z-index-2 p-5 rounded-3"
                                 style="height: 220px">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="user-img d-flex align-items-center">

                                        {{--                            <img src="/images/blog-images/house-7.png" class="img-fluid position-relative" alt="...">--}}
                                        <img src="/images/blog-images/rounded-image.png"
                                             class="img-fluid position-relative"
                                             alt="...">

                                        <div class="ps-3">
                                            <strong class="mb-1 text-black fs-4">John Smith</strong>
                                            <p>30 june 2020</p>
                                        </div>
                                    </div>
                                    <div class="dropdown" x-data>
                                        <button type="button"
                                                class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle list-btn"
                                                id="connectionsDropdown2" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                            <i class="bi-three-dots-vertical"></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end blog-dropdown"
                                             aria-labelledby="connectionsDropdown2">
                                            <a class="btn btn-white dropdown-item blog-dropdown-item" href="#"
                                               data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal"
                                            >
                                                <i class="bi-trash me-1"></i>Delete Blog
                                            </a>
                                            <a class="btn btn-white dropdown-item blog-dropdown-item" href="#"
                                               wire:click="getBlogId()"
                                               data-bs-toggle="modal" data-bs-target="#addBlogCommentModal">
                                                <i class="bi-pencil me-1"></i> Add Comment
                                            </a>
                                            <a class="btn btn-white dropdown-item blog-dropdown-item" href="#"
                                               @click.prevent="window.livewire.emit('readBlogComments')">
                                                <i class="bi-book me-1"></i> Read Comment
                                            </a>

                                            {{--                            <a class="dropdown-item text-danger" href="#">Delete Blog</a>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="paragraph-text pt-3 text-black text-center text-md-start">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                </div>
                            </div>
                            <div class="card-footer px-1 pb-0">
                                <ul class="d-flex list-unstyled ul-card-footer justify-content-between">
                                    <li><img src="/images/blog-images/love.png"
                                             class="img-fluid me-1"><span>200 Likes</span></li>
                                    <li><img src="/images/blog-images/comment.svg"
                                             class="img-fluid me-1"><span>Comments</span></li>
                                    <li><img src="/images/blog-images/eye.png"
                                             class="img-fluid me-1"><span>200 Views</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-guest-layout>


{{--<div class="container my-5">--}}
{{--    <div class="row my-5">--}}

{{--        <div class="col-lg-6">--}}
{{--            --}}{{--  comment Compenent--}}
{{--            <livewire:comment.comment-form :local-guide="$localGuide" />--}}
{{--        </div>--}}

{{--        <div class="col-lg-6">--}}
{{--            --}}{{--  Star Rating Component--}}
{{--            <livewire:review.review-form :local-guide="$localGuide" />--}}
{{--        </div>--}}

{{--    </div>--}}
{{--</div>--}}
