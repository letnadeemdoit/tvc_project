<x-settings>
    @push('stylesheets')
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
        <style>
            .message-color{
                color: rgba(var(--bs-success-rgb),var(--bs-text-opacity)) !important;
            }
        </style>

    @endpush
    <x-slot name="title">
        Calendar Settings
    </x-slot>
    <div class="d-grid gap-3 gap-lg-5">
        <!-- Card -->
        @if($user->is_admin)
            <!-- Card -->
            <livewire:settings.calendar-settings.enable-or-disable-rooms :user="$user"/>
            <!-- End Card -->
        @endif

        @if($user->is_admin)
            <!-- Card -->
            <livewire:settings.calendar-settings.enable-scheduling-window :user="$user"/>
            <!-- End Card -->
        @endif


        @if($user->is_admin)
            <!-- Card -->
            <livewire:settings.calendar-settings.update-start-end-time-of-vacation :user="$user"/>
            <!-- End Card -->
        @endif

        @if($user->is_admin)
            <!-- Card -->
            <livewire:settings.calendar-settings.enable-calendar-rows-height :user="$user"/>
            <!-- End Card -->
        @endif

        @if($user->is_admin)
            <!-- Card -->
            <livewire:settings.calendar-settings.enable-owner-vacation-approval :user="$user"/>
            <!-- End Card -->
        @endif

        @if($user->is_admin)
            <!-- Card -->
            <livewire:settings.calendar-settings.allow-overlapping-vacations :user="$user"/>
            <!-- End Card -->
        @endif

        @if($user->is_admin)
            <!-- Card -->
            <livewire:settings.calendar-settings.allow-guest-to-schedule-vacations :user="$user"/>
            <!-- End Card -->
        @endif

        @if($user->is_admin)
            <!-- Card -->
            <livewire:settings.calendar-settings.enable-calendar-entries :user="$user"/>
            <!-- End Card -->
        @endif


        <!-- End Card -->
    </div>
</x-settings>
