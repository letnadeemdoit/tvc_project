<div id="emailSection" class="card">
    <div class="card-header">
        <h4 class="card-title">Email</h4>
    </div>

    <!-- Body -->
    <div class="card-body">
        <p>Your current email address is <span class="fw-semi-bold">{{ $this->user->email }}</span></p>
        <!-- Form -->
        <form wire:submit.prevent="changeEmail">
            <!-- Form -->
            <div class="row mb-4">
                <label for="new_email" class="col-sm-3 col-form-label form-label">New email address</label>

                <div class="col-sm-9">
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email"
                        id="new_email"
                        wire:model.defer="email"
                        placeholder="Enter new email address"
                        aria-label="Enter new email address"
                    />
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- End Form -->

            <div class="d-flex align-items-center justify-content-end">
                <x-jet-action-message class="text-success me-2" on="saved">
                    Your email has been changed successfully and we have emailed you verification link.
                </x-jet-action-message>
                <button type="submit" class="btn btn-primary">Change Email</button>
            </div>
        </form>
        <!-- End Form -->
    </div>
    <!-- End Body -->
</div>
