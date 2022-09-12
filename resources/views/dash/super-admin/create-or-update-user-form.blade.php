<x-modals.bs-modal
    id="addOrUpdateUser"
>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $userCU && $userCU->user_name ? "Update" : 'Add' }} User information</h5>
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click.click="hide()"
            ></button>
        </div>
        <form wire:submit.prevent="saveUserCU" class="modal-body"  x-data="{role: '{{ $state['role'] ?? \App\Models\User::ROLE_OWNER }}'}">
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label class="form-label" for="user_name">Username:</label>
                    <input
                        type="text"
                        class="form-control @error('user_name') is-invalid @enderror"
                        name="user_name"
                        placeholder="User Name"
                        id="user_name"
                        x-bind:disabled="role === '{{ \App\Models\User::ROLE_GUEST }}'"
                        wire:model.defer="state.user_name"
                    />
                    @error('user_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="role">Role:</label>
                    <select
                        type="text"
                        class="form-control @error('role') is-invalid @enderror"
                        name="role"
                        id="role"
                        wire:model="state.role"
                    >
                        @if($userCU && $userCU->role !== \App\Models\User::ROLE_GUEST)
                            <option value="{{ \App\Models\User::ROLE_ADMINISTRATOR }}">Administrator</option>
                            <option value="{{ \App\Models\User::ROLE_OWNER }}" selected>Owner</option>
                        @endif
                        <option
                            value="{{ \App\Models\User::ROLE_GUEST }}" {{ $isGuestAlreadyExists && ($userCU && $userCU->role !== 'Guest')? 'disabled' : '' }}>
                            Guest
                        </option>
                    </select>
                    @error('role')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label class="form-label" for="first_name">First Name:</label>
                    <input
                        type="text"
                        class="form-control @error('first_name') is-invalid @enderror"
                        name="first_name"
                        placeholder="First Name"
                        id="first_name"
                        x-bind:disabled="role === '{{ \App\Models\User::ROLE_GUEST }}'"
                        wire:model.defer="state.first_name"
                    />
                    @error('first_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="last_name">Last Name:</label>
                    <input
                        type="text"
                        class="form-control @error('last_name') is-invalid @enderror"
                        name="last_name"
                        placeholder="Last Name"
                        id="last_name"
                        x-bind:disabled="role === '{{ \App\Models\User::ROLE_GUEST }}'"
                        wire:model.defer="state.last_name"
                    />
                    @error('last_name')
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
                    id="email"
                    x-bind:disabled="role === '{{ \App\Models\User::ROLE_GUEST }}'"
                    wire:model.defer="state.email"
                />
                @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label class="form-label" for="password">Password:</label>
                    <input
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password"
                        placeholder="Password"
                        id="password"
                        wire:model.defer="state.password"
                    />
                    @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="confirm_password">Confirm Password:</label>
                    <input
                        type="password"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation"
                        placeholder="Confirm Password"
                        id="confirm_password"
                        wire:model.defer="state.password_confirmation"
                    />
                    @error('password_confirmation')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            @if((isset($state['role']) && $state['role'] !== \App\Models\User::ROLE_GUEST) || ($userCU && $userCU->role !== \App\Models\User::ROLE_GUEST))
                <div class="row mb-3">
                <label for="" class="form-label">Send Email:</label>
                <div class="col-12 col-lg-6  mb-3 mb-sm-0">
                    <!-- Form Radio -->
                    <label class="form-control" for="status">
                                  <span class="form-check">
                                    <input type="radio"
                                           wire:model.defer="state.send_email"
                                           value="1"
                                           class="form-check-input"
                                           checked
                                           name="send_email"
                                           id="status"
                                    >
                                    <span class="form-check-label">Yes</span>
                                  </span>
                    </label>
                    <!-- End Form Radio -->
                </div>

                <div class="col-12 col-lg-6  mb-3 mb-sm-0">
                    <!-- Form Radio -->
                    <label class="form-control" for="status1">
                                  <span class="form-check">
                                    <input type="radio"
                                           value="0"
                                           wire:model.defer="state.send_email"
                                           class="form-check-input"
                                           name="send_email" id="status1">
                                    <span class="form-check-label">No</span>
                                  </span>
                    </label>
                    <!-- End Form Radio -->
                </div>
            </div>
            @endif

            <div class="d-flex">
                <button
                    type="submit"
                    class="btn btn-primary ms-auto"
                >
                    {{ $userCU && $userCU->user_name ? "Update" : 'Add' }} User
                </button>
            </div>
        </form>
    </div>
</x-modals.bs-modal>
