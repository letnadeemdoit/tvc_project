<div>
    <div class="card border-0  shadow-none">
        {{--    @if(!empty($album->image))--}}
            {{--    <img--}}
            {{--        src="https://images.unsplash.com/photo-1661688625912-8d0191156923?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyNHx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60"--}}
            {{--        class="card-img"/>--}}
        @if(isset($dt->image))
            <img
                src="{{ $dt->getFileUrl() }}"
                class="card-img"/>
        @endif

        <div class="card-body">
            <h3 class="card-title">{{$dt->title}}</h3>
            <div class="text-light-secondary">
                {!! $dt->Board !!}
            </div>
        </div>
    </div>
</div>



{{--<div id="masonry">--}}
{{--<div class="col-md-4 col-lg-3">--}}
{{--    <div class="card mb-3">--}}
{{--        @if(isset($dt->image))--}}
{{--            <img--}}
{{--                src="{{$dt->getFileUrl('image')}}"--}}
{{--                class="card-img-top rounded-2"--}}
{{--                alt="{{ $dt->title ?? '' }}"--}}
{{--            />--}}
{{--        @endif--}}
{{--        <div class="card-body">--}}
{{--            <h3 class="card-title">{{$dt->title}}</h3>--}}
{{--            <div class="card-text text-light-secondary">--}}
{{--                {!! $dt->Board !!}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--</div>--}}
{{--@push('scripts')--}}
{{--    <script>--}}
{{--        $('#masonry').imagesLoaded(function() {--}}
{{--            $('#masonry').masonry({--}}
{{--                itemSelector : '.item',--}}
{{--                columnWidth : 460,--}}
{{--                isAnimated: true,--}}
{{--                gutter: 20,--}}
{{--                isFitWidth: true,--}}
{{--                animationOptions: {--}}
{{--                    duration: 700,--}}
{{--                    easing: 'linear',--}}
{{--                    queue: false--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}

{{--@endpush--}}
