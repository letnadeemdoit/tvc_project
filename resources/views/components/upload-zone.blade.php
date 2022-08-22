@props(['files', ])
<div
    class="mb-2"
    x-data="{
        isFileDropping: false,
        isUploadingFile: false,
        uploadingProgress: 0,
        files: [],
        startUploading() {
            @this.upload('{{ $attributes->wire('model') }}', files,
                (uploadedFilename) => {
                }, () => {

                }, (event) => {
                    uploadingProgress = event.detail.progress;
                });
        },
        validateAndPreviewImages() {
            console.log(this.files);
            //var allowedExtensions = /(\/jpg|\/jpeg|\/png|\/gif)$/i;
            //var fileTypeCheck = $event.dataTransfer.files[0].type;
            //if (!allowedExtensions.exec(fileTypeCheck)) {
            //    return;
            //}
        }
    }"
    x-on:drop="isFileDropping = false"
    x-on:drop.prevent="
        if ($event.dataTransfer.files.length > 0 ) {
            files = $event.dataTransfer.files;
            validateAndPreviewImages();
        }
    "
    x-on:dragover.prevent="isFileDropping = true"
    x-on:dragleave.prevent="isFileDropping = false"
>
    <div id="basicExampleDropzone"
         class="js-dropzone row dz-dropzone dz-dropzone-card border-primary bg-primary-light mx-auto">
        <div class="dz-message">
            <h5>Drag and drop your file here</h5>
            <p class="mb-2">or</p>
            <div class="text-center"
                 x-on:livewire-upload-start="isUploadingFile = true"
                 x-on:livewire-upload-finish=""
                 x-on:livewire-upload-error=""
                 x-on:livewire-upload-progress="uploadingProgress = $event.detail.progress"
            >
                <input
                    id="file_upload"
                    type="file"
                    name="image"
                    hidden="hidden"
                    x-ref="file_upload"
                />
                <button class="btn bg-primary btn-sm text-white" @click.prevent="$refs.file_upload.click()">Upload Image</button>
            </div>
        </div>
        <div class="row">
            <template x-for="(f, i) in files" :key="i">
                <div class="col-md-2">
                    <img :src="URL.createObjectURL(f)" class="img-thumbnail"/>
                </div>
            </template>
        </div>
    </div>
</div>
