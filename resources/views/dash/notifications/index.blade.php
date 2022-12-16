<x-dashboard-layout>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item active" aria-current="page">Notifications</li>
        {{--        <li class="breadcrumb-item active" aria-current="page">Photo Album</li>--}}
    </x-slot>

    <x-slot name="title">
        Notifications
    </x-slot>

    <div class="content container-fluid p-1">
        <div>
            @if ($data->count() > 0 )
                <div class="mb-3 text-end">
                    <a href="{{ route('dash.mark-as-read-notifications') }}" class="btn btn-primary">Mark as Read
                        All</a>
                </div>
            @endif
            <div class="card">
                <!-- Header -->

                @if ($data->count() > 0 )

                    <div class="p-1 p-lg-0">
                        <ul class="list-group list-group-flush">
                            @foreach($data as $dt)
                                {{--                                      @if($dt->type == 'App\Notifications\BlogNotification')--}}
                                {{--                                    <li class="list-group-item border-bottom rounded-0 p-1 p-lg-3 d-lg-flex justify-content-between align-items-center">--}}
                                {{--                                        <div class="d-flex justify-content-start align-items-center mb-2 mb-lg-0">--}}
                                {{--                                            <h4 class="mb-0 me-3 d-none d-lg-block">- <i class="bi bi-image"></i> :--}}
                                {{--                                            </h4>--}}
                                {{--                                            <p class="mb-0">New Blog <b--}}
                                {{--                                                    class="text-primary text-capitalize">{{$dt->data['Name'] ?? ''}}</b>--}}
                                {{--                                                has been created against <b--}}
                                {{--                                                    class="text-primary text-capitalize">{{$dt->data['house_name'] ?? ''}}</b>--}}
                                {{--                                                House </p>--}}
                                {{--                                        </div>--}}
                                {{--                                        <div class="d-lg-flex align-items-center d-lg-block mb-2 mb-lg-0">--}}
                                {{--                                            <p class="mb-0 text-muted mb-2 mb-lg-0">{{$dt->created_at->format('d-M-Y  h:m:A')}}</p>--}}
                                {{--                                            <form action="{{route('dash.mark-as-read-single-notification', $dt->id)}}">--}}
                                {{--                                                <button type="submit"--}}
                                {{--                                                        class="text-primary px-0 bg-transparent border-0 fw-bold text-decoration-underline ms-0 ms-lg-2">--}}
                                {{--                                                    Mark as Read--}}
                                {{--                                                </button>--}}
                                {{--                                            </form>--}}
                                {{--                                        </div>--}}
                                {{--                                    </li>--}}
                                @if($dt->type == 'App\Notifications\CalendarEmailNotification')

                                    <li class="list-group-item border-bottom rounded-0 p-1 p-lg-3 d-lg-flex justify-content-between align-items-center">
                                        <div class="d-flex justify-content-start align-items-center mb-2 mb-lg-0">
                                            <h4 class="mb-0 me-3 d-none d-lg-block">- <i
                                                    class="bi bi-calendar-event"></i> : </h4>
                                            <p class="mb-0">A vacation has been scheduled from
                                                <b class="text-primary text-capitalize">{{$dt->data['start_date'] ?? ''}}</b>
                                                to
                                                <b class="text-primary text-capitalize">{{$dt->data['end_date'] ?? ''}}</b>
                                                Date against <b
                                                    class="text-primary text-capitalize">{{$dt->data['house_name'] ?? ''}}</b>
                                                House
                                            </p>
                                        </div>

                                        <div class="d-lg-flex align-items-center mb-2 mb-lg-0">
                                            <p class="mb-0 text-muted mb-2 fs-12 mb-lg-0">{{$dt->created_at->format('d-M-Y  h:m:A')}}</p>
                                            <form action="{{route('dash.mark-as-read-single-notification', $dt->id)}}">
                                                <button type="submit"
                                                        class="text-primary px-0 bg-transparent border-0 fs-13 fw-bold text-decoration-underline ms-0 ms-lg-2">
                                                    Mark as Read
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                @else
                                    <li class="list-group-item border-bottom rounded-0 p-1 p-lg-3 d-lg-flex justify-content-between align-items-center">
                                        <div class="d-flex justify-content-start align-items-center mb-2 mb-lg-0">
                                            <h4 class="mb-0 me-3 d-none d-lg-block">- <i class="bi bi-calendar"></i> :
                                            </h4>
                                            <p class="mb-0">
                                                <b class="text-primary text-capitalize">{{$dt->data['Name'] ?? ''}}</b>
                                               @if(isset($dt->data['isModal'] ))
                                                    <span class="fw-600">{{$dt->data['isModal'] ?? ''}}</span>
                                                @endif
                                                has been
                                                @if(isset($dt->data['isAction']))
                                                    @if($dt->data['isAction'] == 'created')
                                                        <span
                                                            class="text-success fw-600">{{$dt->data['isAction'] ?? ''}}</span>
                                                    @elseif($dt->data['isAction'] == 'updated')
                                                        <span
                                                            class="text-info fw-600">{{$dt->data['isAction'] ?? ''}}</span>
                                                    @else
                                                        <span
                                                            class="text-danger fw-600">{{$dt->data['isAction'] ?? ''}}</span>
                                                    @endif
                                                @endif
                                                    against <b
                                                        class="text-primary text-capitalize">{{$dt->data['house_name'] ?? ''}}</b>
                                                    House
                                            </p>
                                        </div>
                                        <div class="d-lg-flex align-items-center d-lg-block mb-2 mb-lg-0">
                                            <p class="mb-0 text-muted fs-12 mb-2 mb-lg-0">{{$dt->created_at->format('d-M-Y  h:m:A')}}</p>
                                            <form action="{{route('dash.mark-as-read-single-notification', $dt->id)}}">
                                                <button type="submit"
                                                        class="text-primary px-0 bg-transparent border-0 fs-13 fw-bold text-decoration-underline ms-0 ms-lg-2">
                                                    Mark as Read
                                                </button>
                                            </form>
                                        </div>
                                    </li>


                                    {{--                                    <li class="list-group-item border-bottom rounded-0 p-1 p-lg-3 d-lg-flex justify-content-between align-items-center">--}}
                                    {{--                                        <div class="d-flex justify-content-start align-items-center mb-2 mb-lg-0">--}}
                                    {{--                                            <h4 class="mb-0 me-3 d-none d-lg-block">- <i class="bi bi-image"></i> : </h4>--}}

                                    {{--                                            @if(isset($dt->data['deleteType']))--}}
                                    {{--                                                @if($dt->data['deleteType'] == 'Blog')--}}

                                    {{--                                                    <p class="mb-0">A Blog <b--}}
                                    {{--                                                            class="text-primary text-capitalize">{{$dt->data['Name'] ?? ''}}</b>--}}
                                    {{--                                                        has been Deleted</p>--}}
                                    {{--                                                @else--}}
                                    {{--                                                    <p class="mb-0">A Calendar <b--}}
                                    {{--                                                            class="text-primary text-capitalize">{{$dt->data['Name'] ?? ''}}</b>--}}
                                    {{--                                                        has been Deleted</p>--}}
                                    {{--                                                @endif--}}
                                    {{--                                            @endif--}}


                                    {{--                                        </div>--}}
                                    {{--                                        <div class="d-lg-flex align-items-center d-lg-block mb-2 mb-lg-0">--}}
                                    {{--                                            <p class="mb-0 text-muted mb-2 mb-lg-0">{{$dt->created_at->format('d-M-Y  h:m:A')}}</p>--}}
                                    {{--                                            <form action="{{route('dash.mark-as-read-single-notification', $dt->id)}}">--}}
                                    {{--                                                <button type="submit" class="text-primary px-0 bg-transparent border-0 fw-bold text-decoration-underline ms-0 ms-lg-2">Mark as Read</button>--}}
                                    {{--                                            </form>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </li>--}}

                                @endif
                            @endforeach
                        </ul>
                    </div>

                    <div class="mt-3">
                        {{ $data->onEachSide(0)->links() }}
                    </div>

            </div>

            @else
                <p class="text-center my-4">There are no Notifications</p>
            @endif

        </div>

        {{--        <livewire:notification.notification-list :user="$user"/>--}}

    </div>
</x-dashboard-layout>
