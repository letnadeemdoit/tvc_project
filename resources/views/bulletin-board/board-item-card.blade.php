<div class="card mb-3">
    <img
        src="{{$dt->getFileUrl('image')}}"
        class="card-img-top"
        alt="{{ $dt->title ?? '' }}"
    />
    <div class="card-body">
        <h3 class="card-title">{{$dt->title}}</h3>
        <div class="card-text">
            {!! $dt->Board !!}
        </div>
    </div>
</div>

