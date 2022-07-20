<x-guest-layout>
    @push('stylesheets')

    @endpush

    @include('partials.sub-page-hero-section',["title" => 'Bulletin Board']);
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
{{--                            <section class="text-end">--}}
{{--                                <img src="/images/bulletin-images/Combined Shape.png" class="img-fluid bg-dots-orange" />--}}
{{--                            </section>--}}
                         <div class="row">
                             @foreach($boards as $key => $board)
                             <div class="col-12 col-md-6 col-lg-3">
                                 <div class="card">
                                     <img src="/images/bulletin-images/house-1.png" class="card-img-top" alt="..." />
                                     <div class="card-body">
                                         <h3 class="card-title">Beach House</h3>
                                         <div class="card-text">
                                             @if(isset($board))
                                             {{ isset($board->Board) ? Str::limit(strip_tags($board->Board), 10) : ''}}</td>
                                             @endif
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             @endforeach
                         </div>
{{--                            <section class="text-center">--}}
{{--                                <img src="/images/bulletin-images/dark-dots.png" class="img-fluid cards-dots-green" />--}}
{{--                            </section>--}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</x-guest-layout>

