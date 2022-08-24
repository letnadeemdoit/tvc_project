@props(['multiple' => false])
<div
    class="mb-2"
    x-data="{
        isUploadingFile: false,
        uploadingProgress: 0,
        files: [],
        errors: [],
        multiple: !!{{ $multiple ? 1 : 0 }},
        startUploading() {
            this.isUploadingFile = true;
            if (this.multiple) {
                @this.uploadMultiple('{{ $attributes->get('wire:model') }}', this.files,
                    (uploadedFilename) => {
                        this.isUploadingFile = false;
                    }, () => {
                        this.isUploadingFile = false;
                    }, (event) => {
                        this.uploadingProgress = event.detail.progress;
                    });
            } else {
                @this.upload('{{ $attributes->get('wire:model') }}', this.files[0],
                    (uploadedFilename) => {
                        this.isUploadingFile = false;
                    }, () => {
                        this.isUploadingFile = false;
                    }, (event) => {
                        this.uploadingProgress = event.detail.progress;
                    });
            }
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

            this.startUploading();

            console.log(this.files);
        }
    }"
    @modal-is-hidden.window="errors = []; files = []; uploadingProgress = 0;"
>
    <div
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
            <h5>Drag and drop your file here</h5>
            <p class="mb-2">or</p>
            <div class="text-center">
                <input
                    id="file_upload"
                    type="file"
                    name="image"
                    hidden="hidden"
                    x-ref="file_upload"
                    x-on:change="files = Array.from($el.files); validateAndPreviewImages()"
                    {{ $multiple ? 'multiple' : '' }}
                />
                <button class="btn bg-primary btn-sm text-white" @click.prevent="$refs.file_upload.click()">Upload Image</button>
            </div>
        </div>

        <h5 class="mt-3" style="display: none" x-show="errors.length > 0">Following file's can't upload, allowed file types are jpg, jpeg, png, tiff etc:</h5>
        <ul class="ms-5" x-show="errors.length > 0">
            <template x-for="(e,i) in errors" :key="i">
                <li x-text="e" class="text-danger"></li>
            </template>
        </ul>
        <div class="row" :class="{'mt-3': files.length > 0}">
            <template x-for="(f, i) in files" :key="i">
                <div class="col-md-2 mx-auto">
                    <img :src="URL.createObjectURL(f)" class="img-fluid"/>
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
