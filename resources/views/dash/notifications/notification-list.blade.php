<div>
    <div class="card">
        <!-- Header -->

        @if ($data->count() > 0 )
            <div class="p-3">
                <ul class="list-group list-group-flush">
                    @foreach($data as $dt)

                        @if($dt->type == 'App\Notifications\BlogNotify')
                            <li class="list-group-item border-bottom rounded-0 d-flex justify-content-start align-items-center">
                                <h4 class="mb-0 me-3">Blog: </h4>
                                <p class="mb-0">New Blog <b class="text-primary text-capitalize">{{$dt->data['Name']}}</b>
                                    has been created against <b class="text-primary text-capitalize">{{$dt->data['house_name']}}</b> House </p>
                            </li>
                        @elseif($dt->type == 'App\Notifications\CalendarEmailNotification')
                            <li class="list-group-item border-bottom rounded-0 d-flex justify-content-start align-items-center">
                                <h4 class="mb-0 me-3">Calendar: </h4>

                                <p class="mb-0">This Vacation has been Scheduled from
                                    <b class="text-primary text-capitalize">{{$dt->data['start_date']}}</b>
                                    to
                                    <b class="text-primary text-capitalize">{{$dt->data['end_date']}}</b>
                                    Date against <b class="text-primary text-capitalize">{{$dt->data['house_name']}}</b> House
                                </p>

                            </li>
                        @else
                            <li class="list-group-item border-bottom rounded-0 d-flex justify-content-start align-items-center">
                                <h4 class="mb-0 me-3">Item : </h4>
                                <p class="mb-0">New  <b class="text-primary text-capitalize">{{$dt->data['Name']}}</b>
                                    has been {{$dt->data['isAction']}} against <b class="text-primary text-capitalize">{{$dt->data['house_name']}}</b> House </p>
                            </li>

                        @endif
                    @endforeach
                </ul>
            </div>



    <div class="mt-3">
        {{ $data->onEachSide(0)->links() }}
    </div>

        <!-- End Table -->
    </div>

    @else
        <p class="text-center my-4">There are no Notifications</p>
    @endif

</div>
