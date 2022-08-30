<div id="masonry">
<div class="col-md-4 col-lg-3">
    <div class="card mb-3">
        @if(isset($dt->image))
            <img
                src="{{$dt->getFileUrl('image')}}"
                class="card-img-top rounded-2"
                alt="{{ $dt->title ?? '' }}"
            />
        @endif
        <div class="card-body">
            <h3 class="card-title">{{$dt->title}}</h3>
            <div class="card-text text-light-secondary">
                {!! $dt->Board !!}
            </div>
        </div>
    </div>
</div>
</div>
@push('scripts')
    <script>
        $('#masonry').imagesLoaded(function() {
            $('#masonry').masonry({
                itemSelector : '.item',
                columnWidth : 460,
                isAnimated: true,
                gutter: 20,
                isFitWidth: true,
                animationOptions: {
                    duration: 700,
                    easing: 'linear',
                    queue: false
                }
            });
        });
    </script>

@endpush
