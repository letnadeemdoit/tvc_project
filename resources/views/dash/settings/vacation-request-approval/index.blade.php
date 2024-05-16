
<x-settings>
    @push('stylesheets')
        <link href="{{asset('vendors/tokenize2/tokenize2.min.css')}}" rel="stylesheet" />
        <link href="{{asset('vendors/amsify/amsify.suggestags.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @endpush
    <x-slot name="title">
        Vacation Request Approval
    </x-slot>
    <x-slot name="headerRightActions">
        <div class="col-sm-auto" x-data>

        </div>
    </x-slot>
    <livewire:settings.vacation-request-approval.owners-vacation-approval-list :user="$user" />


</x-settings>
