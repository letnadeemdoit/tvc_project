<div>
    <div class="card">
        <!-- Header -->
        <div class="card-header">
            <div class="row justify-content-between align-items-center flex-grow-1">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="col-12 col-md">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-header-title">Photo Albums</h5>
                    </div>
                </div>
                <div class="col-auto">
                    <!-- Filter -->
                    <form>
                        <!-- Search -->
                        <div class="input-group input-group-merge input-group-flush">
                            <div class="input-group-prepend input-group-text">
                                <i class="bi-search"></i>
                            </div>
                            <input id="datatableWithSearchInput" type="search" class="form-control"
                                   placeholder="Search users" aria-label="Search users">
                        </div>
                        <!-- End Search -->
                    </form>
                    <!-- End Filter -->
                </div>
            </div>
        </div>
        <!-- End Header -->

        <!-- Table -->
        <div class="table-responsive datatable-custom">
            <table
                class="js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                data-hs-datatables-options='{
                   "order": [],
                   "search": "#datatableWithSearchInput",
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatableWithSearchPagination"
                 }'>
                <thead class="thead-light">
                <tr>
                    <th style="width: 25%;">Name</th>
                    <th style="width: 25%;">Parent Album</th>
                    <th style="width: 30%;">Description</th>
                    <th style="width: 20%;">Action</th>
                </tr>
                </thead>

                <tbody>

                @if(isset($albums))
                    @foreach($albums as $album)
                        <tr>
                            <td>{{$album->name}}</td>
                            <td>{{$album->parentAlbum->name ?? ''}}</td>
                            <td>{{$album->description}}</td>

                            <td>
                                <div class="btn-group" role="group" aria-label="Edit group">
                                    <a class="btn btn-white" href="#"
                                       wire:click="edit({{ $album->id }})"
                                    >
                                        <i class="bi-pencil me-1 text-success"></i> Edit
                                    </a>
                                    <a class="btn btn-white" href="#"
                                       data-bs-toggle="modal"
                                       data-bs-target="#deleteConfirmation{{ $album->id }}Modal"
                                    >
                                        <i class="bi-trash text-danger"></i>
                                    </a>

                                    <a class="btn btn-primary"
{{--                                       href="{{route('dash.show-single-album',$album->id)}}"--}}
                                    >
                                        Add Photo Album <i class="bi-arrow-right text-white"></i>
                                    </a>


                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif


                </tbody>
            </table>
            <div class="d-flex mt-4">
                {!! $albums->links() !!}
            </div>
        </div>
        <!-- End Table -->

        <!-- Footer -->
        <div class="card-footer">
            <!-- Pagination -->
            <div class="d-flex justify-content-center justify-content-sm-end">
                <nav id="datatableWithSearchPagination" aria-label="Activity pagination"></nav>
            </div>
            <!-- End Pagination -->
        </div>
        <!-- End Footer -->



        {{--    Create Photo Album Model--}}

        <div class="modal fade hideableModal createOrUpdateModal" id="createPhotoAlbum" tabindex="-1"
             aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title text-primary" id="exampleModalLabel">
                            @if($updateMode)
                                Update Photo Album
                            @else
                                Create Photo Album
                            @endif
                        </h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="">
                        <form
                            @if($updateMode)
                            wire:submit.prevent="UpdatePhotoAlbum"
                            @else
                            wire:submit.prevent="createPhotoAlbum"
                            @endif

                        >
                            <div class="row">

                                @if($updateMode)
                                    <input type="hidden" name="id" id="id" wire:model.defer="state.id">
                                @endif

                                <div class="mb-3">
                                    <label class="form-label" for="parent_id">Select Parent Album</label>
                                    <select id="parent_id" wire:model.defer="state.parent_id" name="parent_id" class="form-control select2 js-example-basic-multipl">
                                        <option value="">Select Parent Album...</option>
                                        @if(isset($albums))
                                            @foreach($albums as $album)
                                                <option value="{{$album->id}}">{{$album->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="name">Album Name</label>
                                    <input type="text" id="name" wire:model.defer="state.name" name="name" class="form-control" placeholder="Album Name Here">
                                    @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="description">Description</label>
                                    <textarea id="description" wire:model.defer="state.description" class="form-control" name="description" placeholder="Description" rows="4"></textarea>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary px-5">
                                        @if($updateMode)
                                            Update
                                        @else
                                            Save
                                        @endif
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{--    End Create Photo Album Model--}}



        @if(isset($albums))
            @foreach($albums as $album)

                <x-modals.delete-confirmation :id="$album->id" action="destroy({{$album->id}})"/>

            @endforeach
        @endif

    </div>

</div>
