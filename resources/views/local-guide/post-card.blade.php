<div class="col-md-6 col-xl-4 mb-4 item">

    <div class="card blog-card rounded-2">
        <div class="card-header border-0 pt-3 pb-1">
            <div class="d-block d-sm-flex justify-content-between align-items-center">
                <div class="user-img d-flex align-items-center">
                    <a href="{{route('guest.local-guide.show',$dt->id)}}">
                        <img
                            src="{{ $dt->user->profile_photo_url }}"
                            class="avatar-initials img-fluid position-relative rounded-circle border-rounded-red"
                            alt="{{ $dt->user->name ?? '' }}" style="object-fit: cover;"
                        >
                    </a>
                    <div class="ps-2">
                        <b class="mb-1 text-black fs-4 title-fs text-capitalize">{{$dt->user->first_name}} {{$dt->user->last_name}}</b>
                        <p class="mb-0 date-fs fw-500">{{ substr($dt->address , 0 ,15) }}
                            <a href="https://google.com/maps?q={{$dt->address}}" class="color-blue fw-normal"
                               target="_blank">View</a>
                        </p>
                    </div>
                </div>
                <p class="mb-0 badge badge-primary fs-13 fw-semi-bold mt-3 mt-sm-0" style="padding: 10px">{{$dt->category->name ?? ''}}</p>
            </div>
            <div class="d-flex align-items-center justify-content-between pt-3">
                <p class="text-dark mb-0" style="font-weight: 500">{{ substr($dt->title, 0, 15) }}</p>
                <p class="mb-0">{{ $dt->datetime }}</p>
            </div>
        </div>
        <div class="w-100">
            <a class="btn  position-absolute text-index featured-btn mt-3 ms-3">FEATURE HOUSE</a>
            <a href="{{route('guest.local-guide.show',$dt->id)}}">
                <img

{{--                    src="{{$dt->getFileUrl('image')}}"--}}
                        @if(isset($dt->image))
                        src="{{$dt->getFileUrl('image')}}"
                        @elseif(!is_null($dt->user->house->image))
                        src="{{ $dt->user->house->getFileUrl() }}"
                        @else
                        src="{{$dt->getFileUrl('image')}}"
                        @endif

                    class="card-img-top  position-relative p-3"
                     style="height: 355px !important;object-fit: cover;border-radius:23px;"
                     alt="{{ $dt->title ?? '' }}"/>
            </a>
        </div>
        <div class="card-body p-2">
            <div class="card-footer px-1 pb-1 border-0 pt-1">
                <ul class="d-block d-sm-flex list-unstyled recipe-card-footer align-items-center mb-2">
                    @if(isset($avgRating))
                        <span class="text-primary fw-bolder fs-4 pe-2">
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
                                <span class="ps-2 text-light-grey">({{$dt->reviews->count()}} Reviews)</span>
                            </a>
                    @else
                        <li>
                        <span class="text-primary fw-bolder fs-4">
                           0
                        </span>
                            <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}" style="width: 17px;margin-top: -3px"
                                 alt="">
                            <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}" style="width: 17px;margin-top: -3px"
                                 alt="">
                            <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}" style="width: 17px;margin-top: -3px"
                                 alt="">
                            <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}" style="width: 17px;margin-top: -3px"
                                 alt="">
                            <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}" style="width: 17px;margin-top: -3px"
                                 alt="">
                            <a href="{{route('guest.local-guide.show',$dt->id)}}">
                                <span class="ps-2 text-light-grey">(0 Reviews)</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

</div>

