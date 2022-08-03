<form wire:submit.prevent="register" method="post">
    @csrf
{{--    <x-jet-validation-errors />--}}
    <fieldset class=" border rounded-1 p-3 mb-5"  style="border: 1px solid #D9D9D9 !important;">
        <legend class="float-none w-auto fs-4 mb-0 px-2 mb-0 ms-1 text-dark poppins-bold">House Details</legend>
        <!-- Form -->
        <div class="pt-2 mb-3">
            <fieldset class="input-group rounded-1 ps-1">
                <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">House Name</legend>
                <input
                    type="text"
                    class="form-control form-control-lg border-0 shadow-none outline-0"
                    name="HouseName"
                    id="HouseName"
                    wire:model.defer="state.HouseName"
                    placeholder="Enter House Name"
                    value="{{old('HouseName')}}"
                />
            </fieldset>
            @error('HouseName')
            <span class="text-danger fw-semi-bold"
                  style="font-size: 13px !important;">{{$message}}</span>
            @enderror


        </div>
        {{--     second row starts --}}

        <div class="row mb-3">
            <div class="col-md-6">
                <fieldset class="input-group  rounded-1 ps-1">
                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">City</legend>
                    <input
                        type="text"
                        class="form-control form-control-lg border-0 shadow-none outline-0"
                        id="city"
                        name="City"
                        wire:model.defer="state.City"
                        placeholder="City"
                        value="{{ old('city') }}"
                    />

                </fieldset>
                @error('City')
                <span class="text-danger fw-semi-bold"
                      style="font-size: 13px !important;">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <fieldset class="input-group  rounded-1 ps-1">
                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">State</legend>
                    <input
                        type="text"
                        class="form-control form-control-lg border-0 shadow-none outline-0"
                        name="State"
                        wire:model.defer="state.State"
                        id="State"
                        placeholder="State"
                        value="{{ old('state') }}"
                        aria-label=""
                    />
                </fieldset>
                @error('State')
                <span class="text-danger fw-semi-bold"
                      style="font-size: 13px !important;">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <fieldset class="input-group rounded-1 ps-1">
                <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Paypal Account</legend>
                <input
                    type="number"
                    class="form-control form-control-lg border-0 shadow-none outline-0"
                    id="ReferredBy"
                    name="ReferredBy"
                    wire:model.defer="state.ReferredBy"
                    placeholder=""
                    value="{{old('ReferredBy')}}"
                />
            </fieldset>
            @error('ReferredBy')
            <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
            @enderror
        </div>
        <div
            class="mb-2"
            x-data="{isFileDropping: false, isUploadingFile: false, uploadingProgress: 0}"
            x-on:drop="isFileDropping = false"
            x-on:drop.prevent="
                if ($event.dataTransfer.files.length > 0) {
                    isUploadingFile = true;
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
                                x-bind:style="'width:' + `${uploadingProgress * 3}px`"
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
        </div>
    </fieldset>
    <!-- End Form -->
    <!-- second fieldset -->
    <fieldset class="border rounded-1 p-3 mb-3" style="border: 1px solid #D9D9D9 !important;">
        <legend class="float-none w-auto fs-4 mb-0 px-2 mb-0 ms-1 poppins-bold text-dark">Admin Details</legend>
        <!-- Form -->
        <div class="row pt-2">
            <div class="col-md-12">
                <!-- Form -->
                <div class="mb-2">
                    <fieldset class="input-group  rounded-1 ps-1">
                        <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Username</legend>
                        <input type="text"
                               class="form-control form-control-lg border-0 shadow-none outline-0"
                               name="user_name"
                               wire:model.defer="state.user_name"
                               id="user_name" tabindex="1"
                               placeholder=""
                               value="{{ old('user_name') }}"
                               aria-label=""
                        />
                        <a id="changePassTarget-2" class="input-group-append input-group-text border-0"
                           href="javascript:;">
                            <i class="bi bi-person text-primary"></i>
                        </a>
                    </fieldset>
                    @error('user_name')
                    <span class="text-danger fw-semi-bold"
                          style="font-size: 13px !important;">{{$message}}</span>
                    @enderror
                </div>
                <!-- End Form -->
            </div>
        </div>
        {{--     second row starts --}}

        <div class="row">
            <div class="col-md-12">
                <div class="mt-3">
                    <fieldset class="input-group rounded-1 ps-1">
                        <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Email</legend>
                        <input type="email"
                               class="form-control form-control-lg border-0 shadow-none outline-0"
                               name="email"
                               wire:model.defer="state.email"
                               id="email" tabindex="1"
                               value="{{ old('email') }}"
                               placeholder=""
                               aria-label=""
                        />
                        <a id="changePassTarget-2" class="input-group-append input-group-text border-0"
                           href="javascript:;">
                            <i class="bi bi-envelope text-primary"></i>
                        </a>
                    </fieldset>
                    @error('email')
                    <span class="text-danger fw-semi-bold"
                          style="font-size: 13px !important;">{{$message}}</span>
                    @enderror
                </div>

                <input type="hidden" name="role" value="Administrator">

                <div class="form-check mt-2">
                    <label class="form-check-label" for="AdminOwner">
                        Allow Administrator to have Owner Permissions.
                    </label>
                    <input
                        type="checkbox"
                        class="form-check-input"
                        name="AdminOwner"
                        wire:model.defer="state.AdminOwner"
                        value=""
                        id="AdminOwner"
                    />

                </div>
            </div>
        </div>
        <div class="row">
            <div class=" col-md-6">
                <div class="mt-3">
                    <fieldset class="input-group rounded-1 ps-1">
                        <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">First Name</legend>
                        <input type="text"
                               class="form-control form-control-lg border-0 shadow-none outline-0"
                               name="first_name"
                               wire:model.defer="state.first_name"
                               id="first_name" tabindex="1"
                               placeholder=""
                               value="{{ old('first_name') }}"
                               aria-label=""
                        />
                    </fieldset>
                    @error('first_name')
                    <span class="text-danger fw-semi-bold"
                          style="font-size: 13px !important;">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class=" col-md-6">
                <div class="mt-3">
                    <fieldset class="input-group rounded-1 ps-1">
                        <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Last Name</legend>
                        <input type="text"
                               class="form-control form-control-lg border-0 shadow-none outline-0"
                               name="last_name"
                               wire:model.defer="state.last_name"
                               id="last_name" tabindex="1"
                               placeholder=""
                               value="{{ old('last_name') }}"
                               aria-label=""
                        />
                    </fieldset>
                    @error('last_name')
                    <span class="text-danger fw-semi-bold"
                          style="font-size: 13px !important;">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="mt-3">
                    <fieldset class="input-group rounded-1 ps-1">
                        <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Create Password</legend>
                        <input type="password"
                               class="form-control form-control-lg border-0 shadow-none outline-0"
                               name="password"
                               wire:model.defer="state.password"
                               id="password"
                               tabindex="1"
                               placeholder=""
                               aria-label=""
                        >
                        <a id="changePassTarget-2" class="input-group-append input-group-text border-0"
                           href="javascript:;">
                            <i class="bi-eye text-primary"></i>
                        </a>
                    </fieldset>
                    @error('password')
                    <span class="text-danger fw-semi-bold"
                          style="font-size: 13px !important;">{{$message}}</span>
                    @enderror
                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="mt-3">
                    <fieldset class="input-group rounded-1 ps-1">
                        <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Confirm Password</legend>
                        <input type="password"
                               class="form-control form-control-lg border-0 shadow-none outline-0"
                               wire:model.defer="state.password_confirmation"
                               name="password_confirmation"
                               id="password_confirmation"
                               tabindex="1"
                               placeholder=""
                               aria-label=""
                        >
                        <a id="changePassTarget-2" class="input-group-append input-group-text border-0"
                           href="javascript:;">
                            <i class="bi-eye text-primary"></i>
                        </a>
                    </fieldset>

                    @error('password_confirmation')
                    <span class="text-danger fw-semi-bold"
                          style="font-size: 13px !important;">{{$message}}</span>
                    @enderror

                    <div class="form-check mt-2">
                        <label class="form-check-label" for="remember_me">
                            I accept <a href="#" class="text-decoration-underline">Terms and Conditions</a>
                        </label>
                        <input type="checkbox" class="form-check-input" name="remember_me" value=""
                               id="remember_me">

                    </div>
                </div>

            </div>

        </div>
        <div class="text-center mt-3">
            <button class="btn btn-dark-secondary text-white w-100" type="submit">Create Account</button>
        </div>

    </fieldset>
</form>
