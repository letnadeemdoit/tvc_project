<x-guest-layout>
    @push('stylesheets')
    <style>
       .switch-button .active{
            background-color: #fff;
            color: #2A3342 !important;
        }

    </style>
    @endpush




        <livewire:house-items.house-item-front-list/>


 @push('scripts')

 @endpush
</x-guest-layout>
