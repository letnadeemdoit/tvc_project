<x-guest-layout>
    @push('stylesheets')

    @endpush


    @include('partials.sub-page-hero-section', ['title' => 'House Items'])

    <section class=" bg-light pt-55">
        <div class="bg-guest shadow-1-strong rounded text-center  d-flex justify-content-center align-items-center">
            <h1 class="text-primary font-vintage mb-0">Food Item</h1>
        </div>
        <h1 class="pt-2 text-center poppins-bold">View Available Food in House</h1>


        <div class="container mt-70 mb-5 bg-primary-light p-5">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h3>Food in the House</h3>
                </div>
                <div class="">

                    <div class="btn-group nav nav-tabs d-flex justify-content-end bg-secondary p-2 rounded-pill" id="myTab" role="tablist">
                        <button class="active btn btn-white rounded-pill"
                                id="home-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#home"
                                type="button"
                                role="tab"
                                aria-controls="home"
                                aria-selected="true"
                        >Food in House
                        </button>
                        <button class="btn rounded-pill"
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
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-12 col-md-6 col-lg-2 border-end">
                                    <img src="{{asset('/images/house-items/bread.svg')}}" class="img-fluid">
                                </div>
                                <div class="col-12 col-md-6 col-lg-3">
                                    <div class="d-flex w-100 justify-content-center align-items-center">
                                        <a  class="btn btn-soft-primary">Food Item:</a>
                                        <p class="mb-0">Bread</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3">fasdf</div>
                                <div class="col-12 col-md-6 col-lg-4">fasdfas</div>
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
