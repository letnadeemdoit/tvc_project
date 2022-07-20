<x-app-layout>
    <div class="card">
        <!-- Header -->
        <div class="card-header">
{{--            <div class="row justify-content-between align-items-center flex-grow-1">--}}
{{--                <div class="col-12 col-md">--}}
{{--                    <div class="d-flex justify-content-between align-items-center">--}}
{{--                        <h5 class="card-header-title">Blogs</h5>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-auto">--}}
{{--                    <!-- Filter -->--}}
{{--                    <form>--}}
{{--                        <!-- Search -->--}}
{{--                        <div class="input-group input-group-merge input-group-flush">--}}
{{--                            <div class="input-group-prepend input-group-text">--}}
{{--                                <i class="bi-search"></i>--}}
{{--                            </div>--}}
{{--                            <input id="datatableWithSearchInput" type="search" class="form-control" placeholder="Search users" aria-label="Search users">--}}
{{--                        </div>--}}
{{--                        <!-- End Search -->--}}
{{--                    </form>--}}
{{--                    <!-- End Filter -->--}}
{{--                </div>--}}
{{--            </div>--}}
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
                    <th>Audit First Name</th>
                    <th>Audit Last Name</th>
                    <th>Audit Email</th>
                    <th>Board</th>


                </tr>
                </thead>

                <tbody>
                @if(!empty($boards))
                    @foreach($boards as $key => $board)
                        <tr>
                            <td>{{ isset($board->HouseId) ? $board->HouseId : ''}}</td>
                            <td>{{ isset($board->Audit_user_name) ? $board->Audit_user_name : ''}}</td>
                            <td>{{ isset($board->Audit_Role) ? $board->Audit_Role : ''}}</td>
                            <td>{{ isset($board->Audit_FirstName) ? $board->Audit_FirstName : ''}}</td>
                            <td>{{ isset($board->Audit_LastName) ? $board->Audit_LastName : ''}}</td>
                            <td>{{ isset($board->Audit_Email) ? $board->Audit_Email : ''}}</td>
{{--                            @php $data = $board->Board @endphp--}}
                            <td>

                                {{ isset($board->Board) ? Str::limit(strip_tags($board->Board), 10) : ''}}</td>
                        </tr>

                    @endforeach


                @endif
                <tr>

                </tr>





                </tbody>
            </table>
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
    </div>

</x-app-layout>
