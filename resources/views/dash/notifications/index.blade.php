<x-dashboard-layout>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item active" aria-current="page">Notifications</li>
        {{--        <li class="breadcrumb-item active" aria-current="page">Photo Album</li>--}}
    </x-slot>

    <x-slot name="title">
        Notifications
    </x-slot>

    <div class="content container-fluid">
        <div>
            @if ($data->count() > 0 )
                <div class="mb-3 text-end">
                    <a href="{{ route('dash.mark-as-read-notifications') }}" class="btn btn-primary">Mark as Read All</a>
                </div>
            @endif
            <div class="card">
                <!-- Header -->

                @if ($data->count() > 0 )

                    <div class="p-3">
                        <ul class="list-group list-group-flush">
                            @foreach($data as $dt)
                                @if($dt->type == 'App\Notifications\BlogNotify')
                                    <li class="list-group-item border-bottom rounded-0 d-flex justify-content-between align-items-center">
                                       <div class="d-flex justify-content-start align-items-center">
                                           <h4 class="mb-0 me-3">- <i class="bi bi-image"></i>: </h4>
                                           <p class="mb-0">New Blog <b
                                                   class="text-primary text-capitalize">{{$dt->data['Name']}}</b>
                                               has been created against <b
                                                   class="text-primary text-capitalize">{{$dt->data['house_name']}}</b>
                                               House </p>
                                       </div>
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0 text-muted">{{$dt->created_at->format('d-M-Y  h:m:A')}}</p>
                                            <form action="{{route('dash.mark-as-read-single-notification', $dt->id)}}">
                                                <button type="submit" class="btn btn-primary btn-sm ms-3">Mark as Read</button>
                                            </form>
                                        </div>
                                    </li>
                                @else
                                    <li class="list-group-item border-bottom rounded-0 d-flex justify-content-between align-items-center">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <h4 class="mb-0 me-3">- <i class="bi bi-calendar-event"></i>: </h4>
                                           <p class="mb-0">This Vacation has been Scheduled from
                                               <b class="text-primary text-capitalize">{{$dt->data['start_date']}}</b>
                                               to
                                               <b class="text-primary text-capitalize">{{$dt->data['end_date']}}</b>
                                               Date against <b
                                                   class="text-primary text-capitalize">{{$dt->data['house_name']}}</b>
                                               House
                                           </p>
                                       </div>

                                        <div class="d-flex align-items-center">
                                            <p class="mb-0 text-muted">{{$dt->created_at->format('d-M-Y  h:m:A')}}</p>
                                            <form action="{{route('dash.mark-as-read-single-notification', $dt->id)}}">
                                                <button type="submit" class="btn btn-primary btn-sm ms-3">Mark as Read</button>
                                            </form>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                    <div class="mt-3">
                        {{ $data->links() }}
                    </div>

            </div>

            @else
                <p class="text-center my-4">There are no Notifications</p>
            @endif

        </div>

        {{--        <livewire:notification.notification-list :user="$user"/>--}}

    </div>
</x-dashboard-layout>
