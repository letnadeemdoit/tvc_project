<div
    class="mb-2"
    x-data="{isFileDropping: false, isUploadingFile: false, uploadingProgress: 0}"
    x-on:drop="isFileDropping = false"
    x-on:drop.prevent="

                if ($event.dataTransfer.files.length > 0 ) {
                    isUploadingFile = true;
                    var allowedExtensions = /(\/jpg|\/jpeg|\/png|\/gif)$/i;
                    var fileTypeCheck = $event.dataTransfer.files[0].type;
                    if (!allowedExtensions.exec(fileTypeCheck)) {

                        $('.showErrorMsg').addClass('d-block');

                        return;
                     }

                        $('.showErrorMsg').addClass('d-none');

                    @this.upload( 'file', $event.dataTransfer.files[0],
                        (uploadedFilename) => {
                        }, () => {

                        }, (event) => {
                            uploadingProgress = event.detail.progress;
                        });
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
                    wire:model="file"
                    x-ref="file_upload"
                />
                <button class="btn bg-primary btn-sm text-white" @click.prevent="$refs.file_upload.click()">Upload Image</button>
            </div>
        </div>
        <div class="col h-100 mt-4" style="display: none" x-show="isUploadingFile">
            <div class="dz-preview dz-file-preview">
                <a href="#" class="d-flex justify-content-end dz-close-icon text-decoration-none"  @click.prevent="$wire.set('file', null); isUploadingFile = false">
                    <small class="bi-x" data-dz-remove></small>
                </a>
                <div class="dz-details d-flex">
                    <div class="dz-img flex-shrink-0">
                        @if($file)
                            <img
                                class="img-fluid dz-img-inner" data-dz-thumbnail
                                src="{{ $file->temporaryUrl() }}"
                            />
                        @endif
                    </div>

                    <div class="dz-file-wrapper flex-grow-1">
                        <h6 class="dz-filename">
                            @if($file)
                                <span class="dz-title" data-dz-name>{{ $file->getClientOriginalName() }}</span>
                            @endif
                        </h6>
                        <div class="dz-size" data-dz-size></div>
                    </div>
                </div>
                <div class="dz-progress progress">
                    <div
                        class="dz-upload progress-bar bg-success"
                        role="progressbar"
                        x-bind:style="'width:' + `${uploadingProgress}%`"
                        aria-valuenow="0"
                        aria-valuemin="0"
                        aria-valuemax="100"
                        data-dz-uploadprogress></div>
                </div>
                <div class="d-flex align-items-center">
                    {{--                            <div class="dz-success-mark  ">--}}
                    {{--                                <span class="bi-check-lg"></span>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="dz-error-mark">--}}
                    {{--                                <span class="bi-x-lg"></span>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="dz-error-message">--}}
                    {{--                                <small data-dz-errormessage></small>--}}
                    {{--                            </div>--}}
                </div>
            </div>
        </div>
    </div>


    <span class="showErrorMsg fw-semi-bold mt-1"
          style="font-size: 13px !important;color: #ff0000 !important;display: none"> Only jpg,png,giff,tiff are allowed</span>
    @error('image')
    <span class="text-danger fw-semi-bold"
          style="font-size: 13px !important; ">{{$message}}</span>
    @enderror
</div>
