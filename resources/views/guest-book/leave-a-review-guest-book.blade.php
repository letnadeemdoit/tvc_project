<div class="card rounded border-0">
    <div class="w-lg-50 mx-auto">
        <div class="my-5">
            <div class="mb-2 pt-2">
                @include('flash-messages')
            </div>

            <div class="bg-review shadow-1-strong rounded text-center  d-flex justify-content-center align-items-center">
                <h1 class="text-primary font-vintage mb-0">FeedBack</h1>
            </div>
            <h1 class="pt-2 text-center poppins-bold">Leave a quick thank you</h1>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="saveReviewFeedBackGuestBook" method="post">

                <div class="row">
                    <div class="mb-3 col-12">

                        <fieldset class="input-group  rounded-1 ps-1">
                            <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Name</legend>
                            <input
                                type="text"
                                class="form-control form-control-lg border-0 shadow-none outline-0"
                                id="name"
                                wire:model.defer="state.name"
                                name="name"
                                class="form-control"
                                value="{{ old('name') }}"
                            />

                        </fieldset>
                        @error('name')
                        <span class="invalid-feedback d-block">{{$message}}</span>
                        @enderror

                    </div>


{{--                    <div class="mb-3 col-12">--}}

{{--                        <fieldset class="input-group  rounded-1 ps-1">--}}
{{--                            <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Last Name</legend>--}}
{{--                            <input--}}
{{--                                type="text"--}}
{{--                                class="form-control form-control-lg border-0 shadow-none outline-0"--}}
{{--                                id="last_name"--}}
{{--                                wire:model.defer="state.last_name"--}}
{{--                                name="last_name"--}}
{{--                                class="form-control"--}}
{{--                                value="{{ old('last_name') }}"--}}
{{--                            />--}}

{{--                        </fieldset>--}}

{{--                    </div>--}}


                </div>

                <div class="mb-3">

                    <fieldset class="input-group  rounded-1 ps-1">
                        <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Title</legend>
                        <input
                            type="text"
                            class="form-control form-control-lg border-0 shadow-none outline-0"
                            id="title"
                            wire:model.defer="state.title"
                            name="title"
                            class="form-control"
                            value="{{ old('title') }}"
                        />

                    </fieldset>
                    @error('title')
                    <span class="invalid-feedback d-block">{{$message}}</span>
                    @enderror

                </div>

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

                    <div class="js-dropzone row dz-dropzone dz-dropzone-card border-primary bg-primary-light mx-auto">
                        @if($guestBook && !is_null($guestBook->image))
                            {{--           TODO:  need to fix the design               --}}
                            <div class="col h-100">
                                <div class="dz-preview dz-file-preview">
                                    <a href="#" class="d-flex justify-content-end dz-close-icon text-decoration-none"
                                       wire:click.prevent="deleteFile">
                                        <small class="bi-x" data-dz-remove></small>
                                    </a>
                                    <div class="dz-details d-flex">
                                        <div class="dz-img flex-shrink-0">
                                            <img class="img-fluid dz-img-inner" data-dz-thumbnail src="{{ $guestBook->getFileUrl() }}"/>
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
                        <div class="dz-message d-block d-sm-flex justify-content-center align-items-center">
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
                            <p class="mb-0 mx-3 py-2 py-sm-0">or</p>
                            <h5 class="mb-0">Drag and drop your Visit Selfie here</h5>
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


                <div class="mb-3">
                    <fieldset class="input-group  rounded-1 ps-1">
                        <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Content</legend>
                        <textarea
                            class="form-control form-control-lg border-0 shadow-none outline-0"
                            wire:model.defer="state.content"
                            name="content"
                            placeholder=""
                            rows="5"
                            id="content"

                        ></textarea>
                    </fieldset>
                    @error('content')
                    <span class="invalid-feedback d-block">{{$message}}</span>
                    @enderror
                </div>


                <div class="gap-3 text-center my-3 d-block d-md-flex justify-content-center">
                    <button type="submit" class="btn btn-primary btn-lg rounded btn-min-160 px-5 border-0 shadow-lg">SEND</button>
                    <a href="#!" onclick="resetForm()"
                       wire:click.prevent="resetFeedbackForm"
                       class="btn  btn-lg bg-skin btn-min-160  rounded px-5 mt-3 mt-sm-0 border-0">RESET</a>
                </div>

{{--                <div class="my-3 d-flex">--}}
{{--                    <button type="submit" class="btn btn-primary px-5 ms-auto">--}}
{{--                        {{ $guestBook && $guestBook->id ? "Update" . ($guestBook->title ? " '$guestBook->title'" : '') : 'Add' }} Guest Book--}}
{{--                    </button>--}}
{{--                </div>--}}

            </form>
        </div>
    </div>

</div>
