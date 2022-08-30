<x-settings>
    <x-slot name="title">
        Account Information
    </x-slot>

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

    @if($user->is_admin)
        <!-- Card -->
        <livewire:settings.account-information.update-preferences-form :user="$user"/>
        <!-- End Card -->
    @endif
    <!-- Card -->
    <livewire:settings.account-information.recent-devices-and-logout-other-browser-sessions-form :user="$user"/>
    <!-- End Card -->
</x-settings>
