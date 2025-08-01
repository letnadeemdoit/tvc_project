<div>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title h4">House Details</h2>
        </div>
        <div class="card-body">



            <form wire:submit.prevent="saveHouseDetails" method="post">
                <label class="form-label"
                       for="house_image">
                    House Image:
                </label>
                @if($house && $house->image)
                    <div class="d-flex mb-3">
                        <div class="mx-auto">
                            {{--                            <a--}}
                            {{--                                href="#"--}}
                            {{--                                class="position-absolute" style="right: 5px; top: 5px"--}}
                            {{--                                wire:click.prevent="deleteFile"--}}
                            {{--                            ><i class="bi-trash fs-3 pe-1 pt-1 text-dark text-white"></i></a>--}}
                            <img src="{{ $house->getFileUrl('image') }}" class="img-thumbnail" style="max-height: 100px" />
                        </div>
                    </div>
                @endif
                <x-upload-zone wire:model="file" />
                <x-jet-input-error for="image" />
                <br />

                <div class="row">
                    <div class="mb-3 col-12 col-lg-12">
                        <!-- Form Switch -->
                        <label class="row form-check form-switch mb-4" for="is_default_image">
                            <span class="col-8 col-sm-9 ms-0">
                              <span class="d-block text-dark mb-1">Show Default Image.</span>
                              <span class="d-block fs-5 text-muted">
                                  Use this option to show House Image as a default image.
                              </span>
                            </span>
                            <span class="col-4 col-sm-3 text-end">
                              <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="is_default_image"
                                  name="is_default_image"
                                  wire:model.defer="state.is_default_image"
                                  value="1"
                              />
                            </span>
                        </label>
                        <!-- End Form Switch -->
                    </div>

{{--                    Portrait image for login page --}}
                    <div class="mb-3 col-12 col-lg-12">
                        <label class="form-label"
                               for="login_image">
                            Login Page Image:
                        </label>
                        @if($house && $house->login_image)
                            <div class="d-flex mb-3">
                                <div class="mx-auto">
                                    <img src="{{ $house->getFileUrl('login_image') }}" class="img-thumbnail" style="max-height: 150px" />
                                </div>
                            </div>
                        @endif
                        <x-login-upload-zone wire:model="login_file" />
                        <x-jet-input-error for="login_image" />
                        <br/>
                    </div>

                    <div class="mb-3 col-12 col-lg-12">
                        <label class="row form-check form-switch mb-4" for="is_default_login_image">
                            <span class="col-8 col-sm-9 ms-0">
                              <span class="d-block text-dark mb-1">Show Default Login Image.</span>
                              <span class="d-block fs-5 text-muted">
                                  Use this option to show Login Image as a default image.
                              </span>
                            </span>
                            <span class="col-4 col-sm-3 text-end">
                              <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="is_default_login_image"
                                  name="is_default_login_image"
                                  wire:model.defer="state.is_default_login_image"
                                  value="1"
                              />
                            </span>
                        </label>
                    </div>
                    {{--                    Portrait image for login page --}}


                    <div class="mb-3 col-12 col-lg-6">
                        <label class="form-label"
                               for="primary_house_name">
                            Primary House Name
                        </label>
                        <input
                            type="text"
                            id="primary_house_name"
                            wire:model.defer="state.primary_house_name"
                            name="primary_house_name"
                            class="form-control @error('primary_house_name') is-invalid @enderror"
                            placeholder="Primary House Name"
                        />
                        @error('primary_house_name')
                        <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                        <p class="fs-10 mb-0 mt-1" style="line-height: 14px">The primary house name defined here will not change the account house name,
                            but will only be used to differentiate the house within the account</p>

                    </div>

                    <div class="mb-3 col-12 col-lg-6">
                        <label class="form-label" for="name">House Name</label>
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
                </div>
                {{--                <div class="mb-3">--}}
                {{--                    <label class="form-label" for="address_1">Address 1:</label>--}}
                {{--                    <input--}}
                {{--                        type="text"--}}
                {{--                        id="address_1"--}}
                {{--                        wire:model.defer="state.address_1"--}}
                {{--                        name="address_1"--}}
                {{--                        class="form-control @error('address_1') is-invalid @enderror"--}}
                {{--                        placeholder="Address line 1"--}}
                {{--                    />--}}
                {{--                    @error('address_1')--}}
                {{--                    <span class="invalid-feedback">{{$message}}</span>--}}
                {{--                    @enderror--}}
                {{--                </div>--}}
                {{--                <div class="mb-3">--}}
                {{--                    <label class="form-label" for="address_2">Address 2:</label>--}}
                {{--                    <input--}}
                {{--                        type="text"--}}
                {{--                        id="address_2"--}}
                {{--                        wire:model.defer="state.address_2"--}}
                {{--                        name="address_2"--}}
                {{--                        class="form-control @error('address_2') is-invalid @enderror"--}}
                {{--                        placeholder="Address line 2"--}}
                {{--                    />--}}
                {{--                    @error('address_2')--}}
                {{--                    <span class="invalid-feedback">{{$message}}</span>--}}
                {{--                    @enderror--}}
                {{--                </div>--}}

                <div class="row mt-4 mb-2">
                    <div class="col-12 col-md-6 col-lg-3 mx-auto">
                        <div class="form-group mb-3" wire:ignore>
                            <label for="" class="form-label">Country</label>
                            <select
                                name="country_id"
                                wire:model="state.country_id"
                                wire:change="onChangeCountry"
                                class="form-control"
                            >
                                <option value="">--select country--</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 mx-auto">
                        <div class="form-group mb-3 ">
                            <label for="state_id" class="form-label">State</label>
                            <select
                                name="state_id"
                                wire:model="state.state_id"
                                class="form-control"
                                data-live-search="true"
                            >
                                <option value="">--select state--</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{--                        <div class="col-12 col-md-6 col-lg-3 mx-auto">--}}
                    {{--                            <div class="form-group mb-3 ">--}}
                    {{--                                <label for="city_id" class="form-label">City</label>--}}
                    {{--                                <select--}}
                    {{--                                    name="city_id"--}}
                    {{--                                    wire:model.defer="state.city_id"--}}
                    {{--                                    class="form-control"--}}
                    {{--                                >--}}
                    {{--                                    <option value="">--select city--</option>--}}
                    {{--                                    @foreach($cities as $city)--}}
                    {{--                                        <option value="{{ $city->id }}">{{ $city->name }}</option>--}}
                    {{--                                    @endforeach--}}
                    {{--                                </select>--}}

                    {{--                            </div>--}}
                    {{--                        </div>--}}


                    <div class="col-12 col-md-6 col-lg-3 mx-auto">
                        <div class="form-group mb-3 ">
                            <label class="form-label" for="city">City:</label>
                            <input
                                type="text"
                                id="city"
                                wire:model.defer="state.city_id"
                                name="city"
                                class="form-control @error('city') is-invalid @enderror"
                                placeholder="City"
                            />
                            @error('city')
                            <span class="invalid-feedback">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 mx-auto">
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
                    <button type="submit" class="btn btn-primary px-5 ms-auto">Update House</button>
                </div>

            </form>
        </div>
    </div>
</div>
