<x-modals.bs-modal class="modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Board Item</h5>
            <button
                type="button"
                class="btn-close"
                aria-label="Close"
                @click.prevent="hide()"
            ></button>
        </div>
        <div class="modal-body">
            <form

                @if(isset($boardItem))
                wire:submit.prevent="updateBulletinBoard"
                @else
                wire:submit.prevent="createBulletinBoard"
                @endif

                method="post">
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
                                        @if($file)
                                            <img class="img-fluid dz-img-inner" data-dz-thumbnail src="{{ $file->temporaryUrl() }}"/>
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
                                </div>
                            </div>
                        </div>

                        @if($OldImage)
                            <div class="col-6 mt-4 mx-auto">
                                <div class="dz-preview dz-file-preview">
                                    <a href="#" class="d-flex justify-content-end dz-close-icon text-decoration-none"
                                       @click.prevent="$wire.set('OldImage', null); isUploadingFile = false">
                                        <h1 class="bi-x" title="Remove Image" data-dz-remove></h1>
                                    </a>

                                    <div class="dz-details d-flex">
                                        <div class="dz-img flex-shrink-0">
                                            <img id="blah" class="img-fluid dz-img-inner"
                                                 src="{{ asset('storage/'.$OldImage) }}" alt="your image"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                    </div>

                    <span class="showErrorMsg fw-semi-bold mt-1"
                          style="font-size: 13px !important;color: #ff0000 !important;display: none"> Only jpg,png,giff,tiff are allowed</span>
                    @error('image')
                    <span class="text-danger fw-semi-bold"
                          style="font-size: 13px !important; ">{{$message}}</span>
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
                    <input type="text" id="title" wire:model.defer="state.title" name="title" class="form-control"
                           placeholder="Board Title">
                    @error('title')
                    <span class="text-danger fw-semi-bold"
                          style="font-size: 13px !important;">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="Board">Board Detail</label>
                    <textarea id="Board" class="form-control" wire:model.defer="state.Board" name="Board"
                              placeholder="Textarea field" rows="4"></textarea>
                    @error('Board')
                    <span class="text-danger fw-semi-bold"
                          style="font-size: 13px !important;">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <button class="btn btn-primary px-5">Create Bulletin Board</button>
                </div>

            </form>
        </div>
    </div>
</x-modals.bs-modal>
