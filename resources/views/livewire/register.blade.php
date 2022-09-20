<div>
    <form wire:submit.prevent="register" method="post">
        @csrf
        {{--    <x-jet-validation-errors />--}}
        <fieldset class=" border rounded-1 p-3 mb-5" style="border: 1px solid #D9D9D9 !important;">
            <legend class="float-none w-auto fs-4 mb-0 px-2 mb-0 ms-1 text-dark poppins-bold">House Details</legend>
            <!-- Form -->
            <div class="pt-2 mb-3">
                <fieldset class="input-group rounded-1 ps-1">
                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">House Name</legend>
                    <input
                        type="text"
                        class="form-control form-control-lg border-0 shadow-none outline-0"
                        name="HouseName"
                        autofocus
                        id="HouseName"
                        wire:model.defer="state.HouseName"
                        tabindex="0"
                        value="{{old('HouseName')}}"
                    />
                </fieldset>
                @error('HouseName')
                <span class="text-danger fw-semi-bold"
                      style="font-size: 13px !important;">{{$message}}</span>
                @enderror
            </div>

            {{--     second row starts --}}

            <div class="row">

                <div class="col-md-6 mb-3">
                    <fieldset class="input-group  rounded-1 ps-1" wire:ignore>
                        <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Country:</legend>
                        <select
                            tabindex="1"
                            name="country_id"
                            wire:model="state.country_id"
                            wire:change="onChangeCountry"
                            class="form-control form-control-lg border-0 shadow-none outline-0"
                        >
                            <option value=""></option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>

                    </fieldset>
                    @error('country_id')
                    <span class="text-danger fw-semi-bold"
                          style="font-size: 13px !important;">{{$message}}</span>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <fieldset class="input-group  rounded-1 ps-1">
                        <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">State:</legend>
                        <select
                            tabindex="2"
                            name="state_id"
                            wire:model="state.state_id"
                            class="form-control form-control-lg border-0 shadow-none outline-0"
                            data-live-search="true"

                        >
                            <option value=""></option>
                            @foreach($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>

                    </fieldset>
                    @error('state_id')
                    <span class="text-danger fw-semi-bold"
                          style="font-size: 13px !important;">{{$message}}</span>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <fieldset class="input-group  rounded-1 ps-1">
                        <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">City:</legend>
                        <select
                            tabindex="3"
                            name="city_id"
                            wire:model.defer="state.city_id"
                            class="form-control form-control-lg border-0 shadow-none outline-0"

                        >
                            <option value=""></option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>

                    </fieldset>
                    @error('city_id')
                    <span class="text-danger fw-semi-bold"
                          style="font-size: 13px !important;">{{$message}}</span>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <fieldset class="input-group rounded-1 ps-1">
                        <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Zipcode:</legend>
                        <input
                            type="text"
                            id="zipcode"
                            wire:model.defer="state.zipcode"
                            name="zipcode"
                            class="form-control form-control-lg border-0 shadow-none outline-0"
                            tabindex="4"
                            value="{{old('zipcode')}}"
                        />
                    </fieldset>
                    @error('zipcode')
                    <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                    @enderror
                </div>

            </div>


            {{--            <div class="row mb-3">--}}
            {{--                <div class="col-md-6">--}}
            {{--                    <fieldset class="input-group  rounded-1 ps-1">--}}
            {{--                        <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">City</legend>--}}
            {{--                        <input--}}
            {{--                            type="text"--}}
            {{--                            class="form-control form-control-lg border-0 shadow-none outline-0"--}}
            {{--                            id="city"--}}
            {{--                            name="City"--}}
            {{--                            wire:model.defer="state.City"--}}
            {{--                            value="{{ old('city') }}"--}}
            {{--                        />--}}

            {{--                    </fieldset>--}}
            {{--                    @error('City')--}}
            {{--                    <span class="text-danger fw-semi-bold"--}}
            {{--                          style="font-size: 13px !important;">{{$message}}</span>--}}
            {{--                    @enderror--}}
            {{--                </div>--}}
            {{--                <div class="col-md-6">--}}
            {{--                    <fieldset class="input-group  rounded-1 ps-1">--}}
            {{--                        <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">State</legend>--}}
            {{--                        <input--}}
            {{--                            type="text"--}}
            {{--                            class="form-control form-control-lg border-0 shadow-none outline-0"--}}
            {{--                            name="State"--}}
            {{--                            wire:model.defer="state.State"--}}
            {{--                            id="State"--}}
            {{--                            value="{{ old('state') }}"--}}
            {{--                            aria-label=""--}}
            {{--                        />--}}
            {{--                    </fieldset>--}}
            {{--                    @error('State')--}}
            {{--                    <span class="text-danger fw-semi-bold"--}}
            {{--                          style="font-size: 13px !important;">{{$message}}</span>--}}
            {{--                    @enderror--}}
            {{--                </div>--}}
            {{--            </div>--}}


            <div class="mb-3">
                <fieldset class="input-group rounded-1 ps-1">
                    <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Referral Paypal Account Email</legend>
                    <input
                        type="text"
                        class="form-control form-control-lg border-0 shadow-none outline-0"
                        id="ReferredBy"
                        tabindex="5"
                        name="Referral_paypal_account"
                        wire:model.defer="state.Referral_paypal_account"
                        placeholder=""
                        value="{{old('Referral_paypal_account')}}"
                    />
                </fieldset>
                @error('Referral_paypal_account')
                <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                @enderror
            </div>
            <div>
                <x-upload-zone wire:model="file" tabindex="-1"/>
                <x-jet-input-error for="image"/>
            </div>
            {{--            <div--}}
            {{--                class="mb-2"--}}
            {{--                x-data="{isFileDropping: false, isUploadingFile: false, uploadingProgress: 0}"--}}
            {{--                x-on:drop="isFileDropping = false"--}}
            {{--                x-on:drop.prevent="--}}

            {{--                if ($event.dataTransfer.files.length > 0 ) {--}}
            {{--                    isUploadingFile = true;--}}
            {{--                    var allowedExtensions = /(\/jpg|\/jpeg|\/png|\/gif)$/i;--}}
            {{--                    var fileTypeCheck = $event.dataTransfer.files[0].type;--}}
            {{--                    if (!allowedExtensions.exec(fileTypeCheck)) {--}}

            {{--                        $('.showErrorMsg').addClass('d-block');--}}

            {{--                        return;--}}
            {{--                     }--}}

            {{--                        $('.showErrorMsg').addClass('d-none');--}}

            {{--                    @this.upload( 'file', $event.dataTransfer.files[0],--}}
            {{--                        (uploadedFilename) => {--}}
            {{--                        }, () => {--}}

            {{--                        }, (event) => {--}}
            {{--                            uploadingProgress = event.detail.progress;--}}
            {{--                        });--}}
            {{--                }--}}
            {{--            "--}}
            {{--                x-on:dragover.prevent="isFileDropping = true"--}}
            {{--                x-on:dragleave.prevent="isFileDropping = false"--}}
            {{--            >--}}
            {{--                <div id="basicExampleDropzone"--}}
            {{--                     class="js-dropzone row dz-dropzone dz-dropzone-card border-primary bg-primary-light mx-auto">--}}
            {{--                    <div class="dz-message">--}}
            {{--                        <h5>Drag and drop your file here</h5>--}}
            {{--                        <p class="mb-2">or</p>--}}
            {{--                        <div class="text-center"--}}
            {{--                             x-on:livewire-upload-start="isUploadingFile = true"--}}
            {{--                             x-on:livewire-upload-finish=""--}}
            {{--                             x-on:livewire-upload-error=""--}}
            {{--                             x-on:livewire-upload-progress="uploadingProgress = $event.detail.progress"--}}
            {{--                        >--}}
            {{--                            <input--}}
            {{--                                id="file_upload"--}}
            {{--                                type="file"--}}
            {{--                                name="image"--}}
            {{--                                hidden="hidden"--}}
            {{--                                wire:model="file"--}}
            {{--                                x-ref="file_upload"--}}
            {{--                            />--}}
            {{--                            <button class="btn bg-primary btn-sm text-white" @click.prevent="$refs.file_upload.click()">Upload Image</button>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                    <div class="col h-100 mt-4" style="display: none" x-show="isUploadingFile">--}}
            {{--                        <div class="dz-preview dz-file-preview">--}}
            {{--                            <a href="#" class="d-flex justify-content-end dz-close-icon text-decoration-none"  @click.prevent="$wire.set('file', null); isUploadingFile = false">--}}
            {{--                                <small class="bi-x" data-dz-remove></small>--}}
            {{--                            </a>--}}
            {{--                            <div class="dz-details d-flex">--}}
            {{--                                <div class="dz-img flex-shrink-0">--}}
            {{--                                    @if($file)--}}
            {{--                                        <img--}}
            {{--                                            class="img-fluid dz-img-inner" data-dz-thumbnail--}}
            {{--                                            src="{{ $file->temporaryUrl() }}"--}}
            {{--                                        />--}}
            {{--                                    @endif--}}
            {{--                                </div>--}}

            {{--                                <div class="dz-file-wrapper flex-grow-1">--}}
            {{--                                    <h6 class="dz-filename">--}}
            {{--                                        @if($file)--}}
            {{--                                            <span class="dz-title" data-dz-name>{{ $file->getClientOriginalName() }}</span>--}}
            {{--                                        @endif--}}
            {{--                                    </h6>--}}
            {{--                                    <div class="dz-size" data-dz-size></div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="dz-progress progress">--}}
            {{--                                <div--}}
            {{--                                    class="dz-upload progress-bar bg-success"--}}
            {{--                                    role="progressbar"--}}
            {{--                                    x-bind:style="'width:' + `${uploadingProgress}%`"--}}
            {{--                                    aria-valuenow="0"--}}
            {{--                                    aria-valuemin="0"--}}
            {{--                                    aria-valuemax="100"--}}
            {{--                                    data-dz-uploadprogress></div>--}}
            {{--                            </div>--}}
            {{--                            <div class="d-flex align-items-center">--}}
            {{--                                --}}{{--                            <div class="dz-success-mark  ">--}}
            {{--                                --}}{{--                                <span class="bi-check-lg"></span>--}}
            {{--                                --}}{{--                            </div>--}}
            {{--                                --}}{{--                            <div class="dz-error-mark">--}}
            {{--                                --}}{{--                                <span class="bi-x-lg"></span>--}}
            {{--                                --}}{{--                            </div>--}}
            {{--                                --}}{{--                            <div class="dz-error-message">--}}
            {{--                                --}}{{--                                <small data-dz-errormessage></small>--}}
            {{--                                --}}{{--                            </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}


            {{--                <span class="showErrorMsg fw-semi-bold mt-1"--}}
            {{--                      style="font-size: 13px !important;color: #ff0000 !important;display: none"> Only jpg,png,giff,tiff are allowed</span>--}}
            {{--                @error('image')--}}
            {{--                <span class="text-danger fw-semi-bold"--}}
            {{--                      style="font-size: 13px !important; ">{{$message}}</span>--}}
            {{--                @enderror--}}
            {{--            </div>--}}


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
                                   id="user_name" tabindex="6"
                                   placeholder=""
                                   value="{{ old('user_name') }}"
                                   aria-label=""
                            />
                            <a id="changePassTarget-2" class="input-group-append input-group-text border-0"
                               style="outline-color: transparent"
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
                                   id="email" tabindex="7"
                                   value="{{ old('email') }}"
                                   placeholder=""
                                   aria-label=""
                            />
                            <a id="changePassTarget-2" class="input-group-append input-group-text border-0"
                               style="outline-color: transparent"
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
                            tabindex="8"
                            class="form-check-input check-input"
                            name="AdminOwner"
                            wire:model.defer="state.AdminOwner"
                            value="1"
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
                                   id="first_name" tabindex="9"
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
                                   id="last_name" tabindex="10"
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
                    <div class="mt-3" x-data="{showPassword: false}">

                        <fieldset class="input-group rounded-1 ps-1">
                            <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Create Password</legend>
                            <input
                                x-bind:type="showPassword ? 'text' : 'password'"
                                class="form-control form-control-lg border-0 shadow-none outline-0"
                                name="password"
                                wire:model.defer="state.password"
                                id="password"
                                tabindex="11"
                                placeholder=""
                                aria-label=""
                            >
                            <a id="changePassTarget-2" class="input-group-append input-group-text border-0"
                               style="outline-color: transparent"
                               href="javascript:;"
                               @click.prevent="showPassword  = !showPassword"
                            >

                                <i id="changePassIcon" class="bi-eye text-primary"
                                   :class="{'bi-eye-slash': showPassword, 'bi-eye': !showPassword}"></i>
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


                    <div class="mt-3" x-data="{showPassword: false}">
                        <fieldset class="input-group rounded-1 ps-1">
                            <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0 ms-1">Confirm Password</legend>
                            <input
                                x-bind:type="showPassword ? 'text' : 'password'"
                                class="form-control form-control-lg border-0 shadow-none outline-0"
                                wire:model.defer="state.password_confirmation"
                                name="password_confirmation"
                                id="password_confirmation"
                                tabindex="12"
                                placeholder=""
                                aria-label=""
                            >
                            <a id="changePassTarget-2" class="input-group-append input-group-text border-0"
                               style="outline-color: transparent"
                               href="javascript:;"
                               @click.prevent="showPassword  = !showPassword"
                            >
                                <i id="changePassIcon" class="bi-eye text-primary"
                                   :class="{'bi-eye-slash': showPassword, 'bi-eye': !showPassword}"></i>
                            </a>
                        </fieldset>

                        @error('password_confirmation')
                        <span class="text-danger fw-semi-bold"
                              style="font-size: 13px !important;">{{$message}}</span>
                        @enderror

                        <div class="form-check mt-3">
                            <label class="form-check-label" for="terms_and_conditions">
                                I accept <a href="{{route('guest.privacy-policy')}}" target="_blank"
                                            class="text-decoration-underline">Terms and Conditions</a>
                            </label>
                            <input type="checkbox" class="form-check-input check-input" name="terms"
                                   wire:model.defer="state.terms" tabindex="13" value="yes"
                                   id="terms_and_conditions">
                        </div>
                        @error('terms')
                        <span class="text-danger fw-semi-bold"
                              style="font-size: 13px !important;">{{$message}}</span>
                        @enderror

                    </div>


                </div>

            </div>
            <div class="text-center mt-5">
                <button
                    class="btn btn-dark-secondary  w-100"
                    type="submit"
                    tabindex="14"
                    wire:loading.attr="disabled"
                    wire:target="register"
                >
                    <span wire:loading.remove>Create Account</span>
                    <span wire:loading>Creating....</span>

                </button>
            </div>

        </fieldset>
    </form>

</div>
