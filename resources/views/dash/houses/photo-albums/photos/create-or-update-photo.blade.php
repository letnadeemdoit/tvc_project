<x-modals.bs-modal class="modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                {{ $photo && $photo->PhotoId ? "Update" : 'Add' }} Photo</h5>
            <button
                type="button"
                class="btn-close"
                aria-label="Close"
                @click.prevent="hide()"
            ></button>
        </div>
        <div class="modal-body">

            <div class="row">

                <div class="box-2 col-12 col-lg-5">
                    <div class="result"></div>
                </div>

                <div class="box-2 col-12 col-lg-7 text-center align-self-center img-result hide">
                    <!-- result of crop -->
                    <img class="cropped" src="" alt="">


                </div>

                <div class="box d-flex justify-content-between align-items-center my-3">
                    <div class="options hide">
                        <button class="btn-primary rotate btn-sm hide">Rotate</button>
                    </div>
                    <!-- save btn -->
                </div>

                <!-- input file -->

                <div class="box d-flex justify-content-between align-items-center my-3">
                    <div class="options hide">
                        <label> Width</label>
                        <input type="number" class="img-w" value="300" min="100" max="1200"/>
                    </div>
                    <!-- save btn -->
                    <div class="">
                        <button class="btn save btn-primary btn-sm hide">Crop</button>
                        <!-- download btn -->
                    </div>
                </div>
            </div>

            <hr>

            <form wire:submit.prevent="savePhotoCU" method="post">

                <div class="mb-3">
                    <input type="file"
                           class="form-control"
{{--                           wire:model.defer="state.image"--}}
                           name=""
                           id="file-input"
                    >
                </div>

                <input type="text"
                       name="image"
                       wire:model.defer="state.image"
                       value=""
                       class="form-control" id="cropImagePath">

                <div
                    class="mb-3"
                >
                    <label class="form-label" for="description">Description</label>
                    <textarea
                        class="form-control"
                        wire:model.defer="state.description"
                        name="description"
                        placeholder=""
                        rows="6"
                        id="description"

                    ></textarea>
                </div>

                <div class="mb-3 d-flex">
                    <button type="submit" class="btn btn-primary px-5 ms-auto">
                        {{ $photo && $photo->PhotoId ? "Update" : 'Add' }} Photo
                    </button>
                </div>

            </form>
        </div>
    </div>

    @push('scripts')

        <script>
            let result = document.querySelector('.result'),
                img_result = document.querySelector('.img-result'),
                img_w = document.querySelector('.img-w'),
                img_h = document.querySelector('.img-h'),
                options = document.querySelector('.options'),
                save = document.querySelector('.save'),
                rotate = document.querySelector('.rotate'),
                cropped = document.querySelector('.cropped'),
                dwn = document.querySelector('.download'),
                upload = document.querySelector('#file-input'),
                cropper = '';

            // on change show image with crop options
            upload.addEventListener('change', (e) => {
                if (e.target.files.length) {
                    // start file reader
                    const reader = new FileReader();
                    reader.onload = (e)=> {
                        if(e.target.result){
                            // create new image
                            let img = document.createElement('img');


                            img.id = 'image';
                            img.src = e.target.result
                            // clean result before
                            result.innerHTML = '';
                            // append new image
                            result.appendChild(img);
                            // show save btn and options
                            save.classList.remove('hide');
                            options.classList.remove('hide');
                            // init cropper
                            cropper = new Cropper(img);


                        }
                    };
                    reader.readAsDataURL(e.target.files[0]);
                }
            });

            // save on click
            save.addEventListener('click',(e)=>{
                e.preventDefault();
                // get result to data uri
                let imgSrc = cropper.getCroppedCanvas({

                    width: img_w.value // input value
                }).toDataURL();

                document.getElementById('cropImagePath').value = imgSrc;

                @this.set('state.image',imgSrc,true)

                cropped.classList.remove('hide');
                img_result.classList.remove('hide');
                // show image cropped
                cropped.src = imgSrc;
                dwn.classList.remove('hide');
                dwn.download = 'imagename.png';
                dwn.setAttribute('href',imgSrc);
            });
            function handleCropChange() {
                console.log("## cropped !");
                const croppedImgData = cropper.getCroppedCanvas({

                    width: img_w.value // input value
                }).toDataURL();

                @this.set('state.image',croppedImgData,true)

                // this.setState({ croppedImgSrc: croppedImgData });
            }
            rotate.addEventListener('click',(e)=>{
                e.preventDefault();
                // get result to data uri
                console.log(cropper);
                cropper.rotate(90);
                handleCropChange();

            });
        </script>

    @endpush

</x-modals.bs-modal>
