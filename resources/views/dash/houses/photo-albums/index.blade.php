<x-dashboard-layout>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item active" aria-current="page">Photo Album</li>
    </x-slot>

    <x-slot name="title">
        Photo Albums
    </x-slot>

    <x-slot name="headerRightActions">
        <div class="col-sm-auto" x-data>
            <a
                class="btn btn-primary"
                href="javascript:;"
                @click.prevent="window.livewire.emit('showAlbumCUModal', true)"
            >
                <i class="bi-plus me-1"></i> Add New Album
            </a>
        </div>
    </x-slot>

    <div class="content container-fluid">

        <livewire:houses.photo-albums.photo-album-list :user="$user"/>

        <livewire:houses.photo-albums.create-or-update-photo-album :user="$user"/>

    </div>
</x-dashboard-layout>

