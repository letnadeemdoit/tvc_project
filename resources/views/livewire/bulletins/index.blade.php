
<div class="card">
    <div class="card-header">
        <div class="row justify-content-between align-items-center flex-grow-1">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-12 col-md">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-header-title">Bulletins</h5>
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
                               placeholder="Search Bulletin" aria-label="Search Bulletin">
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
        <table class="js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
               data-hs-datatables-options='{
                   "order": [],
                   "search": "#datatableWithSearchInput",
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatableWithSearchPagination"
                 }'>
            <thead class="thead-light">
            <tr>
                <th>HouseId</th>
                <th>Audit User Name</th>
                <th>Audit Role</th>
                <th>Audit Last Name</th>
                <th>Audit Email</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>

            <tbody>
            @if(isset($boards) && !empty($boards))
                @foreach($boards as $key => $board)
                    <tr>
                        <td>
                            <a class="d-flex align-items-center" href="../user-profile.html">
                                <div class="avatar avatar-soft-primary avatar-circle">
                                    <span class="avatar-initials">{{!empty($board->Audit_FirstName) ? substr($board->Audit_FirstName, 0, 1) : 'A'}}</span>
                                </div>
                                <div class="ms-3">
                                    <span class="d-block h5 text-inherit mb-0">{{$board->Audit_FirstName ?? ''}} <i
                                            class="bi-patch-check-fill text-primary" data-toggle="tooltip"
                                            data-bs-placement="top" title="Top endorsed"></i></span>
                                    <span class="d-block fs-5 text-body">{{$board->Audit_Email ?? ''}}</span>
                                </div>
                            </a>
                        </td>
                        <td>{{ isset($board->Audit_user_name) ? $board->Audit_user_name : ''}}</td>
                        <td>{{ isset($board->Audit_Role) ? $board->Audit_Role : ''}}</td>
                        <td>{{ isset($board->Audit_LastName) ? $board->Audit_LastName : ''}}</td>
                        <td>{{ isset($board->Audit_Email) ? $board->Audit_Email : ''}}</td>
{{--                        <td>--}}
{{--                            <span class="legend-indicator @if(!empty($board->Board)) bg-success @else bg-warning @endif"></span>{{!empty($board->Board) ? 'Active' : 'inActive'}}--}}
{{--                        </td>--}}
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Edit group">
                                <a class="btn btn-ghost-success" title="Edit Blog" href="#" wire:click="editBoardData({{ $board->HouseId }})">
                                    <i class="bi-pencil me-1"></i> Edit
                                </a>
                                <a class="btn btn-ghost-danger" href="#"
                                   data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{ $board->HouseId }}Modal"
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
        <div class="d-flex mt-4 text-center">
            {!! $boards->links() !!}
        </div>
    </div>
    <!-- End Table -->
    @if(isset($boards))
        @foreach($boards as $board)
            <x-modals.delete-confirmation :id="$board->HouseId" action="destroy({{$board->HouseId}})"/>
        @endforeach
    @endif
    @include('livewire.bulletins.bulletins-add-update')
</div>






