@props(['multiple' => false, 'title' => 'Drag and drop your file here'])
<div
    class="mb-2"
    x-data="{
        isUploadingFile: false,
        uploadingProgress: 0,
        previewAndEdit: false,
        files: [],
        errors: [],
        cropper: null,
        isCropEnabled: false,
        multiple: !!{{ $multiple ? 1 : 0 }},
        startUploading() {
            this.isUploadingFile = true;
            this.previewAndEdit = false;
            $('.btn-close').attr('disabled', true);
            this.cropper.getCroppedCanvas().toBlob((blob) => {
                this.files[0] = blob;
                @this.upload('{{ $attributes->get('wire:model') }}', blob, (uploadedFilename) => {
                    this.isUploadingFile = false;
                    $('.btn-close').attr('disabled', null);

                }, () => {
                    this.isUploadingFile = false;
                     $('.btn-close').attr('disabled', null);
                }, (event) => {
                    this.uploadingProgress = event.detail.progress;
                });

                this.cropper.destroy();
                this.cropper = null;
            });
        },
        validateAndPreviewImages() {
            this.errors = [];
            var allowedExtensions = /(\/jpg|\/jpeg|\/png|\/gif)$/i;

            this.files = this.files.filter(f => {
                if (!allowedExtensions.exec(f.type)) {
                    this.errors.push(f.name);
                }

               return allowedExtensions.exec(f.type);
            });

            this.previewAndEdit = this.errors.length === 0;

            if (this.previewAndEdit) {
                setTimeout(() => {
                    this.cropper = new Cropper($refs.cropper, {
                        autoCrop: false,
                        crop: (event) => {
                            this.isCropEnabled = true;
                        }
                    });

                }, 200)
            }
        }
    }"
    @modal-is-hidden.window="errors = []; files = []; uploadingProgress = 0; cropper = null; previewAndEdit = false;"
    @upload-dropzone-reset.window="errors = []; files = []; uploadingProgress = 0; cropper = null; previewAndEdit = false;"
>
    <div x-show="previewAndEdit">
        <template x-for="(f, i) in files" :key="i">
            <div class="position-relative">

                <img :src="files.length > 0 ? URL.createObjectURL(files[0]) : null" x-ref="cropper" style="max-height: 400px"/>
             <div class="text-center">
                 <div class="mt-2 mb-1" style="bottom: 10px; right: 10px; z-index: 100">
                     <a
                         href="#"
                         class="btn btn-primary btn-xs"
                         @click.prevent="isCropEnabled ? cropper.clear() : cropper.crop(); isCropEnabled = !isCropEnabled"
                     >
                         <i class="bi bi-crop"></i>
                     </a>
                     <a
                         href="#"
                         class="btn btn-primary btn-xs"
                         @click.prevent="cropper.rotate(-45)"
                     >
                         <i class="bi bi-arrow-counterclockwise"></i>
                     </a>
                     <a
                         href="#"
                         class="btn btn-primary btn-xs"
                         @click.prevent="cropper.rotate(45)"
                     >
                         <i class="bi bi-arrow-clockwise"></i>
                     </a>
                     <a
                         href="#"
                         class="btn btn-primary btn-xs"
                         @click.prevent="cropper.reset()"
                     >
                         <i class="bi bi-arrow-repeat"></i>
                     </a>
                     <a
                         href="#"
                         class="btn btn-primary btn-xs"
                         @click.prevent="errors = []; files = []; uploadingProgress = 0; cropper = null; previewAndEdit = false"
                     >
                         <i class="bi bi-x"></i>
                     </a>
                     <a
                         href="#"
                         class="btn btn-primary btn-xs"
                         @click.prevent="startUploading()"
                     >
{{--                         <i class="bi bi-check2"></i>--}}
                         Save
                     </a>
                 </div>
                 <p class="text-danger fs-12" x-show="files.length > 0">Click <b>save</b> button to upload your image otherwise it will not be uploaded.</p>
             </div>

            </div>

        </template>
    </div>
    <div
        x-show="!previewAndEdit"
        class="js-dropzone row dz-dropzone dz-dropzone-card border-primary bg-primary-light mx-auto"
        x-on:drop="isFileDropping = false"
        x-on:drop.prevent="
            if ($event.dataTransfer.files.length > 0 ) {
                files = multiple ? Array.from($event.dataTransfer.files) : [$event.dataTransfer.files[0]];
                validateAndPreviewImages();
            }
        "
        x-on:dragover.prevent="isFileDropping = true"
        x-on:dragleave.prevent="isFileDropping = false"
    >
        <div class="dz-message">
            <h5>{{ $title }}</h5>
            <p class="mb-2">or</p>
            <div class="text-center">
                <input
                    id="file_upload"
                    type="file"
                    name="image"
                    hidden="hidden"
                    x-ref="file_upload"
                    x-on:change.prevent="files = Array.from($el.files); validateAndPreviewImages();"
                    {{ $multiple ? 'multiple' : '' }}
                />
                <button class="btn bg-primary btn-sm text-white" onclick="event.preventDefault(); document.getElementById('file_upload').value = null; document.getElementById('file_upload').click(); ">Upload Image</button>
            </div>
        </div>

        <h5 class="mt-3" style="display: none" x-show="errors.length > 0">Following file's can't upload, allowed file types are jpg, jpeg, png, tiff etc:</h5>
        <ul class="ms-5" x-show="errors.length > 0">
            <template x-for="(e,i) in errors" :key="i">
                <li x-text="e" class="text-danger"></li>
            </template>
        </ul>
        <div class="row ms-0" :class="{'mt-3': files.length > 0}">
            <template x-for="(f, i) in files" :key="i">
                <div class="col-md-2 mx-auto">
                    <img :src="URL.createObjectURL(f)" class="img-fluid" draggable="false"/>
                </div>
            </template>
        </div>

        <div class="px-5">
            <div class="progress mt-3" style="display: none" x-show="isUploadingFile">
                <div
                    class="progress-bar"
                    role="progressbar"
                    :style="`width: ${uploadingProgress}%`"
                    :aria-valuenow="uploadingProgress"
                    aria-valuemin="0"
                    aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</div>
