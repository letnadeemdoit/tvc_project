<div>

    @push('stylesheets')

        <style>
            .rate {
                float: left;
                height: 46px;
                padding: 0 10px;
            }

            .rate:not(:checked) > input {
                position: absolute;
                top: -9999px;
            }

            .rate:not(:checked) > label {
                float: right;
                width: 1em;
                overflow: hidden;
                white-space: nowrap;
                cursor: pointer;
                font-size: 30px;
                color: #cccccc9c;
            }

            .rate:not(:checked) > label:before {
                content: '★ ';
            }

            .rate > input:checked ~ label {
                color: #E8604C;
            }

            .rate:not(:checked) > label:hover,
            .rate:not(:checked) > label:hover ~ label {
                color: #E8604C;
            }

            .rate > input:checked + label:hover,
            .rate > input:checked + label:hover ~ label,
            .rate > input:checked ~ label:hover,
            .rate > input:checked ~ label:hover ~ label,
            .rate > label:hover ~ input:checked ~ label {
                color: #E8604C;
            }

        </style>

        <style>
            span.fa.fa-star.checked {
                background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxOCAxNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTkuNjAzNDYgMC45MTQ0NTNDOS4yMTg5MiAwLjEzNTI4NiA4LjEwNzI3IDAuMTM1Mjg2IDcuNzIyNzQgMC45MTQ0NTNMNS44OTA5NiA0LjYyNjE4TDEuNzk0NyA1LjIyMTIzQzAuOTM0NzQyIDUuMzQ1NTMgMC41OTA2MDQgNi40MDM1OCAxLjIxMzYzIDcuMDEwMjlMNC4xNzcyNiA5Ljg5OTM0TDMuNDc4MSAxMy45Nzc3QzMuMzMwNTEgMTQuODM1NCA0LjIzMDA4IDE1LjQ4ODcgNC45OTkxNSAxNS4wODM5TDguNjYyNzEgMTMuMTU3NEwxMi4zMjYzIDE1LjA4MzlDMTMuMDk1MyAxNS40ODc5IDEzLjk5NDkgMTQuODM1NCAxMy44NDgxIDEzLjk3ODVMMTMuMTQ4OSA5Ljg5OTM0TDE2LjExMjYgNy4wMDk1MUMxNi43MzQgNi40MDM1OCAxNi4zOTE1IDUuMzQ2MyAxNS41MzA3IDUuMjIxMjNMMTEuNDM2IDQuNjI2MThMOS42MDM0NiAwLjkxNDQ1M1pNMC4yNDQ5MTIgMS40NDE5MkMwLjE0ODUwMSAxLjU2MjY2IDAuMTAzOTk2IDEuNzE2NzUgMC4xMjExODYgMS44NzAzQzAuMTM4Mzc3IDIuMDIzODUgMC4yMTU4NTUgMi4xNjQyOCAwLjMzNjU3OSAyLjI2MDcxTDIuMjc4NjcgMy44MTQzOEMyLjMzODIxIDMuODYzODggMi40MDcwMiAzLjkwMTAyIDIuNDgxMDggMy45MjM2MkMyLjU1NTE0IDMuOTQ2MjIgMi42MzI5NiAzLjk1MzgzIDIuNzA5OTkgMy45NDYwMUMyLjc4NzAzIDMuOTM4MTkgMi44NjE3MyAzLjkxNTA5IDIuOTI5NzMgMy44NzgwN0MyLjk5Nzc0IDMuODQxMDQgMy4wNTc2OCAzLjc5MDgzIDMuMTA2MDYgMy43MzAzOEMzLjE1NDQ0IDMuNjY5OTIgMy4xOTAyOCAzLjYwMDQyIDMuMjExNDkgMy41MjU5NkMzLjIzMjY5IDMuNDUxNDkgMy4yMzg4NSAzLjM3MzU0IDMuMjI5NTggMy4yOTY2NkMzLjIyMDMyIDMuMjE5NzkgMy4xOTU4MyAzLjE0NTUzIDMuMTU3NTMgMy4wNzgyM0MzLjExOTI0IDMuMDEwOTMgMy4wNjc5MiAyLjk1MTk0IDMuMDA2NTYgMi45MDQ3MUwxLjA2NDQ3IDEuMzUxMDNDMS4wMDQ3MiAxLjMwMzEzIDAuOTM2MTAxIDEuMjY3NDggMC44NjI1NTQgMS4yNDYxM0MwLjc4OTAwNiAxLjIyNDc3IDAuNzExOTY5IDEuMjE4MTIgMC42MzU4NDkgMS4yMjY1NkMwLjU1OTcyOSAxLjIzNSAwLjQ4NjAyMSAxLjI1ODM3IDAuNDE4OTQgMS4yOTUzMkMwLjM1MTg1OSAxLjMzMjI4IDAuMjkyNzIyIDEuMzgyMDkgMC4yNDQ5MTIgMS40NDE5MlpNMTcuMDgwNSAxMi42NTcxQzE3LjE3NyAxMi41MzY1IDE3LjIyMTYgMTIuMzgyNCAxNy4yMDQ2IDEyLjIyODlDMTcuMTg3NiAxMi4wNzU0IDE3LjExMDIgMTEuOTM0OSAxNi45ODk2IDExLjgzODNMMTUuMDQ3NSAxMC4yODQ2QzE0LjkyNjkgMTAuMTg4IDE0Ljc3MjggMTAuMTQzMyAxNC42MTkyIDEwLjE2MDJDMTQuNDY1NiAxMC4xNzcyIDE0LjMyNSAxMC4yNTQ1IDE0LjIyODQgMTAuMzc1MkMxNC4xMzE3IDEwLjQ5NTggMTQuMDg3IDEwLjY0OTkgMTQuMTAzOSAxMC44MDM1QzE0LjEyMDkgMTAuOTU3MSAxNC4xOTgyIDExLjA5NzcgMTQuMzE4OSAxMS4xOTQzTDE2LjI2MDkgMTIuNzQ4QzE2LjMyMDcgMTIuNzk1OSAxNi4zODkzIDEyLjgzMTUgMTYuNDYyOSAxMi44NTI5QzE2LjUzNjQgMTIuODc0MyAxNi42MTM0IDEyLjg4MDkgMTYuNjg5NiAxMi44NzI1QzE2Ljc2NTcgMTIuODY0IDE2LjgzOTQgMTIuODQwNyAxNi45MDY1IDEyLjgwMzdDMTYuOTczNiAxMi43NjY4IDE3LjAzMjcgMTIuNzE2OSAxNy4wODA1IDEyLjY1NzFaTTAuMzM2NTc5IDExLjgzODNDMC4yNzUyMjUgMTEuODg1NiAwLjIyMzkwMiAxMS45NDQ1IDAuMTg1NjA5IDEyLjAxMThDMC4xNDczMTcgMTIuMDc5MSAwLjEyMjgyMyAxMi4xNTM0IDAuMTEzNTYgMTIuMjMwM0MwLjEwNDI5NiAxMi4zMDcyIDAuMTEwNDQ5IDEyLjM4NTEgMC4xMzE2NTggMTIuNDU5NkMwLjE1Mjg2OCAxMi41MzQgMC4xODg3MDggMTIuNjAzNSAwLjIzNzA4NSAxMi42NjRDMC4yODU0NjEgMTIuNzI0NCAwLjM0NTQwNCAxMi43NzQ3IDAuNDEzNDA5IDEyLjgxMTdDMC40ODE0MTMgMTIuODQ4NyAwLjU1NjExNiAxMi44NzE4IDAuNjMzMTUgMTIuODc5NkMwLjcxMDE4NSAxMi44ODc0IDAuNzg4MDA2IDEyLjg3OTggMC44NjIwNjQgMTIuODU3MkMwLjkzNjEyMyAxMi44MzQ2IDEuMDA0OTMgMTIuNzk3NSAxLjA2NDQ3IDEyLjc0OEwzLjAwNjU2IDExLjE5NDNDMy4xMjM5MyAxMS4wOTY3IDMuMTk4MzIgMTAuOTU3IDMuMjEzNzQgMTAuODA1MkMzLjIyOTE2IDEwLjY1MzMgMy4xODQzNyAxMC41MDE1IDMuMDg5MDEgMTAuMzgyM0MyLjk5MzY1IDEwLjI2MzEgMi44NTUzMyAxMC4xODYxIDIuNzAzOCAxMC4xNjc5QzIuNTUyMjYgMTAuMTQ5NiAyLjM5OTYxIDEwLjE5MTUgMi4yNzg2NyAxMC4yODQ2TDAuMzM2NTc5IDExLjgzODNaTTE3LjA4MDUgMS40NDExNUMxNy4xNzcgMS41NjE3OSAxNy4yMjE2IDEuNzE1ODIgMTcuMjA0NiAxLjg2OTM2QzE3LjE4NzYgMi4wMjI5IDE3LjExMDIgMi4xNjMzOSAxNi45ODk2IDIuMjU5OTNMMTUuMDQ3NSAzLjgxMzYxQzE0Ljk4NzggMy44NjE0NSAxNC45MTkyIDMuODk3MDYgMTQuODQ1NyAzLjkxODQxQzE0Ljc3MjIgMy45Mzk3NSAxNC42OTUzIDMuOTQ2NDEgMTQuNjE5MiAzLjkzODAxQzE0LjU0MzEgMy45Mjk2MSAxNC40Njk1IDMuOTA2MyAxNC40MDI0IDMuODY5NDNDMTQuMzM1MyAzLjgzMjU2IDE0LjI3NjIgMy43ODI4MyAxNC4yMjg0IDMuNzIzMUMxNC4xODA1IDMuNjYzMzcgMTQuMTQ0OSAzLjU5NDggMTQuMTIzNiAzLjUyMTMxQzE0LjEwMjIgMy40NDc4MiAxNC4wOTU1IDMuMzcwODQgMTQuMTAzOSAzLjI5NDc3QzE0LjExMjQgMy4yMTg3MSAxNC4xMzU3IDMuMTQ1MDQgMTQuMTcyNSAzLjA3Nzk4QzE0LjIwOTQgMy4wMTA5MiAxNC4yNTkxIDIuOTUxNzggMTQuMzE4OSAyLjkwMzkzTDE2LjI2MDkgMS4zNTAyNkMxNi4zMjA3IDEuMzAyMzYgMTYuMzg5MyAxLjI2NjcxIDE2LjQ2MjkgMS4yNDUzNUMxNi41MzY0IDEuMjIzOTkgMTYuNjEzNCAxLjIxNzM0IDE2LjY4OTYgMS4yMjU3OEMxNi43NjU3IDEuMjM0MjIgMTYuODM5NCAxLjI1NzU5IDE2LjkwNjUgMS4yOTQ1NUMxNi45NzM2IDEuMzMxNSAxNy4wMzI3IDEuMzgxMzIgMTcuMDgwNSAxLjQ0MTE1WiIgZmlsbD0iI0U4NjA0QyIvPgo8L3N2Zz4K) !important;
                background-size: 100%;
            }
        </style>

    @endpush

    <div class="container my-5 pb-4">
        <div class="row mb-5 mt-5">
            <div class="col-12 col-lg-6">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{$localGuide->reviews()->count()}} Reviews</h4>
                    <div><label for="">Sort By</label>
                        <select name="" id=""
                                wire:model="orderBy"
                                class="border px-3 py-1 rounded" style="background-color: #F5F6F7;">
                            <option value="DESC">Latest</option>
                            <option value="ASC">Oldest</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        @if(isset($avgRating))
            <div class="row py-5 my-4">
                <div class="col-12 col-lg-6">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div>
                                <h1 class="text-primary">
                                    @if($avgRating)
                                        {{$avgRating ?? 0}}.0
                                    @else
                                        0
                                    @endif
                                </h1>
                                <div class="rate px-0">
                                    <ul class="d-block d-sm-flex list-unstyled recipe-card-footer justify-content-between mb-2">
                                        <li>
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

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row align-items-center">
                                <div class="col-1">
                                    <span>5.0</span>
                                </div>
                                <div class="col-9 col-sm-10">
                                    <div class="progress">
                                        <div class="progress-bar" style="width: {{$allRatingFive ?? 0}}%"
                                             role="progressbar" aria-valuenow="100"
                                             aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <span>({{ $countAllRatingFive ?? 0 }})</span>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-1">
                                    <span>4.0</span>
                                </div>
                                <div class="col-9 col-sm-10">
                                    <div class="progress">
                                        <div class="progress-bar" style="width: {{$allRatingFour ?? 0}}%"
                                             role="progressbar" aria-valuenow="75"
                                             aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <span>({{ $countAllRatingFour ?? 0}})</span>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-1">
                                    <span>3.0</span>
                                </div>
                                <div class="col-9 col-sm-10">
                                    <div class="progress">
                                        <div class="progress-bar" style="width: {{$allRatingThree ?? 0}}%"
                                             role="progressbar" aria-valuenow="50"
                                             aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <span>({{ $countAllRatingThree ?? 0 }})</span>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-1">
                                    <span>2.0</span>
                                </div>
                                <div class="col-9 col-sm-10">
                                    <div class="progress">
                                        <div class="progress-bar" style="width: {{$allRatingTwo ?? 0}}% !important;"
                                             role="progressbar" aria-valuenow="25"
                                             aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <span>({{ $countAllRatingTwo ?? 0 }})</span>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <div class="col-1">
                                    <span>1.0</span>
                                </div>
                                <div class="col-9 col-sm-10">
                                    <div class="progress">
                                        <div class="progress-bar" style="width: {{$allRatingOne ?? 0}}%"
                                             role="progressbar" aria-valuenow="25"
                                             aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <span>({{ $countAllRatingOne ?? 0}})</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-6">
                </div>
            </div>
        @endif

        <div class="row my-5">
            <div class="col-12 col-lg-6">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <img src="{{$localGuide->user->profile_photo_url}}" class="rounded-circle"
                             width="50"
                             height="50" style="object-fit: cover" alt="...">
                    </div>

                        <div class="flex-grow-1 ms-3">
                            <form wire:submit.prevent="saveRatingForm">
                                <div class="rate my-2 px-0">
                                    @if(isset($user))
                                        <ul class="d-block d-sm-flex list-unstyled recipe-card-footer justify-content-between mb-2">
                                            <li>
                                                @php
                                                    $i = 0;
                                                @endphp
                                                @while (++$i <= ($user->rating))
                                                    <span class="fa fa-star checked"></span>
                                                @endwhile

                                                @php
                                                    $r = 1;
                                                    $t_rating = 5;
                                                @endphp

                                                @for ($r; $r <= $t_rating - $user->rating; $r++)
                                                    <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}" style="width: 17px;margin-top: -1px" alt="">
                                                @endfor
                                            </li>
                                        </ul>
                                    @else
                                        <input type="radio" class="" hidden id="star5" wire:model.defer="state.rating"
                                               name="rating"
                                               value="5"/>
                                        <label for="star5" class="" title="text">5 stars</label>
                                        <input type="radio" hidden id="star4" wire:model.defer="state.rating" name="rating"
                                               value="4"/>
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" hidden id="star3" wire:model.defer="state.rating" name="rating"
                                               value="3"/>
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" hidden id="star2" wire:model.defer="state.rating" name="rating"
                                               value="2"/>
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" hidden id="star1" wire:model.defer="state.rating" name="rating"
                                               value="1"/>
                                        <label for="star1" title="text">1 star</label>
                                    @endif
                                </div>
                                <div class="">
                        <textarea id="remarks" name="remarks" wire:model.defer="state.remarks" class="form-control"
                                  placeholder="Leave a review"
                                  rows="6"></textarea>
                                </div>
                                <div class="text-start text-lg-end py-3 px-3" style="background-color: #2D394C10">
                                    <button class="btn btn-secondary px-5 {{ $user ? 'disabled' : '' }} "
                                            style="background-color: #2D394C">Review
                                    </button>
                                </div>
                            </form>
                        </div>

                </div>
            </div>
        </div>

        @if(isset($totalReviewLocalGuide))
            @foreach($totalReviewLocalGuide as $review)
                @continue(is_null($review->user))
                <div class="row mt-5 mb-3 more-reviews">
                    <div class="col-12 col-lg-6">
                        <div class="d-flex w-100">
                            <div class="flex-shrink-0">

                                <img src="{{$review->user->profile_photo_url}}" class="rounded-circle"
                                     width="50"
                                     height="50" style="object-fit: cover" alt="...">

                            </div>
                            <div class="flex-grow-1 ms-3 mb-3">
                                <h5 class="mb-0">{{$review->user->user_name}}</h5>
                                <div>
                                    <ul class="d-block d-sm-flex list-unstyled recipe-card-footer justify-content-between mb-2">
                                        <li>
                                            @php
                                                $i = 0;
                                            @endphp
                                            @while (++$i <= ($review->rating))
                                                <span class="fa fa-star checked"></span>
                                            @endwhile

                                            @php
                                                $r = 1;
                                                $t_rating = 5;
                                            @endphp

                                            @for ($r; $r <= $t_rating - $review->rating; $r++)
                                                <img src="{{asset('images/local-guide/star-rating-light-icon.svg')}}" style="width: 17px;margin-top: -1px" alt="">
                                            @endfor
                                        </li>
                                    </ul>
                                </div>
                                <p class="mb-0"
                                   style="font-size: 12px">
                                    {{$review->remarks}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        @endif


        @if(isset($totalReviewLocalGuide) && count($totalReviewLocalGuide) > 2)
            <div class="row mt-5 mb-3">
                <div class="col-12 col-lg-6">
                    <button class="w-100 btn btn-primary" id="moreReviews">Load More comments</button>
                </div>
            </div>
        @endif

    </div>

    @push('scripts')

        <script>
            $(document).ready(function () {

                var list = $(".more-reviews");
                var numToShow = 2;
                var button = $("#moreReviews");
                var numInList = list.length;
                list.hide();
                if (numInList > numToShow) {
                    button.show();
                }
                list.slice(0, numToShow).show();

                button.click(function () {
                    var showing = list.filter(':visible').length;
                    list.slice(showing - 1, showing + numToShow).fadeIn();
                    var nowShowing = list.filter(':visible').length;
                    if (nowShowing >= numInList) {
                        button.hide();
                    }
                });

            });
        </script>


    @endpush()
</div>

