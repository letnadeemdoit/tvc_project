<div id="guestPasswordSection" class="card">
    <div class="card-header">
        <h4 class="card-title">Change guest password</h4>
    </div>

    <!-- Body -->
    <div class="card-body">
        <p>The password for the Guest associated with this House will be changed.</p>
        <!-- Form -->
        <form id="changeGuestPasswordForm" wire:submit.prevent="changeGuestPassword">
            <!-- Form -->
            <div class="row mb-4">
                <label for="new_password" class="col-sm-3 col-form-label form-label">New password</label>
                <div class="col-sm-9">
                    <input
                        type="password"
                        class="form-control @error('new_password') is-invalid @enderror"
                        name="new_password"
                        id="new_password"
                        wire:model.defer="state.new_password"
                        placeholder="Enter new password"
                        aria-label="Enter new password"
                    />
                    @error('new_password')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- End Form -->

            <!-- Form -->
            <div class="row mb-4">
                <label for="new_password_confirmation" class="col-sm-3 col-form-label form-label">Confirm new password</label>
                <div class="col-sm-9">
                    <div class="mb-3">
                        <input
                            type="password"
                            class="form-control @error('new_password_confirmation') is-invalid @enderror"
                            name="new_password_confirmation"
                            id="new_password_confirmation"
                            wire:model.defer="state.new_password_confirmation"
                            placeholder="Confirm your new password"
                            aria-label="Confirm your new password"
                        />
                        @error('new_password_confirmation')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <h5>Password requirements:</h5>

                    <p class="fs-6 mb-2">Ensure that these requirements are met:</p>

                    <ul class="fs-6">
                        <li>Minimum 8 characters long - the more, the better</li>
                        <li>At least one uppercase character</li>
                        <li>At least one number</li>
                        <li>At least one special character</li>
                    </ul>
                </div>
            </div>
            <!-- End Form -->

            <div class="d-flex align-items-center justify-content-end">
                <x-jet-action-message on="saved" class="text-muted">Guest password changed successfully.</x-jet-action-message>
                <button type="submit" class="btn btn-primary ms-2">Change Password</button>
            </div>
        </form>
        <!-- End Form -->
    </div>
    <!-- End Body -->
</div>
