<div>
<div class="row mb-5">
    <div class="col-12 col-lg-6">
        <div class="d-flex justify-content-between">
            <h4>{{count($BlogComments)}} comments</h4>
            <div><label for="">Sort By</label>
                <select name="" id="" wire:model.defer="type" wire:change="changeType" class="border px-3 py-1 rounded" style="background-color: #CDD0D5">
                    <option value="Newest" >Newest</option>
                    <option value="Oldest">Oldest</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row my-5">
<div class="col-12 col-lg-6">
    <div class="d-flex">
        <div class="flex-shrink-0">
            <img src="{{asset('images/images-home/smiling-girl.jpg')}}" class="rounded-1" width="50"
                 height="50" style="object-fit: cover" alt="...">
        </div>

        <div class="flex-grow-1 ms-3">
            <form wire:submit.prevent="addBlogComment()">
                <div class="border">
                    <textarea id="Content" name="Content"
                      wire:model.defer="state.Content"
                      class="form-control @error('Content') is-invalid @enderror"
                      placeholder="Description"
                      rows="6">
                    </textarea>
                    @error('Content')
                    <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="text-start text-lg-end py-3 px-3" style="background-color: #2D394C10">
                    <button class="btn btn-secondary px-5" style="background-color: #2D394C">Post</button>
                </div>
            </form>

        </div>

    </div>

    <div class="row">
        <div class="col-12 col-lg-6">
            @foreach($BlogComments as $comment)
            <div class="d-flex w-100 mt-2">
                <div class="flex-shrink-0">
                    <img src="{{asset('images/images-home/smiling-girl.jpg')}}" class="rounded-1" width="50"
                         height="50" style="object-fit: cover" alt="...">
                </div>
                <div class="flex-grow-1 ms-3 mb-3">
                    <h5 class="mb-0">{{$comment->Author}}</h5>
                    <p class="mb-0" style="font-size: 12px">{!! $comment->Content !!}</p>
                    <p class="mb-0" style="font-size: 12px">
                            <span class="me-1">
                                <a href="" class="text-muted">Like</a>
                            </span>.
                        <span class="mx-1">
                                <a href="" class="text-muted">Reply</a>
                            </span>.
                        @php
                            $startTime = \Carbon\Carbon::parse($comment->BlogDate);
                            $finishTime = \Carbon\Carbon::now();
                            $totalDuration = $startTime->diff($finishTime)->format('%H:%I:%S');
                            //$totalDuration = $finishTime->diffForHumans($startTime);
                        @endphp
                        <span class="mx-1 text-muted">
                                {{$totalDuration}}
                            </span>
                    </p>
                </div>
            </div>
{{--            Sub comment Section--}}

{{--            <div class="sub-comment ms-2 ps-2 ms-lg-5">--}}
{{--                <div class="d-flex w-100">--}}
{{--                    <div class="flex-shrink-0">--}}
{{--                        <img src="{{asset('images/images-home/smiling-girl.jpg')}}" class="rounded-1" width="50"--}}
{{--                             height="50" style="object-fit: cover" alt="...">--}}
{{--                    </div>--}}
{{--                    <div class="flex-grow-1 ms-3">--}}
{{--                        <h5 class="mb-0">Courteny Hendry</h5>--}}
{{--                        <p class="mb-0" style="font-size: 12px">Ultricies ultricies interdum dolor sodales. Vitae--}}
{{--                            feugiat vitae vitae quis id consectetur. Aenean urna, lectus enim suscipit eget.--}}
{{--                            Tristique bibendum nib.</p>--}}
{{--                        <p class="mb-0" style="font-size: 12px">--}}
{{--                            <span class="me-1">--}}
{{--                                <a href="" class="text-muted">Like</a>--}}
{{--                            </span>.--}}
{{--                            <span class="mx-1">--}}
{{--                                <a href="" class="text-muted">Reply</a>--}}
{{--                            </span>.--}}
{{--                            <span class="mx-1 text-muted">--}}
{{--                                24h--}}
{{--                            </span>--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            @endforeach
{{--            @if(count($BlogComments)>3)--}}
{{--                <div class="">--}}
{{--                    <button class="w-100 btn btn-primary">Load More comments</button>--}}
{{--                </div>--}}
{{--            @endif--}}
        </div>
    </div>
</div>
</div>
</div>
