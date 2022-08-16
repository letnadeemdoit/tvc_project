
<x-guest-layout>
    @push('stylesheets')
    @endpush

    @include('partials.sub-page-hero-section', ['title' => 'Local Guide'])

    <section class=" bg-light pt-55">
        <div class="bg-guide shadow-1-strong rounded text-center  d-flex justify-content-center align-items-center">
            <h1 class="text-primary font-vintage mb-0">Local Guide</h1>
        </div>
        <h1 class="pt-2 text-center poppins-bold">Read Local Guide reviews here</h1>
        <div class="container mt-80 pb-5">
            <div class="row">
                @if(isset($data))
                    @foreach($data as $dt)
                        <div class="col-md-6 col-xl-4 mb-4">
                            <div class="card blog-card rounded-2">
                                <div class="card-header border-0">
                                    <div class="d-block d-sm-flex justify-content-between align-items-center">
                                        <div class="user-img d-flex align-items-center">

                                            {{--                            <img src="/images/blog-images/house-7.png" class="img-fluid position-relative" alt="...">--}}
                                            <img

                                                src="{{$dt->getFileUrl('image')}}"
                                                class="avatar-initials img-fluid position-relative rounded-circle"
                                                alt="{{ $dt->title ?? '' }}"
                                            >

                                            <div class="ps-1">
                                                <b class="mb-1 text-black fs-4 title-fs text-capitalize">{{$dt->user->first_name}} {{$dt->user->last_name}}</b>
                                                <p class="mb-0 date-fs">{{date('Y-M-d',strtotime($dt->created_at))}} <a href="#">View</a> </p>
                                            </div>
                                        </div>
                                        <a class="btn btn-primary-light fs-13 my-3 my-md-0">{{$dt->localGuideCategory->name}}</a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between pt-2">
                                        <b class="text-dark">{{$dt->title}}</b>
                                        <p class="mb-0">{{date('Y-m-d | h:m A',strtotime($dt->datetime))}}</p>
                                    </div>
                                </div>
                                <div class="w-100">
                                    <a class="btn  position-absolute text-index featured-btn mt-3 ms-3">FEATURE HOUSE</a>
                                    <a href="{{route('guest.local-guide.show',$dt->id)}}">
                                        <img src="/images/blog-images/house-5.png" class="card-img-top  position-relative p-2" style="height: 320px !important;object-fit: cover;border-radius:17px;" alt="..." />
                                    </a>


                                </div>
                                <div class="card-body p-2">
                                    <div class="card-footer px-1 pb-0 border-0">
                                        <ul class="d-block d-sm-flex list-unstyled recipe-card-footer justify-content-between">
                                            <li>
                                                <span class="text-primary fw-bolder fs-4">5.0</span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <a href="{{route('guest.local-guide.show',$dt->id)}}">
                                                    <span class="ps-2 text-dark">({{$dt->reviews->count()}} Reviews)</span>
                                                </a>
                                            </li>
                                            <li class="pt-2 pt-md-0"><img src="/images/blog-images/comment.svg" class="img-fluid me-1">
                                                <a href="{{route('guest.local-guide.show',$dt->id)}}">
                                                    <span class="text-dark">{{$dt->comments->count()}}  Comments</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            $(document).ready(function(){
                $('nav.navecation ul li a').click(function(){
                    $('li a').removeClass("active");
                    $(this).addClass("active");
                });
            });
        </script>
    @endpush()
</x-guest-layout>

