<section class=" bg-light">
    <div class="section-padding">
        <div class="bg-{{$title}} shadow-1-strong rounded text-center d-flex justify-content-center align-items-center">
            <h1 class="text-primary font-vintage mb-0">{{$title}} list</h1>
        </div>
        <h1 class="pt-2 text-center poppins-bold text-capitalize">View Available {{$title}} in House</h1>
    </div>
    <div class="container my-2  bg-light-primary p-3 p-md-5 rounded-2 house-card-border">
        <div class="d-block d-sm-flex justify-content-between align-items-center">
            <div class="">
                <h3 class="mb-0 text-capitalize text-center text-md-start">{{$title}} in the House</h3>
            </div>
            <div class="">
                <div
                    class="btn-group switch-button nav nav-tabs d-flex justify-content-end bg-dark-blue p-2 rounded-pill mt-3 mt-sm-0"
                    id="myTab" role="tablist">
                    <a href="#!" class="{{$title == 'food' ? 'active' : ''}} btn rounded-pill text-white" id="home-tab"
                       data-bs-target="#home" role="tab" aria-controls="home" aria-selected="true"
                       wire:click.prevent="changeFoodTitle"
                    >Food in House
                    </a>
                    <a href="#!" class="{{$title == 'shopping' ? 'active' : ''}} btn rounded-pill text-white"
                       id="profile-tab"
                       data-bs-target="#profile" role="tab" aria-controls="profile" aria-selected="false"
                       wire:click.prevent="changeShoppingTitle"
                    >Shopping List
                    </a>
                </div>
            </div>
        </div>
        <div class="tab-content  mt-5" id="myTabContent">
            @if($title == 'food')
                <div class="" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @if(isset($foodItems))
                        @foreach($foodItems as $dt)
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div
                                        class="row justify-content-center justify-content-md-start align-items-center text-start text-lg-center">
                                        <div class="col-md-6 col-lg-2  border-right-solid text-center">
                                            <img src="{{$dt->getFileUrl('image')}}" alt="{{ $dt->title ?? '' }}"
                                                 style="width: 120px;height: 75px;object-fit: cover"
                                                 class="rounded-3 food-item-img">
                                        </div>
                                        <div class="col-md-6 col-lg-10">
                                            <div class="row">
                                                <div
                                                    class="col-12  col-lg-4  mt-3 mt-md-0 border-right-solid d-flex align-items-center ps-3 ps-lg-5">
                                                    <span class="badge badge-blue btn-min-115 fs-4 p-2 fw-normal">Food Item :</span>
                                                    <p class="mb-0 ps-5 toggle-text">{{$dt->name}}</p>
                                                </div>
                                                <div
                                                    class="col-12 col-lg-4  mt-3 mt-lg-0 border-right-solid d-flex align-items-center ps-3 ps-lg-5">
                                                    <span class="badge badge-green btn-min-115 fs-4 p-2 fw-normal">Location :</span>
                                                    <p class="mb-0 ps-5 toggle-text">{{$dt->location}}</p>
                                                </div>
                                                <div
                                                    class="col-12 col-lg-4 mt-3 mt-lg-0 d-flex align-items-center ps-3 ps-lg-5">
                                                    <span class="badge badge-primary btn-min-115 fs-4 p-2 fw-normal">Expiry Date:</span>
                                                    <p class="mb-0 ps-5">{{$dt->expiration_date}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            @endif

            @if($title == 'shopping')
                <div class="" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                @if(isset($shoppingItems))
                    @foreach($shoppingItems as $dt)
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row justify-content-center justify-content-md-start align-items-center text-start text-lg-center">
                                    <div class="col-md-6 col-lg-2  border-right-solid text-center">
                                        <img src="{{$dt->getFileUrl('image')}}" alt="{{ $dt->title ?? '' }}"
                                             style="width: 120px;height: 75px;object-fit: cover" class="rounded-3 food-item-img">
                                    </div>
                                    <div class="col-md-6 col-lg-10">
                                        <div class="row">
                                            <div
                                                class="col-12  col-lg-4  mt-3 mt-md-0 border-right-solid d-flex align-items-center ps-3 ps-lg-5">
                                                <span class="badge badge-blue btn-min-115 fs-4 p-2 fw-normal">Food Item :</span>
                                                <p class="mb-0 ps-5 toggle-text">{{$dt->name}}</p>

{{--                                                {{$dt->name}}--}}
                                            </div>
                                            <div
                                                class="col-12 col-lg-4  mt-3 mt-lg-0 border-right-solid d-flex align-items-center ps-3 ps-lg-5">
                                                <span class="badge badge-green btn-min-115 fs-4 p-2 fw-normal">Location :</span>
                                                <p class="mb-0 ps-5 toggle-text">{{$dt->location}}</p>
                                            </div>
                                            <div
                                                class="col-12 col-lg-4 mt-3 mt-lg-0 d-flex align-items-center ps-3 ps-lg-5">
                                                <span class="badge badge-primary btn-min-115 fs-4 p-2 fw-normal">Expiry Date:</span>
                                                <p class="mb-0 ps-5">{{$dt->expiration_date}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
          @endif

        </div>
    </div>
</section>
