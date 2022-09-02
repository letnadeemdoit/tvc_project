<x-modals.bs-modal class="modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $house && $house->HouseID ? "Update" : 'Add' }} House</h5>
            <button
                type="button"
                class="btn-close"
                aria-label="Close"
                @click.prevent="hide()"
            ></button>


        </div>
        <div class="modal-body">

            @if($house && $house->HouseID)

            @else
                <p class="text-dark fw-600">Your current logged in account information will be used to create new administrator account for this new house</p>
            @endif
            <form wire:submit.prevent="saveAdditionalHouseCU" method="post">


{{--                <div--}}
{{--                    class="mb-3"--}}
{{--                    x-data="{isFileDropping: false, isUploadingFile: false, uploadingProgress: 0}"--}}
{{--                    x-on:drop="isFileDropping = false"--}}
{{--                    x-on:drop.prevent="--}}
{{--                        if ($event.dataTransfer.files.length > 0 ) {--}}
{{--                            isUploadingFile = true;--}}
{{--                            var allowedExtensions = /(\/jpg|\/jpeg|\/png|\/gif)$/i;--}}
{{--                            var fileTypeCheck = $event.dataTransfer.files[0].type;--}}
{{--                            if (!allowedExtensions.exec(fileTypeCheck)) {--}}
{{--                                $('.showErrorMsg').addClass('d-block');--}}
{{--                                return;--}}
{{--                             }--}}
{{--                            $('.showErrorMsg').addClass('d-none');--}}
{{--                            @this.upload( 'file', $event.dataTransfer.files[0],--}}
{{--                                (uploadedFilename) => {--}}
{{--                                }, () => {--}}

{{--                                }, (event) => {--}}
{{--                                    uploadingProgress = event.detail.progress;--}}
{{--                                });--}}
{{--                        }--}}
{{--                    "--}}
{{--                    x-on:dragover.prevent="isFileDropping = true"--}}
{{--                    x-on:dragleave.prevent="isFileDropping = false"--}}
{{--                    @modal-is-showing--}}
{{--                >--}}

{{--                    <label class="form-label" for="">House Image</label>--}}
{{--                    <div class="js-dropzone row dz-dropzone dz-dropzone-card border-primary bg-primary-light mx-auto">--}}
{{--                        @if($house && !is_null($house->image))--}}
{{--                            --}}{{--           TODO:  need to fix the design               --}}
{{--                            <div class="col h-100">--}}
{{--                                <div class="dz-preview dz-file-preview">--}}
{{--                                    <a href="#" class="d-flex justify-content-end dz-close-icon text-decoration-none"--}}
{{--                                       wire:click.prevent="deleteFile">--}}
{{--                                        <small class="bi-x" data-dz-remove></small>--}}
{{--                                    </a>--}}
{{--                                    <div class="dz-details d-flex">--}}
{{--                                        <div class="dz-img flex-shrink-0">--}}
{{--                                            <img class="img-fluid dz-img-inner" data-dz-thumbnail src="{{ $house->getFileUrl() }}"/>--}}
{{--                                        </div>--}}

{{--                                        <div class="dz-file-wrapper flex-grow-1">--}}
{{--                                            <h6 class="dz-filename">--}}
{{--                                                @if($file)--}}
{{--                                                    <span class="dz-title" data-dz-name>--}}
{{--                                                        {{ $file->getClientOriginalName() }}--}}
{{--                                                    </span>--}}
{{--                                                @endif--}}
{{--                                            </h6>--}}
{{--                                            <div class="dz-size" data-dz-size></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                        <div class="dz-message">--}}
{{--                            <h5>Drag and drop your file here</h5>--}}
{{--                            <p class="mb-2">or</p>--}}
{{--                            <div class="text-center"--}}
{{--                                 x-on:livewire-upload-start="isUploadingFile = true"--}}
{{--                                 x-on:livewire-upload-finish=""--}}
{{--                                 x-on:livewire-upload-error=""--}}
{{--                                 x-on:livewire-upload-progress="uploadingProgress = $event.detail.progress"--}}
{{--                            >--}}
{{--                                <input--}}
{{--                                    id="file_upload"--}}
{{--                                    type="file"--}}
{{--                                    name="image"--}}
{{--                                    hidden="hidden"--}}
{{--                                    wire:model="file"--}}
{{--                                    x-ref="file_upload"--}}
{{--                                    accept=".jpg,.png,.jpeg,.gif,.tiff"--}}
{{--                                />--}}
{{--                                <button class="btn bg-primary btn-sm text-white"--}}
{{--                                        @click.prevent="$refs.file_upload.click()">Upload Image--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col h-100 mt-4" style="display: none" x-show="isUploadingFile">--}}
{{--                            <div class="dz-preview dz-file-preview">--}}
{{--                                <a href="#" class="d-flex justify-content-end dz-close-icon text-decoration-none"--}}
{{--                                   @click.prevent="$wire.set('file', null); isUploadingFile = false">--}}
{{--                                    <small class="bi-x" data-dz-remove></small>--}}
{{--                                </a>--}}
{{--                                <div class="dz-details d-flex">--}}
{{--                                    <div class="dz-img flex-shrink-0">--}}
{{--                                        @if($file && in_array($file->getClientOriginalExtension(), config('livewire.temporary_file_upload.preview_mimes')))--}}
{{--                                            <img class="img-fluid dz-img-inner" data-dz-thumbnail--}}
{{--                                                 src="{{ $file->temporaryUrl() }}"/>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}

{{--                                    <div class="dz-file-wrapper flex-grow-1">--}}
{{--                                        <h6 class="dz-filename">--}}
{{--                                            @if($file)--}}
{{--                                                <span class="dz-title" data-dz-name>--}}
{{--                                                    {{ $file->getClientOriginalName() }}--}}
{{--                                                </span>--}}
{{--                                            @endif--}}
{{--                                        </h6>--}}
{{--                                        <div class="dz-size" data-dz-size></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="dz-progress progress">--}}
{{--                                    <div--}}
{{--                                        class="dz-upload progress-bar bg-success"--}}
{{--                                        role="progressbar"--}}
{{--                                        x-bind:style="'width:' + `${uploadingProgress}%`"--}}
{{--                                        aria-valuenow="0"--}}
{{--                                        aria-valuemin="0"--}}
{{--                                        aria-valuemax="100"--}}
{{--                                        data-dz-uploadprogress></div>--}}
{{--                                </div>--}}
{{--                                <div class="d-flex align-items-center">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <span class="showErrorMsg fw-semi-bold mt-1" style="font-size: 13px !important;color: #ff0000 !important;display: none">Only jpg,png,giff,tiff are allowed</span>--}}
{{--                    @error('file')--}}
{{--                    <span class="invalid-feedback d-block">{{$message}}</span>--}}
{{--                    @enderror--}}
{{--                </div>--}}
                <div>
                    @if($house && $house->image)
                        <div class="d-flex mb-3">
                            <div class="mx-auto">
                                <img src="{{ $house->getFileUrl() }}" class="img-thumbnail rounded" style="max-height: 120px"/>
                            </div>
                        </div>
                    @endif
                </div>

                <div>
                    <x-upload-zone wire:model="file" />
                    <x-jet-input-error for="image" />
                </div>
                <br/>
                <div class="mb-3">
                    <label class="form-label" for="name">Name:</label>
                    <input
                        type="text"
                        id="name"
                        wire:model.defer="state.name"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="House Name"
                    />
                    @error('name')
                    <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="address_1">Address 1:</label>
                    <input
                        type="text"
                        id="address_1"
                        wire:model.defer="state.address_1"
                        name="address_1"
                        class="form-control @error('address_1') is-invalid @enderror"
                        placeholder="Address line 1"
                    />
                    @error('address_1')
                    <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="address_2">Address 2:</label>
                    <input
                        type="text"
                        id="address_2"
                        wire:model.defer="state.address_2"
                        name="address_2"
                        class="form-control @error('address_2') is-invalid @enderror"
                        placeholder="Address line 2"
                    />
                    @error('address_2')
                    <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>

                <div class="row mt-4 mb-2">
                    <div class="col-12 col-md-6 col-lg-6 mx-auto">
                        <div class="form-group mb-3" wire:ignore>
                            <label for="" class="form-label">Country</label>
                            <select
                                name="country_id"
                                wire:model="state.country_id"
                                class="form-control"
                            >
                                <option value="">--select country--</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6 mx-auto">
                        <div class="form-group mb-3 ">
                            <label for="state_id" class="form-label">State</label>
                            <select
                                name="state_id"
                                wire:model="state.state_id"
                                class="form-control"
                                data-live-search="true"
                            >
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6 mx-auto">
                        <div class="form-group mb-3 ">
                            <label for="city_id" class="form-label">City</label>
                            <select
                                name="city_id"
                                wire:model.defer="state.city_id"
                                class="form-control"
                            >
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6 mx-auto">
                        <div class="form-group mb-3 ">
                            <label class="form-label" for="zipcode">Zipcode:</label>
                            <input
                                type="text"
                                id="zipcode"
                                wire:model.defer="state.zipcode"
                                name="zipcode"
                                class="form-control @error('zipcode') is-invalid @enderror"
                                placeholder="Zipcode"
                            />
                            @error('zipcode')
                            <span class="invalid-feedback">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                </div>

{{--                <div class="row mb-3">--}}
{{--                    <div class="col-md-4">--}}
{{--                        <label class="form-label" for="city">City:</label>--}}
{{--                        <input--}}
{{--                            type="text"--}}
{{--                            id="city"--}}
{{--                            wire:model.defer="state.city"--}}
{{--                            name="city"--}}
{{--                            class="form-control @error('city') is-invalid @enderror"--}}
{{--                            placeholder="City"--}}
{{--                        />--}}
{{--                        @error('city')--}}
{{--                        <span class="invalid-feedback">{{$message}}</span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                    <div class="col-md-4">--}}
{{--                        <label class="form-label" for="state">State:</label>--}}
{{--                        <input--}}
{{--                            type="text"--}}
{{--                            id="state"--}}
{{--                            wire:model.defer="state.state"--}}
{{--                            name="state"--}}
{{--                            class="form-control @error('state') is-invalid @enderror"--}}
{{--                            placeholder="State"--}}
{{--                        />--}}
{{--                        @error('state')--}}
{{--                        <span class="invalid-feedback">{{$message}}</span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                    <div class="col-md-4">--}}
{{--                        <label class="form-label" for="zipcode">Zipcode:</label>--}}
{{--                        <input--}}
{{--                            type="text"--}}
{{--                            id="zipcode"--}}
{{--                            wire:model.defer="state.zipcode"--}}
{{--                            name="zipcode"--}}
{{--                            class="form-control @error('zipcode') is-invalid @enderror"--}}
{{--                            placeholder="Zipcode"--}}
{{--                        />--}}
{{--                        @error('zipcode')--}}
{{--                        <span class="invalid-feedback">{{$message}}</span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="mb-3 d-flex">
                    <button type="submit" class="btn btn-primary px-5 ms-auto">{{ $house && $house->HouseID ? "Update" : 'Add' }} House</button>
                </div>

            </form>
        </div>
    </div>
</x-modals.bs-modal>
