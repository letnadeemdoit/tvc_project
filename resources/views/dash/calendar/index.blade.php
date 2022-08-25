<x-dashboard-layout>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item active" aria-current="page">Calendar</li>
    </x-slot>
    <x-slot name="title">
        <h1 class="page-header-title">Calendar</h1>
    </x-slot>

    <x-slot name="headerRightActions">
{{--        <div class="col-sm-auto" x-data>--}}
{{--            <a--}}
{{--                class="btn btn-primary"--}}
{{--                href="javascript:;"--}}
{{--                @click.prevent="window.livewire.emit('showFoodItemCUModal', true)"--}}
{{--            >--}}
{{--                <i class="bi-plus me-1"></i> Add New Food Item--}}
{{--            </a>--}}
{{--        </div>--}}
    </x-slot>
    <livewire:calendar.calendar-view :user="$user" />
</x-dashboard-layout>
