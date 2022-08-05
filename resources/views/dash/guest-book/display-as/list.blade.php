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
                    <h5 class="card-header-title">Guest Book</h5>
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
                <th>UserId</th>
                <th>HouseId</th>
                <th>Title</th>
                <th>Name</th>
                <th>Image</th>
                <th>Content</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>

            <tbody>

            @if(isset($bookdata) && !empty($bookdata))
                @foreach($bookdata as $book)
                    <tr>
                        <td>
                           <span>{{$book->user_id}}</span>
                        </td>
                        <td>
                            <span>{{$book->house_id}}</span>
                        </td>
                        <td>
                            <span>{{$book->title ?? ''}}</span>
                        </td>
                        <td>
                            <span>{{$book->name ?? ''}}</span>
                        </td>
                        <td>
                            <span>{{$book->image ?? ''}}</span>
                        </td>
                        <td>
                            <span>{{$book->content ?? ''}}</span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Edit group">
                                <a class="btn btn-ghost-success" href="#" wire:click="editGuestBook({{ $book->id }})">
                                    <i class="bi-pencil me-1"></i> Edit
                                </a>
                                <a class="btn btn-ghost-danger" href="#"
                                   data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{ $book->id }}Modal"
                                >
                                    <i class="bi-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif


            </tbody>
        </table>
        <div class="d-flex mt-4">
            {!! $bookdata->links() !!}
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

    @if(isset($bookdata))
        @foreach($bookdata as $book)
            <x-modals.delete-confirmation :id="$book->id" action="destroy({{$book->id}})"/>
        @endforeach
    @endif
{{--    @livewire('guest-book.display-as.add-or-update-guest-book', ['id'=>$book->id])--}}
    @include('dash.guest-book.display-as.create-or-update-book')


</div>



