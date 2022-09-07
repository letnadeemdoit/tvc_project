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
                    column-count: 3;
                }
            }
            .masonry .brick {
                box-sizing: border-box;
                -webkit-column-break-inside: avoid;
                page-break-inside: avoid;
                break-inside: avoid;
                counter-increment: brick-counter;
                padding-bottom: 18px;
                margin-left: 10px;
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
        <h1 class="pt-2 text-center poppins-bold" id="page-title">Share discoveries with community</h1>
    </div>
        <livewire:photo-album.photo-album-list :user="$user" />
    @push('scripts')
    @endpush
</x-guest-layout>
