<x-modals.bs-modal class="modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $boardItem && $boardItem->id ? "Update" . ($boardItem->title ? " '$boardItem->title'" : '') : 'Add' }} Board Item</h5>
            <button
                type="button"
                class="btn-close"
                aria-label="Close"
                @click.prevent="hide()"
            ></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent="saveBulletinBoardCU" method="post">
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
                >
                    <label class="form-label" for="">Board Image</label>
                    <div class="js-dropzone row dz-dropzone dz-dropzone-card border-primary bg-primary-light mx-auto">
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
                                        data-dz-uploadprogress></div>
                                </div>
                                <div class="d-flex align-items-center">
                                </div>
                            </div>
                        </div>

                        @if($boardItem && !is_null($boardItem->image))
                            <div class="col h-100 mt-4">
                                <div class="dz-preview dz-file-preview">
                                    <a href="#" class="d-flex justify-content-end dz-close-icon text-decoration-none"
                                       @click.prevent="">
                                        <small class="bi-x" data-dz-remove></small>
                                    </a>
                                    <div class="dz-details d-flex">
                                        <div class="dz-img flex-shrink-0">
                                            <img class="img-fluid dz-img-inner" data-dz-thumbnail src="{{ $boardItem->getFileUrl() }}"/>
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
                    </div>
                    <span class="showErrorMsg fw-semi-bold mt-1" style="font-size: 13px !important;color: #ff0000 !important;display: none">Only jpg,png,giff,tiff are allowed</span>
                    @error('file')
                        <span class="invalid-feedback d-block">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="exampleFormControlSelect1">Select Category</label>
                    <select id="exampleFormControlSelect1" class="form-control">
                        <option>Choose Category</option>
                        <option>category one</option>
                        <option>category two</option>
                        <option>category three</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="title">Title</label>
                    <input
                        type="text"
                        id="title"
                        wire:model.defer="state.title"
                        name="title"
                        class="form-control @error('title') is-invalid @enderror"
                        placeholder="Board Title"
                    />
                    @error('title')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>

                <div
                    class="mb-3"
                    @modal-is-shown.window="
                        window.tinymce.init({
                        ...window.TINYMCE_DEFAULT_CONFIG,
                        selector: 'textarea#board_textarea',
                        setup: function(editor) {
                                editor.on('change', function(e) {
                                    @this.set('state.Board', editor.getContent());
                                    console.log(editor.getContent());
                                });
                            }
                        })
                    "

                >
                    <label class="form-label" for="board_textarea">Board Detail</label>
                    <textarea
                        class="form-control @error('Board') is-invalid @enderror"
                        wire:model.defer="state.Board"
                        name="Board"
                        placeholder=""
                        rows="4"
                        id="board_textarea"

                    ></textarea>
                    @error('Board')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-3 d-flex">
                    <button type="submit" class="btn btn-primary px-5 ms-auto">{{ $boardItem && $boardItem->id ? "Update" . ($boardItem->title ? " '$boardItem->title'" : '') : 'Add' }} Board Item</button>
                </div>

            </form>
        </div>
    </div>
</x-modals.bs-modal>
