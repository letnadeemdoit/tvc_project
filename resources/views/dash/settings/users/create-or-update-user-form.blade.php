<x-modals.bs-modal
    id="addOrUpdateUser"
>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $userCU && $userCU->user_name ? "Update '$userCU->user_name'" : 'Add' }} User</h5>
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click.click="hide()"
            ></button>
        </div>
        <form wire:submit.prevent="saveUserCU" class="modal-body">
            <div class="row mb-3">
                <div class="form-group col-md-6">
                    <label class="form-label" for="user_name">Username:</label>
                    <input
                        type="text"
                        class="form-control @error('user_name') is-invalid @enderror"
                        name="user_name"
                        id="user_name"
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
                        wire:model.defer="state.role"
                    >
                        <option value="Owner">Owner</option>
                        <option value="Guest" {{ $isGuestAlreadyExists ? 'disabled' : '' }}>Guest</option>
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
                        id="first_name"
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
                        id="last_name"
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
                    id="email"
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
                        id="confirm_password"
                        wire:model.defer="state.password_confirmation"
                    />
                    @error('password_confirmation')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="d-flex">
                <button
                    type="submit"
                    class="btn btn-primary ms-auto"
                >
                    {{ $userCU && $userCU->user_name ? "Update '$userCU->user_name'" : 'Add' }} User
                </button>
            </div>
        </form>
    </div>
</x-modals.bs-modal>
