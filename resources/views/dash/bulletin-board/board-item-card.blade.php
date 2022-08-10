<div class="col-12 col-md-6 col-lg-3 mb-3 column ">
    <div class="card">
        @if(isset($board->image))
            <a href="#">
                <img src="{{ asset('/storage/'.$board->image) }}" class="card-img-top" alt="..." />
            </a>
        @endif
        <div class="card-body">
            <h3 class="card-title">
               <a>{{ $board->Audit_user_name ?? '' }}</a>
            </h3>
            <h5 class="">
                {{ $board->Audit_Role ?? ''}}
            </h5>
            <h5 class="">
                {{ $board->Audit_FirstName ?? ''}}
            </h5>

            <div class="card-text">
                <p>{!! $board->Board !!}</p>
            </div>
        </div>
    </div>
</div>
