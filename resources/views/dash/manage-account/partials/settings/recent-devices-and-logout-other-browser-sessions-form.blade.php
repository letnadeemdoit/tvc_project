<div id="recentDevicesSection" class="card">
    <div class="card-header">
        <h4 class="card-title">Recent devices</h4>
    </div>

    <!-- Body -->
    <div class="card-body">
        <p class="card-text">Manage and log out your active sessions on other browsers and devices.</p>
        <p class="card-text">If necessary, you may log out of all of your other browser sessions across all of your
            devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you
            feel your account has been compromised, you should also update your password.</p>
    </div>
    <!-- End Body -->

    @if (count($this->sessions) > 0)
        <div class="px-4 py-2">
            <!-- Other Browser Sessions -->
            @foreach ($this->sessions as $session)
                <div class="d-flex justify-items-center">
                    <div>
                        @if ($session->agent->isDesktop())
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 viewBox="0 0 24 24" stroke="currentColor" class="text-secondary"
                                 style="width: 25px; height: 25px">
                                <path
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2"
                                 stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                 class="text-secondary" style="width: 25px; height: 25px">
                                <path d="M0 0h24v24H0z" stroke="none"></path>
                                <rect x="7" y="4" width="10" height="16" rx="1"></rect>
                                <path d="M11 5h2M12 17v.01"></path>
                            </svg>
                        @endif
                    </div>

                    <div class="ms-3">
                        <div class="text-sm text-secondary">
                            {{ $session->agent->platform() ? $session->agent->platform() : 'Unknown' }}
                            - {{ $session->agent->browser() ? $session->agent->browser() : 'Unknown' }}
                        </div>

                        <div>
                            <div class="text-xs text-secondary">
                                {{ $session->ip_address }},

                                @if ($session->is_current_device)
                                    <span class="text-success fw-semi-bold">{{ __('This device') }}</span>
                                @else
                                    {{ __('Last active') }} {{ $session->last_active }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex align-items-center justify-content-end mt-5 mb-4 px-4">
            <x-jet-action-message class="text-success me-2" on="loggedOut">
                {{ __('Done.') }}
            </x-jet-action-message>
            <button class="btn btn-primary" wire:click.prevent="confirmLogout" wire:loading.attr="disabled">
                {{ __('Log Out Other Browser Sessions') }}
            </button>
        </div>
    @endif
    @push('modals')
        <x-modals.bs-modal wire:model="confirmingLogout">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordConfirmationLabel">Log Out Other Browser Sessions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="$toggle('confirmingLogout')"></button>
                </div>
                <div class="modal-body">
                    <p class="card-text">Please enter your password to confirm you would like to log out of your other
                        browser sessions across all of your devices.</p>
                    <div class="mt-4" x-data="{}"
                         x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                        <input
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="{{ __('Password') }}"
                            x-ref="password"
                            wire:model.defer="password"
                            wire:keydown.enter="logoutOtherBrowserSessions"
                        />
                        @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-white"
                        data-bs-dismiss="modal"
                        wire:click="$toggle('confirmingLogout')"
                        wire:loading.attr="disabled"
                    >
                        {{ __('Cancel') }}
                    </button>
                    <button
                        type="button"
                        class="btn btn-primary"
                        wire:click.prevent="logoutOtherBrowserSessions"
                        wire:loading.attr="disabled"
                    >
                        {{ __('Log Out Other Browser Sessions') }}
                    </button>
                </div>
            </div>
        </x-modals.bs-modal>
    @endpush
</div>
