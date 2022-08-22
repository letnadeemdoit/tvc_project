<x-app-layout>

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


    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Album Name: {{$album->name}} </h1>
                </div>

                <div class="col-sm-auto" x-data>
                    <a
                        class="btn btn-primary"
                        href="#!"
                        @click.prevent="window.livewire.emit('showPhotoCUModal', true)"
                    >
                        <i class="bi-plus me-1"></i> Add New Photo
                    </a>
                </div>

            </div>
        </div>

        <livewire:houses.photo-albums.photos.photos-list :user="$user" :album="$album" />

        <livewire:houses.photo-albums.photos.create-or-update-photo :user="$user" :album="$album"/>

    </div>

    @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>
    @endpush

</x-app-layout>
