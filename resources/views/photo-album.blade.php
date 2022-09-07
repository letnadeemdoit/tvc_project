<x-guest-layout>
    @push('stylesheets')

{{--        <style>--}}
{{--            @charset "UTF-8";--}}

{{--            .card-columns {--}}
{{--                -moz-column-count: 1;--}}
{{--                column-count: 1;--}}
{{--            }--}}

{{--            @media (min-width: 768px) {--}}
{{--                .card-columns {--}}
{{--                    -moz-column-count: 2;--}}
{{--                    column-count: 2;--}}
{{--                }--}}
{{--            }--}}

{{--            @media (min-width: 1200px) {--}}
{{--                .card-columns {--}}
{{--                    -moz-column-count: 3;--}}
{{--                    column-count: 3;--}}
{{--                }--}}
{{--            }--}}

{{--            .card-img-overlay .card-block {--}}
{{--                position: absolute;--}}
{{--                /* top: 0; */--}}
{{--                right: 0;--}}
{{--                bottom: 10px;--}}
{{--                left: 0;--}}
{{--                padding: 1.25rem;--}}
{{--                z-index: 1;--}}
{{--            }--}}

{{--            .card-img-overlay::after {--}}
{{--                content: "";--}}
{{--                position: absolute;--}}
{{--                top: 0;--}}
{{--                right: 0;--}}
{{--                bottom: 0;--}}
{{--                left: 0;--}}
{{--                z-index: 0;--}}
{{--                background-color: transparent;--}}
{{--                transition: all 0.3s ease-in-out;--}}
{{--            }--}}

{{--            .card-img-overlay:hover::after {--}}
{{--                background-color: transparent;--}}
{{--            }--}}


{{--        </style>--}}

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
                padding-bottom: 13px;
                padding-left: 6px;
            }
            .masonry img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 6px;
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

            .masonary-gallery img {
                border-radius: 6px !important;
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
        <div class="container padding-bottom massonary-container mt-3">
            <div class="masonry">
                <div class="brick">
                    <div class="card border-0 text-white bg-transparent shadow-none">
                        <a class="" data-fancybox="demo"
                           data-src="https://lipsum.app/id/36/1024x768"
                           data-caption="Lorem Ipsum is simply dummy text of the printing">
                            <img src="https://lipsum.app/id/36/400x300">
                        </a>
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
                        <a class="" data-fancybox="demo" data-src="https://images.unsplash.com/photo-1620393518579-65b081581e32?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1yZWxhdGVkfDEzfHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60" data-caption="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><img src="https://images.unsplash.com/photo-1620393518579-65b081581e32?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1yZWxhdGVkfDEzfHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60"></a>
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
                        <a class="" data-fancybox="demo" data-src="https://images.unsplash.com/photo-1660659236367-710aa4ae7e19?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw2MHx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60" data-caption="Optional caption">
                            <img src="https://images.unsplash.com/photo-1660659236367-710aa4ae7e19?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw2MHx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60">
                        </a>
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
                        <a class="" data-fancybox="demo" data-src="https://lipsum.app/id/30/1024x768" data-caption="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."><img src="https://lipsum.app/id/30/400x300"></a>
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
                        <a class="" data-fancybox="demo" data-src="https://images.unsplash.com/photo-1661881781570-0f4cb16e97aa?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" data-caption="Optional caption">
                            <img src="https://images.unsplash.com/photo-1661881781570-0f4cb16e97aa?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"></a>
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
                        <a class="" data-fancybox="demo" data-src="https://images.unsplash.com/photo-1661860859715-d963b4d51268?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" data-caption="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.">
                            <img src="https://images.unsplash.com/photo-1661860859715-d963b4d51268?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"></a>
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
                        <a class="" data-fancybox="demo" data-src="https://images.unsplash.com/photo-1600614193704-17582f918bb7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735&q=80" data-caption="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.">
                            <img src="https://images.unsplash.com/photo-1600614193704-17582f918bb7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735&q=80"></a>
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
                        <a class="" data-fancybox="demo" data-src="https://images.unsplash.com/photo-1519160450767-b159c73fe437?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" data-caption="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.">
                            <img src="https://images.unsplash.com/photo-1519160450767-b159c73fe437?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"></a>
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
                        <a class="" data-fancybox="demo" data-src="https://images.unsplash.com/photo-1661796428181-ffc414240d58?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw5fHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60" data-caption="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.">
                            <img src="https://images.unsplash.com/photo-1661796428181-ffc414240d58?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw5fHx8ZW58MHx8fHw%3D&auto=format&fit=crop&w=500&q=60"></a>
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
                        <a class="" data-fancybox="demo" data-src="https://images.unsplash.com/photo-1446407113233-1ea5e2bb0752?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1480&q=80" data-caption="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.">
                            <img src="https://images.unsplash.com/photo-1446407113233-1ea5e2bb0752?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1480&q=80"></a>
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
            </div>
        </div>

    @push('scripts')

    @endpush()
</x-guest-layout>
