<x-guest-layout>
    @push('stylesheets')
    <style>
       .switch-button .active{
            background-color: #fff;
            color: #2A3342 !important;
        }

    </style>
    @endpush


    @include('partials.sub-page-hero-section', ['title' => 'House Items'])

    <section class=" bg-light pt-55">
        <div class="bg-guest shadow-1-strong rounded text-center  d-flex justify-content-center align-items-center">
            <h1 class="text-primary font-vintage mb-0">Food Item</h1>
        </div>
        <h1 class="pt-2 text-center poppins-bold">View Available Food in House</h1>


        <div class="container mt-70 mb-5 bg-light-primary p-5">
            <div class="d-block d-sm-flex justify-content-between align-items-center">
                <div class="">
                    <h3 class="mb-0">Food in the House</h3>
                </div>
                <div class="">

                    <div class="btn-group switch-button nav nav-tabs d-flex justify-content-end bg-dark-blue p-2 rounded-pill" id="myTab" role="tablist">
                        <button class="active btn rounded-pill text-white"
                                id="home-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#home"
                                type="button"
                                role="tab"
                                aria-controls="home"
                                aria-selected="true"
                        >Food in House
                        </button>
                        <button class="btn rounded-pill text-white"
                                id="profile-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#profile"
                                type="button"
                                role="tab"
                                aria-controls="profile"
                                aria-selected="false"
                        >Shopping List
                        </button>
                    </div>

                </div>
            </div>
            <div class="tab-content  mt-5" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row justify-content-center align-items-center text-start text-lg-center">
                                <div class="col-12 col-md-6 col-lg-2 border-right-solid">
                                    <img src="{{asset('/images/house-items/bread.svg')}}" width="90" class="img-fluid">
                                </div>
                                <div class="col-12 col-md-6 col-lg-3  mt-3 mt-lg-0 border-right-solid d-flex justify-content-start justify-content-lg-center align-items-center">
                                        <a  class="btn btn-soft-blue">Food Item :</a>
                                        <p class="mb-0 ps-5">Bread</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3  mt-3 mt-lg-0 border-right-solid d-flex justify-content-start justify-content-lg-center align-items-center">
                                        <a  class="btn btn-soft-green">Food Item :</a>
                                        <p class="mb-0 ps-5">Bread</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4 mt-3 mt-lg-0 d-flex  justify-content-start justify-content-lg-center align-items-center">
                                        <a  class="btn btn-soft-primary">Food Item :</a>
                                        <p class="mb-0 ps-5">Bread</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row justify-content-center align-items-center text-start text-lg-center">
                                <div class="col-12 col-md-6 col-lg-2 border-right-solid">
                                    <img src="{{asset('/images/house-items/bread.svg')}}" width="90" class="img-fluid">
                                </div>
                                <div class="col-12 col-md-6 col-lg-3  mt-3 mt-lg-0 border-right-solid d-flex justify-content-start justify-content-lg-center align-items-center">
                                        <a  class="btn btn-soft-blue">Food Item :</a>
                                        <p class="mb-0 ps-5">Bread</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3  mt-3 mt-lg-0 border-right-solid d-flex justify-content-start justify-content-lg-center align-items-center">
                                        <a  class="btn btn-soft-green">Food Item :</a>
                                        <p class="mb-0 ps-5">Bread</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4 mt-3 mt-lg-0 d-flex  justify-content-start justify-content-lg-center align-items-center">
                                        <a  class="btn btn-soft-primary">Food Item :</a>
                                        <p class="mb-0 ps-5">Bread</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">is is ofor</div>
            </div>
        </div>
        </div>

    </section>

</x-guest-layout>
