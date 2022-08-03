<div>

    <div class="row">
        @foreach($photos as $photo)

            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="card ">
                    <div class="w-100">
                        <button class="btn  position-absolute text-index featured-btn mt-3 ms-3">FEATURE
                            HOUSE</button>
                        <img src="{{$photo->image}}"  style="max-height: 240px" class="card-img-top  position-relative" alt="..." />
                    </div>
                    <div class="card-body">
                        <div class="w-80 mx-auto margin-negative bg-white position-relative z-index-2 p-5 rounded-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="user-img d-flex">
                                    <div class="list-unstyled ul-card-footer">
                                        <p class="mb-0"><span><img src="/images/blog-images/chat.png" class="img-fluid me-1"></span>20 Comments</p>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="connectionsDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi-three-dots-vertical"></i>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="connectionsDropdown2">
                                        <a class="dropdown-item" href="#">Share connection</a>
                                        <a class="dropdown-item" href="#">Block connection</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="#">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <div class="paragraph-text pt-3">
                                <p>	Hi Everyone! I am excited us  to know about house.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        @endforeach
    </div>


    {{--    Create Photo Album Model--}}

    <div class="modal fade hideableModal createOrUpdateModal" id="createPhotoAlbum" tabindex="-1"
         aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-primary" id="exampleModalLabel">
                        save
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="">
                    <form
                        wire:submit.prevent="createPhotoAlbum"
                    >
                        <div class="row">

                            <div class="mb-3">
                                <label class="form-label" for="parent_id">Album Id</label>
                                <input type="text" class="form-control" value="{{$albumID}}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="parent_id">Upload Image</label>
                                <input type="file" class="form-control" >
                            </div>





                            {{--                            <div class="mb-3">--}}
{{--                                <div--}}
{{--                                    class=""--}}
{{--                                    x-data="{isFileDropping: false, isUploadingFile: false, uploadingProgress: 0}"--}}
{{--                                    x-on:drop="isFileDropping = false"--}}
{{--                                    x-on:drop.prevent="--}}
{{--                                    if ($event.dataTransfer.files.length > 0) {--}}
{{--                                        isUploadingFile = true;--}}
{{--                                        @this.upload( 'file', $event.dataTransfer.files[0],--}}
{{--                                            (uploadedFilename) => {--}}

{{--                                            }, () => {--}}

{{--                                            }, (event) => {--}}
{{--                                                uploadingProgress = event.detail.progress;--}}
{{--                                            });--}}
{{--                                    }--}}
{{--                                "--}}
{{--                                    x-on:dragover.prevent="isFileDropping = true"--}}
{{--                                    x-on:dragleave.prevent="isFileDropping = false"--}}
{{--                                >--}}
{{--                                    <div id="basicExampleDropzone"--}}
{{--                                         class="js-dropzone row dz-dropzone dz-dropzone-card border-primary bg-primary-light mx-auto">--}}
{{--                                        <div class="dz-message">--}}
{{--                                            <h5>Drag and drop your file here</h5>--}}
{{--                                            <p class="mb-2">or</p>--}}
{{--                                            <div class="text-center"--}}
{{--                                                 x-on:livewire-upload-start="isUploadingFile = true"--}}
{{--                                                 x-on:livewire-upload-finish=""--}}
{{--                                                 x-on:livewire-upload-error=""--}}
{{--                                                 x-on:livewire-upload-progress="uploadingProgress = $event.detail.progress"--}}
{{--                                            >--}}
{{--                                                <input--}}
{{--                                                    id="file_upload"--}}
{{--                                                    type="file"--}}
{{--                                                    hidden="hidden"--}}
{{--                                                    wire:model="file"--}}
{{--                                                    x-ref="file_upload"--}}
{{--                                                />--}}
{{--                                                <button class="btn bg-primary btn-sm text-white" @click.prevent="$refs.file_upload.click()">Upload Image</button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col h-100 mt-4" style="display: none" x-show="isUploadingFile">--}}
{{--                                            <div class="dz-preview dz-file-preview">--}}
{{--                                                <a href="#" class="d-flex justify-content-end dz-close-icon text-decoration-none"  @click.prevent="$wire.set('file', null); isUploadingFile = false">--}}
{{--                                                    <small class="bi-x" data-dz-remove></small>--}}
{{--                                                </a>--}}
{{--                                                <div class="dz-details d-flex">--}}
{{--                                                    <div class="dz-img flex-shrink-0">--}}
{{--                                                        @if($file)--}}
{{--                                                            <img--}}
{{--                                                                class="img-fluid dz-img-inner" data-dz-thumbnail--}}
{{--                                                                src="{{ $file->temporaryUrl() }}"--}}
{{--                                                            />--}}
{{--                                                        @endif--}}
{{--                                                    </div>--}}
{{--                                                    <div class="dz-file-wrapper flex-grow-1">--}}
{{--                                                        <h6 class="dz-filename">--}}
{{--                                                            @if($file)--}}
{{--                                                                <span class="dz-title" data-dz-name>{{ $file->getClientOriginalName() }}</span>--}}
{{--                                                            @endif--}}
{{--                                                        </h6>--}}
{{--                                                        <div class="dz-size" data-dz-size></div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="dz-progress progress">--}}
{{--                                                    <div--}}
{{--                                                        class="dz-upload progress-bar bg-success"--}}
{{--                                                        role="progressbar"--}}
{{--                                                        x-bind:style="'width:' + `${uploadingProgress * 3}px`"--}}
{{--                                                        aria-valuenow="0"--}}
{{--                                                        aria-valuemin="0"--}}
{{--                                                        aria-valuemax="100"--}}
{{--                                                        data-dz-uploadprogress></div>--}}
{{--                                                </div>--}}
{{--                                                <div class="d-flex align-items-center">--}}
{{--                                                    --}}{{--                            <div class="dz-success-mark  ">--}}
{{--                                                    --}}{{--                                <span class="bi-check-lg"></span>--}}
{{--                                                    --}}{{--                            </div>--}}
{{--                                                    --}}{{--                            <div class="dz-error-mark">--}}
{{--                                                    --}}{{--                                <span class="bi-x-lg"></span>--}}
{{--                                                    --}}{{--                            </div>--}}
{{--                                                    --}}{{--                            <div class="dz-error-message">--}}
{{--                                                    --}}{{--                                <small data-dz-errormessage></small>--}}
{{--                                                    --}}{{--                            </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}



                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary px-5">
                                    @if($updateMode)
                                        Update
                                    @else
                                        Save
                                    @endif
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--    End Create Photo Album Model--}}

    <div class="d-flex mt-4">
        {!! $photos->links() !!}
    </div>

</div>

