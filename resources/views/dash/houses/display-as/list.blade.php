<div class="card">
    <!-- Header -->
    <div class="card-header">
        <div class="row justify-content-between align-items-center flex-grow-1">
            <div class="col-12 col-md">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-header-title">Houses</h5>
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
                <th>House Name</th>
                <th>City</th>
                <th>State</th>
                <th>ZipCode</th>
                <th>Home Phone</th>
                <th>Referred By</th>
                <th>Status</th>
                <th>Guest</th>
                <th>More Details</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>

            @if(isset($houses))
                @foreach($houses as $house)
                    <tr>
                        <td>
                            <a class="d-flex align-items-center" href="#">
                                <div class="avatar avatar-soft-primary avatar-circle">
                                    <span class="avatar-initials">{{substr($house->HouseName, 0, 1)}}</span>
                                </div>
                                <div class="ms-3">
                                    <span class="d-block h5 text-inherit mb-0">{{$house->HouseName}} </span>
                                    <span class="d-block fs-5 text-body">{{$house->Address1}}</span>
                                </div>
                            </a>
                        </td>

                        <td>{{$house->City}}</td>
                        <td>{{$house->State}}</td>
                        <td>{{$house->ZipCode}}</td>
                        <td>{{$house->HomePhone}}</td>
                        <td>{{$house->ReferredBy}}</td>
                        <td>{{$house->Status}}</td>
                        <td>{{$house->Guest}}</td>
                        <td>
                            <a class="btn btn-sm btn-success text-white"
                                data-bs-toggle="modal"
                                data-bs-target="#moreHouse{{$house->HouseID}}Modal"
                                href="#!">Click For More Details</a>
                        </td>

                        <!-- Modal -->
                        <div class="modal fade" id="moreHouse{{$house->HouseID}}Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title text-primary" id="exampleModalLabel">House More Details</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="row">
                                          <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                                              <div class="card shadow-none">
                                                  <div class="card-body">
                                                      <h3 class="">House Details</h3>
                                                      <hr>
                                                      <div class="mb-3">
                                                          <h5 class="card-title">House Name</h5>
                                                          <h6 class="card-subtitle mb-2 text-muted">{{$house->HouseName}}</h6>
                                                      </div>
                                                      <div class="mb-3">
                                                          <h5 class="card-title">House Address 1</h5>
                                                          <h6 class="card-subtitle mb-2 text-muted">{{$house->Address1}}</h6>
                                                      </div>
                                                      <div class="mb-3">
                                                          <h5 class="card-title">House Address 2</h5>
                                                          <h6 class="card-subtitle mb-2 text-muted">{{$house->Address2}}</h6>
                                                      </div>
                                                      <div class="mb-3">
                                                          <h5 class="card-title">City</h5>
                                                          <h6 class="card-subtitle mb-2 text-muted">{{$house->City}}</h6>
                                                      </div>
                                                      <div class="mb-3">
                                                          <h5 class="card-title">State</h5>
                                                          <h6 class="card-subtitle mb-2 text-muted">{{$house->State}}</h6>
                                                      </div>
                                                      <div class="mb-3">
                                                          <h5 class="card-title">Home Phone</h5>
                                                          <h6 class="card-subtitle mb-2 text-muted">{{$house->HomePhone}}</h6>
                                                      </div>
                                                      <div class="mb-3">
                                                          <h5 class="card-title">Fax</h5>
                                                          <h6 class="card-subtitle mb-2 text-muted">{{$house->Fax}}</h6>
                                                      </div>
                                                      <div class="mb-3">
                                                          <h5 class="card-title">Emergency Phone</h5>
                                                          <h6 class="card-subtitle mb-2 text-muted">{{$house->EmergencyPhone}}</h6>
                                                      </div>
                                                      <div class="mb-3">
                                                          <h5 class="card-title">Cal Email List</h5>
                                                          <h6 class="card-subtitle mb-2 text-muted">{{$house->CalEmailList}}</h6>
                                                      </div>
                                                      <div class="mb-3">
                                                          <h5 class="card-title">Blog Email List</h5>
                                                          <h6 class="card-subtitle mb-2 text-muted">{{$house->BlogEmailList}}</h6>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                                              <div class="card shadow-none">
                                                  <div class="card-body">
                                                      <h3 class="">Audit Details</h3>
                                                      <hr>
                                                      <div class="mb-3">
                                                          <h5 class="card-title">Audit User Name</h5>
                                                          <h6 class="card-subtitle mb-2 text-muted">{{$house->Audit_user_name}}</h6>
                                                      </div>
                                                      <div class="mb-3">
                                                          <h5 class="card-title">Audit Role</h5>
                                                          <h6 class="card-subtitle mb-2 text-muted">{{$house->Audit_Role}}</h6>
                                                      </div>
                                                      <div class="mb-3">
                                                          <h5 class="card-title">Audit First Name</h5>
                                                          <h6 class="card-subtitle mb-2 text-muted">{{$house->Audit_FirstName}}</h6>
                                                      </div>
                                                      <div class="mb-3">
                                                          <h5 class="card-title">Audit Last Name</h5>
                                                          <h6 class="card-subtitle mb-2 text-muted">{{$house->Audit_LastName}}</h6>
                                                      </div>
                                                      <div class="mb-3">
                                                          <h5 class="card-title">Audit Email</h5>
                                                          <h6 class="card-subtitle mb-2 text-muted">{{$house->Audit_Email}}</h6>
                                                      </div>
                                                  </div>
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
                                   data-bs-toggle="modal"
                                   data-bs-target="#"
                                >
                                    <i class="bi-pencil me-1"></i> Edit
                                </a>
                                <a class="btn btn-white" href="#"
                                   data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal"
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
            {!! $houses->links() !!}
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

    @if(isset($houses))
        @foreach($houses as $house)

            <x-modals.delete-confirmation :id="$house->HouseID" action="destroy({{$house->HouseID}})"/>

        @endforeach
    @endif


</div>
