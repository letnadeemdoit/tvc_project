<x-settings>
    <x-slot name="title">
        @if($user->is_admin)
            Account Information
        @else
            Manage Account
        @endif
    </x-slot>
    <div class="d-grid gap-3 gap-lg-5">
        <!-- Card -->
        <livewire:settings.account-information.profile-photo-form :user="$user"/>
        <!-- End Card -->

        <!-- Card -->
        <livewire:settings.account-information.update-basic-information-form :user="$user"/>
        <!-- End Card -->

        <!-- Card -->
        <livewire:settings.account-information.update-email-form :user="$user"/>
        <!-- End Card -->

        <!-- Card -->
        <livewire:settings.account-information.change-password-form :user="$user"/>
        <!-- End Card -->

        @if($user->is_admin && $user->hasGuest())
            <!-- Card -->
            <livewire:settings.account-information.guest-password-form :user="$user"/>
            <!-- End Card -->
        @endif

        <!-- Card -->
        <livewire:settings.account-information.update-preferences-form :user="$user"/>
        <!-- End Card -->
        <!-- Card -->
        <livewire:settings.account-information.recent-devices-and-logout-other-browser-sessions-form :user="$user"/>
        <!-- End Card -->
    </div>
</x-settings>
