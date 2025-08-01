@push('stylesheets')
    <style>
        .card-hover-house-items:hover{
            transition: box-shadow .3s;
            box-shadow: 0 8px 11px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.15);
        }

        .mb-100{
            margin-bottom: 100px;
        }
        .bg-food{
            background-image: url('/images/house-items/food.svg') !important;
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            height: 50px;
        }

        .bg-shopping{
            background-image: url('/images/house-items/shopping.svg') !important;
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            height: 50px;
        }
    </style>
@endpush
<div>

    @include('partials.sub-page-hero-section', [
    'title' => $title . ' '. 'Items',
    ])


    <section class=" bg-light pt-5" style="padding-bottom: 100px !important;">
{{--        <div class="section-padding">--}}
{{--            <div class="bg-{{$title}} shadow-1-strong rounded text-center d-flex justify-content-center align-items-center">--}}
{{--                <h1 class="text-primary font-vintage mb-0">{{$title}} list</h1>--}}
{{--            </div>--}}



{{--            @if($title == 'food')--}}
{{--                <h1 class="pt-2 text-center poppins-bold text-capitalize">View Available Food in House</h1>--}}
{{--            @endif--}}

{{--            @if($title == 'shopping')--}}
{{--                <h1 class="pt-2 text-center poppins-bold text-capitalize">View Available Shopping List</h1>--}}
{{--            @endif--}}


{{--        </div>--}}
        <div class="container bg-light-primary p-3 p-md-5 rounded-2 house-card-border">
            <div class="d-block d-sm-flex justify-content-between align-items-center">
                <div class="">


                    @if($title == 'food')
                        <h3 class="mb-0 text-capitalize text-center text-md-start">Food</h3>

                    @endif

                    @if($title == 'shopping')
                            <h3 class="mb-0 text-capitalize text-center text-md-start">Shopping</h3>
                    @endif


                </div>
                <div class="">
                    <div class="d-flex justify-content-end mt-3 mt-sm-0">
                        @if($title == 'food' && !auth()->user()->is_guest)
                            <div class="me-4 mt-2" x-data>
                                <a
                                    class="btn btn-sm btn-soft-primary"
                                    href="#!"
                                    @click.prevent="window.livewire.emit('showFoodItemCUModal', true)"
                                >
                                    <i class="bi-plus me-1"></i> Add New Food Item
                                </a>
                            </div>
                        @endif

                        @if($title == 'shopping' && !auth()->user()->is_guest)
                            <div class="me-4 mt-2" x-data>
                                <a
                                    class="btn btn-sm btn-soft-primary"
                                    href="#!"
                                    @click.prevent="window.livewire.emit('showShoppingItemCUModal', true)"
                                >
                                    <i class="bi-plus me-1"></i> Add New Shopping Item
                                </a>
                            </div>
                        @endif

                        <div
                            class="btn-group switch-button nav nav-tabs bg-dark-blue p-2 rounded-pill"
                            id="myTab" role="tablist">
                            <a href="#!" class="{{$title == 'food' ? 'active' : ''}} btn rounded-pill text-white px-5"
                               id="home-tab"
                               data-bs-target="#home" role="tab" aria-controls="home" aria-selected="true"
                               wire:click.prevent="changeFoodTitle"
                            >Food
                            </a>
                            <a href="#!" class="{{$title == 'shopping' ? 'active' : ''}} btn rounded-pill text-white"
                               id="profile-tab"
                               data-bs-target="#profile" role="tab" aria-controls="profile" aria-selected="false"
                               wire:click.prevent="changeShoppingTitle"
                            >Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content  mt-5" id="myTabContent">
                @if($title == 'food')
                    <div class="" id="home" role="tabpanel" aria-labelledby="home-tab">
                        @if(isset($foodItems) && count($foodItems) > 0)
                            @foreach($foodItems as $dt)
                                <div class="card mb-4 card-hover-house-items pt-4 position-relative">
                                    <div class="card-body">
                                        <div
                                            class="row justify-content-center justify-content-md-start align-items-center text-start text-lg-center">
                                            <div class="col-md-6 col-lg-2  border-right-solid text-center">
                                                <img src="{{$dt->getFileUrl('image')}}" alt="{{ $dt->title ?? '' }}"
                                                     style="width: 120px;height: 75px;object-fit: cover"
                                                     class="rounded-3 food-item-img">
                                            </div>
                                            <div class="col-md-6 col-lg-10">
                                                <div class="row text-secondary-light">
                                                    <div
                                                        class="col-12 col-lg-4 mt-3 mt-md-0 border-right-solid d-flex align-items-center ps-3 ps-lg-5">
                                                        <span class="badge badge-blue btn-min-115 fs-4 p-2 fw-normal">Food Item :</span>
                                                        <p class="mb-0 ps-5 toggle-text text-break text-start">{{$dt->name}}</p>
                                                    </div>
                                                    <div
                                                        class="col-12 col-lg-4 mt-3 border-right-solid mt-lg-0 d-flex align-items-center ps-3 ps-lg-5">
                                                        <span class="badge badge-green btn-min-115 fs-4 p-2 fw-normal">Location :</span>
                                                        <p class="mb-0 ps-5 toggle-text text-break text-start">{{$dt->location}}</p>
                                                    </div>
                                                    <div
                                                        class="col-12 col-lg-4 mt-3 mt-lg-0 d-flex align-items-center ps-3 ps-lg-5">
                                                        <span class="badge badge-primary btn-min-115 fs-4 p-2 fw-normal">Expiry Date :</span>
                                                        <p class="mb-0 ps-5 text-start">{{$dt->expiration_date}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="position-absolute top-0 end-0 p-2">
                                        @if(!auth()->user()->is_guest)
                                            <div
                                                class="col-12 col-lg-2 mt-3 mt-lg-0 d-flex align-items-center ps-3 ps-lg-5">
                                                <button
                                                    type="button"
                                                    class="btn btn-success btn-sm me-2"
                                                    wire:click="$emit('showFoodItemCUModal', true, {{$dt->id}})"
                                                >
                                                    <i class="bi-pencil me-1"></i>
                                                </button>

                                                <button
                                                    type="button"
                                                    class="btn btn-danger btn-sm"
                                                    wire:click.prevent="destroy({{$dt->id}})"
                                                >
                                                    <i class="bi-trash"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @include('partials.no-data-available',['title' => 'No Food Items have been created yet!'])
                        @endif
                    </div>
                @endif

                @if($title == 'shopping')
                    <div class="" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        @if(isset($shoppingItems) && count($shoppingItems) > 0)
                            @foreach($shoppingItems as $dt)
                                <div class="card mb-4 card-hover-house-items pt-4 position-relative">
                                    <div class="card-body">
                                        <div class="row justify-content-center justify-content-md-start align-items-center text-start text-lg-center text-secondary-light">
                                            <div class="col-md-6 col-lg-2  border-right-solid text-center">
                                                <img src="{{$dt->getFileUrl('image')}}" alt="{{ $dt->title ?? '' }}"
                                                     style="width: 120px;height: 75px;object-fit: cover" class="rounded-3 food-item-img">
                                            </div>
                                            <div class="col-md-6 col-lg-10">
                                                <div class="row">
                                                    <div
                                                        class="col-12  col-lg-5 mt-3 mt-md-0 border-right-solid d-flex align-items-center ps-3 ps-lg-5">
                                                        <span class="badge badge-blue btn-min-115 fs-4 p-2 fw-normal">Shopping Item :</span>
                                                        <p class="mb-0 ps-5 toggle-text text-break text-start">{{$dt->name}}</p>

                                                    </div>
                                                    <div
                                                        class="col-12 col-lg-7 mt-3 mt-lg-0 d-flex align-items-center ps-3 ps-lg-5">
                                                        <span class="badge badge-green fs-4 p-2 fw-normal" style="min-width: 130px;">Where to buy :</span>
                                                        <p class="mb-0 ps-5 text-start text-break">{{$dt->location}}</p>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="position-absolute top-0 end-0 p-2">
                                        @if(!auth()->user()->is_guest)
                                            <div
                                                class="col-12 col-lg-2 mt-3 mt-lg-0 d-flex align-items-center ps-3 ps-lg-5">
                                                <button
                                                    type="button"
                                                    class="btn btn-success btn-sm me-2"
                                                    wire:click="$emit('showShoppingItemCUModal', true, {{$dt->id}})"
                                                >
                                                    <i class="bi-pencil me-1"></i>
                                                </button>

                                                <button
                                                    type="button"
                                                    class="btn btn-danger btn-sm"
                                                    wire:click.prevent="destroy({{$dt->id}})"
                                                >
                                                    <i class="bi-trash"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>


                                </div>
                            @endforeach
                        @else
                            @include('partials.no-data-available',['title' => 'Shopping List has not been created yet!'])
                        @endif
                    </div>
                @endif

            </div>
        </div>
    </section>
</div>
