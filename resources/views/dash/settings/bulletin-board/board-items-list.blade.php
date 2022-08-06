<div>

    <div class="card">
        <!-- Header -->
        <div class="card-header">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col-12 col-md">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-header-title">Bulletin Board</h5>
                    </div>
                </div>

                <div class="col-auto">
                    <!-- Filter -->
                    <form>
                        <!-- Search -->
                        <div class="input-group input-group-merge input-group-flush">
                            <div class="input-group-prepend input-group-text" wire:loading.remove>
                                <i class="bi-search"></i>
                            </div>

                            <div class="input-group-prepend input-group-text" wire:loading wire:target="searchQuery">
                                <div class="spinner-border" style="width: 20px;height: 20px" role="status">
                                </div>
                            </div>

                            <input wire:model="searchQuery" id="datatableWithSearchInput" type="search" class="form-control"
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
                    <th>Audit Name</th>
{{--                    <th style="width: 25%;">House</th>--}}
                    <th style="width: 25%;">Title</th>
                    <th style="width: 20%;">Description</th>
                    <th style="width: 20%;">Audit Details</th>
                    <th style="width: 20%;">Action</th>
                </tr>
                </thead>

                <tbody>

                @if(isset($data))
                    @foreach($data as $d)
                        <tr>
                            <td>
                                <a class="d-flex align-items-center" href="#">
                                    <div class="avatar avatar-soft-primary avatar-circle">
                                        <img src="{{$d->image ? asset('storage/'.$d->image) : asset('storage/photos/placeholder-image.png')}}" class="avatar-initials"/>
                                    </div>
                                    <div class="ms-3">
                                        <span class="d-block h5 text-inherit mb-0">{{$d->Audit_user_name ?? ''}} </span>
                                    </div>
                                </a>
                            </td>

{{--                            <td>{{$d->house->HouseName ?? ''}}</td>--}}
                            <td>{{$d->title ?? ''}}</td>
                            <td>
                                <a
                                    data-bs-toggle="modal"
                                    data-bs-target="#bulletinDetails{{$loop->iteration}}Modal"
                                    class="btn btn-sm btn-soft-info" href="">View Description</a>
                            </td>

                            <div class="modal fade" id="bulletinDetails{{$loop->iteration}}Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title text-primary" id="exampleModalLabel">{{$d->title ?? ''}} Board Details</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="overflow-y: hidden">
                                          <div>
                                              <div>
                                              </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <td>
                                @if(!is_null($d->Audit_user_name))
                                    <a class="btn btn-sm btn-soft-success"
                                       data-bs-toggle="modal"
                                       data-bs-target="#audit{{$loop->iteration}}Modal"
                                       style="" href="#!">Audit Details</a>
                                @else
                                    <a class="btn btn-sm btn-soft-warning" href="#!">No Audit</a>
                                @endif
                            </td>

                            <!-- Modal -->
                            <div class="modal fade" id="audit{{$loop->iteration}}Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title text-primary" id="exampleModalLabel">Audit Details</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card shadow-none border-0">
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <h5 class="card-title">Audit User Name</h5>
                                                        <h6 class="card-subtitle mb-2 text-muted">{{$d->Audit_user_name}}</h6>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h5 class="card-title">Audit Role</h5>
                                                        <h6 class="card-subtitle mb-2 text-muted">{{$d->Audit_Role}}</h6>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h5 class="card-title">Audit First Name</h5>
                                                        <h6 class="card-subtitle mb-2 text-muted">{{$d->Audit_FirstName}}</h6>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h5 class="card-title">Audit Last Name</h5>
                                                        <h6 class="card-subtitle mb-2 text-muted">{{$d->Audit_LastName}}</h6>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h5 class="card-title">Audit Email</h5>
                                                        <h6 class="card-subtitle mb-2 text-muted">{{$d->Audit_Email}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <td>
                                <div class="btn-group" role="group" aria-label="Edit group">
                                    <a class="btn btn-white" href="#"
                                       wire:click="$emit('showBulletinBoardModal', true, {{$d->id}})"
                                    >
                                        <i class="bi-pencil me-1 text-success"></i> Edit
                                    </a>
                                    <a class="btn btn-white" href="#"
                                       data-bs-toggle="modal"
                                         data-bs-target="#deleteConfirmation{{ $d->id }}Modal"
                                    >
                                        <i class="bi-trash text-danger"></i>
                                    </a>

                                </div>
                            </td>

                        </tr>
                    @endforeach
                @endif


                </tbody>


            </table>
            <div class="d-flex mt-4">
                {!! $data->links() !!}
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

        @if(isset($data))
            @foreach($data as $d)

                <x-modals.delete-confirmation :id="$d->id" action="destroy({{$d->id}})"/>

            @endforeach
        @endif


    </div>

</div>
