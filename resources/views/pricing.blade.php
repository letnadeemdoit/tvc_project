<x-guest-layout>
    @include('partials.sub-page-hero-section', ['title' => 'Pricing'])

    <section class="text-center">
        <div class="container py-lg-5">


            <div class="row my-5 py-5">
                <div class="col-12" x-data="{ period: 'monthly' }">
                    <div class="card py-5">
                        <div class="card-body">

                            <div class="btn-group rounded-pill bg-primary mb-5 border border-primary p-1">
                                <a href="#!" x-on:click="period = 'monthly' "
                                   class="btn rounded-pill text-white"
                                   :class="{ 'bg-white text-dark fw-600 border-0': period === 'monthly' }"
                                >Monthly</a>
                                <a href="#!" x-on:click="period = 'yearly'"
                                   class="btn rounded-pill text-white"
                                   :class="{ 'bg-white text-dark fw-600 border-0': period === 'yearly' }"
                                >Yearly</a>
                            </div>

                            <div class="table-responsive mt-lg-5">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="w-25 fw-bold fs-4 text-start" scope="col">Functionality</th>
                                        <th class="w-25" scope="col">
                                            <div x-show="period === 'monthly'">
                                                <h2>Basic</h2>
                                                <h1 class="text-primary">$5</h1>
                                                <p style="font-weight: 500">PRICE (BILLED MONTHLY)</p>
                                            </div>
                                            <div x-show="period === 'yearly' ">
                                                <h2>Basic</h2>
                                                <h1 class="text-primary">$40</h1>
                                                <p style="font-weight: 500">PRICE (BILLED YEARLY)</p>
                                            </div>
                                        </th>
                                        <th class="w-25 " scope="col">
                                            <div x-show="period === 'monthly'">
                                                <h2>Standard</h2>
                                                <h1 class="text-primary">$7</h1>
                                                <p style="font-weight: 500">PRICE (BILLED MONTHLY)</p>
                                            </div>
                                            <div x-show="period === 'yearly' ">
                                                <h2>Standard</h2>
                                                <h1 class="text-primary">$60</h1>
                                                <p style="font-weight: 500">PRICE (BILLED YEARLY)</p>
                                            </div>
                                        </th>
                                        <th class="w-25" scope="col">
                                            <div x-show="period === 'monthly'">
                                                <h2>Premium</h2>
                                                <h1 class="text-primary">$9</h1>
                                                <p style="font-weight: 500">PRICE (BILLED MONTHLY)</p>
                                            </div>
                                            <div x-show="period === 'yearly' ">
                                                <h2>Premium</h2>
                                                <h1 class="text-primary">$80</h1>
                                                <p style="font-weight: 500">PRICE (BILLED YEARLY)</p>
                                            </div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th class="text-start ps-lg-3" scope="row">Calendar</th>
                                        <td class="text-danger">X</td>
                                        <td class="text-danger">X</td>
                                        <td class="text-danger">X</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start ps-lg-3" scope="row">Bulletin Board</th>
                                        <td class="text-danger">X</td>
                                        <td class="text-danger">X</td>
                                        <td class="text-danger">X</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start ps-lg-3" scope="row">Blog</th>
                                        <td class="text-danger">X</td>
                                        <td class="text-danger">X</td>
                                        <td class="text-danger">X</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start ps-lg-3" scope="row">Photo Album</th>
                                        <td class="text-danger">X</td>
                                        <td class="text-danger">X</td>
                                        <td class="text-danger">X</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start ps-lg-3" scope="row">Local Guide</th>
                                        <td class="text-danger">X</td>
                                        <td class="text-danger">X</td>
                                        <td class="text-danger">X</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start ps-lg-3" scope="row">Food Items</th>
                                        <td class="text-danger">X</td>
                                        <td class="text-danger">X</td>
                                        <td class="text-danger">X</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start ps-lg-3" scope="row">Guest Book</th>
                                        <td class="text-danger">X</td>
                                        <td class="text-danger">X</td>
                                        <td class="text-danger">X</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start ps-lg-3" scope="row">Booking Rooms</th>
                                        <td>-</td>
                                        <td>Up to 6 rooms</td>
                                        <td>Unlimited rooms</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start ps-lg-3" scope="row">Additional Properties</th>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>Up to 9 properties</td>
                                    </tr>

                                    <tr>
                                        <th class="fw-semibold" scope="row"></th>
                                        <td><a href="{{route('register')}}" class="btn btn-sm btn-primary px-4">Sign
                                                up</a></td>
                                        <td><a href="{{route('register')}}" class="btn btn-sm btn-primary px-4">Sign
                                                up</a></td>
                                        <td><a href="{{route('register')}}" class="btn btn-sm btn-primary px-4">Sign
                                                up</a></td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @push('scripts')

    @endpush

</x-guest-layout>
