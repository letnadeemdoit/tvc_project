<x-guest-layout>
    @push('stylesheets')
    <style>
       .switch-button .active{
            background-color: #fff;
            color: #2A3342 !important;
        }

    </style>
    @endpush


    @include('partials.sub-page-hero-section', ['title' => 'Food List'])


        <livewire:house-items.house-item-front-list/>

</x-guest-layout>
