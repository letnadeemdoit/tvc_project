<x-modals.bs-modal class="modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                {{ $blogItem && $blogItem->BlogId ? "Update" : 'Add' }}
                 Blog</h5>
            <button
                type="button"
                class="btn-close"
                aria-label="Close"
                @click.prevent="hide()"
            ></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent="saveBlogItemCU" method="post">
                <div
                    class="mb-3"
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
                    @modal-is-showing
                >

{{--                    <label class="form-label" for="">Upload Your Visit Selfie</label>--}}
                    <div class="js-dropzone row dz-dropzone dz-dropzone-card border-primary bg-primary-light mx-auto">
                        @if($blogItem && !is_null($blogItem->BlogImage))
                            {{--           TODO:  need to fix the design               --}}
                            <div class="col h-100">
                                <div class="dz-preview dz-file-preview">
                                    <a href="#" class="d-flex justify-content-end dz-close-icon text-decoration-none"
                                       wire:click.prevent="deleteFile">
                                        <small class="bi-x" data-dz-remove></small>
                                    </a>
                                    <div class="dz-details d-flex">
                                        <div class="dz-img flex-shrink-0">
                                            <img class="img-fluid dz-img-inner" data-dz-thumbnail src="{{ $blogItem->getFileUrl('BlogImage') }}"/>
                                        </div>

                                        <div class="dz-file-wrapper flex-grow-1">
                                            <h6 class="dz-filename">
                                                @if($file)
                                                    <span class="dz-title" data-dz-name>
                                                        {{ $file->getClientOriginalName() }}
                                                    </span>
                                                @endif
                                            </h6>
                                            <div class="dz-size" data-dz-size></div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                    </div>
                                </div>
                            </div>
                        @endif
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
                                    accept=".jpg,.png,.jpeg,.gif,.tiff"
                                />
                                <button class="btn bg-primary btn-sm text-white"
                                        @click.prevent="$refs.file_upload.click()">Upload Image
                                </button>
                            </div>
                        </div>
                        <div class="col h-100 mt-4" style="display: none" x-show="isUploadingFile">
                            <div class="dz-preview dz-file-preview">
                                <a href="#" class="d-flex justify-content-end dz-close-icon text-decoration-none"
                                   @click.prevent="$wire.set('file', null); isUploadingFile = false">
                                    <small class="bi-x" data-dz-remove></small>
                                </a>
                                <div class="dz-details d-flex">
                                    <div class="dz-img flex-shrink-0">
                                        @if($file && in_array($file->getClientOriginalExtension(), config('livewire.temporary_file_upload.preview_mimes')))
                                            <img class="img-fluid dz-img-inner" data-dz-thumbnail
                                                 src="{{ $file->temporaryUrl() }}"/>
                                        @endif
                                    </div>

                                    <div class="dz-file-wrapper flex-grow-1">
                                        <h6 class="dz-filename">
                                            @if($file)
                                                <span class="dz-title" data-dz-name>
                                                    {{ $file->getClientOriginalName() }}
                                                </span>
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
                                        data-dz-uploadprogress>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="showErrorMsg fw-semi-bold mt-1" style="font-size: 13px !important;color: #ff0000 !important;display: none">Only jpg,png,giff,tiff are allowed</span>
                    @error('image')
                    <span class="invalid-feedback d-block">{{$message}}</span>
                    @enderror
                </div>

                <div class="row">

                    <div class="mb-3 col-12 col-lg-12">
                        <label class="form-label" for="title">Subject</label>
                        <input
                            type="text"
                            id="Subject"
                            wire:model.defer="state.Subject"
                            name="Subject"
                            class="form-control @error('Subject') is-invalid @enderror"
                            placeholder="Subject"
                        />
                        @error('Subject')
                        <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>


                </div>

                <div class="row">
                    <div class="mb-3 col-12 col-lg-12">
                        <label class="form-label" for="exampleFormControlSelect1">Select Category</label>
                        <select id="exampleFormControlSelect1" class="form-control">
                            <option>Beach House</option>
                            <option>Town House</option>
                            <option>Tiny House</option>
                            <option>Pool House</option>
                        </select>
                    </div>
                </div>
                <div class="row">


                    <div
                        class="mb-3"
                        @modal-is-shown.window="
                        window.tinymce.init({
                        ...window.TINYMCE_DEFAULT_CONFIG,
                        selector: 'textarea#Content',
                        setup: function(editor) {
                                editor.on('change', function(e) {
                                    @this.set('state.Content', editor.getContent(), true);
                                });
                            }
                        })
                    "

                    >
                        <label class="form-label" for="board_textarea">Content</label>
                        <textarea
                            class="form-control @error('Content') is-invalid @enderror"
                            wire:model.defer="state.Content"
                            name="Content"
                            placeholder=""
                            rows="3"
                            id="Content"

                        ></textarea>
                        @error('Content')
                        <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>


{{--                    <div class="mb-3 col-12 col-lg-12">--}}
{{--                        <label class="form-label" for="title">Content</label>--}}
{{--                        <textarea--}}
{{--                            class="form-control @error('Content') is-invalid @enderror"--}}
{{--                            wire:model.defer="state.Content"--}}
{{--                            name="Content"--}}
{{--                            placeholder="Content"--}}
{{--                            rows="4"--}}
{{--                            id="board_textarea"--}}

{{--                        ></textarea>--}}
{{--                        @error('Content')--}}
{{--                        <span class="invalid-feedback">{{$message}}</span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}


                </div>



                <div class="mb-3 d-flex">
                    <button type="submit" class="btn btn-primary px-5 ms-auto">
                        {{ $blogItem && $blogItem->BlogId ? "Update" : 'Add' }} Blog Item
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-modals.bs-modal>
