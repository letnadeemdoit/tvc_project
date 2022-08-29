<div class="col-md-6 col-xl-4 mb-4 item">
    <div class="card blog-card rounded-2">
        <div class="card-header border-0 pt-3 pb-1">
            <div class="d-block d-sm-flex justify-content-between align-items-center">
                <div class="user-img d-flex align-items-center">
                    <img
                        src="{{ $dt->user->profile_photo_url }}"
                        class="avatar-initials img-fluid position-relative rounded-circle border-rounded-red"
                        alt="{{ $dt->user->name ?? '' }}"
                    >
                    <div class="ps-2">
                        <b class="mb-1 text-black fs-4 title-fs text-capitalize">{{$dt->user->first_name}} {{$dt->user->last_name}}</b>
                        <p class="mb-0 date-fs">{{ substr($dt->address , 0 ,25) }}
                            <a href="https://google.com/maps?q={{$dt->address}}" class="color-blue fw-normal"
                               target="_blank">View</a>
                        </p>
                    </div>
                </div>
                <p class="mb-0 badge badge-primary fs-13 fw-semi-bold" style="padding: 10px">{{$dt->category->name}}</p>
            </div>
            <div class="d-flex align-items-center justify-content-between pt-3">
                <b class="text-dark">{{ substr($dt->title, 0, 30) }}</b>
                <p class="mb-0">{{date('Y-m-d | h:m A',strtotime($dt->datetime))}}</p>
            </div>
        </div>
        <div class="w-100">
            <a class="btn  position-absolute text-index featured-btn mt-3 ms-3">FEATURE HOUSE</a>
            <a href="{{route('guest.local-guide.show',$dt->id)}}">
                <img src="{{$dt->getFileUrl('image')}}" class="card-img-top  position-relative p-2"
                     style="height: 320px !important;object-fit: cover;border-radius:17px;"
                     alt="{{ $dt->title ?? '' }}"/>
            </a>
        </div>
        <div class="card-body p-2">
            <div class="card-footer px-1 pb-0 border-0 pt-1">
                <ul class="d-block d-sm-flex list-unstyled recipe-card-footer align-self-center justify-content-between mb-2">
                    @if(isset($avgRating))
                        <li>
                        <span class="text-primary fw-bolder fs-4">
                            {{ $avgRating ?? 0}}.0
                        </span>
                            @php
                                $i = 0;
                            @endphp

                            @while (++$i <= ($avgRating ?? 0))
                                <span class="fa fa-star checked"></span>
                            @endwhile
                            @php
                                $r = 1;
                                $t_rating = 5;
                            @endphp

                            @for ($r; $r <= $t_rating - $avgRating; $r++)
                                <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}" style="width: 17px;margin-top: -1px" alt="">
                            @endfor

                            <a href="{{route('guest.local-guide.show',$dt->id)}}">
                                <span class="ps-2 text-dark">({{$dt->reviews->count()}} Reviews)</span>
                            </a>
                        </li>
                    @else
                        <li>
                        <span class="text-primary fw-bolder fs-4">
                           0
                        </span>
                            <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}" style="width: 17px"
                                 alt="">
                            <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}" style="width: 17px"
                                 alt="">
                            <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}" style="width: 17px"
                                 alt="">
                            <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}" style="width: 17px"
                                 alt="">
                            <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}" style="width: 17px"
                                 alt="">
                            <a href="{{route('guest.local-guide.show',$dt->id)}}">
                                <span class="ps-2 text-dark">(0 Reviews)</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>

