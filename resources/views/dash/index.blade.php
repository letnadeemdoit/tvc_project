<x-app-layout>

        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h1 class="page-header-title">Dashboard</h1>
                    </div>
                    <!-- End Col -->

                    <div class="col-auto">
{{--                        <a class="btn btn-primary" href="javascript:;" data-bs-toggle="modal" data-bs-target="#inviteUserModal">--}}
{{--                            <i class="bi-person-plus-fill me-1"></i> Invite users--}}
{{--                        </a>--}}
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
            <!-- End Page Header -->

            <!-- Stats -->
            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="#">
                        <div class="card-body">
                            <h6 class="card-subtitle">Total Users</h6>

                            <div class="row align-items-center gx-2 mb-1">
                                <div class="col-6">
                                    <h2 class="card-title text-inherit">72,540</h2>
                                </div>
                                <!-- End Col -->

                                <div class="col-6">
                                    <!-- Chart -->
                                    <div class="chartjs-custom" style="height: 3rem;">
                                        <canvas class="js-chart" data-hs-chartjs-options='{
                              "type": "line",
                              "data": {
                                 "labels": ["1 May","2 May","3 May","4 May","5 May","6 May","7 May","8 May","9 May","10 May","11 May","12 May","13 May","14 May","15 May","16 May","17 May","18 May","19 May","20 May","21 May","22 May","23 May","24 May","25 May","26 May","27 May","28 May","29 May","30 May","31 May"],
                                 "datasets": [{
                                  "data": [21,20,24,20,18,17,15,17,18,30,31,30,30,35,25,35,35,40,60,90,90,90,85,70,75,70,30,30,30,50,72],
                                  "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
                                  "borderColor": "#377dff",
                                  "borderWidth": 2,
                                  "pointRadius": 0,
                                  "pointHoverRadius": 0
                                }]
                              },
                              "options": {
                                 "scales": {
                                   "yAxes": [{
                                     "display": false
                                   }],
                                   "xAxes": [{
                                     "display": false
                                   }]
                                 },
                                "hover": {
                                  "mode": "nearest",
                                  "intersect": false
                                },
                                "tooltips": {
                                  "postfix": "k",
                                  "hasIndicator": true,
                                  "intersect": false
                                }
                              }
                            }'>
                                        </canvas>
                                    </div>
                                    <!-- End Chart -->
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->

                            <span class="badge bg-soft-success text-success">
                <i class="bi-graph-up"></i> 12.5%
              </span>
                            <span class="text-body fs-6 ms-1">from 70,104</span>
                        </div>
                    </a>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="#">
                        <div class="card-body">
                            <h6 class="card-subtitle">Sessions</h6>

                            <div class="row align-items-center gx-2 mb-1">
                                <div class="col-6">
                                    <h2 class="card-title text-inherit">29.4%</h2>
                                </div>
                                <!-- End Col -->

                                <div class="col-6">
                                    <!-- Chart -->
                                    <div class="chartjs-custom" style="height: 3rem;">
                                        <canvas class="js-chart" data-hs-chartjs-options='{
                              "type": "line",
                              "data": {
                                 "labels": ["1 May","2 May","3 May","4 May","5 May","6 May","7 May","8 May","9 May","10 May","11 May","12 May","13 May","14 May","15 May","16 May","17 May","18 May","19 May","20 May","21 May","22 May","23 May","24 May","25 May","26 May","27 May","28 May","29 May","30 May","31 May"],
                                 "datasets": [{
                                  "data": [21,20,24,20,18,17,15,17,30,30,35,25,18,30,31,35,35,90,90,90,85,100,120,120,120,100,90,75,75,75,90],
                                  "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
                                  "borderColor": "#377dff",
                                  "borderWidth": 2,
                                  "pointRadius": 0,
                                  "pointHoverRadius": 0
                                }]
                              },
                              "options": {
                                 "scales": {
                                   "yAxes": [{
                                     "display": false
                                   }],
                                   "xAxes": [{
                                     "display": false
                                   }]
                                 },
                                "hover": {
                                  "mode": "nearest",
                                  "intersect": false
                                },
                                "tooltips": {
                                  "postfix": "%",
                                  "hasIndicator": true,
                                  "intersect": false
                                }
                              }
                            }'>
                                        </canvas>
                                    </div>
                                    <!-- End Chart -->
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->

                            <span class="badge bg-soft-success text-success">
                <i class="bi-graph-up"></i> 1.7%
              </span>
                            <span class="text-body fs-6 ms-1">from 29.1%</span>
                        </div>
                    </a>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="#">
                        <div class="card-body">
                            <h6 class="card-subtitle">Avg. Click Rate</h6>

                            <div class="row align-items-center gx-2 mb-1">
                                <div class="col-6">
                                    <h2 class="card-title text-inherit">56.8%</h2>
                                </div>
                                <!-- End Col -->

                                <div class="col-6">
                                    <!-- Chart -->
                                    <div class="chartjs-custom" style="height: 3rem;">
                                        <canvas class="js-chart" data-hs-chartjs-options='{
                              "type": "line",
                              "data": {
                                 "labels": ["1 May","2 May","3 May","4 May","5 May","6 May","7 May","8 May","9 May","10 May","11 May","12 May","13 May","14 May","15 May","16 May","17 May","18 May","19 May","20 May","21 May","22 May","23 May","24 May","25 May","26 May","27 May","28 May","29 May","30 May","31 May"],
                                 "datasets": [{
                                  "data": [25,18,30,31,35,35,60,60,60,75,21,20,24,20,18,17,15,17,30,120,120,120,100,90,75,90,90,90,75,70,60],
                                  "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
                                  "borderColor": "#377dff",
                                  "borderWidth": 2,
                                  "pointRadius": 0,
                                  "pointHoverRadius": 0
                                }]
                              },
                              "options": {
                                 "scales": {
                                   "yAxes": [{
                                     "display": false
                                   }],
                                   "xAxes": [{
                                     "display": false
                                   }]
                                 },
                                "hover": {
                                  "mode": "nearest",
                                  "intersect": false
                                },
                                "tooltips": {
                                  "postfix": "%",
                                  "hasIndicator": true,
                                  "intersect": false
                                }
                              }
                            }'>
                                        </canvas>
                                    </div>
                                    <!-- End Chart -->
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->

                            <span class="badge bg-soft-danger text-danger">
                <i class="bi-graph-down"></i> 4.4%
              </span>
                            <span class="text-body fs-6 ms-1">from 61.2%</span>
                        </div>
                    </a>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <a class="card card-hover-shadow h-100" href="#">
                        <div class="card-body">
                            <h6 class="card-subtitle">Pageviews</h6>

                            <div class="row align-items-center gx-2 mb-1">
                                <div class="col-6">
                                    <h2 class="card-title text-inherit">92,913</h2>
                                </div>
                                <!-- End Col -->

                                <div class="col-6">
                                    <!-- Chart -->
                                    <div class="chartjs-custom" style="height: 3rem;">
                                        <canvas class="js-chart" data-hs-chartjs-options='{
                              "type": "line",
                              "data": {
                                 "labels": ["1 May","2 May","3 May","4 May","5 May","6 May","7 May","8 May","9 May","10 May","11 May","12 May","13 May","14 May","15 May","16 May","17 May","18 May","19 May","20 May","21 May","22 May","23 May","24 May","25 May","26 May","27 May","28 May","29 May","30 May","31 May"],
                                 "datasets": [{
                                  "data": [21,20,24,15,17,30,30,35,35,35,40,60,12,90,90,85,70,75,43,75,90,22,120,120,90,85,100,92,92,92,92],
                                  "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
                                  "borderColor": "#377dff",
                                  "borderWidth": 2,
                                  "pointRadius": 0,
                                  "pointHoverRadius": 0
                                }]
                              },
                              "options": {
                                 "scales": {
                                   "yAxes": [{
                                     "display": false
                                   }],
                                   "xAxes": [{
                                     "display": false
                                   }]
                                 },
                                "hover": {
                                  "mode": "nearest",
                                  "intersect": false
                                },
                                "tooltips": {
                                  "postfix": "k",
                                  "hasIndicator": true,
                                  "intersect": false
                                }
                              }
                            }'>
                                        </canvas>
                                    </div>
                                    <!-- End Chart -->
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->

                            <span class="badge bg-soft-secondary text-body">0.0%</span>
                            <span class="text-body fs-6 ms-1">from 2,913</span>
                        </div>
                    </a>
                    <!-- End Card -->
                </div>
            </div>
            <!-- End Stats -->

            <div class="row">
                <div class="col-lg-5 mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100">
                        <!-- Header -->
                        <div class="card-header card-header-content-between">
                            <h4 class="card-header-title">Import data into Front Dashboard</h4>

                            <!-- Dropdown -->
                            <div class="dropdown">
                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="reportsOverviewDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi-three-dots-vertical"></i>
                                </button>

                                <div class="dropdown-menu dropdown-menu-end mt-1" aria-labelledby="reportsOverviewDropdown2">
                                    <span class="dropdown-header">Settings</span>

                                    <a class="dropdown-item" href="#">
                                        <i class="bi-share-fill dropdown-item-icon"></i> Share chart
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi-download dropdown-item-icon"></i> Download
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi-alt dropdown-item-icon"></i> Connect other apps
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <span class="dropdown-header">Feedback</span>

                                    <a class="dropdown-item" href="#">
                                        <i class="bi-chat-left-dots dropdown-item-icon"></i> Report
                                    </a>
                                </div>
                            </div>
                            <!-- End Dropdown -->
                        </div>
                        <!-- End Header -->

                        <!-- Body -->
                        <div class="card-body">
                            <p>See and talk to your users and leads immediately by importing your data into the Front Dashboard platform.</p>

                            <ul class="list-group list-group-flush list-group-no-gutters">
                                <li class="list-group-item">
                                    <h5 class="card-title">Import users from:</h5>
                                </li>

                                <!-- List Group Item -->
                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <div class="flex-grow-1 ms-3">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="mb-0">Capsule</h5>
                                                    <span class="d-block fs-6 text-body">Users</span>
                                                </div>
                                                <!-- End Col -->

                                                <div class="col-auto">
                                                    <a class="btn btn-primary btn-sm" href="#" title="Launch importer" target="_blank">
                                                        Launch <span class="d-none d-sm-inline-block">importer</span>
                                                        <i class="bi-box-arrow-up-right ms-1"></i>
                                                    </a>
                                                </div>
                                                <!-- End Col -->
                                            </div>
                                            <!-- End Row -->
                                        </div>
                                    </div>
                                </li>
                                <!-- End List Group Item -->

                                <!-- List Group Item -->
                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <div class="flex-grow-1 ms-3">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="mb-0">Mailchimp</h5>
                                                    <span class="d-block fs-6 text-body">Users</span>
                                                </div>
                                                <!-- End Col -->

                                                <div class="col-auto">
                                                    <a class="btn btn-primary btn-sm" href="#" title="Launch importer" target="_blank">
                                                        Launch <span class="d-none d-sm-inline-block">importer</span>
                                                        <i class="bi-box-arrow-up-right ms-1"></i>
                                                    </a>
                                                </div>
                                                <!-- End Col -->
                                            </div>
                                            <!-- End Row -->
                                        </div>
                                    </div>
                                </li>
                                <!-- End List Group Item -->

                                <!-- List Group Item -->
                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <div class="flex-grow-1 ms-3">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="mb-0">Webdev</h5>
                                                    <span class="d-block fs-6 text-body">Users</span>
                                                </div>
                                                <!-- End Col -->

                                                <div class="col-auto">
                                                    <a class="btn btn-primary btn-sm" href="#" title="Launch importer" target="_blank">
                                                        Launch <span class="d-none d-sm-inline-block">importer</span>
                                                        <i class="bi-box-arrow-up-right ms-1"></i>
                                                    </a>
                                                </div>
                                                <!-- End Col -->
                                            </div>
                                            <!-- End Row -->
                                        </div>
                                    </div>
                                </li>
                                <!-- End List Group Item -->

                                <li class="list-group-item"><span class="small text-muted">Or you can <a class="link" href="#">sync data to Front Dashboard</a> to ensure your data is always up-to-date.</span></li>
                            </ul>
                        </div>
                        <!-- End Body -->
                    </div>
                    <!-- End Card -->
                </div>
                <!-- End Col -->

                <div class="col-lg-7 mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100">
                        <!-- Header -->
                        <div class="card-header card-header-content-sm-between">
                            <h4 class="card-header-title mb-2 mb-sm-0">Monthly expenses</h4>

                            <!-- Nav -->
                            <ul class="nav nav-segment nav-fill" id="expensesTab" role="tablist">
                                <li class="nav-item" data-bs-toggle="chart-bar" data-datasets="thisWeek" data-trigger="click" data-action="toggle">
                                    <a class="nav-link active" href="javascript:;" data-bs-toggle="tab">This week</a>
                                </li>
                                <li class="nav-item" data-bs-toggle="chart-bar" data-datasets="lastWeek" data-trigger="click" data-action="toggle">
                                    <a class="nav-link" href="javascript:;" data-bs-toggle="tab">Last week</a>
                                </li>
                            </ul>
                            <!-- End Nav -->
                        </div>
                        <!-- End Header -->

                        <!-- Body -->
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-sm mb-2 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <span class="h1 mb-0">35%</span>
                                        <span class="text-success ms-2">
                      <i class="bi-graph-up"></i> 25.3%
                    </span>
                                    </div>
                                </div>
                                <!-- End Col -->

                                <div class="col-sm-auto align-self-sm-end">
                                    <div class="row fs-6 text-body">
                                        <div class="col-auto">
                                            <span class="legend-indicator bg-primary"></span> New
                                        </div>
                                        <!-- End Col -->

                                        <div class="col-auto">
                                            <span class="legend-indicator"></span> Overdue
                                        </div>
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->

                            <!-- Bar Chart -->
                            <div class="chartjs-custom">
                                <canvas id="updatingBarChart" style="height: 20rem;" data-hs-chartjs-options='{
                          "type": "bar",
                          "data": {
                            "labels": ["May 1", "May 2", "May 3", "May 4", "May 5", "May 6", "May 7", "May 8", "May 9", "May 10"],
                            "datasets": [{
                              "data": [200, 300, 290, 350, 150, 350, 300, 100, 125, 220],
                              "backgroundColor": "#377dff",
                              "hoverBackgroundColor": "#377dff",
                              "borderColor": "#377dff"
                            },
                            {
                              "data": [150, 230, 382, 204, 169, 290, 300, 100, 300, 225, 120],
                              "backgroundColor": "#e7eaf3",
                              "borderColor": "#e7eaf3"
                            }]
                          },
                          "options": {
                            "scales": {
                              "yAxes": [{
                                "gridLines": {
                                  "color": "#e7eaf3",
                                  "drawBorder": false,
                                  "zeroLineColor": "#e7eaf3"
                                },
                                "ticks": {
                                  "beginAtZero": true,
                                  "stepSize": 100,
                                  "fontSize": 12,
                                  "fontColor":  "#97a4af",
                                  "fontFamily": "Open Sans, sans-serif",
                                  "padding": 10,
                                  "postfix": "$"
                                }
                              }],
                              "xAxes": [{
                                "gridLines": {
                                  "display": false,
                                  "drawBorder": false
                                },
                                "ticks": {
                                  "fontSize": 12,
                                  "fontColor":  "#97a4af",
                                  "fontFamily": "Open Sans, sans-serif",
                                  "padding": 5
                                },
                                "categoryPercentage": 0.5,
                                "maxBarThickness": "10"
                              }]
                            },
                            "cornerRadius": 2,
                            "tooltips": {
                              "prefix": "$",
                              "hasIndicator": true,
                              "mode": "index",
                              "intersect": false
                            },
                            "hover": {
                              "mode": "nearest",
                              "intersect": true
                            }
                          }
                        }'></canvas>
                            </div>
                            <!-- End Bar Chart -->
                        </div>
                        <!-- End Body -->
                    </div>
                    <!-- End Card -->
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->

            <!-- Card -->
            <div class="card mb-3 mb-lg-5">
                <!-- Header -->
                <div class="card-header">
                    <div class="row justify-content-between align-items-center flex-grow-1">
                        <div class="col-md">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-header-title">Users</h4>

                                <!-- Datatable Info -->
                                <div id="datatableCounterInfo" style="display: none;">
                                    <div class="d-flex align-items-center">
                    <span class="fs-6 me-3">
                      <span id="datatableCounter">0</span>
                      Selected
                    </span>
                                        <a class="btn btn-outline-danger btn-sm" href="javascript:;">
                                            <i class="tio-delete-outlined"></i> Delete
                                        </a>
                                    </div>
                                </div>
                                <!-- End Datatable Info -->
                            </div>
                        </div>
                        <!-- End Col -->

                        <div class="col-auto">
                            <!-- Filter -->
                            <div class="row align-items-sm-center">
                                <div class="col-sm-auto">
                                    <div class="row align-items-center gx-0">
                                        <div class="col">
                                            <span class="text-secondary me-2">Status:</span>
                                        </div>
                                        <!-- End Col -->

                                        <div class="col-auto">
                                            <!-- Select -->
                                            <div class="tom-select-custom tom-select-custom-end">
                                                <select class="js-select js-datatable-filter form-select form-select-sm form-select-borderless" data-target-column-index="2" data-target-table="datatable" autocomplete="off" data-hs-tom-select-options='{
                                  "searchInDropdown": false,
                                  "hideSearch": true,
                                  "dropdownWidth": "10rem"
                                }'>
                                                    <option value="null" selected>All</option>
                                                    <option value="successful">Successful</option>
                                                    <option value="overdue">Overdue</option>
                                                    <option value="pending">Pending</option>
                                                </select>
                                            </div>
                                            <!-- End Select -->
                                        </div>
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                                <!-- End Col -->

                                <div class="col-sm-auto">
                                    <div class="row align-items-center gx-0">
                                        <div class="col">
                                            <span class="text-secondary me-2">Signed up:</span>
                                        </div>
                                        <!-- End Col -->

                                        <div class="col-auto">
                                            <!-- Select -->
                                            <div class="tom-select-custom tom-select-custom-end">
                                                <select class="js-select js-datatable-filter form-select form-select-sm form-select-borderless" data-target-column-index="5" data-target-table="datatable" autocomplete="off" data-hs-tom-select-options='{
                                  "searchInDropdown": false,
                                  "hideSearch": true,
                                  "dropdownWidth": "10rem"
                                }'>
                                                    <option value="null" selected>All</option>
                                                    <option value="1 year ago">1 year ago</option>
                                                    <option value="6 months ago">6 months ago</option>
                                                </select>
                                            </div>
                                            <!-- End Select -->
                                        </div>
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </div>
                                <!-- End Col -->

                                <div class="col-md">
                                    <form>
                                        <!-- Search -->
                                        <div class="input-group input-group-merge input-group-flush">
                                            <div class="input-group-prepend input-group-text">
                                                <i class="bi-search"></i>
                                            </div>
                                            <input id="datatableSearch" type="search" class="form-control" placeholder="Search users" aria-label="Search users">
                                        </div>
                                        <!-- End Search -->
                                    </form>
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Filter -->
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>
                <!-- End Header -->

                <!-- Table -->
                <div class="table-responsive datatable-custom">
                    <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table" data-hs-datatables-options='{
                   "columnDefs": [{
                      "targets": [0, 1, 4],
                      "orderable": false
                    }],
                   "order": [],
                   "info": {
                     "totalQty": "#datatableWithPaginationInfoTotalQty"
                   },
                   "search": "#datatableSearch",
                   "entries": "#datatableEntries",
                   "pageLength": 8,
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatablePagination"
                 }'>

                        <thead class="thead-light">
                        <tr>
                            <th>User Name</th>
                            <th>Full Name</th>
                            <th>Role</th>
                            <th>House</th>
                            <th>Intro</th>
                            <th>Show Old Save</th>
                            <th>Admin Owner</th>
                            <th>Check Audit Details</th>
                            {{--                <th>Content</th>--}}
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        @if(isset($users))
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <a class="d-flex align-items-center" href="../user-profile.html">
                                            <div class="avatar avatar-soft-primary avatar-circle">
                                                <span class="avatar-initials">{{substr($user->first_name, 0, 1)}}</span>
                                            </div>
                                            <div class="ms-3">
                                                <span class="d-block h5 text-inherit mb-0">{{$user->user_name}} </span>
                                                <span class="d-block fs-5 text-body">{{$user->email}}</span>
                                            </div>
                                        </a>
                                    </td>
                                    <td>{{$user->first_name}} {{$user->last_name}}</td>
                                    <td>{{$user->role}}</td>
                                    <td>{{$user->HouseId}}</td>
                                    <td>{{$user->Intro}}</td>
                                    <td>{{$user->ShowOldSave}}</td>
                                    <td>{{$user->AdminOwner}}</td>
                                    <td>
                                        @if(!is_null($user->Audit_user_name))
                                            <a class="btn btn-soft-success"
                                               data-bs-toggle="modal"
                                               data-bs-target="#audit{{$user->user_id}}Modal"
                                               style="width: 130px" href="#!">Click to view</a>
                                        @else
                                            <a class="btn btn-soft-secondary" style="width: 130px" href="#!">No Audit</a>
                                        @endif
                                    </td>

                                    <!-- Modal -->
                                    <div class="modal fade" id="audit{{$user->user_id}}Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                <h6 class="card-subtitle mb-2 text-muted">{{$user->Audit_user_name}}</h6>
                                                            </div>
                                                            <div class="mb-3">
                                                                <h5 class="card-title">Audit Role</h5>
                                                                <h6 class="card-subtitle mb-2 text-muted">{{$user->Audit_Role}}</h6>
                                                            </div>
                                                            <div class="mb-3">
                                                                <h5 class="card-title">Audit First Name</h5>
                                                                <h6 class="card-subtitle mb-2 text-muted">{{$user->Audit_FirstName}}</h6>
                                                            </div>
                                                            <div class="mb-3">
                                                                <h5 class="card-title">Audit Last Name</h5>
                                                                <h6 class="card-subtitle mb-2 text-muted">{{$user->Audit_LastName}}</h6>
                                                            </div>
                                                            <div class="mb-3">
                                                                <h5 class="card-title">Audit Email</h5>
                                                                <h6 class="card-subtitle mb-2 text-muted">{{$user->Audit_Email}}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <td>
                                        <div class="btn-group" role="group" aria-label="Edit group">
                                            <a class="btn btn-outline-info btn-sm" href="#"
                                               data-bs-toggle="modal"
                                               data-bs-target="#updateUser{{$user->user_id}}Modal"
                                            >
                                                <i class="bi-pencil me-1"></i> Edit
                                            </a>
                                            <a class="btn btn-outline-danger btn-sm" href="#"
                                               data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{ $user->user_id }}Modal"
                                            >
                                                <i class="bi-trash"></i>
                                            </a>
                                        </div>

                                        <!--Update User Modal -->
                                        <div class="modal fade" id="updateUser{{$user->user_id}}Modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Update User {{$user->user_id}}</h5>
                                                        <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>


                                                    <div class="modal-body">
                                                        <form class=""  action="{{ route('dash.users.update',$user->user_id) }}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <fieldset class="scheduler-border fieldset-padding">
                                                                <legend class="scheduler-border">House Details:  {{$user->HouseName}}</legend>
                                                                <!-- Form -->

                                                                <div class="row pt-2">
                                                                    <div class="col-md-12">
                                                                        <!-- Form -->
                                                                        <div class="mb-2">
                                                                            <fieldset class="border-light scheduler-border">
                                                                                <legend class="float-none w-auto fs-5 mb-0">House Name*</legend>
                                                                                <input
                                                                                    type="text"
                                                                                    class="form-control form-control-lg"
                                                                                    name="HouseName"
                                                                                    id="HouseName"
                                                                                    placeholder="Enter House Name"
                                                                                    value="{{$user->HouseName}}"
                                                                                />
                                                                            </fieldset>
                                                                            @error('HouseName')
                                                                            <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                                                            @enderror
                                                                        </div>
                                                                        <!-- End Form -->
                                                                    </div>
                                                                </div>
                                                                {{--     second row starts --}}

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mt-3">
                                                                            <fieldset class="border-light scheduler-border">
                                                                                <legend class="float-none w-auto fs-5 mb-0">City</legend>
                                                                                <input
                                                                                    type="text"
                                                                                    class="form-control"
                                                                                    id="city"
                                                                                    name="City"
                                                                                    placeholder="City"
                                                                                    value="{{$user->City}}"
                                                                                />

                                                                            </fieldset>
                                                                            @error('City')
                                                                            <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class=" col-md-6">
                                                                        <div class="mt-3">
                                                                            <fieldset class="border-light scheduler-border">
                                                                                <legend class="float-none w-auto fs-5 mb-0">State</legend>
                                                                                <input
                                                                                    type="text"
                                                                                    class="form-control"
                                                                                    name="State"
                                                                                    id="State"
                                                                                    placeholder="State"
                                                                                    value="{{$user->State}}"
                                                                                    aria-label=""
                                                                                />
                                                                            </fieldset>
                                                                            @error('State')
                                                                            <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="mt-3">
                                                                            <fieldset class="border-light scheduler-border">
                                                                                <legend class="float-none w-auto fs-5 mb-0">Paypal Account</legend>
                                                                                <input
                                                                                    type="number"
                                                                                    class="form-control form-control-lg"
                                                                                    id="ReferredBy"
                                                                                    name="ReferredBy"
                                                                                    placeholder=""
                                                                                    value="{{$user->ReferredBy}}"
                                                                                />
                                                                            </fieldset>
                                                                            @error('ReferredBy')
                                                                            <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                                                            @enderror
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                                <div class="mb-2">
                                                                    <div id="basicExampleDropzone" class="js-dropzone row dz-dropzone dz-dropzone-card border-primary bg-primary-light">
                                                                        <div class="dz-message">
                                                                            {{--                                        <img class="avatar avatar-xl avatar-4x3 mb-3" src="../assets/svg/illustrations/oc-browse.svg" alt="Image Description">--}}

                                                                            <h5>Drag and drop your file here</h5>

                                                                            <p class="mb-2">or</p>

                                                                            <span class="btn bg-primary btn-sm text-white">Upload Image</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            <!-- End Form -->
                                                            <!-- second fieldset -->
                                                            <fieldset class="scheduler-border fieldset-padding">
                                                                <legend class="scheduler-border">Admin Details</legend>
                                                                <!-- Form -->
                                                                <div class="row pt-2">
                                                                    <div class="col-md-6">
                                                                        <!-- Form -->
                                                                        <div class="mb-2">
                                                                            <fieldset class="border-light input-group scheduler-border">
                                                                                <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0">Username</legend>
                                                                                <input type="text" class="form-control form-control-lg border-end-0"
                                                                                       name="user_name"
                                                                                       id="user_name" tabindex="1"
                                                                                       placeholder=""
                                                                                       value="{{ old('user_name') }}"
                                                                                       aria-label=""
                                                                                />
                                                                                <a id="changePassTarget-2" class="input-group-append input-group-text border-0" href="javascript:;">
                                                                                    <i class="bi bi-person text-primary"></i>
                                                                                </a>
                                                                            </fieldset>
                                                                            @error('user_name')
                                                                            <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                                                            @enderror
                                                                        </div>
                                                                        <!-- End Form -->
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="">
                                                                            <fieldset class="border-light input-group scheduler-border">
                                                                                <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0">Email</legend>
                                                                                <input type="email" class="form-control form-control-lg border-end-0"
                                                                                       name="email" value=""
                                                                                       id="email" tabindex="1"
                                                                                       value="{{ old('email') }}"
                                                                                       placeholder=""
                                                                                       aria-label=""
                                                                                />
                                                                                <a id="changePassTarget-2" class="input-group-append input-group-text border-0" href="javascript:;">
                                                                                    <i class="bi bi-envelope text-primary"></i>
                                                                                </a>
                                                                            </fieldset>
                                                                            @error('email')
                                                                            <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                                                            @enderror
                                                                        </div>

                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-check mt-2 col-12">
                                                                            <label class="form-check-label" for="remember_me">
                                                                                Allow Administrator to have Owner Permissions.
                                                                            </label>
                                                                            <input type="checkbox" class="form-check-input" name="remember_me" value="" id="remember_me">

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="row pt-2">
                                                                    <div class="col-md-12">
                                                                        <div class="">
                                                                            <fieldset class="border-light input-group scheduler-border">
                                                                                <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0">Role</legend>
                                                                                <select class="form-control form-control-lg border-end-0"
                                                                                        name="role"
                                                                                        id="role" tabindex="1"
                                                                                        value="{{ old('role') }}"
                                                                                        placeholder=""
                                                                                        aria-label=""
                                                                                >
                                                                                    <option readonly="" value="">Please Select Role</option>
                                                                                    <option value="Administrator">Administrator</option>
                                                                                    <option value="Administrator">Guest</option>
                                                                                    <option value="Administrator">Owner</option>
                                                                                </select>
                                                                            </fieldset>
                                                                            @error('role')
                                                                            <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                                                            @enderror
                                                                        </div>

                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-check mt-2 col-12">
                                                                            <label class="form-check-label" for="remember_me">
                                                                                Allow Administrator to have Owner Permissions.
                                                                            </label>
                                                                            <input type="checkbox" class="form-check-input" name="remember_me" value="" id="remember_me">

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                {{--     second row starts --}}

                                                                <div class="row">
                                                                    <div class=" col-md-6">
                                                                        <div class="mt-3">
                                                                            <fieldset class="border-light input-group scheduler-border">
                                                                                <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0">First Name</legend>
                                                                                <input type="text" class="form-control form-control-lg border-end-0"
                                                                                       name="first_name" value=""
                                                                                       id="first_name" tabindex="1"
                                                                                       placeholder=""
                                                                                       value="{{$user->first_name}}"
                                                                                       aria-label=""
                                                                                />
                                                                            </fieldset>
                                                                            @error('first_name')
                                                                            <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class=" col-md-6">
                                                                        <div class="mt-3">
                                                                            <fieldset class="border-light input-group scheduler-border">
                                                                                <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0">Last Name</legend>
                                                                                <input type="text" class="form-control form-control-lg border-end-0"
                                                                                       name="last_name" value=""
                                                                                       id="last_name" tabindex="1"
                                                                                       placeholder=""
                                                                                       value="{{$user->last_name}}"
                                                                                       aria-label=""
                                                                                />
                                                                            </fieldset>
                                                                            @error('last_name')
                                                                            <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mt-3">
                                                                            <fieldset class="border-light input-group scheduler-border">
                                                                                <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0">Create Password</legend>
                                                                                <input type="password"
                                                                                       class="form-control form-control-lg border-end-0"
                                                                                       name="password"
                                                                                       value="{{old('password')}}"
                                                                                       id="password"
                                                                                       tabindex="1"
                                                                                       placeholder=""
                                                                                       aria-label=""
                                                                                >
                                                                                <a id="changePassTarget-2" class="input-group-append input-group-text border-0" href="javascript:;">
                                                                                    <i class="bi-eye text-primary"></i>
                                                                                </a>
                                                                            </fieldset>
                                                                            @error('password')
                                                                            <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                                                            @enderror
                                                                        </div>

                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="mt-3">
                                                                            <fieldset class="border-light input-group scheduler-border">
                                                                                <legend class="float-none w-auto fs-5 mb-0 px-2 mb-0">Confirm Password</legend>
                                                                                <input type="password"
                                                                                       class="form-control form-control-lg border-end-0"
                                                                                       name="password_confirmation"
                                                                                       value="{{old('confirm_password')}}"
                                                                                       id="password_confirmation"
                                                                                       tabindex="1"
                                                                                       placeholder=""
                                                                                       aria-label=""
                                                                                >
                                                                                <a id="changePassTarget-2" class="input-group-append input-group-text border-0" href="javascript:;">
                                                                                    <i class="bi-eye text-primary"></i>
                                                                                </a>
                                                                            </fieldset>

                                                                            @error('password_confirmation')
                                                                            <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                                                                            @enderror

                                                                        </div>

                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-check mt-2">
                                                                            <label class="form-check-label" for="remember_me">
                                                                                I accept <a href="#" class="text-decoration-underline">Terms and Conditions</a>
                                                                            </label>
                                                                            <input type="checkbox" class="form-check-input" name="remember_me" value="" id="remember_me">

                                                                        </div>
                                                                    </div>


                                                                </div>
                                                                <div class="text-center mt-3">
                                                                    <button class="btn btn-dark-secondary text-white w-100" type="submit">Create Account</button>
                                                                </div>

                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal -->

                                    </td>
                                </tr>
                            @endforeach
                        @endif


                        </tbody>


                    </table>
                </div>
                <!-- End Table -->

                <!-- Footer -->
                <div class="card-footer">
                    <!-- Pagination -->
                    <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                        <div class="col-sm mb-2 mb-sm-0">
                            <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                                <span class="me-2">Showing:</span>

                                <!-- Select -->
                                <div class="tom-select-custom">
                                    <select id="datatableEntries" class="js-select form-select form-select-borderless w-auto" autocomplete="off" data-hs-tom-select-options='{
                            "searchInDropdown": false,
                            "hideSearch": true
                          }'>
                                        <option value="4">4</option>
                                        <option value="6">6</option>
                                        <option value="8" selected>8</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                                <!-- End Select -->

                                <span class="text-secondary me-2">of</span>

                                <!-- Pagination Quantity -->
                                <span id="datatableWithPaginationInfoTotalQty"></span>
                            </div>
                        </div>
                        <!-- End Col -->

                        <div class="col-sm-auto">
                            <div class="d-flex justify-content-center justify-content-sm-end">
                                <!-- Pagination -->
                                <nav id="datatablePagination" aria-label="Activity pagination"></nav>
                            </div>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Pagination -->
                </div>
                <!-- End Footer -->
            </div>
            <!-- End Card -->

            <div class="row">
                <div class="col-lg-6 mb-3 mb-lg-0">
                    <!-- Card -->
                    <div class="card h-100">
                        <!-- Header -->
                        <div class="card-header card-header-content-sm-between">
                            <h4 class="card-header-title mb-2 mb-sm-0">Transactions</h4>

                            <!-- Daterangepicker -->
                            <button id="js-daterangepicker-predefined" class="btn btn-ghost-secondary btn-sm dropdown-toggle">
                                <i class="bi-calendar-week"></i>
                                <span class="js-daterangepicker-predefined-preview ms-1"></span>
                            </button>
                            <!-- End Daterangepicker -->
                        </div>
                        <!-- End Header -->

                        <!-- Body -->
                        <div class="card-body">
                            <!-- Chart -->
                            <div class="chartjs-custom mx-auto" style="height: 20rem;">
                                <canvas class="js-chart-datalabels" data-hs-chartjs-options='{
                              "type": "bubble",
                              "data": {
                                "datasets": [
                                  {
                                    "label": "Label 1",
                                    "data": [
                                      {"x": 55, "y": 65, "r": 99}
                                    ],
                                    "color": "#fff",
                                    "backgroundColor": "rgba(55, 125, 255, 0.9)",
                                    "borderColor": "transparent"
                                  },
                                  {
                                    "label": "Label 2",
                                    "data": [
                                      {"x": 33, "y": 42, "r": 65}
                                    ],
                                    "color": "#fff",
                                    "backgroundColor": "rgba(100, 0, 214, 0.8)",
                                    "borderColor": "transparent"
                                  },
                                  {
                                    "label": "Label 3",
                                    "data": [
                                      {"x": 46, "y": 26, "r": 38}
                                    ],
                                    "color": "#fff",
                                    "backgroundColor": "#00c9db",
                                    "borderColor": "transparent"
                                  }
                                ]
                              },
                              "options": {
                                "scales": {
                                  "yAxes": [{
                                    "gridLines": {
                                      "display": false
                                    },
                                    "ticks": {
                                      "display": false,
                                      "max": 100,
                                      "beginAtZero": true
                                    }
                                  }],
                                  "xAxes": [{
                                  "gridLines": {
                                      "display": false
                                    },
                                    "ticks": {
                                      "display": false,
                                      "max": 100,
                                      "beginAtZero": true
                                    }
                                  }]
                                },
                                "tooltips": false
                              }
                            }'></canvas>
                            </div>
                            <!-- End Chart -->

                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    <span class="legend-indicator bg-primary"></span> New
                                </div>
                                <!-- End Col -->

                                <div class="col-auto">
                                    <span class="legend-indicator" style="background-color: #7000f2;"></span> Pending
                                </div>
                                <!-- End Col -->

                                <div class="col-auto">
                                    <span class="legend-indicator bg-info"></span> Failed
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->
                        </div>
                        <!-- End Body -->
                    </div>
                    <!-- End Card -->
                </div>

                <div class="col-lg-6">
                    <!-- Card -->
                    <div class="card h-100">
                        <!-- Header -->
                        <div class="card-header card-header-content-between">
                            <h4 class="card-header-title">Reports overview</h4>

                            <!-- Dropdown -->
                            <div class="dropdown">
                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="reportsOverviewDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi-three-dots-vertical"></i>
                                </button>

                                <div class="dropdown-menu dropdown-menu-end mt-1" aria-labelledby="reportsOverviewDropdown1">
                                    <span class="dropdown-header">Settings</span>

                                    <a class="dropdown-item" href="#">
                                        <i class="bi-share-fill dropdown-item-icon"></i> Share reports
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi-download dropdown-item-icon"></i> Download
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi-alt dropdown-item-icon"></i> Connect other apps
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <span class="dropdown-header">Feedback</span>

                                    <a class="dropdown-item" href="#">
                                        <i class="bi-chat-left-dots dropdown-item-icon"></i> Report
                                    </a>
                                </div>
                            </div>
                            <!-- End Dropdown -->
                        </div>
                        <!-- End Header -->

                        <!-- Body -->
                        <div class="card-body">
                            <span class="h1 d-block mb-4">$7,431.14 USD</span>

                            <!-- Progress -->
                            <div class="progress rounded-pill mb-2">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" data-bs-toggle="tooltip" data-bs-placement="top" title="Gross value"></div>
                                <div class="progress-bar opacity-50" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" data-bs-toggle="tooltip" data-bs-placement="top" title="Net volume from sales"></div>
                                <div class="progress-bar opacity-25" role="progressbar" style="width: 9%" aria-valuenow="9" aria-valuemin="0" aria-valuemax="100" data-bs-toggle="tooltip" data-bs-placement="top" title="New volume from sales"></div>
                            </div>

                            <div class="d-flex justify-content-between mb-4">
                                <span>0%</span>
                                <span>100%</span>
                            </div>
                            <!-- End Progress -->

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table table-lg table-nowrap card-table mb-0">
                                    <tr>
                                        <th scope="row">
                                            <span class="legend-indicator bg-primary"></span>Gross value
                                        </th>
                                        <td>$3,500.71</td>
                                        <td>
                                            <span class="badge bg-soft-success text-success">+12.1%</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row">
                                            <span class="legend-indicator bg-primary opacity-50"></span>Net volume from sales
                                        </th>
                                        <td>$2,980.45</td>
                                        <td>
                                            <span class="badge bg-soft-warning text-warning">+6.9%</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row">
                                            <span class="legend-indicator bg-primary opacity-25"></span>New volume from sales
                                        </th>
                                        <td>$950.00</td>
                                        <td>
                                            <span class="badge bg-soft-danger text-danger">-1.5%</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row">
                                            <span class="legend-indicator"></span>Other
                                        </th>
                                        <td>32</td>
                                        <td>
                                            <span class="badge bg-soft-success text-success">1.9%</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!-- End Table -->
                        </div>
                        <!-- End Body -->
                    </div>
                    <!-- End Card -->
                </div>
            </div>
        </div>



</x-app-layout>
