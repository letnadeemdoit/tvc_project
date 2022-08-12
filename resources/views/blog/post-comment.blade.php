<div class="col-12 col-lg-6">
    <div class="d-flex">
        <div class="flex-shrink-0">
            <img src="{{asset('images/images-home/smiling-girl.jpg')}}" class="rounded-1" width="50"
                 height="50" style="object-fit: cover" alt="...">
        </div>

        <div class="flex-grow-1 ms-3">
            <form wire:submit.prevent="addBlogComment()">
                <div class="border">
                        <textarea id="Content" name="Content" wire:model.defer="state.Content" class="form-control" placeholder="Description"
                                  rows="6"></textarea>
                </div>
                @error('Content')
                <span class="text-danger fw-semi-bold" style="font-size: 13px !important;">{{$message}}</span>
                @enderror

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
                    <h5 class="mb-0">{{$comment['Author']}}</h5>
                    <p class="mb-0" style="font-size: 12px">{!! $comment['Content'] !!}</p>
                    <p class="mb-0" style="font-size: 12px">
                            <span class="me-1">
                                <a href="" class="text-muted">Like</a>
                            </span>.
                        <span class="mx-1">
                                <a href="" class="text-muted">Reply</a>
                            </span>.
                        <span class="mx-1 text-muted">
                                24h
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
{{--                <div class="">--}}
{{--                    <button class="w-100 btn btn-primary">Load More comments</button>--}}
{{--                </div>--}}
        </div>
    </div>
</div>
