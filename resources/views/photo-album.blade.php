<x-guest-layout>
    @push('stylesheets')

        <style>
            @charset "UTF-8";

            .card-columns {
                -moz-column-count: 1;
                column-count: 1;
            }

            @media (min-width: 768px) {
                .card-columns {
                    -moz-column-count: 2;
                    column-count: 2;
                }
            }

            @media (min-width: 1200px) {
                .card-columns {
                    -moz-column-count: 3;
                    column-count: 3;
                }
            }

            .card-img-overlay .card-block {
                position: absolute;
                /* top: 0; */
                right: 0;
                bottom: 10px;
                left: 0;
                padding: 1.25rem;
                z-index: 1;
            }
            .card-img-overlay::after {
                content: "";
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                z-index: 0;
                background-color:transparent;
                transition: all 0.3s ease-in-out;
            }

            .card-img-overlay:hover::after {
                background-color: transparent;
            }
            .masonary-gallery img{
                border-radius: 6px !important;
            }

        </style>

    @endpush

    @include('partials.sub-page-hero-section', ['title' => 'Photo Album'])

    <section class=" bg-light">
        <div class="section-padding">
        <div class="bg-album shadow-1-strong rounded text-center  d-flex justify-content-center align-items-center">
            <h1 class="text-primary font-vintage mb-0">Photo Album</h1>
        </div>
        <h1 class="pt-2 text-center poppins-bold">Share discoveries with community</h1>
        </div>

        @if(isset($photoAlbum) && count($photoAlbum) > 0)
            <div class="container padding-bottom">
                <div class="row masonary-gallery" data-masonry='{"percentPosition": true }'>

                    @foreach ($photoAlbum as $dt)
                        @if($loop->iteration % 3 == 0)
                            <div class="col-md-3 mb-4 more-album">
                                <div class="card border-0 text-white bg-transparent shadow-none">
                                <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-3.svg')}}"> -->
                                    <a href="{{asset('https://images.unsplash.com/photo-1660673399641-0e1bc98a7cb4?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw0M3x8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60')}}"
                                       data-lightbox="homePortfolio">
                                        <img
                                            src="{{asset('https://images.unsplash.com/photo-1660673399641-0e1bc98a7cb4?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw0M3x8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60')}}"
                                            class="card-img"/>
                                    </a>
                                    <div class="p-0">
                                        <div
                                            class="card-block d-flex w-100 justify-content-between px-2 px-lg-5 img-card-text align-items-center">
                                            <h3 class="text-white mb-0">Pathways</h3>
                                            <div class="d-flex align-items-center"><img
                                                    src="{{asset('/images/photo-album/camera.svg')}}"
                                                    class="img-fluid me-1 me-lg-2">
                                                <span>20</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($loop->iteration % 2 == 0)
                            <div class="col-md-6 mb-4 more-album">
                                <div class="card border-0 text-white bg-transparent shadow-none">
                                <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-2.svg')}}"> -->
                                    <a href="{{asset('https://images.unsplash.com/photo-1660679745214-2bf5ad599863?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw4fHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60')}}"
                                       data-lightbox="homePortfolio">
                                        <img
                                            src="{{asset('https://images.unsplash.com/photo-1660679745214-2bf5ad599863?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw4fHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60')}}"
                                            class="card-img"/>
                                    </a>
                                    <div class="p-0">
                                        <div
                                            class="card-block d-flex w-100 justify-content-between px-2 px-lg-5 img-card-text align-items-center">
                                            <h3 class="text-white mb-0">Pathways</h3>
                                            <div class="d-flex align-items-center">
                                                <img src="{{asset('/images/photo-album/camera.svg')}}"
                                                     class="img-fluid me-1 me-lg-2">
                                                <span>20</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-md-3 mb-4 more-album">
                                <div class="card border-0 text-white bg-transparent shadow-none">
                                <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-2.svg')}}"> -->
                                    <a href="{{asset('https://images.unsplash.com/photo-1660678732383-1ad7842ed297?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80')}}"
                                       data-lightbox="homePortfolio">
                                        <img
                                            src="{{asset('https://images.unsplash.com/photo-1660678732383-1ad7842ed297?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80')}}"
                                            class="card-img"/>
                                    </a>
                                    <div class="p-0">
                                        <div
                                            class="card-block d-flex w-100 justify-content-between px-2 px-lg-5 img-card-text align-items-center align-items-center">
                                            <h3 class="text-white mb-0">Pathways</h3>
                                            <div class="d-flex align-items-center">
                                                <img src="{{asset('/images/photo-album/camera.svg')}}"
                                                     class="img-fluid me-1 me-lg-2">
                                                <span>20</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>

                @if(isset($photoAlbum) && count($photoAlbum) > 9)
                    <div class="my-5 text-center">
                        <button class="btn btn-primary-light px-5" id="ViewMoreAlbum">See More Album</button>
                    </div>
                @endif
            </div>
        @endif
    </section>
    @push('scripts')
{{--        <script>--}}
{{--            lightbox.option({--}}
{{--                'resizeDuration': 200,--}}
{{--                'wrapAround': true--}}
{{--            })--}}
{{--        </script>--}}
            <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>

        <script>
            $(document).ready(function () {

                var list = $(".more-album");
                var numToShow = 9;
                var button = $("#ViewMoreAlbum");
                var numInList = list.length;
                list.hide();
                if (numInList > numToShow) {
                    button.show();
                }
                list.slice(0, numToShow).show();

                button.click(function () {
                    var showing = list.filter(':visible').length;
                    list.slice(showing - 1, showing + numToShow).fadeIn();
                    var nowShowing = list.filter(':visible').length;
                    if (nowShowing >= numInList) {
                        button.hide();
                    }
                });

            });
        </script>

    @endpush()
</x-guest-layout>
