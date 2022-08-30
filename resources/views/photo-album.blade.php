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
                background-color: transparent;
                transition: all 0.3s ease-in-out;
            }

            .card-img-overlay:hover::after {
                background-color: transparent;
            }


        </style>

        <style>
            .massonary-container {
                width: 100%;
                display: block;
                margin: 0 auto;
            }
            .masonry {
                column-count: 2;
                column-gap: 5px;
            }
            @media (min-width: 768px) {
                .masonry {
                    column-count: 3;
                }
            }
            @media (min-width: 992px) {
                .masonry {
                    column-count: 4;
                }
            }
            @media (min-width: 1199px) {
                .masonry {
                    column-count: 4;
                }
            }
            .masonry .brick {
                box-sizing: border-box;
                -webkit-column-break-inside: avoid;
                page-break-inside: avoid;
                break-inside: avoid;
                counter-increment: brick-counter;
                margin-bottom: 12px;
                margin-left: 6px;
            }
            .masonry img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 6px;
            }

        </style>

    @endpush

    @include('partials.sub-page-hero-section', ['title' => 'Photo Album'])


    <div class="section-padding">
        <div class="bg-album shadow-1-strong rounded text-center  d-flex justify-content-center align-items-center">
            <h1 class="text-primary font-vintage mb-0">Photo Album</h1>
        </div>
        <h1 class="pt-2 text-center poppins-bold">Share discoveries with community</h1>
    </div>
        <div class="container padding-bottom massonary-container">
            <div class="masonry">
                <div class="brick">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                        {{--                            <a href="{{asset('https://images.unsplash.com/photo-1660678732383-1ad7842ed297?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80')}}"--}}
                        {{--                               data-lightbox="homePortfolio">--}}
                        <img
                            src="https://images.unsplash.com/photo-1661688625912-8d0191156923?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyNHx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60"
                            class="card-img"/>
                        {{--                            </a>--}}
                        <div class="p-0">
                            <div
                                class="card-block d-flex w-100 justify-content-between px-2 px-lg-4 px-xxl-5 img-card-text align-items-center align-items-center">
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
                {{--                </div>--}}
                {{--                <div class="col-md-6 mb-4">--}}
                <div class="brick">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                    <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-2.svg')}}">
                -->
                        <a href="https://images.unsplash.com/photo-1660679745214-2bf5ad599863?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw4fHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60"
                           data-lightbox="homePortfolio">
                            <img
                                src="https://images.unsplash.com/photo-1660679745214-2bf5ad599863?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw4fHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60"
                                class="card-img"/>
                        </a>
                        <div class="p-0">
                            <div
                                class="card-block d-flex w-100 justify-content-between px-2 px-lg-4 px-xxl-5 img-card-text align-items-center">
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
                {{--                </div>--}}
                {{--                    <div class="col-md-3 mb-4">--}}
                <div class="brick">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                    <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-3.svg')}}">
                -->
                        {{--                            <a href="{{asset('https://images.unsplash.com/photo-1660673399641-0e1bc98a7cb4?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw0M3x8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60')}}"--}}
                        {{--                               data-lightbox="homePortfolio">--}}
                        <img
                            src="https://images.unsplash.com/photo-1660679745214-2bf5ad599863?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw4fHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60"
                            class="card-img"/>
                        {{--                            </a>--}}
                        <div class="p-0">
                            <div
                                class="card-block d-flex w-100 justify-content-between px-2 px-lg-4 px-xxl-5 img-card-text align-items-center">
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
                <div class="brick">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                        <!-- <img class="card-img rounded-0" src="http://dev.devdimensions.com/images/photo-album/album-2.svg"> -->
                        {{--                                    <a href="https://images.unsplash.com/photo-1660678732383-1ad7842ed297?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=687&amp;q=80" data-lightbox="homePortfolio">--}}
                        <img
                            src="https://images.unsplash.com/photo-1660673399641-0e1bc98a7cb4?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw0M3x8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60">
                        {{--                                    </a>--}}
                        <div class="p-0">
                            <div
                                class="card-block d-flex w-100 justify-content-between px-2 px-lg-4 img-card-text align-items-center align-items-center">
                                <h3 class="text-white mb-0">Pathways</h3>
                                <div class="d-flex align-items-center">
                                    <img src="http://dev.devdimensions.com/images/photo-album/camera.svg"
                                         class="img-fluid me-1 me-lg-2">
                                    <span>20</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="brick">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                        <!-- <img class="card-img rounded-0" src="http://dev.devdimensions.com/images/photo-album/album-2.svg"> -->
                        {{--                                    <a href="https://images.unsplash.com/photo-1660678732383-1ad7842ed297?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=687&amp;q=80" data-lightbox="homePortfolio">--}}
                        <img src="https://images.unsplash.com/photo-1660678732383-1ad7842ed297?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=687&amp;q=80"
                             class="card-img">
                        {{--                                    </a>--}}
                        <div class="p-0">
                            <div
                                class="card-block d-flex w-100 justify-content-between px-2 px-lg-4 img-card-text align-items-center align-items-center">
                                <h3 class="text-white mb-0">Pathways</h3>
                                <div class="d-flex align-items-center">
                                    <img src="http://dev.devdimensions.com/images/photo-album/camera.svg"
                                         class="img-fluid me-1 me-lg-2">
                                    <span>20</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="brick">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                        <!-- <img class="card-img rounded-0" src="http://dev.devdimensions.com/images/photo-album/album-2.svg"> -->
                        {{--                                    <a href="https://images.unsplash.com/photo-1660678732383-1ad7842ed297?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=687&amp;q=80" data-lightbox="homePortfolio">--}}
                        <img
                            src="https://images.unsplash.com/photo-1660659236367-710aa4ae7e19?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw2MHx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60">
                        {{--                                    </a>--}}
                        <div class="p-0">
                            <div
                                class="card-block d-flex w-100 justify-content-between px-2 px-lg-4 img-card-text align-items-center align-items-center">
                                <h3 class="text-white mb-0">Pathways</h3>
                                <div class="d-flex align-items-center">
                                    <img src="http://dev.devdimensions.com/images/photo-album/camera.svg"
                                         class="img-fluid me-1 me-lg-2">
                                    <span>20</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="brick">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                        <!-- <img class="card-img rounded-0" src="http://dev.devdimensions.com/images/photo-album/album-2.svg"> -->
                        {{--                                    <a href="https://images.unsplash.com/photo-1660678732383-1ad7842ed297?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=687&amp;q=80" data-lightbox="homePortfolio">--}}
                        <img
                            src="https://source.unsplash.com/random/?tech,number">
                        {{--                                    </a>--}}
                        <div class="p-0">
                            <div
                                class="card-block d-flex w-100 justify-content-between px-2 px-lg-4 img-card-text align-items-center align-items-center">
                                <h3 class="text-white mb-0">Pathways</h3>
                                <div class="d-flex align-items-center">
                                    <img src="http://dev.devdimensions.com/images/photo-album/camera.svg"
                                         class="img-fluid me-1 me-lg-2">
                                    <span>20</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="brick">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                        <!-- <img class="card-img rounded-0" src="http://dev.devdimensions.com/images/photo-album/album-2.svg"> -->
                        {{--                                    <a href="https://images.unsplash.com/photo-1660678732383-1ad7842ed297?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=687&amp;q=80" data-lightbox="homePortfolio">--}}
                        <img src="https://images.unsplash.com/photo-1657299143549-73fb118d68aa?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"
                             class="card-img">
                        {{--                                    </a>--}}
                        <div class="p-0">
                            <div
                                class="card-block d-flex w-100 justify-content-between px-2 px-lg-4 img-card-text align-items-center align-items-center">
                                <h3 class="text-white mb-0">Pathways</h3>
                                <div class="d-flex align-items-center">
                                    <img src="http://dev.devdimensions.com/images/photo-album/camera.svg"
                                         class="img-fluid me-1 me-lg-2">
                                    <span>20</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="brick">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                    <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-2.svg')}}">
                -->
                        <a href="https://images.unsplash.com/photo-1660679745214-2bf5ad599863?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw4fHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60"
                           data-lightbox="homePortfolio">
                            <img
                                src="{{asset('https://source.unsplash.com/random/?tech,event')}}"
                                class="card-img"/>
                        </a>
                        <div class="p-0">
                            <div
                                class="card-block d-flex w-100 justify-content-between px-2 px-lg-4 px-xxl-5 img-card-text align-items-center">
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
                <div class="brick">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                    <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-2.svg')}}">
                -->
                        <a href="https://images.unsplash.com/photo-1660679745214-2bf5ad599863?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw4fHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60"
                           data-lightbox="homePortfolio">
                            <img
                                src="{{asset('https://source.unsplash.com/random/?tech,eight')}}"
                                class="card-img"/>
                        </a>
                        <div class="p-0">
                            <div
                                class="card-block d-flex w-100 justify-content-between px-2 px-lg-4 px-xxl-5 img-card-text align-items-center">
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
                <div class="brick">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                    <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-2.svg')}}">
                -->
                        <a href="https://images.unsplash.com/photo-1660679745214-2bf5ad599863?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw4fHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60"
                           data-lightbox="homePortfolio">
                            <img
                                src="{{asset('https://source.unsplash.com/random/?tech,crew')}}"
                                class="card-img"/>
                        </a>
                        <div class="p-0">
                            <div
                                class="card-block d-flex w-100 justify-content-between px-2 px-lg-4 px-xxl-5 img-card-text align-items-center">
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
                <div class="brick">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                    <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-2.svg')}}">
                -->
                        <a href="https://images.unsplash.com/photo-1660679745214-2bf5ad599863?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw4fHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60"
                           data-lightbox="homePortfolio">
                            <img
                                src="{{asset('https://images.unsplash.com/photo-1661702530984-7b8fcf108f8b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyOXx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60')}}"
                                class="card-img"/>
                        </a>
                        <div class="p-0">
                            <div
                                class="card-block d-flex w-100 justify-content-between px-2 px-lg-4 px-xxl-5 img-card-text align-items-center">
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
                <div class="brick">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                    <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-2.svg')}}">
                -->
                        <a href="https://images.unsplash.com/photo-1660679745214-2bf5ad599863?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw4fHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60"
                           data-lightbox="homePortfolio">
                            <img
                                src="{{asset('https://images.unsplash.com/photo-1661770392658-31d943ebb90c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwzNHx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60')}}"
                                class="card-img"/>
                        </a>
                        <div class="p-0">
                            <div
                                class="card-block d-flex w-100 justify-content-between px-2 px-lg-4 px-xxl-5 img-card-text align-items-center">
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
                <div class="brick">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                    <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-2.svg')}}">
                -->
                        <a href="https://images.unsplash.com/photo-1657214059139-dc58d16118ed?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxlZGl0b3JpYWwtZmVlZHw2fHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60"
                           data-lightbox="homePortfolio">
                            <img
                                src="{{asset('https://images.unsplash.com/photo-1661702530984-7b8fcf108f8b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyOXx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60')}}"
                                class="card-img"/>
                        </a>
                        <div class="p-0">
                            <div
                                class="card-block d-flex w-100 justify-content-between px-2 px-lg-4 px-xxl-5 img-card-text align-items-center">
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
                <div class="brick">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                    <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-2.svg')}}">
                -->
                        <a href="https://images.unsplash.com/photo-1661630801805-a497f4985377?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwxMHx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60"
                           data-lightbox="homePortfolio">
                            <img
                                src="{{asset('https://images.unsplash.com/photo-1661718498895-daa013f72110?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw0M3x8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60')}}"
                                class="card-img"/>
                        </a>
                        <div class="p-0">
                            <div
                                class="card-block d-flex w-100 justify-content-between px-2 px-lg-4 px-xxl-5 img-card-text align-items-center">
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
                <div class="brick">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                    <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-2.svg')}}">
                -->
                        <a href="https://images.unsplash.com/photo-1661691111071-42c262ca061e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw5fHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60"
                           data-lightbox="homePortfolio">
                            <img
                                src="{{asset('https://images.unsplash.com/photo-1661749420533-f041b343b360?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw1NXx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60')}}"
                                class="card-img"/>
                        </a>
                        <div class="p-0">
                            <div
                                class="card-block d-flex w-100 justify-content-between px-2 px-lg-4 px-xxl-5 img-card-text align-items-center">
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
                <div class="brick">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                    <!-- <img class="card-img rounded-0" src="{{asset('/images/photo-album/album-2.svg')}}">
                -->
                        <a href="https://images.unsplash.com/photo-1657299141942-3dab1b224686?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxlZGl0b3JpYWwtZmVlZHwyMXx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60"
                           data-lightbox="homePortfolio">
                            <img
                                src="{{asset('https://source.unsplash.com/random/?tech,pass')}}"
                                class="card-img"/>
                        </a>
                        <div class="p-0">
                            <div
                                class="card-block d-flex w-100 justify-content-between px-2 px-lg-4 px-xxl-5 img-card-text align-items-center">
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
                {{--                </div>--}}
                {{--            </div>--}}
            </div>
        </div>

    @push('scripts')
        {{--        <script>--}}
        {{--            lightbox.option({--}}
        {{--                'resizeDuration': 200,--}}
        {{--                'wrapAround': true--}}
        {{--            })--}}
        {{--        </script>--}}
        {{--               <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>--}}
    @endpush()
</x-guest-layout>
