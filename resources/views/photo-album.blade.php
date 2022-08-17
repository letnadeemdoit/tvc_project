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


            /*@-webkit-keyframes beat {*/
            /*    0% {*/
            /*        transform: scale(1);*/
            /*    }*/

            /*    100% {*/
            /*        transform: scale(1.2);*/
            /*    }*/
            /*}*/

            /*@keyframes beat {*/
            /*    0% {*/
            /*        transform: scale(1);*/
            /*    }*/

            /*    100% {*/
            /*        transform: scale(1.2);*/
            /*    }*/
            /*}*/
        </style>

    @endpush

    @include('partials.sub-page-hero-section', ['title' => 'Photo Album'])

    <section class=" bg-light pt-55">
        <div class="bg-album shadow-1-strong rounded text-center  d-flex justify-content-center align-items-center">
            <h1 class="text-primary font-vintage mb-0">Photo Album</h1>
        </div>
        <h1 class="pt-2 text-center poppins-bold">Share discoveries with community</h1>
        <div class="container my-4">
            <div class="row masonary-gallery" data-masonry='{"percentPosition": true }'>
                <div class="col-md-3 mb-3">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                        <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-2.svg')}}"> -->
                        <a href="{{asset('https://images.unsplash.com/photo-1660678732383-1ad7842ed297?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80')}}" data-lightbox="homePortfolio">
                            <img src="{{asset('https://images.unsplash.com/photo-1660678732383-1ad7842ed297?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80')}}" class="card-img rounded-0" />
                        </a>
                        <div class="p-0">
                            <div class="card-block d-flex w-100 justify-content-between px-5 img-card-text">
                                <h3 class="text-white">Pathways</h3>
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('/images/photo-album/camera.svg')}}" class="img-fluid me-2">
                                    <span>20</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                        <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-2.svg')}}"> -->
                        <a href="{{asset('https://images.unsplash.com/photo-1660679745214-2bf5ad599863?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw4fHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60')}}" data-lightbox="homePortfolio">
                            <img src="{{asset('https://images.unsplash.com/photo-1660679745214-2bf5ad599863?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw4fHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60')}}" class="card-img rounded-0" />
                        </a>
                        <div class="p-0">
                            <div class="card-block d-flex w-100 justify-content-between px-5 img-card-text">
                                <h3 class="text-white">Pathways</h3>
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('/images/photo-album/camera.svg')}}" class="img-fluid me-2">
                                    <span>20</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                        <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-3.svg')}}"> -->
                        <a href="{{asset('https://images.unsplash.com/photo-1660673399641-0e1bc98a7cb4?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw0M3x8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60')}}" data-lightbox="homePortfolio">
                            <img src="{{asset('https://images.unsplash.com/photo-1660673399641-0e1bc98a7cb4?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw0M3x8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60')}}" class="card-img rounded-0" />
                        </a>
                        <div class="p-0">
                            <div class="card-block d-flex w-100 justify-content-between px-5 img-card-text">
                                <h3 class="text-white">Pathways</h3>
                                <div class="d-flex align-items-center"> <img
                                        src="{{asset('/images/photo-album/camera.svg')}}" class="img-fluid me-2">
                                    <span>20</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                        <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-3.svg')}}"> -->
                        <a href="{{asset('https://images.unsplash.com/photo-1660679867941-2f2d560d008f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80')}}" data-lightbox="homePortfolio">
                            <img src="{{asset('https://images.unsplash.com/photo-1660679867941-2f2d560d008f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80')}}" class="card-img rounded-0" />
                        </a>
                        <div class="p-0">
                            <div class="card-block d-flex w-100 justify-content-between px-5 img-card-text">
                                <h3 class="text-white">Pathways</h3>
                                <div class="d-flex align-items-center"> <img
                                        src="{{asset('/images/photo-album/camera.svg')}}" class="img-fluid me-2">
                                    <span>20</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                        <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-3.svg')}}"> -->
                        <a href="{{asset('https://images.unsplash.com/photo-1660655641795-8a68ca5da6c5?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw1NXx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60')}}" data-lightbox="homePortfolio">
                            <img src="{{asset('https://images.unsplash.com/photo-1660655641795-8a68ca5da6c5?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw1NXx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60')}}" class="card-img rounded-0" />
                        </a>
                        <div class="p-0">
                            <div class="card-block d-flex w-100 justify-content-between px-5 img-card-text">
                                <h3 class="text-white">Pathways</h3>
                                <div class="d-flex align-items-center"> <img
                                        src="{{asset('/images/photo-album/camera.svg')}}" class="img-fluid me-2">
                                    <span>20</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                        <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-3.svg')}}"> -->
                        <a href="{{asset('https://images.unsplash.com/photo-1660659236367-710aa4ae7e19?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw2MHx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60')}}" data-lightbox="homePortfolio">
                            <img src="{{asset('https://images.unsplash.com/photo-1660659236367-710aa4ae7e19?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw2MHx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60')}}" class="card-img rounded-0" />
                        </a>
                        <div class="p-0">
                            <div class="card-block d-flex w-100 justify-content-between px-5 img-card-text">
                                <h3 class="text-white">Pathways</h3>
                                <div class="d-flex align-items-center"> <img
                                        src="{{asset('/images/photo-album/camera.svg')}}" class="img-fluid me-2">
                                    <span>20</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                        <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-3.svg')}}"> -->
                        <a href="{{asset('https://images.unsplash.com/photo-1660646654254-08a09f8589ef?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw4N3x8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60')}}" data-lightbox="homePortfolio">
                            <img src="{{asset('https://images.unsplash.com/photo-1660646654254-08a09f8589ef?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw4N3x8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60')}}" class="card-img rounded-0" />
                        </a>
                        <div class="p-0">
                            <div class="card-block d-flex w-100 justify-content-between px-5 img-card-text">
                                <h3 class="text-white">Pathways</h3>
                                <div class="d-flex align-items-center"> <img
                                        src="{{asset('/images/photo-album/camera.svg')}}" class="img-fluid me-2">
                                    <span>20</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                        <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-3.svg')}}"> -->
                        <a href="{{asset('https://images.unsplash.com/photo-1660586179082-775abddd8386?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw4M3x8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60')}}" data-lightbox="homePortfolio">
                            <img src="{{asset('https://images.unsplash.com/photo-1660586179082-775abddd8386?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw4M3x8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60')}}" class="card-img rounded-0" />
                        </a>
                        <div class="p-0">
                            <div class="card-block d-flex w-100 justify-content-between px-5 img-card-text">
                                <h3 class="text-white">Pathways</h3>
                                <div class="d-flex align-items-center"> <img
                                        src="{{asset('/images/photo-album/camera.svg')}}" class="img-fluid me-2">
                                    <span>20</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                        <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-3.svg')}}"> -->
                        <a href="{{asset('https://images.unsplash.com/photo-1660629813449-2f621228cc68?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw5N3x8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60')}}" data-lightbox="homePortfolio">
                            <img src="{{asset('https://images.unsplash.com/photo-1660629813449-2f621228cc68?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw5N3x8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60')}}" class="card-img rounded-0" />
                        </a>
                        <div class="p-0">
                            <div class="card-block d-flex w-100 justify-content-between px-5 img-card-text">
                                <h3 class="text-white">Pathways</h3>
                                <div class="d-flex align-items-center"> <img
                                        src="{{asset('/images/photo-album/camera.svg')}}" class="img-fluid me-2">
                                    <span>20</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                        <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-3.svg')}}"> -->
                        <a href="{{asset('https://images.unsplash.com/photo-1660632531779-b363f16acdbd?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80')}}" data-lightbox="homePortfolio">
                            <img src="{{asset('https://images.unsplash.com/photo-1660632531779-b363f16acdbd?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80')}}" class="card-img rounded-0" />
                        </a>
                        <div class="p-0">
                            <div class="card-block d-flex w-100 justify-content-between px-5 img-card-text">
                                <h3 class="text-white">Pathways</h3>
                                <div class="d-flex align-items-center"> <img
                                        src="{{asset('/images/photo-album/camera.svg')}}" class="img-fluid me-2">
                                    <span>20</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            })
        </script>
    @endpush()
</x-guest-layout>
