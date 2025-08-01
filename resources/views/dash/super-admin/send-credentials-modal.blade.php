<x-modals.bs-modal
    id="addOrUpdateUser"
>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Send Mail User</h5>
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click.click="hide()"
            ></button>
        </div>
        <form wire:submit.prevent="sendMailUserCU"
              class="modal-body"
        >
            <div class="row mb-3">
                <div class="form-group col-md-12">
                    <label class="form-label" for="user_name">Username:</label>
                    <input
                        type="text"
                        class="form-control @error('user_name') is-invalid @enderror"
                        name="user_name"
                        placeholder="User Name"
                        disabled
                        id="user_name"
                        wire:model.defer="state.user_name"
                    />
                    @error('user_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="form-group mb-3">
                <label class="form-label" for="email">Email:</label>
                <input
                    type="text"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email"
                    placeholder="Email"
                    disabled
                    readonly
                    id="email"
                    wire:model.defer="state.email"
                />
                @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="row mb-3">
                <div class="form-group col-md-12">
                    <label class="form-label" for="password">Password:</label>
                    <div class="input-group input-group-merge" x-data="{showPassword: false}">
                        <input type="password" class="js-toggle-password form-control form-control-lg"
                               x-bind:type="showPassword ? 'text' : 'password'"
                               class="form-control @error('password') is-invalid @enderror "
                               name="password"
                               wire:model.defer="state.password"
                               id="password"
                               tabindex="1"
                               placeholder="Password"
                               aria-label=""
                        >

                        <a id="changePassTarget" class="input-group-append input-group-text"
                           href="#!"
                           @click.prevent="showPassword  = !showPassword"
                        >
                            <i id="changePassIcon" class="bi-eye"></i>
                        </a>
                    </div>
                    @error('password')
                    <span class="text-danger"
                          style="font-size: 13px !important;">{{$message}}</span>
                    @enderror
                </div>


                {{--                <div class="form-group col-md-12">--}}
                {{--                    <label class="form-label" for="password">Password:</label>--}}
                {{--                    <input--}}
                {{--                        type="password"--}}
                {{--                        class="form-control @error('password') is-invalid @enderror"--}}
                {{--                        name="password"--}}
                {{--                        placeholder="Enter Password"--}}
                {{--                        id="password"--}}
                {{--                        wire:model.defer="state.password"--}}
                {{--                    />--}}
                {{--                    @error('password')--}}
                {{--                    <span class="invalid-feedback">{{ $message }}</span>--}}
                {{--                    @enderror--}}
                {{--                </div>--}}

            </div>

            <div class="d-flex">
                <button
                    type="submit"
                    class="btn btn-primary ms-auto w-100"
                >
                    Send Mail
                </button>
            </div>
        </form>
    </div>
</x-modals.bs-modal>
