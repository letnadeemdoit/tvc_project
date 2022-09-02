<div>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title h4">House Details</h2>
        </div>
        <div class="card-body">



            <form wire:submit.prevent="saveHouseDetails" method="post">
                @if($house && $house->image)
                    <div class="d-flex mb-3">
                        <div class="mx-auto">
{{--                            <a--}}
{{--                                href="#"--}}
{{--                                class="position-absolute" style="right: 5px; top: 5px"--}}
{{--                                wire:click.prevent="deleteFile"--}}
{{--                            ><i class="bi-trash fs-3 pe-1 pt-1 text-dark text-white"></i></a>--}}
                            <img src="{{ $house->getFileUrl() }}" class="img-thumbnail" style="max-height: 150px" />
                        </div>
                    </div>
                @endif
                <x-upload-zone wire:model="file" />
                <x-jet-input-error for="image" />
                <br />

                <div class="row">
                    <div class="mb-3 col-12 col-lg-6">
                        <label class="form-label" for="primary_house_name">Primary House Name</label>
                        <input
                            type="text"
                            id="primary_house_name"
                            wire:model.defer="state.primary_house_name"
                            name="primary_house_name"
                            class="form-control"
                            placeholder="Primary House Name"
                        />
                    </div>

                    <div class="mb-3 col-12 col-lg-6">
                        <label class="form-label" for="name">House Name</label>
                        <input
                            type="text"
                            id="name"
                            wire:model.defer="state.name"
                            name="name"
                            disabled
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="House Name"
                        />
                        @error('name')
                        <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
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
                        <div class="col-12 col-md-6 col-lg-3 mx-auto">
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

                        <div class="col-12 col-md-6 col-lg-3 mx-auto">
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
                        <div class="col-12 col-md-6 col-lg-3 mx-auto">
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
