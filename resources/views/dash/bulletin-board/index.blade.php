<x-guest-layout>
    @include('partials.sub-page-hero-section', ['title' => 'Bulletin Board']);
    <section class="bg-lightGrey">
        <div class="container  section-padding">
            <div class="row text-center">
                <div
                    class="features-img shadow-1-strong rounded  text-white d-flex justify-content-center align-items-center">
                    <h1 class="text-primary font-vintage mb-0">Bulletin Board</h1>
                </div>
                <h3 class="pt-2 poppins-bold">Choose your Category</h3>
            </div>
            <div class="mt-5  category-cards">
                <ul class="nav nav-tabs border-bottom-0" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">
                            <img src="/images/bulletin-images/shopping-bag.png" width="30px" />
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
                        <button class="nav-link" id="shopping-tab" data-bs-toggle="tab" data-bs-target="#shopping"
                                type="button" role="tab" aria-controls="shopping" aria-selected="true">
                            <img src="/images/bulletin-images/clock-img.png" width="30px" />
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="clipboard-tab" data-bs-toggle="tab" data-bs-target="#clipboard"
                                type="button" role="tab" aria-controls="clipboard" aria-selected="true">
                            <img src="/images/bulletin-images/shopping-bag.png" width="30px" />
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="gallery-tab" data-bs-toggle="tab" data-bs-target="#gallery"
                                type="button" role="tab" aria-controls="gallery" aria-selected="true">
                            <img src="/images/bulletin-images/calculator.png" width="30px" />
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="gallery-tab" data-bs-toggle="tab" data-bs-target="#gallery"
                                type="button" role="tab" aria-controls="gallery" aria-selected="true">
                            <img src="/images/bulletin-images/Photo.png" width="30px" />
                        </button>
                    </li>
                </ul>
                <!-- dots img -->

                <div class="tab-content bg-waves" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="d-flex">
                            <div class="row flex-column-reverse"
                                 style="background: url('images/bulletin-images/combined-shape.png');background-repeat: no-repeat; background-size: auto; background-position: right;">

                                @if(isset($boards))
                                    @foreach($boards as $board)
                                        @include('dash.bulletin-board.board-item-card')
                                    @endforeach
                                @endif

                                <!-- cards -->
                                <div class="col-md-3">
                                    <div class="card">
                                        <img src="/images/bulletin-images/house-3.png" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Daily Belvana Trainer</h5>
                                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Lobortis eros diam dolor in aenean natoque magna commodo.
                                                Elementum tristique nec eget.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card">
                                        <img src="/images/bulletin-images/house-4.png" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Daily Belvana Trainer</h5>
                                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Lobortis eros diam dolor in aenean natoque magna commodo.
                                                Elementum tristique nec eget.Lorem ipsum dolor sit amet, consectetur
                                                adipiscing
                                                elit. Lobortis eros diam dolor in aenean natoque.Lorem ipsum dolor sit amet,
                                                consectetur adipiscing
                                                elit. Lobortis eros diam dolor in aenean natoque magna commodo.
                                                Elementum tristique nec eget.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card">
                                        <img src="/images/bulletin-images/house-7.png" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Daily Belvana Trainer</h5>
                                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Lobortis eros diam dolor in aenean natoque magna commodo.
                                                Elementum tristique nec eget.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card">
                                        <img src="/images/bulletin-images/house-1.png" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Daily Belvana Trainer</h5>
                                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Lobortis eros diam dolor in aenean natoque magna commodo.
                                                Elementum tristique nec eget.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- cards end -->

                                <div class="d-flex">
                                    {{--                                    {!! $boards->links() !!}--}}
                                </div>
                            </div>

                            <!-- second row -->
                            <div class="row flex-column-reverse">
                                <div class="col-md-3">
                                    <div class="card">
                                        <img src="/images/bulletin-images/house-4.png" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Daily Belvana Trainer</h5>
                                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Lobortis eros diam dolor in aenean natoque magna commodo.
                                                Elementum tristique nec eget.Lorem ipsum dolor sit amet, consectetur
                                                adipiscing
                                                elit. Lobortis eros diam dolor in aenean natoque.Lorem ipsum dolor sit amet,
                                                consectetur adipiscing
                                                elit. Lobortis eros diam dolor in aenean natoque magna commodo.
                                                Elementum tristique nec eget.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card">
                                        <img src="/images/bulletin-images/house-8.png" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Daily Belvana Trainer</h5>
                                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Lobortis eros diam dolor in aenean natoque magna commodo.
                                                Elementum tristique nec eget.Lorem ipsum dolor sit amet, consectetur
                                                adipiscing
                                                elit. Lobortis eros diam dolor in aenean natoque.Lorem ipsum dolor sit amet,
                                                consectetur adipiscing
                                                elit. Lobortis eros diam dolor in aenean natoque magna commodo.
                                                Elementum tristique nec eget.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card">
                                        <img src="/images/bulletin-images/house-1.png" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Daily Belvana Trainer</h5>
                                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Lobortis eros diam dolor in aenean natoque magna commodo.
                                                Elementum tristique nec eget.Lorem ipsum dolor sit amet, consectetur
                                                adipiscing
                                                elit. Lobortis eros diam dolor in aenean natoque.Lorem ipsum dolor sit amet,
                                                consectetur adipiscing
                                                elit. Lobortis eros diam dolor in aenean natoque magna commodo.
                                                Elementum tristique nec eget.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card">
                                        <img src="/images/bulletin-images/house-10.png" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Daily Belvana Trainer</h5>
                                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing
                                                elit. Lobortis eros diam dolor in aenean natoque magna commodo.
                                                Elementum tristique nec eget.Lorem ipsum dolor sit amet, consectetur
                                                adipiscing
                                                elit. Lobortis eros diam dolor in aenean natoque.Lorem ipsum dolor sit amet,
                                                consectetur adipiscing
                                                elit. Lobortis eros diam dolor in aenean natoque magna commodo.
                                                Elementum tristique nec eget.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- second row ends -->

                        {{--                        <section class="text-center">--}}
                        {{--                            <img src="/images/bulletin-images/dark-dots.png" class="img-fluid cards-dots-green" />--}}
                        {{--                        </section>--}}
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
    </section>

</x-guest-layout>
