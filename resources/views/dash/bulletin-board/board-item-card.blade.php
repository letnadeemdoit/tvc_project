
<div class="col-12 col-md-6 col-lg-3">
    @if(isset($board))
    <div class="card">
        <a href="{{route('guest.card', $board->HouseId)}}"><img src="/images/bulletin-images/house-1.png" class="card-img-top" alt="..." /></a>
        <div class="card-body">
            <h3 class="card-title">
               <a>{{ isset($board->Audit_user_name) ? $board->Audit_user_name : ''}}</a>
            </h3>
            <h5 class="">
                {{ isset($board->Audit_Role) ? $board->Audit_Role : ''}}
            </h5>
            <h5 class="">
                {{ isset($board->Audit_FirstName) ? $board->Audit_FirstName : ''}}
            </h5>

            <div class="card-text">
                <p>{{ isset($board->Board) ? Str::limit(strip_tags($board->Board), 100) : ''}}</p>
            </div>
        </div>
    </div>


    @endif
</div>
