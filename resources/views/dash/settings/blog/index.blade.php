
<x-settings>
    @push('stylesheets')
        <link href="{{asset('vendors/tokenize2/tokenize2.min.css')}}" rel="stylesheet" />
        <link href="{{asset('vendors/amsify/amsify.suggestags.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @endpush
    <x-slot name="title">
        Blog
    </x-slot>
    <x-slot name="headerRightActions">
        <div class="col-sm-auto" x-data>
            <a
                class="btn btn-primary"
                href="javascript:;"
                @click.prevent="window.livewire.emit('showBlogCUModal', true)"
            >
                <i class="bi-plus me-1"></i> Add New Blog
            </a>
        </div>
    </x-slot>
    <livewire:settings.blog.blog-item-list :user="$user" />
    <livewire:settings.blog.create-or-update-blog-item-form :user="$user" />


</x-settings>
