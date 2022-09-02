<x-dashboard-layout>

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

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a class="breadcrumb-link" href="{{ route('dash.photo-albums') }}">Photo Albums</a></li>
        <li class="breadcrumb-item active" aria-current="page">Photos</li>
    </x-slot>

    <x-slot name="title">
        Album Name: {{$album->name}}
    </x-slot>

    <x-slot name="headerRightActions">
        <div class="col-sm-auto" x-data>
            <a
                class="btn btn-primary"
                href="#!"
                @click.prevent="window.livewire.emit('showPhotoCUModal', true)"
            >
                <i class="bi-plus me-1"></i> Add New Photo
            </a>
        </div>
    </x-slot>

    <div class="content container-fluid">

        <livewire:houses.photo-albums.photos.photos-list :user="$user" :album="$album" />

        <livewire:houses.photo-albums.photos.create-or-update-photo :user="$user" :album="$album"/>

    </div>

        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>



            <script>

                var $modal = $('#modal');
                var image = document.getElementById('image');
                var cropper;

                $("body").on("change", ".image", function(e){
                    var files = e.target.files;
                    var done = function (url) {
                        image.src = url;
                        $modal.modal('show');
                    };
                    var reader;
                    var file;
                    var url;
                    if (files && files.length > 0) {
                        file = files[0];
                        if (URL) {
                            done(URL.createObjectURL(file));
                        } else if (FileReader) {
                            reader = new FileReader();
                            reader.onload = function (e) {
                                done(reader.result);
                            };
                            reader.readAsDataURL(file);
                        }
                    }
                });
                $modal.on('shown.bs.modal', function () {
                    cropper = new Cropper(image, {
                        aspectRatio: 1,
                        viewMode: 3,
                        preview: '.preview'
                    });
                }).on('hidden.bs.modal', function () {
                    cropper.destroy();
                    cropper = null;
                });
                $("#crop").click(function(){
                    canvas = cropper.getCroppedCanvas({
                        width: 160,
                        height: 160,
                    });
                    canvas.toBlob(function(blob) {
                        url = URL.createObjectURL(blob);
                        var reader = new FileReader();
                        reader.readAsDataURL(blob);
                        reader.onloadend = function() {
                            var base64data = reader.result;
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "crop-image-upload",
                                data: {'_token': $('meta[name="_token"]').attr('content'), 'image': base64data},
                                success: function(data){
                                    console.log(data);
                                    $modal.modal('hide');
                                    alert("Crop image successfully uploaded");
                                }
                            });
                        }
                    });
                });
            </script>
        @endpush
</x-dashboard-layout>

