<x-app-layout>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-sm mb-2 mb-sm-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-no-gutter">
                            <li class="breadcrumb-item"><a class="breadcrumb-link" href="{{ route('dash.calendar') }}">Calendar</a></li>
                            {{ $breadcrumbs ?? '' }}
                        </ol>
                    </nav>

                    <h1 class="page-header-title">{{ $title ?? '' }}</h1>
                </div>
                <!-- End Col -->
                <!-- End Row -->
                {{ $headerRightActions ?? '' }}
            </div>

        </div>

        <!-- End Page Header -->
        <div>
            {{ $slot }}
        </div>
        <!-- End Row -->
    </div>
</x-app-layout>
