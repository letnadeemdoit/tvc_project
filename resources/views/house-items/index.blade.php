<x-guest-layout>
    @push('stylesheets')
        <link href="{{asset('vendors/tokenize2/tokenize2.min.css')}}" rel="stylesheet" />
        <link href="{{asset('vendors/amsify/amsify.suggestags.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
            .switch-button .active{
                background-color: #fff;
                color: #2A3342 !important;
            }

        </style>
    @endpush




        <livewire:house-items.house-item-front-list/>

        <livewire:house-items.food-item.create-or-update-food-item-form :user="$user"/>
        <livewire:house-items.shopping-item.create-or-update-shopping-item-form :user="$user"/>


 @push('scripts')

 @endpush
</x-guest-layout>
